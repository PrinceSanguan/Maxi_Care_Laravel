<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SO Users</title>
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="icon" href="maxi.jpg">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <div class="sidebar">
        <div class="logo-section">
            <img src="{{asset('images/maxi3.png')}}" alt="Maxi Health Logo" class="sidebar-logo">
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li><a href="storeownerhome.html"><i class="fa-solid fa-house"></i> Home</a></li>
                <li><a href="users.html"class="active"><i class="fa-solid fa-user"></i> Users</a></li>
                <li><a href="SOsalesreport.html"><i class="fa-solid fa-chart-line"></i> Sales Report</a></li>
            </ul>
        </nav>
    </div>

    <div class="main-content">
        <header class="main-header">
            <h1>Maxi Health Inventory Management System</h1>
            <div class="user-info">
                <i class="fa-solid fa-user"></i>
                <span>Admin</span>
            </div>
        </header>
        <div class="users-section">
            <h2>Users</h2>
            <button class="new-user-btn">+ New User</button>
            <table class="user-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Admin1</td>
                        <td>FirstAdmin</td>
                        <td><button class="action-btn">Action</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Admin2</td>
                        <td>SecondAdmin</td>
                        <td><button class="action-btn">Action</button></td>
                    </tr>
                </tbody>
            </table>
        </div>
        
       
    
    <footer class="footer">
        <div class="footer-logo">
            <img src="{{asset('images/maxi2.jpg')}}" alt="Maxi Health Logo" class="small-logo">
            <p>&copy; 2024 Maxi Health. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
