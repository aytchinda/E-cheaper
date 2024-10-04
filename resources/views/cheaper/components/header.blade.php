<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>{{ __('messages.cheaper') }} - {{ __('messages.your_shopping_site') }}</title>

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
            background-color: #ece49c;
            border-bottom: 1px solid #ddd;
            padding: 10px 0;
            position: relative;
            overflow: hidden;
        }

        /* Alignements des éléments dans le header */
        .header-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0 2rem;
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
            position: relative;
            max-width: 200px;
        }

        .logo-img {
            height: 70px;
            margin-right: 10px;
            transition: transform 0.3s ease;
            position: relative;
        }

        .logo-img:hover {
            transform: scale(1.6);
        }

        .logo-text {
            font-size: 18px;
            margin: 0;
            color: #007bff;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .logo-text:hover {
            color: #0056b3;
        }

        /* Barre de recherche */
        .search-bar {
            flex: 1;
            padding: 0 20px;
            max-width: 600px;
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

        /* Sélecteur de langue simplifié */
        .language-selector {
            margin-left: 15px;
            position: relative;
        }

        .language-selector select {
            padding: 5px;
            border-radius: 4px;
            border: 1px solid #ccc;
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
            align-items: center; /* Aligner les éléments verticalement */

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

        /* Styles pour le menu principal */
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
            position: relative;
            margin: 0 20px;
        }

        .main-navigation ul li a {
            color: white;
            font-size: 16px;
            text-decoration: none;
            padding: 10px 15px;
            transition: background-color 0.3s ease;
        }

        .main-navigation ul li a:hover {
            background-color: #0056b3;
        }

        /* Styles pour le menu déroulant */
        .nav-item.dropdown .dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: #ffffff;
            min-width: 200px;
            border-radius: 4px;
            box-shadow: 0px 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
            transition: all 0.3s ease;
            opacity: 0;
            transform: translateY(10px);
        }

        .nav-item.dropdown:hover .dropdown-menu {
            display: block;
            opacity: 1;
            transform: translateY(0);
        }

        .dropdown-menu a {
            color: #333;
            text-decoration: none;
            padding: 10px 15px;
            display: block;
            transition: background-color 0.3s ease;
        }

        .dropdown-menu a:hover {
            background-color: #f1f1f1;
            color: #007bff;
        }

        /* Mobile-friendly styles */
        @media (max-width: 768px) {
            .main-navigation ul {
                flex-direction: column;
                align-items: flex-start;
            }

            .nav-item .dropdown-menu {
                position: static;
                box-shadow: none;
            }

            .nav-item.dropdown:hover .dropdown-menu {
                transform: none;
            }
        }
    </style>
</head>

<body>
    <header>
        <div class="container-fluid header-content">
            <!-- Logo -->
            <div class="logo">
                <a href="/" class="d-flex align-items-center text-decoration-none">
                    <img src="../storage/images/logo1.png" alt="Logo" class="logo-img">
                    <h1 class="logo-text ml-2">{{ __('messages.cheaper') }}</h1>
                </a>
            </div>

            <!-- Search Bar -->
            <div class="search-bar">
                <form action="/search" method="GET">
                    <input type="text" name="query" placeholder="{{ __('messages.search_for_products') }}">
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
                            <span>{{ __('messages.admin_dashboard') }}</span>
                        </a>
                        <a href="{{ route('dashboard.index') }}" class="user-icon">
                            <i class="fa fa-user"></i>
                            <span>{{ __('messages.dashboard') }}</span>
                        </a>
                    @else
                        <a href="{{ route('dashboard.index') }}" class="user-icon">
                            <i class="fa fa-user"></i>
                            <span>{{ __('messages.dashboard') }}</span>
                        </a>
                    @endif

                    <a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        <i class="fa fa-sign-out-alt"></i>
                        <span>{{ __('messages.logout') }}</span>
                    </a>

                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('signup') }}" class="user-icon">
                        <i class="fa fa-user-plus"></i>
                        <span>{{ __('messages.signup') }}</span>
                    </a>
                    <a href="{{ route('signin') }}" class="user-icon">
                        <i class="fa fa-sign-in-alt"></i>
                        <span>{{ __('messages.signin') }}</span>
                    </a>
                @endauth
                <a href="/wishlist" class="wishlist-icon">
                    <i class="fa fa-heart"></i>
                    <span>{{ __('messages.wishlist') }}</span>
                </a>
                <a href="/cart" class="cart-icon">
                    <i class="fa fa-shopping-cart"></i>
                    <span>{{ __('messages.cart') }} (<span class="cart-count">{{ $cartCount ?? 0 }}</span>)</span>
                </a>

                <!-- Sélecteur de Langue Simplifié -->
                <div class="language-selector">
                    <form id="language-form" method="GET">
                        <select name="locale" onchange="changeLanguage(this.value)">
                            <option value="en" {{ app()->getLocale() == 'en' ? 'selected' : '' }}>EN</option>
                            <option value="fr" {{ app()->getLocale() == 'fr' ? 'selected' : '' }}>FR</option>
                            <option value="es" {{ app()->getLocale() == 'es' ? 'selected' : '' }}>ES</option>
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="main-navigation mt-4">
        <ul>
            <li><a href="/">{{ __('messages.home') }}</a></li>
            <li><a href="/shop">{{ __('messages.shop') }}</a></li>
            <li class="nav-item dropdown">
                <a href="#" class="nav-link">{{ __('messages.pages') }}</a>
                <div class="dropdown-menu">
                    @foreach (session()->get('pages')['headPages'] as $page)
                        <a href="{{ route('page', ['page' => $page->slug]) }}">{{ $page->title }}</a>
                    @endforeach
                </div>
            </li>
        </ul>
    </nav>

</body>

<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>

<!-- Popper.js -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
    function changeLanguage(locale) {
        // Redirige vers l'URL appropriée avec le paramètre locale
        window.location.href = "{{ url('lang') }}/" + locale;
    }
</script>

</html>
