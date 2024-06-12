@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Applicants for {{ $webinar->title }}</h1>
    <a href="{{ route('webinars.index') }}" class="btn btn-secondary mb-3">Back</a>
    @foreach($applicants as $applicant)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $applicant->name }}</h5>
                <p class="card-text">{{ $applicant->email }}</p>
                <form action="{{ route('webinars.removeApplicant', [$webinar->id, $applicant->id]) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Remove Applicant</button>
                </form>
            </div>
        </div>
    @endforeach
</div>
@endsection
