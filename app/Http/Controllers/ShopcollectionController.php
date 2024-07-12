<?php

namespace App\Http\Controllers;

use App\Models\Shopcollection;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ShopcollectionFormRequest;
use Illuminate\Support\Facades\Storage;

class ShopcollectionController extends Controller
{
    public function index(): View
    {
        $shopcollections = Shopcollection::orderBy('created_at', 'desc')->paginate(5);
        return view('shopcollections/index', ['shopcollections' => $shopcollections]);
    }

    public function show($id): View
    {
        $shopcollection = Shopcollection::findOrFail($id);

        return view('shopcollections/show',['shopcollection' => $shopcollection]);
    }
    public function create(): View
    {
        return view('shopcollections/create');
    }

    public function edit($id): View
    {
        $shopcollection = Shopcollection::findOrFail($id);
        return view('shopcollections/edit', ['shopcollection' => $shopcollection]);
    }

    public function store(ShopcollectionFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $shopcollection = Shopcollection::create($data);
        return redirect()->route('admin.shopcollection.show', ['id' => $shopcollection->id]);
    }

    public function update(Shopcollection $shopcollection, ShopcollectionFormRequest $req)
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        // Suppression de l'ancienne image si elle existe
        if ($shopcollection->imageUrl) {
            Storage::disk('public')->delete($shopcollection->imageUrl);
        }
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $shopcollection->update($data);

        return redirect()->route('admin.shopcollection.show', ['id' => $shopcollection->id]);
    }

    public function updateSpeed(Shopcollection $shopcollection, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $shopcollection->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Shopcollection $shopcollection)
    {
            if ($shopcollection->imageUrl) {
        Storage::disk('public')->delete($shopcollection->imageUrl);
    }
        $shopcollection->delete();

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