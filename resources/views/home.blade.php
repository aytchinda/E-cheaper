@extends('base')

@section('content')
@include('cheaper/components/banner')

<div class="container-fluid">
    @include('cheaper/components/collection')

    <div class="section-title">
        <h2><strong>{{ __('messages.exclusive_products') }}</strong></h2>
    </div>
    <div class="exclusive-products">
        <ul class="exclusive-products-menu">
            <li><a href="#" class="category-link active" data-category="newArrivals">{{ __('messages.new_arrival') }}</a></li>
            <li><a href="#" class="category-link" data-category="bestSellers">{{ __('messages.best_sellers') }}</a></li>
            <li><a href="#" class="category-link" data-category="featured">{{ __('messages.featured') }}</a></li>
            <li><a href="#" class="category-link" data-category="specialOffers">{{ __('messages.special_offer') }}</a></li>
        </ul>
    </div>

    @include('cheaper/components/product_type')
</div>

@endsection
