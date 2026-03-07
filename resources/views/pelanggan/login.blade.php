<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary: #F97316;
            --primary-dark: #EA6B0A;
            --primary-light: #FFF7ED;
            --primary-glow: rgba(249,115,22,0.18);
            --amber: #FBBF24;
            --text-dark: #0F172A;
            --text-mid: #475569;
            --text-light: #94A3B8;
            --white: #FFFFFF;
            --surface: #FAFAF9;
            --border: #E2E8F0;
            --border-focus: #F97316;
            --shadow-card: 0 25px 50px -12px rgba(0,0,0,0.1), 0 0 0 1px rgba(249,115,22,0.06);
            --radius-lg: 20px;
            --radius-md: 12px;
            --radius-sm: 8px;
        }

        html { height: 100%; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #FFF7ED;
            min-height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 32px 16px;
            position: relative;
            overflow-x: hidden;
            overflow-y: auto;
        }

        /* Animated background */
        .bg-layer {
            position: fixed; inset: 0; z-index: 0;
            overflow: hidden; pointer-events: none;
        }
        .bg-orb {
            position: absolute; border-radius: 50%;
            filter: blur(70px); opacity: 0.55;
            animation: floatOrb 8s ease-in-out infinite;
        }
        .bg-orb-1 {
            width: 500px; height: 500px;
            top: -160px; right: -100px;
            background: radial-gradient(circle, #FED7AA, #FB923C44);
            animation-delay: 0s;
        }
        .bg-orb-2 {
            width: 400px; height: 400px;
            bottom: -120px; left: -80px;
            background: radial-gradient(circle, #FDE68A66, #F59E0B33);
            animation-delay: -3s;
        }
        .bg-orb-3 {
            width: 250px; height: 250px;
            top: 40%; left: 30%;
            background: radial-gradient(circle, #FDBA7433, transparent);
            animation-delay: -5s;
        }
        @keyframes floatOrb {
            0%, 100% { transform: translateY(0px) scale(1); }
            50% { transform: translateY(-24px) scale(1.04); }
        }

        /* Grid pattern */
        .bg-grid {
            position: fixed; inset: 0; z-index: 0;
            background-image:
                linear-gradient(rgba(249,115,22,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(249,115,22,0.04) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .wrapper {
            position: relative; z-index: 1;
            width: 100%; max-width: 460px;
        }

        /* Brand top */
        .brand-top {
            text-align: center; margin-bottom: 28px;
            animation: fadeDown 0.7s cubic-bezier(0.16,1,0.3,1) both;
        }
        .brand-pill {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--white); padding: 8px 18px;
            border-radius: 50px; border: 1px solid #FED7AA;
            box-shadow: 0 4px 14px rgba(249,115,22,0.12);
            font-size: 13px; font-weight: 700; color: var(--primary);
            letter-spacing: 0.3px;
        }
        .brand-pill i { font-size: 16px; }

        /* Card */
        .card {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            overflow: hidden;
            box-shadow: var(--shadow-card);
            border: 1px solid rgba(249,115,22,0.1);
            animation: fadeUp 0.7s cubic-bezier(0.16,1,0.3,1) 0.1s both;
        }

        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(24px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Card header */
        .card-header {
            position: relative; padding: 36px 40px 30px;
            background: linear-gradient(135deg, #F97316 0%, #FB923C 50%, #FBBF24 100%);
            overflow: hidden;
        }
        .card-header::before {
            content: ''; position: absolute;
            top: -60px; right: -60px;
            width: 200px; height: 200px;
            background: rgba(255,255,255,0.1);
            border-radius: 50%;
        }
        .card-header::after {
            content: ''; position: absolute;
            bottom: -40px; left: -20px;
            width: 140px; height: 140px;
            background: rgba(255,255,255,0.06);
            border-radius: 50%;
        }
        .header-content { position: relative; z-index: 1; }
        .header-icon-wrap {
            width: 56px; height: 56px;
            background: rgba(255,255,255,0.22);
            border-radius: 16px; border: 1.5px solid rgba(255,255,255,0.35);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px;
            backdrop-filter: blur(4px);
        }
        .header-icon-wrap i { font-size: 24px; color: #fff; }
        .card-header h1 {
            color: #fff; font-size: 23px; font-weight: 800;
            letter-spacing: -0.5px; margin-bottom: 5px;
        }
        .card-header p { color: rgba(255,255,255,0.82); font-size: 13.5px; font-weight: 400; }

        /* Decorative dots */
        .header-dots {
            position: absolute; top: 16px; right: 40px;
            display: flex; flex-direction: column; gap: 5px;
        }
        .header-dots span {
            display: flex; gap: 5px;
        }
        .dot {
            width: 6px; height: 6px;
            background: rgba(255,255,255,0.25);
            border-radius: 50%;
        }

        /* Card body */
        .card-body { padding: 32px 40px 36px; }

        /* Alert */
        .alert {
            border-radius: 11px; padding: 12px 15px; font-size: 13px;
            display: flex; align-items: flex-start; gap: 10px;
            margin-bottom: 20px; font-weight: 500;
            animation: shakeIn 0.4s ease;
        }
        .alert i { font-size: 16px; flex-shrink: 0; margin-top: 0.5px; }
        .alert-error { background: #FEF2F2; border: 1px solid #FECACA; color: #B91C1C; }
        .alert-success { background: #F0FDF4; border: 1px solid #BBF7D0; color: #15803D; }
        @keyframes shakeIn {
            0%, 100% { transform: translateX(0); }
            20% { transform: translateX(-5px); }
            40% { transform: translateX(5px); }
            60% { transform: translateX(-3px); }
            80% { transform: translateX(3px); }
        }

        /* Form */
        .form-group { margin-bottom: 20px; }

        .form-label {
            display: block; font-size: 12.5px; font-weight: 700;
            color: var(--text-dark); margin-bottom: 8px;
            letter-spacing: 0.2px; text-transform: uppercase;
        }

        .input-wrap { position: relative; }

        .input-icon {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-light); font-size: 15px;
            pointer-events: none; transition: color 0.2s;
        }

        .form-input {
            width: 100%; padding: 13px 44px 13px 42px;
            border: 1.5px solid var(--border); border-radius: var(--radius-md);
            font-size: 14px; font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-dark); background: var(--surface);
            transition: all 0.25s ease; outline: none;
            caret-color: var(--primary);
        }
        .form-input::placeholder { color: var(--text-light); }
        .form-input:focus {
            border-color: var(--primary); background: var(--white);
            box-shadow: 0 0 0 4px var(--primary-glow);
        }
        .form-input:focus ~ .input-icon,
        .input-wrap:focus-within .input-icon { color: var(--primary); }

        .toggle-pw {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%); cursor: pointer;
            color: var(--text-light); font-size: 16px; transition: color 0.2s;
            padding: 4px;
        }
        .toggle-pw:hover { color: var(--primary); }

        /* Forgot link */
        .row-meta {
            display: flex; align-items: center;
            justify-content: flex-end; margin-top: -10px; margin-bottom: 22px;
        }
        .forgot-link {
            font-size: 12.5px; color: var(--primary);
            text-decoration: none; font-weight: 600;
            transition: all 0.2s; padding: 2px 0;
            border-bottom: 1px solid transparent;
        }
        .forgot-link:hover { border-bottom-color: var(--primary); }

        /* Submit button */
        .btn-submit {
            width: 100%; padding: 14px;
            background: linear-gradient(135deg, #F97316, #FB923C);
            color: #fff; border: none; border-radius: var(--radius-md);
            font-size: 15px; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.3s ease;
            box-shadow: 0 8px 24px rgba(249,115,22,0.38);
            display: flex; align-items: center; justify-content: center; gap: 9px;
            letter-spacing: 0.1px; position: relative; overflow: hidden;
        }
        .btn-submit::before {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15), transparent);
            opacity: 0; transition: opacity 0.3s;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 14px 32px rgba(249,115,22,0.45); }
        .btn-submit:hover::before { opacity: 1; }
        .btn-submit:active { transform: translateY(0); }
        .btn-submit i { font-size: 17px; }

        /* Divider */
        .divider {
            display: flex; align-items: center; gap: 12px;
            margin: 24px 0; color: var(--text-light); font-size: 12px; font-weight: 500;
        }
        .divider::before, .divider::after {
            content: ''; flex: 1; height: 1px; background: var(--border);
        }

        /* Footer */
        .footer-links { text-align: center; }
        .footer-links p { font-size: 13.5px; color: var(--text-mid); margin-bottom: 12px; }
        .footer-links a { color: var(--primary); font-weight: 700; text-decoration: none; }
        .footer-links a:hover { text-decoration: underline; }

        .admin-btn {
            display: inline-flex; align-items: center; gap: 7px;
            font-size: 12.5px; color: var(--text-mid); font-weight: 500;
            text-decoration: none; padding: 9px 18px;
            background: var(--surface); border-radius: 50px;
            border: 1px solid var(--border); transition: all 0.25s;
        }
        .admin-btn:hover {
            background: var(--primary-light); color: var(--primary);
            border-color: #FED7AA;
            box-shadow: 0 4px 12px rgba(249,115,22,0.12);
        }
        .admin-btn i { font-size: 14px; }

        /* Input filled state */
        .form-input:not(:placeholder-shown) { background: var(--white); }

        /* Floating label animation line */
        .input-line {
            position: absolute; bottom: 0; left: 0;
            height: 2px; width: 0; background: var(--primary);
            border-radius: 2px; transition: width 0.3s ease;
        }
        .form-input:focus ~ .input-line { width: 100%; }
    </style>
</head>
<body>

<div class="bg-layer">
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
    <div class="bg-orb bg-orb-3"></div>
</div>
<div class="bg-grid"></div>

<div class="wrapper">
    <div class="brand-top">
        <div class="brand-pill">
            <i class="bi bi-capsule"></i>
            {{ config('app.name') }}
        </div>
    </div>

    <div class="card">
        <div class="card-header">
            <div class="header-dots">
                <span><div class="dot"></div><div class="dot"></div><div class="dot"></div></span>
                <span><div class="dot"></div><div class="dot"></div><div class="dot"></div></span>
                <span><div class="dot"></div><div class="dot"></div><div class="dot"></div></span>
            </div>
            <div class="header-content">
                <div class="header-icon-wrap">
                    <i class="bi bi-person-circle"></i>
                </div>
                <h1>Selamat Datang</h1>
                <p>Masuk ke akun pelanggan Anda untuk melanjutkan</p>
            </div>
        </div>

        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <form method="POST" action="{{ route('pelanggan.login.submit') }}">
                @csrf

                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="bi bi-envelope" style="margin-right:5px; font-size:11px;"></i>
                        Alamat Email
                    </label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" id="email" name="email" class="form-input"
                               placeholder="nama@email.com" value="{{ old('email') }}" required>
                        <div class="input-line"></div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password">
                        <i class="bi bi-lock" style="margin-right:5px; font-size:11px;"></i>
                        Password
                    </label>
                    <div class="input-wrap">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" id="password" name="password" class="form-input"
                               placeholder="Masukkan password Anda" required>
                        <i class="bi bi-eye-slash toggle-pw" id="togglePw"></i>
                        <div class="input-line"></div>
                    </div>
                </div>

                <div class="row-meta">
                    <a href="{{ route('pelanggan.forgot') }}" class="forgot-link">
                        <i class="bi bi-question-circle" style="margin-right:4px;"></i>Lupa password?
                    </a>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="bi bi-box-arrow-in-right"></i>
                    Masuk Sekarang
                </button>
            </form>

            <div class="divider">atau</div>

            <div class="footer-links">
                <p>Belum punya akun? <a href="{{ route('pelanggan.register') }}">Daftar gratis</a></p>
                <a href="{{ route('login') }}" class="admin-btn">
                    <i class="bi bi-shield-lock"></i>
                    Login sebagai pengelola
                </a>
            </div>

        </div>
    </div>
</div>

<script>
    const togglePw = document.getElementById('togglePw');
    const pwInput  = document.getElementById('password');
    togglePw.addEventListener('click', function () {
        const isHidden = pwInput.type === 'password';
        pwInput.type = isHidden ? 'text' : 'password';
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });

    // Input focus effects
    document.querySelectorAll('.form-input').forEach(input => {
        input.addEventListener('focus', () => {
            input.closest('.input-wrap').querySelector('.input-icon').style.color = '#F97316';
        });
        input.addEventListener('blur', () => {
            if (!input.value) {
                input.closest('.input-wrap').querySelector('.input-icon').style.color = '';
            }
        });
    });
</script>
</body>
</html>