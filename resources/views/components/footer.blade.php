{{-- 
    Bagian CTA (Call to Action)
    Bagian ini hanya akan muncul jika variabel $showCTA diset sebagai true.
    Cocok digunakan untuk Halaman Profil atau Beranda.
--}}
@if(isset($showCTA) && $showCTA)
    <div class="bg-[#52795b] py-20 px-4 text-center text-white">
        <h2 class="text-3xl md:text-4xl font-bold mb-4">
            Pendaftaran Santri Baru Telah Dibuka
        </h2>
        <p class="text-lg opacity-90 mb-10 max-w-2xl mx-auto leading-relaxed">
            Bergabunglah dengan ribuan santri kami dan mulai perjalanan pendidikan Anda di Pondok Pesantren Al-Mardliyyah
        </p>
        <a href="{{ route('register') }}" 
           class="bg-[#c9a76d] hover:bg-[#b5955e] text-white font-bold px-10 py-3 rounded-lg shadow-lg transition duration-300 inline-block uppercase tracking-wider text-sm">
            Daftar Sekarang
        </a>
    </div>
@endif

{{-- 2. FOOTER UTAMA (WAJIB ADA PEMBUNGKUS INI) --}}
<footer class="bg-[#1e4d2b] text-white py-16 px-12 mt-auto w-full">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
        
        {{-- BAGIAN 1: BRAND & LOGO (Dinamis dari $profil) --}}
        <div class="space-y-6">
            <div class="flex items-center gap-3">
                <img src="{{ asset($profil->logo ?? 'images/logo.jpg') }}" alt="Logo" class="w-12 h-12 object-contain rounded-lg">
                <h2 class="font-bold text-xl uppercase tracking-wider">{{ $profil->nama_pondok ?? 'Al-Mardliyyah' }}</h2>
            </div>
            <p class="text-sm leading-relaxed text-gray-200">
                {{ $profil->tagline ?? 'Institusi pendidikan islam modern yang berkomitmen menghadirkan generasi cendekiawan berakhlak karimah.' }}
            </p>
        </div>

        {{-- BAGIAN 2: NAVIGASI CEPAT --}}
        <div>
            <h3 class="font-bold text-lg mb-6">Navigasi Cepat</h3>
            <ul class="space-y-3 text-sm text-gray-200">
                <li><a href="/" class="hover:text-white transition {{ Request::is('/') ? 'font-bold' : '' }}">Beranda</a></li>
                <li><a href="{{ route('profile') }}" class="hover:text-white transition {{ Request::is('profil*') ? 'font-bold' : '' }}">Profil</a></li>
                <li><a href="{{ route('berita') }}" class="hover:text-white transition {{ Request::is('berita*') ? 'font-bold' : '' }}">Berita</a></li>
                <li><a href="{{ route('register') }}" class="hover:text-white transition {{ Request::is('register*') ? 'font-bold' : '' }}">Pendaftaran</a></li>
            </ul>
        </div>

        {{-- BAGIAN 3: KONTAK DINAMIS (Pindahkan kodenya ke sini) --}}
        <div class="space-y-4">
            <h3 class="font-bold text-lg mb-6">Kontak</h3>
            
            @php $alamat = $kontaks->where('tipe', 'alamat')->first(); @endphp
            <div class="flex gap-4 items-start text-sm text-gray-200">
                <span class="text-lg">📍</span>
                <p>{{ $alamat->nilai ?? 'Alamat belum diatur' }}</p>
            </div>

            @php $telepon = $kontaks->where('tipe', 'telepon')->first(); @endphp
            <div class="flex gap-4 items-start text-sm text-gray-200">
                <span class="text-lg">📞</span>
                <p>{{ $telepon->nilai ?? 'Telepon belum diatur' }}</p>
            </div>

            @php $email = $kontaks->where('tipe', 'email')->first(); @endphp
            <div class="flex gap-4 items-center text-sm text-gray-200">
                <span class="text-lg">📧</span>
                <p>{{ $email->nilai ?? 'Email belum diatur' }}</p>
            </div>
        </div>

        {{-- BAGIAN 4: SOSMED DINAMIS (Pindahkan kodenya ke sini) --}}
        <div>
            <h3 class="font-bold text-lg mb-6">Ikuti Kami</h3>
            <div class="flex gap-4">
                @foreach($kontaks->where('tipe', 'sosmed') as $sosmed)
                    <a href="{{ $sosmed->link }}" target="_blank" class="hover:scale-110 transition-transform">
                        <img src="{{ asset($sosmed->icon) }}" class="w-8 h-8" alt="{{ $sosmed->judul }}">
                    </a>
                @endforeach
            </div>
        </div>

    </div>

    {{-- COPYRIGHT --}}
    <div class="max-w-7xl mx-auto border-t border-white/10 mt-12 pt-8 text-center text-xs text-gray-400">
        <p>&copy; {{ date('Y') }} {{ $profil->nama_pondok ?? 'Pondok Pesantren Al-Mardliyyah' }}. All rights reserved.</p>
    </div>
</footer>