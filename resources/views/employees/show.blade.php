@extends('template.main')
@section('content')
    {{-- Profile Pegawai --}}
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center space-x-4">
            <img src="{{ $employee->profile_photo_url }}" alt="Profile Photo" class="w-24 h-24 rounded-full">
            <div>
                <h2 class="text-2xl font-semibold">{{ $employee->name }}</h2>
                <p class="text-gray-600">{{ $employee->email }}</p>
                <p class="text-gray-600">{{ $employee->phone_number }}</p>
            </div>
        </div>

        <div class="mt-6">
            <h3 class="text-xl font-semibold">Informasi Data Diri</h3>
            <div class="grid grid-cols-2 gap-4 mt-4">
                <div>
                    <p class="text-gray-600">Employee Number</p>
                    <p class="font-semibold">{{ $employee->employee_number }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Gender</p>
                    <p class="font-semibold">{{ $employee->gender }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Tanggal Lahir</p>
                    <p class="font-semibold">{{ $employee->birth_date->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Status Perkawinan</p>
                    <p class="font-semibold">Sudah Menikah</p>
                </div>
                <div>
                    <p class="text-gray-600">Alamat</p>
                    <p class="font-semibold">{{ $employee->address }}</p>
                </div>
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Informasi Terkait Kepegawaian di Yahya --}}
    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <div class="row">
            <div class="col-6">
                <h3 class="text-xl font-semibold">Informasi Kepegawaian Yahya</h3>
            </div>
            <div class="col-6 d-flex justify-content-end">
                <button id="openEmployeeDetailModalButton" class="btn btn-primary">Tambah / Edit</button>
            </div>
            @include('components.modal-employment-detail')
        </div>

        <div class="grid grid-cols-2 gap-4 mt-4">
            <div>
                <p class="text-gray-600">Tahun Masuk</p>
                <p class="font-semibold">
                    {{ $employee->employmentDetail ? $employee->employmentDetail->tahun_masuk->format('Y') : 'N/A' }}</p>
            </div>
            <div>
                <p class="text-gray-600">Unit</p>
                <p class="font-semibold">{{ $employee->employmentDetail ? $employee->employmentDetail->unit->name : 'N/A' }}
                </p>
            </div>
            <div>
                <p class="text-gray-600">Tahun sertifikasi</p>
                <p class="font-semibold">
                    {{ $employee->employmentDetail ? $employee->employmentDetail->tahun_sertifikasi->format('Y') : 'N/A' }}
                </p>
            </div>
            <div>
                <p class="text-gray-600">Status Kepegawaian</p>
                <p class="font-semibold">
                    {{ $employee->employmentDetail ? $employee->employmentDetail->status_kepegawaian : 'N/A' }}
                </p>
            </div>
        </div>
    </div>
    {{-- End --}}



    {{-- Diklat Pegawai --}}
    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-semibold">Diklat Pegawai</h3>
            <button id="openDiklatModalButton" class="btn btn-primary">Tambah</button>
            @include('components.modal-employee-certificates')
        </div>
        <div class="max-w-4xl mx-auto p-6">
            <div class="space-y-4">
                @forelse ($employee->employeeCertificates as $certificate)
                    <div class="p-4 border rounded-lg shadow-lg flex">
                        <div class="w-16 h-16 mr-4">
                            <img src="{{ Storage::url($certificate->media) }}" alt="{{ $certificate->name }}"
                                class="w-full h-full object-cover rounded">
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold">{{ $certificate->name }}</h2>
                            <p class="text-gray-600">{{ $certificate->organizer }}</p>
                            <p class="text-gray-600">{{ $certificate->issued_date->format('M Y') }} -
                                {{ $certificate->expired_date->format('M Y') }}</p>
                            <p class="text-gray-600">Credential ID: {{ $certificate->credential_number }}</p>
                            <a href="{{ $certificate->certificate_url }}" class="text-blue-500 hover:underline">Show
                                credential</a>
                        </div>

                        <a href="#" data-modal-toggle="diklatModal{{ $certificate->name }}"
                            class="btn btn-primary">Edit</a>
                        @include('components.modal-edit-employee-certificates', [
                            'employee_number' => $employee->employee_number,
                            'certificate' => $certificate,
                        ])
                    </div>
                @empty
                    <p class="text-gray-500">No
                        Certificate Found. Try Upload one.</p>
                @endforelse
            </div>
        </div>
    </div>
    {{-- End --}}

    {{-- Riwayat Pendidikan --}}
    <div class="bg-white p-6 rounded-lg shadow-md mt-6">
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-semibold">Diklat Pegawai</h3>
            <button id="openDiklatModalButton" class="btn btn-primary">Tambah</button>
            @include('components.modal-employee-certificates')
        </div>
        <div class="max-w-4xl mx-auto p-6">
            <div class="space-y-4">
                @forelse ($employee->employeeCertificates as $certificate)
                    <div class="p-4 border rounded-lg shadow-lg flex">
                        <div class="w-16 h-16 mr-4">
                            <img src="{{ Storage::url($certificate->media) }}" alt="{{ $certificate->name }}"
                                class="w-full h-full object-cover rounded">
                        </div>
                        <div>
                            <h2 class="text-lg font-semibold">{{ $certificate->name }}</h2>
                            <p class="text-gray-600">{{ $certificate->organizer }}</p>
                            <p class="text-gray-600">{{ $certificate->issued_date->format('M Y') }} -
                                {{ $certificate->expired_date->format('M Y') }}</p>
                            <p class="text-gray-600">Credential ID: {{ $certificate->credential_number }}</p>
                            <a href="{{ $certificate->certificate_url }}" class="text-blue-500 hover:underline">Show
                                credential</a>
                        </div>

                        <a href="#" data-modal-toggle="diklatModal{{ $certificate->name }}"
                            class="btn btn-primary">Edit</a>
                        @include('components.modal-edit-employee-certificates', [
                            'employee_number' => $employee->employee_number,
                            'certificate' => $certificate,
                        ])
                    </div>
                @empty
                    <p class="text-gray-500">No
                        Certificate Found. Try Upload one.</p>
                @endforelse
            </div>
        </div>
    </div>
    {{-- End --}}


    <script>
        document.querySelectorAll('[id^="openEditDiklatModalButton"]').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                document.querySelector(targetId).classList.remove('hidden');
            });
        });

        document.querySelectorAll('[id^="closeEditDiklatModalButton"]').forEach(button => {
            button.addEventListener('click', function() {
                const modalId = this.getAttribute('data-target');
                document.querySelector(modalId).classList.add('hidden');
            });
        });
    </script>
@endsection
