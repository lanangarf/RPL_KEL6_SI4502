<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebinarController;
Route::redirect('/', '/login');

// Recruiter
Route::middleware(['auth', 'role:recruiter'])->group(function () {
    Route::get('/recruiter/dashboard', function () {
        return view('recruiter.recruiter_dashboard');
    });
});

// Applicant
Route::middleware(['auth', 'role:applicant'])->group(function () {
    Route::get('/applicant/dashboard', function () {
        return view('applicant.applicant_dashboard');
    });

    Route::get('/webinars', [WebinarController::class, 'index'])->name('webinars.index');
    Route::get('/webinars/{id}', [WebinarController::class, 'show'])->name('webinars.show');   
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