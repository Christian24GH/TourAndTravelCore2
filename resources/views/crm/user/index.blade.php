@extends('layout.user')

@section('content')
    <h3>Welcome, {{ $customer->first_name }} {{ $customer->last_name }}</h3>
    <a href="{{ route('user.application.index', $customer->id) }}" class="btn btn-primary mt-3">My Applications</a>
    <a href="{{ route('user.schedule.index', $customer->id) }}" class="btn btn-secondary mt-3">Tour Schedules</a>
@endsection