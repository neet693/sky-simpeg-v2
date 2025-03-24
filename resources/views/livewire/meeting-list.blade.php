<div>
    @livewire('meeting-form')

    <table class="min-w-full bg-white border border-gray-300 display" id="meetingsTable">
        <thead>
            <tr>
                <th>Judul</th>
                <th>Tanggal</th>
                <th>Pukul</th>
                <th>Lokasi</th>
                @if (auth()->user()->role === 'kepala' || auth()->user()->role === 'admin')
                    <th>Aksi</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($meetings as $meeting)
                <tr>
                    <td>{{ $meeting->title }}</td>
                    <td>{{ $meeting->meeting_date->format('d M y') }}</td>
                    <td>{{ $meeting->start_time->format('H:i') }} s/d
                        {{ $meeting->end_time->format('H:i') }}
                    </td>
                    <td>{{ $meeting->meeting_location }}</td>
                    @if (auth()->user()->role === 'kepala' || auth()->user()->role === 'admin')
                        <td class="px-6 py-3 border-b border-gray-300">
                            {{-- <button wire:click="approve({{ $leave->id }})">Setujui</button>
                        <button wire:click="reject({{ $leave->id }})">Tolak</button> --}}
                            <button wire:click="viewDetails({{ $meeting->id }})">Lihat Detail</button>
                        </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#meetingsTable').DataTable();
        });
    </script>
</div>
