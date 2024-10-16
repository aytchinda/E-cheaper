<!DOCTYPE html>
<html lang="en">

<head>

    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css" rel="stylesheet">

    @yield('styles')
    <style>
        .espero-soft-admin {
            background-color: #fafafa;
        }

        .espero-soft-admin .row {
            height: 100vh;
        }

        .espero-soft-admin a {
            text-decoration: inherit;
        }

        .espero-soft-admin h2 {
            color: black;
            text-transform: uppercase;
        }

        .espero-soft-admin .nav-item {
            /* Vos styles ici si nécessaire */
        }

        .btn {
            border-radius: 0;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-3 bg-light text-dark">
        <div class="row gx-0 gy-0">
            <nav id="sidebar" class="col-md-2 border-end d-none d-md-block bg-light sidebar">

                <div class="sidebar-sticky">
                    <!-- Notifications de commandes -->
                    <div class="mt-5">
                        <h4>Notifications des commandes</h4>
                        <ul class="list-group">
                            @foreach (auth()->user()->unreadNotifications as $notification)
                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-primary me-3">
                                        <i class="bi bi-cart-plus"></i>
                                    </span>
                                    <div>
                                        <strong>Commande #{{ $notification->data['order_id'] }}</strong>
                                        passée par {{ $notification->data['clientName'] ?? 'Inconnu' }}.<br>
                                        <small>Total : €{{ number_format($notification->data['total'], 2, ',', ' ') }}.</small>
                                    </div>
                                </div>

                                <!-- Boutons pour voir les détails et marquer comme lue -->
                                <div class="d-flex">
                                    <a href="{{ route('admin.orders.show', $notification->data['order_id']) }}" class="btn btn-sm btn-info me-2">
                                        Voir détails
                                    </a>


                                    <form action="{{ route('admin.notifications.read', $notification->id) }}" method="POST">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Marquer comme lue</button>
                                    </form>
                                </div>
                            </li>
                            @endforeach
                        </ul>

                        @if (auth()->user()->unreadNotifications->isEmpty())
                        <p class="mt-3 text-muted">Aucune nouvelle notification.</p>
                        @endif
                    </div>

                    <!-- Modal Bootstrap pour afficher les détails de la commande -->
<!-- Modal Bootstrap pour afficher les détails de la commande -->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Détails de la commande</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p><strong>Commande #</strong> <span id="modal-order-id"></span></p>
                <p><strong>Client :</strong> <span id="modal-client-name"></span></p>
                <p><strong>Total :</strong> €<span id="modal-total"></span></p>

                <!-- Tableau pour afficher les produits -->
                <h5>Produits</h5>
                <table class="table table-bordered" id="modal-items">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prix</th>
                            <th>Quantité</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Les produits seront insérés ici via JavaScript -->
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>




        <!-- Fin Notifications de commandes -->

                    <a href="{{ route('home') }}">Home</a>

                    <h2>Cheaper</h2>
                    <ul class="nav flex-column">

                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.category.index') }}">
                                Categories
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.product.index') }}">
                                Products
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.user.index') }}">
                                Users
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.banner.index') }}">
                                Banners
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.shopcollection.index') }}">
                                Shopcollections
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.page.index') }}">
                                Pages
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.role.index') }}">
                                Roles
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.carrier.index') }}">
                                Carriers
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.address.index') }}">
                                Addresses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.method.index') }}">
                                Methods
                            </a>
                        </li>


                    </ul>
                </div>
            </nav>

            <main id="main-content" class="col-md-10">
               <h2 class="border-bottom m-0 p-3">Dashboard</h2>


                <div class="p-3">


                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.0.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" defer
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" defer
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" defer></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap4.min.js" defer></script>
    @yield('scripts')


    <script>
    function loadOrderDetails(orderId) {
        // Effectuer un appel AJAX pour récupérer les détails de la commande
        $.ajax({
            url: '/admin/orders/' + orderId + '/details',
            method: 'GET',
            success: function(data) {
                // Mettre à jour les éléments dans le modal avec les données de la commande
                $('#modal-order-id').text(data.order_id);
                $('#modal-client-name').text(data.client_name);

                // Formater le total
                let formattedTotal = parseFloat(data.total).toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                $('#modal-total').text(formattedTotal);

                // Afficher les produits
                let productsHtml = '';
                data.products.forEach(function(product) {
                    productsHtml += `
                        <tr>
                            <td>${product.name}</td>
                            <td>€${parseFloat(product.price).toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                            <td>${product.quantity}</td>
                            <td>€${parseFloat(product.total).toLocaleString('fr-FR', { minimumFractionDigits: 2, maximumFractionDigits: 2 })}</td>
                        </tr>
                    `;
                });

                $('#modal-items tbody').html(productsHtml);

                // Afficher le modal
                $('#orderDetailsModal').modal('show');
            },
            error: function() {
                alert("Impossible de charger les détails de la commande.");
            }
        });
    }

    </script>



</body>

</html>
