@extends('layouts.app')

@section('title', 'Hubungi Kami - Al-Mardliyyah')

@section('content')
<div class="bg-white">
    <div class="max-w-6xl mx-auto py-20 px-6 text-center">

        <div class="inline-block bg-[#D8E6E0] text-[#1E5631] px-5 py-1.5 rounded-full text-xs font-bold uppercase tracking-wider mb-6">
            Butuh Bantuan?
        </div>

        <h2 class="text-4xl font-bold text-[#1E5631] mb-4">
            Hubungi Kami
        </h2>

        <p class="text-gray-500 max-w-xl mx-auto mb-16">
            Tim kami siap membantu menjawab pertanyaan Anda seputar pendaftaran, program pendidikan, dan kegiatan pondok.
        </p>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
            
            @forelse($kontaks as $k)
                <div class="group bg-white border border-gray-100 rounded-2xl p-8 shadow-sm hover:shadow-xl hover:-translate-y-2 transition-all duration-300">
                    
                    <div class="w-16 h-16 mx-auto mb-6 bg-[#1E5631] text-white flex items-center justify-center rounded-2xl {{ $loop->iteration % 2 == 0 ? '-rotate-3' : 'rotate-3' }} group-hover:rotate-0 transition-transform duration-300 text-2xl shadow-lg">
                        @switch($k->tipe)
                            @case('alamat') 📍 @break
                            @case('whatsapp') 💬 @break
                            @case('email') ✉️ @break
                            @case('instagram') 📸 @break
                            @case('youtube') ▶️ @break
                            @case('facebook') 📘 @break
                            @default 📞
                        @endswitch
                    </div>

                    <h3 class="font-bold text-lg text-[#1E5631] mb-3">{{ $k->judul }}</h3>
                    
                    @if($k->link)
                        <a href="{{ $k->link }}" target="_blank" class="text-sm text-gray-500 leading-relaxed hover:text-[#c9a76d] transition-colors block">
                            {!! nl2br(e($k->nilai)) !!}
                        </a>
                    @else
                        <p class="text-sm text-gray-500 leading-relaxed">
                            {!! nl2br(e($k->nilai)) !!}
                        </p>
                    @endif

                    @if($k->keterangan)
                        <div class="mt-4 pt-4 border-t border-gray-50 flex items-center justify-center gap-2">
                            <span class="text-[10px] bg-gray-100 text-gray-500 px-2 py-0.5 rounded font-bold uppercase tracking-tighter">
                                {{ $k->keterangan }}
                            </span>
                        </div>
                    @endif
                </div>
            @empty
                <div class="col-span-full py-20 text-gray-400 italic">
                    Belum ada data kontak yang ditambahkan.
                </div>
            @endforelse

        </div>

        <div class="mt-20 bg-gray-50 p-6 rounded-2xl border border-dashed border-gray-200 text-sm text-gray-600 max-w-4xl mx-auto">
            <span class="font-bold text-[#1E5631]">Catatan:</span> Jika Anda mengalami kesulitan dalam proses pendaftaran, jangan ragu untuk menghubungi kami setiap hari kerja pukul 08.00 - 16.00 WIB.
        </div>

    </div>
</div>
@endsection