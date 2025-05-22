@extends('layout.default')

@section('content')
<div class="container">
    <h2 class="mb-4">CRM Dashboard</h2>

    {{-- KPI Cards --}}
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

        {{-- Recent Open Issues --}}
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
