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
            <div class="card-header text-center">Login</div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" name="email" id="email" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember">
                        <label class="form-check-label" for="remember">Remember Me</label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
            </div>
            <div class="card-footer text-muted text-center">
                Don't have an account? <a href="{{ route('register') }}">Register Here</a>
            </div>
        </div>
    </div>
</div>
@endsection