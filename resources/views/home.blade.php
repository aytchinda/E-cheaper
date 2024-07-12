@extends('base')

@section('content')
    @include('cheaper/components/banner')

    <div class="container-fluid">
        @include('cheaper/components/collection')

        <div class="section-title">
            <h2><strong>Exclusive Products</strong></h2>
        </div>
        <div class="exclusive-products">
            <ul class="exclusive-products-menu">
                <li><a href="#" class="category-link active" data-category="newArrivals">New Arrival</a></li>
                <li><a href="#" class="category-link" data-category="bestSellers">Best Sellers</a></li>
                <li><a href="#" class="category-link" data-category="featured">Featured</a></li>
                <li><a href="#" class="category-link" data-category="specialOffers">Special Offer</a></li>
            </ul>
        </div>

        @include('cheaper/components/product_type')



@endsection
