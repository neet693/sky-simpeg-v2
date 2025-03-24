<div>
    @livewire('leave-form')

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif

    <table class="min-w-full bg-white border border-gray-300 display" id="leavesTable">
        <thead>
            <tr>
                <th>Nama</th>
                <th>Tanggal Permohonan</th>
                <th>Disetujui Oleh</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($leaves as $leave)
                <tr>
                    <td>{{ $leave->user->name }}</td>
                    <td>{{ $leave->tanggal_mulai->format('d M y') }} - {{ $leave->tanggal_selesai->format('d M y') }}
                    </td>
                    <td> {{ $leave->approver ? $leave->approver->name : 'Belum disetujui' }}</td>
                    <td class="relative group">
                        @switch($leave->status_permohonan)
                            @case('Disetujui')
                                <div class="relative flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                        stroke="currentColor" class="text-green-500 size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <span
                                        class="absolute px-2 py-1 text-xs text-white transition duration-200 ease-in-out -translate-x-1/2 bg-gray-800 rounded opacity-0 bottom-8 left-1/2 group-hover:opacity-100 whitespace-nowrap">
                                        Disetujui
                                    </span>
                                </div>
                            @break

                            @case('Ditolak')
                                <div class="relative flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="text-red-500 size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <span
                                        class="absolute px-2 py-1 text-xs text-white transition duration-200 ease-in-out -translate-x-1/2 bg-gray-800 rounded opacity-0 bottom-8 left-1/2 group-hover:opacity-100 whitespace-nowrap">
                                        Ditolak
                                    </span>
                                </div>
                            @break

                            @default
                                <div class="relative flex items-center">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="text-yellow-500 size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                                    </svg>
                                    <span
                                        class="absolute px-2 py-1 text-xs text-white transition duration-200 ease-in-out -translate-x-1/2 bg-gray-800 rounded opacity-0 bottom-8 left-1/2 group-hover:opacity-100 whitespace-nowrap">
                                        Menunggu Persetujuan
                                    </span>
                                </div>
                        @endswitch
                    </td>


                    <td>
                        <div class="flex space-x-4">
                            @if (auth()->user()->role === 'kepala' && $leave->status_permohonan === 'Menunggu Persetujuan')
                                <button wire:click="approve({{ $leave->id }})" title="Setujui"
                                    class="flex items-center justify-center w-10 h-10 btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </button>
                                <button wire:click="reject({{ $leave->id }})" title="Tolak"
                                    class="flex items-center justify-center w-10 h-10 btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            @endif
                            <button wire:click="viewDetails({{ $leave->id }})"
                                title="Lihat Izin {{ $leave->user->name }}"
                                class="flex items-center justify-center w-10 h-10 btn btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#leavesTable').DataTable();
        });
    </script>

    {{-- <table class="min-w-full mt-3 bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="px-6 py-3 text-sm font-medium text-left text-gray-700 border-b border-gray-300">Nama</th>
                <th class="px-6 py-3 text-sm font-medium text-left text-gray-700 border-b border-gray-300">Tanggal
                    Permohonan
                </th>
                <th class="px-6 py-3 text-sm font-medium text-left text-gray-700 border-b border-gray-300">Disetujui
                    Oleh
                </th>
                <th class="px-6 py-3 text-sm font-medium text-left text-gray-700 border-b border-gray-300">Status</th>
                <th class="px-6 py-3 text-sm font-medium text-left text-gray-700 border-b border-gray-300">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($leaves as $leave)
                <tr>
                    <td class="px-6 py-3 border-b border-gray-300">{{ $leave->user->name }}</td>
                    <td class="px-6 py-3 border-b border-gray-300">{{ $leave->tanggal_mulai->format('d M y') }}</td>
                    <td class="px-6 py-3 border-b border-gray-300">
                        {{ $leave->approver ? $leave->approver->name : 'Belum disetujui' }}</td>
                    <td class="px-6 py-3 border-b border-gray-300">{{ $leave->status_permohonan }}</td>
                    <td class="px-6 py-3 border-b border-gray-300">
                        <div class="flex space-x-4">
                            @if (auth()->user()->role === 'kepala' && $leave->status_permohonan === 'Menunggu Persetujuan')
                                <button wire:click="approve({{ $leave->id }})" title="Setujui"
                                    class="flex items-center justify-center w-10 h-10 btn btn-success">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </button>
                                <button wire:click="reject({{ $leave->id }})" title="Tolak"
                                    class="flex items-center justify-center w-10 h-10 btn btn-danger">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            @endif
                            <button wire:click="viewDetails({{ $leave->id }})"
                                title="Lihat Izin {{ $leave->user->name }}"
                                class="flex items-center justify-center w-10 h-10 btn btn-info">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M2.036 12.322a1.012 1.012 0 0 1 0-.639C3.423 7.51 7.36 4.5 12 4.5c4.638 0 8.573 3.007 9.963 7.178.07.207.07.431 0 .639C20.577 16.49 16.64 19.5 12 19.5c-4.638 0-8.573-3.007-9.963-7.178Z" />
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M15 12a3 3 0 1 1-6 0 3 3 0 0 1 6 0Z" />
                                </svg>
                            </button>
                        </div>
                    </td>

                </tr>
            @empty
                <tr>
                    <td colspan="6">Belum ada permohonan izin.</td>
                </tr>
            @endforelse
        </tbody>
    </table> --}}

    @if ($isModalOpen)
        <div class="fixed inset-0 z-50 flex items-center justify-center bg-gray-500 bg-opacity-75">
            <div class="w-1/3 p-6 bg-white rounded-lg shadow-lg">
                <h3 class="text-lg font-medium text-gray-900">Detail Permohonan Izin</h3>
                <div class="mt-4">
                    <p><strong>Nama Pegawai:</strong> <br> {{ $selectedLeave->user->name }}</p>
                    <p><strong>Status Kepegawaian:</strong> <br>
                        {{ $selectedLeave->user->employmentDetail->status_kepegawaian }}</p>
                    <p><strong>Hari / Tanggal:</strong> <br> {{ $selectedLeave->tanggal_mulai->format('D, d M Y') }}
                        s/d
                        {{ $selectedLeave->tanggal_selesai->format('D, d M Y') }}</p>
                    <p><strong>Keterangan:</strong> <br> {{ $selectedLeave->keterangan }}</p>
                    <p><strong>Status Permohonan:</strong> {{ $selectedLeave->status_permohonan }}</p>
                    <!-- Menampilkan Yang Memberi Izin dan Pemohon Izin secara sejajar -->
                    <div class="flex justify-between gap-6 mt-4">
                        <div>
                            <strong>Ketua Unit:</strong>
                            <br><br><br>
                            {{ $selectedLeave->approver ? $selectedLeave->approver->name : 'Belum disetujui' }}
                        </div>
                        <div>
                            <strong>Pemohon Izin:</strong>
                            <br><br><br>
                            {{ $selectedLeave->user->name }}
                        </div>
                    </div>
                </div>
                <div class="flex justify-end mt-6">
                    <button wire:click="closeModal" class="px-4 py-2 text-white bg-gray-500 rounded">Tutup</button>
                </div>
            </div>
        </div>
    @endif
</div>
