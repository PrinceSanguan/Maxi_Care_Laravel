<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home System</title>
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="icon" href="{{asset('images/maxi.jpg')}}">
</head>
<body>

@include('staff.sidebar')
    
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

    @include('staff.footer')

</body>
</html>
