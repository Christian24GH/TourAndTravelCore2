@extends('layout.user')

@section('content')
    <h4>Available Tour Schedules</h4>
    <table class="table table-striped mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Location</th>
                <th>Start Date</th>
                <th>Start Time</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($schedules as $schedule)
            <tr>
                <td>{{ $schedule->id }}</td>
                <td>{{ $schedule->location }}</td>
                <td>{{ $schedule->start_date }}</td>
                <td>{{ $schedule->start_time }}</td>
                <td>{{ number_format($schedule->final_price, 2) }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection