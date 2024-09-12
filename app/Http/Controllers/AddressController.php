<?php

namespace App\Http\Controllers;

use App\Models\Address;
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AddressFormRequest;
use Illuminate\Support\Facades\Storage;

class AddressController extends Controller
{
    public function index(): View
    {
        $addresses = Address::orderBy('created_at', 'desc')->paginate(5);
        return view('addresses/index', ['addresses' => $addresses]);
    }

    public function show($id): View
    {
        $address = Address::findOrFail($id);

        return view('addresses/show',['address' => $address]);
    }
    public function create(): View
    {
        $users = User::all();
        return view('addresses/create', ['users' => $users]);
    }

    public function edit($id): View
    {

        $users = User::all();
        $address = Address::findOrFail($id);
        return view('addresses/edit', ['address' => $address], ['users' => $users]);
    }

    public function store(AddressFormRequest $req): RedirectResponse
    {
        // Valider les données
        $data = $req->validated();

        // Assurez-vous que 'user_id' est présent dans $data
        $data['user_id'] = $req->input('user_id');

        // Créer l'adresse avec 'user_id'
        $address = Address::create($data);

        return redirect()->route('admin.address.show', ['id' => $address->id]);
    }

    public function update(Address $address, AddressFormRequest $req): RedirectResponse
    {
        // Valider les données
        $data = $req->validated();

        // Assurez-vous que 'user_id' est présent dans $data
        $data['user_id'] = $req->input('user_id');

        // Mettre à jour l'adresse avec 'user_id'
        $address->update($data);

        return redirect()->route('admin.address.show', ['id' => $address->id]);
    }


    public function updateSpeed(Address $address, Request $req)
    {
        foreach ($req->all() as $key => $value) {
            $address->update([
                $key => $value
            ]);
        }

        return [
            'isSuccess' => true,
            'data' => $req->all()
        ];
    }

    public function delete(Address $address)
    {

        $address->delete();

        return [
            'isSuccess' => true
        ];
    }


}
