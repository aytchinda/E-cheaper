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
                            <tr>
                                <td>
                                    @if (isset($item['product']['imageUrls']) && !empty($item['product']['imageUrls']))
                                        @php
                                            $imageUrl = is_array(json_decode($item['product']['imageUrls']))
                                                ? json_decode($item['product']['imageUrls'])[0]
                                                : $item['product']['imageUrls'];
                                        @endphp
                                        <img src="{{ asset('storage/' . trim($imageUrl, '["]')) }}"
                                            class="rounded shadow-sm" alt="{{ $item['product']['name'] }}"
                                            style="width: 70px; height: auto;">
                                    @else
                                    @endif
                                </td>
                                <td class="fw-semibold">{{ $item['product']['name'] }}</td>
                                <td class="text-success fw-bold">
                                    €{{ number_format($item['product']['price'], 2, ',', ' ') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center justify-content-center">
                                            <form action="{{ route('cart.decrement', ['productId' => $item['product']['id']]) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-secondary" {{ $item['quantity'] <= 1 ? 'disabled' : '' }}>-</button>
                                            </form>

                                            <span class="mx-2">{{ $item['quantity'] }}</span>

                                            <form action="{{ route('cart.increment', ['productId' => $item['product']['id']]) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                <button type="submit" class="btn btn-sm btn-outline-secondary">+</button>
                                            </form>
                                        </div>
                                    </td>

                                <td class="fw-semibold">
                                    €{{ number_format($item['product']['price'] * $item['quantity'], 2, ',', ' ') }}</td>
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

            <!-- Total du panier -->
            <div class="text-end my-4">
                <h4>Total du Panier:
                    <span class="text-success fw-bold">
                        €{{ number_format(array_sum(array_column(session()->get('cart')['items'], 'sub_total')), 2, ',', ' ') }}
                    </span>
                </h4>
                <a href="#" class="btn btn-primary btn-lg mt-3">Passer à la caisse</a>
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

@endsection
