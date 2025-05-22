@extends("layout.default")

@section('dashboard')
<div class="container py-4">
    <h2 class="mb-4">Dashboard Summary</h2>

    <div class="row g-4">
        <!-- Total Schedules -->
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Schedules</h5>
                    <h1 class="display-4 text-primary">{{ $scheduleCount }}</h1>
                </div>
            </div>
        </div>

        <!-- Upcoming Schedules -->
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Upcoming Schedules</h5>
                    <h1 class="display-4 text-success">{{ $upcomingSchedules }}</h1>
                </div>
            </div>
        </div>

        <!-- Total Rate Types -->
        <div class="col-md-4">
            <div class="card shadow border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">Rate Types</h5>
                    <h1 class="display-4 text-warning">{{ $ratesCount }}</h1>
                </div>
            </div>
        </div>
    </div>

    <hr class="my-5">

    <div class="row">
        <!-- Recent Schedules -->
        <div class="col-md-6 mb-4">
            <h4>Recent Schedules</h4>
            <table class="table table-bordered table-hover" style="min-height: 25vh;">
                <thead>
                    <tr>
                        <th>Tour</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentSchedules as $schedule)
                        <tr>
                            <td>{{ $schedule->tour_title ? $schedule->tour_title : 'N/A'}}</td>
                            <td>{{ $schedule->start_date }}</td>
                            <td>{{ \Carbon\Carbon::parse($schedule->start_time)->format('h:i A') }}</td>
                            <td>
                                <span class="badge 
                                    {{ $schedule->status == 'available' ? 'bg-success' : 
                                        ($schedule->status == 'unavailable' ? 'bg-secondary' : 'bg-danger') }}">
                                    {{ ucfirst($schedule->status) }}
                                </span>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Rate Types Overview -->
        <div class="col-md-6 mb-4">
            <h4>Rate Types Overview</h4>
            <table class="table table-bordered table-hover" style="min-height: 25vh;">
                <thead>
                    <tr>
                        <th>Rate Type</th>
                        <th>Multiplier</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rateTypes as $rate)
                        <tr>
                            <td>{{ ucfirst($rate->rate_name) }}</td>
                            <td>{{ number_format($rate->multiplier, 2) }}</td>
                            <td>{{ $rate->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection