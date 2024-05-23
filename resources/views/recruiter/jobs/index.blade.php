@extends('layouts.app')

@section('content')
<div class="container">
    <h1>My Job Listings</h1>
    <a href="{{ route('recruiter.jobs.create') }}" class="btn btn-primary mb-3">Create Job</a>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <a href="{{ route('recruiter.dashboard') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Location</th>
                <th>Applicants</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jobs as $job)
            <tr>
                <td>{{ $job->title }}</td>
                <td>{{ $job->description }}</td>
                <td>{{ $job->location }}</td>
                <td><a href="{{ route('recruiter.jobs.applications', $job->id) }}">View Applicants</a></td>
                <td>{{ ucfirst($job->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
