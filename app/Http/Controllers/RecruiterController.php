<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Job;
use App\Models\Event;
use App\Models\Webinar;

class RecruiterController extends Controller
{
    public function index()
    {
        $recruiterId = Auth::id();
        $user = Auth::user();
        
        $jobsCount = Job::where('recruiter_id', $recruiterId)->count();
        $eventsCount = Event::where('recruiter_id', $recruiterId)->count();
        $webinarsCount = Webinar::where('recruiter_id', $recruiterId)->count();

        $recentJobs = Job::where('recruiter_id', $recruiterId)->latest()->take(3)->get();
        $recentEvents = Event::where('recruiter_id', $recruiterId)->latest()->take(3)->get();
        $recentWebinars = Webinar::where('recruiter_id', $recruiterId)->latest()->take(3)->get();

        return view('recruiter.dashboard', compact('user', 'jobsCount', 'eventsCount', 'webinarsCount', 'recentJobs', 'recentEvents', 'recentWebinars'));
    }
}
