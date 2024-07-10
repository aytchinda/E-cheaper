<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cheaper - Your Online Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="path/to/your/css/style.css">
</head>
<body>
    <header>
        <div class="container">
            <div class="header-top">
                <div class="logo">

                    <a href="/">
                        <h1>Cheaper</h1>
                        <img src="path/to/your/logo.png" alt=" Logo">
                    </a>
                </div>
                <div class="search-bar">
                    <form action="/search" method="GET">
                        <input type="text" name="query" placeholder="Search for products...">
                        <button type="submit"><i class="fa fa-search"></i></button>
                    </form>
                </div>
                <div class="user-actions">
                    <a href="/account" class="user-icon">
                        <i class="fa fa-user"></i>
                        <span>Account</span>
                    </a>
                    <a href="/wishlist" class="wishlist-icon">
                        <i class="fa fa-heart"></i>
                        <span>Wishlist</span>
                    </a>
                    <a href="/cart" class="cart-icon">
                        <i class="fa fa-shopping-cart"></i>
                        <span>Cart (<span class="cart-count">0</span>)</span>
                    </a>
                </div>
            </div>
            <nav class="main-navigation">
                <ul>
                    <li><a href="/">Home</a></li>
                    <li><a href="/shop">Shop</a></li>
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/contact">Contact</a></li>
                    <li><a href="/faq">FAQ</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: #f8f8f8;
            border-bottom: 1px solid #e7e7e7;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }

        .logo img {
            max-height: 50px;
        }

        .search-bar {
            flex-grow: 1;
            max-width: 600px;
            margin: 0 20px;
        }

        .search-bar form {
            display: flex;
        }

        .search-bar input {
            flex-grow: 1;
            padding: 10px;
            border: 1px solid #ccc;
            border-right: none;
            border-radius: 5px 0 0 5px;
        }

        .search-bar button {
            padding: 10px;
            background-color: #007bff;
            border: 1px solid #007bff;
            color: white;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }

        .user-actions a {
            margin-left: 15px;
            color: #333;
            text-decoration: none;
            display: flex;
            align-items: center;
        }

        .user-actions a span {
            margin-left: 5px;
        }

        .main-navigation {
            background-color: #007bff;
        }

        .main-navigation ul {
            list-style: none;
            display: flex;
            justify-content: space-around;
            margin: 0;
            padding: 0;
        }

        .main-navigation ul li {
            margin: 0;
        }

        .main-navigation ul li a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 15px 20px;
        }

        .main-navigation ul li a:hover {
            background-color: #0056b3;
        }
    </style>
</body>
</html>
