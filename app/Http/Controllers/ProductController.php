<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductFormRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::orderBy('created_at', 'desc')->paginate(5);
        return view('products/index', ['products' => $products]);
    }

    public function show($id): View
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products/show',['product' => $product,]);
    }
    public function create(): View
    {
        $categories = Category::all();
        return view('products/create',['categories'=> $categories]);
    }

    public function edit($id): View
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('products/edit', ['product' => $product,'categories'=> $categories]);
    }

    public function store(ProductFormRequest $req): RedirectResponse
    {
        $categories = $req->validated('categories');
        $data = $req->validated();

            if ($req->hasFile('imageUrls')) {
        $data['imageUrls'] = json_encode($this->handleImageUpload($req->file('imageUrls')));
    }

        $product = Product::create($data);

        $product->categories()->sync($categories);

        return redirect()->route('admin.product.show', ['id' => $product->id]);
    }

    public function update(Product $product, ProductFormRequest $req)
    {
        $categories = $req->validated('categories');
        $data = $req->validated();

            if ($req->hasFile('imageUrls')) {
        $uploadedImages = $this->handleImageUpload($req->file('imageUrls'));
        // Suppression des anciennes images s'il en existe
        if ($product->imageUrls && is_array($product->imageUrls)) {
            foreach ($product->imageUrls as $imageUrl) {
                Storage::disk('public')->delete($imageUrl);
            }
        }
        $data['imageUrls'] = json_encode($uploadedImages);
    }

        $product->update($data);
        $product->categories()->sync($categories);

        return redirect()->route('admin.product.show', ['id' => $product->id]);
    }

    public function updateSpeed(Product $product, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $product->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Product $product)
    {
        if ($product->imageUrls) {
    foreach ($product->imageUrls as $image) {
        Storage::disk('public')->delete($image);
    }
}
        $product->delete();

        return [
            'isSuccess' => true
        ];
    }

        private function handleImageUpload(\Illuminate\Http\UploadedFile|array $images): string|array
    {
        if (is_array($images)) {
            $uploadedImages = [];
            foreach ($images as $image) {
                $imageName = uniqid() . '_' . $image->getClientOriginalName();
                $image->storeAs('images', $imageName, 'public');
                $uploadedImages[] = 'images/' . $imageName;
            }
            return $uploadedImages;
        } else {
            $imageName = uniqid() . '_' . $images->getClientOriginalName();
            $images->storeAs('images', $imageName, 'public');
            return 'images/' . $imageName;
        }
    }



}
