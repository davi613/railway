<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Apotek Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        * {
            font-family: 'Poppins', sans-serif;
        }

        body {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(135deg, #ffecd2, #fcb69f);
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
        }

        /* Animasi background elements yang smooth dan profesional */
        body::before {
            content: '';
            position: absolute;
            width: 200px;
            height: 200px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            top: 10%;
            left: 5%;
            animation: floatBubble 8s ease-in-out infinite;
        }

        body::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 50%;
            bottom: 10%;
            right: 5%;
            animation: floatBubble 10s ease-in-out infinite reverse;
        }

        @keyframes floatBubble {
            0%, 100% {
                transform: translate(0, 0) scale(1);
            }
            50% {
                transform: translate(20px, -20px) scale(1.1);
            }
        }

        .login-box {
            background: #fff;
            border-radius: 1rem;
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.15);
            max-width: 420px;
            width: 100%;
            padding: 2.5rem;
            animation: slideIn 0.5s ease;
            position: relative;
            z-index: 1;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .login-box:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 35px rgba(0, 0, 0, 0.2);
        }

        @keyframes slideIn {
            from {
                transform: translateY(30px);
                opacity: 0;
            }
            to {
                transform: translateY(0);
                opacity: 1;
            }
        }

        .login-box .icon {
            width: 70px;
            margin-bottom: 15px;
            animation: gentlePulse 2s ease-in-out infinite;
        }

        @keyframes gentlePulse {
            0%, 100% {
                transform: scale(1);
            }
            50% {
                transform: scale(1.05);
            }
        }

        .login-box h2 {
            font-weight: 600;
            color: #e67e22;
        }

        .login-box p {
            color: #555;
            font-size: 0.9rem;
        }

        .form-label {
            font-weight: 500;
        }

        .form-control {
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #e67e22;
            box-shadow: 0 0 0 0.2rem rgba(230, 126, 34, 0.25);
            transform: scale(1.02);
        }

        /* Password wrapper styling */
        .password-wrapper {
            position: relative;
            width: 100%;
        }

        .password-wrapper .form-control {
            padding-right: 45px;
        }

        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            cursor: pointer;
            color: #e67e22;
            font-size: 1.1rem;
            padding: 5px;
            transition: all 0.3s ease;
            z-index: 10;
        }

        .password-toggle:hover {
            color: #cf711f;
            transform: translateY(-50%) scale(1.1);
        }

        .password-toggle:active {
            transform: translateY(-50%) scale(0.95);
        }

        .btn-login {
            background: #e67e22;
            color: white;
            font-weight: 500;
            border: none;
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-login:hover {
            background: #cf711f;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(230, 126, 34, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        /* Loading animation untuk button */
        .btn-login.loading {
            pointer-events: none;
            opacity: 0.8;
        }

        .btn-login.loading::after {
            content: '';
            position: absolute;
            width: 20px;
            height: 20px;
            top: 50%;
            left: 50%;
            margin-left: -10px;
            margin-top: -10px;
            border: 2px solid rgba(255, 255, 255, 0.3);
            border-top-color: white;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }

        @keyframes spin {
            to { transform: rotate(360deg); }
        }

        .forgot-link {
            font-size: 0.85rem;
            color: #e67e22;
            transition: all 0.3s ease;
            display: inline-block;
        }

        .forgot-link:hover {
            color: #cf711f;
            transform: translateX(3px);
            text-decoration: underline;
        }

        .remember-me {
            font-size: 0.9rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .remember-me:hover {
            color: #e67e22;
        }

        /* Animasi untuk error message */
        .invalid-feedback {
            animation: shake 0.4s ease;
        }

        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-5px); }
            75% { transform: translateX(5px); }
        }

        /* Smooth transition untuk semua interactive elements */
        .form-control, .btn-login, .password-toggle, .forgot-link, .remember-me {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
    </style>
</head>
<body>

<div class="login-box text-center">
    <img src="https://cdn-icons-png.flaticon.com/512/4298/4298892.png" alt="Obat Icon" class="icon">
    <h2>Selamat Datang</h2>
    <p>Silakan login untuk melanjutkan ke sistem Apotek Online</p>

    <form method="POST" action="{{ route('login') }}" id="loginForm">
        @csrf

        <div class="mb-3 text-start">
            <label for="email" class="form-label">{{ __('Email Address') }}</label>
            <input id="email" type="email"
                   class="form-control @error('email') is-invalid @enderror"
                   name="email" value="{{ old('email') }}" required autofocus>

            @error('email')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3 text-start">
            <label for="password" class="form-label">{{ __('Password') }}</label>
            <div class="password-wrapper">
                <input id="password" type="password"
                       class="form-control @error('password') is-invalid @enderror"
                       name="password" required>
                <button type="button" class="password-toggle" id="togglePassword" aria-label="Toggle password visibility">
                    <i class="fas fa-eye-slash"></i>
                </button>
            </div>

            @error('password')
            <div class="invalid-feedback">
                {{ $message }}
            </div>
            @enderror
        </div>

        <div class="mb-3 form-check text-start">
            <input class="form-check-input" type="checkbox" name="remember" id="remember"
                   {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label remember-me" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>

        <div class="d-grid mb-3">
            <button type="submit" class="btn btn-login" id="loginButton">
                {{ __('Login') }}
            </button>
        </div>
        <div class="d-grid mb-3">
            
                <a class="btn btn-login" href="{{ route('pelanggan.login') }}">Kembali Ke Login Pelanggan</a>
        
        </div>

        @if (Route::has('password.request'))
            <div class="text-center">
                <a class="forgot-link" href="{{ route('password.request') }}">
                    {{ __('Forgot Your Password?') }}
                </a>
            </div>
        @endif
    </form>
</div>

<script>
    (function() {
        // Password toggle functionality - FIXED: mata terbuka untuk melihat, mata tertutup untuk menyembunyikan
        const togglePassword = document.getElementById('togglePassword');
        const passwordInput = document.getElementById('password');
        
        if (togglePassword && passwordInput) {
            togglePassword.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Get current icon
                const icon = this.querySelector('i');
                
                // Check current password type
                const isPassword = passwordInput.getAttribute('type') === 'password';
                
                if (isPassword) {
                    // Change to text type to SHOW password (mata terbuka)
                    passwordInput.setAttribute('type', 'text');
                    // Change icon to open eye (mata terbuka - menunjukkan password terlihat)
                    if (icon) {
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                } else {
                    // Change to password type to HIDE password (mata tertutup)
                    passwordInput.setAttribute('type', 'password');
                    // Change icon to closed eye (mata tertutup - menunjukkan password tersembunyi)
                    if (icon) {
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    }
                }
                
                // Add animation feedback
                this.style.transform = 'translateY(-50%) scale(1.1)';
                setTimeout(() => {
                    if (this) {
                        this.style.transform = 'translateY(-50%) scale(1)';
                    }
                }, 200);
                
                // Focus back on input
                passwordInput.focus();
            });
        }
        
        // Add loading animation to login button saat submit
        const loginForm = document.getElementById('loginForm');
        const loginButton = document.getElementById('loginButton');
        const originalButtonText = loginButton ? loginButton.innerHTML : '';
        
        if (loginForm && loginButton) {
            loginForm.addEventListener('submit', function() {
                loginButton.classList.add('loading');
                loginButton.innerHTML = '{{ __("Logging in...") }}';
            });
        }
        
        // Add focus animation for inputs
        const inputs = document.querySelectorAll('.form-control');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.style.transform = 'scale(1)';
            });
        });
        
        // Add ripple effect untuk tombol
        const buttons = document.querySelectorAll('.btn-login');
        buttons.forEach(button => {
            button.addEventListener('click', function(e) {
                if (this.classList.contains('loading')) return;
                
                const ripple = document.createElement('span');
                ripple.style.position = 'absolute';
                ripple.style.borderRadius = '50%';
                ripple.style.backgroundColor = 'rgba(255, 255, 255, 0.4)';
                ripple.style.pointerEvents = 'none';
                ripple.style.transform = 'scale(0)';
                ripple.style.transition = 'transform 0.5s ease-out';
                ripple.style.width = '100px';
                ripple.style.height = '100px';
                
                const rect = this.getBoundingClientRect();
                const x = e.clientX - rect.left - 50;
                const y = e.clientY - rect.top - 50;
                
                ripple.style.left = x + 'px';
                ripple.style.top = y + 'px';
                
                this.style.position = 'relative';
                this.style.overflow = 'hidden';
                this.appendChild(ripple);
                
                setTimeout(() => {
                    ripple.style.transform = 'scale(2)';
                    ripple.style.opacity = '0';
                }, 10);
                
                setTimeout(() => {
                    ripple.remove();
                }, 500);
            });
        });
        
        // Hover effect yang smooth untuk password toggle
        if (togglePassword) {
            togglePassword.addEventListener('mouseenter', function() {
                this.style.color = '#cf711f';
            });
            
            togglePassword.addEventListener('mouseleave', function() {
                this.style.color = '#e67e22';
            });
        }
        
        // Tooltip untuk password toggle (optional enhancement)
        if (togglePassword) {
            let tooltipTimeout;
            togglePassword.addEventListener('mouseenter', function() {
                const tooltip = document.createElement('div');
                tooltip.textContent = 'Lihat/Sembunyikan password';
                tooltip.style.position = 'absolute';
                tooltip.style.right = '45px';
                tooltip.style.top = '50%';
                tooltip.style.transform = 'translateY(-50%)';
                tooltip.style.backgroundColor = '#e67e22';
                tooltip.style.color = 'white';
                tooltip.style.padding = '4px 8px';
                tooltip.style.borderRadius = '6px';
                tooltip.style.fontSize = '11px';
                tooltip.style.whiteSpace = 'nowrap';
                tooltip.style.zIndex = '100';
                tooltip.style.opacity = '0';
                tooltip.style.transition = 'opacity 0.2s ease';
                tooltip.classList.add('password-tooltip');
                
                this.parentElement.appendChild(tooltip);
                
                setTimeout(() => {
                    tooltip.style.opacity = '1';
                }, 10);
                
                tooltipTimeout = setTimeout(() => {
                    tooltip.style.opacity = '0';
                    setTimeout(() => tooltip.remove(), 200);
                }, 2000);
            });
            
            togglePassword.addEventListener('mouseleave', function() {
                const tooltip = this.parentElement.querySelector('.password-tooltip');
                if (tooltip) {
                    tooltip.style.opacity = '0';
                    setTimeout(() => tooltip.remove(), 200);
                }
                if (tooltipTimeout) clearTimeout(tooltipTimeout);
            });
        }
    })();
</script>

</body>
</html>

{{-- //LOGIN VER LAMA// --}}

{{-- //LOGIN VER LAMA// --}}