<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\EmployeeCertificationController;
use App\Http\Controllers\EmployeeChildrenController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeEducationController;
use App\Http\Controllers\EmployeeSpouseController;
use App\Http\Controllers\EmploymentDetailController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\MeetingController;
use App\Http\Controllers\TaskController;
use App\Livewire\EmployeeDashboards;
use App\Livewire\LeaveForm;
use App\Livewire\LeaveList;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('template.homepage');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    // Route::get('/dashboard', function () {
    //     return view('template.dashboard');
    // })->name('dashboard');
    Route::get('/dashboard', EmployeeDashboards::class)->name('dashboard');
    Route::get('/employees', function () {
        return view('employees.index');
    })->name('employees');

    //Route Task Kanban
    Route::resource('tasks', TaskController::class);
    Route::resource('assignments', AssignmentController::class);
    // Route::post('/update-task-order', [TaskController::class, 'updateOrder']);
    Route::post('/update-task-order', [TaskController::class, 'updateTaskOrder']);
    Route::post('/update-task-inline', [TaskController::class, 'updateTaskInline']);

    // Route untuk menampilkan detail karyawan
    Route::get('/employees/{employee_number}', [EmployeeController::class, 'show'])->name('employee.show');

    // Route Employee Detail
    Route::post('/employees/{employee_number}/employment-details', [EmploymentDetailController::class, 'storeOrUpdate'])->name('employment_detail.store');
    //Route Certificate
    Route::post('/employees/{employee_number}/employee-certificates', [EmployeeCertificationController::class, 'store'])->name('employee_certification.store');
    Route::put('/employees/{employee_number}/employee-certificates/{certificate}', [EmployeeCertificationController::class, 'update'])->name('employee_certification.update');
    // Route Education
    Route::post('/employees/{employee_number}/education-histories', [EmployeeEducationController::class, 'store'])->name('education_history.store');
    Route::put('/employees/{employee_number}/education-histories/{id}', [EmployeeEducationController::class, 'update'])->name('education_history.update');

    // Route Spouse
    Route::post('/employees/{employee_number}/employee-spouse', [EmployeeSpouseController::class, 'store'])->name('employee.spouse.store');
    Route::put('/employees/{employee_number}/employee-spouse/{id}', [EmployeeSpouseController::class, 'update'])->name('employee.spouse.update');

    // Route Children
    Route::post('/employees/{employee_number}/employee-children', [EmployeeChildrenController::class, 'store'])->name('employee.children.store');
    Route::put('/employees/{employee_number}/employee-children/{id}', [EmployeeChildrenController::class, 'update'])->name('employee.children.update');

    //Route Leave (Izin)
    Route::resource('leaves', LeaveController::class);
    // Route::get('/leaves/create', LeaveForm::class)->name('leave.create');
    Route::resource('meetings', MeetingController::class);
});
