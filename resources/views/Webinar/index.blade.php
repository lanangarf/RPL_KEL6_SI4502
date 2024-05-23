@extends('layouts.app')

@section('content')
    <h1>Webinars</h1>
    @foreach($webinars as $webinar)
        <div>
            <h2>{{ $webinar->title }}</h2>
            <p>{{ $webinar->description }}</p>
            <p>Date: {{ $webinar->start_datetime }}</p>
            <p>Host: {{ $webinar->host }}</p>
            <a href="{{ route('webinars.show', $webinar->id) }}">View Details</a>
        </div>
    @endforeach
@endsection
