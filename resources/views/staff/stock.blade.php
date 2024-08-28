<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monitor System</title>
    <link rel="stylesheet" href="{{asset('css/stock.css')}}">
    <link rel="icon" href="{{asset('images/maxi.jpg')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>

    @include('staff.sidebar')

    <div class="main-content">
        <header class="main-header">
            <h1>Maxi Health Inventory Management System</h1>
            <div class="user-info">
                <i class="fa-solid fa-user"></i>
                <span>Otlum</span>
            </div>
        </header>

        <section class="inventory">
            <h2>Inventory</h2>
            <div class="inventory-controls">
                <label>Show 
                    <select>
                        <option value="5">5</option>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                    </select> entries
                </label>
                <label>Search: 
                    <input type="text">
                </label>
            </div>
            <table class="inventory-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Stock In</th>
                        <th>Stock Out</th>
                        <th>Expired</th>
                        <th>Stock Available</th>
                        <th>Safety Stock</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        @foreach($productNames as $index => $productName)
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $productName->product }}</td>
                            <td>{{ $productName->quantity }}</td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="pagination">
                <span>Showing 1 to 5 of 5 entries</span>
                <div>
                    <button>Previous</button>
                    <span>1</span>
                    <button>Next</button>
                </div>
            </div>
        </section>
    </div>
    
    @include('staff.footer')

</body>
</html>
