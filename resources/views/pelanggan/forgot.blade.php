<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary: #F97316;
            --primary-glow: rgba(249,115,22,0.16);
            --primary-light: #FFF7ED;
            --text-dark: #0F172A;
            --text-mid: #475569;
            --text-light: #94A3B8;
            --white: #FFFFFF;
            --surface: #FAFAF9;
            --border: #E2E8F0;
        }

        html { height: 100%; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #FFF7ED;
            min-height: 100%;
            display: flex; align-items: center; justify-content: center;
            padding: 32px 16px;
            overflow-x: hidden; overflow-y: auto;
            position: relative;
        }

        /* Background */
        .bg-layer { position: fixed; inset: 0; z-index: 0; overflow: hidden; pointer-events: none; }
        .bg-orb {
            position: absolute; border-radius: 50%;
            filter: blur(70px); opacity: 0.5;
            animation: floatOrb 9s ease-in-out infinite;
        }
        .bg-orb-1 {
            width: 480px; height: 480px; top: -140px; right: -100px;
            background: radial-gradient(circle, #FED7AA, #FB923C44);
        }
        .bg-orb-2 {
            width: 380px; height: 380px; bottom: -110px; left: -80px;
            background: radial-gradient(circle, #FDE68A55, #F59E0B33);
            animation-delay: -4s;
        }
        @keyframes floatOrb {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-20px); }
        }

        .bg-grid {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background-image:
                linear-gradient(rgba(249,115,22,0.04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(249,115,22,0.04) 1px, transparent 1px);
            background-size: 40px 40px;
        }

        .wrapper {
            width: 100%; max-width: 460px;
            position: relative; z-index: 1;
        }

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
        }

        @keyframes fadeDown { from { opacity:0; transform:translateY(-16px); } to { opacity:1; transform:translateY(0); } }
        @keyframes fadeUp { from { opacity:0; transform:translateY(24px); } to { opacity:1; transform:translateY(0); } }

        .card {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(20px);
            border-radius: 24px; overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0,0,0,0.1), 0 0 0 1px rgba(249,115,22,0.06);
            border: 1px solid rgba(249,115,22,0.1);
            animation: fadeUp 0.7s cubic-bezier(0.16,1,0.3,1) 0.1s both;
        }

        /* Header */
        .card-header {
            background: linear-gradient(135deg, #F97316, #FB923C 60%, #FBBF24);
            padding: 36px 40px 30px; position: relative; overflow: hidden;
        }
        .card-header::before {
            content: ''; position: absolute;
            top: -60px; right: -60px; width: 200px; height: 200px;
            background: rgba(255,255,255,0.1); border-radius: 50%;
        }
        .card-header::after {
            content: ''; position: absolute;
            bottom: -40px; left: -20px; width: 140px; height: 140px;
            background: rgba(255,255,255,0.06); border-radius: 50%;
        }

        .header-content { position: relative; z-index: 1; }

        .header-icon-wrap {
            width: 56px; height: 56px;
            background: rgba(255,255,255,0.22);
            border-radius: 16px; border: 1.5px solid rgba(255,255,255,0.35);
            display: flex; align-items: center; justify-content: center;
            margin-bottom: 16px; backdrop-filter: blur(4px);
        }
        .header-icon-wrap i { font-size: 24px; color: #fff; }

        .card-header h1 { color: #fff; font-size: 22px; font-weight: 800; letter-spacing: -0.5px; margin-bottom: 5px; }
        .card-header p { color: rgba(255,255,255,0.82); font-size: 13.5px; }

        .header-dots {
            position: absolute; top: 16px; right: 40px;
            display: flex; flex-direction: column; gap: 5px; z-index: 1;
        }
        .header-dots span { display: flex; gap: 5px; }
        .dot { width: 6px; height: 6px; background: rgba(255,255,255,0.22); border-radius: 50%; }

        /* Steps visual */
        .how-steps {
            display: flex; gap: 8px; margin: 24px 0;
        }
        .how-step {
            flex: 1; background: #FFFBF7; border: 1px solid #FED7AA;
            border-radius: 12px; padding: 14px 10px; text-align: center;
            transition: all 0.25s;
        }
        .how-step:hover { background: var(--primary-light); transform: translateY(-2px); box-shadow: 0 4px 12px rgba(249,115,22,0.12); }
        .how-step .step-num {
            width: 28px; height: 28px; border-radius: 8px;
            background: linear-gradient(135deg, #F97316, #FB923C);
            color: #fff; font-size: 12px; font-weight: 700;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 8px;
        }
        .how-step i { font-size: 20px; color: var(--primary); display: block; margin-bottom: 6px; }
        .how-step p { font-size: 11px; color: var(--text-mid); font-weight: 600; line-height: 1.4; }

        /* Card body */
        .card-body { padding: 30px 40px 36px; }

        /* Alert */
        .alert {
            border-radius: 11px; padding: 12px 15px; font-size: 13px;
            display: flex; align-items: flex-start; gap: 10px;
            margin-bottom: 20px; font-weight: 500;
        }
        .alert i { font-size: 16px; flex-shrink: 0; }
        .alert-error { background: #FEF2F2; border: 1px solid #FECACA; color: #B91C1C; }
        .alert-success {
            background: #F0FDF4; border: 1px solid #BBF7D0; color: #15803D;
            animation: successPulse 0.5s ease;
        }
        @keyframes successPulse {
            0% { transform: scale(0.97); }
            50% { transform: scale(1.01); }
            100% { transform: scale(1); }
        }

        .info-banner {
            display: flex; gap: 12px; align-items: flex-start;
            background: var(--primary-light); border: 1px solid #FED7AA;
            border-left: 4px solid var(--primary);
            border-radius: 12px; padding: 14px 16px; margin-bottom: 22px;
        }
        .info-banner i { font-size: 18px; color: var(--primary); flex-shrink: 0; margin-top: 1px; }
        .info-banner p { font-size: 13px; color: var(--text-mid); line-height: 1.6; }
        .info-banner strong { color: var(--text-dark); }

        /* Form */
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block; font-size: 12px; font-weight: 700;
            color: var(--text-dark); margin-bottom: 8px;
            text-transform: uppercase; letter-spacing: 0.3px;
        }
        .input-wrap { position: relative; }
        .input-icon {
            position: absolute; left: 14px; top: 50%;
            transform: translateY(-50%); color: var(--text-light);
            font-size: 15px; pointer-events: none; transition: color 0.25s;
        }
        .form-input {
            width: 100%; padding: 13px 14px 13px 42px;
            border: 1.5px solid var(--border); border-radius: 12px;
            font-size: 14px; font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-dark); background: var(--surface);
            transition: all 0.25s; outline: none; caret-color: var(--primary);
        }
        .form-input::placeholder { color: var(--text-light); }
        .form-input:focus {
            border-color: var(--primary); background: var(--white);
            box-shadow: 0 0 0 4px var(--primary-glow);
        }
        .form-input:focus + .input-icon { color: var(--primary); }

        /* Submit */
        .btn-submit {
            width: 100%; padding: 14px;
            background: linear-gradient(135deg, #F97316, #FB923C);
            color: #fff; border: none; border-radius: 12px;
            font-size: 15px; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.3s;
            box-shadow: 0 8px 24px rgba(249,115,22,0.38);
            display: flex; align-items: center; justify-content: center; gap: 9px;
            position: relative; overflow: hidden;
        }
        .btn-submit::after {
            content: ''; position: absolute; inset: 0;
            background: rgba(255,255,255,0.12); opacity: 0; transition: opacity 0.3s;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 14px 32px rgba(249,115,22,0.45); }
        .btn-submit:hover::after { opacity: 1; }
        .btn-submit i { font-size: 17px; }

        .back-link {
            display: flex; align-items: center; justify-content: center;
            gap: 7px; margin-top: 20px;
            font-size: 13.5px; color: var(--text-light);
            text-decoration: none; font-weight: 500;
            transition: color 0.2s;
        }
        .back-link:hover { color: var(--primary); }
        .back-link i { font-size: 15px; }
    </style>
</head>
<body>

<div class="bg-layer">
    <div class="bg-orb bg-orb-1"></div>
    <div class="bg-orb bg-orb-2"></div>
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
            </div>
            <div class="header-content">
                <div class="header-icon-wrap">
                    <i class="bi bi-key-fill"></i>
                </div>
                <h1>Lupa Password?</h1>
                <p>Kami akan bantu pulihkan akses akun Anda</p>
            </div>
        </div>

        <div class="card-body">

            <div class="how-steps">
                <div class="how-step">
                    <i class="bi bi-envelope-at"></i>
                    <p>Masukkan Email</p>
                </div>
                <div class="how-step">
                    <i class="bi bi-inbox-fill"></i>
                    <p>Cek Inbox Email</p>
                </div>
                <div class="how-step">
                    <i class="bi bi-shield-check"></i>
                    <p>Buat Password Baru</p>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <div class="info-banner">
                <i class="bi bi-info-circle-fill"></i>
                <p>Masukkan <strong>alamat email</strong> yang terdaftar. Kami akan mengirimkan link untuk membuat password baru ke inbox Anda.</p>
            </div>

            <form method="POST" action="{{ route('pelanggan.forgot.submit') }}">
                @csrf
                <div class="form-group">
                    <label class="form-label" for="email">
                        <i class="bi bi-envelope" style="margin-right:5px; font-size:11px;"></i>
                        Alamat Email Terdaftar
                    </label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope input-icon"></i>
                        <input type="email" id="email" name="email" class="form-input"
                               placeholder="nama@email.com" value="{{ old('email') }}" required>
                    </div>
                </div>

                <button type="submit" class="btn-submit">
                    <i class="bi bi-send-fill"></i>
                    Kirim Link Reset Password
                </button>
            </form>

            <a href="{{ route('pelanggan.login') }}" class="back-link">
                <i class="bi bi-arrow-left-circle"></i>
                Kembali ke halaman login
            </a>

        </div>
    </div>
</div>

</body>
</html>