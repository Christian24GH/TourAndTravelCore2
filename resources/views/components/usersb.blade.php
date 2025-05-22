<div class="col-md-2 sidebar p-3 overflow-y-auto">
    <div class="text-center mb-4">
    <img src="{{asset('img/logo.jpg')}}" class="img-fluid" alt="Logo">
    <h6>Travel and Tours</h6>
    <small>User Panel</small>
    <div class="mt-3">
        <strong>Username</strong><br>
    </div>
    </div>
    <nav class="nav flex-column">
        <a class="nav-link" href="{{route('user.home')}}">Home</a>
        <a class="nav-link " href="{{route('user.schedule.index')}}">Schedules</a>
        <a class="nav-link " href="{{route('user.application.index')}}">Application</a>
    </nav>
</div>