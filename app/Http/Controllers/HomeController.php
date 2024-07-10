<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        $products = Product::all();

        // Extraire les noms des images de chaque produit
        $images = $products->pluck('imageUrls')->toArray();

        return view('home', compact('products', 'images'));
    }
}
