@extends('layout.default')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Issue</h2>

    <form action="{{ route('crm.issues.update', $issue->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="customer_id" class="form-label">Customer</label>
                <select name="customer_id" class="form-select" required>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" {{ $customer->id == $issue->customer_id ? 'selected' : '' }}>
                            {{ $customer->first_name }} {{ $customer->last_name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" name="subject" class="form-control" value="{{ $issue->subject }}" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" required>{{ $issue->description }}</textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="open" {{ $issue->status == 'open' ? 'selected' : '' }}>Open</option>
                <option value="in_progress" {{ $issue->status == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                <option value="resolved" {{ $issue->status == 'resolved' ? 'selected' : '' }}>Resolved</option>
                <option value="closed" {{ $issue->status == 'closed' ? 'selected' : '' }}>Closed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Update Issue</button>
    </form>
</div>
@endsection
