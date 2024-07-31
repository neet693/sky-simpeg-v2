<!-- Modal Tambah Riwayat Pendidikan -->
<div id="educationModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="fixed inset-0 flex items-center justify-center">
        <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
        <div class="relative z-10 bg-white rounded-lg shadow-xl max-w-lg mx-auto p-6">
            <form id="educationForm" action="{{ route('education_history.store', $employee->employee_number) }}"
                method="POST">
                @csrf
                <div class="mb-4">
                    <label for="institution" class="block font-medium text-sm text-gray-700">Institusi</label>
                    <input type="text" id="institution" name="institution"
                        class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('institution') }}" />
                    @error('institution')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="degree" class="block font-medium text-sm text-gray-700">Gelar</label>
                    <input type="text" id="degree" name="degree"
                        class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('degree') }}" />
                    @error('degree')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="start_date" class="block font-medium text-sm text-gray-700">Tanggal Mulai</label>
                    <input type="month" id="start_date" name="start_date"
                        class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('start_date') }}" />
                    @error('start_date')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="end_date" class="block font-medium text-sm text-gray-700">Tanggal Selesai</label>
                    <input type="month" id="end_date" name="end_date"
                        class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('end_date') }}" />
                    @error('end_date')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="field_of_study" class="block font-medium text-sm text-gray-700">Bidang Studi</label>
                    <input type="text" id="field_of_study" name="field_of_study"
                        class="form-input rounded-md shadow-sm mt-1 block w-full" value="{{ old('field_of_study') }}" />
                    @error('field_of_study')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-4">
                    <label for="description" class="block font-medium text-sm text-gray-700">Deskripsi</label>
                    <textarea id="description" name="description" class="form-input rounded-md shadow-sm mt-1 block w-full">{{ old('description') }}</textarea>
                    @error('description')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>
                <div class="flex justify-end mt-4">
                    <button type="submit"
                        class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Save</button>
                    <button type="button" id="closeEducationModalButton"
                        class="ml-3 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

<script>
    document.getElementById('openEducationModalButton').addEventListener('click', function() {
        document.getElementById('educationModal').classList.remove('hidden');
    });

    document.getElementById('closeEducationModalButton').addEventListener('click', function() {
        document.getElementById('educationModal').classList.add('hidden');
    });
</script>
