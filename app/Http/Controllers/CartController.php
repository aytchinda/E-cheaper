<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CartService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CartController extends Controller
{
    // Afficher le panier
    public function index(CartService $cartService): View
    {
        $cart = $cartService->getCartDetails();
        return view('cheaper.cart', ['cart' => $cart]);
    }

    // Ajouter un produit au panier
    public function addToCart(CartService $cartService, $productId, Request $request)
    {
        // Supposons que la quantité par défaut soit 1 ou qu'elle provienne de la requête
        $quantity = $request->input('quantity', 1);

        // Récupérez le produit depuis la base de données
        $product = Product::find($productId);

        // Vérifiez si le produit existe
        if (!$product) {
            return redirect()->back()->with('error', 'Produit non trouvé');
        }

        // Appel du service pour ajouter au panier
        $cartService->addToCart($productId, $quantity, $product);

        // Redirection vers la page du panier avec un message de succès
        return redirect()->back()->with('success', 'Produit ajouté au panier');
    }


    public function removeFromCart(CartService $cartService, $productId, $quantity)
    {

        $cartService->removeFromCart($productId, $quantity);

        $cart = $cartService->getCartDetails();

        return redirect()->route('cart.index')->with('success', 'Produit retire du panier');

    }

    public function incrementQuantity(CartService $cartService, $productId)
    {
        $cartService->updateQuantity($productId, 1);
        return redirect()->route('cart.index');
    }

    public function decrementQuantity(CartService $cartService, $productId)
    {
        $cartService->updateQuantity($productId, -1);
        return redirect()->route('cart.index');
    }


}
