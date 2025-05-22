@extends("layout.default")
@section('modal')
<div class="modal fade" id="addrate" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
            <form id="addScheduleForm" action="{{ route('rates.store') }}" method="post">
                @csrf
                @method('post')
                <div class="col-md-4">
                    <label for="rate_type" class="form-label">Rate Name</label>
                    <input type="text" class="form-control" name="rate_name">
                </div>

                <div class="col-md-4">
                    <label for="multiplier" class="form-label">Multiplier</label>
                    <input type="number" step="0.01" min="0" name="multiplier" id="multiplier" class="form-control" placeholder="e.g., 1.25" required>
                </div>

                <div class="col-md-4">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" name="description" id="description" class="form-control" placeholder="Description" maxlength="255">
                </div>

                <div class="row mb-3">
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Add Rate</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>

@endsection
@section("content")
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Rates</h3>
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addrate">New Rate</button>
    </div>

    <div class="card-box" style="min-height: 85vh;">
        <h5>Rates</h5>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger" role="alert">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Rate Name</th>
                <th>Multiplier</th>
                <th>Description</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rates as $rate)
                <form action="{{ route('rates.update', $rate->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <tr>
                        <td class="align-middle">{{ $rate->id }}</td>

                        <td class="align-middle">
                            <input class="form-control" value="{{ $rate->rate_name }}" name="rate_name"/>
                        </td>

                        <td class="align-middle">
                            <input type="number" step="0.01" name="multiplier" class="form-control" value="{{ $rate->multiplier }}" required>
                        </td>

                        <td class="align-middle">
                            <input name="description" class="form-control" value="{{ $rate->description }}"></input>
                        </td>

                        <td class="align-middle">{{ $rate->created_at }}</td>
                        <td class="align-middle">{{ $rate->updated_at }}</td>

                        <td class="align-middle">
                            <button type="submit" class="btn btn-success"><i class="bi bi-save2-fill"></i></button>
                            <a href="{{ route('rates.destroy', $rate->id) }}" class="btn btn-danger"
                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $rate->id }}').submit();">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                </form>

                <!-- Hidden delete form -->
                <form id="delete-form-{{ $rate->id }}" action="{{ route('rates.destroy', $rate->id) }}" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
            @endforeach
        </tbody>
    </table>


    </div>
@endsection