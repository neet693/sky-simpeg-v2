<!-- Modal Add Spouse -->
<div id="spouseModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="fixed inset-0 flex items-center justify-center">
        <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
        <div class="relative z-10 bg-white rounded-lg shadow-xl max-w-lg mx-auto p-6">
            <form action="{{ route('employee.spouse.store', $employee->employee_number) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col">
                        <!-- Field for Name -->
                        <div class="mb-4">
                            <label for="name" class="block font-medium text-sm text-gray-700">Nama</label>
                            <input type="text" id="name" name="name"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" required />
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Field for Birth Place -->
                        <div class="mb-4">
                            <label for="birth_place" class="block font-medium text-sm text-gray-700">Tempat
                                Lahir</label>
                            <input type="text" id="birth_place" name="birth_place"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" required />
                            @error('birth_place')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Field for Birth Date -->
                        <div class="mb-4">
                            <label for="birth_date" class="block font-medium text-sm text-gray-700">Tanggal
                                Lahir</label>
                            <input type="date" id="birth_date" name="birth_date"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" required />
                            @error('birth_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Field for Gender -->
                        <div class="mb-4">
                            <label for="gender" class="block font-medium text-sm text-gray-700">Jenis Kelamin</label>
                            <select id="gender" name="gender"
                                class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="male">Laki-laki</option>
                                <option value="female">Perempuan</option>
                            </select>
                            @error('gender')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <!-- Field for Education -->
                        <div class="mb-4">
                            <label for="education" class="block font-medium text-sm text-gray-700">Pendidikan</label>
                            <input type="text" id="education" name="education"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" required />
                            @error('education')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Field for Allowance Status -->
                        <div class="mb-4">
                            <label for="allowance_status" class="block font-medium text-sm text-gray-700">Status
                                Tunjangan</label>
                            <select id="allowance_status" name="allowance_status"
                                class="form-select rounded-md shadow-sm mt-1 block w-full" required>
                                <option value="eligible">Berhak</option>
                                <option value="not_eligible">Tidak Berhak</option>
                            </select>
                            @error('allowance_status')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Field for Marriage Date -->
                        <div class="mb-4">
                            <label for="marriage_date" class="block font-medium text-sm text-gray-700">Tanggal
                                Pernikahan</label>
                            <input type="date" id="marriage_date" name="marriage_date"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" required />
                            @error('marriage_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Field for Notes -->
                        <div class="mb-4">
                            <label for="notes" class="block font-medium text-sm text-gray-700">Keterangan</label>
                            <textarea id="notes" name="notes" class="form-input rounded-md shadow-sm mt-1 block w-full" rows="3"></textarea>
                            @error('notes')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit"
                        class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Save</button>
                    <button type="button" id="closeSpouseModalButton"
                        class="ml-3 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.getElementById('openSpouseModalButton').addEventListener('click', function() {
        document.getElementById('spouseModal').classList.remove('hidden');
    });

    document.getElementById('closeSpouseModalButton').addEventListener('click', function() {
        document.getElementById('spouseModal').classList.add('hidden');
    });
</script>
