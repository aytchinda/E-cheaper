@extends('base')

@section('title')
    {{ $product->name }} | Cheaper
@endsection

@section('content')

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
    .product-container {
        display: flex;
        flex-wrap: wrap;
        padding: 20px;
        gap: 20px;
    }

    /* Section des images produit */
    .product-images {
        flex: 1;
        max-width: 48%;
        display: flex;
        flex-direction: column;
        align-items: center;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
    }

    .main-image {
        width: 100%;
        height: 400px;
        margin-bottom: 15px;
        overflow: hidden;
        transition: all 0.3s ease-in-out;
        border-radius: 8px;
    }

    .main-image img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }

    .thumbnail-images {
        display: flex;
        justify-content: center;
        gap: 10px;
    }

    .thumbnail-images img {
        width: 80px;
        height: 80px;
        object-fit: cover;
        cursor: pointer;
        border: 2px solid transparent;
        transition: transform 0.3s ease, border-color 0.3s ease;
    }

    .thumbnail-images img:hover {
        border-color: #f39c12;
        transform: scale(1.1);
    }

    /* Section des détails produit */
    .product-details {
        flex: 1;
        max-width: 48%;
        padding: 20px;
        background-color: #f8f9fa;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .product-title {
        font-size: 2rem;
        font-weight: bold;
        margin-bottom: 15px;
        color: #333;
    }

    .product-price {
        font-size: 1.8rem;
        color: #e74c3c;
        margin-bottom: 20px;
    }

    .product-description,
    .product-more-description {
        font-size: 1rem;
        margin-bottom: 15px;
        color: #555;
    }

    .product-options label {
        display: inline-block;
        font-weight: bold;
        margin-right: 10px;
    }

    .product-options select,
    .product-options input[type="radio"] {
        margin-right: 10px;
    }

    .quantity-selector {
        display: flex;
        align-items: center;
        margin-bottom: 15px;
    }

    .quantity-selector input[type="number"] {
        width: 70px;
        text-align: center;
        padding: 8px;
        border-radius: 5px;
        border: 1px solid #ddd;
    }

    /* Actions produit */
    .product-actions {
        display: flex;
        gap: 10px;
        margin-bottom: 20px;
    }

    .product-actions button {
        background-color: #ff6347;
        color: white;
        border: none;
        padding: 12px 20px;
        font-size: 1rem;
        cursor: pointer;
        border-radius: 5px;
        transition: background-color 0.3s ease;
    }

    .product-actions button:hover {
        background-color: #e5533d;
    }

    .product-sku,
    .product-category,
    .product-tags {
        margin-bottom: 10px;
        font-size: 0.9rem;
        color: #777;
    }

    .product-sku span,
    .product-category span,
    .product-tags span {
        font-weight: bold;
        color: #333;
    }

    /* Icônes réseaux sociaux */
    .social-icons a {
        margin-right: 15px;
        color: #555;
        font-size: 1.4rem;
        transition: color 0.3s ease;
    }

    .social-icons a:hover {
        color: #ff6347;
    }

    /* Responsivité */
    @media (max-width: 768px) {
        .product-images, .product-details {
            max-width: 100%;
        }

        .main-image {
            height: 300px;
        }
    }
</style>

<div class="container">
    <div class="product-container">
        <!-- Images du produit -->
        <div class="product-images">
            <div class="main-image">
                <img src="{{ asset('storage/' . trim($product->imageUrls, '["]')) }}" alt="{{ $product->name }}">
            </div>
            <div class="thumbnail-images">
                @foreach (json_decode($product->imageUrls) as $imageUrl)
                    <img src="{{ asset('storage/' . $imageUrl) }}" alt="Thumbnail">
                @endforeach
            </div>
        </div>

        <!-- Détails du produit -->
        <div class="product-details">
            <h1 class="product-title">{{ $product->name }}</h1>
            <p class="product-price">€{{ number_format($product->soldePrice, 2, ',', ' ') }}</p>
            <p class="product-description">{{ $product->description }}</p>
            <p class="product-more-description">{{ $product->moreDescrciption }}</p>

            <!-- Sélection d'options -->
            <div class="product-options">
                <label for="size">Size:</label>
                <select id="size" name="size">
                    <option value="XS">XS</option>
                    <option value="S">S</option>
                    <option value="M">M</option>
                    <option value="L">L</option>
                    <option value="XL">XL</option>
                </select>

                <label for="color">Color:</label>
                <input type="radio" id="color1" name="color" value="red"> Red
                <input type="radio" id="color2" name="color" value="blue"> Blue
                <input type="radio" id="color3" name="color" value="green"> Green
            </div>

            <!-- Sélecteur de quantité -->
            <div class="quantity-selector">
                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" value="1">
            </div>

            <!-- Actions produit -->
            <div class="product-actions">
                <form action="{{ route('addToCart', ['productId' => $product->id]) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn btn-success">Add to Cart</button>
                    <button type="button">Pay Now</button>
                </form>
            </div>

            <!-- Informations supplémentaires -->
            <div class="product-sku">
                SKU: <span>{{ $product->sku }}</span>
            </div>
            <div class="product-category">
                Category: <span>{{ $product->category }}</span>
            </div>
            <div class="product-tags">
                Tags: <span>{{ $product->tags }}</span>
            </div>

            <!-- Icônes de réseaux sociaux -->
            {{-- <div class="social-icons">
                <a href="#"><i class="fa fa-facebook"></i></a>
                <a href="#"><i class="fa fa-twitter"></i></a>
                <a href="#"><i class="fa fa-instagram"></i></a>
                <a href="#"><i class="fa fa-pinterest"></i></a>
            </div> --}}
        </div>
    </div>
</div>

<!-- Bootstrap JS et Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

@endsection
