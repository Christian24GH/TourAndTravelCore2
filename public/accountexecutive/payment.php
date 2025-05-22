<?php
require_once __DIR__ . '../../../database/connect.php';
require_once __DIR__ . '../../components/session-start.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Payment Processing";
require_once __DIR__ . '../../components/head.inc.php'; ?>

<body>
    <?php require_once __DIR__ . '../../components/nav-bar.inc.php'; ?>

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">Payment Processing</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#recordPaymentModal">
                        <i class="bi bi-plus-circle me-1"></i>Record Payment
                    </button>
                </div>


                <div class="card-box mb-4">
                    <div class="row g-3">
                        <div class="col-md-3">
                            <input type="text" class="form-center" placeholder="Search payments...">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option value="">All Payment Methods</option>
                                <option>Credit Card</option>
                                <option>Bank Transfer</option>
                                <option>Cash</option>
                                <option>PayPal</option>
                            </select>
                        </div>
                        <div class="col-md-3">
                            <select class="form-center">
                                <option value="">All Statuses</option>
                                <option>Completed</option>
                                <option>Pending</option>
                                <option>Failed</option>
                                <option>Refunded</option>
                            </select>
                        </div>
                    </div>
                </div>


                <div class="row mb-4">
                    <div class="col-md-3">
                        <div class="card-box text-center">
                            <h5 class="text-muted">Total Received</h5>
                            <h3 class="text-success">₱200,000 </h3>
                            <small>This month</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-box text-center">
                            <h5 class="text-muted">Pending Payments</h5>
                            <h3 class="text-warning">5,000</h3>
                            <small>5 invoices</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-box text-center">
                            <h5 class="text-muted">Average Payment</h5>
                            <h3 class="text-primary">75,000</h3>
                            <small>Per booking</small>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card-box text-center">
                            <h5 class="text-muted">Refunds Issued</h5>
                            <h3 class="text-danger">60,000</h3>
                            <small>3 refunds</small>
                        </div>
                    </div>
                </div>


                <div class="card-box">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Payment ID</th>
                                    <th>Invoice</th>
                                    <th>Client</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Method</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>PAY-2025-001</td>
                                    <td>INV-2025-015</td>
                                    <td>May 12, 2025</td>
                                    <td>₱139,169.83</td>
                                    <td>Credit Card</td>
                                    <td><span class="badge bg-success">Completed</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary" title="View Details">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary" title="Receipt">
                                            <i class="bi bi-receipt"></i>
                                        </button>
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
        </div>
    </div>


    <div class="modal fade" id="recordPaymentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Record New Payment</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Invoice Number</label>
                            <select class="form-select" required>
                                <option value="">Select Invoice</option>
                                <option>9225155 (John Smith - ₱139,175.92)</option>
                                <option>92251556 (Sarah Johnson - ₱105,092.03)</option>
                            </select>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">Payment Amount</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Payment Date</label>
                                <input type="date" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Payment Method</label>
                            <select class="form-select" required>
                                <option value="">Select method</option>
                                <option>Credit Card</option>
                                <option>Bank Transfer</option>
                                <option>Cash</option>
                                <option>PayPal</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Transaction Reference</label>
                            <input type="text" class="form-control">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Record Payment</button>
                </div>
            </div>
        </div>
    </div>

    <?php require_once __DIR__ . '../../components/footer.inc.php'; ?>
</body>

</html>