@extends('layouts.layout')
@section('title', 'Dashboard')
@section('content')
<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
    @csrf
</form>

@endsection

@endsection

