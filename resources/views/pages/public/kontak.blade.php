@extends('layouts.app')

@section('title', 'Hubungi Kami - Al-Mardliyyah')

@section('content')
<div class="bg-white">
    <div class="max-w-6xl mx-auto py-20 px-6 text-center">

        <div class="inline-block bg-[#D8E6E0] text-[#1E5631] px-5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-6" data-aos="fade-down" data-aos-duration="800">
            Butuh Bantuan?
        </div>

        <h2 class="text-4xl font-bold text-[#1E5631] mb-4" data-aos="fade-up" data-aos-duration="800">
            Hubungi Kami
        </h2>

        <p class="text-gray-500 max-w-xl mx-auto mb-16" data-aos="fade-up" data-aos-delay="100" data-aos-duration="800">
            Tim panitia kami siap membantu menjawab pertanyaan Anda seputar pendaftaran, program pendidikan, dan kegiatan pondok pesantren.
        </p>

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

                <div class="w-full md:w-80 group bg-white border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300"
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

        <div class="mt-20 bg-gray-50 p-6 rounded-2xl border border-dashed border-gray-200 text-sm text-gray-600 max-w-4xl mx-auto" data-aos="fade-up" data-aos-duration="800">
            <span class="font-bold text-[#1E5631]">Catatan:</span> Jika Anda mengalami kesulitan dalam proses pendaftaran, jangan ragu untuk menghubungi kami setiap hari kerja pukul 08.00 - 16.00 WIB.
        </div>

    </div>
</div>
@endsection