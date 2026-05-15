@extends('layouts.app')

@php
    $showCTA = true;
@endphp

@section('content')

{{-- ================= HERO SECTION ================= --}}
<div id="hero" class="bg-[#1E5631] text-white py-28" data-aos="fade-down" data-aos-duration="1000">
    <div class="max-w-6xl mx-auto px-6">
        <p class="text-sm text-gray-300 mb-3">Beranda > Program Pendidikan</p>
        <h1 class="text-4xl font-bold mb-4 leading-tight">
            Program Pendidikan Pondok Pesantren <br>
            Al-Mardliyyah
        </h1>
        <p class="text-base text-gray-200 max-w-2xl leading-relaxed">
            Program pendidikan yang mendukung pembelajaran agama, pendidikan formal, dan pembinaan santri secara komprehensif.
        </p>
    </div>
</div>

{{-- ================= STICKY TAB MENU ================= --}}
<div class="bg-white border-b sticky top-20 z-40" data-aos="fade-up" data-aos-delay="300" data-aos-duration="800">
    <div id="tab-menu" class="max-w-6xl mx-auto px-6 flex justify-center gap-4 py-3 text-sm">
        <a href="#lembaga" class="tab-link text-[#333333] px-3 py-2 hover:text-[#1E5631] transition-all font-medium">
            Lembaga Pendidikan
        </a>
        <a href="#program" class="tab-link text-[#333333] px-3 py-2 hover:text-[#1E5631] transition-all font-medium">
            Program Unggulan
        </a>
    </div>
</div>

{{-- ================= SECTION 1: LEMBAGA PENDIDIKAN ================= --}}
<section id="lembaga" class="py-16 bg-white scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <div data-aos="fade-up">
            <div class="inline-block bg-[#D8E6E0] px-5 py-2 rounded-lg mb-4">
                <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wide">Lembaga Pendidikan</span>
            </div>
            <h2 class="text-3xl font-bold text-[#1E5631] mb-4">Daftar Lembaga Pendidikan</h2>
            <p class="text-[#4B5563] text-base max-w-2xl mx-auto mb-12 leading-relaxed">
                Unit pendidikan formal yang dikelola untuk membentuk generasi yang cerdas dan berakhlakul karimah.
            </p>
        </div>

        <div class="grid md:grid-cols-3 gap-8">
            @if(isset($programs['lembaga pendidikan']))
                @foreach($programs['lembaga pendidikan'] as $item)
                {{-- Efek fade-up berurutan dari bawah ke atas --}}
                <div class="bg-white rounded-2xl shadow-sm overflow-hidden hover:shadow-xl transition-all duration-300 border border-gray-100 flex flex-col group"
                    data-aos="fade-up" data-aos-delay="{{ ($loop->index % 3) * 150 }}">
                    
                    <div class="h-3 w-full bg-[#1E5631] rounded-t-2xl"></div>
                    <div class="p-8 flex-grow text-center">

                        <div class="w-16 h-16 bg-[#E8F2EC] rounded-2xl flex items-center justify-center mb-6 mx-auto group-hover:scale-110 transition-transform">

                            <svg xmlns="http://www.w3.org/2000/svg"
                                class="w-9 h-9 text-[#1E5631]"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor">

                                <path stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="1.8"
                                    d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5s3.332.477 4.5 1.253v13C19.832 18.477 18.246 18 16.5 18s-3.332.477-4.5 1.253" />
                            </svg>

                        </div>

                        <h3 class="text-[#1E5631] font-bold text-xl mb-3">{{ $item->nama_program }}</h3>
                        <div class="text-sm text-[#4B5563] leading-relaxed max-h-48 overflow-y-auto pr-2 text-justify no-scrollbar">
                            {!! nl2br(e($item->deskripsi)) !!}
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-span-3 py-10 text-gray-400">Belum ada data lembaga pendidikan.</div>
            @endif
        </div>
    </div>
</section>

{{-- ================= SECTION 2: PROGRAM UNGGULAN ================= --}}
<section id="program" class="py-20 bg-gray-50 scroll-mt-20">
    <div class="max-w-6xl mx-auto px-6 text-center">
        <div data-aos="fade-up">
            <div class="inline-block bg-[#D8E6E0] px-5 py-2 rounded-lg mb-4">
                <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wider">Program Unggulan</span>
            </div>
            <h2 class="text-3xl font-bold text-[#1E5631] mb-4">Program Keunggulan Pesantren</h2>
            <p class="text-[#4B5563] text-base max-w-2xl mx-auto mb-12 leading-relaxed">
                Program khusus yang dirancang untuk mengasah bakat, minat, dan spiritualitas santri di luar jam pelajaran sekolah.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
            @if(isset($programs['program pendidikan']))
                @foreach($programs['program pendidikan'] as $item)
                {{-- Efek zoom-in bergantian --}}
                <div class="bg-white rounded-[2rem] p-10 border border-gray-100 shadow-sm border-l-8 border-l-[#1E5631] flex flex-col md:flex-row items-center gap-8 group hover:shadow-xl transition-all duration-500"
                    data-aos="zoom-in" data-aos-delay="{{ ($loop->index % 2) * 200 }}">

                    <div class="w-20 h-20 bg-[#E8F2EC] rounded-2xl shadow-sm flex items-center justify-center flex-shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-10 h-10 text-[#1E5631]"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor">

                            <path stroke-linecap="round"
                                stroke-linejoin="round"
                                stroke-width="1.8"
                                d="M12 14l9-5-9-5-9 5 9 5zm0 0l6.16-3.422A12.083 12.083 0 0118 20.055c-1.151.6-3.041.945-6 .945s-4.849-.345-6-.945A12.083 12.083 0 015.84 10.578L12 14zm0 0v7" />
                        </svg>
                    </div>

                    <div class="text-left">
                        <h3 class="text-[#1E5631] font-extrabold text-2xl mb-3 leading-tight">
                            {{ $item->nama_program }}
                        </h3>
                        <div class="text-gray-500 text-base leading-relaxed max-h-48 overflow-y-auto pr-2 text-justify no-scrollbar">
                            {!! nl2br(e($item->deskripsi)) !!}
                        </div>
                    </div>
                </div>
                @endforeach
            @else
                <div class="col-span-2 py-10 text-gray-400">Belum ada data program unggulan.</div>
            @endif
        </div>
    </div>
</section>

{{-- ================= SCRIPTS & STYLES ================= --}}
<style>
    html { scroll-behavior: smooth; }
    section, #hero { scroll-margin-top: 80px; }
    
    html { 
        scroll-behavior: smooth; 
    }

    section, #hero { 
        scroll-margin-top: 80px; 
    }

    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }

    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('.tab-link');
    const sections = [
        document.querySelector('#lembaga'),
        document.querySelector('#program')
    ];
    
    function changeActiveTab() {
        if (window.scrollY < sections[0].offsetTop - 200) {
            tabs.forEach(tab => {
                tab.classList.remove('bg-[#1E5631]', 'text-white', 'shadow-sm', 'rounded-md');
                tab.classList.add('text-[#333333]');
            });
            return;
        }

        let index = sections.length;
        while(--index && window.scrollY + 150 < sections[index].offsetTop) {}
        
        tabs.forEach((tab) => {
            tab.classList.remove('bg-[#1E5631]', 'text-white', 'shadow-sm', 'rounded-md');
            tab.classList.add('text-[#333333]');
        });
        
        if(tabs[index]) {
            tabs[index].classList.add('bg-[#1E5631]', 'text-white', 'shadow-sm', 'rounded-md');
            tabs[index].classList.remove('text-[#333333]');
        }
    }
    
    window.addEventListener('scroll', changeActiveTab);
    changeActiveTab();
});
</script>

@endsection