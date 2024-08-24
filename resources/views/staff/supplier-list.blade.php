<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier List</title>
    <link rel="stylesheet" href="{{asset('css/supplier-list.css')}}">
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

        <section class="supplier-form-section">
            <h2>Supplier Form</h2>
            <div class="form-container">

                <form action="{{route('staff.supplier-form')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <label for="supplier-name">Supplier</label>
                        <input type="text" id="supplier-name" name="supplier" required>
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
                <table class="supplier-table table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Supplier Info</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($supply as $index => $supplies)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $supplies->supplier }}, {{ $supplies->email }}, {{ $supplies->product }}</td>
                            <td>
                                <button class="action-btn edit-btn btn btn-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal"
                                    data-supply-id="{{ $supplies->id }}"
                                    data-supplier-name="{{ $supplies->supplier }}"
                                    data-email="{{ $supplies->email }}"
                                    data-product="{{ $supplies->product }}">
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                </button>
                                <form action="{{ route('staff.delete-supplier', $supplies->id) }}" method="post" style="display: inline;">
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
                <form action=" {{ route('staff.update-supplier') }} " method="post">
                    @csrf
                    <!-- Hidden input to store the supply ID -->
                    <input type="hidden" id="supplyId" name="supplyId">
                    
                    <div class="mb-3">
                        <label for="supplierName" class="form-label">Supplier Name</label>
                        <input type="text" class="form-control" id="supplierName" name="supplierName" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="product" class="form-label">Product</label>
                        <input type="text" class="form-control" id="product" name="product" required>
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

  <!-- JavaScript to populate the form fields based on the data attributes -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var editModal = document.getElementById('editModal');
        
        editModal.addEventListener('show.bs.modal', function (event) {
            var button = event.relatedTarget; // Button that triggered the modal
            
            // Extract data-* attributes from the button
            var supplyId = button.getAttribute('data-supply-id');
            var supplierName = button.getAttribute('data-supplier-name');
            var email = button.getAttribute('data-email');
            var product = button.getAttribute('data-product');
            
            // Populate the modal form fields with the data
            editModal.querySelector('#supplyId').value = supplyId;
            editModal.querySelector('#supplierName').value = supplierName;
            editModal.querySelector('#email').value = email;
            editModal.querySelector('#product').value = product;
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
