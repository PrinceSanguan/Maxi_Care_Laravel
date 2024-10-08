<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receiving System</title>
    <link rel="stylesheet" href="{{asset('css/receiving.css')}}">
    <link rel="icon" href="maxi.jpg">
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
       
                <!-- Button to open the modal -->
    <button class="new-sales-btn btn btn-primary"><i class="fa fa-plus"></i> Receiving</button>
       
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
                        <th>Date Received</th>
                        <th>Expiry Date</th>
                        <th>Amount</th>
                        <th>Supplier</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($receives as $index => $receive)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $receive->created_at ? $receive->created_at->format('F j, Y') : 'N/A' }}</td>
                            <td>{{$receive->reference}}</td>
                            <td>{{$receive->product}}</td>
                            <td>{{$receive->quantity}}</td>
                            <td>{{ $receive->dateReceived->format('F j, Y') }}</td>
                            <td>{{ $receive->expired->format('F j, Y') }}</td>
                            <td>{{$receive->amount}}</td>
                            <td>{{$receive->supplier}}</td>
                            <td>
                                <button class="action-btn edit-btn btn btn-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal"
                                    data-receive-id="{{ $receive->id }}"
                                    data-receive-reference="{{ $receive->reference }}"
                                    data-receive-product="{{ $receive->product }}"
                                    data-receive-quantity="{{ $receive->quantity }}"
                                    data-receive-dateReceived="{{ $receive->dateReceived }}"
                                    data-receive-expired="{{ $receive->expired }}"
                                    data-receive-supplier="{{ $receive->supplier }}"
                                    >
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <form action="{{ route('staff.receive-delete', $receive->id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn btn btn-danger" onclick="return confirm('Are you sure you want to delete this supplier?');">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
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

<!-- Modal -->
<div id="newSalesModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Manage Receiving</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">

                <form method="post" action="{{ route('staff.receive-form') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="category" class="form-label">Supplier</label>
                        <select id="category" name="supplier" class="form-control form-select" required>
                            <option value="" disabled selected>Select a supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->supplier }}">{{ $supplier->supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Product Name</label>
                        <select id="product" name="product" class="form-control form-select" required>
                            <option value="" disabled selected>Select a product</option>
                            @foreach($productNames as $productName)
                                <option value="{{ $productName->productName }}">{{ $productName->productName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Quantity</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" required min="1" oninput="this.value = Math.abs(this.value)">
                    </div>

                    <!-- New Radio Buttons for Stock Type -->
                    <div class="form-check">
                        <label class="form-label">Stock Type</label>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="safetyStock" name="stockType" value="safetyStock" required>
                            <label class="form-check-label" for="safetyStock">
                                Safety Stock
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" id="stockAvailable" name="stockType" value="stockAvailable" required>
                            <label class="form-check-label" for="stockAvailable">
                                Stock Available
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="expiryDate">Date Receive</label>
                        <input type="date" id="dateReceived" name="dateReceived" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="expiryDate">Expiration Date</label>
                        <input type="date" id="expiryDate" name="expired" class="form-control" required>
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Receiving</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{route('staff.receive-update')}}" method="post">
                    @csrf
                    <input type="hidden" id="receiveId" name="receiveId">
                    
                    <div class="mb-3">
                        <label for="receiveSupplier" class="form-label">Supplier</label>
                        <select id="receiveSupplier" name="receiveSupplier" class="form-control form-select" required>
                            <option value="" disabled selected>Select a supplier</option>
                            @foreach($suppliers as $supplier)
                                <option value="{{ $supplier->supplier }}">{{ $supplier->supplier }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Reference</label>
                        <input type="number" class="form-control" id="receiveReference" name="receiveReference" readonly>
                    </div>
                    <div class="mb-3">
                        <label>Product Name</label>
                        <select id="receiveProduct" name="receiveProduct" class="form-control form-select" required>
                            <option value="" disabled selected>Select a Product</option>
                            @foreach($productNames as $productName)
                                <option value="{{ $productName->productName }}">{{ $productName->productName }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label>Quantity</label>
                        <input type="number" class="form-control" id="receiveQuantity" name="receiveQuantity" required>
                    </div>
                    <div class="mb-3">
                        <label>Date Received</label>
                        <input type="date" class="form-control" id="receiveDateReceived" name="receiveDateReceived" required>
                    </div>
                    <div class="mb-3">
                        <label>Expiry date</label>
                        <input type="date" class="form-control" id="receiveExpired" name="receiveExpired" required>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editModal = document.getElementById('editModal');
        
        editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            
            // Extract data-* attributes from the button
            var receiveId = button.getAttribute('data-receive-id');
            var receiveReference = button.getAttribute('data-receive-reference');
            var receiveProduct = button.getAttribute('data-receive-product');
            var receiveQuantity = button.getAttribute('data-receive-quantity');
            var receiveExpired = button.getAttribute('data-receive-expired');
            var receiveDateReceived = button.getAttribute('data-receive-dateReceived');
            var receiveSupplier = button.getAttribute('data-receive-supplier');
            
            // Populate the modal form fields with the data
            editModal.querySelector('#receiveId').value = receiveId;
            editModal.querySelector('#receiveReference').value = receiveReference;
            editModal.querySelector('#receiveProduct').value = receiveProduct;
            editModal.querySelector('#receiveQuantity').value = receiveQuantity;
            editModal.querySelector('#receiveExpired').value = receiveExpired;
            editModal.querySelector('#receiveDateReceived').value = receiveDateReceived;
            editModal.querySelector('#receiveSupplier').value = receiveSupplier;

        });
    });
</script>

    <!----Sweet Alert---->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if(session('success'))
    <script>
        Swal.fire({
            icon: 'success',
            title: '{{ session('success') }}',
            showConfirmButton: true
        });
    </script>
    @endif

    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
                showConfirmButton: true
            });
        </script>
    @endif

    @if($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Validation Errors',
                html: `
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                `,
                showConfirmButton: true
            });
        </script>
    @endif

<script>
    // JavaScript to set the minimum date for the expiration date input
    document.addEventListener('DOMContentLoaded', (event) => {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('expiryDate').setAttribute('min', today);
        document.getElementById('receiveExpired').setAttribute('min', today);
    });
</script>

</body>
</html>
