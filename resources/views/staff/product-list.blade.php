<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="{{asset('css/product-list.css')}}">
    <link rel="icon" href="maxi.jpg">
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

        <section class="product-section">
            <div class="product-form">
                <h2>Product form</h2>
                <label for="category">Category</label>
                <input type="text" id="category" name="category" required>

                <label for="product-info">Product Information</label>
                <input type="text" id="product-info" name="product-info" required>

                <label for="price">Price</label>
                <input type="number" id="price" name="price" required>

                <label for="prescription">Medicine requires Prescription</label>
                <input type="checkbox" id="prescription" name="prescription">

                <div class="form-actions">
                    <button type="submit" class="save-btn">Save</button>
                    <button type="button" class="cancel-btn">Cancel</button>
                </div>
            </div>
            <div class="medicine-list">
                <h2>Medicine List</h2>
                <div class="table-controls">
                    <div class="show-entries">
                        <label for="entries">Show 
                            <select id="entries" name="entries">
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                            </select>
                            entries
                        </label>
                    </div>
                    <div class="search-box">
                        <label for="search">Search:
                            <input type="text" id="search" name="search">
                        </label>
                    </div>
                </div>
                <table>
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Information</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>BUSCOPAN VENUS TABLET</td>
                            <td>Branded</td>
                            <td>10.00</td>
                            <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>CATAPRES 75MCG TABLET</td>
                            <td>Branded</td>
                            <td>15.00</td>
                            <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                        </tr>
                        <tr>
                            <td>3</td>
                            <td>ARCOXIA 60MG TABLET</td>
                            <td>Branded</td>
                            <td>20.00</td>
                            <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    
    @include('staff.footer')

</body>
</html>
