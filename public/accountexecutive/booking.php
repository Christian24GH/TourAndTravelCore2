<?php
require_once __DIR__ . '../../../database/connect.php';
require_once __DIR__ . '../../components/session-start.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Booking Management";
require_once __DIR__ . '../../components/head.inc.php'; ?>

<body>
    <?php require_once __DIR__ . '../../components/nav-bar.inc.php'; ?>

    <div class="col-md-10 main-content">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Booking Management</h2>
            <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addBookingModal">
                <i class="bi bi-plus-circle me-1"></i>New Booking
            </button>
        </div>


        <div class="card-box mb-4">
            <div class="row g-3">
                <div class="col-md-4">
                    <input type="text" class="form-control" placeholder="Search bookings...">
                </div>
                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">All Statuses</option>
                        <option>Confirmed</option>
                        <option>Pending</option>
                        <option>Cancelled</option>
                        <option>Completed</option>
                    </select>
                </div>

                <div class="col-md-3">
                    <select class="form-select">
                        <option value="">All Tour Packages</option>
                        <option>Bali Adventure</option>
                        <option>Japan Cultural</option>
                        <option>European Explorer</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <button class="btn btn-outline-secondary w-100">More Filters</button>
                </div>
            </div>
        </div>


        <div class="card-box">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>Booking ID</th>
                            <th>Client</th>
                            <th>Tour Package</th>
                            <th>Dates</th>
                            <th>Travelers</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>9225155</td>
                            <td>Bali Adventure</td>
                            <td>May 15-22, 2025</td>
                            <td>4</td>
                            <td><span class="badge bg-success">Confirmed</span></td>
                            <td>
                                <div class="dropdown">
                                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                        Actions
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                        <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-text me-2"></i>Generate Invoice</a></li>
                                        <li>
                                            <hr class="dropdown-divider">
                                        </li>
                                        <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Cancel</a></li>
                                    </ul>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>
            </div>


            <nav class="mt-4">
                <ul class="pagination justify-content-center">
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="#">1</a></li>
                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                    <li class="page-item">
                        <a class="page-link" href="#">Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>

    <div class="modal fade" id="addBookingModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Create New Booking</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Client</label>
                                <select class="form-select" required>
                                    <option value="">Select Client</option>
                                    <option>John Smith</option>
                                    <option>Sarah Johnson</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Tour Package</label>
                                <select class="form-select" required>
                                    <option value="">Select Package</option>
                                    <option>Bali Adventure</option>
                                    <option>Japan Cultural</option>
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Start Date</label>
                                <input type="date" class="form-control" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">End Date</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4">
                                <label class="form-label">Number of Travelers</label>
                                <input type="number" class="form-control" min="1" required>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Total Price</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" min="0" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label class="form-label">Status</label>
                                <select class="form-select" required>
                                    <option>Confirmed</option>
                                    <option>Pending</option>
                                </select>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Special Requirements</label>
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Create Booking</button>
                </div>
            </div>
        </div>
    </div>

    <?php require_once __DIR__ . '../../components/footer.inc.php'; ?>
</body>

</html>