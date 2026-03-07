<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pelanggan — {{ config('app.name') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        *, *::before, *::after { margin: 0; padding: 0; box-sizing: border-box; }

        :root {
            --primary: #F97316;
            --primary-dark: #EA6B0A;
            --primary-light: #FFF7ED;
            --primary-glow: rgba(249,115,22,0.15);
            --text-dark: #0F172A;
            --text-mid: #475569;
            --text-light: #94A3B8;
            --white: #FFFFFF;
            --surface: #FAFAF9;
            --border: #E2E8F0;
            --shadow-card: 0 4px 24px rgba(0,0,0,0.06), 0 0 0 1px rgba(249,115,22,0.05);
        }

        html { height: 100%; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #FFF7ED;
            min-height: 100%;
            padding: 40px 16px 60px;
            overflow-x: hidden;
            overflow-y: auto;
            position: relative;
        }

        /* Background */
        body::before {
            content: ''; position: fixed;
            top: -200px; right: -200px;
            width: 600px; height: 600px;
            background: radial-gradient(circle, #FED7AA55 0%, transparent 70%);
            border-radius: 50%; pointer-events: none; z-index: 0;
        }
        body::after {
            content: ''; position: fixed;
            bottom: -200px; left: -200px;
            width: 500px; height: 500px;
            background: radial-gradient(circle, #FDE68A33 0%, transparent 70%);
            border-radius: 50%; pointer-events: none; z-index: 0;
        }

        .bg-grid {
            position: fixed; inset: 0; z-index: 0; pointer-events: none;
            background-image:
                linear-gradient(rgba(249,115,22,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(249,115,22,0.03) 1px, transparent 1px);
            background-size: 44px 44px;
        }

        .page-wrapper {
            max-width: 680px; margin: 0 auto;
            position: relative; z-index: 1;
        }

        /* Page header */
        .page-header {
            text-align: center; margin-bottom: 36px;
            animation: fadeDown 0.7s cubic-bezier(0.16,1,0.3,1) both;
        }
        @keyframes fadeDown {
            from { opacity: 0; transform: translateY(-18px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(22px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .brand-pill {
            display: inline-flex; align-items: center; gap: 8px;
            background: var(--white); padding: 8px 18px;
            border-radius: 50px; border: 1px solid #FED7AA;
            box-shadow: 0 4px 14px rgba(249,115,22,0.12);
            font-size: 13px; font-weight: 700; color: var(--primary);
            margin-bottom: 18px;
        }
        .brand-pill i { font-size: 15px; }

        .page-header h1 {
            font-size: 30px; font-weight: 800; color: var(--text-dark);
            letter-spacing: -0.7px; line-height: 1.2; margin-bottom: 8px;
        }
        .page-header h1 span { color: var(--primary); }
        .page-header p { font-size: 14px; color: var(--text-mid); }

        /* Progress steps */
        .progress-steps {
            display: flex; align-items: center; justify-content: center;
            gap: 0; margin-bottom: 32px;
            animation: fadeDown 0.7s 0.1s both;
        }
        .step-item {
            display: flex; flex-direction: column; align-items: center; gap: 6px;
        }
        .step-circle {
            width: 36px; height: 36px; border-radius: 50%;
            display: flex; align-items: center; justify-content: center;
            font-size: 13px; font-weight: 700;
            border: 2px solid var(--border);
            background: var(--white); color: var(--text-light);
            transition: all 0.3s;
        }
        .step-circle.active {
            background: var(--primary); border-color: var(--primary);
            color: #fff; box-shadow: 0 4px 14px rgba(249,115,22,0.35);
        }
        .step-circle.done {
            background: #DCFCE7; border-color: #86EFAC; color: #16A34A;
        }
        .step-label { font-size: 10.5px; color: var(--text-light); font-weight: 600; text-align: center; }
        .step-label.active { color: var(--primary); }
        .step-connector {
            width: 60px; height: 2px; background: var(--border);
            margin-bottom: 22px; flex-shrink: 0;
        }

        /* Alert */
        .alert {
            border-radius: 12px; padding: 14px 16px; font-size: 13px;
            display: flex; align-items: flex-start; gap: 10px;
            margin-bottom: 24px; font-weight: 500;
            animation: slideIn 0.4s ease;
        }
        @keyframes slideIn {
            from { opacity: 0; transform: translateX(-10px); }
            to { opacity: 1; transform: translateX(0); }
        }
        .alert i { font-size: 16px; flex-shrink: 0; margin-top: 0.5px; }
        .alert-error { background: #FEF2F2; border: 1px solid #FECACA; color: #B91C1C; }
        .alert-error ul { padding-left: 16px; margin-top: 5px; }
        .alert-error ul li { margin-bottom: 2px; }

        /* Card sections */
        .section-card {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(16px);
            border-radius: 20px;
            padding: 28px 32px;
            box-shadow: var(--shadow-card);
            border: 1px solid rgba(249,115,22,0.08);
            margin-bottom: 20px;
            animation: fadeUp 0.6s cubic-bezier(0.16,1,0.3,1) both;
        }
        .section-card:nth-child(1) { animation-delay: 0.15s; }
        .section-card:nth-child(2) { animation-delay: 0.2s; }
        .section-card:nth-child(3) { animation-delay: 0.25s; }
        .section-card:nth-child(4) { animation-delay: 0.3s; }
        .section-card:nth-child(5) { animation-delay: 0.35s; }
        .section-card:nth-child(6) { animation-delay: 0.4s; }

        .section-head {
            display: flex; align-items: center; gap: 14px;
            padding-bottom: 20px; margin-bottom: 22px;
            border-bottom: 1.5px dashed #F0E6D9;
        }
        .section-icon-wrap {
            width: 42px; height: 42px; border-radius: 12px;
            background: linear-gradient(135deg, #FFF7ED, #FED7AA);
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0; border: 1px solid #FED7AA;
            box-shadow: 0 2px 8px rgba(249,115,22,0.12);
        }
        .section-icon-wrap i { font-size: 19px; color: var(--primary); }
        .section-title h2 { font-size: 15.5px; font-weight: 700; color: var(--text-dark); }
        .section-title p { font-size: 12px; color: var(--text-light); margin-top: 2px; }

        /* Optional badge */
        .badge-optional {
            display: inline-flex; align-items: center; gap: 4px;
            font-size: 10px; font-weight: 600; padding: 3px 9px;
            background: #F1F5F9; color: var(--text-light);
            border-radius: 20px; border: 1px solid var(--border); margin-left: 8px;
        }

        /* Form grid */
        .form-grid { display: flex; flex-direction: column; gap: 18px; }
        .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; }
        .form-row.col-3 { grid-template-columns: 1fr 1fr 1fr; }
        .form-row.col-full { grid-template-columns: 1fr; }

        .form-group { }

        .form-label {
            display: block; font-size: 11.5px; font-weight: 700;
            color: var(--text-dark); margin-bottom: 7px;
            letter-spacing: 0.3px; text-transform: uppercase;
        }

        .input-wrap { position: relative; }

        .input-icon {
            position: absolute; left: 13px; top: 50%;
            transform: translateY(-50%);
            color: var(--text-light); font-size: 14.5px;
            pointer-events: none; transition: color 0.25s;
        }

        .form-input {
            width: 100%; padding: 12px 13px 12px 40px;
            border: 1.5px solid var(--border); border-radius: 11px;
            font-size: 13.5px; font-family: 'Plus Jakarta Sans', sans-serif;
            color: var(--text-dark); background: var(--surface);
            transition: all 0.25s ease; outline: none;
            caret-color: var(--primary);
        }
        .form-input.no-icon { padding-left: 13px; }
        .form-input::placeholder { color: var(--text-light); font-size: 13px; }
        .form-input:focus {
            border-color: var(--primary); background: var(--white);
            box-shadow: 0 0 0 4px var(--primary-glow);
        }
        .form-input:focus + .input-icon,
        .input-wrap:focus-within .input-icon { color: var(--primary); }

        .form-input[type="file"] {
            padding: 10px 13px; cursor: pointer; font-size: 12.5px;
        }

        .toggle-pw {
            position: absolute; right: 13px; top: 50%;
            transform: translateY(-50%); cursor: pointer;
            color: var(--text-light); font-size: 16px; transition: color 0.2s;
        }
        .toggle-pw:hover { color: var(--primary); }

        .hint-text {
            font-size: 11px; color: var(--text-light);
            margin-top: 5px; display: flex; align-items: center; gap: 5px;
        }
        .hint-text i { font-size: 11px; }

        /* File upload custom */
        .file-upload-box {
            border: 2px dashed #FED7AA;
            border-radius: 11px; padding: 20px 16px;
            text-align: center; cursor: pointer;
            transition: all 0.25s; background: #FFFBF7;
            position: relative;
        }
        .file-upload-box:hover {
            border-color: var(--primary);
            background: var(--primary-light);
        }
        .file-upload-box input[type="file"] {
            position: absolute; inset: 0; opacity: 0; cursor: pointer; width: 100%; height: 100%;
        }
        .file-upload-box i { font-size: 28px; color: #FED7AA; display: block; margin-bottom: 8px; }
        .file-upload-box:hover i { color: var(--primary); }
        .file-upload-box p { font-size: 12.5px; color: var(--text-mid); font-weight: 500; }
        .file-upload-box span { font-size: 11px; color: var(--text-light); margin-top: 3px; display: block; }

        /* Submit button */
        .btn-submit {
            width: 100%; padding: 15px;
            background: linear-gradient(135deg, #F97316, #FB923C);
            color: #fff; border: none; border-radius: 14px;
            font-size: 15.5px; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all 0.3s;
            box-shadow: 0 8px 28px rgba(249,115,22,0.38);
            display: flex; align-items: center; justify-content: center; gap: 10px;
            margin-top: 8px; position: relative; overflow: hidden;
        }
        .btn-submit::after {
            content: ''; position: absolute; inset: 0;
            background: linear-gradient(135deg, rgba(255,255,255,0.15), transparent);
            opacity: 0; transition: opacity 0.3s;
        }
        .btn-submit:hover { transform: translateY(-2px); box-shadow: 0 14px 36px rgba(249,115,22,0.45); }
        .btn-submit:hover::after { opacity: 1; }
        .btn-submit i { font-size: 18px; }

        .footer-note {
            text-align: center; font-size: 14px; color: var(--text-mid);
            margin-top: 24px; padding-bottom: 8px;
            animation: fadeUp 0.6s 0.45s both;
        }
        .footer-note a { color: var(--primary); font-weight: 700; text-decoration: none; }
        .footer-note a:hover { text-decoration: underline; }

        /* Section collapse toggle */
        .section-toggle {
            display: flex; align-items: center; justify-content: space-between;
            cursor: pointer; width: 100%;
        }
        .toggle-chevron {
            width: 28px; height: 28px; border-radius: 8px;
            background: var(--primary-light); border: 1px solid #FED7AA;
            display: flex; align-items: center; justify-content: center;
            color: var(--primary); transition: transform 0.3s;
            flex-shrink: 0;
        }
        .toggle-chevron.open { transform: rotate(180deg); }
        .collapsible { overflow: hidden; transition: max-height 0.4s ease, opacity 0.3s; }
        .collapsible.collapsed { max-height: 0 !important; opacity: 0; }

        @media (max-width: 580px) {
            .section-card { padding: 22px 18px; }
            .form-row, .form-row.col-3 { grid-template-columns: 1fr; }
        }
    </style>
</head>
<body>

<div class="bg-grid"></div>

<div class="page-wrapper">

    <div class="page-header">
        <div class="brand-pill">
            <i class="bi bi-capsule"></i>
            {{ config('app.name') }}
        </div>
        <h1>Buat Akun <span>Baru</span></h1>
        <p>Daftar sekarang dan nikmati kemudahan berbelanja</p>
    </div>

    {{-- Progress --}}
    <div class="progress-steps">
        <div class="step-item">
            <div class="step-circle active"><i class="bi bi-person"></i></div>
            <div class="step-label active">Data Diri</div>
        </div>
        <div class="step-connector"></div>
        <div class="step-item">
            <div class="step-circle"><i class="bi bi-house"></i></div>
            <div class="step-label">Alamat</div>
        </div>
        <div class="step-connector"></div>
        <div class="step-item">
            <div class="step-circle"><i class="bi bi-check-lg"></i></div>
            <div class="step-label">Selesai</div>
        </div>
    </div>

    @if($errors->any())
        <div class="alert alert-error">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div>
                <strong>Terdapat kesalahan:</strong>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endif

    <form method="POST" action="{{ route('pelanggan.register.submit') }}" enctype="multipart/form-data">
        @csrf

        {{-- INFORMASI PRIBADI --}}
        <div class="section-card">
            <div class="section-head">
                <div class="section-icon-wrap"><i class="bi bi-person-vcard"></i></div>
                <div class="section-title">
                    <h2>Informasi Pribadi</h2>
                    <p>Data diri dan akun Anda</p>
                </div>
            </div>
            <div class="form-grid">
                <div class="form-row col-full">
                    <div class="form-group">
                        <label class="form-label" for="nama_pelanggan">Nama Lengkap</label>
                        <div class="input-wrap">
                            <input type="text" id="nama_pelanggan" name="nama_pelanggan"
                                   class="form-input no-icon" placeholder="Masukkan nama lengkap"
                                   value="{{ old('nama_pelanggan') }}" required>
                            <i class="bi bi-person input-icon" style="left:13px;"></i>
                        </div>
                    </div>
                </div>
                <div class="form-row col-full">
                    <div class="form-group">
                        <label class="form-label" for="email">Alamat Email</label>
                        <div class="input-wrap">
                            <i class="bi bi-envelope input-icon"></i>
                            <input type="email" id="email" name="email"
                                   class="form-input" placeholder="nama@email.com"
                                   value="{{ old('email') }}" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="password">Password</label>
                        <div class="input-wrap">
                            <i class="bi bi-lock input-icon"></i>
                            <input type="password" id="password" name="password"
                                   class="form-input" placeholder="Min. 8 karakter" required>
                            <i class="bi bi-eye-slash toggle-pw" onclick="togglePw('password', this)"></i>
                        </div>
                        <p class="hint-text"><i class="bi bi-info-circle"></i> Minimal 8 karakter</p>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                        <div class="input-wrap">
                            <i class="bi bi-lock-fill input-icon"></i>
                            <input type="password" id="password_confirmation" name="password_confirmation"
                                   class="form-input" placeholder="Ulangi password" required>
                            <i class="bi bi-eye-slash toggle-pw" onclick="togglePw('password_confirmation', this)"></i>
                        </div>
                    </div>
                </div>
                <div class="form-row col-full">
                    <div class="form-group">
                        <label class="form-label" for="no_telp">Nomor Telepon</label>
                        <div class="input-wrap">
                            <i class="bi bi-telephone input-icon"></i>
                            <input type="text" id="no_telp" name="no_telp"
                                   class="form-input" placeholder="08xxxxxxxxxx"
                                   value="{{ old('no_telp') }}" maxlength="15" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ALAMAT UTAMA --}}
        <div class="section-card">
            <div class="section-head">
                <div class="section-icon-wrap"><i class="bi bi-house-fill"></i></div>
                <div class="section-title">
                    <h2>Alamat Utama</h2>
                    <p>Alamat pengiriman utama Anda</p>
                </div>
            </div>
            <div class="form-grid">
                <div class="form-row col-full">
                    <div class="form-group">
                        <label class="form-label" for="alamat1">Alamat Lengkap</label>
                        <div class="input-wrap">
                            <i class="bi bi-geo-alt input-icon"></i>
                            <input type="text" id="alamat1" name="alamat1" class="form-input"
                                   placeholder="Jl. Nama Jalan No. XX RT/RW"
                                   value="{{ old('alamat1') }}" required>
                        </div>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label class="form-label" for="kota1">Kota / Kabupaten</label>
                        <div class="input-wrap">
                            <i class="bi bi-building input-icon"></i>
                            <input type="text" id="kota1" name="kota1" class="form-input"
                                   placeholder="Nama kota" value="{{ old('kota1') }}" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="form-label" for="kodepos1">Kode Pos</label>
                        <div class="input-wrap">
                            <i class="bi bi-mailbox input-icon"></i>
                            <input type="text" id="kodepos1" name="kodepos1" class="form-input"
                                   placeholder="12345" value="{{ old('kodepos1') }}" maxlength="10" required>
                        </div>
                    </div>
                </div>
                <div class="form-row col-full">
                    <div class="form-group">
                        <label class="form-label" for="provinsi1">Provinsi</label>
                        <div class="input-wrap">
                            <i class="bi bi-map input-icon"></i>
                            <input type="text" id="provinsi1" name="provinsi1" class="form-input"
                                   placeholder="Nama provinsi" value="{{ old('provinsi1') }}" required>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ALAMAT ALTERNATIF 2 --}}
        <div class="section-card">
            <div class="section-head section-toggle" onclick="toggleSection('addr2')">
                <div style="display:flex;align-items:center;gap:14px;">
                    <div class="section-icon-wrap"><i class="bi bi-house-door"></i></div>
                    <div class="section-title">
                        <h2>Alamat Alternatif 2 <span class="badge-optional"><i class="bi bi-dash-circle"></i> Opsional</span></h2>
                        <p>Alamat pengiriman cadangan pertama</p>
                    </div>
                </div>
                <div class="toggle-chevron" id="chevron-addr2"><i class="bi bi-chevron-down"></i></div>
            </div>
            <div class="collapsible collapsed" id="addr2" style="max-height: 600px;">
                <div class="form-grid">
                    <div class="form-row col-full">
                        <div class="form-group">
                            <label class="form-label" for="alamat2">Alamat Lengkap</label>
                            <div class="input-wrap">
                                <i class="bi bi-geo-alt input-icon"></i>
                                <input type="text" id="alamat2" name="alamat2" class="form-input"
                                       placeholder="Jl. Nama Jalan No. XX" value="{{ old('alamat2') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="kota2">Kota</label>
                            <div class="input-wrap">
                                <i class="bi bi-building input-icon"></i>
                                <input type="text" id="kota2" name="kota2" class="form-input"
                                       placeholder="Nama kota" value="{{ old('kota2') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="kodepos2">Kode Pos</label>
                            <div class="input-wrap">
                                <i class="bi bi-mailbox input-icon"></i>
                                <input type="text" id="kodepos2" name="kodepos2" class="form-input"
                                       placeholder="12345" value="{{ old('kodepos2') }}" maxlength="10">
                            </div>
                        </div>
                    </div>
                    <div class="form-row col-full">
                        <div class="form-group">
                            <label class="form-label" for="provinsi2">Provinsi</label>
                            <div class="input-wrap">
                                <i class="bi bi-map input-icon"></i>
                                <input type="text" id="provinsi2" name="provinsi2" class="form-input"
                                       placeholder="Nama provinsi" value="{{ old('provinsi2') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- ALAMAT ALTERNATIF 3 --}}
        <div class="section-card">
            <div class="section-head section-toggle" onclick="toggleSection('addr3')">
                <div style="display:flex;align-items:center;gap:14px;">
                    <div class="section-icon-wrap"><i class="bi bi-pin-map"></i></div>
                    <div class="section-title">
                        <h2>Alamat Alternatif 3 <span class="badge-optional"><i class="bi bi-dash-circle"></i> Opsional</span></h2>
                        <p>Alamat pengiriman cadangan kedua</p>
                    </div>
                </div>
                <div class="toggle-chevron" id="chevron-addr3"><i class="bi bi-chevron-down"></i></div>
            </div>
            <div class="collapsible collapsed" id="addr3" style="max-height: 600px;">
                <div class="form-grid">
                    <div class="form-row col-full">
                        <div class="form-group">
                            <label class="form-label" for="alamat3">Alamat Lengkap</label>
                            <div class="input-wrap">
                                <i class="bi bi-geo-alt input-icon"></i>
                                <input type="text" id="alamat3" name="alamat3" class="form-input"
                                       placeholder="Jl. Nama Jalan No. XX" value="{{ old('alamat3') }}">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group">
                            <label class="form-label" for="kota3">Kota</label>
                            <div class="input-wrap">
                                <i class="bi bi-building input-icon"></i>
                                <input type="text" id="kota3" name="kota3" class="form-input"
                                       placeholder="Nama kota" value="{{ old('kota3') }}">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="form-label" for="kodepos3">Kode Pos</label>
                            <div class="input-wrap">
                                <i class="bi bi-mailbox input-icon"></i>
                                <input type="text" id="kodepos3" name="kodepos3" class="form-input"
                                       placeholder="12345" value="{{ old('kodepos3') }}" maxlength="10">
                            </div>
                        </div>
                    </div>
                    <div class="form-row col-full">
                        <div class="form-group">
                            <label class="form-label" for="provinsi3">Provinsi</label>
                            <div class="input-wrap">
                                <i class="bi bi-map input-icon"></i>
                                <input type="text" id="provinsi3" name="provinsi3" class="form-input"
                                       placeholder="Nama provinsi" value="{{ old('provinsi3') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- DOKUMEN --}}
        <div class="section-card">
            <div class="section-head">
                <div class="section-icon-wrap"><i class="bi bi-file-earmark-image"></i></div>
                <div class="section-title">
                    <h2>Dokumen & Foto <span class="badge-optional"><i class="bi bi-dash-circle"></i> Opsional</span></h2>
                    <p>Upload foto profil dan KTP Anda</p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group">
                    <label class="form-label" for="foto">Foto Profil</label>
                    <div class="file-upload-box" id="fotoBox">
                        <input type="file" id="foto" name="foto" accept="image/jpeg,image/png"
                               onchange="updateFileLabel('foto', 'fotoLabel')">
                        <i class="bi bi-person-bounding-box"></i>
                        <p id="fotoLabel">Klik untuk upload foto</p>
                        <span>JPEG / PNG &bull; Maks. 2MB</span>
                    </div>
                </div>
                <div class="form-group">
                    <label class="form-label" for="url_ktp">Foto KTP</label>
                    <div class="file-upload-box" id="ktpBox">
                        <input type="file" id="url_ktp" name="url_ktp" accept="image/jpeg,image/png"
                               onchange="updateFileLabel('url_ktp', 'ktpLabel')">
                        <i class="bi bi-credit-card-2-front"></i>
                        <p id="ktpLabel">Klik untuk upload KTP</p>
                        <span>JPEG / PNG &bull; Maks. 2MB</span>
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn-submit">
            <i class="bi bi-person-check-fill"></i>
            Daftar Sekarang
        </button>

    </form>

    <p class="footer-note">
        Sudah punya akun? <a href="{{ route('pelanggan.login') }}">Login di sini</a>
    </p>

</div>

<script>
    function togglePw(inputId, icon) {
        const input = document.getElementById(inputId);
        input.type = input.type === 'password' ? 'text' : 'password';
        icon.classList.toggle('bi-eye');
        icon.classList.toggle('bi-eye-slash');
    }

    function toggleSection(id) {
        const el = document.getElementById(id);
        const chevron = document.getElementById('chevron-' + id);
        const isCollapsed = el.classList.contains('collapsed');
        if (isCollapsed) {
            el.classList.remove('collapsed');
            chevron.classList.add('open');
        } else {
            el.classList.add('collapsed');
            chevron.classList.remove('open');
        }
    }

    function updateFileLabel(inputId, labelId) {
        const input = document.getElementById(inputId);
        const label = document.getElementById(labelId);
        if (input.files && input.files[0]) {
            label.textContent = input.files[0].name;
            label.style.color = '#F97316';
            label.style.fontWeight = '600';
        }
    }

    // Activate addr2/addr3 if has old value
    @if(old('alamat2') || old('kota2'))
        toggleSection('addr2');
    @endif
    @if(old('alamat3') || old('kota3'))
        toggleSection('addr3');
    @endif
</script>
</body>
</html>