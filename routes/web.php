<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\InterviewController;
use App\Http\Controllers\ApplicantController;

Route::redirect('/', '/login');

// Recruiter
Route::middleware(['auth', 'role:recruiter'])->group(function () {
    Route::get('/recruiter/dashboard', function () {
        return view('recruiter.recruiter_dashboard');
    });
    Route::get('/dashboard/recruiter', [RecruiterController::class, 'index'])->name('recruiter.dashboard');
    Route::get('recruiter/jobs', [JobController::class, 'index'])->name('recruiter.jobs.index');
    Route::get('recruiter/jobs/create', [JobController::class, 'create'])->name('recruiter.jobs.create');
    Route::post('recruiter/jobs', [JobController::class, 'store'])->name('recruiter.jobs.store');
});

// Applicant
Route::middleware(['auth', 'role:applicant'])->group(function () {
    Route::get('/applicant/dashboard', function () {
        return view('applicant.applicant_dashboard');
    });
    Route::get('applicant/jobs', [JobController::class, 'availableJobs'])->name('applicant.jobs.index');
    Route::post('applicant/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applicant.jobs.apply');
    Route::get('/dashboard/applicant', [ApplicantController::class, 'index'])->name('applicant.dashboard');
    Route::get('applicant/applications/active', [ApplicationController::class, 'activeApplications'])->name('applicant.applications.active');
    Route::get('applicant/applications/{application}/schedule-interview', [ApplicationController::class, 'scheduleInterview'])->name('applicant.schedule.interview');
    Route::post('applications/{application}/interviews/schedule', [InterviewController::class, 'schedule'])->name('interview.schedule');
});

// Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.admin_dashboard');
    });
});

// Auth
Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');
