@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
<div class="container">
    <h1>Recruiter Dashboard</h1>
    <p>Welcome, {{ Auth::user()->name }}. This is your dashboard.</p>
</div>
@endsection
