<x-mail::message>
# Pengumuman Hasil Seleksi PPDB

Assalamu'alaikum Warahmatullahi Wabarakatuh,

Yth. Bapak/Ibu Wali dari Calon Santri **{{ $santri->nama_lengkap }}**,

Terima kasih atas minat dan kepercayaan Bapak/Ibu untuk mendaftarkan ananda ke Pondok Pesantren Al-Mardliyyah.

Setelah melalui tahapan verifikasi dan seleksi oleh panitia, dengan berat hati kami menyampaikan bahwa pada periode ini ananda **belum dapat kami terima** menjadi santri di Pondok Pesantren Al-Mardliyyah.

Berikut adalah catatan dari panitia penerimaan:
<x-mail::panel>
**Alasan Penolakan:**
{{ $catatanAdmin }}
</x-mail::panel>

Kami mendoakan yang terbaik untuk pendidikan ananda ke depannya. Tetap semangat dan semoga mendapatkan tempat pendidikan yang paling tepat.

Wassalamu'alaikum Warahmatullahi Wabarakatuh,

Panitia PPDB,<br>
**{{ config('app.name') }}**
</x-mail::message>