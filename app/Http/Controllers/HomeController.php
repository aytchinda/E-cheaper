<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Page;
use App\Models\Product;
use App\Models\ShopCollection;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $products = Product::all();
        $collections = ShopCollection::all();
        $banners = Banner::all();

        $newArrivals = Product::where("isNewArrival", true)->orderBy("id", "desc")->get();
        $bestSellers = Product::where("isBestSeller", true)->orderBy("id", "desc")->get();
        $featured = Product::where("isFeatured", true)->orderBy("id", "desc")->get();
        $specialOffers = Product::where("isSpecialOffer", true)->orderBy("id", "desc")->get();
        // dd($newArrivals);

        return view('home', compact(
            'products',
            'banners',
            'collections',
            'newArrivals',
            'bestSellers',
            'featured',
            'specialOffers'
        ));
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    public function showPage(Page $page): View
    {
        if (!$page) {
            abort(404);
        }
        return view('cheaper.components.page', ['page' => $page]);
    }

    public function showProduct(string $slug): View
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('cheaper.product', ['product' => $product]);
    }

    public function shop(Request $req): View
    {
        // Récupération de la valeur du tri
        $sort = $req->input('sort');

        if ($sort === 'price_desc') {
            // Tri par prix décroissant
            $products = Product::orderBy('soldePrice', 'desc')->paginate(6);
        } elseif ($sort === 'price_asc') {
            // Tri par prix croissant
            $products = Product::orderBy('soldePrice', 'asc')->paginate(6);
        } else {
            // Pas de tri, juste la pagination par défaut
            $products = Product::paginate(6);
        }

        // Retourne toujours la vue avec les produits
        return view('cheaper.shop', ['products' => $products]);
    }

   
}

