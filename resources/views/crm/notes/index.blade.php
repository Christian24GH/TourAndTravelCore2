@extends('layout.default')

@section('content')
<div class="container">
    <h2 class="mb-4">Customer Notes</h2>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Add Note Form --}}
    <div class="card mb-4">
        <div class="card-header">Add New Note</div>
        <div class="card-body">
            <form action="{{ route('crm.notes.store') }}" method="POST">
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
                </div>

                <div class="mb-3">
                    <label for="note" class="form-label">Note</label>
                    <textarea name="note" class="form-control" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Add Note</button>
            </form>
        </div>
    </div>

    {{-- Notes Table --}}
    <div class="card">
        <div class="card-header">All Notes</div>
        <div class="card-body p-0">
            <table class="table table-bordered mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Customer</th>
                        <th>Note</th>
                        <th>Created At</th>
                        <th style="width: 100px;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($notes as $note)
                        <tr>
                            <td>{{ $note->customer_name }}</td>
                            <td>{{ $note->note }}</td>
                            <td>{{ \Carbon\Carbon::parse($note->created_at)->format('Y-m-d H:i') }}</td>
                            <td>
                                <form action="{{ route('crm.notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Delete this note?')">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-danger">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="text-center">No notes yet.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
