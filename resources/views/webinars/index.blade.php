@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Webinars</h1>
    @if(auth()->user()->role == 'recruiter')
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createWebinarModal">
            Create Webinar
        </button>
    @endif
    @if(auth()->user()->role == 'applicant')
        <a href="{{ route('webinars.joined') }}" class="btn btn-primary mb-3">Joined Webinars</a>
    @endif
    <a href="{{ auth()->user()->role == 'recruiter' ? route('recruiter.dashboard') : route('applicant.dashboard') }}" class="btn btn-secondary mb-3">Back to Dashboard</a>
    @foreach($webinars as $webinar)
        <div class="card mb-3">
            <div class="card-body">
                <h5 class="card-title">{{ $webinar->title }}</h5>
                <p class="card-text">{{ $webinar->description }}</p>
                <p class="card-text"><small class="text-muted">{{ $webinar->date }} at {{ $webinar->time }}</small></p>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#webinarDetailsModal" data-title="{{ $webinar->title }}" data-description="{{ $webinar->description }}" data-date="{{ $webinar->date }}" data-time="{{ $webinar->time }}">View Details</button>
                @if(auth()->user()->role == 'applicant')
                    @if(!$webinar->applicants->contains(auth()->user()))
                        <form action="{{ route('webinars.join', $webinar->id) }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="btn btn-success">Join Webinar</button>
                        </form>
                    @else
                        <button type="button" class="btn btn-secondary" disabled>Already Joined</button>
                    @endif
                @endif
                @if(auth()->user()->role == 'recruiter' && auth()->user()->id == $webinar->recruiter_id)
                    <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editWebinarModal" data-id="{{ $webinar->id }}" data-title="{{ $webinar->title }}" data-description="{{ $webinar->description }}" data-date="{{ $webinar->date }}" data-time="{{ $webinar->time }}">Edit Webinar</button>
                    <a href="{{ route('webinars.applicants', $webinar->id) }}" class="btn btn-info">View Applicants</a>
                    <form action="{{ route('webinars.destroy', $webinar->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Close Webinar</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>

<!-- Create Webinar Modal -->
<div class="modal fade" id="createWebinarModal" tabindex="-1" aria-labelledby="createWebinarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createWebinarModalLabel">Create Webinar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('webinars.store') }}" method="POST">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="title">Webinar Title</label>
                        <input type="text" class="form-control" id="title" name="title" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="description">Webinar Description</label>
                        <textarea class="form-control" id="description" name="description" required></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="date">Webinar Date</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="time">Webinar Time</label>
                        <input type="time" class="form-control" id="time" name="time" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Create Webinar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- View Webinar Details Modal -->
<div class="modal fade" id="webinarDetailsModal" tabindex="-1" aria-labelledby="webinarDetailsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="webinarDetailsModalLabel">Webinar Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h5 id="webinarTitle"></h5>
                <p id="webinarDescription"></p>
                <p><strong>Date:</strong> <span id="webinarDate"></span></p>
                <p><strong>Time:</strong> <span id="webinarTime"></span></p>
            </div>
        </div>
    </div>
</div>

<!-- Edit Webinar Modal -->
<div class="modal fade" id="editWebinarModal" tabindex="-1" aria-labelledby="editWebinarModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editWebinarModalLabel">Edit Webinar</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form id="editWebinarForm" action="" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group mb-3">
                        <label for="editTitle">Webinar Title</label>
                        <input type="text" class="form-control" id="editTitle" name="title" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="editDescription">Webinar Description</label>
                        <textarea class="form-control" id="editDescription" name="description" required></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="editDate">Webinar Date</label>
                        <input type="date" class="form-control" id="editDate" name="date" required>
                    </div>

                    <div class="form-group mb-3">
                        <label for="editTime">Webinar Time</label>
                        <input type="time" class="form-control" id="editTime" name="time" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Update Webinar</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const webinarDetailsModal = document.getElementById('webinarDetailsModal');
        webinarDetailsModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const title = button.getAttribute('data-title');
            const description = button.getAttribute('data-description');
            const date = button.getAttribute('data-date');
            const time = button.getAttribute('data-time');

            const modalTitle = webinarDetailsModal.querySelector('#webinarTitle');
            const modalDescription = webinarDetailsModal.querySelector('#webinarDescription');
            const modalDate = webinarDetailsModal.querySelector('#webinarDate');
            const modalTime = webinarDetailsModal.querySelector('#webinarTime');

            modalTitle.textContent = title;
            modalDescription.textContent = description;
            modalDate.textContent = date;
            modalTime.textContent = time;
        });

        const editWebinarModal = document.getElementById('editWebinarModal');
        editWebinarModal.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            const id = button.getAttribute('data-id');
            const title = button.getAttribute('data-title');
            const description = button.getAttribute('data-description');
            const date = button.getAttribute('data-date');
            const time = button.getAttribute('data-time');

            const modalTitle = editWebinarModal.querySelector('#editTitle');
            const modalDescription = editWebinarModal.querySelector('#editDescription');
            const modalDate = editWebinarModal.querySelector('#editDate');
            const modalTime = editWebinarModal.querySelector('#editTime');
            const form = editWebinarModal.querySelector('#editWebinarForm');

            modalTitle.value = title;
            modalDescription.value = description;
            modalDate.value = date;
            modalTime.value = time;
            form.action = `/webinars/${id}`;
        });
    });
</script>
@endsection
