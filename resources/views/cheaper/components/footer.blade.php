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
            background-color: #000; /* Couleur de fond noire */
            color: #fff; /* Couleur du texte en blanc pour le contraste */
            border-top: 1px solid #444; /* Ajuster la couleur de la bordure supérieure pour un contraste */
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .footer-top {
            display: flex;
            flex-wrap: wrap; /* Ajout de wrap pour une meilleure réactivité sur les petits écrans */
            justify-content: space-between;
            padding: 20px 0;
        }

        .footer-section {
            flex: 1;
            margin: 0 10px;
            min-width: 200px; /* Assurez-vous que les sections ne deviennent pas trop petites */
        }

        .footer-section h4 {
            margin-bottom: 10px;
            color: #fff; /* Assurez-vous que les titres sont en blanc */
        }

        .footer-section p {
            margin: 0 0 15px;
            color: #ccc; /* Utiliser une couleur de texte légèrement différente pour le corps du texte */
        }

        .footer-section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-section ul li {
            margin-bottom: 10px;
        }

        .footer-section ul li a {
            color: #fff; /* Couleur du texte en blanc */
            text-decoration: none;
        }

        .footer-section ul li a:hover {
            text-decoration: underline;
        }

        .social-icons a {
            margin-right: 10px;
            color: #fff; /* Couleur des icônes en blanc */
            text-decoration: none;
            font-size: 18px;
        }

        .social-icons a:hover {
            color: #007bff; /* Couleur de survol pour les icônes */
        }

        .footer-section form {
            display: flex;
        }

        .footer-section form input {
            padding: 10px;
            border: 1px solid #444; /* Couleur de la bordure pour correspondre au thème sombre */
            border-right: none;
            flex-grow: 1;
            border-radius: 5px 0 0 5px;
            background-color: #333; /* Couleur de fond du champ de texte */
            color: #fff; /* Couleur du texte dans le champ de texte */
        }

        .footer-section form button {
            padding: 10px;
            background-color: #007bff; /* Couleur du bouton */
            border: 1px solid #007bff;
            color: white;
            border-radius: 0 5px 5px 0;
            cursor: pointer;
        }

        .footer-bottom {
            text-align: center;
            padding: 10px 0;
            border-top: 1px solid #444; /* Ajuster la couleur de la bordure supérieure pour un contraste */
            margin-top: 20px;
        }

        .footer-bottom p {
            margin: 0;
            color: #ccc; /* Couleur du texte pour correspondre au thème sombre */
        }
    </style>
</head>
<body>
    <!-- Contenu principal de la page -->
    <div class="content">
        <!-- Place your main content here -->
    </div>

    <!-- Footer -->
    <footer>
        <div class="container-fluid">
            <div class="footer-top">
                <div class="footer-section">
                    <h4>About Cheaper</h4>
                    <p>Your one-stop shop for the best deals on electronics, fashion, home goods, and more. We aim to provide the highest quality products at unbeatable prices.</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/shop">Shop</a></li>
                        <li><a href="/about">About Us</a></li>
                        <li><a href="/contact">Contact</a></li>
                        <li><a href="/faq">FAQ</a></li>
                        <li><a href="/terms">Terms of Service</a></li>
                        <li><a href="/privacy">Privacy Policy</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contact Us</h4>
                    <ul>
                        <li><i class="fa fa-map-marker"></i> 1234 Street Name, City, State, 12345</li>
                        <li><i class="fa fa-phone"></i> (123) 456-7890</li>
                        <li><i class="fa fa-envelope"></i> support@cheaper.com</li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Follow Us</h4>
                    <div class="social-icons">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-twitter"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="footer-section">
                    <h4>Subscribe to Our Newsletter</h4>
                    <form action="/subscribe" method="POST">
                        <input type="email" name="email" placeholder="Enter your email" required>
                        <button type="submit">Subscribe</button>
                    </form>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2024 Cheaper. All rights reserved.</p>
            </div>
        </div>
    </footer>
</body>
</html>
