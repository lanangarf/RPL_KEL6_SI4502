@extends('layouts.layout')

@section('title', 'Pengaturan Akun - Dash')

@section('content')
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap">
    @csrf
</form>

<style>
    body {
        font-family: 'Inter', sans-serif;
        background-color: #f8f9fa;
    }

    .card {
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        background-color: #007bff;
        color: white;
        border-radius: 10px 10px 0 0;
        font-weight: bold;
    }

    .btn-warning,
    .btn-secondary,
    .btn-primary {
        border-radius: 20px;
        font-weight: bold;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
    }

    .btn-secondary {
        background-color: #6c757d;
        border-color: #6c757d;
    }

    .btn-primary {
        background-color: #007bff;
        border-color: #007bff;
    }
</style>

<div class="container mt-5">
    <div class="row justify-content-center">
        <!-- Container for Profile Photo and Info -->
        <div class="col-md-6">
            <div class="card mb-3">
                <div class="card-header text-center">Foto Profil</div>
                <div class="card-body text-center">
                    @if($user->profile_photo)
                        <img src="{{ asset('images/profile/' . $user->profile_photo) }}"
                            class="img-fluid mb-3 rounded-circle" style="width: 150px; height: 150px; object-fit: cover;">
                    @else
                        <p>No photo available</p>
                    @endif
                </div>
            </div>

            <div class="card">
                <div class="card-header">Informasi Pribadi</div>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" class="form-control mb-3" id="name" value="{{ $user->name }}" readonly>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control mb-3" id="email" value="{{ $user->email }}"
                                readonly>
                        </div>
                        <button type="button" onclick="window.location='{{ route('applicant.detailProfile') }}'"
                            class="btn btn-warning" style="margin-top: 10px;">Edit</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Container for Education and Experience -->
        <div class="col-md-6">
            <!-- Education Section -->
            <div class="card mb-3">
                <div class="card-header">Pendidikan</div>
                <div class="card-body">
                    <form>
                        @foreach($education as $edu)
                            <div class="education-info"
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <div>
                                    <p class="mb-1"><strong>{{ $edu->degree }}</strong></p>
                                    <p class="mb-1">{{ $edu->institution }}</p>
                                    <p class="mb-1">{{ $edu->start_date }} - {{ $edu->end_date ?? 'Sekarang' }}</p>
                                </div>
                                <button type="button"
                                    onclick="window.location='{{ route('applicant.editEducation', $edu->id) }}'"
                                    class="btn btn-secondary btn-sm" style="margin-left: 10px;"><i
                                        class="fa fa-pencil-alt"></i> Edit</button>
                            </div>
                            <hr style="margin-top: 0;">
                        @endforeach
                        <button type="button" onclick="window.location='{{ route('applicant.educationProfile') }}'"
                            class="btn btn-primary" style="margin-top: 10px;">Tambah Pendidikan</button>
                    </form>
                </div>
            </div>

            <!-- Experience Section -->
            <div class="card">
                <div class="card-header">Pengalaman</div>
                <div class="card-body">
                    <form>
                        @foreach($user->experience as $exp)
                            <div class="experience-info"
                                style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 15px;">
                                <div>
                                    <p class="mb-1"><strong>{{ $exp->job_title }}</strong></p>
                                    <p class="mb-1">{{ $exp->company }}</p>
                                    <p class="mb-1">{{ $exp->start_date }} - {{ $exp->end_date ?? 'Sekarang' }}</p>
                                </div>
                                <button type="button"
                                    onclick="window.location='{{ route('applicant.editExperience', $exp->id) }}'"
                                    class="btn btn-secondary btn-sm" style="margin-left: 10px;"><i
                                        class="fa fa-pencil-alt"></i> Edit</button>
                            </div>
                            <hr style="margin-top: 0;">
                        @endforeach
                        <button type="button" onclick="window.location='{{ route('applicant.experienceProfile') }}'"
                            class="btn btn-primary" style="margin-top: 10px;">Tambah Pengalaman</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection