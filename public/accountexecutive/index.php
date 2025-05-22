<?php
    require_once __DIR__ . '/connect.php';
    require_once __DIR__ . '/session-start.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Account Executives"; require_once __DIR__ . '/head.inc.php'; ?>
<body>
<?php require_once __DIR__ . '/nav-bar.inc.php'; ?>

<div class="col-md-10 main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Account Executives</h2>
        <div>
            <button class="btn btn-warning me-2">
                <i class="bi bi-download me-1"></i>Export Report
            </button>
            <button class="btn btn-primary">
                <i class="bi bi-plus-circle me-1"></i>New Booking
            </button>
        </div>
    </div>

        
    <div class="row mb-4">
        <div class="col-md-3">
            <div class="card-box text-center border-start border-4 border-primary">
                <h5 class="text-muted">Active Bookings</h5>
                <h2 class="fw-bold">24</h2>
                <small class="text-success"><i class="bi bi-arrow-up"></i> 10.3% from last month</small>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-box text-center border-start border-4 border-success">
                <h5 class="text-muted">New Clients</h5>
                <h2 class="fw-bold">18</h2>
                <small class="text-success"><i class="bi bi-arrow-up"></i> 5.2% growth</small>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card-box text-center border-start border-4 border-warning">
                <h5 class="text-muted">Monthly Revenue</h5>
                <h2 class="fw-bold">300,000</h2>
                <small class="text-danger"><i class="bi bi-arrow-down"></i> 2.5% from last month</small>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-box text-center border-start border-4 border-danger">
                <h5 class="text-muted">Pending Requests</h5>
                <h2 class="fw-bold">15</h2>
                <small class="text-warning"><i class="bi bi-plus-circle"></i> 3 new today</small>
            </div>
        </div>
    </div>

    
    <div class="card-box">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold">Upcoming Bookings</h5>
            <a href="booking.html" class="btn btn-sm btn-outline-primary">View All</a>
        </div>
        
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                <tr>
                    <th>Booking ID</th>
                    <th>Client</th>
                    <th>Tour Package</th>
                    <th>Date</th>
                    <th>Travelers</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>9225155</td>
                    <td>John Smith</td>
                    <td>May 15-22, 2025</td>
                    <td>4</td>
                    <td><span class="badge-confirmed status-badge">Confirmed</span></td>
                    <td><button class="btn btn-sm btn-outline-primary">View</button></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

        
    <div class="card-box">
        <div class="d-flex justify-content-between align-items-center mb-3">
            <h5 class="fw-bold">Recent Clients</h5>
            <a href="client.html" class="btn btn-sm btn-outline-primary">View All</a>
        </div>

        <div class="row">
            <div class="col-md-3 mb-3">
                <div class="card h-100">
                    <div class="card-body text-center">
                        <h6 class="card-title mb-1">John Smith</h6>
                        <small class="text-muted d-block mb-2">john@example.com</small>
                        <span class="badge bg-success mb-2">VIP Client</span>
                        <div class="d-flex justify-content-between small">
                            <span>Bookings: 5</span>
                            <span>Total: ₱10,000</span>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent">
                        <button class="btn btn-sm btn-outline-primary w-100">View Profile</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require_once __DIR__ . '/footer.inc.php'; ?>
</body>
</html>