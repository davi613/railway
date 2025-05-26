<!DOCTYPE html>
<html>
<head>
    <title>Register Pelanggan</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
            max-width: 900px;
            margin: 0 auto;
            padding: 40px 20px;
        }

        h1 {
            text-align: center;
            color: #4CAF50;
            margin-bottom: 30px;
            font-size: 28px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #444;
        }

        input[type="text"], input[type="email"], input[type="password"], input[type="file"] {
            width: 100%;
            padding: 12px 15px;
            margin: 5px 0 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            background-color: #fff;
        }

        input[type="file"] {
            padding: 10px;
        }

        .address-section {
            margin-bottom: 20px;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border: 1px solid #f0f0f0;
        }

        .section-title {
            color: #4CAF50;
            font-size: 20px;
            margin-bottom: 15px;
        }

        .btn-submit {
            background-color: #4CAF50;
            color: white;
            font-size: 18px;
            font-weight: bold;
            padding: 14px 20px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            width: 100%;
            transition: background-color 0.3s ease;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        .form-group input:focus {
            border-color: #4CAF50;
            outline: none;
        }

        small {
            font-size: 12px;
            color: #888;
        }

        .error-list {
            list-style: none;
            padding-left: 0;
        }

        .error-list li {
            margin-bottom: 5px;
        }

        p {
            text-align: center;
            font-size: 16px;
            margin-top: 30px;
        }

        p a {
            color: #4CAF50;
            font-weight: bold;
            text-decoration: none;
        }

        p a:hover {
            text-decoration: underline;
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

        <div class="form-group">
            <label for="password">Password*</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Konfirmasi Password*</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <label for="no_telp">Nomor Telepon*</label>
            <input type="number" id="no_telp" name="no_telp" value="{{ old('no_telp') }}" required>
        </div>

        <!-- Alamat Utama -->
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

        <!-- Alamat Alternatif 1 -->
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

        <!-- Alamat Alternatif 2 -->
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

        <!-- Upload File -->
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
