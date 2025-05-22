@extends("layout.default")
@section('modal')
<div class="modal fade" id="addSchedule" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
            <form id="addScheduleForm" action="{{ route('schedules.store') }}" method="post">
                @csrf
                @method('post')

                <div class="row mb-3">
                    <div class="col">
                        <label for="tour_package_id" class="form-label">Tour Package</label>
                        <select name="tour_package_id" id="tour_package_id" class="form-select" required>
                            <option>Select a tour package</option>
                            @foreach($tourPackages as $package)
                                <option value="{{ $package->id }}">{{ $package->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col">
                        <label for="rate_id" class="form-label">Rate Type</label>
                        <select name="rate_id" id="rate_id" class="form-select" required>
                            <option disabled selected>Select a rate</option>
                            @foreach($rates as $rate)
                                <option value="{{ $rate->id }}">{{ $rate->rate_name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="start_date" class="form-label">Start Date</label>
                        <input type="date" class="form-control" name="start_date" id="start_date" required>
                    </div>

                    <div class="col">
                        <label for="start_time" class="form-label">Start Time</label>
                        <input type="time" class="form-control" name="start_time" id="start_time" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="duration" class="form-label">Duration</label>
                        <input type="text" class="form-control" name="duration" id="duration" placeholder="e.g., 5 hours or 3 days" required>
                    </div>

                    <div class="col">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" class="form-control" name="location" id="location" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col">
                        <label for="final_price" class="form-label">Base Price (PHP)</label>
                        <input type="number" step="0.01" class="form-control" name="final_price" id="final_price" required>
                    </div>

                    <div class="col">
                        <label for="status" class="form-label">Status</label>
                        <select class="form-select" name="status" id="status">
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                            <option value="fully booked">Fully Booked</option>
                        </select>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-12 d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Add Schedule</button>
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
        <h3>Schedules</h3>
        <button class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#addSchedule">Add Schedule</button>
    </div>

    <div class="card-box" style="min-height: 85vh;">
        <h5>Schedules</h5>
        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif
        
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Tour Name</th>
                <th>Rate</th>
                <th>Date</th>
                <th>Time</th>
                <th>Duration</th>
                <th>Price</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
                @foreach ($schedules as $schedule)
                <form action="{{ route('schedules.update', $schedule->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <tr>
                        <td class="align-middle">
                            <!-- Optional: If you want to let users change tour package -->
                            {{$schedule->tour_title}}
                        </td>
                        <td class="align-middle">
                            <select name="rate_id" class="form-select">
                                @foreach($rates as $rate)
                                    <option value="{{$rate->id}}" {{ $schedule->rate_id === $rate->id ? 'selected' : '' }}>{{$rate->rate_name}}</option>
                                @endforeach
                            </select>
                        </td>
                        <td class="align-middle">
                            <input type="date" name="start_date" class="form-control" value="{{ $schedule->start_date }}" required>
                        </td>
                        <td class="align-middle">
                            <input type="time" name="start_time" class="form-control" value="{{ $schedule->start_time }}" required>
                        </td>
                        <td class="align-middle">
                            <input type="text" name="duration" class="form-control" value="{{ $schedule->duration }}" required>
                        </td>
                        <td class="align-middle">
                            <input type="number" step="0.01" name="final_price" class="form-control" value="{{ $schedule->final_price }}" required>
                        </td>
                        <td class="align-middle">
                            <select name="status" class="form-select" required>
                                <option value="available" {{ $schedule->status == 'available' ? 'selected' : '' }}>Available</option>
                                <option value="unavailable" {{ $schedule->status == 'unavailable' ? 'selected' : '' }}>Unavailable</option>
                                <option value="fully booked" {{ $schedule->status == 'fully booked' ? 'selected' : '' }}>Fully Booked</option>
                            </select>
                        </td>
                        <td class="align-middle">
                            <button type="submit" class="btn btn-success"><i class="bi bi-save2-fill"></i></button>
                            <a href="{{ route('schedules.destroy', $schedule->id) }}" class="btn btn-danger"
                                onclick="event.preventDefault(); document.getElementById('delete-form-{{ $schedule->id }}').submit();">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>
                </form>

                <!-- Hidden delete form -->
                <form id="delete-form-{{ $schedule->id }}" action="{{ route('schedules.destroy', $schedule->id) }}" method="POST" style="display:none;">
                    @csrf
                    @method('DELETE')
                </form>
                @endforeach

            </tbody>
        </table>
    </div>
@endsection