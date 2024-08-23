<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SO Sales Report</title>
    <link rel="stylesheet" href="{{asset('css/sales-report.css')}}">
    <link rel="icon" href="{{asset('images/maxi.jpg')}}">
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
        
            <!-- Sales Report Section -->
            <div class="sales-report-section">
                <h2>Sales Report</h2>
                <div class="charts">
                    <div class="chart-wrapper">
                       
                        <img src="{{asset('images/flowchart.png')}}" alt="Monthly Sales by Category">
                    </div>
                    <div class="pie-charts">
                        <div class="pie-chart">
                            <h3>Generic</h3>
                            <img src="{{asset('images/generic.png')}}" alt="Generic Sales">
                        </div>
                        <div class="pie-chart">
                            <h3>Branded</h3>
                            <img src="{{asset('images/branded.png')}}" alt="Branded Sales">
                        </div>
                    </div>
                </div>
            </div>
        
            <footer class="footer">
                <div class="footer-logo">
                    <img src="{{asset('images/maxi2.jpg')}}" alt="Maxi Health Logo" class="small-logo">
                    <p>&copy; 2024 Maxi Health. All Rights Reserved.</p>
                </div>
            </footer>
        </div>
        
       
    
    <footer class="footer">
        <div class="footer-logo">
            <img src="{{asset('images/maxi2.jpg')}}" alt="Maxi Health Logo" class="small-logo">
            <p>&copy; 2024 Maxi Health. All Rights Reserved.</p>
        </div>
    </footer>
</body>
</html>
