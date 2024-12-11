<div>
    @livewire('meeting-form')

    <table class="min-w-full bg-white border border-gray-300 mt-3">
        <thead>
            <tr>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Judul</th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Tanggal
                    Rapat
                </th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Pukul</th>
                <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Lokasi</th>
                @if (auth()->user()->role === 'kepala' || auth()->user()->role === 'admin')
                    <th class="px-6 py-3 border-b border-gray-300 text-left text-sm font-medium text-gray-700">Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @forelse ($meetings as $meeting)
                <tr>
                    <td class="px-6 py-3 border-b border-gray-300">{{ $meeting->title }}</td>
                    <td class="px-6 py-3 border-b border-gray-300">{{ $meeting->meeting_date->format('d M y') }}</td>
                    <td class="px-6 py-3 border-b border-gray-300">{{ $meeting->start_time->format('H:i') }} s/d
                        {{ $meeting->end_time->format('H:i') }}</td>
                    <td class="px-6 py-3 border-b border-gray-300">{{ $meeting->meeting_location }}</td>
                    {{-- <td class="px-6 py-3 border-b border-gray-300">{{ $meeting->meeting_result }}</td> --}}

                    @if (auth()->user()->role === 'kepala' || auth()->user()->role === 'admin')
                        <td class="px-6 py-3 border-b border-gray-300">
                            {{-- <button wire:click="approve({{ $leave->id }})">Setujui</button>
                            <button wire:click="reject({{ $leave->id }})">Tolak</button> --}}
                            <button wire:click="viewDetails({{ $meeting->id }})">Lihat Detail</button>
                    @endif
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center font-bold">Data Kosong.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
