@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Applicants for "{{ $job->title }}"</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    
    <table class="table">
        <thead>
            <tr>
                <th>Applicant</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <a href="{{ route('recruiter.jobs.index') }}" class="btn btn-secondary mb-3">Back</a>
        <tbody>
            @foreach($applications as $application)
            <tr>
                <td>{{ optional($application->applicant)->name ?? 'Applicant does not exist' }}</td>
                <td>{{ ucfirst($application->status) }}</td>
                <td>
                    <form action="{{ route('applications.status.update', $application->id) }}" method="POST">
                        @csrf
                        <select name="status" onchange="this.form.submit()">
                            <option value="pending" {{ $application->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="accepted" {{ $application->status == 'accepted' ? 'selected' : '' }}>Accepted</option>
                            <option value="rejected" {{ $application->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
