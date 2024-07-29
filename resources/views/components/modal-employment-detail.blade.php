<!-- Modal -->
<div id="employmentModal" class="fixed z-10 inset-0 overflow-y-auto hidden">
    <div class="fixed inset-0 flex items-center justify-center">
        <div class="fixed inset-0 bg-gray-500 opacity-75"></div>
        <div class="relative z-10 bg-white rounded-lg shadow-xl max-w-lg mx-auto p-6">
            <form action="{{ route('employment_detail.store', $employee->employee_number) }}" method="POST">
                @csrf

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

                <div class="mb-4">
                    <label for="tahun_masuk" class="block font-medium text-sm text-gray-700">Tahun Masuk</label>
                    <input type="month" id="tahun_masuk" name="tahun_masuk"
                        value="{{ $employee->employmentDetail ? $employee->employmentDetail->tahun_masuk->format('Y') : '' }}"
                        class="form-input rounded-md shadow-sm mt-1 block w-full" />
                    @error('tahun_masuk')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="unit_id" class="block font-medium text-sm text-gray-700">Unit</label>
                    <select id="unit_id" name="unit_id" class="form-select rounded-md shadow-sm mt-1 block w-full">
                        <option value="">Select Unit</option>
                        @foreach ($units as $unit)
                            <option value="{{ $unit->id }}"
                                {{ $employee->employmentDetail && $employee->employmentDetail->unit_id == $unit->id ? 'selected' : '' }}>
                                {{ $unit->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('unit_id')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>



                <div class="mb-4">
                    <label for="status_kepegawaian" class="block font-medium text-sm text-gray-700">Status
                        Kepegawaian</label>
                    <select id="status_kepegawaian" name="status_kepegawaian"
                        class="form-select rounded-md shadow-sm mt-1 block w-full">
                        <option value="Tetap"
                            {{ $employee->employmentDetail && $employee->employmentDetail->status_kepegawaian == 'tetap' ? 'selected' : '' }}>
                            Tetap</option>
                        <option value="Tidak Tetap"
                            {{ $employee->employmentDetail && $employee->employmentDetail->status_kepegawaian == 'tidak_tetap' ? 'selected' : '' }}>
                            Tidak Tetap</option>
                    </select>
                    @error('status_kepegawaian')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="tahun_sertifikasi" class="block font-medium text-sm text-gray-700">Tahun
                        Sertifikasi</label>
                    <input type="month" id="tahun_sertifikasi" name="tahun_sertifikasi"
                        value="{{ $employee->employmentDetail ? $employee->employmentDetail->tahun_sertifikasi->format('Y') : '' }}"
                        class="form-input rounded-md shadow-sm mt-1 block w-full" />
                    @error('tahun_sertifikasi')
                        <span class="text-red-500 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <div class="flex justify-end mt-4">
                    <button type="submit"
                        class="inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:text-sm">Save</button>
                    <button type="button" id="closeModalButton"
                        class="ml-3 inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:text-sm">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- End Modal -->

<script>
    document.getElementById('openModalButton').addEventListener('click', function() {
        document.getElementById('employmentModal').classList.remove('hidden');
    });

    document.getElementById('closeModalButton').addEventListener('click', function() {
        document.getElementById('employmentModal').classList.add('hidden');
    });
</script>
