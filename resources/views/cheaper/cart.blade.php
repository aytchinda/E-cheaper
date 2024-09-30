@extends('base')

@section('title')
    Cart | Cheaper
@endsection

@section('content')

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container my-5">
        <h2 class="text-center mb-5 fw-bold">Votre Panier</h2>

        @if (session('success'))
            <div class="alert alert-success text-center">
                {{ session('success') }}
            </div>
        @endif

        @if (session()->has('cart') && isset(session()->get('cart')['items']) && count(session()->get('cart')['items']) > 0)
            <div class="table-responsive">
                <table class="table align-middle text-center">
                    <thead class="table-light">
                        <tr>
                            <th scope="col">Produit</th>
                            <th scope="col">Nom du produit</th>
                            <th scope="col">Prix</th>
                            <th scope="col">Quantité</th>
                            <th scope="col">Total</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-group-divider">
                        @foreach (session()->get('cart')['items'] as $item)
                            <tr data-product-id="{{ $item['product']['id'] }}">
                                <td>
                                    @php
                                        $imageUrl = is_array(json_decode($item['product']['imageUrls']))
                                            ? json_decode($item['product']['imageUrls'])[0]
                                            : $item['product']['imageUrls'];
                                    @endphp
                                    <img src="{{ asset('storage/' . trim($imageUrl, '["]')) }}" class="rounded shadow-sm"
                                        alt="{{ $item['product']['name'] }}" style="width: 70px; height: auto;">
                                </td>
                                <td class="fw-semibold">{{ $item['product']['name'] }}</td>
                                <td class="product-price text-success fw-bold">
                                    €{{ number_format($item['product']['price'], 2, ',', ' ') }}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center justify-content-center">
                                        <button class="btn btn-sm btn-outline-secondary decrement-quantity">-</button>
                                        <span class="mx-2 product-quantity">{{ $item['quantity'] }}</span>
                                        <button class="btn btn-sm btn-outline-secondary increment-quantity">+</button>
                                    </div>
                                </td>
                                <td class="fw-semibold product-total">
                                    €{{ number_format($item['product']['price'] * $item['quantity'], 2, ',', ' ') }}
                                </td>
                                <td>
                                    <form
                                        action="{{ route('removeFromCart', ['productId' => $item['product']['id'], 'quantity' => $item['quantity']]) }}"
                                        method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="d-flex align-items-center my-4">
                <h4 class="mb-0 me-2">Carrier:</h4>
                <div>
                    <form action="{{ route('cart.index') }}" method="GET" class="d-flex align-items-center">
                        <select class="form-control form-select-sm w-auto" name="carrier_id" id="carrier_id"
                            onchange="this.form.submit()">
                            <option value="">Sélectionnez un transporteur</option>
                            @foreach ($carriers as $carrier)
                                <option value="{{ $carrier->id }}"
                                    {{ $selectedCarrier && $selectedCarrier->id == $carrier->id ? 'selected' : '' }}>
                                    {{ $carrier->name }} (€{{ number_format($carrier->price, 2, ',', ' ') }})
                                </option>
                            @endforeach
                        </select>
                    </form>

                </div>
            </div>

            <!-- Total du panier -->
            <div class="text-end my-4">
                <h4>Sous Total du Panier:
                    <span class="text-success fw-bold" id="cart-total">
                        €{{ number_format(array_sum(array_column(session()->get('cart')['items'], 'sub_total')), 2, ',', ' ') }}
                    </span>
                </h4>

                <h4>Shipping:
                    <span
                        id="carrier-name">{{ $selectedCarrier ? $selectedCarrier->name : 'Sélectionnez un transporteur' }}</span>
                    - <span
                        id="shipping-price">€{{ $selectedCarrier ? number_format($selectedCarrier->price, 2, ',', ' ') : '' }}</span>
                </h4>

                <h4>Total à Payer:
                    <span class="text-success fw-bold" id="total-price">
                        €{{ number_format(array_sum(array_column(session()->get('cart')['items'], 'sub_total')), 2, ',', ' ') }}
                    </span>
                </h4>

                <form action="{{ route('checkout') }}" method="GET">
                    <button type="submit" class="btn btn-primary">Passer à la caisse</button>
                </form>
            </div>
        @else
            <div class="text-center my-5">
                <h4 class="text-muted">Votre panier est vide.</h4>
                <a href="{{ route('shop') }}" class="btn btn-outline-primary mt-3">Continuer vos achats</a>
            </div>
        @endif
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <!-- Custom JavaScript for updating cart total -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cartTotalElement = document.getElementById('cart-total');
            const shippingPriceElement = document.getElementById('shipping-price');
            const carrierNameElement = document.getElementById('carrier-name');
            const totalPriceElement = document.getElementById('total-price');
            const carrierSelect = document.getElementById('carrier_id');

            // Fonction pour mettre à jour le total du panier
            function updateTotalPrice() {
                const cartTotal = parseFloat(cartTotalElement.textContent.replace('€', '').replace(',', '.'));
                const shippingPrice = parseFloat(shippingPriceElement.textContent.replace('€', '').replace(',',
                    '.')) || 0;
                const totalPrice = cartTotal + shippingPrice;

                totalPriceElement.textContent = '€' + totalPrice.toFixed(2).replace('.', ',');
            }

            // Gestion de l'incrémentation et décrémentation des quantités
            document.querySelectorAll('.increment-quantity').forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const productId = row.getAttribute('data-product-id');

                    // Effectuer une requête AJAX pour incrémenter la quantité
                    fetch(`/cart/increment/${productId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                // Recharger la page ou mettre à jour l'interface utilisateur
                                location.reload();
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });

            document.querySelectorAll('.decrement-quantity').forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('tr');
                    const productId = row.getAttribute('data-product-id');

                    // Effectuer une requête AJAX pour décrémenter la quantité
                    fetch(`/cart/decrement/${productId}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.status === 'success') {
                                // Recharger la page ou mettre à jour l'interface utilisateur
                                location.reload();
                            }
                        })
                        .catch(error => console.error('Error:', error));
                });
            });

            // Gestion du changement de transporteur
            carrierSelect.addEventListener('change', function() {
                const selectedOption = carrierSelect.options[carrierSelect.selectedIndex];

                // Extraire le nom du transporteur
                const carrierName = selectedOption.textContent.split(' (')[0].trim();

                // Extraire le prix du transporteur entre parenthèses
                const shippingCost = parseFloat(selectedOption.textContent.match(/\((.*?)\)/)[1].replace(
                    '€', '').replace(',', '.'));

                // Mettre à jour le nom du transporteur à côté de "Shipping"
                carrierNameElement.textContent = carrierName;

                // Mettre à jour le prix du transporteur
                shippingPriceElement.textContent = '€' + shippingCost.toFixed(2).replace('.', ',');

                // Mettre à jour le prix total
                updateTotalPrice();
            });

            // Initialiser le prix total au chargement de la page
            updateTotalPrice();
        });
    </script>


@endsection
