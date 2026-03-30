<footer class="bg-[#1e4d2b] text-white py-16 px-12">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-4 gap-12">
        
        {{-- BRAND & LOGO --}}
        <div class="space-y-6">
            <div class="flex items-center gap-3">
                {{-- Menampilkan logo.jpg dari folder public/images/ --}}
                <img src="{{ asset('images/logo.jpg') }}" alt="Logo Al-Mardliyyah" class="w-12 h-12 object-contain rounded-lg">
                <h2 class="font-bold text-xl uppercase tracking-wider">Al-Mardliyyah</h2>
            </div>
            <p class="text-sm leading-relaxed text-gray-200">
                Pondok pesantren Al-Mardliyyah adalah institusi pendidikan islam modern yang berkomitmen menghadirkan generasi cendekiawan berakhlak karimah.
            </p>
        </div>

        {{-- NAVIGASI CEPAT --}}
        <div>
            <h3 class="font-bold text-lg mb-6">Navigasi Cepat</h3>
            <ul class="space-y-3 text-sm text-gray-200">
                <li>
                    <a href="#" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block">Beranda</a>
                </li>
                <li>
                    <a href="#" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block">Profil</a>
                </li>
                <li>
                    <a href="#" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block">Program Pendidikan</a>
                </li>
                <li>
                    <a href="#" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block">Berita</a>
                </li>
                <li>
                    <a href="#" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block">Galeri</a>
                </li>
                <li>
                    <a href="#" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block font-bold text-white">Pendaftaran</a>
                </li>
                <li>
                    <a href="#" class="hover:text-white hover:translate-x-1 transition-all duration-300 inline-block">Kontak</a>
                </li>
            </ul>
        </div>

        {{-- KONTAK --}}
        <div class="space-y-4">
            <h3 class="font-bold text-lg mb-6">Kontak</h3>
            <div class="flex gap-4 items-start text-sm text-gray-200">
                <span class="text-lg">📍</span>
                <p>Jl. H. Moch. Noer No. 1, RT/RW 01/01, Kelurahan Demangan, Kecamatan Taman, Kota Madiun, Jawa Timur</p>
            </div>
            <div class="flex gap-4 items-start text-sm text-gray-200">
                <span class="text-lg">📞</span>
                <p>0856 0448 7824 (Putra)<br>0857 0678 5032 (Putri)</p>
            </div>
            <div class="flex gap-4 items-center text-sm text-gray-200">
                <span class="text-lg">📧</span>
                <p>almardliyyahpondok@gmail.com</p>
            </div>
        </div>

        {{-- IKUTI KAMI (SOSIAL MEDIA) --}}
        <div>
            <h3 class="font-bold text-lg mb-6">Ikuti Kami</h3>
            <div class="flex gap-4">
                {{-- Instagram --}}
                <a href="#" class="w-10 h-10 bg-gradient-to-tr from-yellow-400 via-red-500 to-purple-600 rounded-lg flex items-center justify-center text-xl hover:scale-110 transition-transform">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/a/a5/Instagram_icon.png" class="w-6 h-6 invert-0" alt="Instagram">
                </a>
                {{-- YouTube --}}
                <a href="#" class="w-10 h-10 bg-red-600 rounded-lg flex items-center justify-center text-xl hover:scale-110 transition-transform">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/0/09/YouTube_full-color_icon_%282017%29.svg" class="w-6 h-6" alt="YouTube">
                </a>
                {{-- Facebook --}}
                <a href="#" class="w-10 h-10 bg-blue-600 rounded-lg flex items-center justify-center text-xl hover:scale-110 transition-transform">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/b/b8/2021_Facebook_icon.svg" class="w-6 h-6" alt="Facebook">
                </a>
            </div>
        </div>

    </div>

    {{-- Copyright sederhana di bawah --}}
    <div class="max-w-7xl mx-auto border-t border-white/10 mt-12 pt-8 text-center text-xs text-gray-400">
        <p>&copy; {{ date('Y') }} Pondok Pesantren Al-Mardliyyah Madiun. All rights reserved.</p>
    </div>
</footer>