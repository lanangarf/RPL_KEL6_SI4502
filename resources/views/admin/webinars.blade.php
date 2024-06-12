@extends('layouts.app')

@section('title', 'Manage Webinars')

@section('content')
<div class="container">
    <h1 class="my-4">Manage Webinars</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Time</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($webinars as $webinar)
            <tr>
                <td>{{ $webinar->title }}</td>
                <td>{{ $webinar->description }}</td>
                <td>{{ $webinar->date }}</td>
                <td>{{ $webinar->time }}</td>
                <td>
                    <a href="{{ route('admin.webinar.edit', $webinar->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.webinar.delete', $webinar->id) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
