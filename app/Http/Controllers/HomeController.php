<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
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

        // Récupère la langue courante (en, fr, es)
        $locale = app()->getLocale();

        // Sélectionne le titre et le contenu en fonction de la langue
        $title = $page->{'title_' . $locale};
        $content = $page->{'content_' . $locale};

        // Retourne la vue avec les titres et contenus traduits
        return view('cheaper.components.page', [
            'page' => $page,
            'title' => $title,
            'content' => $content,
        ]);
    }

    public function showProduct(string $slug): View
    {
        $product = Product::where('slug', $slug)->firstOrFail();
        return view('cheaper.product', ['product' => $product]);
    }


    public function shopByCategory(Request $req, $slug): View
    {
        // Récupération de la catégorie par son slug
        $category = Category::where('slug', $slug)->first();

        // Vérifier si la catégorie existe
        if (!$category) {
            return redirect()->route('shop')->with('error', 'Catégorie non trouvée.');
        }

        // Récupération des produits de la catégorie avec tri
        $sort = $req->input('sort');

        if ($sort === 'price_desc') {
            // Tri par prix décroissant
            $products = Product::where('category_id', $category->id)->orderBy('soldePrice', 'desc')->paginate(6);
        } elseif ($sort === 'price_asc') {
            // Tri par prix croissant
            $products = Product::where('category_id', $category->id)->orderBy('soldePrice', 'asc')->paginate(6);
        } else {
            // Pas de tri, juste la pagination par défaut
            $products = Product::where('category_id', $category->id)->paginate(6);
        }

        // Récupération de toutes les catégories pour l'affichage dans la vue
        $categories = Category::all();

        // Retourne la vue avec les produits filtrés par catégorie et les catégories disponibles
        return view('cheaper.shop', [
            'products' => $products,
            'category' => $category,
            'categories' => $categories
        ]);
    }





    public function shop(Request $req): View
    {
        // Récupération des catégories
        $categories = Category::all();

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

        // Retourne la vue avec les produits et les catégories
        return view('cheaper.shop', ['products' => $products, 'categories' => $categories]);
    }


    public function search(Request $request): View

    {
        $categories = Category::all();

        $query = $request->input('query');

        // Rechercher les produits dont le nom contient les 3 premières lettres ou plus du texte entré
        $products = Product::where('name', 'LIKE', "%{$query}%")->paginate(6);

        // Retourner les résultats de la recherche vers la vue
        return view('cheaper.shop', ['products' => $products, 'query' => $query, 'categories' => $categories]);
    }






}
