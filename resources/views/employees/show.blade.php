@extends('template.main')
@section('content')
    {{-- Profile Pegawai --}}
    <div class="bg-white p-6 rounded-lg shadow-md">
        <div class="flex items-center space-x-4">
            <img src="{{ $employee->profile_photo_path
                ? Storage::url($employee->profile_photo_path)
                : 'https://ui-avatars.com/api/?name=' . urlencode($employee->name) . '&color=7F9CF5&background=EBF4FF' }}"
                alt="{{ $employee->name }}" class="w-24 h-24 rounded-full">
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
                    <p class="font-semibold">
                        {{ $employee->employeeSpouses->isEmpty() ? 'Belum Menikah' : 'Sudah Menikah' }}
                    </p>

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
                <p class="font-semibold">
                    {{ $employee->employmentDetail ? $employee->employmentDetail->unit->name : 'N/A' }}
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

    <div class="flex space-x-6 mt-6 mb-6">
        {{-- Riwayat Pendidikan dan Diklat --}}
        <div class="bg-white p-6 rounded-lg shadow-md mt-6 w-1/2">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-semibold">Riwayat Pendidikan dan Diklat</h3>
            </div>

            <!-- Tabs -->
            <div class="mt-4 border-b tabs-education">
                <nav class="flex space-x-4" role="tablist">
                    <button class="tab-button active sidebar-item text-white"
                        data-target="#educationHistoryTab">Pendidikan</button>
                    <button class="tab-button sidebar-item hover:bg-purple-400" data-target="#diklatTab">Diklat</button>
                </nav>
            </div>

            <!-- Content -->
            <div class="mt-4">
                <!-- Pendidikan -->
                <div id="educationHistoryTab" class="tab-content active">
                    <div class="flex justify-between items-center">
                        <h4 class="text-lg font-semibold">Informasi Pendidikan</h4>


                        <button id="openEducationModalButton" class="btn btn-statistic">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </button>
                        @include('components.modal-employee-education')
                    </div>
                    <div class="space-y-4 mt-4">
                        @forelse ($employee->educationHistories as $education)
                            <div class="relative p-4 border rounded-lg shadow-lg flex">
                                {{-- <div class="w-16 h-16 mr-4">
                        <img src="{{ Storage::url($education->media) }}" alt="{{ $education->name }}"
                            class="w-full h-full object-cover rounded">
                        </div> --}}
                                <div class="flex-grow">
                                    <h2 class="text-lg font-semibold">{{ $education->institution }}</h2>
                                    <p class="text-gray-600">{{ $education->degree }}</p>
                                    <p class="text-gray-600">{{ $education->field }}</p>
                                    <p class="text-gray-600">{{ $education->start_date->format('M Y') }} -
                                        {{ $education->end_date->format('M Y') }}</p>
                                    <p class="text-gray-600">Description: {{ $education->description }}</p>
                                </div>

                                <!-- Edit Button -->
                                <a href="#" data-modal-toggle="diklatModal{{ $education->id }}"
                                    class="absolute top-2 right-2 p-2 text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>

                                </a>
                                @include('components.modal-edit-employee-education', [
                                    'employee_number' => $employee->employee_number,
                                    'education' => $education,
                                ])
                            </div>

                        @empty
                            <p class="text-gray-500">Education History not found. Try Upload one.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Diklat -->
                <div id="diklatTab" class="tab-content hidden">
                    <div class="flex justify-between items-center">
                        <h4 class="text-lg font-semibold">Informasi Diklat</h4>
                        <button id="openDiklatModalButton" class="btn btn-statistic">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </button>
                        @include('components.modal-employee-certificates')
                    </div>
                    <div class="space-y-4 mt-4">
                        @forelse ($employee->employeeCertificates as $certificate)
                            <div class="relative p-4 border rounded-lg shadow-lg flex">
                                <div class="w-16 h-16 mr-4">
                                    <img src="{{ Storage::url($certificate->media) }}" alt="{{ $certificate->name }}"
                                        class="w-full h-full object-cover rounded">
                                </div>
                                <div class="flex-grow">
                                    <h2 class="text-lg font-semibold">{{ $certificate->name }}</h2>
                                    <p class="text-gray-600">{{ $certificate->organizer }}</p>
                                    <p class="text-gray-600">{{ $certificate->issued_date->format('M Y') }} -
                                        {{ $certificate->expired_date->format('M Y') }}</p>
                                    <p class="text-gray-600">Credential ID: {{ $certificate->credential_number }}</p>
                                    <a href="{{ $certificate->certificate_url }}"
                                        class="text-blue-500 hover:underline">Show
                                        credential</a>
                                </div>

                                <!-- Edit Button -->
                                <a href="#" data-modal-toggle="diklatModal{{ $certificate->name }}"
                                    class="absolute top-2 right-2 p-2 text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>

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
        </div>
        {{-- End --}}

        {{-- Informasi Keluarga --}}
        <div class="bg-white p-6 rounded-lg shadow-md mt-6 w-1/2">
            <div class="flex justify-between items-center">
                <h3 class="text-xl font-semibold">Informasi Keluarga</h3>
            </div>

            <!-- Tabs -->
            <div class="mt-4 border-b tabs-family">
                <nav class="flex space-x-4" role="tablist">
                    <button class="tab-button active sidebar-item text-white"
                        data-target="#spouseTab">Suami/Istri</button>
                    <button class="tab-button sidebar-item hover:bg-purple-400" data-target="#childrenTab">Anak</button>
                </nav>
            </div>

            <!-- Content -->
            <div class="mt-4">
                <!-- Suami/Istri -->
                <div id="spouseTab" class="tab-content active">
                    <div class="flex justify-between items-center">
                        <h4 class="text-lg font-semibold">Informasi Suami/Istri</h4>
                        <button id="openSpouseModalButton" class="btn btn-statistic">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </button>
                        @include('components.modal-employee-spouse')
                    </div>
                    <div class="space-y-4 mt-4">
                        @forelse ($employee->employeeSpouses as $spouse)
                            <div class="relative p-4 border rounded-lg shadow-lg flex">
                                <div class="flex-grow">
                                    <h2 class="text-lg font-semibold">{{ $spouse->name }}</h2>
                                    <p class="text-gray-600">
                                        Tanggal Lahir:
                                        {{ $spouse->birth_date ? $spouse->birth_date->format('d F Y') : 'N/A' }}
                                        ({{ $spouse->age ?? 'N/A' }} tahun)
                                    </p>
                                    <p class="text-gray-600">Status: {{ $spouse->notes ?? 'N/A' }}</p>
                                </div>
                                <a href="#" data-modal-toggle="spouseModal{{ $spouse->id }}"
                                    class="absolute top-2 right-2 p-2 text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                @foreach ($employee->employeeChilds as $child)
                                    @include('components.modal-edit-employee-spouse', [
                                        'employee_number' => $employee->employee_number,
                                        'spouse' => $spouse,
                                    ])
                                @endforeach
                            </div>
                        @empty
                            <p class="text-gray-500">Informasi Suami/Istri tidak tersedia.</p>
                        @endforelse
                    </div>
                </div>

                <!-- Anak -->
                <div id="childrenTab" class="tab-content hidden">
                    <div class="flex justify-between items-center">
                        <h4 class="text-lg font-semibold">Informasi Anak</h4>
                        <button id="openChildrenModalButton" class="btn btn-statistic">
                            <img src="{{ asset('template/assets/img/global/times.svg') }}" alt="">
                        </button>
                        @include('components.modal-employee-children')
                    </div>
                    <div class="space-y-4 mt-4">
                        @forelse ($employee->employeeChilds as $child)
                            <div class="relative p-4 border rounded-lg shadow-lg flex">
                                <div class="flex-grow">
                                    <h2 class="text-lg font-semibold">{{ $child->name }}</h2>
                                    <p class="text-gray-600">Tanggal Lahir: {{ $child->birth_date->format('d F Y') }}
                                        ({{ $child->age ?? 'N/A' }} tahun)
                                    </p>
                                    <p class="text-gray-600">Jenis Kelamin: {{ $child->gender }}</p>
                                    <p class="text-gray-600">Status: {{ $child->notes }}</p>
                                </div>
                                <a href="#" data-modal-toggle="childModal{{ $child->id }}"
                                    class="absolute top-2 right-2 p-2 text-blue-500 hover:text-blue-700">
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke-width="1.5" stroke="currentColor" class="size-6">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L10.582 16.07a4.5 4.5 0 0 1-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 0 1 1.13-1.897l8.932-8.931Zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0 1 15.75 21H5.25A2.25 2.25 0 0 1 3 18.75V8.25A2.25 2.25 0 0 1 5.25 6H10" />
                                    </svg>
                                </a>
                                @foreach ($employee->employeeChilds as $child)
                                    @include('components.modal-edit-employee-child', [
                                        'employee_number' => $employee->employee_number,
                                        'child' => $child,
                                    ])
                                @endforeach
                            </div>
                        @empty
                            <p class="text-gray-500">Informasi Anak tidak tersedia.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
        {{-- End --}}
    </div>

    <script>
        // document.querySelectorAll('.tab-button').forEach(button => {
        //     button.addEventListener('click', () => {
        //         // Hapus kelas active dan background dari semua tombol
        //         document.querySelectorAll('.tab-button').forEach(btn => {
        //             btn.classList.remove('active', 'sidebar-item', 'text-white');
        //         });

        //         // Sembunyikan semua tab konten
        //         document.querySelectorAll('.tab-content').forEach(content => content.classList.add(
        //             'hidden'));

        //         // Tambahkan kelas active, background, dan teks warna putih pada tombol yang dipilih
        //         button.classList.add('active', 'sidebar-item', 'text-white');

        //         // Tampilkan konten tab yang sesuai
        //         document.querySelector(button.dataset.target).classList.remove('hidden');
        //     });
        // });
        document.addEventListener("DOMContentLoaded", function() {
            // Select all tab buttons
            const tabButtons = document.querySelectorAll(".tab-button");

            // Add click event listener to each button
            tabButtons.forEach((button) => {
                button.addEventListener("click", function() {
                    const targetId = this.getAttribute("data-target"); // Get the target ID
                    const tabContainer = this.closest(
                        ".tabs-education, .tabs-family"); // Limit to specific tab groups
                    const contentContainer = tabContainer
                        .nextElementSibling; // Get the content area

                    // Remove active class from all buttons
                    tabContainer.querySelectorAll(".tab-button").forEach((btn) => {
                        btn.classList.remove("active", "text-white");
                    });

                    // Hide all tab contents
                    contentContainer.querySelectorAll(".tab-content").forEach((content) => {
                        content.classList.add("hidden");
                        content.classList.remove("active");
                    });

                    // Add active class to clicked button
                    this.classList.add("active", "text-white");

                    // Show the corresponding tab content
                    const targetTab = contentContainer.querySelector(targetId);
                    if (targetTab) {
                        targetTab.classList.remove("hidden");
                        targetTab.classList.add("active");
                    }
                });
            });
        });
    </script>

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
