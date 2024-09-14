<?php

namespace App\Services;

use App\Models\Carrier;
use App\Models\Product;
use Illuminate\Support\Facades\Session;

class CartService
{
    public function addToCart($productId, $quantity, $product)
{
    // Récupérer ou initialiser le panier
    $cart = session()->get('cart', ['items' => []]);

    // Vérifier si le produit est déjà dans le panier
    if (isset($cart['items'][$productId])) {
        // Augmenter la quantité
        $cart['items'][$productId]['quantity'] += $quantity;
        // Recalculer le sous-total
        $cart['items'][$productId]['sub_total'] = $cart['items'][$productId]['quantity'] * $cart['items'][$productId]['product']['price'];
    } else {
        // Ajouter le produit au panier
        $cart['items'][$productId] = [
            'product' => [
                'id' => $product->id,
                'name' => $product->name,
                'price' => $product->soldePrice,
                'imageUrls' => $product->imageUrls, // Assurez-vous que cette clé est définie ici
            ],
            'quantity' => $quantity,
            'sub_total' => $product->soldePrice * $quantity, // Calcul du sous-total
        ];
    }

    // Mettre à jour la session avec le panier modifié
    session()->put('cart', $cart);
}


    public function removeFromCart($productId)
    {
        // Récupérer le panier depuis la session
        $cart = session()->get('cart', ['items' => []]);

        // Si le produit existe dans le panier, le retirer
        if (isset($cart['items'][$productId])) {
            unset($cart['items'][$productId]);
        }

        // Mettre à jour la session
        session()->put('cart', $cart);
    }

    public function clearCart()
    {
        // Supprimer le panier entier de la session
        session()->forget('cart');
    }

    public function updateQuantity($productId, $quantityChange)
    {
        $cart = session()->get('cart');

        if (isset($cart['items'][$productId])) {
            $cart['items'][$productId]['quantity'] += $quantityChange;

            if ($cart['items'][$productId]['quantity'] < 1) {
                unset($cart['items'][$productId]);
            }

            session()->put('cart', $cart);
        }
    }


    public function getCartDetails()
    {
        // Récupérer le panier depuis la session
        $cart = session()->get('cart', ['items' => []]);

        // Initialiser le tableau de résultat
        $result = [
            'items' => [],
            'sub_total' => 0,
            'cart_count' => 0,
            'sub_total_with_shipping' => 0 // Initialisation du total avec frais de livraison
        ];

        // Récupérer le transporteur sélectionné ou le premier transporteur par défaut
        $carrier = Session::get('carrier', Carrier::first());

        // Boucle sur chaque élément du panier pour préparer les détails
        foreach ($cart['items'] as $productId => $item) {
            $product = Product::find($productId);
            if ($product) {
                // Ajouter les détails de l'article au résultat
                $result['items'][] = [
                    'product' => [
                        'id' => $product->id,
                        'name' => $product->name,
                        'description' => $product->description,
                        'soldePrice' => $product->soldePrice,
                        'regularPrice' => $product->regularPrice,
                        'imageUrls' => $product->imageUrls, // Assurez-vous que c'est bien ce que vous attendez
                    ],
                    'quantity' => $item['quantity'],
                    'sub_total' => $item['sub_total'],
                ];

                // Calculer le sous-total et le nombre d'articles dans le panier
                $result['sub_total'] += $item['sub_total'];
                $result['cart_count'] += $item['quantity'];
            }
        }

        // Ajouter les frais de livraison au total si un transporteur est sélectionné
        if ($carrier) {
            $shipping_cost = $carrier->price;
            $result['sub_total_with_shipping'] = $result['sub_total'] + $shipping_cost;
        } else {
            $result['sub_total_with_shipping'] = $result['sub_total']; // Si pas de frais de livraison
        }

        return $result;
    }


    public function getCartCount()
{
    $cart = session()->get('cart', ['items' => []]);
    $totalQuantity = 0;

    foreach ($cart['items'] as $item) {
        $totalQuantity += $item['quantity'];
    }

    return $totalQuantity;
}
}
