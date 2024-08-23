<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier List</title>
    <link rel="stylesheet" href="{{asset('css/supplier-list.css')}}">
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

        <section class="supplier-form-section">
            <h2>Supplier Form</h2>
            <div class="form-container">
                <form action="#" method="POST">
                    <div class="form-group">
                        <label for="supplier-name">Supplier</label>
                        <input type="text" id="supplier-name" name="supplier-name" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="product">Product</label>
                        <input type="text" id="product" name="product" required>
                    </div>
                    <div class="form-buttons">
                        <button type="submit" class="save-btn">Save</button>
                        <button type="button" class="cancel-btn">Cancel</button>
                    </div>
                </form>
            </div>

            <h2>Supplier List</h2>
            <div class="supplier-table-container">
                <table class="supplier-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Supplier Info</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Supplier Name, Email, Product</td>
                            <td>
                                <button class="action-btn edit-btn"><i class="fa-solid fa-pen-to-square"></i> Edit</button>
                                <button class="action-btn delete-btn"><i class="fa-solid fa-trash"></i> Delete</button>
                            </td>
                        </tr>
                        <!-- Additional rows can be added here -->
                    </tbody>
                </table>
            </div>
        </section>
    </div>
    
   @include('staff.footer')

</body>
</html>
