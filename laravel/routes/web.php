<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken;

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\MedicalRecordController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\PatientController;
use App\Http\Controllers\PrescriptionController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\TreatmentController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\MedicationController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/api/test', [TestController::class, 'index']);
Route::get('/api/test/{id}', [TestController::class, 'show']);
Route::post('/api/test', [TestController::class, 'store'])->withoutMiddleware([VerifyCsrfToken::class]);


Route::resource('appointments', AppointmentController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('doctors', DoctorController::class);
Route::resource('medical_records', MedicalRecordController::class);
Route::resource('patients', PatientController::class);
Route::resource('roles', RoleController::class);
Route::resource('prescriptions', PrescriptionController::class);
Route::resource('staff', StaffController::class);
Route::resource('treatments', TreatmentController::class);
Route::resource('users', UserController::class);
Route::resource('medications', MedicationController::class);
