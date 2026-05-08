<!DOCTYPE html>
<html>
<head>
    <title>Pengumuman Kelulusan</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333; max-width: 600px; margin: 0 auto; padding: 20px;">
    
    <div style="text-align: center; margin-bottom: 20px;">
        <h2 style="color: #1E5631;">Pondok Pesantren Al-Mardliyyah</h2>
        <hr style="border: 1px solid #1E5631;">
    </div>

    <p>Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
    
    {{-- Asumsi nama santri diambil dari relasi user. Sesuaikan jika kolom namamu berbeda --}}
    <p>Yth. Bapak/Ibu/Sdr <strong>{{ $santri->user->nama ?? 'Calon Santri' }}</strong>,</p>

    <p>Alhamdulillah, berdasarkan hasil evaluasi panitia penerimaan santri baru Pondok Pesantren Al-Mardliyyah, dengan ini kami menyampaikan bahwa Anda dinyatakan:</p>

    <div style="text-align: center; margin: 30px 0;">
        <span style="background-color: #1E5631; color: white; padding: 10px 30px; font-size: 20px; font-weight: bold; border-radius: 5px;">
            LULUS / DITERIMA
        </span>
    </div>

    <p>Selamat bergabung menjadi keluarga besar Pondok Pesantren Al-Mardliyyah! Silakan <strong>login ke akun Anda</strong> untuk mengunduh <strong>Surat Bukti Pendaftaran (PDF)</strong> yang akan digunakan sebagai syarat wajib saat daftar ulang.</p>
    <p>Wassalamu'alaikum Warahmatullahi Wabarakatuh.</p>

    <div style="text-align: center; margin: 30px 0;">
        <a href="{{ url('/status-pendaftaran') }}" style="background-color: #1E5631; color: white; padding: 12px 25px; text-decoration: none; font-size: 16px; font-weight: bold; border-radius: 5px; display: inline-block;">
            Cek Status & Download Bukti
        </a>
    </div>

    <br>
    <p>Hormat kami,</p>
    <p><strong>Panitia Penerimaan Santri Baru</strong><br>
    Pondok Pesantren Al-Mardliyyah</p>

</body>
</html>