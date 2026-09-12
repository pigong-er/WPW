<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Gong Strak</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/favicon.ico') }}">

    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/libs/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">

    <style>
        /* TEMA BROWN UNTUK LOGIN */
        .login-bg-shape-1, .login-bg-shape-2 {
            background: linear-gradient(135deg, #8D6E63, #D7CCC8) !important;
            opacity: 0.5;
        }
        .login-brand i {
            color: #5D4037 !important;
            animation: none !important;
            transform: none !important;
}
        .btn-login {
            background-color: #5D4037 !important;
            border-color: #5D4037 !important;
        }
        .btn-login:hover {
            background-color: #3E2723 !important;
            border-color: #3E2723 !important;
        }
        .input-icon, .password-toggle-btn i { color: #8D6E63 !important; }
        .custom-checkbox-input:checked {
            background-color: #5D4037 !important;
            border-color: #5D4037 !important;
        }
        .forgot-password-link { color: #5D4037 !important; }
        .login-footer-text a { color: #5D4037 !important; font-weight: bold;}
    </style>
</head>
<body>
    <div class="login-wrapper">
        <div class="login-bg-shape login-bg-shape-1"></div>
        <div class="login-bg-shape login-bg-shape-2"></div>

        <div class="login-card">
            <a href="{{ url('/') }}" class="login-brand text-decoration-none">
                <i class="bi bi-shop"></i>
                <span>Gong Strak</span>
            </a>
            <p class="login-subtitle">Silakan login untuk mengakses dashboard</p>

            <form action="{{ url('/admin') }}" method="GET" id="loginForm" class="needs-validation" novalidate>
                <div class="login-form-group">
                    <label for="email" class="login-form-label">Email Address</label>
                    <div class="login-input-group">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" id="email" class="login-input" placeholder="admin@minimarket.com" required>
                    </div>
                </div>

                <div class="login-form-group">
                    <label for="password" class="login-form-label">Password</label>
                    <div class="login-input-group">
                        <i class="bi bi-shield-lock input-icon"></i>
                        <input type="password" id="password" class="login-input login-input-password" placeholder="••••••••" required>
                        <button type="button" class="password-toggle-btn" id="toggle-password" aria-label="Show password">
                            <i class="bi bi-eye"></i>
                        </button>
                    </div>
                </div>

                <div class="login-options">
                    <label class="custom-control-label">
                        <input type="checkbox" class="custom-checkbox-input" id="rememberMe">
                        <span>Ingat Saya</span>
                    </label>
                </div>

                <button type="submit" class="btn-login" id="btn-submit">
                    <span>Masuk ke Dashboard</span>
                    <i class="bi bi-arrow-right"></i>
                </button>
            </form>
        </div>
    </div>

    <script src="{{ asset('assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/auth.js') }}"></script>
</body>
</html>
