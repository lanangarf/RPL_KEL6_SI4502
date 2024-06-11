@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Webinars</h1>
    @if(auth()->user()->role == 'recruiter')
        <a href="{{ route('webinars.create') }}" class="btn btn-primary mb-3">Create Webinar</a>
    @endif
    @if(auth()->user()->role == 'applicant')
        <a href="{{ route('webinars.joined') }}" class="btn btn-primary mb-3">Joined Webinars</a>
    @endif
    <a href="{{ auth()->user()->role == 'recruiter' ? route('recruiter.dashboard') : route('applicant.dashboard') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>
    @foreach($webinars as $webinar)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $webinar->title }}</h5>
                <p class="card-text">{{ $webinar->description }}</p>
                <p class="card-text"><small class="text-muted">{{ $webinar->date }} at {{ $webinar->time }}</small></p>
                <a href="{{ route('webinars.show', $webinar->id) }}" class="btn btn-primary">View Details</a>
                @if(auth()->user()->role == 'applicant')
                    @if(!$webinar->applicants->contains(auth()->user()))
                        <form action="{{ route('webinars.join', $webinar->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">Join Webinar</button>
                        </form>
                    @else
                        <button type="button" class="btn btn-secondary" disabled>Already Joined</button>
                    @endif
                @endif
                @if(auth()->user()->role == 'recruiter' && auth()->user()->id == $webinar->recruiter_id)
                    <a href="{{ route('webinars.edit', $webinar->id) }}" class="btn btn-warning">Edit Webinar</a>
                    <a href="{{ route('webinars.applicants', $webinar->id) }}" class="btn btn-info">View Applicants</a>
                    <form action="{{ route('webinars.destroy', $webinar->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Close Webinar</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
