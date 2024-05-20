@extends('layouts.app')
@section('title', 'Login')
@section('content')
<style>
    .vh-100 {
        height: 100vh;
    }
    .card {
        max-width: 400px;
    }
</style>
<div class="row justify-content-center align-items-center vh-100">
    <div class="col-md-auto">
        <div class="card shadow-lg">
            <div class="card-header text-center">Register</div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" name="name" id="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">What are you?</label>
                        <select class="form-control" name="role">
                            <option value="applicant">Applicant</option>
                            <option value="recruiter">Recruiter</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Register</button>
                </form>
            </div>
            <div class="card-footer text-muted text-center">
                Already have an account? <a href="{{ route('login') }}">Login Here</a>
            </div>
        </div>
    </div>
</div>
@endsection