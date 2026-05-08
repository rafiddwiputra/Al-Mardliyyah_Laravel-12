@extends('layouts.app')

@section('title', 'Hubungi Kami - Al-Mardliyyah')

@section('content')
<div class="w-full bg-white">

    <div class="w-full bg-white py-10"
        data-aos="fade-down"
        data-aos-duration="1000">
            <div class="max-w-6xl mx-auto px-6">
                <div class="bg-gradient-to-b from-[#F5F9F7] to-white rounded-2xl py-20 text-center shadow-sm">

                    <h1 class="text-5xl font-extrabold text-[#1E5631] mb-6"
                        data-aos="zoom-in"
                        data-aos-delay="200">
                        Pusat Bantuan & Kontak
                    </h1>

                    <p class="text-gray-500 max-w-2xl mx-auto text-lg leading-relaxed mb-10"
                        data-aos="fade-up"
                        data-aos-delay="400">
                        Hubungi kami untuk informasi pendaftaran, program pendidikan, dan kegiatan pondok pesantren Al-Mardliyyah.
                    </p>

                </div>
            </div>
    </div>

        {{-- ================= INFORMASI UMUM ================= --}}
        <section id="kontak" class="w-full py-16 mt-16 bg-[#F9FAFB]"
            data-aos="fade-up"
            data-aos-duration="1000">
            <div class="max-w-6xl mx-auto px-6">

                <!-- BADGE -->
                <div class="text-center mb-6">
                    <div class="inline-block bg-[#D8E6E0] px-4 py-2 rounded mb-4">
                        <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wide">
                            Informasi Umum
                        </span>
                    </div>

                    <!-- JUDUL -->
                    <h3 class="text-3xl font-bold text-[#1E5631] mb-3">
                        Informasi Alamat & Email
                    </h3>

                    <!-- DESKRIPSI -->
                    <p class="text-gray-500 max-w-xl mx-auto">
                        Temukan alamat dan email resmi pondok pesantren untuk keperluan administrasi dan komunikasi.
                    </p>
                </div>

                <!-- CONTENT -->
                <div class="flex flex-wrap justify-center gap-6">

                    <!-- ALAMAT -->
                    <div class="w-full md:w-80 group bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 text-center"
                        data-aos="zoom-in"
                        data-aos-delay="100">

                        {{-- GAMBAR MAPS --}}
                        <a href="https://maps.app.goo.gl/t1K41PeTNDuQY9dHA" target="_blank" rel="noopener noreferrer"
                            class="block relative rounded-xl overflow-hidden group border border-gray-100 shadow mb-4">

                            <div class="w-full h-28 bg-[#52795b] relative overflow-hidden flex items-center justify-center">
                                <img src="{{ asset('images/maps.png') }}" alt="Peta Lokasi Pondok"
                                    class="w-full h-full object-cover opacity-60 group-hover:opacity-100 group-hover:scale-110 transition-all duration-700 ease-in-out">

                                <div class="absolute inset-0 bg-black/30 group-hover:bg-black/10 transition-all flex items-center justify-center">
                                    <span class="bg-[#1E5631] text-white text-xs font-bold px-3 py-1.5 rounded-full shadow-xl flex items-center gap-1.5 transform group-hover:scale-105 transition-transform">
                                        <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14">
                                            </path>
                                        </svg>
                                        Buka di Peta
                                    </span>
                                </div>
                            </div>
                        </a>

                        <p class="font-semibold text-[#1E5631] mb-2">Alamat</p>

                        <a href="https://maps.app.goo.gl/t1K41PeTNDuQY9dHA" target="_blank"
                            class="text-sm text-gray-500 hover:text-[#1E5631] transition leading-relaxed block">
                            Jl. H. Moch Noer, RT.01/RW.01, Demangan, Kec. Taman, Kota Madiun, Jawa Timur 63136
                        </a>
                    </div>

                    <!-- EMAIL -->
                    <div class="w-full md:w-80 group bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 text-center"
                        data-aos="zoom-in"
                        data-aos-delay="100">

                        {{-- ICON EMAIL --}}
                        <div class="w-full h-28 mb-4 flex items-center justify-center rounded-xl border border-gray-100 bg-white shadow-sm overflow-hidden">

                            <div class="group-hover:scale-110 transition-all duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg"
                                    width="70"
                                    height="70"
                                    viewBox="0 0 48 48">

                                    <path fill="#4caf50"
                                        d="M45,16.2l-5,2.75l-5,4.75L35,40h7c1.657,0,3-1.343,3-3V16.2z">
                                    </path>

                                    <path fill="#1e88e5"
                                        d="M3 16.2V37c0 1.657 1.343 3 3 3h7V23.7L3 16.2z">
                                    </path>

                                    <polygon fill="#e53935"
                                        points="35,11.2 24,19.45 13,11.2 12,17 13,23.7 24,31.95 35,23.7 36,17">
                                    </polygon>

                                    <path fill="#c62828"
                                        d="M3,12.298V16.2l10,7.5V11.2L9.876,8.859C9.132,8.301,8.228,8,7.298,8h0C4.924,8,3,9.924,3,12.298z">
                                    </path>

                                    <path fill="#fbc02d"
                                        d="M45,12.298V16.2l-10,7.5V11.2l3.124-2.341C38.868,8.301,39.772,8,40.702,8h0C43.076,8,45,9.924,45,12.298z">
                                    </path>

                                </svg>
                            </div>

                        </div>

                        <p class="font-semibold text-[#1E5631] mb-2">Email</p>

                        <a href="mailto:almardliyyahpondok@gmail.com"
                            class="text-sm text-gray-500 hover:text-[#1E5631] transition">
                            almardliyyahpondok@gmail.com
                        </a>
                    </div>

                </div>

            </div>
        </section>
        
        {{-- ================= MEDIA SOSIAL ================= --}}
        <div class="w-full py-20 bg-white"
            data-aos="fade-up"
            data-aos-duration="1000">

            <!-- BADGE -->
            <div class="text-center mb-6">
                <div class="inline-block bg-[#D8E6E0] px-4 py-2 rounded mb-4">
                    <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wide">
                        Media Sosial
                    </span>
                </div>

                <!-- JUDUL -->
                <h3 class="text-3xl font-bold text-[#1E5631] mb-3">
                    Ikuti Kami
                </h3>

                <!-- DESKRIPSI -->
                <p class="text-gray-500 max-w-xl mx-auto">
                    Dapatkan informasi terbaru seputar kegiatan dan program pondok melalui media sosial resmi kami.
                </p>
            </div>

            <!-- CONTENT -->
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 max-w-4xl mx-auto">

                <!-- INSTAGRAM -->
                <a href="https://www.instagram.com/almardliyyah.demangan" target="_blank"
                class="w-full group bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 text-center"
                    data-aos="fade-up"
                    data-aos-delay="100">

                    <div class="w-16 h-16 mx-auto mb-4 bg-gradient-to-tr from-yellow-400 via-pink-500 to-purple-600 text-white flex items-center justify-center rounded-xl group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M7.75 2C4.574 2 2 4.574 2 7.75v8.5C2 19.426 4.574 22 7.75 22h8.5C19.426 22 22 19.426 22 16.25v-8.5C22 4.574 19.426 2 16.25 2h-8.5zm0 2h8.5A3.75 3.75 0 0 1 20 7.75v8.5A3.75 3.75 0 0 1 16.25 20h-8.5A3.75 3.75 0 0 1 4 16.25v-8.5A3.75 3.75 0 0 1 7.75 4zm8.75 1.5a1 1 0 1 0 0 2 1 1 0 0 0 0-2zM12 7a5 5 0 1 0 0 10 5 5 0 0 0 0-10zm0 2a3 3 0 1 1 0 6 3 3 0 0 1 0-6z"/>
                        </svg>

                    </div>

                    <h4 class="font-bold text-[#1E5631]">Instagram</h4>
                    <p class="text-sm text-gray-500 mt-1">@almardliyyah.demangan</p>
                </a>

                <!-- FACEBOOK -->
                <a href="https://www.facebook.com/share/18MpGAx7LZ/" target="_blank"
                class="w-full group bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 text-center"
                    data-aos="fade-up"
                    data-aos-delay="200">

                    <div class="w-16 h-16 mx-auto mb-4 bg-blue-600 text-white flex items-center justify-center rounded-xl group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M24 12.073c0-6.627-5.373-12-12-12S0 5.446 0 12.073c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.469h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.469h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                        </svg>
                    </div>

                    <h4 class="font-bold text-[#1E5631]">Facebook</h4>
                    <p class="text-sm text-gray-500 mt-1">Al-Mardliyyah</p>
                </a>

                <!-- TIKTOK -->
                <a href="https://www.tiktok.com/@almardliyyah" target="_blank"
                class="w-full group bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 text-center"
                    data-aos="fade-up"
                    data-aos-delay="300">

                    <div class="w-16 h-16 mx-auto mb-4 bg-black text-white flex items-center justify-center rounded-xl group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M12.525.02c1.31-.02 2.61-.01 3.91-.02.08 1.53.63 3.09 1.75 4.17 1.12 1.11 2.7 1.62 4.24 1.79v4.03c-1.44-.05-2.89-.35-4.2-.97-.57-.26-1.1-.59-1.62-.93v8.75c-.08 1.4-.54 2.79-1.35 3.94-1.31 1.92-3.58 3.17-5.91 3.21-1.43.08-2.86-.31-4.08-1.03-2.02-1.19-3.44-3.37-3.65-5.71-.02-.5-.03-1-.01-1.49.18-1.9 1.12-3.72 2.58-4.96 1.66-1.44 3.98-2.13 6.15-1.72v4.44c-.99-.32-2.15-.23-3.02.37-.63.41-1.11 1.04-1.36 1.75-.21.51-.15 1.07-.14 1.61.24 1.64 1.82 3.02 3.5 2.87 1.12-.01 2.19-.66 2.77-1.61.19-.33.4-.67.41-1.06.1-1.79.06-3.57.07-5.36V.02z"/>
                        </svg>
                    </div>

                    <h4 class="font-bold text-[#1E5631]">TikTok</h4>
                    <p class="text-sm text-gray-500 mt-1">@almardliyyah</p>
                </a>

                <!-- YOUTUBE -->
                <a href="https://youtube.com/@al-mardliyyah448" target="_blank"
                class="w-full group bg-white border border-gray-100 rounded-2xl p-6 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 text-center"
                    data-aos="fade-up"
                    data-aos-delay="400">

                    <div class="w-16 h-16 mx-auto mb-4 bg-red-600 text-white flex items-center justify-center rounded-xl group-hover:scale-110 transition">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93-.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                        </svg>
                    </div>

                    <h4 class="font-bold text-[#1E5631]">YouTube</h4>
                    <p class="text-sm text-gray-500 mt-1">Al-Mardliyyah</p>
                </a>

            </div>

        </div>
        
        {{-- ================= KONTAK PENDAFTARAN ================= --}}
        <section class="w-full py-20 bg-[#F9FAFB]"
            data-aos="fade-up"
            data-aos-duration="1000">
            <div class="max-w-6xl mx-auto px-6">

                <!-- BADGE -->
                <div class="text-center mb-6">
                    <div class="inline-block bg-[#D8E6E0] px-4 py-2 rounded mb-4">
                        <span class="text-[#1E5631] text-sm font-semibold uppercase tracking-wide">
                            Kontak Pendaftaran
                        </span>
                    </div>

                    <!-- JUDUL -->
                    <h3 class="text-3xl font-bold text-[#1E5631] mb-3">
                        Hubungi Panitia
                    </h3>

                    <!-- DESKRIPSI -->
                    <p class="text-gray-500 max-w-xl mx-auto">
                        Silakan hubungi panitia pendaftaran untuk mendapatkan informasi lebih lanjut mengenai proses pendaftaran santri.
                    </p>
                </div>
            
                <div class="flex flex-wrap justify-center gap-8">
                    
                    @forelse($kontaks as $k)
                        @php
                            // 1. Membersihkan nomor HP dari karakter selain angka
                            $nomorBersih = preg_replace('/[^0-9]/', '', $k->no_hp);
                            
                            // 2. Mengubah format 08.. menjadi 628..
                            if (str_starts_with($nomorBersih, '0')) {
                                $nomorBersih = '62' . substr($nomorBersih, 1);
                            }
                            
                            // 3. Merakit URL WhatsApp
                            $linkWhatsApp = 'https://wa.me/' . $nomorBersih;
                        @endphp

                        <div class="w-full md:w-80 group bg-white border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300 text-center"
                            data-aos="zoom-in" data-aos-delay="{{ $loop->iteration * 150 }}" data-aos-duration="800">
                            
                            <div class="w-16 h-16 mx-auto mb-6 bg-[#25D366] text-white flex items-center justify-center rounded-2xl {{ $loop->iteration % 2 == 0 ? '-rotate-3' : 'rotate-3' }} group-hover:rotate-0 transition-transform duration-300 shadow-lg">
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.446-.272.371-1.04 1.015-1.04 2.475 0 1.46 1.065 2.871 1.213 3.07.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
                                </svg>
                            </div>

                            <h3 class="font-bold text-xl text-[#1E5631] mb-2">
                                @if($k->id == 1)
                                    Panitia Putra
                                @else
                                    Panitia Putri
                                @endif
                            </h3>
                            
                            <p class="text-sm text-gray-500 leading-relaxed mb-6 font-medium">
                                {{ $k->no_hp }}
                            </p>

                            <a href="{{ $linkWhatsApp }}" target="_blank" rel="noopener noreferrer" 
                            class="inline-block bg-[#1E5631] hover:bg-[#164227] text-white px-6 py-2.5 rounded-full text-sm font-bold shadow-md transition-all group-hover:shadow-lg">
                                Chat Sekarang
                            </a>
                        </div>
                    @empty
                        <div class="w-full py-20 text-gray-400 italic text-center">
                            Kontak panitia sedang dalam perbaikan.
                        </div>
                    @endforelse

                </div>
            </div>
        </section>

        <div class="mt-20 mb-20 bg-gray-50 p-6 rounded-2xl border border-dashed border-gray-200 text-sm text-gray-600 max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="800">
            <span class="font-bold text-[#1E5631]">Catatan:</span> Jika Anda mengalami kesulitan dalam proses pendaftaran, jangan ragu untuk menghubungi kami setiap hari kerja pukul 08.00 - 16.00 WIB.
        </div>

    </div>
</div>
@endsection