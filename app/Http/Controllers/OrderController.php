<?php

namespace App\Http\Controllers;

use App\Models\Order; // Assure-toi que tu as le modèle Order
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function getOrderDetails($orderId)
    {
        $order = Order::with('products')->findOrFail($orderId);

        // Mappe les produits pour récupérer le nom, le prix, la quantité et le total
        $products = $order->products->map(function ($product) {
            return [
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => $product->pivot->quantity, // Récupère la quantité depuis la table pivot
                'total' => $product->price * $product->pivot->quantity, // Calcule le total pour chaque produit
            ];
        });

        return response()->json([
            'order_id' => $order->id,
            'client_name' => $order->clientName,
            'total' => $order->order_cost,
            'products' => $products, // Renvoie les produits dans la réponse
        ]);
    }

    public function showOrderDetails($orderId)
    {
        // On récupère la commande avec les détails des produits associés
        $order = Order::with('orderDetails.product')->findOrFail($orderId);

        // Mappe les détails de la commande pour inclure les informations des produits
        $orderDetails = $order->orderDetails->map(function ($detail) {
            // Vérification si le produit existe
            if ($detail->product) {
                // Récupération de la première image depuis `imageUrls` (JSON)
                $imageUrls = json_decode($detail->product->imageUrls, true);  // Décoder le JSON
                $image = is_array($imageUrls) && count($imageUrls) > 0 ? $imageUrls[0] : null;  // Prendre la première image
            } else {
                $image = null;  // Aucun produit associé, donc pas d'image
            }

            return [
                'name' => $detail->product_name,  // Récupère le nom du produit depuis `OrderDetails`
                'price' => $detail->soldePrice,   // Utilise `soldePrice` pour le prix
                'quantity' => $detail->quantity,
                'total' => $detail->soldePrice * $detail->quantity, // Calcule le total
                'imageUrls' => $image,  // Utilise l'URL de la première image ou null
            ];
        });

        // On renvoie les détails de la commande à la vue
        return view('admin.orders.show', compact('order', 'orderDetails'));
    }








}
