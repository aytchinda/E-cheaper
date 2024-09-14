<?php

namespace App\Http\Controllers;

use App\Models\Method;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\MethodFormRequest;
use Illuminate\Support\Facades\Storage;

class MethodController extends Controller
{
    public function index(): View
    {
        $methods = Method::orderBy('created_at', 'desc')->paginate(5);
        return view('methods/index', ['methods' => $methods]);
    }

    public function show($id): View
    {
        $method = Method::findOrFail($id);

        return view('methods/show',['method' => $method]);
    }
    public function create(): View
    {
        return view('methods/create');
    }

    public function edit($id): View
    {
        $method = Method::findOrFail($id);
        return view('methods/edit', ['method' => $method]);
    }

    public function store(MethodFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $method = Method::create($data);
        return redirect()->route('admin.method.show', ['id' => $method->id]);
    }

    public function update(Method $method, MethodFormRequest $req)
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        // Suppression de l'ancienne image si elle existe
        if ($method->imageUrl) {
            Storage::disk('public')->delete($method->imageUrl);
        }
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $method->update($data);

        return redirect()->route('admin.method.show', ['id' => $method->id]);
    }

    public function updateSpeed(Method $method, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $method->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Method $method)
    {
            if ($method->imageUrl) {
        Storage::disk('public')->delete($method->imageUrl);
    }
        $method->delete();

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