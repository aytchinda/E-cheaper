<?php

namespace App\Services;

use App\Models\Product; // Make sure to import the Product model here
use Illuminate\Support\Facades\Session;

class CompareService
{
    public function addProductToCompare($productId)
    {
        $compareProducts = Session::get('compare', []);

        if (!in_array($productId, $compareProducts)) {
            $compareProducts[] = $productId;
            Session::put('compare', $compareProducts);
        }
    }

    public function removeProductFromCompare($productId)
    {
        $compareProducts = Session::get('compare', []);

        $index = array_search($productId, $compareProducts);
        if ($index !== false) {
            unset($compareProducts[$index]);
            Session::put('compare', array_values($compareProducts));
        }
    }

    public function getComparedProducts()
    {
        return Session::get('compare', []);
    }
    public function getComparedProductsDetails()
    {
        $compareProducts = Session::get('compare', []);
        $comparedDetails = [];

        foreach ($compareProducts as $productId) {
            $product = Product::find($productId);

            if ($product) {
                $comparedDetails[] = [
                    'id' => $product->id,
                    'name' => $product->name,
                    'soldePrice' => $product->soldePrice,
                    'regularPrice' => $product->regularPrice,
                    'imageUrls' => $product->imageUrls,
                    // Ajoutez d'autres attributs du produit ici
                ];
            }
        }

        return $comparedDetails;
    }

    public function clearComparedProducts()
    {
        Session::forget('compare');
    }
}
