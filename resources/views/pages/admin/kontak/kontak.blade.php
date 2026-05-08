@extends('layouts.admin')

@section('content')

<div class="bg-white rounded-2xl border border-gray-100 p-8 shadow-sm">

    {{-- TOAST NOTIFICATION CONTAINER --}}
    <div id="toast-container" class="fixed top-5 right-5 z-[9999] flex flex-col gap-3 items-end pointer-events-none">
        @if(session('success'))
            <div class="toast-alert pointer-events-auto flex items-start gap-3 bg-white border-l-4 border-green-500 shadow-xl rounded-lg p-4 min-w-[300px] max-w-sm transform transition-all duration-500 translate-x-full opacity-0">
                <svg class="w-6 h-6 text-green-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div class="flex-1">
                    <h4 class="text-sm font-bold text-gray-800">Berhasil</h4>
                    <p class="text-xs text-gray-500 mt-0.5">{{ session('success') }}</p>
                </div>
                <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        @endif

        @if ($errors->any())
            <div class="toast-alert pointer-events-auto flex items-start gap-3 bg-white border-l-4 border-red-500 shadow-xl rounded-lg p-4 min-w-[300px] max-w-sm transform transition-all duration-500 translate-x-full opacity-0">
                <svg class="w-6 h-6 text-red-500 shrink-0" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                </svg>
                <div class="flex-1">
                    <h4 class="text-sm font-bold text-gray-800">Peringatan</h4>
                    <ul class="list-disc list-inside mt-1 text-xs text-gray-500">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                <button onclick="this.parentElement.remove()" class="text-gray-400 hover:text-gray-600 transition">
                    <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" /></svg>
                </button>
            </div>
        @endif
    </div>

    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center mb-6 gap-4">
        <div>
            <h1 class="text-2xl font-bold text-[#1E5631]">
                Kontak Pendaftaran
            </h1>
            <p class="text-sm text-gray-500 mt-1">
                Kelola nomor WhatsApp (HP) panitia pendaftaran untuk Santri Putra dan Putri
            </p>
        </div>
        
        <!-- <div class="bg-blue-50 border border-blue-200 text-blue-700 px-4 py-2 rounded-lg text-sm flex items-center gap-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            <span>Nomor WA harus diawali dengan angka 0 atau kode negara (contoh: 0812... / 62812...).</span>
        </div> -->
    </div>

    <div class="overflow-x-auto">
        <table class="w-full border border-[#D9D9D9] border-collapse">
            <thead>
                <tr class="bg-white border-b border-[#D9D9D9]">
                    <th class="p-4 text-left font-bold text-black border-r border-[#D9D9D9] w-1/3">
                        Bagian Kepanitiaan
                    </th>
                    <th class="p-4 text-left font-bold text-black border-r border-[#D9D9D9]">
                        Nomor WhatsApp / HP Aktif
                    </th>
                    <th class="p-4 text-center font-bold text-black w-32">
                        Aksi
                    </th>
                </tr>
            </thead>
            
            <tbody>
                @foreach($kontak as $item)
                <tr class="border-b border-[#D9D9D9] hover:bg-gray-50 transition">
                    <td class="p-4 border-r border-[#D9D9D9] font-medium text-[#1E5631]">
                        @if($item->id == 1)
                            Putra
                        @elseif($item->id == 2)
                            Putri
                        @endif
                    </td>

                    <td class="p-4 text-sm text-[#444444] border-r border-[#D9D9D9]">
                        {{ $item->no_hp }}
                    </td>

                    <td class="px-5 py-6 text-center align-middle whitespace-nowrap">
                        <div class="flex gap-3 justify-center items-center">
                            <button type="button" 
                                data-id="{{ $item->id }}"
                                data-label="{{ $item->id == 1 ? 'Kontak Pendaftaran Santri Putra' : 'Kontak Pendaftaran Santri Putri' }}"
                                data-hp="{{ $item->no_hp }}"
                                onclick="openEditModal(this)"
                                class="bg-blue-100 text-blue-600 px-4 py-1.5 rounded font-bold hover:bg-blue-200 transition-colors focus:outline-none">
                                Edit
                            </button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

{{-- MODAL EDIT KONTAK --}}
<div id="editModal" class="hidden fixed inset-0 bg-black/40 flex items-center justify-center z-50 transition-opacity duration-300 opacity-0">
    <div class="bg-white w-full max-w-md rounded-xl overflow-hidden shadow-lg transform scale-95 transition-transform duration-300">
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            
            <div class="bg-[#1E5631] text-white text-center py-3 font-semibold flex justify-between items-center px-4">
                <span>Edit Kontak Pendaftaran</span>
                <button type="button" onclick="closeModal('editModal')" class="text-white hover:text-gray-200 focus:outline-none">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                </button>
            </div>

            <div class="p-5 space-y-4">
                <div>
                    <label class="text-sm font-bold text-gray-700">Kepanitiaan</label>
                    <input type="text" id="editLabel" readonly
                        class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm bg-gray-100 text-gray-500 cursor-not-allowed outline-none">
                </div>

                <div>
                    <label class="text-sm font-bold text-gray-700">Nomor WhatsApp Baru</label>
                    <input type="text" name="no_hp" id="editHp" required maxlength="15"
                        placeholder="Contoh: 08123456789"
                        class="w-full mt-1 border border-gray-300 rounded px-3 py-2 text-sm focus:outline-none focus:border-[#1E5631] focus:ring-1 focus:ring-[#1E5631]">
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeModal('editModal')"
                        class="border border-gray-300 text-gray-700 px-4 py-2 rounded text-sm font-bold hover:bg-gray-50 transition">
                        Batal
                    </button>
                    <button type="submit"
                        class="bg-[#1E5631] text-white px-4 py-2 rounded text-sm font-bold hover:bg-[#17472a] transition shadow-sm">
                        Simpan Nomor
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
        const toasts = document.querySelectorAll('.toast-alert');
        
        toasts.forEach(function(toast, index) {
            setTimeout(function() {
                toast.classList.remove('translate-x-full', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');
            }, 100 + (index * 150)); 
            
            setTimeout(function() {
                toast.classList.remove('translate-x-0', 'opacity-100');
                toast.classList.add('translate-x-full', 'opacity-0');
                setTimeout(function() {
                    toast.remove();
                }, 500);
            }, 4000); 
        });
    });

    function openModal(id){
        const modal = document.getElementById(id);
        const content = modal.querySelector('.transform');
        
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        void modal.offsetWidth;
        modal.classList.remove('opacity-0');
        content.classList.remove('scale-95');
        
        document.body.style.overflow = 'hidden'; 
    }

    function closeModal(id){
        const modal = document.getElementById(id);
        const content = modal.querySelector('.transform');
        
        modal.classList.add('opacity-0');
        content.classList.add('scale-95');
        
        setTimeout(() => {
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto'; 
        }, 300);
    }

    function openEditModal(button){
        let id = button.getAttribute('data-id');
        let label = button.getAttribute('data-label');
        let hp = button.getAttribute('data-hp');

        document.getElementById('editForm').action = '/admin/kontak/' + id;
        document.getElementById('editLabel').value = label;
        document.getElementById('editHp').value = hp;
        
        openModal('editModal');
    }
</script>

@endsection