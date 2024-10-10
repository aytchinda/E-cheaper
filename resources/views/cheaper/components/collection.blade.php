<div class="container d-flex flex-wrap justify-content-between mb-2 mt-1" style="max-width: 70%; padding: 0;">
    <div class="row w-100" style="margin: 0;">
        @foreach ($collections as $collection)
            <div class="col-md-6 mb-2">
                <div class="card h-100">
                    <div class="card-body">
                        <img src="{{ asset('storage/' . $collection->imageUrl) }}" class="card-img-top"
                            alt="{{ __('messages.shop_collection.title_' . $collection->id) }}">
                        <h5 class="card-title" style="line-height: 1.0; font-size: 1.1rem; margin-bottom: 5px; color: #fff;">
                            {{ __('messages.shop_collection.title_' . $collection->id) }}</h5>
                        <p class="card-text" style="font-size: 18px; font-weight: bold; line-height: 1.0; margin-bottom: 5px; color: #fff;">
                            {{ __('messages.shop_collection.description_' . $collection->id) }}</p>
                        <a class="single_btn_link" href="{{ $collection->buttonLink }}"
                            style="background-color: #4CAF50; color: white; padding: 5px 10px; text-align: center; text-decoration: none; display: inline-block; font-size: 14px; border-radius: 5px; margin-top: 5px;">
                            {{ __('messages.shop_collection.buttonText_' . $collection->id) }}</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>


<style>
    .container {
        max-width: 70%;
        padding: 0;
        margin: auto;
    }

    .row {
        margin: 0;
        width: 100%;
    }

    .card {
        background-color: #000; /* Couleur de fond noire pour la carte */
        border: none; /* Enlever les bordures de la carte */
    }

    .card-title {
        line-height: 1.0; /* Réduire l'interligne */
        font-size: 1.1rem; /* Réduire la taille de la police du titre */
        margin-bottom: 5px; /* Réduire l'espace sous le titre */
        color: #fff; /* Couleur du texte en blanc */
    }

    .card-text {
        line-height: 1.0; /* Réduire l'interligne */
        margin-bottom: 5px; /* Réduire l'espace sous la description */
        color: #fff; /* Couleur du texte en blanc */
    }

    .card-body {
        padding: 10px; /* Réduit la hauteur du contenu de la carte */
        background-color: #333; /* Couleur de fond du contenu de la carte pour un contraste */
    }

    .mb-2 {
        margin-bottom: 0.5rem !important;
    }

    .mt-1 {
        margin-top: 0.25rem !important;
    }

    .single_btn_link {
        background-color: #4CAF50;
        color: white;
        padding: 5px 10px; /* Réduit la taille du bouton */
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 14px; /* Réduit la taille de la police du bouton */
        border-radius: 5px;
        margin-top: 5px; /* Ajoute un petit espace au-dessus du bouton */
    }
</style>
