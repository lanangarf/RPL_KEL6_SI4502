<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApplicantController;
use App\Http\Controllers\RecruiterController;
use App\Http\Controllers\ProfileController;

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

    // Profile for Recruiter
    Route::get('/profile', [ProfileController::class, 'index'])->name('recruiter.profile')->middleware('is_recruiter');
    Route::get('/detailProfile', [ProfileController::class, 'detailProfile'])->name('recruiter.detailProfile')->middleware('is_recruiter');
    Route::put('/updateProfile', [ProfileController::class, 'updateProfile'])->name('updateProfile')->middleware('is_recruiter');
    // Profile for Applicant
    Route::get('/applicant/profile', [ProfileController::class, 'applicantProfile'])->name('applicant.profile')->middleware('is_applicant');
    Route::get('/applicant/detailProfile', [ProfileController::class, 'applicantDetailProfile'])->name('applicant.detailProfile')->middleware('is_applicant');
    Route::put('/applicant/updateProfile', [ProfileController::class, 'updateApplicantProfile'])->name('applicant.updateProfile')->middleware('is_applicant');
    Route::get('/applicant/educationProfile', [ProfileController::class, 'educationProfile'])->name('applicant.educationProfile')->middleware('is_applicant');
    Route::post('/applicant/storeEducation', [ProfileController::class, 'storeEducation'])->name('applicant.storeEducation')->middleware('is_applicant');
    Route::get('/applicant/editEducation/{id}', [ProfileController::class, 'editEducation'])->name('applicant.editEducation')->middleware('is_applicant');
    Route::put('/applicant/updateEducation/{id}', [ProfileController::class, 'updateEducation'])->name('applicant.updateEducation')->middleware('is_applicant');
    Route::delete('/applicant/deleteEducation/{id}', [ProfileController::class, 'deleteEducation'])->name('applicant.deleteEducation')->middleware('is_applicant');
    Route::get('/applicant/experience', [ProfileController::class, 'experienceProfile'])->name('applicant.experienceProfile');
    Route::post('/applicant/experience', [ProfileController::class, 'storeExperience'])->name('applicant.storeExperience');
    Route::get('/applicant/experience/{id}/edit', [ProfileController::class, 'editExperience'])->name('applicant.editExperience');
    Route::put('/applicant/experience/{id}', [ProfileController::class, 'updateExperience'])->name('applicant.updateExperience');
    Route::delete('/applicant/experience/{id}', [ProfileController::class, 'deleteExperience'])->name('applicant.deleteExperience');

});
