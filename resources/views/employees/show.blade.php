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
            <button id="openDiklatModalButton" class="btn btn-primary">Tambah / Edit</button>
        </div>

        @include('components.modal-employee-certificates')

        <div class="mt-4 space-y-4">
            @forelse ($employee->employeeCertificates as $certificate)
                <div class="flex items-center">
                    <div class="w-3/4">
                        <p class="font-semibold">
                            {{ $certificate->name }}
                        </p>
                    </div>

                </div>
                <div class="flex items-center">
                    <div class="w-3/4">
                        <p class="text-grey-600">
                            {{ $certificate->organizer }}
                        </p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-1/4">
                        <p class="text-gray-500">Issued {{ $certificate->issued_date->format('M Y') }} -
                            {{ $certificate->expired_date->format('M Y') }}</p>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-1/4">
                        <p class="text-gray-500">Credential ID {{ $certificate->credential_number }}</p>
                    </div>
                </div>

                <div class="flex items-center">
                    <div class="w-1/4">
                        <a href="{{ $certificate->certificate_url }}" target="_blank" class="btn btn-primary">Lihat
                            Online</a>
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="w-3/4">
                        @if ($certificate->media)
                            <img src="{{ Storage::url($certificate->media) }}" alt="{{ $certificate->name }}"
                                class="w-full h-auto">
                        @endif
                    </div>
                </div>
            @empty
                <p class="text-gray-500">No Certificate Found. Try Upload one.</p>
            @endforelse

        </div>
    </div>
    {{-- End --}}
@endsection
