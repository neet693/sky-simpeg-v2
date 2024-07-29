@extends('template.main')
@section('content')
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
@endsection
