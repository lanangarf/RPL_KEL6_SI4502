<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(){
        \Log::info('Accessed Applicant Dashboard by User: ' . Auth::user()->email);
        return view('admin.dashboard');
    }
}
