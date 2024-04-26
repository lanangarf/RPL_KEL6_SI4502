@extends('layouts.app')

@section('content')
    <h1>{{ $webinar->title }}</h1>
    <p>{{ $webinar->description }}</p>
    <p>Date: {{ $webinar->start_datetime }}</p>
    <p>Host: {{ $webinar->host }}</p>
    <a href="{{ route('webinars.index') }}">Back to Webinars</a>
@endsection
