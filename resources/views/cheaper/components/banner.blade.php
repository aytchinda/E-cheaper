<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .carousel-item {
            max-height: 400px; /* Ajustez cette valeur selon vos besoins */
            background-size: contain; /* Use 'cover' to fill the area while maintaining aspect ratio */
            background-repeat: repeat;
            background-position: center;
        }
        .carousel-item .banner_slide_content {
            background: rgba(0, 0, 0, 0.3); /* Augmenter l'opacité pour plus de contraste */
            padding: 20px;
            border-radius: 5px;
            color: white; /* Assurez-vous que le texte est lisible sur un fond sombre */
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 1.8); /* Ajout d'une ombre pour améliorer la lisibilité */
        }
        .carousel-item h5 {
            font-size: 2em; /* Augmenter la taille de la police pour le titre */
            font-weight: bold; /* Rendre le texte plus gras pour améliorer la lisibilité */
        }
        .carousel-item p {
            font-size: 1.2em; /* Augmenter la taille de la police pour le texte */
        }
    </style>
</head>
<body>
    <div class="container-fluid">
        <div class="banner_section slide_medium shop_banner_slider staggered-animation-wrap">
            <div id="carouselExampleControls" class="carousel slide carousel light_arrow" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-inner">
                    @foreach($banners as $banner)
                        <div class="carousel-item {{ $loop->first ? 'active' : '' }}"
                             style="background-image: url('{{ Storage::url($banner->imageUrl) }}');">
                            <div class="banner_slide_content">
                                <h5>{{ $banner->title }}</h5>
                                <p class="fw-bold fst-italic">{{ $banner->description }}</p>
                                <a href="{{ route('shop') }}" class="btn btn-primary">{{ $banner->buttonText }}</a>
                            </div>
                        </div>
                    @endforeach
                </div>
                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
