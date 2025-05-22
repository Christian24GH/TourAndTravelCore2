@extends('layout.default')

@section('content')
<div class="container">
    <h2 class="mb-4">Customer Issues</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Add Issue Button --}}
    <a href="{{ route('crm.issues.create') }}" class="btn btn-primary mb-4">Create New Issue</a>

    {{-- Issues Table --}}
    <div class="card">
        <div class="card-header">Issues List</div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Customer</th>
                        <th>Subject</th>
                        <th>Status</th>
                        <th>Created At</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($issues as $issue)
                        <tr>
                            <td>{{ $issue->customer_name }}</td>
                            <td>{{ $issue->subject }}</td>
                            <td>{{ ucfirst($issue->status) }}</td>
                            <td>{{ \Carbon\Carbon::parse($issue->created_at)->format('Y-m-d H:i') }}</td>
                            <td>
                                <a href="{{ route('crm.issues.edit', $issue->id) }}" class="btn btn-sm btn-info">Edit</a>

                                <form action="{{ route('crm.issues.destroy', $issue->id) }}" method="POST" style="display:inline;" onsubmit="return confirm('Delete this issue?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">No issues found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection