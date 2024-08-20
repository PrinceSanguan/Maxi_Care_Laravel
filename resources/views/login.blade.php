<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maxi Health - Sign In</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="icon" href="maxi.jpg" >
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{asset('images/maxi.jpg')}}" alt="Maxi Health Logo" class="logo">
            <div class="form-container">
                <form action="login.php" method="POST" class="login-form">
             
                    
                    <div class="form-group">
                        <label for="username">Email</label>
                        <input type="text" id="username" name="username" >
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" >
                    </div>
                    <button type="button" class="btn-submit">
                        <a href="home.html">Login</a>
                    </button>
                    <p>Already have an account? <a href="index.html">Create Account</a></p>
                </form>
            </div>
        </div>

        <footer class="footer">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Maxi Health Estore</h3>
                    <ul>
                        <li><a href="#">Order & Payment</a></li>
                        <li><a href="#">Cancellation Policy</a></li>
                        <li><a href="#">Shipping & Delivery</a></li>
                        <li><a href="#">Return & Refund</a></li>
                        <li><a href="#">Senior Citizen / PWD Discount</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>About Us</h3>
                    <ul>
                        <li><a href="#">Who We Are</a></li>
                        <li><a href="#">Maxi Health Brand</a></li>
                        <li><a href="#">Sustainability</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Shopping @Maxi Health</h3>
                    <ul>
                        <li><a href="#">Our Stores</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Legal</h3>
                    <ul>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                
            </div>
            <div class="footer-logo">
                <img src="{{asset('images/maxi2.jpg')}}" alt="Maxi Health Logo" class="small-logo">
                <p>&copy; 2024 Maxi Health. All Rights Reserved.</p>
            </div>
        </footer>
</body>
</html>
