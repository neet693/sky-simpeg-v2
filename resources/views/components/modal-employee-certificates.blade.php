<!-- Modal -->
<div id="diklatModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="fixed inset-0 flex items-center justify-center">
        <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
        <div class="relative z-10 bg-white rounded-lg shadow-xl max-w-lg mx-auto p-6">
            <form action="{{ route('employee_certification.store', $employee->employee_number) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <!-- Field employee_number -->
                @if (auth()->user()->role === 'admin')
                    <div class="mb-4">
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

                <!-- Other fields -->
                <div class="mb-4">
                    <label for="name" class="block font-medium text-sm text-gray-700">Nama Diklat</label>
                    <input type="text" id="name" name="name"
                        class="form-input rounded-md shadow-sm mt-1 block w-full" />
                    @error('name')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="organizer" class="block font-medium text-sm text-gray-700">Penyelenggara</label>
                    <input type="text" id="organizer" name="organizer"
                        class="form-input rounded-md shadow-sm mt-1 block w-full" />
                    @error('organizer')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="issued_date" class="block font-medium text-sm text-gray-700">Tanggal Dikeluarkan</label>
                    <input type="date" id="issued_date" name="issued_date"
                        class="form-input rounded-md shadow-sm mt-1 block w-full" />
                    @error('issued_date')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="expired_date" class="block font-medium text-sm text-gray-700">Tanggal Berakhir</label>
                    <input type="date" id="expired_date" name="expired_date"
                        class="form-input rounded-md shadow-sm mt-1 block w-full" />
                    @error('expired_date')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="credential_number" class="block font-medium text-sm text-gray-700">Nomor
                        Kredensial</label>
                    <input type="text" id="credential_number" name="credential_number"
                        class="form-input rounded-md shadow-sm mt-1 block w-full" />
                    @error('credential_number')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="certificate_url" class="block font-medium text-sm text-gray-700">URL Sertifikat</label>
                    <input type="url" id="certificate_url" name="certificate_url"
                        class="form-input rounded-md shadow-sm mt-1 block w-full" />
                    @error('certificate_url')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="media" class="block font-medium text-sm text-gray-700">Upload Media</label>
                    <input type="file" id="media" name="media"
                        class="form-input rounded-md shadow-sm mt-1 block w-full">
                    @error('media')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit"
                        class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Save</button>
                    <button type="button" id="closeDiklatModalButton"
                        class="ml-3 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- End Modal -->

<script>
    document.getElementById('openDiklatModalButton').addEventListener('click', function() {
        document.getElementById('diklatModal').classList.remove('hidden');
    });

    document.getElementById('closeDiklatModalButton').addEventListener('click', function() {
        document.getElementById('diklatModal').classList.add('hidden');
    });
</script>
