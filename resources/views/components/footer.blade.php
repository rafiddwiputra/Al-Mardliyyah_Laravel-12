{{-- 
    Bagian CTA (Call to Action)
--}}
@if(isset($showCTA) && $showCTA)

@php
    // Mengecek status periode pendaftaran yang baru
    $periodeAktif = \App\Models\Public\PeriodePendaftaran::where('status', 1)->latest()->first();
    
    $status = false; // <-- UBAH DARI $isBuka MENJADI $status
    
    if($periodeAktif && $periodeAktif->tanggal_mulai && $periodeAktif->tanggal_selesai) {
        $hariIni = \Carbon\Carbon::now();
        $mulai = \Carbon\Carbon::parse($periodeAktif->tanggal_mulai)->startOfDay();
        $selesai = \Carbon\Carbon::parse($periodeAktif->tanggal_selesai)->endOfDay();
        
        if($hariIni->between($mulai, $selesai)) {
            $status = true; // <-- UBAH JUGA DI SINI
        }
    }
@endphp

<div class="bg-[#4F7C5C] text-white py-20 text-center px-6">
    <h3 class="text-2xl font-semibold mb-4">
        {{ $status ? 'Pendaftaran Santri Baru Telah Dibuka' : 'Pendaftaran Saat Ini Ditutup' }}
    </h3>

    <p class="text-sm mb-8 max-w-xl mx-auto text-gray-200">
        Bergabunglah dengan ribuan santri kami dan mulai perjalanan pendidikan Anda di Pondok Pesantren Al-Mardliyyah
    </p>

    {{-- CTA LOGIKA SAMA --}}
    @if($status)
        @auth
            <a href="{{ route('formulir') }}"
               class="bg-[#C6A75E] text-white px-8 py-3 rounded-lg font-bold inline-block hover:bg-[#b59650] transition shadow-lg animate-heartbeat">
                Lanjutkan Pendaftaran
            </a>
        @else

    @if(Request::is('pendaftaran'))
        <a href="{{ route('register') }}"
           class="bg-[#C6A75E] text-white px-8 py-3 rounded-lg font-bold inline-block hover:bg-[#b59650] transition shadow-lg animate-heartbeat">
            Daftar Sekarang
        </a>
    @else
        <a href="{{ route('pendaftaran') }}"
           class="bg-[#C6A75E] text-white px-8 py-3 rounded-lg font-bold inline-block hover:bg-[#b59650] transition shadow-lg animate-heartbeat">
            Daftar Sekarang
        </a>
    @endif
    @endauth
    @else
        <button onclick="bukaPopupTutup()"
            class="bg-[#C6A75E] text-white px-8 py-3 rounded-lg font-bold inline-block hover:bg-[#b59650] transition shadow-lg animate-heartbeat">
            Daftar Sekarang
        </button>
    @endif
</div>

{{-- POPUP --}}
<div id="popupTutup" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
    <div class="bg-white p-8 rounded-xl text-center max-w-sm">
        <h2 class="font-bold text-lg mb-2 text-red-600">Pendaftaran Ditutup</h2>
        <p class="text-sm text-gray-500 mb-4">
            Pendaftaran sedang tidak dibuka saat ini.
        </p>
        <button onclick="tutupPopup()" class="bg-[#1E5631] text-white px-4 py-2 rounded">
            Tutup
        </button>
    </div>
</div>

<script>
function bukaPopupTutup() {
    document.getElementById('popupTutup').classList.remove('hidden');
    document.getElementById('popupTutup').classList.add('flex');
}

function tutupPopup() {
    document.getElementById('popupTutup').classList.add('hidden');
}
</script>

@endif

{{-- FOOTER UTAMA --}}
<footer class="bg-[#1e4d2b] text-white py-16 px-12 mt-auto w-full">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
        
        {{-- BAGIAN 1: BRAND & LOGO (HARDCODE) --}}
        <div class="space-y-6">
            <div class="flex items-center gap-3">
                <img src="{{ asset('images/logo-pondok.png') }}" class="w-14 h-14 object-contain bg-white p-1 rounded" alt="Logo Al-Mardliyyah">
                <h2 class="font-bold text-xl uppercase tracking-wider leading-tight">
                    Pondok Pesantren<br>Al-Mardliyyah
                </h2>
            </div>
            <p class="text-sm leading-relaxed text-gray-200">
                Membentuk Generasi Qur'ani yang Berakhlak Mulia dan Berprestasi.
            </p>
        </div>

        {{-- BAGIAN 2: NAVIGASI CEPAT --}}
        <div>
            <h3 class="font-bold text-lg mb-6 border-b border-white/10 pb-2 inline-block">Navigasi Cepat</h3>
            <ul class="space-y-3 text-sm text-gray-200">
                <li><a href="/" class="hover:text-[#c9a76d] transition {{ Request::is('/') ? 'font-bold text-white' : '' }}">Beranda</a></li>

                <li><a href="{{ route('profile') }}" class="hover:text-[#c9a76d] transition {{ Request::is('profil*') ? 'font-bold text-white' : '' }}">Profil</a></li>

                <li><a href="{{ route('program') }}" class="hover:text-[#c9a76d] transition {{ Request::is('program*') ? 'font-bold text-white' : '' }}">Program</a></li>

                <li><a href="{{ route('berita') }}" class="hover:text-[#c9a76d] transition {{ Request::is('berita*') ? 'font-bold text-white' : '' }}">Berita</a></li>
                
                <li><a href="{{ route('galeri') }}" class="hover:text-[#c9a76d] transition {{ Request::is('galeri*') ? 'font-bold text-white' : '' }}">Galeri</a></li>

                <li><a href="{{ url('/pendaftaran') }}" class="hover:text-[#c9a76d] transition {{ Request::is('pendaftaran*') ? 'font-bold text-white' : '' }}">Pendaftaran</a></li>
                
                <li><a href="{{ route('kontak') }}" class="hover:text-[#c9a76d] transition {{ Request::is('kontak*') ? 'font-bold text-white' : '' }}">Kontak</a></li>
            </ul>
        </div>

        {{-- BAGIAN 3: KONTAK & MAPS --}}
        <div>
            <h3 class="font-bold text-lg mb-6 border-b border-white/10 pb-2 inline-block">Kontak & Lokasi</h3>
            <div class="space-y-5">
                
                {{-- Looping Kontak Dinamis dari AppServiceProvider --}}
                @foreach($globalKontak as $gk)
                    @php
                        $waNomor = preg_replace('/[^0-9]/', '', $gk->no_hp);
                        if (str_starts_with($waNomor, '0')) {
                            $waNomor = '62' . substr($waNomor, 1);
                        }
                    @endphp
                    <div class="flex gap-3 items-start text-sm text-gray-200 group">
                        <svg class="w-5 h-5 text-[#25D366] shrink-0 mt-0.5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.446-.272.371-1.04 1.015-1.04 2.475 0 1.46 1.065 2.871 1.213 3.07.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
                        </svg>
                        <div>
                            <p class="font-bold text-white text-xs uppercase tracking-tighter opacity-70">
                                {{ $gk->id == 1 ? 'Panitia Putra' : 'Panitia Putri' }}
                            </p>
                            <a href="https://wa.me/{{ $waNomor }}" target="_blank" class="hover:text-[#c9a76d] transition-colors">
                                {{ $gk->no_hp }}
                            </a>
                        </div>
                    </div>
                @endforeach

                {{-- Alamat Asli & Peta --}}
                <div class="flex gap-3 items-start text-sm text-gray-200 pt-2 border-t border-white/10 mt-2">
                    <svg class="w-5 h-5 text-red-500 shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <div class="flex-1">
                        <p class="leading-relaxed mb-3">
                            Jl. H. Moch Noer, RT.01/RW.01, Demangan, Kec. Taman, Kota Madiun, Jawa Timur 63136
                        </p>
                        
                        <a href="https://maps.app.goo.gl/t1K41PeTNDuQY9dHA" target="_blank" rel="noopener noreferrer" class="block relative rounded-lg overflow-hidden group border border-white/20 shadow-md">
                            <div class="w-full h-24 bg-[#52795b] relative overflow-hidden flex items-center justify-center">
                                <img src="{{ asset('images/maps.png') }}" alt="Peta Lokasi Pondok" class="w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-110 transition-all duration-700 ease-in-out">
                                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/10 transition-all flex items-center justify-center">
                                    <span class="bg-[#1E5631] text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-xl flex items-center gap-1.5 transform group-hover:scale-105 transition-transform">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"></path></svg>
                                        Buka di Maps
                                    </span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

            </div>
        </div>

        {{-- BAGIAN 4: MEDIA SOSIAL (LINK & LOGO SVG OTOMATIS) --}}
        <div>
            <h3 class="font-bold text-lg mb-6 border-b border-white/10 pb-2 inline-block">Ikuti Kami</h3>
            <p class="text-xs text-gray-300 mb-5 italic">Dapatkan informasi terbaru melalui media sosial resmi kami:</p>
            <div class="flex gap-4">
                
                <a href="https://www.instagram.com/almardliyyah.demangan?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" target="_blank" 
                   class="bg-white/10 p-2.5 rounded-lg hover:bg-[#E1306C] text-gray-300 hover:text-white transition-all hover:-translate-y-1 shadow-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zM12 0C8.741 0 8.333.014 7.053.072 2.695.272.273 2.69.073 7.052.014 8.333 0 8.741 0 12c0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98C8.333 23.986 8.741 24 12 24c3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98C15.668.014 15.259 0 12 0zm0 5.838a6.162 6.162 0 100 12.324 6.162 6.162 0 000-12.324zM12 16a4 4 0 110-8 4 4 0 010 8zm6.406-11.845a1.44 1.44 0 100 2.881 1.44 1.44 0 000-2.881z"/>
                    </svg>
                </a>

                <a href="https://www.facebook.com/share/18MpGAx7LZ/" target="_blank" 
                   class="bg-white/10 p-2.5 rounded-lg hover:bg-[#1877F2] text-gray-300 hover:text-white transition-all hover:-translate-y-1 shadow-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                    </svg>
                </a>

                <a href="https://www.tiktok.com/@almardliyyah?_r=1&_t=ZS-95r7mXYTaFt" target="_blank" 
                   class="bg-white/10 p-2.5 rounded-lg hover:bg-[#000000] text-gray-300 hover:text-white transition-all hover:-translate-y-1 shadow-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93-.01 2.92.01 5.84-.02 8.75-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72.02 1.48-.04 2.96-.04 4.44-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36.01-4.03-.01-8.05.02-12.07z"/>
                    </svg>
                </a>

                <a href="https://youtube.com/@al-mardliyyah448?si=VNv1pjNiPgOYqSRS" target="_blank" 
                   class="bg-white/10 p-2.5 rounded-lg hover:bg-[#FF0000] text-gray-300 hover:text-white transition-all hover:-translate-y-1 shadow-sm">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93-.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                    </svg>
                </a>
                
            </div>
        </div>

    </div>

    {{-- COPYRIGHT --}}
    <div class="max-w-7xl mx-auto border-t border-white/10 mt-12 pt-8 text-center text-xs text-gray-400">
        <p>© {{ date('Y') }} Pondok Pesantren Al-Mardliyyah. Seluruh Hak Cipta Dilindungi.</p>
    </div>
</footer>