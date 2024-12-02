<!-- resources/views/livewire/employee-list.blade.php -->
<div>
    <div class="row">
        <div class="col-6">
            <h2 class="content-title">Statistics</h2>
            <h5 class="content-desc mb-4">Your business growth</h5>
        </div>
        <div class="col-6 d-flex justify-content-end">
            @livewire('add-employee-modal')
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="statistics-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column justify-content-between align-items-start">
                        <h5 class="content-desc">Total Employee</h5>
                        <h3 class="statistics-value">{{ $totalEmployees }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="statistics-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column justify-content-between align-items-start">
                        <h5 class="content-desc">Active</h5>
                        <h3 class="statistics-value">205,399</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-md-6 col-lg-4">
            <div class="statistics-card">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex flex-column justify-content-between align-items-start">
                        <h5 class="content-desc">Inactive</h5>
                        <h3 class="statistics-value">142,593</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        @foreach ($employees as $employee)
            <div class="col-3">
                <div class="employee-card">
                    <img src="{{ $employee->profile_photo_path
                        ? Storage::url($employee->profile_photo_path)
                        : 'https://ui-avatars.com/api/?name=' . urlencode($employee->name) . '&color=7F9CF5&background=EBF4FF' }}"
                        alt="{{ $employee->name }}" class="employee-img rounded-full">
                    <h2 class="employee-name">{{ $employee->name }}</h2>
                    <span class="employee-role">{{ $employee->employee_number }}</span>
                    @if ($employee->verified)
                        <span class="employee-status verified">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke-width="1.5" stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12.75 11.25 15 15 9.75M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                            </svg>
                            Verified
                        </span>
                    @else
                        <a href="#" class="employee-status unverified">Verify Now</a>
                    @endif
                    <a href="{{ route('employee.show', ['employee_number' => $employee->employee_number]) }}"
                        class="employee-status">Lihat Detail</a>
                </div>
            </div>
        @endforeach
    </div>
</div>
