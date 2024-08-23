<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receiving System</title>
    <link rel="stylesheet" href="{{asset('css/receiving.css')}}">
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

        <section class="inventory">
       
                <button class="new-sales-btn"><i class="fa fa-plus"></i> Receiving</button>
       
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
                        <th>Reference</th>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Expiry Date</th>
                        <th>Amount</th>
                        <th>Supplier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>June 3, 2024</td>
                        <td>00000000</td>
                        <td>Product A</td>
                        <td>100</td>
                        <td>June 3, 2025</td>
                        <td>100.00</td>
                        <td>Supplier A</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>2</td>
                        <td>May 20, 2024</td>
                        <td>50031334</td>
                        <td>Product B</td>
                        <td>50</td>
                        <td>May 20, 2025</td>
                        <td>250.00</td>
                        <td>Supplier B</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>3</td>
                        <td>June 5, 2024</td>
                        <td>30045234</td>
                        <td>Product C</td>
                        <td>30</td>
                        <td>June 5, 2025</td>
                        <td>550.00</td>
                        <td>Supplier C</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>4</td>
                        <td>June 2, 2024</td>
                        <td>31341520</td>
                        <td>Product D</td>
                        <td>75</td>
                        <td>June 2, 2025</td>
                        <td>750.00</td>
                        <td>Supplier D</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>5</td>
                        <td>June 10, 2024</td>
                        <td>32351520</td>
                        <td>Product E</td>
                        <td>45</td>
                        <td>June 10, 2025</td>
                        <td>150.00</td>
                        <td>Supplier E</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>6</td>
                        <td>June 8, 2024</td>
                        <td>55551520</td>
                        <td>Product F</td>
                        <td>60</td>
                        <td>June 8, 2025</td>
                        <td>170.00</td>
                        <td>Supplier F</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                    <tr>
                        <td>7</td>
                        <td>June 9, 2024</td>
                        <td>12462520</td>
                        <td>Product G</td>
                        <td>80</td>
                        <td>June 9, 2025</td>
                        <td>670.00</td>
                        <td>Supplier G</td>
                        <td><button class="edit-btn">Edit</button> <button class="delete-btn">Delete</button></td>
                    </tr>
                </tbody>
            </table>
            <div class="pagination">
                <span>Showing 1 to 7 of 7 entries</span>
                <div>
                    <button>Previous</button>
                    <span>1</span>
                    <button>Next</button>
                </div>
            </div>
        </section>
    </div>
    <div id="newSalesModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Manage Receiving</h2>
            <form>
                <div class="form-group">
                    <label for="supplier">Supplier</label>
                    <input type="text" id="supplier" name="supplier" value="Supplier 1">
                </div>
                <div class="form-group">
                    <label for="productName">Product Name</label>
                    <input type="text" id="productName" name="productName">
                </div>
                <div class="form-group">
                    <label for="quantity">Quantity</label>
                    <input type="number" id="quantity" name="quantity">
                </div>
                <div class="form-group">
                    <label for="amount">Amount</label>
                    <input type="number" id="amount" name="amount">
                </div>
                <div class="form-group">
                    <label for="expiryDate">Expiration Date</label>
                    <input type="date" id="expiryDate" name="expiryDate">
                </div>
                <button type="button" id="addToList">Add to list</button>
            </form>
            <table class="inventory-table">
                <thead>
                    <tr>
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Expiration Date</th>
                        <th>Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Name: Loperamide 250mg Category: Branded</td>
                        <td>500</td>
                        <td>June 3, 2026</td>
                        <td>4800</td>
                        <td><button class="delete-btn">Delete</button></td>
                    </tr>
                </tbody>
            </table>
            <button id="saveBtn">Save</button>
        </div>
    </div>
    <script>
        // Get the modal
        var modal = document.getElementById("newSalesModal");
    
        // ito yung button para ma open ung modal
        var btn = document.querySelector(".new-sales-btn");
    
        
        var span = document.getElementsByClassName("close")[0];
    
        
        btn.onclick = function() {
            modal.style.display = "block";
        }
    
        // pang x pag na open na ung modal
        span.onclick = function() {
            modal.style.display = "none";
        }
    
        // pag na open na simple na exx nalang
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
    
   @include('staff.footer')

</body>
</html>
