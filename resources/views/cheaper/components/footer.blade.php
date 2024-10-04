<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __('messages.cheaper') }} - {{ __('messages.your_shopping_site') }}</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="path/to/your/css/style.css">
    <style>
        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .content {
            flex: 1;
            padding: 20px;
        }

        footer {
            background-color: #000;
            color: #fff;
            border-top: 1px solid #444;
            padding: 10px 0;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-top {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            padding: 10px 0;
        }

        .footer-section {
            flex: 1;
            margin: 0 10px;
            min-width: 180px;
        }

        .footer-section h4 {
            margin-bottom: 8px;
            font-size: 16px;
            color: #fff;
        }

        .footer-section p,
        .footer-section ul li {
            margin: 0 0 10px;
            font-size: 14px;
            line-height: 1.4;
            color: #ccc;
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-section ul li a {
            color: #fff;
            text-decoration: none;
        }

        .footer-section ul li a:hover {
            text-decoration: underline;
        }

        .social-icons a {
            margin-right: 10px;
            color: #fff;
            text-decoration: none;
            font-size: 18px;
        }

        .social-icons a:hover {
            color: #007bff;
        }

        .footer-section form {
            display: flex;
        }

        .footer-section form input {
            padding: 8px;
            border: 1px solid #444;
            border-right: none;
            flex-grow: 1;
            border-radius: 5px 0 0 5px;
            background-color: #333;
            color: #fff;
            font-size: 14px;
        }

        .footer-section form button {
            padding: 8px;
            background-color: #007bff;
            border: 1px solid #007bff;
            color: white;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
            font-size: 14px;
        }

        .footer-bottom {
            text-align: center;
            padding: 5px 0;
            border-top: 1px solid #444;
            margin-top: 10px;
        }

        .footer-bottom p {
            margin: 0;
            font-size: 13px;
            color: #ccc;
        }
    </style>
</head>
<body>
    <!-- Contenu principal de la page -->
    <div class="content">
        <!-- Placez ici votre contenu principal -->
    </div>

    <!-- Footer -->
    <footer>
        <div class="container-fluid">
            <div class="footer-top">
                <div class="footer-section">
                    <h4>{{ __('messages.about_cheaper') }}</h4>
                    <p>{{ __('messages.about_description') }}</p>
                </div>
                <div class="footer-section">
                    <h4>{{ __('messages.quick_links') }}</h4>
                    <ul>
                        <li><a href="/">{{ __('messages.home') }}</a></li>
                        <li><a href="/shop">{{ __('messages.shop') }}</a></li>
                        <li><a href="/about">{{ __('messages.about_us') }}</a></li>
                        <li><a href="/terms">{{ __('messages.terms_conditions') }}</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>{{ __('messages.contact_us') }}</h4>
                    <ul>
                        <li><i class="fa fa-map-marker"></i> {{ __('messages.address') }}</li>
                        <li><i class="fa fa-phone"></i> {{ __('messages.phone') }}</li>
                        <li><i class="fa fa-envelope"></i> {{ __('messages.email') }}</li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>{{ __('messages.follow_us') }}</h4>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>{{ __('messages.subscribe_newsletter') }}</h4>
                    <form action="/subscribe" method="POST">
                        <input type="email" name="email" placeholder="{{ __('messages.enter_your_email') }}" required>
                        <button type="submit">{{ __('messages.subscribe') }}</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>{{ __('messages.copyright') }}</p>
            </div>
        </div>
    </footer>
</body>
</html>
