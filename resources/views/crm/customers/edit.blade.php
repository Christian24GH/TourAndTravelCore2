@extends('layout.default')

@section('content')
<div class="container">
    <h2 class="mb-4">Edit Customer</h2>

    <form action="{{ route('crm.customers.update', $customer->id) }}" method="POST">
        @csrf
        @method('PUT')

        @include('crm.customers.form', ['customer' => $customer])

        <button type="submit" class="btn btn-success">Update</button>
        <a href="{{ route('crm.customers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection