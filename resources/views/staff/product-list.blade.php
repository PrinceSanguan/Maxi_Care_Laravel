<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List</title>
    <link rel="stylesheet" href="{{asset('css/product-list.css')}}">
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

        <section class="product-section">

            <div class="product-form">

                <form action="{{route('staff.add-medicine')}}" method="post">
                    @csrf
                    <h2>Product form</h2>
                    
                    <div class="mb-3">
                        <label for="category" class="form-label">Category</label>
                        <select id="category" name="category" class="form-control" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->category }}">{{ $category->category }}</option>
                            @endforeach
                        </select>
                    </div>

                    <label for="product-info">Product Information</label>
                    <input type="text" id="product-info" name="product" required>

                    <label for="price">Price</label>
                    <input type="number" id="price" name="price" required>

                    <label for="prescription">Medicine requires Prescription</label>
                    <input type="checkbox" id="prescription" name="prescription">

                    <div class="form-actions">
                        <button type="submit" class="save-btn">Save</button>
                        <button type="button" class="cancel-btn">Cancel</button>
                    </div>
                </form>
                
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
                        @foreach($medicine as $index => $medicines)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $medicines->product }}</td>
                            <td>{{ $medicines->category }}</td>
                            <td>{{ $medicines->price }}</td>
                            <td>
                                <button class="action-btn edit-btn btn btn-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal"
                                    data-medicine-id="{{ $medicines->id }}"
                                    data-medicine-product="{{ $medicines->product }}"
                                    data-medicine-category="{{ $medicines->category }}"
                                    data-medicine-price="{{ $medicines->price }}"
                                    >
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <form action="{{ route('staff.delete-medicine', $medicines->id) }}" method="post" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="action-btn delete-btn btn btn-danger" onclick="return confirm('Are you sure you want to delete this medicine?');">
                                        <i class="fa-solid fa-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </section>
    </div>

        <!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{route('staff.update-medicine')}}" method="post">
                    @csrf
                    <!-- Hidden input to store the supply ID -->
                    <input type="hidden" id="medicineId" name="medicineId">
                    
                    <div class="mb-3">
                        <label for="medicineProduct" class="form-label">Product Information</label>
                        <input type="text" class="form-control" id="medicineProduct" name="medicineProduct" required>
                    </div>

                    <div class="mb-3">
                        <label for="medicineCategory" class="form-label">Category</label>
                        <input type="text" class="form-control" id="medicineCategory" name="medicineCategory" readonly>
                    </div>

                    <div class="mb-3">
                        <label for="medicinePrice" class="form-label">Price</label>
                        <input type="number" class="form-control" id="medicinePrice" name="medicinePrice" required>
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

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editModal = document.getElementById('editModal');
        
        editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            
            // Extract data-* attributes from the button
            var medicineId = button.getAttribute('data-medicine-id');
            var medicineProduct = button.getAttribute('data-medicine-product');
            var medicineCategory = button.getAttribute('data-medicine-category');
            var medicinePrice = button.getAttribute('data-medicine-price');
            
            // Populate the modal form fields with the data
            editModal.querySelector('#medicineId').value = medicineId;
            editModal.querySelector('#medicineProduct').value = medicineProduct;
            editModal.querySelector('#medicineCategory').value = medicineCategory;           ;
            editModal.querySelector('#medicinePrice').value = medicinePrice;
        });
    });
</script>

</body>
</html>
