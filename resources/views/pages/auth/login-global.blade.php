@extends('layouts.app')

@section('content')
<div class="min-h-[80vh] flex items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 bg-white p-10 rounded-2xl shadow-xl border border-gray-100">
        <div>
            <h2 class="mt-6 text-center text-3xl font-extrabold text-[#1E5631]">
                Selamat Datang
            </h2>
            <p class="mt-2 text-center text-sm text-gray-600">
                Silakan masuk ke akun Anda untuk melanjutkan
            </p>
        </div>
        
        <form class="mt-8 space-y-6" action="{{ route('login.authenticate') }}" method="POST">
            @csrf
            <div class="rounded-md shadow-sm space-y-4">
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" required 
                        class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 rounded-lg focus:outline-none focus:ring-[#1E5631] focus:border-[#1E5631] focus:z-10 sm:text-sm" 
                        placeholder="Masukkan email Anda">
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" required 
                        class="appearance-none relative block w-full px-3 py-3 border border-gray-300 placeholder-gray-400 text-gray-900 rounded-lg focus:outline-none focus:ring-[#1E5631] focus:border-[#1E5631] focus:z-10 sm:text-sm" 
                        placeholder="Masukkan password">
                </div>
            </div>

            <div>
                <button type="submit" 
                    class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-bold rounded-lg text-white bg-[#1E5631] hover:bg-[#174427] focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-[#1E5631] transition-all">
                    Login
                </button>
            </div>
            
            <div class="text-center">
                <p class="text-xs text-gray-500">
                    Belum punya akun? <a href="{{ route('pendaftaran') }}" class="font-bold text-[#1E5631] hover:underline">Daftar Akun</a>
                </p>
            </div>
        </form>
    </div>
</div>
@endsection