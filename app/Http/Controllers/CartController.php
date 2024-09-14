<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    // Afficher le panier
    public function index(CartService $cartService, Request $req): View
    {
        $cart = $cartService->getCartDetails();
        $carriers = Carrier::all();

        // Vérifier si un transporteur est déjà stocké dans la session
        $carrierId = $req->input('carrier_id') ?? session('selected_carrier_id');
        $selectedCarrier = null;

        if ($carrierId && is_numeric($carrierId)) {
            // Si un carrier_id est sélectionné et valide, le rechercher
            $selectedCarrier = Carrier::find($carrierId);
        }

        // Si aucun transporteur n'est sélectionné ou que l'ID est invalide, utiliser le premier transporteur par défaut
        if (!$selectedCarrier) {
            $selectedCarrier = Carrier::first();
        }

        // Stocker le transporteur sélectionné dans la session
        session(['selected_carrier_id' => $selectedCarrier->id]);

        return view('cheaper.cart', [
            'cart' => $cart,
            'carriers' => $carriers,
            'selectedCarrier' => $selectedCarrier // Passe correctement le transporteur sélectionné à la vue
        ]);
    }


    // Ajouter un produit au panier
    public function addToCart(CartService $cartService, $productId, Request $request)
    {
        $quantity = $request->input('quantity', 1);
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->back()->with('error', 'Produit non trouvé');
        }

        $cartService->addToCart($productId, $quantity, $product);

        return redirect()->back()->with('success', 'Produit ajouté au panier');
    }

    // Retirer un produit du panier
    public function removeFromCart(CartService $cartService, $productId, $quantity)
    {
        $cartService->removeFromCart($productId, $quantity);

        return redirect()->route('cart.index')->with('success', 'Produit retiré du panier');
    }

    // Incrémenter la quantité d'un produit dans le panier
    public function incrementQuantity($id)
    {
        $cart = session()->get('cart');

        if (isset($cart['items'][$id])) {
            $cart['items'][$id]['quantity']++;
            $cart['items'][$id]['sub_total'] = $cart['items'][$id]['quantity'] * $cart['items'][$id]['product']['price'];
        }

        session()->put('cart', $cart);

        return response()->json(['status' => 'success', 'cart' => $cart]);
    }

    // Décrémenter la quantité d'un produit dans le panier
    public function decrementQuantity($id)
    {
        $cart = session()->get('cart');

        if (isset($cart['items'][$id]) && $cart['items'][$id]['quantity'] > 1) {
            $cart['items'][$id]['quantity']--;
            $cart['items'][$id]['sub_total'] = $cart['items'][$id]['quantity'] * $cart['items'][$id]['product']['price'];
        }

        session()->put('cart', $cart);

        return response()->json(['status' => 'success', 'cart' => $cart]);
    }
}
