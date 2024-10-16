@extends('admin')

@section('title', 'Détails de la commande')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Détails de la commande #{{ $order->id }}</h1>

    <div class="mb-3">
        <p><strong>Client :</strong> {{ $order->clientName ?? $order->user->name }}</p>
        <p><strong>Total :</strong> €{{ number_format($order->order_cost, 2, ',', ' ') }}</p>
    </div>

    <h5 class="mb-3">Produits</h5>

    <div class="table-responsive">
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th scope="col">Image</th>
                    <th scope="col">Nom</th>
                    <th scope="col">Description</th>
                    <th scope="col">Quantité</th>
                    <th scope="col">Prix</th>
                    <th scope="col">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orderDetails as $detail)
                <tr>
                    <td>
                        @php
                            $imageUrl = $detail['imageUrls'] ? trim($detail['imageUrls'], '["]') : 'images/default-product.png';
                        @endphp
                        <img src="{{ asset('storage/' . $imageUrl) }}" class="rounded shadow-sm"
                             style="width: 70px; height: 70px; object-fit: cover;" alt="{{ $detail['name'] }}">
                    </td>
                    <td>{{ $detail['name'] }}</td>
                    <td>{{ __('messages.products.' . $detail['name'] . '.description') }}</td>
                    <td>{{ $detail['quantity'] }}</td>
                    <td>€{{ number_format($detail['price'], 2, ',', ' ') }}</td>
                    <td>€{{ number_format($detail['total'], 2, ',', ' ') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        <a href="{{ route('admin.product.index') }}" class="btn btn-primary">Retour à la liste des commandes</a>
    </div>
</div>
@endsection
