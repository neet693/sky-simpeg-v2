<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmploymentDetailController;
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
    Route::get('/dashboard', function () {
        return view('template.dashboard');
    })->name('dashboard');
    Route::get('/employees', function () {
        return view('employees.index');
    })->name('employees');
    // Route untuk menampilkan detail karyawan
    Route::get('/employees/{employee_number}', [EmployeeController::class, 'show'])->name('employee.show');

    // Route untuk menyimpan atau memperbarui detail pekerjaan
    Route::post('/employees/{employee_number}/employment-details', [EmploymentDetailController::class, 'storeOrUpdate'])->name('employment_detail.store');
});
