<div id="newArrivals" class="product-category active">
    <div class="row g-1"> <!-- Using g-1 class to reduce the gutters -->
        @foreach ($newArrivals->chunk(4) as $chunk)
            @foreach ($chunk as $product)
                @php
                    $imageUrl = trim($product->imageUrls, '["]');
                @endphp
                <div class="col-md-3 col-6 p-1">
                    <div class="product-card">
                        <a href="{{ route('product', ['slug' => $product->slug]) }}">
                            <div class="product-image">
                                <img src="{{ asset('storage/' . $imageUrl) }}"
                                    alt="{{ __('messages.products.' . $product->id . '.name') }}">
                            </div>
                            <div class="product-details">
                                <h5 class="product-title">{{ __('messages.products.' . $product->id . '.name') }}</h5>
                                <p class="product-description">
                                    {{ __('messages.products.' . $product->id . '.description') }}</p>
                                <p class="product-more-description">
                                    {{ __('messages.products.' . $product->id . '.more_description') }}</p>

                                <div class="product-price">
                                    <span class="price">€{{ number_format($product->soldePrice, 2, ',', ' ') }}</span>
                                    <del>€{{ number_format($product->regularPrice, 2, ',', ' ') }}</del>
                                    <span
                                        class="on_sale">{{ 100 - round(($product->soldePrice / $product->regularPrice) * 100) }}%
                                        {{ __('messages.off') }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        @endforeach

    </div>
</div>


<div id="bestSellers" class="product-category">
    <div class="row g-1"> <!-- Using g-1 class to reduce the gutters -->
        @foreach ($bestSellers->chunk(4) as $chunk)
            @foreach ($chunk as $product)
                @php
                    $imageUrl = trim($product->imageUrls, '["]');
                @endphp
                <div class="col-md-3 col-6 p-1">
                    <div class="product-card">
                        <a href="{{ route('product', ['slug' => $product->slug]) }}">
                            <div class="product-image">
                                <img src="{{ asset('storage/' . $imageUrl) }}"
                                    alt="{{ __('messages.products.' . $product->id . '.name') }}">
                            </div>
                            <div class="product-details">
                                <h5 class="product-title">{{ __('messages.products.' . $product->id . '.name') }}</h5>
                                <p class="product-description">{{ __('messages.products.' . $product->id . '.description') }}</p>
                                <p class="product-more-description">{{ __('messages.products.' . $product->id . '.more_description') }}</p>

                                <div class="product-price">
                                    <span class="price">€{{ number_format($product->soldePrice, 2, ',', ' ') }}</span>
                                    <del>€{{ number_format($product->regularPrice, 2, ',', ' ') }}</del>
                                    <span class="on_sale">{{ 100 - round(($product->soldePrice / $product->regularPrice) * 100) }}%
                                        {{ __('messages.off') }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>



<div id="featured" class="product-category">
    <div class="row g-1"> <!-- Using g-1 class to reduce the gutters -->
        @foreach ($featured->chunk(4) as $chunk)
            @foreach ($chunk as $product)
                @php
                    $imageUrl = trim($product->imageUrls, '["]');
                @endphp
                <div class="col-md-3 col-6 p-1">
                    <div class="product-card">
                        <a href="{{ route('product', ['slug' => $product->slug]) }}">
                            <div class="product-image">
                                <img src="{{ asset('storage/' . $imageUrl) }}"
                                    alt="{{ __('messages.products.' . $product->id . '.name') }}">
                            </div>
                            <div class="product-details">
                                <h5 class="product-title">{{ __('messages.products.' . $product->id . '.name') }}</h5>
                                <p class="product-description">{{ __('messages.products.' . $product->id . '.description') }}</p>
                                <p class="product-more-description">{{ __('messages.products.' . $product->id . '.more_description') }}</p>

                                <div class="product-price">
                                    <span class="price">€{{ number_format($product->soldePrice, 2, ',', ' ') }}</span>
                                    <del>€{{ number_format($product->regularPrice, 2, ',', ' ') }}</del>
                                    <span class="on_sale">{{ 100 - round(($product->soldePrice / $product->regularPrice) * 100) }}%
                                        {{ __('messages.off') }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>



<div id="specialOffers" class="product-category">
    <div class="row g-1"> <!-- Using g-1 class to reduce the gutters -->
        @foreach ($specialOffers->chunk(4) as $chunk)
            @foreach ($chunk as $product)
                @php
                    $imageUrl = trim($product->imageUrls, '["]');
                @endphp
                <div class="col-md-3 col-6 p-1">
                    <div class="product-card">
                        <a href="{{ route('product', ['slug' => $product->slug]) }}">
                            <div class="product-image">
                                <img src="{{ asset('storage/' . $imageUrl) }}"
                                    alt="{{ __('messages.products.' . $product->id . '.name') }}">
                            </div>
                            <div class="product-details">
                                <h5 class="product-title">{{ __('messages.products.' . $product->id . '.name') }}</h5>
                                <p class="product-description">{{ __('messages.products.' . $product->id . '.description') }}</p>
                                <p class="product-more-description">{{ __('messages.products.' . $product->id . '.more_description') }}</p>

                                <div class="product-price">
                                    <span class="price">€{{ number_format($product->soldePrice, 2, ',', ' ') }}</span>
                                    <del>€{{ number_format($product->regularPrice, 2, ',', ' ') }}</del>
                                    <span class="on_sale">{{ __('messages.products.' . $product->id . '.discount') }}
                                        {{ __('messages.off') }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        @endforeach
    </div>
</div>




<style>
    .exclusive-products {
        text-align: center;
        margin-top: 20px;
    }

    .section-title {
        text-align: center;
        margin-top: 20px;
    }

    .exclusive-products-menu {
        list-style: none;
        padding: 0;
        display: flex;
        justify-content: center;
        gap: 20px;
    }

    .exclusive-products-menu li {
        display: inline;
    }

    .exclusive-products-menu a {
        text-decoration: none;
        color: black;
        font-size: 18px;
        transition: color 0.3s ease;
    }

    .exclusive-products-menu a:hover {
        color: #007bff;
        /* Color change on hover */
    }

    .exclusive-products-menu a.active {
        font-weight: bold;
        color: #007bff;
        /* Active link color */
    }

    .product-category {
        display: none;
    }

    .product-category.active {
        display: block;
    }

    .section-title h2 {
        font-weight: bold;
    }

    .product-card {
        text-align: left;
        /* border: 1px solid #ddd; */
        /* Light border for better separation */
        padding: 10px;
        display: flex;
        flex-direction: column;
        background-color: #ffffff;
        /* Background color for a clean look */
        border-radius: 8px;
        /* Rounded corners */
        transition: box-shadow 0.3s ease;
        height: 100%;
    }

    .product-card:hover {
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        /* Subtle shadow on hover */
    }

    .product-image {
        width: 100%;
        height: 380px;
        /* Slightly reduced height for the images */
        overflow: hidden;
        /* Hide any overflow */
        border-radius: 8px 8px 0 0;
        /* Rounded corners on the top of the card */
        background-color: #ffffff;
        /* Une couleur de fond pour un contraste propre */

    }

    .product-image img {
        width: 100%;
        height: 100%;
        /* object-fit: cover; */
        /* Cover image for a cleaner appearance */
        object-fit: contain;
        /* Pour s'assurer que l'image reste contenue sans être coupée */
        padding: 10px;
        /* Espace autour de l'image pour un look plus épuré */
    }

    .product-details {
        padding-top: 10px;
        margin-top: 0;
        line-height: 1.4;
        flex-grow: 1;
    }

    .product-title {
        font-size: 1.15rem;
        font-weight: bold;
        margin: 5px 0;
        color: #333;
        /* Darker text for better readability */
    }

    .product-description,
    .product-more-description,
    .product-additional-info {
        font-size: 0.85rem;
        margin: 5px 0;
        color: #666;
        /* Soft grey for descriptions */
    }

    .product-price {
        font-size: 1rem;
        margin: 10px 0 5px;
        display: flex;
        align-items: center;
        font-weight: bold;
    }

    .product-price .price {
        color: #e74c3c;
        /* Slightly darker red for a modern look */
        font-size: 1.15rem;
        margin-right: 10px;
    }

    .product-price del {
        color: #95a5a6;
        /* Softer grey for the old price */
        font-size: 0.9rem;
        margin-right: 10px;
    }

    .product-price .on_sale {
        color: #27ae60;
        /* A more vibrant green for the discount */
        font-size: 0.9rem;
    }

    .product-card a {
        text-decoration: none;
    }

    .product-card a:hover .product-title {
        color: #007bff;
        /* Title color changes on hover */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const links = document.querySelectorAll('.category-link');
        const categories = document.querySelectorAll('.product-category');

        links.forEach(link => {
            link.addEventListener('click', function(event) {
                event.preventDefault();

                // Remove active class from all links
                links.forEach(link => link.classList.remove('active'));

                // Add active class to the clicked link
                this.classList.add('active');

                // Get the category to display
                const category = this.getAttribute('data-category');

                // Hide all categories
                categories.forEach(category => category.classList.remove('active'));

                // Show the selected category
                document.getElementById(category).classList.add('active');
            });
        });
    });
</script>
