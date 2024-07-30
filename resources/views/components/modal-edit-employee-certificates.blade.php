@foreach ($employee->employeeCertificates as $certificate)
    <div id="diklatModal{{ $certificate->name }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="relative z-10 bg-white rounded-lg shadow-xl max-w-3xl mx-auto p-6">
                <form
                    action="{{ route('employee_certification.update', [$employee->employee_number, $certificate->name]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Baris 1: User dan Nama Diklat -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        @if (auth()->user()->role === 'admin')
                            <div>
                                <label for="employee_number" class="block font-medium text-sm text-gray-700">User</label>
                                <select id="employee_number" name="employee_number"
                                    class="form-select rounded-md shadow-sm mt-1 block w-full">
                                    @foreach ($users as $user)
                                        <option value="{{ $user->employee_number }}"
                                            {{ $employee->employee_number == $user->employee_number ? 'selected' : '' }}>
                                            {{ $user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('employee_number')
                                    <span class="text-red-500 text-sm">{{ $message }}</span>
                                @enderror
                            </div>
                        @else
                            <input type="hidden" name="employee_number" value="{{ auth()->user()->employee_number }}">
                        @endif

                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Nama Diklat</label>
                            <input type="text" id="name" name="name"
                                value="{{ old('name', $certificate->name) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 2: Penyelenggara, Tanggal Dikeluarkan, dan Tanggal Berakhir -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="organizer" class="block font-medium text-sm text-gray-700">Penyelenggara</label>
                            <input type="text" id="organizer" name="organizer"
                                value="{{ old('organizer', $certificate->organizer) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('organizer')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="issued_date" class="block font-medium text-sm text-gray-700">Tanggal
                                Dikeluarkan</label>
                            <input type="date" id="issued_date" name="issued_date"
                                value="{{ old('issued_date', $certificate->issued_date->format('Y-m-d')) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('issued_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="expired_date" class="block font-medium text-sm text-gray-700">Tanggal
                                Berakhir</label>
                            <input type="date" id="expired_date" name="expired_date"
                                value="{{ old('expired_date', $certificate->expired_date->format('Y-m-d')) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('expired_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 3: Nomor Kredensial, URL Sertifikat, dan Upload Media -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">
                        <div>
                            <label for="credential_number" class="block font-medium text-sm text-gray-700">Nomor
                                Kredensial</label>
                            <input type="text" id="credential_number" name="credential_number"
                                value="{{ old('credential_number', $certificate->credential_number) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('credential_number')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="certificate_url" class="block font-medium text-sm text-gray-700">URL
                                Sertifikat</label>
                            <input type="url" id="certificate_url" name="certificate_url"
                                value="{{ old('certificate_url', $certificate->certificate_url) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('certificate_url')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 3: Nomor Kredensial, URL Sertifikat, dan Upload Media -->
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-4">

                        <div>
                            <label for="media" class="block font-medium text-sm text-gray-700">Upload Media</label>

                            @if ($certificate->media)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($certificate->media) }}" alt="Current Media"
                                        class="w-32 h-32 object-cover rounded">
                                </div>
                            @endif

                            <input type="file" id="media" name="media"
                                class="form-input rounded-md shadow-sm mt-1 block w-full">
                            @error('media')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Save</button>
                        <button type="button" data-modal-close="diklatModal{{ $certificate->name }}"
                            class="ml-3 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

<!-- End Modal -->

<script>
    document.querySelectorAll('[data-modal-toggle]').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-modal-toggle');
            document.getElementById(targetId).classList.remove('hidden');
        });
    });

    document.querySelectorAll('[data-modal-close]').forEach(button => {
        button.addEventListener('click', function() {
            const targetId = this.getAttribute('data-modal-close');
            document.getElementById(targetId).classList.add('hidden');
        });
    });
</script>
