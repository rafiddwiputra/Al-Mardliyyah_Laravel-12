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

{{-- ================= HERO SECTION ================= --}}
<div class="bg-[#1E5631] text-white px-6 md:px-20 py-20" 
     data-aos="fade-down" 
     data-aos-duration="1000">

    <div class="max-w-6xl mx-auto">
        
        <p class="text-sm mb-4 opacity-80 text-white">
            Beranda > Pendaftaran
        </p>
        
        <h1 class="text-4xl font-bold mb-4 text-white">
            Pendaftaran Santri Baru
        </h1>

        {{-- NAMA PERIODE DINAMIS --}}
        @if($periodeAktif)
            <div class="inline-block bg-[#C6A75E] text-white px-4 py-1.5 rounded-full text-sm font-bold mb-4 shadow-md tracking-wide">
                {{ $periodeAktif->nama_periode }}
            </div>
        @endif

        <p class="max-w-2xl text-base leading-relaxed opacity-90 text-gray-100">
            Pondok Pesantren Al-Mardliyyah resmi membuka pendaftaran santri baru. Bergabunglah bersama kami untuk pendidikan Islam yang berkualitas dan berakhlak mulia.
        </p>

    </div>
</div>

<section class="bg-white py-16">
    <div class="max-w-6xl mx-auto text-center mb-16 px-6">

        <div data-aos="fade-up" data-aos-duration="800">
            <div class="inline-block bg-[#D8E6E0] px-5 py-2 rounded-lg mb-4">
                <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wide">
                    Informasi Pendaftaran
                </span>
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
                
                <div class="w-14 h-14 shrink-0 bg-[#E8F2EC] rounded-lg flex items-center justify-center mb-6 transition-transform duration-500 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-8 h-8 text-[#1E5631]"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 12h6m-6 4h6M8 4h5l5 5v11a1 1 0 01-1 1H8a1 1 0 01-1-1V5a1 1 0 011-1z"/>
                    </svg>
                </div>
                
                {{-- Tambahkan 'relative' di sini untuk mengunci posisi efek blur --}}
                <div class="flex flex-col flex-grow overflow-hidden relative">
                    <h4 class="font-bold text-[#1E5631] mb-3 text-lg uppercase tracking-wider leading-tight shrink-0">
                        Persyaratan Pendaftaran
                    </h4>
                    
                    {{-- Tambahkan 'pb-8' agar teks terakhir tidak tertutup penuh oleh efek blur --}}
                    <div class="text-xs text-gray-600 leading-relaxed space-y-1 flex-grow overflow-y-auto scroll-elegan pr-2 pb-8">
                        @if($periodeAktif && $periodeAktif->persyaratan)
                            <ul class="space-y-1">
                                @foreach(explode("\n", str_replace("\r", "", $periodeAktif->persyaratan)) as $baris)
                                    @if(trim($baris) !== '')
                                        <li class="flex gap-2">
                                            <span class="text-gray-600">{{ trim($baris) }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500 italic">Belum ada informasi persyaratan.</span>
                        @endif
                    </div>

                    {{-- INI DIA EFEK BLUR-NYA (Gradasi putih dari bawah ke atas) --}}
                    <div class="absolute bottom-0 left-0 right-0 h-10 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
                </div>
            </div>

            {{-- ================= CARD 2: JADWAL PENDAFTARAN ================= --}}
            <div data-aos="fade-up" data-aos-delay="200" data-aos-duration="800" class="bg-white p-6 rounded-lg shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-[300px] relative">
                
                <div class="w-14 h-14 shrink-0 bg-[#E8F2EC] rounded-lg flex items-center justify-center mb-6 transition-transform duration-500 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-8 h-8 text-[#1E5631]"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M8 7V3m8 4V3m-9 8h10m2 9H5a2 2 0 01-2-2V7a2 2 0 012-2h14a2 2 0 012 2v11a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                
                {{-- Tambahkan 'relative' --}}
                <div class="flex flex-col flex-grow overflow-hidden relative">
                    <h4 class="font-bold text-[#1E5631] mb-3 text-lg uppercase tracking-wider leading-tight shrink-0">
                        Jadwal Pendaftaran
                    </h4>
                    
                    {{-- Tambahkan 'pb-8' --}}
                    <div class="text-xs text-gray-600 leading-relaxed space-y-1 flex-grow overflow-y-auto scroll-elegan pr-2 pb-8">
                        @if($periodeAktif)
                            @php
                                $hariIni = \Carbon\Carbon::now()->startOfDay();
                                $tglMulai = \Carbon\Carbon::parse($periodeAktif->tanggal_mulai)->startOfDay();
                                $tglSelesai = \Carbon\Carbon::parse($periodeAktif->tanggal_selesai)->endOfDay();

                                if ($hariIni->lessThan($tglMulai)) {
                                    $teksStatus = 'Belum Dibuka';
                                    $warnaBadge = 'bg-yellow-100 text-yellow-700 border-yellow-200';
                                } elseif ($hariIni->greaterThan($tglSelesai) || $periodeAktif->status == 0) {
                                    $teksStatus = 'Ditutup';
                                    $warnaBadge = 'bg-[#FECACA] text-[#B91C1C] border-red-200';
                                } else {
                                    $teksStatus = 'Dibuka';
                                    $warnaBadge = 'bg-[#DEFFE9] text-[#1E5631] border-[#1E5631]/20';
                                }
                            @endphp

                            <div class="mb-4">
                                <span class="inline-block px-3 py-1 border rounded-lg text-[10px] font-bold tracking-wide {{ $warnaBadge }}">
                                    Status: {{ $teksStatus }}
                                </span>
                            </div>

                            <ul class="space-y-1">
                                <li class="flex gap-2">
                                    <span>•</span>
                                    <span class="w-16">Pembukaan</span>
                                    <span>: </span>
                                    <span class="text-gray-800 font-medium">{{ $periodeAktif->tanggal_mulai ? \Carbon\Carbon::parse($periodeAktif->tanggal_mulai)->translatedFormat('d F Y') : '-' }}</span>
                                </li>
                                <li class="flex gap-2">
                                    <span>•</span>
                                    <span class="w-16">Penutupan</span>
                                    <span>: </span>
                                    <span class="text-gray-800 font-medium">{{ $periodeAktif->tanggal_selesai ? \Carbon\Carbon::parse($periodeAktif->tanggal_selesai)->translatedFormat('d F Y') : '-' }}</span>
                                </li>
                            </ul>

                            <div class="border-t border-gray-800 my-3 w-10/12"></div>

                            <div class="mt-3">
                                @if($periodeAktif->jadwal_tambahan && $periodeAktif->jadwal_tambahan !== '')
                                    <ul class="space-y-1">
                                        @foreach(explode("\n", str_replace("\r", "", $periodeAktif->jadwal_tambahan)) as $baris)
                                            @if(trim($baris) !== '')
                                                <li class="flex gap-2">
                                                    <span class="text-gray-600">{{ trim($baris) }}</span>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                @else
                                    <span class="text-gray-500 italic text-[12px]">Belum ada jadwal tambahan.</span>
                                @endif
                            </div>
                        @else
                            <span class="text-gray-500 italic">Belum ada jadwal pendaftaran yang ditetapkan.</span>
                        @endif
                    </div>

                    {{-- INI DIA EFEK BLUR-NYA --}}
                    <div class="absolute bottom-0 left-0 right-0 h-10 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
                </div>
            </div>

            {{-- ================= CARD 3: BIAYA ================= --}}
            <div data-aos="fade-up" data-aos-delay="300" data-aos-duration="800" class="bg-white p-6 rounded-2xl shadow-sm border border-gray-100 hover:shadow-xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-[300px] relative">
               
                <div class="w-14 h-14 shrink-0 bg-[#E8F2EC] rounded-2xl flex items-center justify-center mb-6 transition-transform duration-500 hover:scale-110">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        class="w-8 h-8 text-[#1E5631]"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.8" d="M9 14l2 2 4-4m2-6H7a2 2 0 00-2 2v12l3-2 4 2 4-2 3 2V8a2 2 0 00-2-2z"/>
                    </svg>
                </div>
                
                {{-- Tambahkan 'relative' --}}
                <div class="flex flex-col flex-grow overflow-hidden relative">
                    <h4 class="font-bold text-[#1E5631] mb-4 text-lg uppercase tracking-wider leading-tight shrink-0">
                        Biaya Pendaftaran
                    </h4>
                    
                    {{-- Tambahkan 'pb-8' --}}
                    <div class="text-xs text-gray-600 leading-relaxed space-y-1 flex-grow overflow-y-auto scroll-elegan pr-2 pb-8">
                        @if($periodeAktif && $periodeAktif->biaya)
                            <ul class="space-y-1">
                                @foreach(explode("\n", str_replace("\r", "", $periodeAktif->biaya)) as $baris)
                                    @if(trim($baris) !== '')
                                        <li class="flex gap-2">
                                            <span class="text-gray-600">{{ trim($baris) }}</span>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @else
                            <span class="text-gray-500 italic">Belum ada rincian biaya.</span>
                        @endif
                    </div>

                    {{-- INI DIA EFEK BLUR-NYA --}}
                    <div class="absolute bottom-0 left-0 right-0 h-10 bg-gradient-to-t from-white to-transparent pointer-events-none"></div>
                </div>
            </div>

{{-- CSS untuk menghilangkan scrollbar bawaan browser tapi tetap bisa discroll --}}
<style>
.scroll-elegan::-webkit-scrollbar {
    display: none;
}
.scroll-elegan {
    -ms-overflow-style: none;  /* IE and Edge */
    scrollbar-width: none;  /* Firefox */
}
</style>

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