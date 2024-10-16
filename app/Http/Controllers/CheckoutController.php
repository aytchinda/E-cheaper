<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Carrier;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Role;
use App\Models\Settings;
use App\Models\User;
use App\Notifications\AdminOrderNotification;
use App\Services\CartService;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Stripe\StripeClient;

class CheckoutController extends Controller
{
    private $stripeService;
    private $cartService;

    public function __construct()
    {
        $this->stripeService = new StripeService();
        $this->cartService = new CartService();
    }

    public function index(CartService $cartService, Request $req)
    {
        // Récupérer les détails du panier via CartService
        $cart = $cartService->getCartDetails();

        // Récupérer l'utilisateur actuellement connecté
        $user = auth()->user();

        // Vérifier si l'utilisateur est connecté
        if ($user) {
            // Récupérer ses adresses
            $addresses = $user->addresses;
        } else {
            $addresses = collect(); // Renvoie une collection vide si aucun utilisateur connecté
        }

        // Récupérer le transporteur sélectionné depuis la session
        $carrierId = session('selected_carrier_id');
        $selectedCarrier = null;
        $carriers = Carrier::all();
        $stripe_public_key = $this->stripeService->getPublicKey();

        if ($carrierId) {
            $selectedCarrier = Carrier::find($carrierId);
        }

        // Récupérer les adresses de facturation et de livraison de la requête
        $billing_address_id = $req->input('billing_address_id');
        $shipping_address_id = $req->input('shipping_address_id');

        // Calcul de la variable $readyToPay
        $readyToPay = $req->has('billing_address_id') &&
            ($req->has('shipping_address_id') || !$req->has('add_shipping_address')) &&
            $selectedCarrier;

        // Initialisation des adresses de facturation et livraison
        $billing_address = '';
        $shipping_address = '';

        if ($readyToPay) {
            // Construire les adresses si elles existent
            if ($billing_address_id) {
                $address = Address::find($billing_address_id);
                $billing_address = $address->name . " " .
                    $address->clientName . " " .
                    $address->city . " " .
                    $address->state;
            }

            if ($shipping_address_id) {
                $address = Address::find($shipping_address_id);
                $shipping_address = $address->name . " " .
                    $address->clientName . " " .
                    $address->city . " " .
                    $address->state;
            } else {
                $shipping_address = $billing_address;
            }

            // Créer la commande si prêt à payer
            $orderID = $this->createOrder($billing_address, $shipping_address);
        } else {
            $orderID = null; // Pas de commande créée si non prêt à payer
        }

        return view('cheaper.checkout', [
            'cart' => $cart,
            'selectedCarrier' => $selectedCarrier,
            'carriers' => $carriers,
            'addresses' => $addresses,
            'stripe_public_key' => $stripe_public_key,
            'readyToPay' => $readyToPay,
            'orderID' => $orderID,
        ]);
    }

    public function createPaymentIntent(Request $request, $orderID)
    {
        $stripe = new \Stripe\StripeClient($this->stripeService->getPrivateKey());

        $order = Order::find($orderID);
        $amount = intval($order->order_cost_ttc * 100, 0);

        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => $amount,
            'currency' => 'eur',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);

        $order->stripe_payment_intent = $paymentIntent->client_secret;

        $order->save();

        return [
            'clientSecret' => $paymentIntent->client_secret
        ];
    }

    public function paymentSuccess(Request $request)
    {
        $stripe_payment_intent = $request->payment_intent_client_secret;
        $redirect_status = $request->redirect_status;

        if ($redirect_status == "succeeded") {
            $order = Order::where([

                'isPaid' => false,
                'stripe_payment_intent' => $stripe_payment_intent
            ])->first();

            if ($order) {
                $order->isPaid = true;
                $order->save();
            }

        }
        return view('cheaper.ordercompleted', ['order' => $order]);
    }

    protected function createOrder($billing_address, $shipping_address)
    {
        $cart = $this->cartService->getCartDetails();
        $order = new Order();
        $user = Auth::user();
        $carrier = Session::get('carrier', Carrier::first());

        // Taux de taxe : 21%
        $taxRate = 0.21;

        // Calcul du sous-total HT
        $order->clientName = $user->name;
        $order->billing_address = $billing_address;
        $order->shipping_address = $shipping_address;
        $order->carrier_name = $carrier->name;
        $order->carrier_price = $carrier->price;
        $order->quantity = $cart['cart_count'];
        $order->order_cost = $cart['sub_total_with_shipping'];

        // Calcul de la taxe
        $order->taxe = $taxRate * $cart['sub_total_with_shipping'];

        // Calcul du total TTC
        $order->order_cost_ttc = $order->order_cost + $order->taxe + $carrier->price;

        $order->payment_method = "Stripe";
        $order->save();

        // Enregistrer les détails des articles
        foreach ($cart['items'] as $item) {
            $orderDetails = new OrderDetails();
            $orderDetails->product_name = $item['product']['name'];
            $orderDetails->product_description = $item['product']['description'];
            $orderDetails->soldePrice = $item['product']['soldePrice'];
            $orderDetails->regularPrice = $item['product']['regularPrice'];
            $orderDetails->quantity = $item['quantity'];

            // Calcul de la taxe pour chaque produit
            $orderDetails->taxe = $taxRate * $item['product']['soldePrice'];

            // Calcul du sous-total HT et TTC pour chaque produit
            $orderDetails->sub_total_ht = $item['product']['soldePrice'] * $item['quantity'];
            $orderDetails->sub_total_ttc = $orderDetails->sub_total_ht + $orderDetails->taxe;

            $orderDetails->order_id = $order->id;
            $orderDetails->save();
        }

        // Après la création de la commande dans la méthode createOrder
        $admins = Role::where('value', 'ROLE_ADMIN')->first()->users;
        foreach ($admins as $admin) {
            $admin->notify(new AdminOrderNotification($order));
        }

        return $order->id;
    }


}
