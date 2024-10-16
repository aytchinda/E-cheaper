@extends('simple')

@section('title')
    {{ __('messages.checkout') }} | Cheaper
@endsection

<!-- Bootstrap CSS CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- Font Awesome CDN for card icons -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

@php
    $readyToPay =
        request()->has('billing_address_id') &&
        (request()->has('shipping_address_id') || !request()->has('add_shipping_address')) &&
        $selectedCarrier;
@endphp

<div class="container my-5">
    <h2 class="text-center mb-5 fw-bold">{{ __('messages.order_validation') }}</h2>

    @if (session()->has('cart') && isset(session()->get('cart')['items']) && count(session()->get('cart')['items']) > 0)
        <!-- Détails de la commande -->
        <div class="row g-4">
            <!-- Section de gauche: produits -->
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h4 class="mb-0">{{ __('messages.your_products') }}</h4>
                    </div>
                    <div class="table-responsive">
                        <table class="table align-middle text-center">
                            <thead class="table-light">
                                <tr>
                                    <th scope="col">{{ __('messages.product') }}</th>
                                    <th scope="col">{{ __('messages.product_name') }}</th>
                                    <th scope="col">{{ __('messages.price') }}</th>
                                    <th scope="col">{{ __('messages.quantity') }}</th>
                                    <th scope="col">{{ __('messages.total') }}</th>
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
                                                class="rounded shadow-sm" alt="{{ __('messages.products.' . $item['product']['id'] . '.name') }}"
                                                style="width: 70px; height: auto;">
                                        </td>
                                        <td class="fw-semibold">{{ __('messages.products.' . $item['product']['id'] . '.name') }}</td>
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
                        <h5 class="fw-bold mb-3">{{ __('messages.billing_details') }}</h5>
                        @if (auth()->check() && auth()->user()->addresses->isNotEmpty())
                            <form action="{{ url()->current() }}" method="GET">
                                <!-- Conserve l'adresse de livraison lors de la soumission -->
                                <input type="hidden" name="shipping_address_id"
                                    value="{{ request()->get('shipping_address_id') }}">
                                <input type="hidden" name="add_shipping_address"
                                    value="{{ request()->get('add_shipping_address') }}">
                                <select name="billing_address_id" id="billing_address_id" class="form-control mb-3"
                                    onchange="this.form.submit()">
                                    <option value="">{{ __('messages.select_billing_address') }}</option>
                                    @foreach (auth()->user()->addresses as $address)
                                        <option value="{{ $address->id }}"
                                            {{ request()->get('billing_address_id') == $address->id ? 'selected' : '' }}>
                                            {{ $address->addressType }} - {{ $address->street }} - {{ $address->city }} -
                                            {{ $address->state }} - {{ $address->codePostal }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        @else
                            <!-- Formulaire de nouvelle adresse -->
                            <form action="">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('messages.name') }}</label>
                                    <input type="text" name="name" class="form-control" placeholder="{{ __('messages.name_placeholder') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="street" class="form-label">{{ __('messages.street') }}</label>
                                    <input type="text" name="street" class="form-control" placeholder="{{ __('messages.street_placeholder') }}" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="codePostal" class="form-label">{{ __('messages.postal_code') }}</label>
                                        <input type="text" name="codePostal" class="form-control" placeholder="{{ __('messages.postal_code_placeholder') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">{{ __('messages.city') }}</label>
                                        <input type="text" name="city" class="form-control" placeholder="{{ __('messages.city_placeholder') }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="state" class="form-label">{{ __('messages.state') }}</label>
                                        <input type="text" name="state" class="form-control" placeholder="{{ __('messages.state_placeholder') }}" required>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>

                    <!-- Case à cocher pour adresse différente -->
                    <div class="mb-1 col-md-4">
                        <form action="{{ url()->current() }}" method="GET">
                            <!-- Conserve l'adresse de facturation lors de la soumission -->
                            <input type="hidden" name="billing_address_id" value="{{ request()->get('billing_address_id') }}">
                            <input type="checkbox" name="add_shipping_address" id="add_shipping_address"
                                @if (request()->has('add_shipping_address') || request()->has('shipping_address_id')) checked @endif onchange="this.form.submit()">
                            <label for="add_shipping_address">{{ __('messages.different_shipping_address') }}</label>
                        </form>
                    </div>

                    <!-- Shipping Details -->
                    <div class="col-md-6" id="shipping_details"
                        @if (!(request()->has('add_shipping_address') || request()->has('shipping_address_id'))) style="display: none;" @endif>
                        <h5 class="fw-bold mb-3">{{ __('messages.shipping_details') }}</h5>
                        @if (auth()->check() && auth()->user()->addresses->isNotEmpty())
                            <form action="{{ url()->current() }}" method="GET">
                                <!-- Conserve l'adresse de facturation lors de la soumission -->
                                <input type="hidden" name="billing_address_id" value="{{ request()->get('billing_address_id') }}">
                                <select name="shipping_address_id" id="shipping_address_id" class="form-control mb-3" onchange="this.form.submit()">
                                    <option value="">{{ __('messages.select_shipping_address') }}</option>
                                    @foreach (auth()->user()->addresses as $address)
                                        <option value="{{ $address->id }}"
                                            {{ request()->get('shipping_address_id') == $address->id ? 'selected' : '' }}>
                                            {{ $address->addressType }} - {{ $address->street }} - {{ $address->city }} - {{ $address->state }} - {{ $address->codePostal }}
                                        </option>
                                    @endforeach
                                </select>
                            </form>
                        @else
                            <!-- Formulaire de nouvelle adresse -->
                            <form action="">
                                @csrf
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('messages.name') }}</label>
                                    <input type="text" name="name" class="form-control" placeholder="{{ __('messages.name_placeholder') }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="street" class="form-label">{{ __('messages.street') }}</label>
                                    <input type="text" name="street" class="form-control" placeholder="{{ __('messages.street_placeholder') }}" required>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="codePostal" class="form-label">{{ __('messages.postal_code') }}</label>
                                        <input type="text" name="codePostal" class="form-control" placeholder="{{ __('messages.postal_code_placeholder') }}" required>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="city" class="form-label">{{ __('messages.city') }}</label>
                                        <input type="text" name="city" class="form-control" placeholder="{{ __('messages.city_placeholder') }}" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="state" class="form-label">{{ __('messages.state') }}</label>
                                        <input type="text" name="state" class="form-control" placeholder="{{ __('messages.state_placeholder') }}" required>
                                    </div>
                                </div>
                            </form>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Section de droite: récapitulatif et paiement -->
            <div class="col-md-4">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-secondary text-white">
                        <h4 class="mb-0">{{ __('messages.order_summary') }}</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="fw-bold">{{ __('messages.subtotal') }}:
                            <span class="float-end text-success">
                                €{{ number_format(array_sum(array_column(session()->get('cart')['items'], 'sub_total')), 2, ',', ' ') }}
                            </span>
                        </h5>

                        <h5 class="fw-bold">{{ __('messages.shipping_carrier') }}:
                            <span class="float-end">
                                {{ $carrier?->name ?? $selectedCarrier ? $selectedCarrier->name : __('messages.no_carrier_selected') }}
                            </span>
                        </h5>

                        <h5 class="fw-bold">{{ __('messages.shipping_fee') }}:
                            <span class="float-end text-success">
                                €{{ $selectedCarrier ? number_format($selectedCarrier->price, 2, ',', ' ') : '0,00' }}
                            </span>
                        </h5>

                        <hr>

                        <h4 class="fw-bold">{{ __('messages.total_to_pay') }}:
                            <span class="float-end text-primary">
                                €{{ number_format(array_sum(array_column(session()->get('cart')['items'], 'sub_total')) + ($selectedCarrier ? $selectedCarrier->price : 0), 2, ',', ' ') }}
                            </span>
                        </h4>
                    </div>
                </div>

                <!-- Formulaire de paiement -->
                <div class="card shadow-sm">
                    <div class="card-header bg-light">
                        <h4 class="mb-0">{{ __('messages.secure_payment') }}</h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="POST">
                            @csrf
                            @if ($readyToPay)
                                <button type="submit" class="btn btn-primary btn-lg w-100" id="paymentBtnAction">{{ __('messages.confirm_and_pay') }}</button>
                            @endif
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
            <h4 class="text-muted">{{ __('messages.empty_cart') }}</h4>
            <a href="{{ route('shop') }}" class="btn btn-outline-primary mt-3">{{ __('messages.return_to_shop') }}</a>
        </div>
    @endif
</div>
<!-- Modal -->
<div class="modal fade" id="paymentModal" tabindex="-1" aria-labelledby="paymentModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0 shadow-lg">
            <div class="modal-header bg-primary text-white border-0">
                <h5 class="modal-title" id="paymentModalLabel">{{ __('messages.secure_payment') }}</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="payment-form" class="needs-validation" novalidate>
                    <div id="payment-element" class="my-3">
                        <!-- Stripe.js injects the Payment Element -->
                    </div>
                    <!-- Bouton de paiement avec le montant total -->
                    <button id="submit" class="btn btn-lg w-100 d-flex align-items-center justify-content-center"
                        style="background-color: #17a2b8; color: white; border: none; transition: background-color 0.3s;"
                        onmouseover="this.style.backgroundColor='#138496';"
                        onmouseout="this.style.backgroundColor='#17a2b8';">
                        <span id="button-text" class="me-2">
                            {{ __('messages.pay_now') }}
                            (€{{ number_format(array_sum(array_column(session()->get('cart')['items'], 'sub_total')) + ($selectedCarrier ? $selectedCarrier->price : 0), 2, ',', ' ') }})
                        </span>
                        <div class="spinner-border text-light spinner-border-sm d-none" id="spinner" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>
                    <div id="payment-message" class="text-danger mt-3 d-none"></div>
                </form>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('messages.close') }}</button>
            </div>
        </div>
    </div>
</div>


<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<!-- Font Awesome JS CDN -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>

@section('scripts')
    <script src="https://js.stripe.com/v3/"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const billingSelect = document.querySelector('select#billing_address_id');
            const shippingSelect = document.querySelector('select#shipping_address_id');
            const addShippingAddress = document.querySelector('input#add_shipping_address');
            const shippingDetails = document.querySelector('#shipping_details');

            // Show/Hide shipping details based on checkbox or if shipping address has been selected
            if (addShippingAddress.checked || shippingSelect.value !== "") {
                shippingDetails.style.display = 'block';
            }

            addShippingAddress.addEventListener('change', function() {
                if (this.checked) {
                    shippingDetails.style.display = 'block';
                } else {
                    shippingDetails.style.display = 'none';
                }
            });

            const selects = [billingSelect, shippingSelect].filter(Boolean);

            selects.forEach(select => {
                select.addEventListener('change', function(event) {
                    this.form
                        .submit(); // Soumettre le formulaire lors de la sélection d'une nouvelle adresse
                });
            });
        });
    </script>

    <script>
        const paymentBtnAction = document.getElementById('paymentBtnAction');
        if (paymentBtnAction) {
            paymentBtnAction.onclick = (event) => {
                event.preventDefault();
                const paymentModal = document.getElementById('paymentModal');
                const modal = new bootstrap.Modal(paymentModal);
                modal.show();
            }
        }

        const stripe = Stripe('{{ $stripe_public_key }}');

        let elements;

        initialize();

        document.querySelector("#payment-form").addEventListener("submit", handleSubmit);

        async function initialize() {
            const urlPath = window.location.origin + '/checkout/create-payment-intent/{{ $orderID }}';

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            const { clientSecret, dpmCheckerLink } = await fetch(urlPath, {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken,
                },
                body: JSON.stringify({}),
            }).then((r) => r.json());

            elements = stripe.elements({ clientSecret });

            const paymentElementOptions = {
                layout: "tabs",
            };

            const paymentElement = elements.create("payment", paymentElementOptions);
            paymentElement.mount("#payment-element");

            // [DEV] For demo purposes only
            setDpmCheckerLink(dpmCheckerLink);
        }

        async function handleSubmit(e) {
            e.preventDefault();
            setLoading(true);

            const redirectUrl = window.location.origin + '/checkout/payment/success';

            const { error } = await stripe.confirmPayment({
                elements,
                confirmParams: {
                    return_url: redirectUrl,
                },
            });

            if (error.type === "card_error" || error.type === "validation_error") {
                showMessage(error.message);
            } else {
                showMessage("An unexpected error occurred.");
            }

            setLoading(false);
        }

        function showMessage(messageText) {
            const messageContainer = document.querySelector("#payment-message");

            messageContainer.classList.remove("hidden");
            messageContainer.textContent = messageText;

            setTimeout(function() {
                messageContainer.classList.add("hidden");
                messageContainer.textContent = "";
            }, 4000);
        }

        function setLoading(isLoading) {
            if (isLoading) {
                document.querySelector("#submit").disabled = true;
                document.querySelector("#spinner").classList.remove("hidden");
                document.querySelector("#button-text").classList.add("hidden");
            } else {
                document.querySelector("#submit").disabled = false;
                document.querySelector("#spinner").classList.add("hidden");
                document.querySelector("#button-text").classList.remove("hidden");
            }
        }

        function setDpmCheckerLink(url) {
            document.querySelector("#dpm-integration-checker").href = url;
        }
    </script>
@endsection
