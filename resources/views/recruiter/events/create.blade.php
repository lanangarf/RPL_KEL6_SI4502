@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Create Event</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <a href="{{ route('recruiter.dashboard') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>
    <form action="{{ route('recruiter.events.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Event Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="description">Event Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Event</button>
    </form>
</div>
@endsection
