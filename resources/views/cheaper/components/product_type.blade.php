   <!-- Sections for product categories -->
   <div id="newArrivals" class="product-category ">
    @foreach ($newArrivals->chunk(4) as $chunk)
        @foreach ($chunk as $product)
            @php
                $imageUrl = trim($product->imageUrls, '["]');
            @endphp
            <div class="col-md-3 col-6 mb-4">
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('storage/' . $imageUrl) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product-details">
                        <h5 class="product-title">{{ $product->name }}</h5>
                        <p class="product-description">{{ $product->description }}</p>
                        <div class="product-price">
                            <span class="price">€{{ number_format($product->soldePrice, 2, ',', ' ') }}</span>
                            <del>€{{ number_format($product->regularPrice, 2, ',', ' ') }}</del>
                            <span class="on_sale">{{ 100 - round(($product->soldePrice / $product->regularPrice) * 100) }}% Off</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>

<div id="bestSellers" class="product-category">
    @foreach ($bestSellers->chunk(4) as $chunk)
        @foreach ($chunk as $product)
            @php
                $imageUrl = trim($product->imageUrls, '["]');
            @endphp
            <div class="col-md-3 col-6 mb-4">
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('storage/' . $imageUrl) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product-details">
                        <h5 class="product-title">{{ $product->name }}</h5>
                        <p class="product-description">{{ $product->description }}</p>
                        <div class="product-price">
                            <span class="price">€{{ number_format($product->soldePrice, 2, ',', ' ') }}</span>
                            <del>€{{ number_format($product->regularPrice, 2, ',', ' ') }}</del>
                            <span class="on_sale">{{ 100 - round(($product->soldePrice / $product->regularPrice) * 100) }}% Off</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>

<div id="featured" class="product-category">
    @foreach ($featured->chunk(4) as $chunk)
        @foreach ($chunk as $product)
            @php
                $imageUrl = trim($product->imageUrls, '["]');
            @endphp
            <div class="col-md-3 col-6 mb-4">
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('storage/' . $imageUrl) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product-details">
                        <h5 class="product-title">{{ $product->name }}</h5>
                        <p class="product-description">{{ $product->description }}</p>
                        <div class="product-price">
                            <span class="price">€{{ number_format($product->soldePrice, 2, ',', ' ') }}</span>
                            <del>€{{ number_format($product->regularPrice, 2, ',', ' ') }}</del>
                            <span class="on_sale">{{ 100 - round(($product->soldePrice / $product->regularPrice) * 100) }}% Off</span>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endforeach
</div>

<div id="specialOffers" class="product-category">
    @foreach ($specialOffers->chunk(4) as $chunk)
        @foreach ($chunk as $product)
            @php
                $imageUrl = trim($product->imageUrls, '["]');
            @endphp
            <div class="col-md-3 col-6 mb-4">
                <div class="product-card">
                    <div class="product-image">
                        <img src="{{ asset('storage/' . $imageUrl) }}" alt="{{ $product->name }}">
                    </div>
                    <div class="product-details">
                        <h5 class="product-title">{{ $product->name }}</h5>
                        <p class="product-description">{{ $product->description }}</p>
                        <div class="product-price">
                            <span class="price">€{{ number_format($product->soldePrice, 2, ',', ' ') }}</span>
                            <del>€{{ number_format($product->regularPrice, 2, ',', ' ') }}</del>
                            <span class="on_sale">{{ 100 - round(($product->soldePrice / $product->regularPrice) * 100) }}% Off</span>
                        </div>
                    </div>
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
}

.exclusive-products-menu a.active {
    font-weight: bold;
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
    border: none;
    padding: 0;
}

.product-image img {
    width: 100%;
    height: auto;
    max-height: 470px;
    object-fit: contain;
}

.product-details {
    padding-top: 10px;
    margin-top: 0;
    margin-left: 2%;
    line-height: 1.2;
}

.product-title {
    font-size: 1.25rem;
    font-weight: bold;
    margin: 0;
    margin-bottom: 2px;
}

.product-description {
    font-size: 0.8rem;
    margin: 0;
    margin-bottom: 2px;
}

.product-price {
    font-size: 1rem;
    margin: 0;
    display: flex;
    align-items: center;
}

.product-price .price {
    color: red;
    font-size: 1rem;
    margin-right: 5px;
}

.product-price del {
    color: grey;
    font-size: 0.9rem;
    margin-right: 5px;
}

.product-price .on_sale {
    color: green;
    font-size: 0.9rem;
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
