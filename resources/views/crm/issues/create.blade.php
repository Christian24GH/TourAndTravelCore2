@extends('layout.default')

@section('content')
<div class="container">
    <h2 class="mb-4">Create New Issue</h2>

    <form action="{{ route('crm.issues.store') }}" method="POST">
        @csrf

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="customer_id" class="form-label">Customer</label>
                <select name="customer_id" class="form-select" required>
                    <option value="">Select Customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}">{{ $customer->first_name }} {{ $customer->last_name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="subject" class="form-label">Subject</label>
                <input type="text" name="subject" class="form-control" placeholder="Subject of the issue" required>
            </div>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="4" placeholder="Describe the issue" required></textarea>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" class="form-select" required>
                <option value="open">Open</option>
                <option value="in_progress">In Progress</option>
                <option value="resolved">Resolved</option>
                <option value="closed">Closed</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Submit Issue</button>
    </form>
</div>
@endsection
