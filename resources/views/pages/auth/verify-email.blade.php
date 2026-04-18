@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[90vh] bg-white pb-32">
    
    {{-- Bagian Logo dan Header disamakan persis --}}
    <div class="text-center mb-8 mt-8">
        <img src="{{ asset('images/logo-1.png') }}" alt="Logo Pondok Pesantren" class="w-36 h-36 mx-auto mb-5 object-contain">
        
        <div class="inline-block bg-[#E6F0EB] text-[#1a5336] font-bold px-8 py-2 rounded-md mb-4 text-sm">
            Verifikasi Email
        </div>
        
        <p class="text-gray-700 text-lg font-medium">خطوة واحدة أخرى لإكمال التسجيل</p>
    </div>

    {{-- Card Container --}}
    <div class="w-full max-w-md bg-white border border-gray-300 rounded-xl p-8 shadow-sm text-center">
        
        <p class="text-sm text-gray-600 mb-6 leading-relaxed">
           شكراً لتسجيلك! قبل المتابعة، يرجى التحقق من عنوان بريدك الإلكتروني بالنقر على الرابط الذي أرسلناه للتو إلى صندوق بريدك الإلكتروني.
            <br><br>
            إذا لم تتلقَ البريد الإلكتروني، يُرجى التحقق من مجلد البريد العشوائي أو النقر على الزر أدناه لإعادة الإرسال.
        </p>

        {{-- Alert Sukses jika email dikirim ulang --}}
        @if (session('message'))
            <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded text-left">
                <p class="font-medium text-sm">{{ session('message') }}</p>
            </div>
        @endif

        {{-- Form Kirim Ulang --}}
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" 
                class="w-full bg-[#C3A771] text-white font-bold text-lg py-3 rounded-md hover:bg-[#b09664] transition duration-200">
                Kirim Ulang Email Verifikasi
            </button>
        </form>

        {{-- Tombol Logout / Kembali (Penting agar user tidak terjebak jika salah masuk email) --}}
        <div class="mt-6 flex items-center justify-center">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="text-sm font-bold text-gray-500 hover:text-red-600 hover:underline transition">
                    Batal dan Keluar
                </button>
            </form>
        </div>

    </div>
</div>
@endsection