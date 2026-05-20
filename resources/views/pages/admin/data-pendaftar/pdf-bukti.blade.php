<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Bukti Pendaftaran - {{ $data->nama_lengkap }}</title>
    <style>
        /* Margin Halaman */
        @page { 
            size: A4 portrait; 
            margin: 1cm 1.5cm 1cm 1.5cm; 
        }

        body { 
            font-family: "Times New Roman", Times, serif; 
            font-size: 11pt; 
            line-height: 1.15; 
            color: #000; 
            margin: 0;
            padding: 0;
        }
        
        .kop-surat-img { 
            text-align: center; 
            margin-bottom: 15px; 
            
        }
        .kop-surat-img img { 
            width: 100%;
            max-height: 130px; 
            object-fit: contain;
        }

        /* JUDUL */
        .judul-surat { text-align: center; font-weight: bold; margin-bottom: 10px; font-size: 11pt; }
        .judul-surat p { margin: 0; }

        /* TABEL DATA */
        .tabel-data { width: 100%; border-collapse: collapse; margin-bottom: 10px; }
        .tabel-data th, .tabel-data td { border: 1px solid #000; padding: 4px 8px; vertical-align: top; }
        .col-no { width: 5%; text-align: center; }
        .col-label { width: 35%; }
        .col-value { width: 60%; } 

        .inner-table { width: 100%; border: none !important; }
        .inner-table td { border: none !important; padding: 1px 0 !important; }

        /* CHECKLIST & CATATAN */
        .section-title { font-weight: bold; margin-top: 12px; margin-bottom: 6px; font-size: 11pt; }
        
        .list-checklist { list-style-type: none; padding-left: 40px; margin: 0; font-size: 11pt; }
        .list-checklist li { margin-bottom: 6px; }
        .box { display: inline-block; width: 14px; height: 14px; border: 1px solid #000; margin-left: 6px; margin-right: 6px; position: relative; top: 2px; }
        
        .catatan { padding-left: 55px; margin-top: 4px; font-size: 11pt; }
        .catatan li { margin-bottom: 3px; padding-left: 5px; }

        .footer-text { margin-top: 20px; font-size: 11pt; text-align: justify; border-top: 1px dashed #ccc; padding-top: 10px; }
    </style>
</head>
<body>

    {{-- KOP SURAT (MENGGUNAKAN GAMBAR PENUH) --}}
    <div class="kop-surat-img">
        {{-- Pastikan nama file gambarnya sesuai dengan yang kamu simpan di folder public/images --}}
        <img src="{{ public_path('images/kop-surat.png') }}" alt="Kop Surat Al-Mardliyyah">
    </div>

    {{-- JUDUL SURAT --}}
   <div class="judul-surat">
        <p>BUKTI PENDAFTARAN PPDB</p>
        <p>PONDOK PESANTREN AL MARDLIYYAH</p>
        {{-- Mengambil nama periode langsung dari database dan dijadikan huruf besar semua --}}
        <p>{{ strtoupper($data->periode->nama_periode ?? 'PERIODE PENDAFTARAN') }}</p>
    </div>

    <p style="margin-bottom: 4px; font-size: 11pt;">Data Pendaftar : <strong>{{ strtoupper($data->nama_lengkap) }}</strong></p>

    {{-- TABEL DATA PENDAFTAR --}}
    <table class="tabel-data">
        <tr>
            <td class="col-no">1.</td>
            <td class="col-label">No. Pendaftar</td>
            <td class="col-value">{{ $data->smart_id ?? '-' }}</td>
        </tr>
        <tr>
            <td class="col-no">2.</td>
            <td class="col-label">Nama Pendaftar</td>
            <td class="col-value">{{ $data->nama_lengkap }}</td>
        </tr>
        <tr>
            <td class="col-no">3.</td>
            <td class="col-label">Sekolah asal</td>
            <td class="col-value">{{ $data->sekolah_asal ?? '-' }}</td>
        </tr>
        <tr>
            <td class="col-no">4.</td>
            <td class="col-label">Alamat</td>
            <td class="col-value">{{ $data->ortu->alamat ?? '-' }}</td>
        </tr>
        <tr>
            <td class="col-no">5.</td>
            <td class="col-label">Nomor WhatsApp orang tua/wali</td>
            <td class="col-value">{{ $data->ortu->no_hp ?? '-' }}</td>
        </tr>
        <tr>
            <td class="col-no">6.</td>
            <td class="col-label">Jadwal seleksi penentuan kelas santri</td>
            <td class="col-value">
                <table class="inner-table">
                    <tr>
                        <td style="width: 60px;">Hari/Tgl</td>
                        <td style="width: 10px;">:</td>
                        <td>{{ $data->periode->jadwal_seleksi_tanggal ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Ruang</td>
                        <td>:</td>
                        <td>{{ $data->periode->jadwal_seleksi_ruang ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Waktu</td>
                        <td>:</td>
                        <td>{{ $data->periode->jadwal_seleksi_waktu ?? '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
        <tr>
            <td class="col-no">7.</td>
            <td class="col-label">Jadwal wawancara orang tua</td>
            <td class="col-value">
                <table class="inner-table">
                    <tr>
                        <td style="width: 60px;">Hari/Tgl</td>
                        <td style="width: 10px;">:</td>
                        <td>{{ $data->periode->jadwal_wawancara_tanggal ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Ruang</td>
                        <td>:</td>
                        <td>{{ $data->periode->jadwal_wawancara_ruang ?? '-' }}</td>
                    </tr>
                    <tr>
                        <td>Waktu</td>
                        <td>:</td>
                        <td>{{ $data->periode->jadwal_wawancara_waktu ?? '-' }}</td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    {{-- CHECKLIST BERKAS --}}
    <div class="section-title">
        Ceklist Berkas Yang Harus Dibawa Ketika Daftar Ulang <span style="font-weight: normal; font-size: 11pt;">(silahkan dicentang sendiri pada kotak)</span>
    </div>
    <ul class="list-checklist">
        <li>1. <span class="box"></span> Pas Foto ukuran 3x4 berwarna & background merah (4 Lembar)</li>
        <li>2. <span class="box"></span> Foto Copy Akta Kelahiran (4 Lembar)</li>
        <li>3. <span class="box"></span> Foto Copy Kartu Keluarga (4 Lembar)</li>
        <li>4. <span class="box"></span> NISN (2 Lembar)</li>
        <li>5. <span class="box"></span> Foto Copy KTP orang tua (4 Lembar)</li>
        <li>6. <span class="box"></span> Materai 10.000 (1 Lembar)</li>
    </ul>

    {{-- CATATAN --}}
    <div class="section-title">Catatan:</div>
    <ol class="catatan">
        <li>Silakan mencetak bukti pendaftaran ini 2x.</li>
        <li>Bukti pendaftaran WAJIB dibawa ketika melaksanakan daftar ulang dan seleksi penentuan kelas.</li>
        <li>Harap datang 15 menit lebih awal dari waktu tes.</li>
    </ol>

    {{-- FOOTER --}}
    <div class="footer-text">
        Selamat! Anda telah berhasil mendaftar PPDB Online Pondok Pesantren Al-Mardliyyah Kota Madiun untuk <strong>{{ $data->periode->nama_periode ?? 'periode ini' }}</strong>.
    </div>

</body>
</html>