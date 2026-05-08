@extends('layouts.admin')

@section('content')
<div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <div class="mb-6 text-left">
        <h1 class="text-2xl font-bold text-[#1E5631]">Kelola Profil Pondok</h1>
        <p class="text-sm text-gray-500 mt-1">Kelola informasi profil dan sejarah pesantren</p>
    </div>

    <div class="bg-white rounded-lg border border-[#D9D9D9] overflow-hidden">
        
        <div class="border-b border-[#D9D9D9] py-6 bg-white">
            <div class="flex justify-center items-center gap-8">
                {{-- Sejarah sudah hilang --}}
                <button onclick="showTab('fasilitas')" id="btn-fasilitas" class="focus:outline-none">
                    <span class="bg-[#1E5631] text-white px-6 py-1.5 rounded text-sm transition-all duration-300">Fasilitas</span>
                </button>
                <button onclick="showTab('video')" id="btn-video" class="focus:outline-none">
                    <span class="px-6 py-1.5 rounded text-sm transition-all duration-300">Video</span>
                </button>
            </div>
        </div>

        {{-- Tab Fasilitas otomatis terbuka --}}
        <div id="tab-fasilitas" class="p-8">
            @include('pages.admin.profil-pondok.fasilitas')
        </div>

        <div id="tab-video" class="hidden p-8">
            @include('pages.admin.profil-pondok.video')
        </div>

    </div>

    @include('pages.admin.profil-pondok.fasilitas-tambah')
    @include('pages.admin.profil-pondok.fasilitas-edit')
    @include('pages.admin.profil-pondok.fasilitas-hapus')

    @include('pages.admin.profil-pondok.video-tambah')
    @include('pages.admin.profil-pondok.video-edit')
    @include('pages.admin.profil-pondok.video-hapus') 

    <!-- {{-- BEST PRACTICE: Jika layouts.admin memiliki @stack('scripts'), 
        lebih baik <script> ini dipindah ke dalam @push('scripts'). 
        Tapi jika tidak, diletakkan di akhir @section sudah cukup aman. --}} -->
    <script>
    // ==========================================
    // LOGIKA TAMBAH VIDEO (Dengan Animasi)
    // ==========================================
    function openTambahVideoModal() {
        const modal = document.getElementById('modalTambahVideo');
        const content = document.getElementById('modalContentVideo');
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            if(content) {
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }
        }, 10);
    }

    function closeTambahVideoModal() {
        const modal = document.getElementById('modalTambahVideo');
        const content = document.getElementById('modalContentVideo');
        
        modal.classList.add('opacity-0');
        if(content) {
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
        }
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // Fungsi Preview Gambar khusus untuk Tambah Video
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const preview = document.getElementById('image-preview');
            const text = document.getElementById('preview-text');
            if(preview && text) {
                preview.src = reader.result;
                preview.classList.remove('hidden');
                text.classList.add('hidden');
            }
        }
        if(event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }

    // ==========================================
    // FUNGSI TAB & CORE MODAL (Fasilitas & Hapus)
    // ==========================================
    function showTab(tab) {
        document.querySelectorAll('[id^="tab-"]').forEach(el => el.classList.add('hidden'));
        document.querySelectorAll('[id^="btn-"] span').forEach(span => {
            span.classList.remove('bg-[#1E5631]', 'text-white');
        });
        document.getElementById('tab-' + tab).classList.remove('hidden');
        document.querySelector('#btn-' + tab + ' span').classList.add('bg-[#1E5631]', 'text-white');
    }

    function openModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            setTimeout(() => {
                modal.classList.add('opacity-100');
            }, 10);
        } else {
            console.error("Modal ID " + id + " tidak ditemukan!");
        }
    }

    function closeModal(id) {
        const modal = document.getElementById(id);
        if (modal) {
            modal.classList.remove('opacity-100');
            setTimeout(() => {
                modal.classList.add('hidden');
                modal.classList.remove('flex');
            }, 300);
        }
    }

    // ==========================================
    // LOGIKA MODAL FASILITAS
    // ==========================================
    function openTambahFasilitasModal() {
        openModal('modalTambahFasilitas');
    }
    function closeTambahFasilitasModal() {
        closeModal('modalTambahFasilitas');
    }

    function openEditFasilitasModal(id, nama, deskripsi, fotoUrl) {
        document.getElementById('edit_nama_fasilitas').value = nama || '';
        document.getElementById('edit_deskripsi_fasilitas').value = deskripsi || '';
        
        const imgPreview = document.getElementById('edit_preview_fasilitas_img');
        if(imgPreview && fotoUrl) {
            imgPreview.src = fotoUrl;
        }

        const form = document.getElementById('formEditFasilitas');
        if(form && id) {
            form.action = "/admin/profil-pondok/fasilitas/" + id;
        }

        openModal('modalEditFasilitas');
    }
    function closeEditFasilitasModal() {
        closeModal('modalEditFasilitas');
    }

    function openHapusFasilitasModal(id, nama) {
        const form = document.getElementById('formHapusFasilitas');
        if(form && id) {
            form.action = "/admin/profil-pondok/fasilitas/" + id;
        }
        const textNama = document.getElementById('hapus_nama_fasilitas_text');
        if(textNama) {
            textNama.innerText = nama;
        }
        openModal('modalHapusFasilitas');
    }
    function closeHapusFasilitasModal() {
        closeModal('modalHapusFasilitas');
    }

    // ==========================================
    // EDIT VIDEO (Versi Final dengan Animasi & Thumbnail)
    // ==========================================
    function openEditVideoModal(id, judul, deskripsi, linkYt, thumbnailUrl) {
        const inputJudul = document.getElementById('edit_judul_video');
        const inputDeskripsi = document.getElementById('edit_deskripsi_video');
        const inputLinkYt = document.getElementById('edit_link_yt_video'); 
        
        // Elemen Gambar & Error
        const previewImg = document.getElementById('edit_preview_video_img');
        const placeholder = document.getElementById('edit_placeholder_video');
        const inputThumbnail = document.getElementById('edit_thumbnail_video');
        const errorSize = document.getElementById('edit_error_size_video');
        
        // Reset form saat dibuka
        if(inputThumbnail) inputThumbnail.value = '';
        if(errorSize) errorSize.classList.add('hidden');

        if(inputJudul) inputJudul.value = judul || '';
        if(inputDeskripsi) inputDeskripsi.value = deskripsi || '';
        if(inputLinkYt) inputLinkYt.value = linkYt || ''; 

        // Tampilkan gambar lama jika ada
        if (thumbnailUrl) {
            previewImg.src = thumbnailUrl;
            previewImg.classList.remove('hidden');
            placeholder.classList.add('hidden');
        } else {
            previewImg.src = '';
            previewImg.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }

        const form = document.getElementById('formEditVideo');
        if(form && id) {
            form.action = `/admin/profil-pondok/video/update/${id}`;
        }

        // ANIMASI BUKA MODAL
        const modal = document.getElementById('modalEditVideo');
        const content = document.getElementById('modalContentEditVideo');
        modal.classList.remove('hidden');
        setTimeout(() => {
            modal.classList.remove('opacity-0');
            if(content) {
                content.classList.remove('scale-95');
                content.classList.add('scale-100');
            }
        }, 10);
    }

    function closeEditVideoModal() {
        // ANIMASI TUTUP MODAL
        const modal = document.getElementById('modalEditVideo');
        const content = document.getElementById('modalContentEditVideo');
        
        modal.classList.add('opacity-0');
        if(content) {
            content.classList.remove('scale-100');
            content.classList.add('scale-95');
        }
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    // LOGIKA 2MB & LIVE PREVIEW
    function previewEditVideoThumbnail(input) {
        const previewImg = document.getElementById('edit_preview_video_img');
        const placeholder = document.getElementById('edit_placeholder_video');
        const errorSize = document.getElementById('edit_error_size_video');

        if (input.files && input.files[0]) {
            const file = input.files[0];
            
            // Batasan Maksimal 2MB
            if (file.size > 2097152) {
                errorSize.classList.remove('hidden');
                input.value = ''; // Tolak file
                
                // Sembunyikan preview jika gagal upload gambar baru
                previewImg.classList.add('hidden');
                placeholder.classList.remove('hidden');
                return;
            }

            // Kalau lolos, tampilkan gambar
            errorSize.classList.add('hidden');
            const reader = new FileReader();
            
            reader.onload = function(e) {
                previewImg.src = e.target.result;
                previewImg.classList.remove('hidden');
                placeholder.classList.add('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    // ==========================================
    // HAPUS VIDEO
    // ==========================================
    function openHapusVideoModal(id) {
        const form = document.getElementById('formHapusVideo');
        if(form && id) {
            form.action = `/admin/profil-pondok/video/hapus/${id}`;
        }
        openModal('modalHapusVideo');
    }
    function closeHapusVideoModal() {
        closeModal('modalHapusVideo');
    }
    </script>
</div>
@endsection