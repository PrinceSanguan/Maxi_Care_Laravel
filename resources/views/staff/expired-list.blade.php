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
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Loperamide 250mg</td>
                        <td>July 20, 2024</td>
                        <td>Generic</td>
                        <td>100</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Biogesic 500mg</td>
                        <td>July 3, 2024</td>
                        <td>Branded</td>
                        <td>50</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Arcoxia 60mg</td>
                        <td>August 5, 2024</td>
                        <td>Branded</td>
                        <td>210</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Antiox 500mg</td>
                        <td>July 25, 2024</td>
                        <td>Branded</td>
                        <td>150</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
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
