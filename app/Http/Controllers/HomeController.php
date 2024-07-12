<?php

namespace App\Http\Controllers;

use App\Models\Banner;
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

    $newArrivals = Product::where("isNewArrival", true)->orderBy("id","desc")->get();
    $bestSellers = Product::where("isBestSeller", true)->orderBy("id","desc")->get();
    $featured = Product::where("isFeatured", true)->orderBy("id","desc")->get();
    $specialOffers = Product::where("isSpecialOffer", true)->orderBy("id","desc")->get();
    // dd($newArrivals);

        return view('home', compact(
            'products',
            'banners',
            'collections',
            'newArrivals', 'bestSellers', 'featured', 'specialOffers'
        ));
    }
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }
}

