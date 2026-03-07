<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Password Baru — {{ config('app.name') }}</title>
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
            width: 100%; padding: 13px 44px 13px 42px;
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

        .toggle-pw {
            position: absolute; right: 14px; top: 50%;
            transform: translateY(-50%); cursor: pointer;
            color: var(--text-light); font-size: 16px; transition: color 0.2s;
        }
        .toggle-pw:hover { color: var(--primary); }

        /* Password strength */
        .strength-section { margin-top: 10px; }
        .strength-bars {
            display: flex; gap: 5px; margin-bottom: 6px;
        }
        .strength-bar-seg {
            flex: 1; height: 4px; border-radius: 4px;
            background: var(--border); transition: background 0.4s, transform 0.2s;
        }
        .strength-bar-seg.active { transform: scaleY(1.3); }
        .strength-label {
            display: flex; align-items: center; gap: 7px;
            font-size: 12px; font-weight: 600; color: var(--text-light);
        }
        .strength-label i { font-size: 13px; }

        /* Password match */
        .match-row {
            display: flex; align-items: center; gap: 7px;
            font-size: 12px; font-weight: 600; margin-top: 8px;
        }
        .match-row i { font-size: 14px; }

        /* Requirements checklist */
        .req-list {
            background: var(--surface); border: 1px solid var(--border);
            border-radius: 12px; padding: 14px 16px; margin-bottom: 22px;
        }
        .req-list p {
            font-size: 12px; font-weight: 700; color: var(--text-mid);
            margin-bottom: 10px; text-transform: uppercase; letter-spacing: 0.3px;
        }
        .req-item {
            display: flex; align-items: center; gap: 9px;
            font-size: 12.5px; color: var(--text-light);
            margin-bottom: 6px; transition: color 0.3s;
        }
        .req-item:last-child { margin-bottom: 0; }
        .req-item i { font-size: 14px; transition: color 0.3s; }
        .req-item.met { color: #16A34A; }
        .req-item.met i { color: #16A34A; }

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
        .btn-submit:disabled {
            opacity: 0.5; cursor: not-allowed; transform: none;
            box-shadow: 0 4px 12px rgba(249,115,22,0.2);
        }
        .btn-submit i { font-size: 17px; }

        .back-link {
            display: flex; align-items: center; justify-content: center;
            gap: 7px; margin-top: 20px;
            font-size: 13.5px; color: var(--text-light);
            text-decoration: none; font-weight: 500; transition: color 0.2s;
        }
        .back-link:hover { color: var(--primary); }
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
                    <i class="bi bi-shield-lock-fill"></i>
                </div>
                <h1>Password Baru</h1>
                <p>Buat password yang kuat dan mudah diingat</p>
            </div>
        </div>

        <div class="card-body">

            @if($errors->any())
                <div class="alert alert-error">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ $errors->first() }}</span>
                </div>
            @endif

            <!-- Requirements -->
            <div class="req-list">
                <p><i class="bi bi-list-check" style="margin-right:5px;"></i> Syarat Password</p>
                <div class="req-item" id="req-length">
                    <i class="bi bi-circle"></i> Minimal 8 karakter
                </div>
                <div class="req-item" id="req-upper">
                    <i class="bi bi-circle"></i> Mengandung huruf besar (A-Z)
                </div>
                <div class="req-item" id="req-number">
                    <i class="bi bi-circle"></i> Mengandung angka (0-9)
                </div>
                <div class="req-item" id="req-symbol">
                    <i class="bi bi-circle"></i> Mengandung simbol (!@#$...)
                </div>
            </div>

            <form method="POST" action="{{ route('pelanggan.reset.submit') }}">
                @csrf
                <input type="hidden" name="token" value="{{ $token }}">
                <input type="hidden" name="email" value="{{ $email }}">

                <div class="form-group">
                    <label class="form-label" for="password">
                        <i class="bi bi-lock" style="margin-right:5px; font-size:11px;"></i>
                        Password Baru
                    </label>
                    <div class="input-wrap">
                        <i class="bi bi-lock input-icon"></i>
                        <input type="password" id="password" name="password"
                               class="form-input" placeholder="Buat password baru"
                               oninput="checkAll()" required>
                        <i class="bi bi-eye-slash toggle-pw" onclick="togglePw('password', this)"></i>
                    </div>
                    <!-- Strength meter -->
                    <div class="strength-section">
                        <div class="strength-bars">
                            <div class="strength-bar-seg" id="seg1"></div>
                            <div class="strength-bar-seg" id="seg2"></div>
                            <div class="strength-bar-seg" id="seg3"></div>
                            <div class="strength-bar-seg" id="seg4"></div>
                        </div>
                        <div class="strength-label" id="strengthLabel">
                            <i class="bi bi-circle" style="color: #CBD5E1;"></i>
                            <span style="color: #CBD5E1;">Belum diisi</span>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label class="form-label" for="password_confirmation">
                        <i class="bi bi-lock-fill" style="margin-right:5px; font-size:11px;"></i>
                        Konfirmasi Password Baru
                    </label>
                    <div class="input-wrap">
                        <i class="bi bi-lock-fill input-icon"></i>
                        <input type="password" id="password_confirmation" name="password_confirmation"
                               class="form-input" placeholder="Ulangi password baru"
                               oninput="checkAll()" required>
                        <i class="bi bi-eye-slash toggle-pw" onclick="togglePw('password_confirmation', this)"></i>
                    </div>
                    <div class="match-row" id="matchRow" style="color: #CBD5E1;">
                        <i class="bi bi-circle" id="matchIcon"></i>
                        <span id="matchText">Belum diisi</span>
                    </div>
                </div>

                <button type="submit" class="btn-submit" id="submitBtn" disabled>
                    <i class="bi bi-shield-check-fill"></i>
                    Simpan Password Baru
                </button>
            </form>

            <a href="{{ route('pelanggan.login') }}" class="back-link">
                <i class="bi bi-arrow-left-circle"></i>
                Kembali ke halaman login
            </a>

        </div>
    </div>
</div>

<script>
    function togglePw(id, icon) {
        const input = document.getElementById(id);
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    }

    const strengthConfig = [
        { color: '#EF4444', label: 'Sangat Lemah', icon: 'bi-x-circle-fill' },
        { color: '#F97316', label: 'Lemah', icon: 'bi-dash-circle-fill' },
        { color: '#EAB308', label: 'Sedang', icon: 'bi-exclamation-circle-fill' },
        { color: '#22C55E', label: 'Kuat', icon: 'bi-check-circle-fill' },
    ];

    function checkAll() {
        const pw  = document.getElementById('password').value;
        const cfm = document.getElementById('password_confirmation').value;

        // Requirements
        const reqs = {
            'req-length': pw.length >= 8,
            'req-upper':  /[A-Z]/.test(pw),
            'req-number': /[0-9]/.test(pw),
            'req-symbol': /[^A-Za-z0-9]/.test(pw),
        };

        let score = 0;
        Object.entries(reqs).forEach(([id, met]) => {
            const el = document.getElementById(id);
            const icon = el.querySelector('i');
            if (met) {
                el.classList.add('met');
                icon.className = 'bi bi-check-circle-fill';
                score++;
            } else {
                el.classList.remove('met');
                icon.className = 'bi bi-circle';
            }
        });

        // Strength bars
        const colors = ['#EF4444','#F97316','#EAB308','#22C55E'];
        ['seg1','seg2','seg3','seg4'].forEach((sid, idx) => {
            const seg = document.getElementById(sid);
            if (pw.length === 0) {
                seg.style.background = '#E2E8F0';
                seg.classList.remove('active');
            } else if (idx < score) {
                seg.style.background = colors[score - 1];
                seg.classList.add('active');
            } else {
                seg.style.background = '#E2E8F0';
                seg.classList.remove('active');
            }
        });

        // Strength label
        const lbl = document.getElementById('strengthLabel');
        if (pw.length === 0) {
            lbl.innerHTML = '<i class="bi bi-circle" style="color:#CBD5E1;"></i> <span style="color:#CBD5E1;">Belum diisi</span>';
        } else {
            const cfg = strengthConfig[score - 1] || strengthConfig[0];
            lbl.innerHTML = `<i class="bi ${cfg.icon}" style="color:${cfg.color};"></i> <span style="color:${cfg.color};">${cfg.label}</span>`;
        }

        // Match indicator
        const matchRow  = document.getElementById('matchRow');
        const matchIcon = document.getElementById('matchIcon');
        const matchText = document.getElementById('matchText');
        let matched = false;
        if (!cfm) {
            matchRow.style.color = '#CBD5E1';
            matchIcon.className = 'bi bi-circle';
            matchText.textContent = 'Belum diisi';
        } else if (pw === cfm) {
            matchRow.style.color = '#16A34A';
            matchIcon.className = 'bi bi-check-circle-fill';
            matchText.textContent = 'Password cocok';
            matched = true;
        } else {
            matchRow.style.color = '#DC2626';
            matchIcon.className = 'bi bi-x-circle-fill';
            matchText.textContent = 'Password tidak cocok';
        }

        // Enable submit
        document.getElementById('submitBtn').disabled = !(score >= 1 && matched);
    }
</script>
</body>
</html>