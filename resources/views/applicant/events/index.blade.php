@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Available Events</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <ul>
        @foreach ($events as $event)
            <li>
                <h3>{{ $event->title }}</h3>
                <p>{{ $event->description }}</p>
                <a href="{{ route('applicant.events.join', $event->id) }}" class="btn btn-primary">Join Event</a>
            </li>
        @endforeach
    </ul>
</div>
@endsection
