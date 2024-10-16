@extends('base')

@section('title')
    {{ __('messages.order_completed') }} | Cheaper
@endsection

@section('content')
<div class="confirmation-container text-center mt-5">
    <!-- Icône de succès -->
    <div class="success-icon mb-4">
        <i class="bi bi-check-circle-fill text-success" style="font-size: 3rem;"></i>
    </div>

    <!-- Message de confirmation -->
    <h2 class="text-success">{{ __('messages.order_success') }}</h2>
    <p class="text-muted">{{ __('messages.order_confirmation_message') }}</p>


    <!-- Affichage du numéro de commande -->
    <p class="text-muted">{{ __('messages.order_number') }}: <strong>{{ $order->id }}</strong></p>

    <!-- Total à Payer -->
    <h4 class="mt-4">{{ __('messages.total_to_pay') }}:
        <span class="text-success fw-bold" id="total-price">
            €{{ number_format(array_sum(array_column(session()->get('cart')['items'], 'sub_total')) + $order->carrier_price, 2, ',', ' ') }}
        </span>
    </h4>

    <!-- Détails de la commande -->
    <div class="card order-summary-card mt-4 shadow-sm">
        <div class="card-header bg-primary text-white">{{ __('messages.order_details') }}</div>
        <div class="card-body">
            @foreach ($order->orderDetails as $item)
                <div class="order-item d-flex justify-content-between mb-2">
                    <div class="details">
                        <strong>{{ $item->product_name }}</strong>
                        <small class="d-block text-muted">{{ $item->quantity }} x €{{ number_format($item->soldePrice, 2, ',', ' ') }}</small>
                    </div>
                    <div class="text-end">
                        {{-- <span>{{ __('messages.total') }}: </span><strong>€{{ number_format($item->sub_total_ttc, 2, ',', ' ') }}</strong> --}}
                    </div>
                </div>
            @endforeach

            <!-- Extraction de la taxe sans recalcul -->
            @php
                $totalWithTax = array_sum(array_column(session()->get('cart')['items'], 'sub_total'));
                $taxeRate = 21; // 21% déjà inclus
                $taxAmount = $totalWithTax - ($totalWithTax / (1 + $taxeRate / 100));
                $totalWithoutTax = $totalWithTax - $taxAmount;
            @endphp

            <!-- Détails des prix -->
            <hr>
            <div class="price-details d-flex justify-content-between">
                <span>{{ __('messages.subtotal') }} (HT) :</span>
                <span>€{{ number_format($totalWithoutTax, 2, ',', ' ') }}</span>
            </div>

            <div class="price-details d-flex justify-content-between">
                <span>{{ __('messages.tax', ['percentage' => $taxeRate]) }} :</span>
                <span>€{{ number_format($taxAmount, 2, ',', ' ') }}</span>
            </div>

            <div class="price-details d-flex justify-content-between">
                <span>{{ __('messages.shipping_fee') }} :</span>
                <span>€{{ number_format($order->carrier_price, 2, ',', ' ') }}</span>
            </div>

            <!-- Total de la commande -->
            <div class="order-total price-details d-flex justify-content-between mt-3 pt-2 border-top">
                <span class="fw-bold">{{ __('messages.total_order') }}  :</span>
                <span class="fw-bold text-success">€{{ number_format($totalWithTax + $order->carrier_price, 2, ',', ' ') }}</span>
            </div>
        </div>
    </div>

    <!-- Bouton retour à la boutique -->
    <div class="mt-4">
        <a href="/shop" class="btn btn-primary">{{ __('messages.back_to_shop') }}</a>
    </div>
</div>

<!-- CSS ajouté pour plus de style -->
<style>
    .confirmation-container {
        max-width: 600px;
        margin: 0 auto;
    }
    .order-summary-card {
        border-radius: 10px;
        padding: 1.5rem;
    }
    .success-icon i {
        color: #28a745;
    }
</style>
@endsection
