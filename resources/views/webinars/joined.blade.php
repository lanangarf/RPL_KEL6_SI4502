@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Joined Webinars</h1>
    <a href="{{ route('webinars.index') }}" class="btn btn-secondary mb-3">Back</a>
    @if($webinars->isEmpty())
        <p>You have not joined any webinars.</p>
    @else
        @foreach($webinars as $webinar)
            <div class="card mb-3">
                <div class="card-body">
                    <h5 class="card-title">{{ $webinar->title }}</h5>
                    <p class="card-text">{{ $webinar->description }}</p>
                    <p class="card-text"><small class="text-muted">{{ $webinar->date }} at {{ $webinar->time }}</small></p>
                    <a href="{{ route('webinars.show', $webinar->id) }}" class="btn btn-primary">View Details</a>
                </div>
            </div>
        @endforeach
    @endif
</div>
@endsection
