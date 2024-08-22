<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home System</title>
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="maxi.jpg" >
</head>
<body>
    <div class="sidebar">
        <div class="logo-section">
            <img src="{{asset('images/maxi3.png')}}" alt="Maxi Health Logo" class="sidebar-logo">
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li><a href="#" class="active"><i class="fa-solid fa-house"></i> Home</a></li>
                <li><a href="monitor.html" ><i class="fa-sharp fa-solid fa-bars"></i> Stock Monitoring</a></li>
                <li><a href="sales.html"><i class="fa-sharp fa-solid fa-coins"></i> Sales</a></li>
                <li><a href="receive.html"><i class="fa-sharp fa-solid fa-download"></i> Receiving</a></li>
                <li><a href="Pcategory.html"><i class="fa-sharp fa-solid fa-bars"></i> Product Category</a></li>
                <li><a href="Productlist.html"><i class="fa-solid fa-box"></i> Product List</a></li>
                <li><a href="expiredlist.html"><i class="fa-sharp fa-solid fa-bars"></i> Expired List</a></li>
                <li><a href="supplier.html"><i class="fa-solid fa-person-chalkboard"></i> Supplier List</a></li>
                <li><a href="{{route('logout')}}"><i class="fa-solid fa-right-from-bracket"></i> Logout</a></li>
            </ul>
        </nav>
    </div>
    
    <div class="main-content">
        <header class="main-header">
            <h1>Maxi Health Inventory Management System</h1>
            <div class="user-info">
                <i class="fa-solid fa-user-tie"></i> Otlum
            </div>
        </header>
        
        <div class="sales-info">
            <div class="sales-card today-sales">
                <h2>Today Sales :</h2>
                <p>(06-24-2024)</p>
                <p class="sales-amount">Php 9,299.00</p>
            </div>
            <div class="sales-card monthly-sales">
                <h2>Total Monthly Sales :</h2>
                <p>June</p>
                <p class="sales-amount">Php 12,299.00</p>
            </div>
        </div>
    </div>
    
    <!-- Logout ng Modal -->
    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Log out of Account?</h2>
            <p>Are you sure you want to log out of account before you confirm your email? Confirming the email on your account ensures you will be able to log in again.</p>
            <button id="confirmAccount">Confirm account</button>
            <a href="signin2.html" id="logoutButton" class="logout-button">Log out</a>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-logo">
            <img src="{{asset('images/maxi2.jpg')}}" alt="Maxi Health Logo" class="small-logo">
            <p>&copy; 2024 Maxi Health. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- JavaScript for Modal Functionality -->
    <script>
        // kunin ung modal
        var modal = document.getElementById("logoutModal");

        // Get the button para ma open ung modal
        var userInfo = document.querySelector(".user-info");

        // Get the <span> element para naman mag close
        var span = document.getElementsByClassName("close")[0];

       
        userInfo.onclick = function() {
            modal.style.display = "block";
        }

        // pang x lang
        span.onclick = function() {
            modal.style.display = "none";
        }

        // isa pang pang close kapag ni click sa iba
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
</body>
</html>
