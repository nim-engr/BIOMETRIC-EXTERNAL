<?php

use Illuminate\Support\Facades\Route;
use App\Models\Employee;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\BiometricController;
use App\Http\Controllers\DtrController;

// Dashboard (first to last employee)
Route::get('/', function () {
    $employees = Employee::orderBy('id', 'asc')->paginate(10);
    return view('dashboard', compact('employees'));
})->name('dashboard');

// Employee CRUD
Route::prefix('employees')->name('employee.')->group(function () {
    Route::get('/', [EmployeeController::class, 'index'])->name('index');
    Route::get('/create', [EmployeeController::class, 'create'])->name('create');
    Route::post('/', [EmployeeController::class, 'store'])->name('store');
    Route::get('/{employee}/edit', [EmployeeController::class, 'edit'])->name('edit');
    Route::put('/{employee}', [EmployeeController::class, 'update'])->name('update');
    Route::delete('/{employee}', [EmployeeController::class, 'destroy'])->name('destroy');
});

// Biometric Upload
Route::get('/upload-biometric', [BiometricController::class, 'index'])->name('biometric.upload');
Route::post('/upload-biometric', [BiometricController::class, 'store'])->name('biometric.store');

// DTR Module
Route::get('/generate-dtr', [DtrController::class, 'index'])->name('dtr.generate');
