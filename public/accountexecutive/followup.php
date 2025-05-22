<?php
require_once __DIR__ . '../../../database/connect.php';
require_once __DIR__ . '../../components/session-start.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Followup & After Sales";
require_once __DIR__ . '../../components/head.inc.php'; ?>

<body>
    <?php require_once __DIR__ . '../../components/nav-bar.inc.php'; ?>

    <div class="container-fluid">
        <div class="row">

            <div class="col-md-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">Follow-up & After-sales</h2>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addFollowupModal">
                        <i class="bi bi-plus-circle me-1"></i>Schedule Follow-up
                    </button>
                </div>


                <ul class="nav nav-tabs mb-4">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Pending Follow-ups</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Completed</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Client Feedback</a>
                    </li>
                </ul>


                <div class="card-box">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Client ID</th>
                                    <th>Booking Reference</th>
                                    <th>Follow-up Type</th>
                                    <th>Scheduled Date</th>
                                    <th>Status</th>
                                    <th>Assigned To</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>

                                    <td>9225155</td>
                                    <td>Post-tour feedback</td>
                                    <td>May 30, 2025</td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>Sarah Johnson</td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary me-1">
                                            <i class="bi bi-check"></i> Complete
                                        </button>
                                        <button class="btn btn-sm btn-outline-secondary">
                                            <i class="bi bi-pencil"></i> Edit
                                        </button>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="card-box mt-4">
                    <h5 class="fw-bold">Recent Client Feedback</h5>
                    <div class="row">

                        <div class="col-md-4 mb-3">
                            <div class="card h-100">
                                <div class="card-body">
                                    <div class="d-flex align-items-center mb-3">

                                        <div>
                                            <h6 class="mb-0">John Smith</h6>
                                            <small class="text-muted">Bali Adventure - May 2025</small>
                                        </div>
                                    </div>
                                    <div class="mb-2">
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star-fill text-warning"></i>
                                        <i class="bi bi-star text-warning"></i>
                                    </div>
                                    <p class="card-text">"The tour was excellent! The guides were knowledgeable and the itinerary was well-planned. Would definitely book again."</p>
                                </div>
                                <div class="card-footer bg-transparent">
                                    <small class="text-muted">Submitted: June 5, 2025</small>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addFollowupModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Schedule New Follow-up</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Client</label>
                            <select class="form-select" required>
                                <option value="">Select Client</option>
                                <option>John Smith (9225155)</option>
                                <option>Sarah Johnson (9225156)</option>
                                <option>Emily Davis (9225157) </option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Follow-up Type</label>
                            <select class="form-select" required>
                                <option value="">Select Type</option>
                                <option>Pre-tour confirmation</option>
                                <option>Post-tour feedback</option>
                                <option>Special offer</option>
                                <option>Anniversary</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Scheduled Date</label>
                            <input type="datetime-local" class="form-control" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Assigned To</label>
                            <select class="form-select" required>
                                <option value="">Select Staff</option>
                                <option>Sarah Johnson</option>
                                <option>Michael Brown</option>
                                <option>Emily Davis</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Notes</label>
                            <textarea class="form-control" rows="3" placeholder="Any specific instructions or details"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Schedule Follow-up</button>
                </div>
            </div>
        </div>
    </div>

    <?php require_once __DIR__ . '../../components/footer.inc.php'; ?>
</body>

</html>