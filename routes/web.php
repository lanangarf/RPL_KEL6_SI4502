<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\RecruiterController;
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
    Route::post('/webinars/{id}/join', [WebinarController::class, 'join'])->name('webinars.join');
    Route::get('/webinars/joined', [WebinarController::class, 'joinedWebinars'])->name('webinars.joined');
    Route::get('applicant/events', [EventController::class, 'index'])->name('applicant.events.index');
    Route::get('applicant/events/{event}/join', [EventController::class, 'join'])->name('applicant.events.join');
    Route::get('applicant/events/{event}/certificate', [EventController::class, 'downloadCertificate'])->name('applicant.events.certificate');
    Route::get('applicant/jobs', [JobController::class, 'availableJobs'])->name('applicant.jobs.index');
    Route::post('applicant/jobs/{job}/apply', [ApplicationController::class, 'store'])->name('applicant.jobs.apply');
    Route::get('applicant/applications/active', [ApplicationController::class, 'activeApplications'])->name('applicant.applications.active');
    Route::get('applicant/applications/{application}/schedule-interview', [ApplicationController::class, 'scheduleInterview'])->name('applicant.schedule.interview');
    Route::post('applications/{application}/interviews/schedule', [InterviewController::class, 'schedule'])->name('interview.schedule');
});

Route::middleware(['auth', 'is_admin'])->group(function () {
    // Admin Dashboard
    Route::get('/dashboard/admin', [AdminController::class, 'index'])->name('admin.dashboard');
});

Route::middleware(['auth', 'is_recruiter'])->group(function () {
    // Recruiter Dashboard
    Route::get('/dashboard/recruiter', [RecruiterController::class, 'index'])->name('recruiter.dashboard');
    Route::get('/webinars/create', [WebinarController::class, 'create'])->name('webinars.create');
    Route::post('/webinars', [WebinarController::class, 'store'])->name('webinars.store');
    Route::get('/webinars/{id}/edit', [WebinarController::class, 'edit'])->name('webinars.edit');
    Route::put('/webinars/{id}', [WebinarController::class, 'update'])->name('webinars.update');
    Route::delete('/webinars/{id}', [WebinarController::class, 'destroy'])->name('webinars.destroy');
    Route::get('/webinars/{id}/applicants', [WebinarController::class, 'applicants'])->name('webinars.applicants');
    Route::delete('/webinars/{webinarId}/applicants/{applicantId}', [WebinarController::class, 'removeApplicant'])->name('webinars.removeApplicant');
    Route::get('recruiter/events/create', [EventController::class, 'create'])->name('recruiter.events.create');
    Route::post('recruiter/events', [EventController::class, 'store'])->name('recruiter.events.store');
    Route::get('recruiter/events', [EventController::class, 'index'])->name('recruiter.events.index');
    Route::get('recruiter/jobs', [JobController::class, 'index'])->name('recruiter.jobs.index');
    Route::get('recruiter/jobs/create', [JobController::class, 'create'])->name('recruiter.jobs.create');
    Route::post('recruiter/jobs', [JobController::class, 'store'])->name('recruiter.jobs.store');
    Route::get('recruiter/jobs/{job}/applications', [ApplicationController::class, 'index'])->name('recruiter.jobs.applications');
    Route::post('applications/{application}/status', [ApplicationController::class, 'updateStatus'])->name('applications.status.update');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/webinars', [WebinarController::class, 'index'])->name('webinars.index');
    Route::get('/webinars/{id}', [WebinarController::class, 'show'])->name('webinars.show');
});
