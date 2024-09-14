<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\Carrier;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Settings;
use App\Models\User;
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

    public function createPaymentIntent(Request $request)
    {
        $stripe = new \Stripe\StripeClient($this->stripeService->getPrivateKey());

        $paymentIntent = $stripe->paymentIntents->create([
            'amount' => 1900,
            'currency' => 'eur',
            'automatic_payment_methods' => [
                'enabled' => true,
            ],
        ]);

        return [
            'clientSecret' => $paymentIntent->client_secret
        ];
    }

    protected function createOrder($billing_address, $shipping_address)
    {
        $cart = $this->cartService->getCartDetails();
        $order = new Order();
        $user = Auth::user();
        $carrier = Session::get('carrier', Carrier::first());
        $taxerate = 0.21;

        $order->clientName = $user->name;
        $order->billing_address = $billing_address;
        $order->shipping_address = $shipping_address;
        $order->carrier_name = $carrier->name;
        $order->carrier_price = $carrier->price;
        $order->quantity = $cart['cart_count'];
        $order->order_cost = $cart['sub_total_with_shipping'];
        $order->taxe = $taxerate * $cart['sub_total_with_shipping'];
        $order->order_cost_ttc = $cart['sub_total_with_shipping'] + $order->taxe;
        $order->payment_method = "Stripe";

        $order->save(); // Correction ici

        foreach ($cart['items'] as $item) {
            $orderDetails = new OrderDetails();
            $orderDetails->product_name = $item['product']['name'];
            $orderDetails->product_description = $item['product']['description'];
            $orderDetails->soldePrice = $item['product']['soldePrice'];
            $orderDetails->regularPrice = $item['product']['regularPrice'];
            $orderDetails->quantity = $item['quantity'];
            $orderDetails->taxe = $taxerate * $item['product']['soldePrice'];
            $orderDetails->sub_total_ht = $item['product']['soldePrice'] * $item['quantity'];
            $orderDetails->sub_total_ttc = $orderDetails->sub_total_ht + $orderDetails->taxe;
            $orderDetails->order_id = $order->id;
            $orderDetails->save();
        }

        return $order->id;
    }
}
