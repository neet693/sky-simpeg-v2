<div>
    @livewire('leave-form')

    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif
    <table class="min-w-full bg-white border border-gray-300 mt-3">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Nama</th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Tanggal
                    Permohonan
                </th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Disetujui Oleh
                </th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Status</th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Aksi</th>
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
                                    class="btn btn-success flex items-center justify-center h-10 w-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m4.5 12.75 6 6 9-13.5" />
                                    </svg>
                                </button>
                                <button wire:click="reject({{ $leave->id }})" title="Tolak"
                                    class="btn btn-danger flex items-center justify-center h-10 w-10">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
                                    </svg>
                                </button>
                            @endif
                            <button wire:click="viewDetails({{ $leave->id }})"
                                title="Lihat Izin {{ $leave->user->name }}"
                                class="btn btn-info flex items-center justify-center h-10 w-10">
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
    </table>

    @if ($isModalOpen)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-500 bg-opacity-75 z-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
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
                    <div class="mt-4 flex justify-between gap-6">
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
                <div class="mt-6 flex justify-end">
                    <button wire:click="closeModal" class="bg-gray-500 text-white px-4 py-2 rounded">Tutup</button>
                </div>
            </div>
        </div>
    @endif
</div>
