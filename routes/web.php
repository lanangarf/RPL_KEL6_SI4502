<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\WebinarController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\InterviewController;

Route::redirect('/', '/login');

// Authentication
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');

// Recruiter
Route::middleware(['auth', 'role:recruiter'])->group(function () {
    Route::get('/recruiter/dashboard', function () {
        return view('recruiter.recruiter_dashboard');
    });
    Route::get('/dashboard/recruiter', [RecruiterController::class, 'index'])->name('recruiter.dashboard');
    Route::get('recruiter/jobs', [JobController::class, 'index'])->name('recruiter.jobs.index');
    Route::post('recruiter/jobs', [JobController::class, 'store'])->name('recruiter.jobs.store');
});


Route::middleware(['auth', 'is_applicant'])->group(function () {
    // Applicant Dashboard
    Route::get('/dashboard/applicant', [ApplicantController::class, 'index'])->name('applicant.dashboard');
    Route::get('applicant/events', [EventController::class, 'index'])->name('applicant.events.index');
    Route::get('applicant/events/{event}/join', [EventController::class, 'join'])->name('applicant.events.join');
    Route::get('applicant/events/{event}/certificate', [EventController::class, 'generateCertificate'])->name('applicant.events.certificate');
    Route::get('applicant/jobs', [JobController::class, 'availableJobs'])->name('applicant.jobs.index');
    Route::post('applicant/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applicant.jobs.apply');
    Route::get('/dashboard/applicant', [ApplicantController::class, 'index'])->name('applicant.dashboard');
    Route::get('applicant/applications/active', [ApplicationController::class, 'activeApplications'])->name('applicant.applications.active');
    Route::get('applicant/applications/{application}/schedule-interview', [ApplicationController::class, 'scheduleInterview'])->name('applicant.schedule.interview');
    Route::post('applications/{application}/interviews/schedule', [InterviewController::class, 'schedule'])->name('interview.schedule');
});

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


// Auth
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');


Route::middleware(['auth', 'is_recruiter'])->group(function () {
    // Recruiter Dashboard
    Route::get('/dashboard/recruiter', [RecruiterController::class, 'index'])->name('recruiter.dashboard');
    Route::post('recruiter/events', [EventController::class, 'store'])->name('recruiter.events.store');
    Route::get('recruiter/events', [EventController::class, 'index'])->name('recruiter.events.index');
});

Route::get('recruiter/jobs/create', [JobController::class, 'create'])->name('recruiter.jobs.create');
Route::get('recruiter/events/create', [EventController::class, 'create'])->name('recruiter.events.create');