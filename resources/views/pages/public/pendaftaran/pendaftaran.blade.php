@extends('layouts.app')

@php
    $showCTA = true;
@endphp

@section('content')

{{-- POPUP KETIKA PENDAFTARAN DITUTUP (Awalnya Disembunyikan) --}}
<div id="popupTutup" class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center z-50 hidden opacity-0 transition-opacity duration-300">
    <div id="popupContent" class="bg-white p-8 rounded-2xl text-center shadow-2xl max-w-sm border-t-4 border-red-600 transform scale-95 transition-transform duration-300">
        <div class="w-16 h-16 bg-red-100 text-red-600 rounded-full flex items-center justify-center mx-auto mb-4 text-3xl shadow-sm">
            🔒
        </div>
        <h2 class="text-xl font-bold text-gray-800 mb-2">
            Pendaftaran Ditutup
        </h2>
        <p class="text-sm text-gray-500 mb-6 leading-relaxed">
            Mohon maaf, pendaftaran santri baru saat ini sedang ditutup atau berada di luar jadwal. Silakan cek informasi jadwal di halaman ini.
        </p>
        <button onclick="tutupPopup()" class="bg-[#1E5631] text-white px-6 py-2.5 rounded-lg hover:bg-[#17472a] transition-all font-semibold shadow-md inline-block w-full">
            Tutup & Lanjut Membaca
        </button>
    </div>
</div>

<div class="bg-[#1E5631] text-white px-20 py-20" data-aos="fade-down" data-aos-duration="1000">
    <p class="text-sm mb-4 opacity-80">Beranda > Pendaftaran</p>
    
    <h1 class="text-3xl font-bold mb-3">
        Pendaftaran Santri Baru
    </h1>

    {{-- NAMA PERIODE DINAMIS DITAMPILKAN DI SINI --}}
    @if($periodeAktif)
        <div class="inline-block bg-[#C6A75E] text-white px-4 py-1.5 rounded-full text-sm font-bold mb-4 shadow-md tracking-wide">
            {{ $periodeAktif->nama_periode }}
        </div>
    @endif

    {{-- Teks paragrafnya kita buat lebih umum agar cocok untuk tahun berapapun --}}
    <p class="max-w-2xl text-sm leading-relaxed text-gray-100 opacity-90">
        Pondok Pesantren Al-Mardliyyah resmi membuka pendaftaran santri baru. Bergabunglah bersama kami untuk pendidikan Islam yang berkualitas dan berakhlak mulia.
    </p>
</div>

<section class="bg-white py-16">
    <div class="max-w-6xl mx-auto text-center mb-16 px-6">

        <div data-aos="fade-up" data-aos-duration="800">
            <div class="inline-block bg-[#D8E6E0] text-[#1E5631] px-4 py-1 rounded-lg text-sm mb-4 font-medium">
                Informasi Pendaftaran
            </div>
            <h2 class="text-2xl font-semibold text-[#1E5631] mb-2">
                Yang Perlu Anda Ketahui
            </h2>
            <p class="text-sm text-gray-600 mb-10">
                Informasi lengkap mengenai persyaratan, jadwal, alur, dan biaya pendaftaran
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 text-left mb-16 items-stretch">

            {{-- ================= CARD 1: PERSYARATAN ================= --}}
            <div data-aos="fade-up" data-aos-delay="100" data-aos-duration="800" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-[300px] relative">
                <div class="w-14 h-14 shrink-0 bg-[#1E5631] rounded-2xl flex items-center justify-center p-3 mb-6 shadow-md transition-transform duration-500 hover:rotate-6">
                    <img src="{{ asset('images/ikon_dokumen.png') }}" alt="Ikon Dokumen" class="w-full h-full object-contain">
                </div>
                
                <div class="flex flex-col flex-grow overflow-hidden">
                    <h4 class="font-bold text-[#1E5631] mb-3 text-lg uppercase tracking-wider leading-tight shrink-0">
                        Persyaratan Pendaftaran
                    </h4>
                    
                    <div class="text-xs text-gray-600 leading-relaxed space-y-1 flex-grow overflow-y-auto scroll-elegan pr-2">
                        @if($periodeAktif && $periodeAktif->persyaratan)
                            <ul class="space-y-1">
                                @foreach(explode("\n", str_replace("\r", "", $periodeAktif->persyaratan)) as $baris)
                                    @if(trim($baris) !== '')
                                        <li class="flex gap-2">
                                            <span>•</span>
                                            <span class="text-gray-600">{{ ltrim(trim($baris), '- •') }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500 italic">Belum ada informasi persyaratan.</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ================= CARD 2: JADWAL PENDAFTARAN ================= --}}
            <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="800" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-[300px] relative">
                <div class="w-14 h-14 shrink-0 bg-[#1E5631] rounded-2xl flex items-center justify-center p-3 mb-6 shadow-md transition-transform duration-500 hover:rotate-6">
                    <img src="{{ asset('images/ikon_dokumen.png') }}" alt="Ikon Dokumen" class="w-full h-full object-contain">
                </div>
                
                <div class="flex flex-col flex-grow overflow-hidden">
                    <h4 class="font-bold text-[#1E5631] mb-3 text-lg uppercase tracking-wider leading-tight shrink-0">
                        Jadwal Pendaftaran
                    </h4>
                    
                    <div class="text-xs text-gray-600 leading-relaxed space-y-1 flex-grow overflow-y-auto scroll-elegan pr-2">
                        @if($periodeAktif)
                            <ul class="space-y-1">
                                <li class="flex gap-2">
                                    <span>•</span>
                                    <span class="w-16">Pembukaan</span>
                                    <span>: </span>
                                    @if($statusBuka)
                                        <span class="text-gray-800 font-medium">{{ $periodeAktif->tanggal_mulai ? \Carbon\Carbon::parse($periodeAktif->tanggal_mulai)->translatedFormat('d F Y') : '-' }}</span>
                                    @else
                                        <span class="text-red-600 font-bold uppercase">Pendaftaran Telah Ditutup</span>
                                    @endif
                                </li>
                                <li class="flex gap-2">
                                    <span>•</span>
                                    <span class="w-16">Penutupan</span>
                                    <span>: </span>
                                    @if($statusBuka)
                                        <span class="text-gray-800 font-medium">{{ $periodeAktif->tanggal_selesai ? \Carbon\Carbon::parse($periodeAktif->tanggal_selesai)->translatedFormat('d F Y') : '-' }}</span>
                                    @else
                                        <span class="text-red-600 font-bold uppercase">Pendaftaran Telah Ditutup</span>
                                    @endif
                                </li>
                            </ul>

                            {{-- Garis Pemisah Hitam Tipis --}}
                            <div class="border-t border-gray-800 my-3 w-10/12"></div>

                            {{-- Jadwal Tambahan (Dinamis dari Admin) --}}
                            <div class="mt-3">
                                @if($periodeAktif->jadwal_tambahan && $periodeAktif->jadwal_tambahan !== '')
                                    <ul class="space-y-1">
                                        @foreach(explode("\n", str_replace("\r", "", $periodeAktif->jadwal_tambahan)) as $baris)
                                            @if(trim($baris) !== '')
                                                <li class="flex gap-2">
                                                    <span>•</span>
                                                    <span class="text-gray-600">{{ ltrim(trim($baris), '- •') }}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-gray-500 italic text-[11px]">Belum ada jadwal tambahan.</span>
                                @endif
                            </div>
                        @else
                            <span class="text-gray-500 italic">Belum ada jadwal pendaftaran yang ditetapkan.</span>
                        @endif
                    </div>
                </div>
            </div>

            {{-- ================= CARD 3: BIAYA ================= --}}
            <div data-aos="fade-up" data-aos-delay="300" data-aos-duration="800" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-[300px] relative">
                <div class="w-14 h-14 shrink-0 bg-[#1E5631] rounded-2xl flex items-center justify-center p-3 mb-6 shadow-md transition-transform duration-500 hover:rotate-6">
                    <img src="{{ asset('images/ikon_dokumen.png') }}" alt="Ikon Dokumen" class="w-full h-full object-contain">
                </div>
                
                <div class="flex flex-col flex-grow overflow-hidden">
                    <h4 class="font-bold text-[#1E5631] mb-4 text-lg uppercase tracking-wider leading-tight shrink-0">
                        Biaya Pendaftaran
                    </h4>
                    
                    <div class="text-xs text-gray-600 leading-relaxed space-y-1 flex-grow overflow-y-auto scroll-elegan pr-2">
                        @if($periodeAktif && $periodeAktif->biaya)
                            <ul class="space-y-1">
                                @foreach(explode("\n", str_replace("\r", "", $periodeAktif->biaya)) as $baris)
                                    @if(trim($baris) !== '')
                                        <li class="flex gap-2">
                                            <span>•</span>
                                            <span class="text-gray-600">{{ ltrim(trim($baris), '- •') }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500 italic">Belum ada rincian biaya.</span>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>    

    <section class="bg-gray-50 py-16 bg">      
        <div class="max-w-6xl mx-auto text-center px-6">
            <div data-aos="fade-up" data-aos-duration="800">
                <div class="inline-block bg-[#D8E6E0] text-[#1E5631] px-4 py-1 rounded-lg text-sm mb-4 font-medium">
                    Alur Pendaftaran
                </div>
                <h2 class="text-2xl font-semibold text-[#1E5631] mb-2">
                    Langkah Pendaftaran
                </h2>
                <p class="text-sm text-gray-600 mb-10">
                    Ikuti langkah-langkah berikut untuk menyelesaikan pendaftaran!
                </p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-4 gap-6 text-left">
                <div data-aos="zoom-in" data-aos-delay="100" class="bg-white p-5 rounded-xl shadow-sm relative border border-gray-100 group hover:border-[#1E5631] transition-colors">
                     <div class="absolute -top-4 left-4 bg-[#C6A75E] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold shadow-md">1</div>
                    <div class="w-12 h-12 bg-[#D8E6E0] rounded-xl mb-4 flex items-center justify-center text-xl group-hover:scale-110 transition-transform duration-300">👤</div>
                    <h4 class="font-semibold text-[#1E5631] text-sm mb-1">Buat Akun</h4>
                    <p class="text-[11px] text-gray-500 leading-relaxed">Daftarkan akun baru dengan mengisi data diri yang valid untuk memulai proses pendaftaran.</p>
                </div>

                <div data-aos="zoom-in" data-aos-delay="200" class="bg-white p-5 rounded-xl shadow-sm relative border border-gray-100 group hover:border-[#1E5631] transition-colors">
                    <div class="absolute -top-4 left-4 bg-[#C6A75E] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold shadow-md">2</div>
                    <div class="w-12 h-12 bg-[#D8E6E0] rounded-xl mb-4 flex items-center justify-center text-xl group-hover:scale-110 transition-transform duration-300">📝</div>
                    <h4 class="font-semibold text-[#1E5631] text-sm mb-1">Isi Formulir</h4>
                    <p class="text-[11px] text-gray-500 leading-relaxed">Lengkapi formulir online dengan data diri calon santri dan wali yang valid.</p>
                </div>

                <div data-aos="zoom-in" data-aos-delay="300" class="bg-white p-5 rounded-xl shadow-sm relative border border-gray-100 group hover:border-[#1E5631] transition-colors">
                    <div class="absolute -top-4 left-4 bg-[#C6A75E] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold shadow-md">3</div>
                    <div class="w-12 h-12 bg-[#D8E6E0] rounded-xl mb-4 flex items-center justify-center text-xl group-hover:scale-110 transition-transform duration-300">📤</div>
                    <h4 class="font-semibold text-[#1E5631] text-sm mb-1">Upload Dokumen</h4>
                    <p class="text-[11px] text-gray-500 leading-relaxed">Upload dokumen persyaratan seperti Pas Foto, KK, KTP Orang Tua, dan Ijazah.</p>
                </div>

                <div data-aos="zoom-in" data-aos-delay="400" class="bg-white p-5 rounded-xl shadow-sm relative border border-gray-100 group hover:border-[#1E5631] transition-colors">
                    <div class="absolute -top-4 left-4 bg-[#C6A75E] text-white w-8 h-8 flex items-center justify-center rounded-full text-sm font-bold shadow-md">4</div>
                    <div class="w-12 h-12 bg-[#D8E6E0] rounded-xl mb-4 flex items-center justify-center text-xl group-hover:scale-110 transition-transform duration-300">🔔</div>
                    <h4 class="font-semibold text-[#1E5631] text-sm mb-1">Status</h4>
                    <p class="text-[11px] text-gray-500 leading-relaxed">Pantau status pendaftaran Anda secara berkala untuk mengetahui hasil seleksi.</p>
                </div>
            </div>
        </div>
    </section>    

{{-- SCRIPT UNTUK ANIMASI POPUP --}}
<script>
    function bukaPopupTutup() {
        const popup = document.getElementById('popupTutup');
        const content = document.getElementById('popupContent');
        
        popup.classList.remove('hidden');
        void popup.offsetWidth; 
        
        popup.classList.remove('opacity-0');
        content.classList.remove('scale-95');
        
        document.body.style.overflow = 'hidden';
    }

    function tutupPopup() {
        const popup = document.getElementById('popupTutup');
        const content = document.getElementById('popupContent');
        
        popup.classList.add('opacity-0');
        content.classList.add('scale-95');
        
        setTimeout(() => {
            popup.classList.add('hidden');
            document.body.style.overflow = 'auto';
        }, 300);
    }
</script>

@endsection