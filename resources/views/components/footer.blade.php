{{-- 
    Bagian CTA (Call to Action)
    Bagian ini hanya akan muncul jika variabel $showCTA diset sebagai true.
    Cocok digunakan untuk Halaman Profil atau Beranda.
--}}
@if(isset($showCTA) && $showCTA)
    <div class="bg-[#52795b] py-20 px-4 text-center text-white">
        {{-- Judul Besar --}}
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Pendaftaran Santri Baru Telah Dibuka
        </h2>
        
        {{-- Deskripsi --}}
        <p class="text-lg opacity-90 mb-10 max-w-2xl mx-auto leading-relaxed">
            Bergabunglah dengan ribuan santri kami dan mulai perjalanan perjalanan pendidikan Anda di Pondok Pesantren Al-Mardliyyah
        </p>

        {{-- Tombol Daftar --}}
        <a href="{{ route('register') }}" 
           class="bg-[#c9a76d] hover:bg-[#b5955e] text-white font-bold px-10 py-3 rounded-lg shadow-lg transition duration-300 inline-block uppercase tracking-wider text-sm">
            Daftar Sekarang
        </a>
    </div>
@endif

<!-- =============================================================================================================================================================================================== -->

{{-- FOOTER UTAMA --}}
<footer class="bg-[#1e4d2b] text-white py-16 px-12">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
        
        {{-- BAGIAN 1: BRAND & LOGO --}}
        <div class="space-y-6">
            <div class="flex items-center gap-3">
                {{-- Menampilkan logo.jpg dari folder public/images/ --}}
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo Al-Mardliyyah" class="w-12 h-12 object-contain rounded-lg">
                <h2 class="font-bold text-xl uppercase tracking-wider">Al-Mardliyyah</h2>
            </div>
            <p class="text-sm leading-relaxed text-gray-200">
                Pondok pesantren Al-Mardliyyah adalah institusi pendidikan islam modern yang berkomitmen menghadirkan generasi cendekiawan berakhlak karimah.
            </p>
        </div>

       {{-- BAGIAN 2: NAVIGASI CEPAT --}}
<div>
    <h3 class="font-bold text-lg mb-6 text-white">Navigasi Cepat</h3>
    <ul class="space-y-3 text-sm text-gray-200">
        {{-- Beranda --}}
        <li>
            <a href="/" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block {{ Request::is('/') ? 'font-bold text-white' : '' }}">
                Beranda
            </a>
        </li>
        
        {{-- Profil (CEK APAKAH AKTIF) --}}
        <li>
            <a href="{{ route('profile') }}" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block {{ Request::is('profil*') ? 'font-bold text-white underline underline-offset-4' : '' }}">
                Profil
            </a>
        </li>

        {{-- Program Pendidikan --}}
        <li>
            <a href="#" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block">
                Program Pendidikan
            </a>
        </li>

        {{-- Berita --}}
        <li>
            <a href="#" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block">
                Berita
            </a>
        </li>

        {{-- Galeri --}}
        <li>
            <a href="#" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block">
                Galeri
            </a>
        </li>

        {{-- Pendaftaran (CEK APAKAH AKTIF) --}}
        <li>
            <a href="{{ route('register') }}" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block {{ Request::is('register*') || Request::is('login*') ? 'font-bold text-white underline underline-offset-4' : '' }}">
                Pendaftaran
            </a>
        </li>

        {{-- Kontak --}}
        <li>
            <a href="#" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block">
                Kontak
            </a>
        </li>
    </ul>
</div>

        {{-- BAGIAN 3: KONTAK --}}
        <div class="space-y-4">
            <h3 class="font-bold text-lg mb-6">Kontak</h3>
            {{-- Alamat --}}
            <div class="flex gap-4 items-start text-sm text-gray-200">
                <span class="text-lg">📍</span>
                <p>Jl. H. Moch. Noer No. 1, RT/RW 01/01, Kelurahan Demangan, Kecamatan Taman, Kota Madiun, Jawa Timur</p>
            </div>
            {{-- Telepon --}}
            <div class="flex gap-4 items-start text-sm text-gray-200">
                <span class="text-lg">📞</span>
                <p>0856 0448 7824 (Putra)<br>0857 0678 5032 (Putri)</p>
            </div>
            {{-- Email --}}
            <div class="flex gap-4 items-center text-sm text-gray-200">
                <span class="text-lg">📧</span>
                <p>almardliyyahpondok@gmail.com</p>
            </div>
        </div>

        {{-- BAGIAN 4: SOSIAL MEDIA --}}
        <div>
            <h3 class="font-bold text-lg mb-6">Ikuti Kami</h3>
            <div class="flex gap-4">
                {{-- Instagram --}}
                <a href="#" class="w-10 h-10 bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-600 rounded-lg flex items-center justify-center text-xl hover:scale-110 transition-transform">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" class="w-6 h-6 invert-0" alt="Instagram">
                </a>
                {{-- YouTube --}}
                <a href="#" class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center text-xl hover:scale-110 transition-transform">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/09/YouTube_full-color_icon_%282017%29.svg" class="w-6 h-6" alt="YouTube">
                </a>
                {{-- Facebook --}}
                <a href="#" class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-xl hover:scale-110 transition-transform">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b8/2021_Facebook_icon.svg" class="w-6 h-6" alt="Facebook">
                </a>
            </div>
        </div>

    </div>

    {{-- BAGIAN COPYRIGHT --}}
    <div class="max-w-7xl mx-auto border-t border-white/10 mt-12 pt-8 text-center text-xs text-gray-400">
        <p>&copy; {{ date('Y') }} Pondok Pesantren Al-Mardliyyah Madiun. All rights reserved.</p>
    </div>
</footer>