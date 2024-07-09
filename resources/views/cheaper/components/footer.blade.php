<footer>
    <div class="container">
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
        background-color: #f8f8f8;
        border-top: 1px solid #e7e7e7;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .footer-top {
        display: flex;
        justify-content: space-between;
        padding: 20px 0;
    }

    .footer-section {
        flex: 1;
        margin: 0 10px;
    }

    .footer-section h4 {
        margin-bottom: 10px;
    }

    .footer-section p {
        margin: 0 0 15px;
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
        color: #333;
        text-decoration: none;
    }

    .footer-section ul li a:hover {
        text-decoration: underline;
    }

    .social-icons a {
        margin-right: 10px;
        color: #333;
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
        padding: 10px;
        border: 1px solid #ccc;
        border-right: none;
        flex-grow: 1;
        border-radius: 5px 0 0 5px;
    }

    .footer-section form button {
        padding: 10px;
        background-color: #007bff;
        border: 1px solid #007bff;
        color: white;
        border-radius: 0 5px 5px 0;
        cursor: pointer;
    }

    .footer-bottom {
        text-align: center;
        padding: 10px 0;
        border-top: 1px solid #e7e7e7;
        margin-top: 20px;
    }

    .footer-bottom p {
        margin: 0;
    }

</style>
