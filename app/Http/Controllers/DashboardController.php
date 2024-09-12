<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    //

    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        $user = Auth::user();

        $addresses = $user->addresses;
        return view('cheaper.dashboard', compact('user', 'addresses'));
    }

    public function addressEdit($id)
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        $address = Address::findOrFail($id);
        $user = Auth::user();

        if ($address->user_id != $user->id) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to edit this address.');
        }
        return view('cheaper.dashboard', ['user' => $user, 'address' => $address, 'action' => 'address.edit']);
    }
    public function createAddress()
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }
        $user = Auth::user();
        return view('cheaper.dashboard', ['user' => $user, 'action' => 'address.add']);
    }



    public function update(address $address, Request $request)
    {

        $isRequired = $request->isMethod("POST") ? 'required|' : "";

        $request->validate([
            'name' => $isRequired . 'string',
            'clientName' => $isRequired . 'string',
            'street' => $isRequired . 'string',
            'codePostal' => $isRequired . 'string',
            'city' => $isRequired . 'string',
            'state' => $isRequired . 'string',
            'noreDetails' => 'string',
            'addressType' => $isRequired . 'in:Adresse de livraison,Adresse de facturation', // Validation stricte des valeurs acceptées
        ]);
        $address->update([
            'name' => $request->name,
            'clientName' => $request->clientName,
            'street' => $request->street,
            'codePostal' => $request->codePostal,
            'city' => $request->city,
            'state' => $request->state,
            'noreDetails' => $request->noreDetails,
            'addressType' => $request->addressType,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Address updated successfully.');
    }
    public function store(address $address, Request $request)
    {

        $isRequired = $request->isMethod("POST") ? 'required|' : "";

        $request->validate([
            'name' => $isRequired . 'string',
            'clientName' => $isRequired . 'string',
            'street' => $isRequired . 'string',
            'codePostal' => $isRequired . 'string',
            'city' => $isRequired . 'string',
            'state' => $isRequired . 'string',
            'noreDetails' => 'string',
            'addressType' => $isRequired . 'in:Adresse de livraison,Adresse de facturation', // Validation stricte des valeurs acceptées
        ]);
        $address->create([
            'name' => $request->name,
            'clientName' => $request->clientName,
            'street' => $request->street,
            'codePostal' => $request->codePostal,
            'city' => $request->city,
            'state' => $request->state,
            'noreDetails' => $request->noreDetails,
            'addressType' => $request->addressType,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('dashboard.index')->with('success', 'Address updated successfully.');
    }


    public function delete($id)
    {
        if (!Auth::check()) {
            return redirect()->route('home');
        }

        $user = Auth::user();
        $address = Address::findOrFail($id);

        if ($address->user_id != $user->id) {
            return redirect()->route('dashboard')->with('error', 'You are not authorized to delete this address.');
        }
        // Supprimer l'adresse
        $address->delete();
        return redirect()->route('dashboard.index')->with('success', 'Adresse supprimée avec succès.');
    }




}
