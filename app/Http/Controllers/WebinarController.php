<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Webinar;
use Illuminate\Support\Facades\Auth;

class WebinarController extends Controller
{
    public function index()
    {
        $webinars = Webinar::all();
        return view('webinars.index', compact('webinars'));
    }

    public function create()
    {
        return view('webinars.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        Webinar::create([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'time' => $request->time,
            'recruiter_id' => Auth::id()
        ]);

        return redirect()->route('webinars.index')->with('success', 'Webinar created successfully!');
    }

    public function show($id)
    {
        $webinar = Webinar::findOrFail($id);
        return view('webinars.show', compact('webinar'));
    }

    public function join($id)
    {
        $webinar = Webinar::findOrFail($id);
        $webinar->applicants()->attach(Auth::id());

        return redirect()->route('webinars.index')->with('success', 'You have successfully joined the webinar!');
    }

    public function destroy($id)
    {
        $webinar = Webinar::findOrFail($id);
        if ($webinar->recruiter_id == Auth::id()) {
            $webinar->delete();
            return redirect()->route('webinars.index')->with('success', 'Webinar closed and deleted successfully!');
        }

        return redirect()->route('webinars.index')->with('error', 'You are not authorized to delete this webinar.');
    }

    public function edit($id)
    {
        $webinar = Webinar::findOrFail($id);
        if ($webinar->recruiter_id == Auth::id()) {
            return view('webinars.edit', compact('webinar'));
        }

        return redirect()->route('webinars.index')->with('error', 'You are not authorized to edit this webinar.');
    }

    public function update(Request $request, $id)
    {
        $webinar = Webinar::findOrFail($id);

        if ($webinar->recruiter_id != Auth::id()) {
            return redirect()->route('webinars.index')->with('error', 'You are not authorized to edit this webinar.');
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
        ]);

        $webinar->update([
            'title' => $request->title,
            'description' => $request->description,
            'date' => $request->date,
            'time' => $request->time,
        ]);

        return redirect()->route('webinars.index')->with('success', 'Webinar updated successfully!');
    }

    public function joinedWebinars()
    {
        $webinars = Auth::user()->joinedWebinars ?? collect();
        return view('webinars.joined', compact('webinars'));
    }

    public function applicants($id)
    {
        $webinar = Webinar::findOrFail($id);
        if ($webinar->recruiter_id != Auth::id()) {
            return redirect()->route('webinars.index')->with('error', 'You are not authorized to view this webinar.');
        }

        $applicants = $webinar->applicants;
        return view('webinars.applicants', compact('webinar', 'applicants'));
    }

    public function removeApplicant($webinarId, $applicantId)
    {
        $webinar = Webinar::findOrFail($webinarId);
        if ($webinar->recruiter_id != Auth::id()) {
            return redirect()->route('webinars.index')->with('error', 'You are not authorized to perform this action.');
        }

        $webinar->applicants()->detach($applicantId);
        return redirect()->route('webinars.applicants', $webinarId)->with('success', 'Applicant removed successfully.');
    }
}
