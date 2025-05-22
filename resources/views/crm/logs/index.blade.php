@extends('layout.default')

@section('content')
<div class="container">
    <h2 class="mb-4">Communication Logs</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Add Log Form --}}
    <div class="card mb-4">
        <div class="card-header">New Log Entry</div>
        <div class="card-body">
            <form action="{{ route('crm.logs.store') }}" method="POST">
                @csrf

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="customer_id" class="form-label">Customer</label>
                        <select name="customer_id" class="form-select" required>
                            <option value="">Select Customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">
                                    {{ $customer->first_name }} {{ $customer->last_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="type" class="form-label">Type</label>
                        <input type="text" name="type" class="form-control" placeholder="e.g., Call, Email, Chat" required>
                    </div>
                </div>

                <div class="mb-3">
                    <label for="content" class="form-label">Content</label>
                    <textarea name="content" class="form-control" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Add Log</button>
            </form>
        </div>
    </div>

    {{-- Logs Table --}}
    <div class="card">
        <div class="card-header">Log History</div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Customer</th>
                        <th>Type</th>
                        <th>Content</th>
                        <th>Created At</th>
                        <th style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($logs as $log)
                        <tr>
                            <td>{{ $log->customer_name }}</td>
                            <td>{{ $log->type }}</td>
                            <td>{{ $log->content }}</td>
                            <td>{{ \Carbon\Carbon::parse($log->created_at)->format('Y-m-d H:i') }}</td>
                            <td>
                                <form action="{{ route('crm.logs.destroy', $log->id) }}" method="POST" onsubmit="return confirm('Delete this log?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No communication logs yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
