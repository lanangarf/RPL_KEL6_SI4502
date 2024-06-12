@extends('layouts.app')

@section('title', 'Edit Webinar')

@section('content')
<div class="container">
    <h1 class="my-4">Edit Webinar</h1>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.webinar.update', $webinar->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="title">Webinar Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $webinar->title }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="description">Webinar Description</label>
            <textarea class="form-control" id="description" name="description" required>{{ $webinar->description }}</textarea>
        </div>

        <div class="form-group mb-3">
            <label for="date">Date</label>
            <input type="date" class="form-control" id="date" name="date" value="{{ $webinar->date }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="time">Time</label>
            <input type="time" class="form-control" id="time" name="time" value="{{ $webinar->time }}" required>
        </div>

        <button type="submit" class="btn btn-success">Update Webinar</button>
    </form>
</div>
@endsection
