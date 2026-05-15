<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Maxi-Care — Pharmacy Inventory Management</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="icon" href="{{ asset('images/maxi.jpg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLR3LNmFA08kr4E9I5T9q1z34Vyc5Y5PVBamA5rPQJ" crossorigin="anonymous">

    <meta property="og:title" content="Maxi Health | Pharmacy and Medical Supplies" />
    <meta property="og:image" content="{{ url(asset('images/maxi.jpg')) }}" />
    <meta property="og:url" content="http://maxi-cares.free.nf/" />
    <meta property="og:site_name" content="Maxi Health | Pharmacy and Medical Supplies" />
    <meta property="og:description" content="Maxi Health | Pharmacy and Medical Supplies" />
</head>
<body>
    <div class="page">
        <header class="brand-bar">
            <div class="brand">
                <img src="{{ asset('images/maxi.jpg') }}" alt="Maxi-Care" class="brand-logo">
                <span class="brand-name">Maxi-Care</span>
            </div>
            <span class="brand-tag">Pharmacy Inventory Management</span>
        </header>

        <main class="layout">
            <section class="hero">
                <h1>Pharmacy inventory that just works.</h1>
                <p class="hero-lead">Maxi-Care is a complete management system for small pharmacies — track stock, record sales, manage suppliers, and stay on top of expiries. Built with Laravel, ships ready for MySQL or PostgreSQL.</p>

                <ul class="features">
                    <li><span class="check">✓</span> Live stock with safety-stock alerts</li>
                    <li><span class="check">✓</span> Point-of-sale with daily and monthly totals</li>
                    <li><span class="check">✓</span> Supplier and category management</li>
                    <li><span class="check">✓</span> Expiry tracking with automatic write-off</li>
                </ul>

                <img src="{{ asset('images/flowchart.png') }}" alt="System overview" class="hero-image">
            </section>

            <section class="auth">
                <div class="login-card">
                    <h2>Sign in</h2>
                    <form action="{{ route('login.form') }}" method="post" class="login-form">
                        @csrf
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" name="email" id="email" autocomplete="username">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password" autocomplete="current-password">
                        </div>
                        <button type="submit" class="btn-submit">Login</button>
                    </form>
                </div>

                @if (config('demo.enabled'))
                    <div class="demo-card">
                        <h3>Try the demo</h3>
                        <p class="demo-subhead">Click any role to auto-fill the form.</p>

                        @foreach (config('demo.accounts', []) as $account)
                            <article class="demo-row">
                                <div class="demo-row-head">
                                    <span class="demo-pill">{{ $account['label'] }}</span>
                                </div>
                                <p class="demo-blurb">{{ $account['blurb'] }}</p>

                                <div class="demo-line">
                                    <span class="demo-key">Email</span>
                                    <code class="demo-email">{{ $account['email'] }}</code>
                                </div>

                                <div class="demo-line">
                                    <span class="demo-key">Password</span>
                                    <span class="demo-pass-row">
                                        <span class="demo-pass" id="demo-pass-{{ $loop->index }}" data-shown="0" data-password="{{ $account['password'] }}">••••••</span>
                                        <button type="button" class="demo-icon-btn" data-demo-toggle data-target="demo-pass-{{ $loop->index }}" title="Show/hide password">👁</button>
                                        <button type="button" class="demo-icon-btn" data-demo-copy data-password="{{ $account['password'] }}" title="Copy password">⧉</button>
                                    </span>
                                </div>

                                <button type="button" class="btn-demo-fill" data-demo-fill data-email="{{ $account['email'] }}" data-password="{{ $account['password'] }}">Use this account</button>
                            </article>
                        @endforeach
                    </div>
                @endif
            </section>
        </main>

        <footer class="footer">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>Maxi Health Estore</h3>
                    <ul>
                        <li><a href="#">Order &amp; Payment</a></li>
                        <li><a href="#">Cancellation Policy</a></li>
                        <li><a href="#">Shipping &amp; Delivery</a></li>
                        <li><a href="#">Return &amp; Refund</a></li>
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
                    <h3>Shopping @ Maxi Health</h3>
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
                <img src="{{ asset('images/maxi2.jpg') }}" alt="Maxi Health Logo" class="small-logo">
                <p>&copy; 2024 Maxi Health. All Rights Reserved.</p>
            </div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-QJHtvGhmr9A5eYIAdQ6uv0jNmTg+zxD5y5Wo5M5O0K6+Vi+II1GxikAjwQ76fh0B" crossorigin="anonymous"></script>
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
            document.querySelectorAll('[data-demo-fill]').forEach(btn => {
                btn.addEventListener('click', () => {
                    document.getElementById('email').value = btn.dataset.email;
                    document.getElementById('password').value = btn.dataset.password;
                    document.querySelector('.btn-submit').focus();
                });
            });

            document.querySelectorAll('[data-demo-copy]').forEach(btn => {
                btn.addEventListener('click', async () => {
                    try {
                        await navigator.clipboard.writeText(btn.dataset.password);
                        const original = btn.innerHTML;
                        btn.innerHTML = '✓';
                        setTimeout(() => { btn.innerHTML = original; }, 1200);
                    } catch (e) {}
                });
            });

            document.querySelectorAll('[data-demo-toggle]').forEach(btn => {
                btn.addEventListener('click', () => {
                    const span = document.getElementById(btn.dataset.target);
                    if (!span) return;
                    const shown = span.dataset.shown === '1';
                    span.textContent = shown ? '••••••' : span.dataset.password;
                    span.dataset.shown = shown ? '0' : '1';
                });
            });
        });
    </script>
</body>
</html>
