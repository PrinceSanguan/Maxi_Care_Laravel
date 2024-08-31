<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales System</title>
    <link rel="stylesheet" href="{{asset('css/sales.css')}}">
    <link rel="icon" href="{{asset('images/maxi.jpg')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
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
            
                <button class="new-sales-btn btn btn-primary"><i class="fa fa-plus"></i> New Sales</button>
            
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
                        <th>Product Name</th>
                        <th>Quantity</th>
                        <th>Price</th>
                        <th>Total Amount</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($sales as $index => $sale)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{$sale->created_at->format('F j, Y') }}</td>
                        <td>{{$sale->reference}}</td>
                        <td>{{$sale->productName}}</td>
                        <td>{{$sale->quantity}}</td>
                        <td>{{$sale->price}}</td>
                        <td>{{$sale->amount}}</td>
                        <td>
                            <form action="{{ route('staff.delete-sales', $sale->id) }}" method="post" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="action-btn delete-btn btn btn-danger" onclick="return confirm('Are you sure you want to delete this sales?');">
                                    <i class="fa-solid fa-trash"></i> Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
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

    <!-- Modal -->
<div id="newSalesModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">New Sales</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form method="post" action="{{route('staff.new-sales')}}">
                    @csrf

                    <div class="mb-3">
                        <label for="productName" class="form-label">Product Name</label>
                        <select id="productName" name="productName" class="form-control form-select" required>
                            <option value="" disabled selected>Select a Product</option>
                            @foreach($stocks as $stock)
                                <option value="{{ $stock->productName }}">{{ $stock->productName }}</option>
                            @endforeach
                        </select>
                    </div>
                  
                    <div class="form-group">
                      <label>Quantity</label>   
                  
                      <input type="number" name="quantity" class="form-control" required min="1"> </div>
                  
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>   
                  
                      <button type="submit" class="btn btn-primary">Save</button>   
                  
                    </div>
                  </form>
            </div>
            
        </div>
    </div>
</div>

    
    @include('staff.footer')

    <!-- Bootstrap JS, Popper.js, and jQuery -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Open modal on button click
            document.querySelector('.new-sales-btn').addEventListener('click', function () {
                $('#newSalesModal').modal('show');
            });
    
            // Ensure the modal can be closed by the 'X' button
            document.querySelector('.modal .close').addEventListener('click', function () {
                $('#newSalesModal').modal('hide');
            });
    
            // Ensure the modal can be closed by the 'Close' button in the footer
            document.querySelector('.modal-footer .btn-secondary').addEventListener('click', function () {
                $('#newSalesModal').modal('hide');
            });
        });
    </script>

        <!----Sweet Alert---->
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                @if (session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: '{{ session('success') }}',
                        confirmButtonText: 'OK'
                    });
                @endif
        
                @if (session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '{{ session('error') }}',
                        confirmButtonText: 'Try Again'
                    });
                @endif
            });
        </script> 

</body>
</html>
