<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cheaper - Your Shopping Site</title>

    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- FontAwesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

    <!-- Custom CSS -->
    <style>
        /* Général Styling */
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f4;
            margin: 0;
        }

        /* Header Styling */
        header {
            background-color: #ffffff;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
        }

        /* Alignements des éléments dans le header */
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            max-height: 40px;
            margin-right: 10px;
        }

        .logo h1 {
            font-size: 22px;
            margin: 0;
            color: #007bff;
        }

        /* Barre de recherche */
        .search-bar {
            flex: 1;
            padding: 0 20px;
        }

        .search-bar form {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .search-bar input {
            width: 100%;
            max-width: 400px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px 0 0 4px;
            box-shadow: none;
        }

        .search-bar button {
            padding: 10px;
            background-color: #007bff;
            border: none;
            border-radius: 0 4px 4px 0;
            color: white;
            cursor: pointer;
        }

        /* Actions utilisateur */
        .user-actions {
            display: flex;
            align-items: center;
        }

        .user-actions a {
            color: #333;
            text-decoration: none;
            margin-left: 15px;
        }

        .user-actions a:hover {
            color: #007bff;
        }

        .user-actions i {
            margin-right: 5px;
        }

        /* Navigation principale */
        .main-navigation {
            background-color: #007bff;
            padding: 10px 0;
        }

        .main-navigation ul {
            list-style: none;
            display: flex;
            justify-content: center;
            padding: 0;
            margin: 0;
        }

        .main-navigation ul li {
            margin: 0 20px;
        }

        .main-navigation ul li a {
            color: white;
            font-size: 16px;
            text-decoration: none;
        }

        .main-navigation ul li a:hover {
            color: #ddd;
        }

        /* Dropdown Menu */
        .dropdown-menu {
            display: none;
            position: absolute;
            background-color: #fff !important;
            color: #333 !important;
            min-width: 150px;
            z-index: 1000;
            border: 1px solid #ddd;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        }

        .dropdown:hover .dropdown-menu,
        .show > .dropdown-menu {
            display: block;
        }

        /* Liens dans le menu sans effet de survol */
        .dropdown-menu a {
            color: #333 !important;
            padding: 10px 15px;
            display: block;
            text-decoration: none;
            background-color: #fff !important;
        }

        .dropdown-menu a:hover {
            background-color: #fff !important;
            color: #333 !important;
        }

        @media (max-width: 768px) {
            .search-bar input {
                width: 100%;
            }

            .user-actions {
                justify-content: center;
                margin-top: 10px;
            }

            .main-navigation ul {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container header-content">
            <!-- Logo -->
            <div class="logo">
                <a href="/">
                    <img src="path/to/your/logo.png" alt="Logo">
                    <h1>Cheaper</h1>
                </a>
            </div>

            <!-- Search Bar -->
            <div class="search-bar">
                <form action="/search" method="GET">
                    <input type="text" name="query" placeholder="Search for products...">
                    <button type="submit"><i class="fa fa-search"></i></button>
                </form>
            </div>

            <!-- User Actions -->
            <div class="user-actions">
                @auth
                <a href="{{ route('home') }}">
                    <i class="fa fa-user"></i>
                    <span>{{ Auth::user()->name }}</span>
                </a>

                @if (auth()->user()->isAdmin())
                <a href="{{ route('admin.product.index') }}" class="user-icon">
                    <i class="fa fa-user"></i>
                    <span>Admin Dashboard</span>
                </a>
                @endif

                <!-- Bouton de déconnexion -->
                <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="fa fa-sign-out-alt"></i>
                    <span>Logout</span>
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
                @else
                <a href="{{ route('signup') }}" class="user-icon">
                    <i class="fa fa-user-plus"></i>
                    <span>Signup</span>
                </a>
                <a href="{{ route('signin') }}" class="user-icon">
                    <i class="fa fa-sign-in-alt"></i>
                    <span>Signin</span>
                </a>
                @endauth
                <a href="/wishlist" class="wishlist-icon">
                    <i class="fa fa-heart"></i>
                    <span>Wishlist</span>
                </a>
                <a href="/cart" class="cart-icon">
                    <i class="fa fa-shopping-cart"></i>
                    <span>Cart (<span class="cart-count">{{ $cartCount ?? 0 }}</span>)</span>
                </a>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="main-navigation mt-4">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/shop">Shop</a></li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    Pages
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    @foreach (session()->get('pages')['headPages'] as $page)
                    <a class="dropdown-item" href="{{ route('page', ['page' => $page->slug]) }}">{{ $page->title }}</a>
                    @endforeach
                </div>
            </li>
        </ul>
    </nav>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

    <!-- Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>
