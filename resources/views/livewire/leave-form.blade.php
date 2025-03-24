<div>
    <button wire:click="open" class="mb-3 btn btn-primary">Ajukan Izin</button>

    <!-- Modal HTML -->
    <div class="fixed inset-0 z-50 flex items-start justify-start transition-opacity bg-gray-500 bg-opacity-75"
        style="{{ $isOpen ? 'opacity: 1; pointer-events: auto;' : 'opacity: 0; pointer-events: none;' }}">
        <div class="w-full max-w-4xl p-6 mx-auto bg-white rounded-lg shadow-lg">
            <h3 class="mb-4 text-lg font-medium text-gray-900">Form Pengajuan Izin</h3>
            <form wire:submit.prevent="submitLeave">
                <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Tanggal Mulai:</label>
                        <input
                            class="block w-full mt-1 border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            type="date" wire:model="tanggal_mulai">
                        @error('tanggal_mulai')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Tanggal Selesai:</label>
                        <input
                            class="block w-full mt-1 border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            type="date" wire:model="tanggal_selesai">
                        @error('tanggal_selesai')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Keterangan:</label>
                        <textarea
                            class="block w-full mt-1 border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            wire:model="keterangan"></textarea>
                        @error('keterangan')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="flex justify-end mt-6">
                        <button type="submit" class="btn btn-primary">Ajukan Izin</button>
                        <button type="button" wire:click="close" class="ml-4 btn btn-secondary">Tutup</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
