@extends('layout.user')

@section('content')
    <h4>My Applications</h4>
    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Submission Date</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach ($applications as $application)
            <tr>
                <td>{{ $application->applicationID }}</td>
                <td>{{ $application->submittion_date }}</td>
                <td>{{ ucfirst($application->status) }}</td>
                <td>
                    <form action="{{ route('user.application.delete', [$id, $application->applicationID]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Cancel</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection