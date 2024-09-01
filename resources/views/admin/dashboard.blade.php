<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SO Users</title>
    <link rel="stylesheet" href="{{asset('css/dashboard.css')}}">
    <link rel="icon" href="{{asset('images/maxi.jpg')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</head>
<body>

    @include('admin.sidebar')

    <div class="main-content">
        <header class="main-header">
            <h1>Maxi Health Inventory Management System</h1>
            <div class="user-info">
                <i class="fa-solid fa-user"></i>
                <span>Admin</span>
            </div>
        </header>
        <div class="users-section">
            <h2>Staff</h2>
                <button class="btn btn-primary new-user-btn" data-bs-toggle="modal" data-bs-target="#newUserModal">+ New Staff</button>
                <table class="user-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Email</th>
                            <th>Username</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staff as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->username }}</td> <!-- Assuming you have a 'username' field in your User model -->
                                <td>
                                    <button class="action-btn edit-btn btn btn-primary" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#editModal"
                                    data-user-id="{{$user->id}}"
                                    data-user-username="{{$user->username}}"
                                    data-user-email="{{$user->email}}"
                                    >
                                    <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.delete.user', $user->id) }}" method="post" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="action-btn delete-btn btn btn-danger" onclick="return confirm('Are you sure you want to delete this staff?');">
                                            <i class="fa-solid fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
        </div>
        
       
    
    <footer class="footer">
        <div class="footer-logo">
            <img src="{{asset('images/maxi2.jpg')}}" alt="Maxi Health Logo" class="small-logo">
            <p>&copy; 2024 Maxi Health. All Rights Reserved.</p>
        </div>
    </footer>

    <!-- Edit Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Edit Staff</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action=" {{ route('admin.edit.user') }} " method="post">
                    @csrf
                    <!-- Hidden input to store the supply ID -->
                    <input type="hidden" id="userId" name="userId">
                    
                    <div class="mb-3">
                        <label class="form-label">Staff Name</label>
                        <input type="text" class="form-control" id="userUserName" name="userUserName" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" class="form-control" id="userEmail" name="userEmail" required>
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


    <!-- New User Modal -->
<div class="modal fade" id="newUserModal" tabindex="-1" aria-labelledby="newUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newUserModalLabel">Add New User</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <form action="{{route('admin.new.user')}}" method="post" id="newUserForm">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" id="username" name="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" form="newUserForm">Add User</button>
            </div>
        </div>
    </div>
</div>

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
            var userId = button.getAttribute('data-user-id');
            var userUserName = button.getAttribute('data-user-username');
            var userEmail = button.getAttribute('data-user-email');
            
            // Populate the modal form fields with the data
            editModal.querySelector('#userId').value = userId;
            editModal.querySelector('#userUserName').value = userUserName;
            editModal.querySelector('#userEmail').value = userEmail;
        });
    });
</script>

</body>
</html>
