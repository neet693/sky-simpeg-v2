<div>
    {{-- Do your work, then step back. --}}
    <button wire:click="open" class="btn btn-primary">Buat Rapat</button>

    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif


    <div class="fixed inset-0 flex items-start justify-start bg-gray-500 bg-opacity-75 transition-opacity z-50"
        style="{{ $isOpen ? 'opacity: 1; pointer-events: auto;' : 'opacity: 0; pointer-events: none;' }}">
        <div class="bg-white rounded-lg p-6 shadow-lg max-w-4xl w-full mx-auto">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Form Rapat</h3>
            <form wire:submit.prevent="saveMeeting">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="col-span-1">
                        <label for="unit">Pilih Unit:</label>
                        <select wire:model="selectedUnit"
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            multiple>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700" for="title">Title</label>
                        <input
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            type="text" id="title" wire:model="title">
                        @error('title')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700" for="meeting_date">Date</label>
                        <input
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            type="date" id="meeting_date" wire:model="meeting_date">
                        @error('meeting_date')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700" for="start_time">Start Time</label>
                        <input
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            type="time" id="start_time" wire:model="start_time">
                        @error('start_time')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700" for="end_time">End Time</label>
                        <input
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            type="time" id="end_time" wire:model="end_time">
                        @error('end_time')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700" for="meeting_location">Location</label>
                        <input
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            type="text" id="meeting_location" wire:model="meeting_location">
                        @error('meeting_location')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="col-span-1">
                        <label class="block text-sm font-medium text-gray-700" for="meeting_result">Result</label>
                        <textarea
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            id="meeting_result" wire:model="meeting_result"></textarea>
                        @error('meeting_result')
                            <span class="error">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="btn btn-primary">Ajukan Rapat</button>
                    <button type="button" wire:click="close" class="btn btn-secondary ml-4">Tutup</button>
                </div>
            </form>
        </div>
    </div>
</div>
