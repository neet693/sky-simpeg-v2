<div>
    <div class="col-6 d-flex justify-content-end">
        @livewire('leave-form')
    </div>
    @if (session()->has('message'))
        <div>{{ session('message') }}</div>
    @endif
    <table class="min-w-full bg-white border border-gray-300">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Nama</th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Tanggal
                    Permohonan
                </th>
                {{-- <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Tanggal
                Selesai</th> --}}
                {{-- <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Keterangan
                </th> --}}
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Disetujui Oleh
                </th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Status</th>
                @if (auth()->user()->role === 'kepala')
                    <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($leaves as $leave)
                <tr>
                    <td class="px-6 py-3 border-b border-gray-300">{{ $leave->user->name }}</td>
                    <td class="px-6 py-3 border-b border-gray-300">{{ $leave->tanggal_mulai->format('d M y') }}</td>
                    {{-- <td class="px-6 py-3 border-b border-gray-300">{{ $leave->tanggal_selesai->format('d M y') }}</td> --}}
                    {{-- <td class="px-6 py-3 border-b border-gray-300">{{ $leave->keterangan }}</td> --}}
                    <td class="px-6 py-3 border-b border-gray-300">{{ $leave->approver->name }}</td>
                    <td class="px-6 py-3 border-b border-gray-300">{{ $leave->status_permohonan }}</td>

                    <td class="px-6 py-3 border-b border-gray-300">
                        @if (auth()->user()->role === 'kepala' && $leave->status_permohonan === 'Menunggu Persetujuan')
                            <button wire:click="approve({{ $leave->id }})">Setujui</button>
                            <button wire:click="reject({{ $leave->id }})">Tolak</button>
                        @endif
                        <button wire:click="viewDetails({{ $leave->id }})">Lihat Detail</button>
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
