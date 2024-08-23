<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maxi Health Inventory Management System</title>
    <link rel="stylesheet" href="{{asset('css/admin-home.css')}}">
    <link rel="icon" href="maxi.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

  @include('admin.sidebar')
  
    <div class="main-content">
        <header class="main-header">
            <h1>Maxi Health Inventory Management System</h1>
            <div class="user-info">
                <i class="fa-solid fa-user"></i>
                <span>Admin</span>
            </div>
        </header>
        <div id="logoutModal" class="modal">
            <div class="modal-content">
                <span class="close">&times;</span>
                <h2>Log out of Account?</h2>
                <p>Are you sure you want to log out of account before you confirm your email? Confirming the email on your account ensures you will be able to log in again.</p>
                <button id="confirmAccount">Confirm account</button>
                <a href="signin.html" id="logoutButton" class="logout-button">Log out</a>
            </div>
        </div>
    
        <footer class="footer">
            <div class="footer-logo">
                <img src="{{asset('images/maxi2.jpg')}}" alt="Maxi Health Logo" class="small-logo">
                <p>&copy; 2024 Maxi Health. All Rights Reserved.</p>
            </div>
        </footer>
    
</body>
</html>
