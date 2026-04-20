{{-- Ubah baris ini saja --}}
<div id="modalHapusVideo" class="hidden fixed inset-0 z-[9999] items-center justify-center bg-black/50 backdrop-blur-sm transition-opacity opacity-0">
    <div class="bg-white rounded-lg w-full max-w-sm p-6 relative text-center">
        
        {{-- Ikon Peringatan --}}
        <div class="mx-auto flex items-center justify-center h-14 w-14 rounded-full bg-red-100 mb-4">
            <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
            </svg>
        </div>
        
        <h3 class="text-xl font-bold text-gray-900 mb-2">Hapus Video?</h3>
        <p class="text-sm text-gray-500 mb-6">Apakah Anda yakin ingin menghapus data video ini? Data yang dihapus tidak dapat dikembalikan.</p>
        
        {{-- Form Hapus --}}
        <form id="formHapusVideo" method="POST">
    @csrf
    @method('DELETE')
    
    <div class="flex justify-center gap-3">
        <button type="button" onclick="closeHapusVideoModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded font-medium hover:bg-gray-300 transition-colors w-full">Batal</button>
        <button type="submit" class="px-4 py-2 bg-red-600 text-white rounded font-medium hover:bg-red-700 transition-colors w-full">Ya, Hapus</button>
    </div>
</form>
    </div>
</div>