<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cheaper - Your Online Store</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="path/to/your/css/style.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        header {
            background-color: white;
            border-bottom: 1px solid #e7e7e7;
        }

        .container-fluid {
            width: 100%;
            padding: 0 20px;
            margin: 0 auto;
        }

        .header-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
        }

        .logo {
            display: flex;
            align-items: center;
        }

        .logo img {
            max-height: 40px;
            margin-right: 10px;
        }

        .logo h1 {
            font-size: 24px;
            font-family: 'Arial', sans-serif; /* Utilize Arial or a similar sans-serif font */
            color: black;
            margin: 0;
            letter-spacing: 2px; /* Add letter spacing */
            text-transform: uppercase; /* Make text uppercase */
            text-decoration: none; /* Remove underline */
        }

        .logo a {
            text-decoration: none; /* Remove underline from the link */
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
            background-color: black;
            border: 1px solid black;
            color: white;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }

        .user-actions {
            display: flex;
            align-items: center;
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
            background-color: white;
            border-top: 1px solid #e7e7e7;
            padding: 10px 0;
        }

        .main-navigation ul {
            list-style: none;
            display: flex;
            justify-content: center;
            margin: 0;
            padding: 0;
        }

        .main-navigation ul li {
            margin: 0 10px;
        }

        .main-navigation ul li a {
            color: black;
            text-decoration: none;
            display: block;
            padding: 5px 10px;
        }

        .main-navigation ul li a:hover {
            background-color: #f8f8f8;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <header>
        <div class="container-fluid">
            <div class="header-top">
                <div class="logo">
                    <a href="/">
                        <img src="path/to/your/logo.png" alt="Logo">
                        <h1>Cheaper</h1>
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
</body>
</html>
