@foreach ($employee->spouses as $spouse)
    <div id="spouseModal{{ $spouse->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="relative z-10 bg-white rounded-lg shadow-xl max-w-3xl mx-auto p-6">
                <form action="{{ route('employee.spouse.update', [$employee->employee_number, $spouse->id]) }}"
                    method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Baris 1: Nama dan Tempat Lahir -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="name" class="block font-medium text-sm text-gray-700">Nama</label>
                            <input type="text" id="name" name="name" value="{{ old('name', $spouse->name) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('name')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="birth_place" class="block font-medium text-sm text-gray-700">Tempat
                                Lahir</label>
                            <input type="text" id="birth_place" name="birth_place"
                                value="{{ old('birth_place', $spouse->birth_place) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('birth_place')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 2: Tanggal Lahir dan Jenis Kelamin -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="birth_date" class="block font-medium text-sm text-gray-700">Tanggal
                                Lahir</label>
                            <input type="date" id="birth_date" name="birth_date"
                                value="{{ old('birth_date', $spouse->birth_date) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('birth_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="gender" class="block font-medium text-sm text-gray-700">Jenis Kelamin</label>
                            <select id="gender" name="gender"
                                class="form-select rounded-md shadow-sm mt-1 block w-full">
                                <option value="male" {{ $spouse->gender == 'male' ? 'selected' : '' }}>Laki-laki
                                </option>
                                <option value="female" {{ $spouse->gender == 'female' ? 'selected' : '' }}>Perempuan
                                </option>
                            </select>
                            @error('gender')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 3: Pendidikan dan Status Tunjangan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="education" class="block font-medium text-sm text-gray-700">Pendidikan</label>
                            <input type="text" id="education" name="education"
                                value="{{ old('education', $spouse->education) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('education')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="allowance_status" class="block font-medium text-sm text-gray-700">Status
                                Tunjangan</label>
                            <select id="allowance_status" name="allowance_status"
                                class="form-select rounded-md shadow-sm mt-1 block w-full">
                                <option value="eligible"
                                    {{ $spouse->allowance_status == 'eligible' ? 'selected' : '' }}>Berhak</option>
                                <option value="not_eligible"
                                    {{ $spouse->allowance_status == 'not_eligible' ? 'selected' : '' }}>Tidak Berhak
                                </option>
                            </select>
                            @error('allowance_status')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 4: Tanggal Pernikahan dan Keterangan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="marriage_date" class="block font-medium text-sm text-gray-700">Tanggal
                                Pernikahan</label>
                            <input type="date" id="marriage_date" name="marriage_date"
                                value="{{ old('marriage_date', $spouse->marriage_date) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('marriage_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="notes" class="block font-medium text-sm text-gray-700">Keterangan</label>
                            <textarea id="notes" name="notes" class="form-textarea rounded-md shadow-sm mt-1 block w-full">{{ old('notes', $spouse->notes) }}</textarea>
                            @error('notes')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Save</button>
                        <button type="button" data-modal-close="spouseModal{{ $spouse->id }}"
                            class="ml-3 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach

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
