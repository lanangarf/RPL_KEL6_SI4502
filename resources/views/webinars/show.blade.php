@extends('layouts.app')

@section('content')
<div class="container">
    <h1>{{ $webinar->title }}</h1>
    <p>{{ $webinar->description }}</p>
    <p>{{ $webinar->date }} at {{ $webinar->time }}</p>
</div>
@endsection
