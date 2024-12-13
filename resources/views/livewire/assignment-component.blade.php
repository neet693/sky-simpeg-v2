<div>
    @if (session()->has('message'))
        <div x-data="{ show: true }" x-show="show" x-init="setTimeout(() => show = false, 3000)"
            x-transition:leave="transition-opacity duration-1000 ease-out" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="bg-green-500 text-white px-4 py-2 rounded-lg shadow-md">
            {{ session('message') }}
        </div>
    @endif

    <div class="mb-4">
        <h2 class="text-xl font-bold">Daftar Penugasan</h2>
        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'kepala')
            <!-- Button to Open Modal -->
            <button wire:click="open" class="btn btn-primary">Tambah Tugas</button>
        @endif
    </div>

    <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 transition-opacity z-50"
        style="{{ $isOpen ? 'opacity: 1; pointer-events: auto;' : 'opacity: 0; pointer-events: none;' }}">
        <div class="bg-white rounded-lg p-6 shadow-lg max-w-6xl w-full mx-auto">
            <h3 class="text-lg font-medium text-gray-900 mb-4">
                {{ $isViewMode ? 'Detail Penugasan' : ($isEditMode ? 'Edit Penugasan' : 'Tambah Penugasan') }}
            </h3>
            <form wire:submit.prevent="{{ $isEditMode ? 'saveAssignment' : 'saveAssignment' }}">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                    <!-- Pemberi Tugas -->
                    <div class="col-span-1">
                        <label for="assigner">Pemberi Tugas</label>
                        <select wire:model="assigner_employee_number"
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            {{ $isViewMode ? 'disabled' : (Auth::user()->role === 'admin' || Auth::user()->role === 'kepala' ? '' : 'disabled') }}>
                            <option value="">Pilih Pemberi</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->employee_number }}">{{ $employee->user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Penerima Tugas -->
                    <div class="col-span-1">
                        <label for="assignee" class="block text-sm font-medium text-gray-700">Penerima Tugas</label>
                        <select wire:model="assignee_employee_number"
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            {{ $isViewMode ? 'disabled' : (Auth::user()->role === 'admin' || Auth::user()->role === 'kepala' ? '' : 'disabled') }}
                            required>
                            <option value="">Pilih Penerima</option>
                            @foreach ($employees as $employee)
                                <option value="{{ $employee->employee_number }}">{{ $employee->user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Unit -->
                    <div class="col-span-1">
                        <label for="unit">Unit</label>
                        <select wire:model="unit_id"
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            {{ $isViewMode ? 'disabled' : (Auth::user()->role === 'admin' || Auth::user()->role === 'kepala' ? '' : 'disabled') }}
                            required>
                            <option value="">Pilih Unit</option>
                            @foreach ($units as $unit)
                                <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Judul Tugas -->
                    <div class="col-span-1">
                        <label for="title" class="block text-sm font-medium text-gray-700">Judul Tugas</label>
                        <input type="text" id="title" wire:model="title"
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            required {{ $isViewMode ? 'readonly' : '' }}>
                    </div>

                    <!-- Tanggal Tugas -->
                    <div class="col-span-1">
                        <label for="assignment_date" class="block text-sm font-medium text-gray-700">Tanggal
                            Tugas</label>
                        <input type="date" id="assignment_date" wire:model="assignment_date"
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            required {{ $isViewMode ? 'readonly' : '' }}>
                    </div>

                    <!-- Start Time -->
                    <div class="col-span-1">
                        <label for="start_time" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                        <input type="time" id="start_time" wire:model="start_time"
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            required>
                        @error('start_time')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- End Time -->
                    <div class="col-span-1">
                        <label for="end_time" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                        <input type="time" id="end_time" wire:model="end_time"
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            required>
                        @error('end_time')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Progress -->
                    <div class="col-span-1">
                        <label for="progress" class="block text-sm font-medium text-gray-700">Progres:</label>
                        <select id="progress" wire:model="progress"
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            required {{ $isViewMode ? 'disabled' : '' }}>
                            <option value="Ditugaskan">Ditugaskan</option>
                            <option value="Pending">Pending</option>
                            <option value="Selesai">Selesai</option>
                        </select>
                        @error('progress')
                            <span class="text-red-500">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="col-span-2">
                        <label for="description" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                        <textarea id="description" wire:model="description"
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            rows="4" {{ $isViewMode ? 'readonly' : '' }}></textarea>
                    </div>

                    <div class="col-span-2">
                        <label for="kendala" class="block text-sm font-medium text-gray-700">Kendala</label>
                        <textarea id="kendala" wire:model="kendala"
                            class="mt-1 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                            rows="4" {{ $isViewMode ? 'readonly' : '' }}></textarea>
                    </div>
                </div>
                <div class="mt-6 flex justify-end">
                    @if (!$isViewMode)
                        <button type="submit"
                            class="btn btn-primary">{{ $isEditMode ? 'Simpan Perubahan' : 'Tambah Tugas' }}</button>
                    @endif
                    <button type="button" wire:click="close" class="btn btn-secondary ml-4">Close</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300">
            <thead>
                <tr>
                    <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Yang
                        Bertugas
                    </th>
                    <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Tugas
                    </th>
                    <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Tanggal
                    </th>
                    <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Jam
                    </th>
                    <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">
                        Oleh
                    </th>
                    <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Progres
                    </th>
                    <th class="px-6 py-3 border-b border-gray-300 text-center text-sm font-medium text-gray-700">Aksi
                    </th>
                </tr>
            </thead>
            <tbody>
                @forelse ($assignments as $assignment)
                    <tr>
                        <td class="px-6 py-3 border-b border-gray-300">
                            <img src="{{ $assignment->assignee?->user?->profile_photo_path
                                ? Storage::url($assignment->assignee?->user?->profile_photo_path)
                                : 'https://ui-avatars.com/api/?name=' .
                                    urlencode($assignment->assignee?->user?->name) .
                                    '&color=7F9CF5&background=EBF4FF' }}"
                                alt="{{ $assignment->assignee?->user?->name }}"
                                class="employee-img rounded-full w-16 h-16"
                                title="{{ $assignment->assignee?->user?->name }}">
                            {{-- {{ $assignment->assignee?->user?->name ?? 'Tidak Diketahui' }} --}}
                        </td>
                        <td class="px-6 py-3 border-b border-gray-300">{{ $assignment->title }}</td>
                        <td class="px-6 py-3 border-b border-gray-300">
                            {{ $assignment->assignment_date->format('d M Y') }}
                        </td>
                        <td class="px-6 py-3 border-b border-gray-300">
                            {{ $assignment->start_time->format(' H:i') }} s/d
                            {{ $assignment->end_time->format(' H:i') }}
                        </td>
                        <td class="px-6 py-3 border-b border-gray-300">
                            {{ $assignment->assigner?->user?->name ?? 'Tidak Diketahui' }}
                        </td>
                        <td class="px-6 py-3 border-b border-gray-300">
                            <span
                                class="px-2 py-1 text-xs font-medium text-white {{ $assignment->progress === 'Selesai' ? 'bg-green-500' : 'bg-info' }}">
                                {{ $assignment->progress }}
                            </span>
                        </td>
                        <td class="px-6 py-3 border-b border-gray-300 text-center">
                            <div class="relative" x-data="{ open: false }">
                                <!-- Dropdown Button -->
                                <button @click="open = !open" class="btn btn-primary flex items-center">
                                    Aksi
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="ml-2 h-4 w-4">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M19.5 9.75l-7.5 7.5-7.5-7.5" />
                                    </svg>
                                </button>

                                <!-- Dropdown Menu -->
                                <div x-show="open" @click.away="open = false"
                                    class="absolute right-0 mt-2 w-48 bg-white border border-gray-200 rounded-md shadow-lg">
                                    <ul class="py-1">
                                        @if (Auth::user()->role === 'admin' || Auth::user()->role === 'kepala')
                                            <li>
                                                <button wire:click="edit({{ $assignment->id }})"
                                                    class="w-full px-4 py-2 text-sm text-left hover:bg-gray-100 flex items-center space-x-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="h-4 w-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                                                    </svg>
                                                    <span>Edit</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button wire:click="delete({{ $assignment->id }})"
                                                    class="w-full px-4 py-2 text-sm text-left hover:bg-gray-100 flex items-center space-x-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                        viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                        class="h-4 w-4">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                                                    </svg>
                                                    <span>Hapus</span>
                                                </button>
                                            </li>
                                        @endif
                                        <li>
                                            <button wire:click="viewDetail({{ $assignment->id }})"
                                                class="w-full px-4 py-2 text-sm text-left hover:bg-gray-100 flex items-center space-x-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none"
                                                    viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                                                    class="h-4 w-4">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                                </svg>
                                                <span>Detail</span>
                                            </button>
                                        </li>
                                        @if ($assignment->progress != 'Selesai')
                                            <li>
                                                <button wire:click="setStatusSelesai({{ $assignment->id }})"
                                                    class="w-full px-4 py-2 text-sm text-left hover:bg-gray-100 flex items-center space-x-2">
                                                    <span>Selesai</span>
                                                </button>
                                            </li>
                                            <li>
                                                <button wire:click="openPendingModal({{ $assignment->id }})"
                                                    class="w-full px-4 py-2 text-sm text-left hover:bg-gray-100 flex items-center space-x-2">
                                                    <span>Pending</span>
                                                </button>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="px-6 py-3 border-b border-gray-300 text-center">
                            Tidak ada data penugasan.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <!-- Modal untuk Kendala (hanya muncul ketika Pending) -->
        @if ($isOpenKendalaModal)
            <div
                class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 transition-opacity z-50">
                <div class="bg-white rounded-lg p-6 shadow-lg max-w-6xl w-full mx-auto">
                    <h3 class="text-lg font-medium text-gray-900 mb-4">Masukkan Kendala</h3>
                    <form wire:submit.prevent="submitPending">
                        <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                            <div class="col-span-2">
                                <label for="kendala" class="block text-sm font-medium text-gray-700">Kendala</label>
                                <textarea id="kendala" wire:model="kendala"
                                    class="mt-1 px-2 block w-full border-2 border-gray-300 rounded-md shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-500 focus:ring-opacity-50"
                                    rows="4"></textarea>
                                @error('kendala')
                                    <span class="error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <button type="submit" class="btn btn-primary">Submit Pending</button>
                            <button type="button" wire:click="closePendingModal"
                                class="btn btn-secondary ml-4">Tutup</button>
                        </div>
                    </form>
                </div>
            </div>
        @endif

    </div>
</div>
