@foreach ($employee->educationHistories as $education)
    <div id="diklatModal{{ $education->id }}" class="fixed z-10 inset-0 overflow-y-auto hidden">
        <div class="fixed inset-0 flex items-center justify-center">
            <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
            <div class="relative z-10 bg-white rounded-lg shadow-xl max-w-3xl mx-auto p-6">
                <form action="{{ route('education_history.update', [$employee->employee_number, $education->id]) }}"
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
                            <label for="institution" class="block font-medium text-sm text-gray-700">Nama
                                Institusi</label>
                            <input type="text" id="institution" name="institution"
                                value="{{ old('institution', $education->institution) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('institution')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 2: Gelar dan Jurusan -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="degree" class="block font-medium text-sm text-gray-700">Gelar</label>
                            <input type="text" id="degree" name="degree"
                                value="{{ old('degree', $education->degree) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('degree')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="field" class="block font-medium text-sm text-gray-700">Jurusan</label>
                            <input type="text" id="field" name="field"
                                value="{{ old('field', $education->field) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('field')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 2: Masuk dan Lulus -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                        <div>
                            <label for="start_date" class="block font-medium text-sm text-gray-700">Masuk Pada</label>
                            <input type="month" id="start_date" name="start_date"
                                value="{{ old('start_date', $education->start_date->format('Y-m')) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('start_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label for="end_date" class="block font-medium text-sm text-gray-700">Lulus Pada</label>
                            <input type="month" id="end_date" name="end_date"
                                value="{{ old('end_date', $education->end_date->format('Y-m')) }}"
                                class="form-input rounded-md shadow-sm mt-1 block w-full" />
                            @error('end_date')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Baris 3: Description -->
                    <div class="grid grid-cols-1 md:grid-cols-1 gap-4 mb-4">
                        <div>
                            <label for="description" class="block font-medium text-sm text-gray-700">Deskripsi</label>
                            <textarea id="description" name="description" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('description', $education->description) }}</textarea>
                            @error('description')
                                <span class="text-red-500 text-sm">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="flex justify-end mt-4">
                        <button type="submit"
                            class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Save</button>
                        <button type="button" data-modal-close="diklatModal{{ $education->id }}"
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
