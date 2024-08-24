<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\CompareService;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    protected $compareService;

    public function __construct(CompareService $compareService)
    {
        $this->compareService = $compareService;
    }

    public function addToCompare($productId)
    {
        $this->compareService->addProductToCompare($productId);
        return redirect()->back()->with('success', 'Produit ajouté à la comparaison.');
    }

    public function removeFromCompare($productId)
    {
        $this->compareService->removeProductFromCompare($productId);
        return redirect()->back()->with('success', 'Produit retiré de la comparaison.');
    }

    public function compare(Request $request)
    {
        // Si des produits sont sélectionnés via le formulaire GET, on les traite
        if ($request->has('products')) {
            $productIds = $request->get('products');
            $comparedProducts = Product::whereIn('id', $productIds)->get();
            return view('cheaper.compare', compact('comparedProducts'));
        }

        // Si aucun produit n'est passé via la requête, on vérifie la session
        $sessionProductIds = $this->compareService->getComparedProducts();
        if (!empty($sessionProductIds)) {
            $comparedProducts = Product::whereIn('id', $sessionProductIds)->get();
            return view('cheaper.compare', compact('comparedProducts'));
        }

        // Sinon, on retourne un message d'erreur
        return view('cheaper.compare', ['comparedProducts' => []])->with('error', 'Aucun produit sélectionné pour la comparaison.');
    }


    public function clearCompare()
    {
        $this->compareService->clearComparedProducts();
        return redirect()->back()->with('success', 'Comparaison vidée.');
    }



}
