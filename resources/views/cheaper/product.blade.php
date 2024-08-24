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
        }

        .product-images {
            flex: 1;
            max-width: 50%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .main-image {
            width: 100%;
            height: 400px;
            margin-bottom: 15px;
            overflow: hidden;
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
        }

        .thumbnail-images img:hover {
            border-color: #f39c12;
        }

        .product-details {
            flex: 1;
            max-width: 50%;
            padding-left: 20px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .product-title {
            font-size: 1.8rem;
            font-weight: bold;
            margin-bottom: 15px;
        }

        .product-price {
            font-size: 1.5rem;
            color: red;
            margin-bottom: 15px;
        }

        .product-options {
            margin-bottom: 15px;
        }

        .product-options label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .product-options select,
        .product-options input {
            padding: 5px;
            margin-right: 10px;
            font-size: 1rem;
        }

        .quantity-selector {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
        }

        .quantity-selector input[type="number"] {
            width: 60px;
            text-align: center;
        }

        .product-actions {
            margin-bottom: 15px;
            display: flex;
            gap: 10px;
        }

        .product-actions button {
            background-color: #ff6347;
            color: white;
            border: none;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 1rem;
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
        }

        .product-sku span,
        .product-category span,
        .product-tags span {
            font-weight: bold;
        }

        .social-icons {
            margin-top: 10px;
        }

        .social-icons a {
            margin-right: 10px;
            color: #555;
            text-decoration: none;
            font-size: 1.2rem;
        }

        .social-icons a:hover {
            color: #ff6347;
        }
    </style>

    <div class="container">
        <div class="product-container">
            <!-- Section des images du produit -->
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

            <!-- Section des détails du produit -->
            <div class="product-details">
                <h1 class="product-title">{{ $product->name }}</h1>
                <p class="product-price">€{{ number_format($product->soldePrice, 2, ',', ' ') }}</p>

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

                <div class="product-actions">
                    <form action="{{ route('addToCart', ['productId' => $product->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success">Add to Cart</button>
                        <button type="button">Pay Now</button>

                    </form>
                </div>



                <div class="product-sku">
                    SKU: <span>{{ $product->sku }}</span>
                </div>
                <div class="product-category">
                    Category: <span>{{ $product->category }}</span>
                </div>
                <div class="product-tags">
                    Tags: <span>{{ $product->tags }}</span>
                </div>

                <div class="social-icons">
                    <a href="#"><i class="fa fa-facebook"></i></a>
                    <a href="#"><i class="fa fa-twitter"></i></a>
                    <a href="#"><i class="fa fa-instagram"></i></a>
                    <a href="#"><i class="fa fa-pinterest"></i></a>
                </div>
            </div>
        </div>
    </div>

     <!-- Bootstrap JS et Popper.js -->
     <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

@endsection
