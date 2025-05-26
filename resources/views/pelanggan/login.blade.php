<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Pelanggan</title>
    <style>
        body {
            margin: 0;
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ffecd2 0%, #fcb69f 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .login-container {
            background: #fff;
            width: 100%;
            max-width: 400px;
            padding: 30px 25px;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.15);
            text-align: center;
            animation: fadeIn 0.8s ease;
        }
        .login-container img {
            width: 120px;
            margin-bottom: 20px;
        }
        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            color: #ff7a00;
        }
        form {
            margin-top: 20px;
        }
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 12px 15px;
            margin: 10px 0 20px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 14px;
            transition: 0.3s;
        }
        input[type="email"]:focus,
        input[type="password"]:focus {
            border-color: #ff7a00;
            outline: none;
        }
        button {
            width: 100%;
            padding: 12px;
            background-color: #ff7a00;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease, transform 0.2s;
        }
        button:hover {
            background-color: #e56700;
            transform: scale(1.03);
        }
        .alert, .success-message {
            margin-bottom: 15px;
            padding: 10px;
            font-size: 14px;
            border-radius: 6px;
        }
        .alert {
            background: #ffe0e0;
            color: #d60000;
        }
        .success-message {
            background: #e0ffe0;
            color: #00a000;
        }
        p {
            margin-top: 15px;
            font-size: 14px;
        }
        a {
            color: #ff7a00;
            font-weight: bold;
            text-decoration: none;
        }
        a:hover {
            text-decoration: underline;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px);}
            to { opacity: 1; transform: translateY(0);}
        }
    </style>
</head>
<body>

<div class="login-container">
    <img src="https://cdn-icons-png.flaticon.com/512/4290/4290854.png" alt="Obat Icon">
    <h1>Login Pelanggan</h1>

    @if(session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert">{{ $errors->first() }}</div>
    @endif

    <form method="POST" action="{{ route('pelanggan.login.submit') }}">
        @csrf
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Masuk</button>
    </form>

    <p>Belum punya akun? <a href="{{ route('pelanggan.register') }}">Daftar disini</a></p>
</div>
@if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
</body>
</html>
