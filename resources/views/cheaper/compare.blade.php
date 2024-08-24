@extends('base')

@section('title', 'Comparaison des Produits')

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<div class="container mt-5">
    <h3 class="mb-4">Comparaison des Produits</h3>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(!empty($comparedProducts) && count($comparedProducts) > 0)

        @php
        // Fonction pour générer des étoiles (note)
        function generateStars($rating)
        {
            $stars = '';
            for ($i = 0; $i < 5; $i++) {
                if ($i < $rating) {
                    $stars .= '★';
                } else {
                    $stars .= '☆';
                }
            }
            return $stars;
        }

        // Fonction pour générer un avis aléatoire
        function generateRandomReview()
        {
            $reviews = [
                "Excellent produit, je recommande !",
                "Pas mal, mais pourrait être amélioré.",
                "Très bon rapport qualité-prix.",
                "Je suis satisfait de cet achat.",
                "C'est exactement ce que je cherchais !",
                "Le produit ne correspond pas à mes attentes.",
                "Très bon produit, je l'utilise tous les jours.",
                "Livraison rapide et produit conforme.",
                "Bonne qualité, mais un peu cher.",
                "Produit de mauvaise qualité, je ne recommande pas."
            ];

            return $reviews[array_rand($reviews)];
        }

        // Fonction pour générer une description aléatoire
        function generateRandomDescription()
        {
            $descriptions = [
                "Ce produit est fabriqué à partir des matériaux les plus fins pour garantir une durabilité optimale.",
                "Profitez du meilleur confort avec ce produit, conçu pour répondre à vos besoins quotidiens.",
                "Une conception élégante et moderne pour un usage pratique et esthétique.",
                "Ce produit allie qualité et design pour un résultat exceptionnel.",
                "Parfait pour une utilisation quotidienne, avec des fonctionnalités avancées.",
                "Un produit polyvalent qui s'adapte à toutes les situations.",
                "Un style unique et une performance de premier plan pour les utilisateurs exigeants.",
                "Conçu avec des matériaux respectueux de l'environnement, ce produit est un choix durable.",
                "Une innovation qui améliore votre quotidien de manière significative.",
                "Qualité et praticité combinées pour un produit de confiance."
            ];

            return $descriptions[array_rand($descriptions)];
        }
        @endphp

        <div class="table-responsive">
            <table class="table table-bordered table-striped text-center align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>Caractéristiques</th>
                        @foreach($comparedProducts as $product)
                            <th>{{ $product['name'] }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <!-- Image des produits -->
                    <tr>
                        <th>Image</th>
                        @foreach($comparedProducts as $product)
                            <td>
                                <img src="{{ asset('storage/' . trim($product['imageUrls'], '["]')) }}" class="img-fluid" style="max-width: 150px;" alt="{{ $product['name'] }}">
                            </td>
                        @endforeach
                    </tr>

                    <!-- Prix régulier -->
                    <tr>
                        <th>Prix régulier</th>
                        @foreach($comparedProducts as $product)
                            <td>
                                <del class="text-muted">€{{ number_format($product['regularPrice'], 2, ',', ' ') }}</del>
                            </td>
                        @endforeach
                    </tr>

                    <!-- Prix soldé -->
                    <tr>
                        <th>Prix soldé</th>
                        @foreach($comparedProducts as $product)
                            <td class="text-danger">€{{ number_format($product['soldePrice'], 2, ',', ' ') }}</td>
                        @endforeach
                    </tr>

                    <!-- Pourcentage de réduction -->
                    <tr>
                        <th>Pourcentage de réduction</th>
                        @foreach($comparedProducts as $product)
                            <td class="text-success">{{ 100 - round(($product['soldePrice'] / $product['regularPrice']) * 100) }}%</td>
                        @endforeach
                    </tr>

                    <!-- Note (avis) -->
                    <tr>
                        <th>Note moyenne</th>
                        @foreach($comparedProducts as $product)
                            <td>
                                <span class="badge bg-warning text-dark">{{ generateStars($product['rating']) }}</span>
                                ({{ $product['reviews_count'] ?? 0 }} avis)
                            </td>
                        @endforeach
                    </tr>

                    <!-- Avis clients -->
                    <tr>
                        <th>Avis clients</th>
                        @foreach($comparedProducts as $product)
                            <td>
                                <p>{{ generateRandomReview() }}</p>
                            </td>
                        @endforeach
                    </tr>

                    <!-- Description du produit -->
                    <tr>
                        <th>Description</th>
                        @foreach($comparedProducts as $product)
                            <td>
                                <p>{{ generateRandomDescription() }}</p>
                            </td>
                        @endforeach
                    </tr>

                    <!-- Lien vers le produit -->
                    <tr>
                        <th>Voir le produit</th>
                        @foreach($comparedProducts as $product)
                            <td>
                                <a href="{{ route('product', ['slug' => $product['slug']]) }}" class="btn btn-primary">Voir le produit</a>
                            </td>
                        @endforeach
                    </tr>

                    <!-- Ajouter au panier -->
                    <tr>
                        <th>Ajouter au panier</th>
                        @foreach($comparedProducts as $product)
                            <td>
                                <form action="{{ route('addToCart', ['productId' => $product['id']]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">Ajouter au panier</button>
                                </form>
                            </td>
                        @endforeach
                    </tr>
                </tbody>
            </table>
        </div>
    @else
        <p>Aucun produit sélectionné pour la comparaison.</p>
    @endif
</div>

<!-- Bootstrap JS CDN -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

@endsection
