<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CarrierFormRequest;
use Illuminate\Support\Facades\Storage;

class CarrierController extends Controller
{
    public function index(): View
    {
        $carriers = Carrier::orderBy('created_at', 'desc')->paginate(5);
        return view('carriers/index', ['carriers' => $carriers]);
    }

    public function show($id): View
    {
        $carrier = Carrier::findOrFail($id);

        return view('carriers/show',['carrier' => $carrier]);
    }
    public function create(): View
    {
        return view('carriers/create');
    }

    public function edit($id): View
    {
        $carrier = Carrier::findOrFail($id);
        return view('carriers/edit', ['carrier' => $carrier]);
    }

    public function store(CarrierFormRequest $req): RedirectResponse
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $carrier = Carrier::create($data);
        return redirect()->route('admin.carrier.show', ['id' => $carrier->id]);
    }

    public function update(Carrier $carrier, CarrierFormRequest $req)
    {
        $data = $req->validated();

            if ($req->hasFile('imageUrl')) {
        // Suppression de l'ancienne image si elle existe
        if ($carrier->imageUrl) {
            Storage::disk('public')->delete($carrier->imageUrl);
        }
        $data['imageUrl'] = $this->handleImageUpload($req->file('imageUrl'));
    }

        $carrier->update($data);

        return redirect()->route('admin.carrier.show', ['id' => $carrier->id]);
    }

    public function updateSpeed(Carrier $carrier, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $carrier->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Carrier $carrier)
    {
            if ($carrier->imageUrl) {
        Storage::disk('public')->delete($carrier->imageUrl);
    }
        $carrier->delete();

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