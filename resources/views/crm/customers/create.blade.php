@extends('layout.default')

@section('content')
<div class="container">
    <h2 class="mb-4">Add New Customer</h2>

    <form action="{{ route('crm.customers.store') }}" method="POST">
        @csrf

        @include('crm.customers.form')

        <button type="submit" class="btn btn-primary">Save</button>
        <a href="{{ route('crm.customers.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection