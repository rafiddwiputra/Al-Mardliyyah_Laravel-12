<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f3f4f6; margin: 0; padding: 0; }
        .container { max-width: 600px; margin: 40px auto; background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 15px rgba(0,0,0,0.05); }
        .header { background-color: #1E5631; padding: 35px 20px; text-align: center; border-bottom: 5px solid #C6A75E; }
        .header img { max-height: 90px; margin-bottom: 15px; background-color: white; padding: 5px; border-radius: 50%; }
        .header h1 { color: #ffffff; margin: 0; font-size: 24px; letter-spacing: 1px; text-transform: uppercase; }
        .content { padding: 40px 40px; color: #4b5563; line-height: 1.7; font-size: 15px; }
        .content h2 { color: #1E5631; font-size: 22px; margin-top: 0; }
        .btn-container { text-align: center; margin: 35px 0; }
        .btn { display: inline-block; background-color: #C6A75E; color: #ffffff; padding: 14px 30px; text-decoration: none; border-radius: 8px; font-weight: bold; font-size: 16px; box-shadow: 0 4px 6px rgba(198,167,94,0.3); }
        .footer { background-color: #f8fafc; padding: 25px 40px; text-align: center; font-size: 13px; color: #9ca3af; border-top: 1px solid #f3f4f6; }
        .footer a { color: #1E5631; word-break: break-all; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            {{-- Pastikan APP_URL di .env sudah benar (contoh: http://127.0.0.1:8000) agar gambar muncul --}}
            <img src="{{ rtrim(config('app.url'), '/') }}/images/logo-pondok.png" alt="Logo Al-Mardliyyah">
            <h1>Pondok Pesantren<br>Al-Mardliyyah</h1>
        </div>
        
        <div class="content">
            <h2>Assalamu'alaikum, {{ $notifiable->name }}!</h2>
            <p>Terima kasih telah mendaftar di sistem Pendaftaran Santri Baru Pondok Pesantren Al-Mardliyyah.</p>
            <p>Untuk alasan keamanan dan agar Anda dapat melanjutkan proses pengisian formulir pendaftaran, silakan verifikasi alamat email Anda dengan menekan tombol di bawah ini:</p>
            
            <div class="btn-container">
                <a href="{{ $url }}" class="btn">Verifikasi Email Saya</a>
            </div>
            
            <p>Jika Anda tidak merasa mendaftarkan akun di sistem kami, Anda dapat mengabaikan pesan email ini.</p>
            
            <p style="margin-top: 30px;">
                Wassalamu'alaikum Warahmatullahi Wabarakatuh,<br>
                <strong>Panitia Pendaftaran Pondok Pesantren Al-Mardliyyah</strong>
            </p>
        </div>
        
        <div class="footer">
            <p>&copy; {{ date('Y') }} Pondok Pesantren Al-Mardliyyah. Seluruh Hak Cipta Dilindungi.</p>
            <p>Jika tombol verifikasi di atas tidak berfungsi, salin dan tempel tautan berikut ke browser Anda:<br>
            <a href="{{ $url }}">{{ $url }}</a></p>
        </div>
    </div>
</body>
</html>