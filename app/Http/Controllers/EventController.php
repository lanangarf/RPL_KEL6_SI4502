<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view('applicant.events.index', compact('events'));
    }

    public function create()
    {
        return view('recruiter.events.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Event::create([
            'title' => $request->title,
            'description' => $request->description,
            'recruiter_id' => Auth::id(),
        ]);

        return redirect()->route('recruiter.events.index')
            ->with('success', 'Event created successfully.');
    }

    public function join(Event $event)
    {
        $event->applicants()->attach(Auth::id());
        return redirect()->route('applicant.events.index')
            ->with('success', 'You have joined the event.');
    }

    public function generateCertificate(Event $event)
    {
        $applicant = Auth::user();
        return response()->download($certificatePath);
    }

}
