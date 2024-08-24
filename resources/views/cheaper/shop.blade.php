@extends('base')

@section('title', 'Shop | Cheaper')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="row">
        <!-- Barre latérale -->
        <div class="col-md-3">
            <h5>Catégories</h5>
            <ul class="list-group">
                <li class="list-group-item">Femmes</li>
                <li class="list-group-item">Hommes</li>
                <li class="list-group-item">Chaussures</li>
                <li class="list-group-item">T-Shirts</li>
            </ul>

            <h5 class="mt-4">Filtre</h5>
            <h6>Prix</h6>
            <input type="range" class="form-range" id="priceRange" min="0" max="200">

            <h5 class="mt-4">Marque</h5>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="brand1">
                <label class="form-check-label" for="brand1">Nouveautés</label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="checkbox" id="brand2">
                <label class="form-check-label" for="brand2">Éclairage</label>
            </div>
        </div>

        <!-- Zone de contenu principal -->
        <div class="col-md-9">
            <div class="d-flex justify-content-between mb-4">
                <h3>Boutique</h3>

                <div>
                    <div class="d-flex justify-content-center">
                        {{ $products->links('pagination::bootstrap-5') }}
                    </div>

                    <!-- Boutons pour changer la vue -->
                    <button id="grid-view-btn" class="btn btn-outline-secondary">Grille</button>
                    <button id="list-view-btn" class="btn btn-outline-secondary">Liste</button>
                </div>

                <form action="" class="d-flex gap-1">
                    <select name="sort" id="sortByPrice" class="form-select w-auto" style="height: 38px;">
                        <option value="default">Trier par</option>
                        <option value="price_asc" {{ request()->get('sort') === 'price_asc' ? 'selected' : '' }}>
                            Prix : croissant
                        </option>
                        <option value="price_desc" {{ request()->get('sort') === 'price_desc' ? 'selected' : '' }}>
                            Prix : décroissant
                        </option>
                    </select>
                </form>
            </div>

            <!-- Formulaire pour la comparaison -->
            <form id="compare-form" action="{{ route('compare') }}" method="Get">
                @csrf
                <!-- Liste de produits avec checkbox pour la sélection -->
                <div id="products-container" class="row">
                    @foreach ($products as $product)
                        <div class="col-md-6 col-lg-4 mb-4 product-item">
                            <div class="card">
                                <img src="{{ asset('storage/' . trim($product->imageUrls, '["]')) }}"
                                     class="card-img-top" alt="{{ $product->name }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $product->name }}</h5>

                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="products[]"
                                               value="{{ $product->id }}" id="compare-{{ $product->id }}">
                                        <label class="form-check-label" for="compare-{{ $product->id }}">
                                            Ajouter pour comparer
                                        </label>
                                    </div>

                                    <p class="card-text">
                                        <span class="text-danger">€{{ number_format($product->soldePrice, 2, ',', ' ') }}</span>
                                        <del class="text-muted">€{{ number_format($product->regularPrice, 2, ',', ' ') }}</del>
                                        <small class="text-success">{{ 100 - round(($product->soldePrice / $product->regularPrice) * 100) }}% de réduction</small>
                                    </p>

                                    <div class="mb-2">
                                        <span class="badge bg-warning text-dark">★★★★☆ ({{ $product->reviews_count }})</span>
                                    </div>

                                    <div class="mb-3">
                                        <a href="{{ route('product', ['slug' => $product->slug]) }}"
                                           class="btn btn-primary">Voir le produit</a>
                                    </div>

                                    <!-- Formulaire d'ajout au panier (POST) -->
                                    <form action="{{ route('addToCart', ['productId' => $product->id]) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-success">Ajouter au panier</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Remplacer le bouton par un lien pour soumettre le formulaire -->
                <div class="d-flex justify-content-center mb-5">
                    <a href="javascript:void(0);" class="btn btn-primary mt-4" onclick="document.getElementById('compare-form').submit();">
                        Comparer les produits sélectionnés
                    </a>
                </div>
            </form>

            <div class="d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<!-- Bootstrap JS et Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

<!-- Script pour changer la vue -->
<script>
    document.getElementById('grid-view-btn').addEventListener('click', function() {
        document.getElementById('products-container').classList.remove('product-list-view');
        document.querySelectorAll('.product-item').forEach(function(item) {
            item.classList.add('col-md-6', 'col-lg-4');
        });
    });

    document.getElementById('list-view-btn').addEventListener('click', function() {
        document.getElementById('products-container').classList.add('product-list-view');
        document.querySelectorAll('.product-item').forEach(function(item) {
            item.classList.remove('col-md-6', 'col-lg-4');
            item.classList.add('col-12');
        });
    });

    const sortByPrice = document.querySelector('#sortByPrice');
    sortByPrice.onchange = (event) => {
        const { name, value } = event.target;
        const urlParams = new URLSearchParams(window.location.search);
        urlParams.set(name, value);
        const newLink = window.location.origin + window.location.pathname + '?' + urlParams.toString();
        window.location.href = newLink;
    };
</script>
@endsection
