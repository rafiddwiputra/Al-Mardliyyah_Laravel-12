@extends('layouts.app')

@section('content')

{{-- ================= HERO SECTION ================= --}}
<div id="hero" class="bg-[#1E5631] text-white py-28">
    <div class="max-w-6xl mx-auto px-6">
        <p class="text-sm text-gray-300 mb-3 text-white">Beranda > Program Pendidikan</p>
        <h1 class="text-4xl font-bold mb-4 leading-tight text-white">
            Program Pendidikan Pondok Pesantren <br>
            Al-Mardliyyah
        </h1>
        <p class="text-base text-gray-200 max-w-2xl leading-relaxed text-gray-100">
            Program pendidikan yang mendukung pembelajaran agama, pendidikan formal, dan pembinaan santri
        </p>
    </div>
</div>

{{-- ================= STICKY TAB MENU ================= --}}
<div class="bg-white border-b sticky top-20 z-40">
    <div id="tab-menu" class="max-w-6xl mx-auto px-6 flex justify-center gap-4 py-3 text-sm">
        <a href="#hero" class="tab-link bg-[#1E5631] text-white px-4 py-2 rounded-md text-sm font-medium shadow-sm transition-all">
            Semua
        </a>
        <a href="#formal" class="tab-link text-[#333333] px-3 py-2 hover:text-[#1E5631] transition-all">
            Lembaga Pendidikan Formal
        </a>
        <a href="#nonformal" class="tab-link text-[#333333] px-3 py-2 hover:text-[#1E5631] transition-all">
            Pendidikan Non Formal
        </a>
        <a href="#unggulan" class="tab-link text-[#333333] px-3 py-2 hover:text-[#1E5631] transition-all">
            Program Unggulan
        </a>
    </div>
</div>

{{-- ================= LEMBAGA PENDIDIKAN FORMAL ================= --}}
<section id="formal" class="py-16 bg-[#F9FAFB] scroll-mt-20">
    <div class="max-w-5xl mx-auto px-6 text-center">
        <div class="inline-block bg-[#D8E6E0] px-4 py-2 rounded mb-4">
            <span class="text-[#1E5631] text-sm font-medium">Pendidikan Formal</span>
        </div>
        <h2 class="text-3xl font-bold text-[#1E5631] mb-4 text-center">Lembaga Pendidikan Formal</h2>
        <p class="text-[#4B5563] text-sm max-w-2xl mx-auto mb-12 leading-relaxed text-center">
            Menyelenggarakan pendidikan formal terintegrasi dengan kurikulum nasional yang dipadukan nilai-nilai keislaman.
        </p>

        <div class="grid md:grid-cols-3 gap-6 text-left">
            @if(isset($programs['formal']))
                @foreach($programs['formal'] as $item)
                <div class="bg-white rounded-xl shadow-sm overflow-hidden hover:shadow-md transition border border-gray-100">
                    <div class="h-2 bg-[#1E5631]"></div>
                    <div class="p-7 min-h-[250px]">
                        <div class="w-14 h-14 bg-[#E8F2EC] rounded-lg flex items-center justify-center text-2xl mb-5">📘</div>
                        <h3 class="text-[#1E5631] font-semibold text-lg mb-3">{{ $item->nama_program }}</h3>
                        <p class="text-sm text-[#4B5563] leading-relaxed">{{ $item->deskripsi }}</p>
                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

{{-- ================= LEMBAGA PENDIDIKAN NON FORMAL (SAMA PERSIS FIGMA) ================= --}}
<section id="nonformal" class="py-20 bg-white scroll-mt-20">
    <div class="max-w-5xl mx-auto px-6 text-center">
        
        <div class="inline-block bg-[#D8E6E0] px-5 py-2 rounded-lg mb-4">
            <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wider">Pendidikan Non Formal</span>
        </div>
        
        <h2 class="text-4xl font-bold text-[#1E5631] mb-5">Lembaga Pendidikan Non Formal</h2>
        <p class="text-gray-500 text-base md:text-lg max-w-2xl mx-auto mb-16 leading-relaxed">
            Program pendidikan non formal yang mendukung penguatan keilmuan agama dan pembinaan karakter santri.
        </p>

        <div class="space-y-10">
            @if(isset($programs['nonformal']))
                @foreach($programs['nonformal'] as $item)
                {{-- 
                    CARD WRAPPER: 
                    - Menggunakan flex md:flex-row agar di layar besar gambar & teks bersampingan.
                    - rounded-[2rem] untuk kelengkungan yang sesuai figma.
                --}}
                <div class="bg-white rounded-[2rem] shadow-xl border border-gray-50 overflow-hidden flex flex-col md:flex-row items-stretch group hover:shadow-2xl transition-all duration-500">
                    

                    {{-- BAGIAN TEKS (KANAN) --}}
                    <div class="md:w-3/5 p-10 md:p-14 flex flex-col justify-center text-left">
                        
                        <div class="w-12 h-12 bg-[#E8F2EC] rounded-xl flex items-center justify-center text-xl mb-6">
                            📚
                        </div>

                        <h3 class="text-[#1E5631] font-extrabold text-3xl mb-4 leading-tight">
                            {{ $item->nama_program }}
                        </h3>

                        <div class="text-gray-500 text-base md:text-lg leading-relaxed mb-8">
                            {!! nl2br(e($item->deskripsi)) !!}
                        </div>

                        <div class="mt-2">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </a>
                        </div>
                    </div>

                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

{{-- ================= PROGRAM UNGGULAN (SAMA PERSIS FIGMA) ================= --}}
<section id="unggulan" class="py-20 bg-[#F9FAFB] scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6 text-center">

        <div class="inline-block bg-[#D8E6E0] px-5 py-2 rounded-lg mb-4">
            <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wider">Program Unggulan</span>
        </div>

        <h2 class="text-4xl font-bold text-[#1E5631] mb-5">Program Keunggulan</h2>
        
        <p class="text-gray-600 text-base md:text-lg max-w-3xl mx-auto mb-16 leading-relaxed">
            Pendidikan Formal terakreditasi dengan kurikulum nasional
        </p>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
            @if(isset($programs['unggulan']))
                @foreach($programs['unggulan'] as $item)
                
                {{-- Card Wrapper: Menggunakan Shadow halus & rounded tinggi sesuai desain --}}
                <div class="bg-white rounded-2xl shadow-lg border border-gray-100 overflow-hidden hover:shadow-xl transition-all duration-300 flex flex-col group">
                    

                    {{-- Bagian Konten: Rata Tengah (text-center) --}}
                    <div class="p-8 flex flex-col items-center text-center">
                        
                        <h3 class="text-[#1E5631] font-bold text-2xl mb-4 leading-tight">
                            {{ $item->nama_program }}
                        </h3>

                        <div class="text-gray-500 text-sm md:text-base leading-relaxed">
                            {!! nl2br(e($item->deskripsi)) !!}
                        </div>

                    </div>
                </div>
                @endforeach
            @endif
        </div>
    </div>
</section>

{{-- ================= SCRIPTS & STYLES ================= --}}
<style>
    html { scroll-behavior: smooth; }
    section, #hero { scroll-margin-top: 100px; }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab-link');
    const sections = document.querySelectorAll('#hero, #formal, #nonformal, #unggulan');
    
    function changeActiveTab() {
        let index = sections.length;
        while(--index && window.scrollY + 150 < sections[index].offsetTop) {}
        
        tabs.forEach((tab) => {
            tab.classList.remove('bg-[#1E5631]', 'text-white', 'shadow-sm', 'rounded-md', 'font-medium');
            tab.classList.add('text-[#333333]');
        });
        
        if(tabs[index]) {
            tabs[index].classList.add('bg-[#1E5631]', 'text-white', 'shadow-sm', 'rounded-md', 'font-medium');
            tabs[index].classList.remove('text-[#333333]');
        }
    }
    
    window.addEventListener('scroll', changeActiveTab);
    changeActiveTab();
});
</script>

@endsection