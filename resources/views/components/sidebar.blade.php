<div class="col-md-2 sidebar p-3 overflow-y-auto">
    <div class="text-center mb-4">
    <img src="{{asset('img/logo.jpg')}}" class="img-fluid" alt="Logo">
    <h6>Travel and Tours</h6>
    <small>Admin Panel</small>
    <div class="mt-3">
        <strong>Admin name</strong><br>
        <small class="text-muted">Position title</small>
    </div>
    </div>
    <a class="nav-link" href="{{route('dashboard')}}" style="color:var(--bs-link-color);">Dashboard</a>
    <nav class="nav flex-column">
        <p class="mt-4">Passport Verification</p>
        
        <a class="nav-link" href="{{url('/admin/passportInfo/index.php')}}">Passport Information</a>
        <a class="nav-link" href="{{url('/admin/uploadPassport/index.php')}}">Upload Passport</a>
        <a class="nav-link" href="{{url('/admin/apptrack/index.php')}}">Passport Tracking</a>
        <a class="nav-link" href="{{url('/admin/ticket/index.php')}}">Issued Tickets</a>

        <p class="mt-4">Customer Relation</p>
        <a class="nav-link {{ request()->route()->getName() == 'crm.customers.index' ? 'active' : '' }}" href="{{route('crm.customers.index')}}">Customers</a>
        <a class="nav-link {{ request()->route()->getName() == 'crm.notes.index' ? 'active' : '' }}" href="{{route('crm.notes.index')}}">Notes</a>
        <a class="nav-link {{ request()->route()->getName() == 'crm.logs.index' ? 'active' : '' }}" href="{{route('crm.logs.index')}}">Logs</a>
        <a class="nav-link {{ request()->route()->getName() == 'crm.issues.index' ? 'active' : '' }}" href="{{route('crm.issues.index')}}">Issues and Complaints</a>

        <p class="mt-4">Schedule and Rates</p>
        <a class="nav-link {{ request()->route()->getName() == 'schedules.index' ? 'active' : '' }}" href="{{route('schedules.index')}}">Schedule</a>
        <a class="nav-link {{ request()->route()->getName() == 'rates.index' ? 'active' : '' }}" href="{{route('rates.index')}}">Rates</a>
    </nav>
</div>