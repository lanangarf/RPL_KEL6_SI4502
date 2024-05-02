<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

Route::redirect('/', '/login');

// Authentication
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->group(function () {
    // Applicant Dashboard
    Route::get('/dashboard/applicant', [ApplicantController::class, 'index'])->name('applicant.dashboard')->middleware('is_applicant');

    // Admin Dashboard
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.dashboard')->middleware('is_admin');

    // Recruiter Dashboard
    Route::get('/dashboard/recruiter', [RecruiterController::class, 'index'])->name('recruiter.dashboard')->middleware('is_recruiter');
});
