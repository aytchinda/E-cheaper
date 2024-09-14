<?php

namespace App\Http\Controllers;

use App\Models\Carrier;
use App\Models\User;
use App\Services\CartService;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function index(CartService $cartService, Request $req)
    {
        // Récupérer les détails du panier via CartService
        $cart = $cartService->getCartDetails();

        // Récupérer l'utilisateur actuellement connecté
        $user = auth()->user();

        // Vérifier si l'utilisateur est connecté
        if ($user) {
            // Récupérer ses adresses
            $addresses = $user->addresses;
        } else {
            $addresses = collect(); // Renvoie une collection vide si aucun utilisateur connecté
        }

        // Récupérer le transporteur sélectionné depuis la session
        $carrierId = session('selected_carrier_id');
        $selectedCarrier = null;
        $carriers = Carrier::all();

        if ($carrierId) {
            $selectedCarrier = Carrier::find($carrierId);
        }

        return view('cheaper.checkout', [
            'cart' => $cart,
            'selectedCarrier' => $selectedCarrier,
            'carriers' => $carriers,
            'addresses' => $addresses,
        ]);
    }
}
