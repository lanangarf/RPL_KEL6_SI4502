<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Applicantion;

class JobController extends Controller
{
        public function index()
    {
        $jobs = Job::where('recruiter_id', Auth::id())->get();
        return view('recruiter.jobs.index', compact('jobs'));
    }

    public function create()
    {
        return view('recruiter.jobs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'location' => 'required|string',
        ]);

        Job::create([
            'recruiter_id' => '12',
            'title' => $request->title,
            'description' => $request->description,
            'location' => $request->location,
        ]);

        return redirect()->route('recruiter.jobs.index')->with('success', 'Job created successfully.');
    }

    public function availableJobs()
    {
        $jobs = Job::where('status', 'open')->get();
        return view('applicant.jobs.index', compact('jobs'));
    }
}
