<!DOCTYPE html>
<html>
<head>
    <title>Register Pelanggan</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #fff7f0, #ffe5d0);
            color: #333;
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
            line-height: 1.5;
        }

        h1 {
            text-align: center;
            color: #ff7b00;
            margin-bottom: 30px;
            font-size: 30px;
            letter-spacing: 1px;
        }

        .form-group {
            margin-bottom: 20px;
            position: relative;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #ff7b00;
        }

        input[type="text"], input[type="email"], input[type="password"], input[type="file"], input[type="number"] {
            width: 100%;
            padding: 12px 15px;
            margin: 5px 0 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            font-size: 16px;
            background-color: #fff;
            box-shadow: 0 2px 5px rgba(255, 123, 0, 0.05);
            transition: all 0.3s ease;
        }

        input[type="file"] {
            padding: 10px;
        }

        input:focus {
            border-color: #ff7b00;
            box-shadow: 0 0 8px rgba(255, 123, 0, 0.3);
            outline: none;
        }

        .address-section {
            margin-bottom: 25px;
            padding: 20px;
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(255, 123, 0, 0.1);
            border: 1px solid #ffe1c0;
            transition: transform 0.2s ease;
        }

        .address-section:hover {
            transform: translateY(-2px);
        }

        .section-title {
            color: #ff7b00;
            font-size: 20px;
            margin-bottom: 15px;
            border-bottom: 2px solid #ffe1c0;
            padding-bottom: 5px;
        }

        .btn-submit {
            background-color: #ff7b00;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 14px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 10px rgba(255, 123, 0, 0.3);
        }

        .btn-submit:hover {
            background-color: #e86d00;
            box-shadow: 0 5px 14px rgba(255, 123, 0, 0.4);
        }

        .error {
            background: #ffe5e5;
            color: #b30000;
            border: 1px solid #ffcccc;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .error-list {
            list-style: none;
            padding-left: 0;
            margin: 0;
        }

        .error-list li {
            margin-bottom: 5px;
        }

        small {
            font-size: 12px;
            color: #888;
        }

        p {
            text-align: center;
            font-size: 16px;
            margin-top: 30px;
        }

        p a {
            color: #ff7b00;
            font-weight: bold;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
        }

        /* Password toggle styling */
        .password-wrapper {
            position: relative;
        }

        .toggle-password {
            position: absolute;
            top: 50%;
            right: 15px;
            transform: translateY(-50%);
            cursor: pointer;
            font-size: 1.2rem;
            color: #ff7b00;
        }
    </style>
</head>
<body>

    <h1>Registrasi Pelanggan Baru</h1>

    @if($errors->any())
        <div class="error">
            <strong>Terjadi kesalahan:</strong>
            <ul class="error-list">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('pelanggan.register.submit') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="nama_pelanggan">Nama Lengkap*</label>
            <input type="text" id="nama_pelanggan" name="nama_pelanggan" value="{{ old('nama_pelanggan') }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email*</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <style>
            input[type="password"] {
                padding-right: 40px;
            }
        </style>

        <div class="form-group password-wrapper mb-3">
            <label for="password">Password (WAJIB MINIMAL 8 KARAKTER)</label>
            <input type="password" id="password" name="password" required>
            <i class="bi bi-eye-slash toggle-password" onclick="togglePassword('password', this)"></i>
        </div>

        <div class="form-group password-wrapper mb-3">
            <label for="password_confirmation">Konfirmasi Password*</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
            <i class="bi bi-eye-slash toggle-password" onclick="togglePassword('password_confirmation', this)"></i>
        </div>

        <script>
            function togglePassword(inputId, icon) {
                const input = document.getElementById(inputId);
                const isPassword = input.type === "password";
                input.type = isPassword ? "text" : "password";
                icon.classList.toggle("bi-eye");
                icon.classList.toggle("bi-eye-slash");
            }
        </script>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

        <div class="form-group">
            <label for="no_telp">Nomor Telepon*</label>
            <input type="number" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" required>
        </div>

        <div class="address-section">
            <h3 class="section-title">Alamat Utama*</h3>
            <div class="form-group">
                <label for="alamat1">Alamat Lengkap</label>
                <input type="text" id="alamat1" name="alamat1" value="{{ old('alamat1') }}" required>
            </div>
            <div class="form-group">
                <label for="kota1">Kota</label>
                <input type="text" id="kota1" name="kota1" value="{{ old('kota1') }}" required>
            </div>
            <div class="form-group">
                <label for="provinsi1">Provinsi</label>
                <input type="text" id="provinsi1" name="provinsi1" value="{{ old('provinsi1') }}" required>
            </div>
            <div class="form-group">
                <label for="kodepos1">Kode Pos</label>
                <input type="text" id="kodepos1" name="kodepos1" value="{{ old('kodepos1') }}" required>
            </div>
        </div>

        <div class="address-section">
            <h3 class="section-title">Alamat Alternatif 2 (Opsional)</h3>
            <div class="form-group">
                <label for="alamat2">Alamat Lengkap</label>
                <input type="text" id="alamat2" name="alamat2" value="{{ old('alamat2') }}">
            </div>
            <div class="form-group">
                <label for="kota2">Kota</label>
                <input type="text" id="kota2" name="kota2" value="{{ old('kota2') }}">
            </div>
            <div class="form-group">
                <label for="provinsi2">Provinsi</label>
                <input type="text" id="provinsi2" name="provinsi2" value="{{ old('provinsi2') }}">
            </div>
            <div class="form-group">
                <label for="kodepos2">Kode Pos</label>
                <input type="text" id="kodepos2" name="kodepos2" value="{{ old('kodepos2') }}">
            </div>
        </div>

        <div class="address-section">
            <h3 class="section-title">Alamat Alternatif 3 (Opsional)</h3>
            <div class="form-group">
                <label for="alamat3">Alamat Lengkap</label>
                <input type="text" id="alamat3" name="alamat3" value="{{ old('alamat3') }}">
            </div>
            <div class="form-group">
                <label for="kota3">Kota</label>
                <input type="text" id="kota3" name="kota3" value="{{ old('kota3') }}">
            </div>
            <div class="form-group">
                <label for="provinsi3">Provinsi</label>
                <input type="text" id="provinsi3" name="provinsi3" value="{{ old('provinsi3') }}">
            </div>
            <div class="form-group">
                <label for="kodepos3">Kode Pos</label>
                <input type="text" id="kodepos3" name="kodepos3" value="{{ old('kodepos3') }}">
            </div>
        </div>

        <div class="form-group">
            <label for="foto">Foto Profil (Opsional)</label>
            <input type="file" id="foto" name="foto" accept="image/jpeg, image/png">
            <small>Format: JPEG/PNG (Max 2MB)</small>
        </div>

        <div class="form-group">
            <label for="url_ktp">Foto KTP (Opsional)</label>
            <input type="file" id="url_ktp" name="url_ktp" accept="image/jpeg, image/png">
            <small>Format: JPEG/PNG (Max 2MB)</small>
        </div>

        <button type="submit" class="btn-submit">Daftar Sekarang</button>
    </form>

    <p>Sudah punya akun? <a href="{{ route('pelanggan.login') }}">Login disini</a></p>

</body>
</html>
