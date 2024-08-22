<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maxi Health - Sign In</title>
    <link rel="stylesheet" href="{{asset('css/login.css')}}">
    <link rel="icon" href="maxi.jpg" >
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLR3LNmFA08kr4E9I5T9q1z34Vyc5Y5PVBamA5rPQJ" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{asset('images/maxi.jpg')}}" alt="Maxi Health Logo" class="logo">

            <div class="form-container">

                <form action="{{route('login.form')}}" method="post" class="login-form">
                    @csrf
             
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" >
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" >
                    </div>
                    <button type="submit" class="btn-submit">Login</button>
                    {{-- <p>Already have an account? <a href="{{route('signup')}}">Create Account</a></p> --}}
                </form>
            </div>
        </div>

        <footer class="footer">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Maxi Health Estore</h3>
                    <ul>
                        <li><a href="#">Order & Payment</a></li>
                        <li><a href="#">Cancellation Policy</a></li>
                        <li><a href="#">Shipping & Delivery</a></li>
                        <li><a href="#">Return & Refund</a></li>
                        <li><a href="#">Senior Citizen / PWD Discount</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>About Us</h3>
                    <ul>
                        <li><a href="#">Who We Are</a></li>
                        <li><a href="#">Maxi Health Brand</a></li>
                        <li><a href="#">Sustainability</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Shopping @Maxi Health</h3>
                    <ul>
                        <li><a href="#">Our Stores</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Legal</h3>
                    <ul>
                        <li><a href="#">Terms of Use</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                    </ul>
                </div>
                
            </div>
            <div class="footer-logo">
                <img src="{{asset('images/maxi2.jpg')}}" alt="Maxi Health Logo" class="small-logo">
                <p>&copy; 2024 Maxi Health. All Rights Reserved.</p>
            </div>
        </footer>


        <!-- Bootstrap Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-QJHtvGhmr9A5eYIAdQ6uv0jNmTg+zxD5y5Wo5M5O0K6+Vi+II1GxikAjwQ76fh0B" crossorigin="anonymous"></script>

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
