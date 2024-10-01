@extends('base')

@section('title')
    Order Completed | Cheaper
@endsection

@section('content')

    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <div class="container my-5">
        <div class="text-center">
            <h2 class="fw-bold text-success">Merci pour votre commande !</h2>
            <p class="lead mt-3">Votre commande a été passée avec succès et est en cours de traitement.</p>

            <!-- Numéro de commande -->
            {{-- <h4 class="my-4">Numéro de commande : <span class="text-primary fw-bold">#{{ $orderID }}</span></h4> --}}

            <!-- Détails de la commande -->
            <div class="card mt-4">
                <div class="card-header fw-bold">Détails de la commande</div>
                <div class="card-body">
                    <ul class="list-group list-group-flush">

                    </ul>
                </div>
            </div>

            <!-- Adresse de livraison -->
            <div class="card mt-4">
                <div class="card-header fw-bold">Adresse de livraison</div>
                <div class="card-body">
                </div>
            </div>

            <!-- Actions supplémentaires -->
            <div class="mt-5">
                <a href="{{ route('shop') }}" class="btn btn-primary">Continuer vos achats</a>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

@endsection
