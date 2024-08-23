<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Category</title>
    <link rel="stylesheet" href="{{asset('css/product-category.css')}}">
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

        <section class="category-section">
            <form class="category-form">
                <h2>Category Form</h2>
                <label for="category">Category</label>
                <input type="text" id="category" name="category" required>
                <div class="form-actions">
                    <button type="submit" class="save-btn">Save</button>
                    <button type="button" class="cancel-btn">Cancel</button>
                </div>
            </form>

            <table class="category-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>Generic</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>Generic Bottles</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>Cosmetics</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>Supplies</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>Branded</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>Milk</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>Ritemed</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                </tbody>
            </table>
        </section>
    </div>
    
@include('staff.footer')

</body>
</html>
