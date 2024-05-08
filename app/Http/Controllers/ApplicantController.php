<?php

use Illuminate\Http\Request;
namespace App\Http\Controllers;

class ApplicantController extends Controller
{
    public function index(){
        return view('applicant.dashboard');
    }
}



