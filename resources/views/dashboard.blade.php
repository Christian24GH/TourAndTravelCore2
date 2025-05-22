@extends('layout.default')
@section('content')
<div class="container-fluid">
    <h2 class="mb-4">Dashboard Summary</h2>
    
    <div class="row mb-5">
        <div class="col-md-3 mb-3">
            <div class="card border-primary h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Customers</h5>
                    <p class="display-4">{{ $totalCustomers }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-secondary h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Notes</h5>
                    <p class="display-4">{{ $totalNotes }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-info h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Total Communications</h5>
                    <p class="display-4">{{ $totalCommunications }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3 mb-3">
            <div class="card border-danger h-100">
                <div class="card-body text-center">
                    <h5 class="card-title">Open Issues</h5>
                    <p class="display-4">{{ $totalOpenIssues }}</p>
                </div>
            </div>
        </div>
    </div>

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

    <div class="row mt-5">
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

    

    <div class="row">
        {{-- Recent Communications --}}
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    Recent Communications
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($recentCommunications as $log)
                        <li class="list-group-item">
                            <strong>{{ $log->customer_name }}</strong>  
                            <span class="badge bg-secondary">{{ ucfirst($log->type) }}</span>
                            <div>{{ $log->summary }}</div>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($log->communicated_at)->diffForHumans() }}</small>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted">No communications yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    Recent Open Issues
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($recentIssues as $issue)
                        <li class="list-group-item">
                            <strong>{{ $issue->customer_name }}</strong>
                            <div>{{ $issue->subject }}</div>
                            <small class="text-danger">{{ ucfirst($issue->status) }}</small>
                            <br>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($issue->created_at)->diffForHumans() }}</small>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted">No open issues.</li>
                    @endforelse
                </ul>
            </div>
        </div>

        {{-- Recent Notes --}}
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                <div class="card-header">
                    Recent Customer Notes
                </div>
                <ul class="list-group list-group-flush">
                    @forelse($recentNotes as $note)
                        <li class="list-group-item">
                            <strong>{{ $note->customer_name }}</strong>
                            <div>{{ $note->note }}</div>
                            <small class="text-muted">{{ \Carbon\Carbon::parse($note->created_at)->diffForHumans() }}</small>
                        </li>
                    @empty
                        <li class="list-group-item text-center text-muted">No notes yet.</li>
                    @endforelse
                </ul>
            </div>
        </div>
    </div>
</div>
@endsection