<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expired List</title>
    <link rel="stylesheet" href="{{asset('css/expired-list.css')}}">
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
            <h2>Expired List</h2>
            <div class="inventory-controls">
                <label>Show 
                    <select>
                        <option value="10">10</option>
                        <option value="25">25</option>
                        <option value="50">50</option>
                        <option value="100">100</option>
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
                        <th>Expired Date</th>
                        <th>Medicine Category</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($receives as $index => $receive)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $receive->product }}</td>
                        <td>{{ $receive->expired->format('F j, Y') }}</td>
                        <td>{{ $receive->productCategory }}</td>
                        <td>{{ $receive->quantity }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">No expired items found.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="pagination">
                <span>Showing 1 to 4 of 4 entries</span>
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
