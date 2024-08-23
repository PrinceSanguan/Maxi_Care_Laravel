<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales System</title>
    <link rel="stylesheet" href="{{asset('css/sales.css')}}">
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
            <a href="sales2.html">
                <button class="new-sales-btn"><i class="fa fa-plus"></i> New Sales</button>
            </a>
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
                        <th>Date</th>
                        <th>Reference #</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>June 3, 2024</td>
                        <td>00000000</td>
                        <td>100.00</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>May 20, 2024</td>
                        <td>50031334</td>
                        <td>250.00</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>June 5, 2024</td>
                        <td>30045234</td>
                        <td>550.00</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>June 2, 2024</td>
                        <td>31341520</td>
                        <td>750.00</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>June 10, 2024</td>
                        <td>32351520</td>
                        <td>150.00</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>June 8, 2024</td>
                        <td>55551520</td>
                        <td>170.00</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>June 9, 2024</td>
                        <td>12462520</td>
                        <td>670.00</td>
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
