<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Inter', Arial, sans-serif;
            background-color: #f4f6f9;
            color: #333;
        }
        .wrapper {
            max-width: 600px;
            margin: 40px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,0.08);
        }
        .header {
            background: linear-gradient(135deg, #FF8C00 0%, #FF6B35 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .header-icon {
            width: 70px;
            height: 70px;
            background: rgba(255,255,255,0.2);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 16px;
            font-size: 32px;
        }
        .header h1 {
            color: #ffffff;
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.3px;
        }
        .header p {
            color: rgba(255,255,255,0.85);
            font-size: 14px;
            margin-top: 6px;
        }
        .body {
            padding: 40px 36px;
        }
        .greeting {
            font-size: 16px;
            font-weight: 600;
            color: #1a1a2e;
            margin-bottom: 12px;
        }
        .message {
            font-size: 14px;
            color: #555;
            line-height: 1.7;
            margin-bottom: 28px;
        }
        .btn-wrapper {
            text-align: center;
            margin: 32px 0;
        }
        .btn-verify {
            display: inline-block;
            background: linear-gradient(135deg, #FF8C00, #FF6B35);
            color: #ffffff !important;
            text-decoration: none;
            padding: 16px 42px;
            border-radius: 50px;
            font-size: 15px;
            font-weight: 600;
            letter-spacing: 0.3px;
            box-shadow: 0 6px 20px rgba(255, 107, 53, 0.4);
            transition: all 0.3s;
        }
        .info-box {
            background: #fff8f2;
            border-left: 4px solid #FF8C00;
            border-radius: 8px;
            padding: 16px 20px;
            margin: 24px 0;
        }
        .info-box p {
            font-size: 13px;
            color: #666;
            line-height: 1.6;
        }
        .info-box strong {
            color: #FF8C00;
        }
        .divider {
            height: 1px;
            background: #f0f0f0;
            margin: 28px 0;
        }
        .link-text {
            font-size: 12px;
            color: #999;
            word-break: break-all;
            background: #f9f9f9;
            padding: 12px;
            border-radius: 8px;
            border: 1px solid #eee;
        }
        .footer {
            background: #fafafa;
            border-top: 1px solid #f0f0f0;
            padding: 24px 36px;
            text-align: center;
        }
        .footer p {
            font-size: 12px;
            color: #aaa;
            line-height: 1.8;
        }
        .footer strong {
            color: #FF8C00;
        }
        .badge {
            display: inline-block;
            background: #fff3e8;
            color: #FF8C00;
            font-size: 11px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            margin-top: 8px;
            border: 1px solid #ffe0c0;
        }
    </style>
</head>
<body>
<div class="wrapper">
    <div class="header">
        <div class="header-icon">📧</div>
        <h1>Verifikasi Email Anda</h1>
        <p>Satu langkah lagi untuk bergabung bersama kami</p>
    </div>

    <div class="body">
        <p class="greeting">Halo, {{ $pelanggan->nama_pelanggan }}! 👋</p>
        <p class="message">
            Terima kasih telah mendaftar di <strong>{{ config('app.name') }}</strong>. 
            Untuk mengaktifkan akun Anda dan mulai menikmati layanan kami, 
            silakan verifikasi alamat email Anda dengan mengklik tombol di bawah ini.
        </p>

        <div class="btn-wrapper">
            <a href="{{ url('/pelanggan/verify-email/' . $token) }}" class="btn-verify">
                ✅ &nbsp; Verifikasi Email Sekarang
            </a>
        </div>

        <div class="info-box">
            <p>⏰ <strong>Perhatian:</strong> Link verifikasi ini hanya berlaku selama <strong>24 jam</strong> sejak email ini dikirimkan. Pastikan Anda segera melakukan verifikasi.</p>
        </div>

        <div class="divider"></div>

        <p style="font-size:13px; color:#888; margin-bottom:8px;">Atau salin link berikut ke browser Anda:</p>
        <div class="link-text">{{ url('/pelanggan/verify-email/' . $token) }}</div>

        <div class="divider"></div>

        <p style="font-size:13px; color:#999; line-height:1.7;">
            Jika Anda tidak merasa mendaftarkan akun ini, abaikan email ini. 
            Akun tidak akan aktif tanpa verifikasi.
        </p>
    </div>

    <div class="footer">
        <p>Email ini dikirim secara otomatis oleh sistem <strong>{{ config('app.name') }}</strong>.</p>
        <p>Mohon jangan membalas email ini.</p>
        <span class="badge">🏥 {{ config('app.name') }}</span>
    </div>
</div>
</body>
</html>