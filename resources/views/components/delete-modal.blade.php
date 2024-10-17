<div class="position-fixed top-0 start-0 end-0 bottom-0 bg-dark bg-opacity-50 d-flex align-items-center justify-content-center" style="z-index: 1050;">
    <div class="bg-white p-4 rounded shadow-lg" style="width: 90%; max-width: 500px;">
        <h2 class="h4 mb-3">Konfirmasi Hapus</h2>
        <p>Apakah Anda yakin ingin menghapus agenda ini?</p>
        <div class="text-end">
            <button class="btn btn-danger me-2" wire:click="delete">Ya, Hapus</button>
            <button class="btn btn-secondary" wire:click="cancelDelete">Batal</button>
        </div>
    </div>
</div>