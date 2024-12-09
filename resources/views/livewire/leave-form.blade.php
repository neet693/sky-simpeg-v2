<div>
    <button wire:click="open" class="btn btn-primary">Ajukan Izin</button>

    <!-- Modal HTML -->
    <div class="fixed inset-0 flex items-start justify-start bg-gray-500 bg-opacity-75 transition-opacity z-50"
        style="{{ $isOpen ? 'opacity: 1; pointer-events: auto;' : 'opacity: 0; pointer-events: none;' }}">
        <div class="bg-white rounded-lg p-6 shadow-lg max-w-4xl w-full mx-auto">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Form Pengajuan Izin</h3>
            <form wire:submit.prevent="submitLeave">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Tanggal Mulai:</label>
                        <input
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            type="date" wire:model="tanggal_mulai">
                        @error('tanggal_mulai')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Tanggal Selesai:</label>
                        <input
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            type="date" wire:model="tanggal_selesai">
                        @error('tanggal_selesai')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700">Keterangan:</label>
                        <textarea
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            wire:model="keterangan"></textarea>
                        @error('keterangan')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="mt-6 flex justify-end">
                        <button type="submit" class="btn btn-primary">Ajukan Izin</button>
                        <button type="button" wire:click="close" class="btn btn-secondary ml-4">Tutup</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
