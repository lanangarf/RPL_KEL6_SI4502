<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\WebinarController;

Route::redirect('/', '/login');

// Authentication
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

Route::middleware(['auth', 'is_applicant'])->group(function () {
    // Applicant Dashboard
    Route::get('/dashboard/applicant', [ApplicantController::class, 'index'])->name('applicant.dashboard');
    Route::get('applicant/events', [EventController::class, 'index'])->name('applicant.events.index');
    Route::get('applicant/events/{event}/join', [EventController::class, 'join'])->name('applicant.events.join');
    Route::get('applicant/events/{event}/certificate', [EventController::class, 'generateCertificate'])->name('applicant.events.certificate');
  
// Applicant
Route::middleware(['auth', 'role:applicant'])->group(function () {
    Route::get('/applicant/dashboard', function () {
        return view('applicant.applicant_dashboard');
    });

    Route::get('/webinars', [WebinarController::class, 'index'])->name('webinars.index');
    Route::get('/webinars/{id}', [WebinarController::class, 'show'])->name('webinars.show');   

});
Route::middleware(['auth', 'is_admin'])->group(function () {
    // Admin Dashboard
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'is_recruiter'])->group(function () {
    // Recruiter Dashboard
    Route::get('/dashboard/recruiter', [RecruiterController::class, 'index'])->name('recruiter.dashboard');
    Route::get('recruiter/events/create', [EventController::class, 'create'])->name('recruiter.events.create');
    Route::post('recruiter/events', [EventController::class, 'store'])->name('recruiter.events.store');
    Route::get('recruiter/events', [EventController::class, 'index'])->name('recruiter.events.index');
});
