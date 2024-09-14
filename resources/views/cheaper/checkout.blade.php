@extends('simple')

@section('title')
    Checkout | Cheaper
@endsection

<!-- Bootstrap CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome CDN for card icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

<div class="container my-5">
    <h2 class="text-center mb-5 fw-bold">Validation de la commande</h2>

    @if (session()->has('cart') && isset(session()->get('cart')['items']) && count(session()->get('cart')['items']) > 0)
        <!-- Détails de la commande -->
        <div class="row g-4">
            <!-- Section de gauche: produits -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">Vos Produits</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">Produit</th>
                                    <th scope="col">Nom du produit</th>
                                    <th scope="col">Prix</th>
                                    <th scope="col">Quantité</th>
                                    <th scope="col">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach (session()->get('cart')['items'] as $item)
                                    <tr>
                                        <td>
                                            @php
                                                $imageUrl = is_array(json_decode($item['product']['imageUrls']))
                                                    ? json_decode($item['product']['imageUrls'])[0]
                                                    : $item['product']['imageUrls'];
                                            @endphp
                                            <img src="{{ asset('storage/' . trim($imageUrl, '["]')) }}"
                                                class="rounded shadow-sm" alt="{{ $item['product']['name'] }}"
                                                style="width: 70px; height: auto;">
                                        </td>
                                        <td class="fw-semibold">{{ $item['product']['name'] }}</td>
                                        <td class="text-success fw-bold">
                                            €{{ number_format($item['product']['price'], 2, ',', ' ') }}
                                        </td>
                                        <td>{{ $item['quantity'] }}</td>
                                        <td class="fw-semibold">
                                            €{{ number_format($item['product']['price'] * $item['quantity'], 2, ',', ' ') }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Détails de facturation et de livraison côte à côte -->
                <div class="row mt-4">
                    <!-- Billing Details -->
                    <div class="col-md-6">
                        <h5 class="fw-bold mb-3">Billing Details</h5>
                        @if (auth()->check() && auth()->user()->addresses->isNotEmpty())
                            <form action="{{ url()->current() }}" method="GET">
                                <select name="billing_address_id" id="billing_address_id" class="form-control mb-3"
                                    onchange="this.form.submit()">
                                    <option value="">Sélectionnez l'adresse de facturation</option>
                                    @foreach (auth()->user()->addresses as $address)
                                        <option value="{{ $address->id }}"
                                            {{ request()->get('billing_address_id') == $address->id ? 'selected' : '' }}>
                                            {{ $address->addressType }} - {{ $address->street }} - {{ $address->city }} - {{ $address->state }} - {{ $address->codePostal }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        @else
                            <form action="" >
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name ..." required>
                                </div>
                                <div class="mb-3">
                                    <label for="street" class="form-label">Street</label>
                                    <input type="text" name="street" class="form-control" placeholder="Street ..." required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="codePostal" class="form-label">Code Postal</label>
                                        <input type="text" name="codePostal" class="form-control" placeholder="Code Postal ..." required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" name="city" class="form-control" placeholder="City ..." required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="state" class="form-label">State</label>
                                        <input type="text" name="state" class="form-control" placeholder="State ..." required>
                                    </div>
                                </div>
                                <button class="btn btn-success">Add Address</button>
                            </form>
                        @endif
                    </div>

                    <div class="mb-1 col-md-4">
                        <input type="checkbox" name="add_shipping_address" id="add_shipping_address">
                        <label for="add_shipping_address">Adresse de livraison différente de l'adresse de facturation</label>
                    </div>

                    <!-- Shipping Details -->
                    <div class="col-md-6" id="shipping_details" style="display: none;">
                        <h5 class="fw-bold mb-3">Shipping Details</h5>
                        @if (auth()->check() && auth()->user()->addresses->isNotEmpty())
                            <form action="{{ url()->current() }}" method="GET">
                                <select name="shipping_address_id" id="shipping_address_id" class="form-control mb-3"
                                    onchange="this.form.submit()">
                                    <option value="">Sélectionnez l'adresse de livraison</option>
                                    @foreach (auth()->user()->addresses as $address)
                                        <option value="{{ $address->id }}"
                                            {{ request()->get('shipping_address_id') == $address->id ? 'selected' : '' }}>
                                            {{ $address->addressType }} - {{ $address->street }} - {{ $address->city }} - {{ $address->state }} - {{ $address->codePostal }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        @else
                            <form action="" class="">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" name="name" class="form-control" placeholder="Name ..." required>
                                </div>
                                <div class="mb-3">
                                    <label for="street" class="form-label">Street</label>
                                    <input type="text" name="street" class="form-control" placeholder="Street ..." required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="codePostal" class="form-label">Code Postal</label>
                                        <input type="text" name="codePostal" class="form-control" placeholder="Code Postal ..." required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">City</label>
                                        <input type="text" name="city" class="form-control" placeholder="City ..." required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="state" class="form-label">State</label>
                                        <input type="text" name="state" class="form-control" placeholder="State ..." required>
                                    </div>
                                </div>
                                <button class="btn btn-success">Add Address</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Section de droite: récapitulatif et paiement -->
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h4 class="mb-0">Résumé de la commande</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold">Sous Total:
                            <span class="float-end text-success">
                                €{{ number_format(array_sum(array_column(session()->get('cart')['items'], 'sub_total')), 2, ',', ' ') }}
                            </span>
                        </h5>

                        <h5 class="fw-bold">Transporteur:
                            <span class="float-end">
                                {{ $carrier?->name ?? $selectedCarrier ? $selectedCarrier->name : 'Aucun transporteur sélectionné' }}
                            </span>
                        </h5>

                        <h5 class="fw-bold">Frais de livraison:
                            <span class="float-end text-success">
                                €{{ $selectedCarrier ? number_format($selectedCarrier->price, 2, ',', ' ') : '0,00' }}
                            </span>
                        </h5>

                        <hr>

                        <h4 class="fw-bold">Total à Payer:
                            <span class="float-end text-primary">
                                €{{ number_format(array_sum(array_column(session()->get('cart')['items'], 'sub_total')) + ($selectedCarrier ? $selectedCarrier->price : 0), 2, ',', ' ') }}
                            </span>
                        </h4>
                    </div>
                </div>

                <!-- Formulaire de paiement -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">Paiement sécurisé</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="cardNumber" class="form-label">Numéro de carte</label>
                                <input type="text" id="cardNumber" name="cardNumber" class="form-control"
                                    placeholder="1234 5678 9123 4567" required>
                            </div>

                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="cardExpiry" class="form-label">Expiration</label>
                                    <input type="text" id="cardExpiry" name="cardExpiry" class="form-control"
                                        placeholder="MM/YY" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="cardCVC" class="form-label">CVC</label>
                                    <input type="text" id="cardCVC" name="cardCVC" class="form-control"
                                        placeholder="123" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary btn-lg w-100">Confirmer et Payer</button>
                        </form>

                        <!-- Icônes de cartes bancaires -->
                        <div class="text-center mt-3">
                            <i class="fab fa-cc-visa fa-2x me-2"></i>
                            <i class="fab fa-cc-mastercard fa-2x me-2"></i>
                            <i class="fab fa-cc-amex fa-2x me-2"></i>
                            <i class="fab fa-cc-discover fa-2x me-2"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center my-5">
            <h4 class="text-muted">Votre panier est vide.</h4>
            <a href="{{ route('shop') }}" class="btn btn-outline-primary mt-3">Retourner à la boutique</a>
        </div>
    @endif
</div>

<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<!-- Font Awesome JS CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

@section('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const billingSelect = document.querySelector('select#billing_address_id');
            const shippingSelect = document.querySelector('select#shipping_address_id');
            const addShippingAddress = document.querySelector('input#add_shipping_address');
            const shippingDetails = document.querySelector('#shipping_details');

            // Show/Hide shipping details based on checkbox
            addShippingAddress.addEventListener('change', function() {
                if (this.checked) {
                    shippingDetails.style.display = 'block';
                } else {
                    shippingDetails.style.display = 'none';
                }
            });

            // Créer un tableau des selects existants
            const selects = [billingSelect, shippingSelect].filter(Boolean);

            selects.forEach(select => {
                select.addEventListener('change', function(event) {
                    this.form.submit(); // Soumettre le formulaire lors de la sélection d'une nouvelle adresse
                });
            });
        });
    </script>
@endsection
