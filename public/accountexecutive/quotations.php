<?php
require_once __DIR__ . '../../../database/connect.php';
require_once __DIR__ . '../../components/session-start.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Quotations & Invoicing";
require_once __DIR__ . '../../components/head.inc.php'; ?>

<body>
    <?php require_once __DIR__ . '../../components/nav-bar.inc.php'; ?>

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">Quotations & Invoicing</h2>
                    <div>
                        <button class="btn btn-outline-primary me-2">
                            <i class="bi bi-file-earmark-text me-1"></i>Create Quotation
                        </button>
                        <button class="btn btn-primary">
                            <i class="bi bi-receipt me-1"></i>Generate Invoice
                        </button>
                    </div>
                </div>

                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">All Documents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Quotations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Invoices</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Drafts</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pending</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Paid</a>
                    </li>
                </ul>


                <div class="card-box">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead>
                                <tr>
                                    <th>Document #</th>
                                    <th>Client ID </th>
                                    <th>Tour Package</th>
                                    <th>Date</th>
                                    <th>Amount</th>
                                    <th>Status</th>
                                    <th>Due Date</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>

                                        <small class="text-muted">Quotation</small>
                                    </td>
                                    <td>Travel and Tours</td>
                                    <td>May 10, 2025</td>
                                    <td>₱139,286.18</td>
                                    <td><span class="badge-pending status-badge">Pending</span></td>
                                    <td>May 24, 2025</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                Actions
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-pencil me-2"></i>Edit</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-file-earmark-pdf me-2"></i>Download PDF</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-envelope me-2"></i>Email to Client</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-success" href="#"><i class="bi bi-receipt me-2"></i>Convert to Invoice</a></li>
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
        </div>
    </div>

    <?php require_once __DIR__ . '../../components/footer.inc.php'; ?>
</body>

</html>