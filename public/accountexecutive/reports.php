<?php
require_once __DIR__ . '../../../database/connect.php';
require_once __DIR__ . '../../components/session-start.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Reports & Analytics";
require_once __DIR__ . '../../components/head.inc.php'; ?>

<body>
    <?php require_once __DIR__ . '../../components/nav-bar.inc.php'; ?>

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">Reports & Analytics</h2>
                    <div>
                        <button class="btn btn-outline-secondary me-2">
                            <i class="bi bi-calendar me-1"></i>Date Range
                        </button>
                        <button class="btn btn-primary">
                            <i class="bi bi-download me-1"></i>Export Report
                        </button>
                    </div>
                </div>


                <div class="card-box mb-4">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <label class="form-label">From Date</label>
                            <input type="text" class="form-control datepicker" placeholder="Select start date">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">To Date</label>
                            <input type="text" class="form-control datepicker" placeholder="Select end date">
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Report Type</label>
                            <select class="form-select">
                                <option>Sales Summary</option>
                                <option>Booking Analysis</option>
                                <option>Client Acquisition</option>
                                <option>Revenue by Destination</option>
                                <option>Payment Status</option>
                            </select>
                        </div>
                        <div class="col-md-3 d-flex align-items-end">
                            <button class="btn btn-primary w-100">Generate Report</button>
                        </div>
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card-box">
                            <h6 class="text-muted">Total Bookings</h6>
                            <h3>42</h3>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar bg-success" style="width: 75%"></div>
                            </div>
                            <small class="text-muted">12% increase vs last period</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-box">
                            <h6 class="text-muted">Total Revenue</h6>
                            <h3>$52,400</h3>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar bg-primary" style="width: 65%"></div>
                            </div>
                            <small class="text-muted">8% increase vs last period</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-box">
                            <h6 class="text-muted">New Clients</h6>
                            <h3>28</h3>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar bg-info" style="width: 45%"></div>
                            </div>
                            <small class="text-muted">5% increase vs last period</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-box">
                            <h6 class="text-muted">Avg. Booking Value</h6>
                            <h3>$1,247</h3>
                            <div class="progress mt-2" style="height: 6px;">
                                <div class="progress-bar bg-warning" style="width: 55%"></div>
                            </div>
                            <small class="text-muted">3% increase vs last period</small>
                        </div>
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-md-8">
                        <div class="card-box h-100">
                            <h5 class="fw-bold">Monthly Revenue</h5>
                            <div class="chart-container" style="height: 300px;">


                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card-box h-100">
                            <h5 class="fw-bold">Top Destinations</h5>
                            <div class="chart-container" style="height: 300px;">

                                <img src="touris.jpg" class="img-fluid" alt="Destinations Chart">

                            </div>
                        </div>
                    </div>
                </div>


                <div class="card-box">
                    <h5 class="fw-bold">Detailed Booking Report</h5>
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Booking ID</th>
                                    <th>Client ID</th>
                                    <th>Tour Package</th>
                                    <th>Date</th>
                                    <th>Revenue</th>
                                    <th>Profit</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>9225155</td>
                                    <td>John Smith</td>
                                    <td>Travel andd Tour</td>
                                    <td>May 15-22, 2025</td>
                                    <td>₱139,292.32</td>
                                    <td>₱55 863.92</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php require_once __DIR__ . '../../components/footer.inc.php'; ?>
</body>

</html>