<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login - Apotek Online</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

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

        .form-control:focus {
            border-color: #e67e22;
            box-shadow: 0 0 0 0.2rem rgba(230, 126, 34, 0.25);
        }

        .btn-login {
            background: #e67e22;
            color: white;
            font-weight: 500;
            border: none;
        }

        .btn-login:hover {
            background: #cf711f;
        }

        .forgot-link {
            font-size: 0.85rem;
            color: #e67e22;
        }

        .forgot-link:hover {
            text-decoration: underline;
        }

        .remember-me {
            font-size: 0.9rem;
        }
    </style>
</head>
<body>

<div class="login-box text-center">
    <img src="https://cdn-icons-png.flaticon.com/512/4298/4298892.png" alt="Obat Icon" class="icon">
    <h2>Selamat Datang</h2>
    <p>Silakan login untuk melanjutkan ke sistem Apotek Online</p>

    <form method="POST" action="{{ route('login') }}">
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
            <input id="password" type="password"
                   class="form-control @error('password') is-invalid @enderror"
                   name="password" required>

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
            <button type="submit" class="btn btn-login">
                {{ __('Login') }}
            </button>
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

</body>
</html>

{{-- //LOGIN VER LAMA// --}}

{{-- //LOGIN VER LAMA// --}}
