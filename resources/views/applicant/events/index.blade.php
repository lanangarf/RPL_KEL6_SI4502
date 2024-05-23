@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Available Events</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('applicant.dashboard') }}" class="btn btn-secondary" style="margin-top: 20px;">Back to Dashboard</a>

    <ul>
        @foreach ($events as $event)
            <li>
                <h3>{{ $event->title }}</h3>
                <p>{{ $event->description }}</p>
                <a href="{{ route('applicant.events.join', $event->id) }}" class="btn btn-primary">Join Event</a>
                @if($event->applicants()->find(Auth::id()))
                    <a href="{{ route('applicant.events.certificate', $event->id) }}" class="btn btn-success">Download E-Certificate</a>
                @endif
            </li>
        @endforeach
    </ul>
</div>
@endsection
