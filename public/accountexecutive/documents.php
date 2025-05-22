<?php
require_once __DIR__ . '../../../database/connect.php';
require_once __DIR__ . '../../components/session-start.inc.php';
?>
<!DOCTYPE html>
<html lang="en">
<?php $pageTitle = "Document Support";
require_once __DIR__ . '../../components/head.inc.php'; ?>

<body>
    <?php require_once __DIR__ . '../../components/nav-bar.inc.php'; ?>

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-10 main-content">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="fw-bold">Document Support</h2>
                    <div>
                        <button class="btn btn-outline-secondary me-2">
                            <i class="bi bi-folder me-1"></i>New Folder
                        </button>
                        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadDocumentModal">
                            <i class="bi bi-upload me-1"></i>Upload Document
                        </button>
                    </div>
                </div>


                <div class="card-box mb-4">
                    <div class="row g-3">
                        <div class="col-md-5">
                            <input type="text" class="form-control" placeholder="Search documents...">
                        </div>
                        <div class="col-md-3">
                            <select class="form-select">
                                <option value="">All Categories</option>
                                <option>Client Contracts</option>
                                <option>Tour Itineraries</option>
                                <option>Visa Documents</option>
                                <option>Insurance</option>
                                <option>Marketing Materials</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <select class="form-select">
                                <option value="">All Types</option>
                                <option>PDF</option>
                                <option>Word</option>
                                <option>Excel</option>
                                <option>Image</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <button class="btn btn-outline-secondary w-100">More Filters</button>
                        </div>
                    </div>
                </div>


                <div class="card-box">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h5 class="fw-bold">All Documents</h5>
                        <div class="btn-group">
                            <button class="btn btn-sm btn-outline-secondary">
                                <i class="bi bi-grid"></i> Grid
                            </button>
                            <button class="btn btn-sm btn-outline-secondary active">
                                <i class="bi bi-list"></i> List
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Category</th>
                                    <th>Type</th>
                                    <th>Size</th>
                                    <th>Last Modified</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-file-earmark-pdf text-danger fs-4 me-3"></i>
                                            <div>
                                                <h6 class="mb-0">Bali_Adventure_Itinerary.pdf</h6>
                                                <small class="text-muted">BK-2025-001</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Tour Itineraries</td>
                                    <td>PDF</td>
                                    <td>2.4 MB</td>
                                    <td>May 10, 2025</td>
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                                <i class="bi bi-three-dots-vertical"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-eye me-2"></i>View</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-download me-2"></i>Download</a></li>
                                                <li><a class="dropdown-item" href="#"><i class="bi bi-share me-2"></i>Share</a></li>
                                                <li>
                                                    <hr class="dropdown-divider">
                                                </li>
                                                <li><a class="dropdown-item text-danger" href="#"><i class="bi bi-trash me-2"></i>Delete</a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>


                <div class="card-box mt-4">
                    <h5 class="fw-bold">Recent Document Activity</h5>
                    <div class="list-group">
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <i class="bi bi-file-earmark-text text-primary me-2"></i>
                                    <strong>Sarah Johnson</strong> uploaded <strong>Japan_Cultural_Tour.docx</strong>
                                </div>
                                <small class="text-muted">2 hours ago</small>
                            </div>
                        </div>
                        <div class="list-group-item">
                            <div class="d-flex justify-content-between">
                                <div>
                                    <i class="bi bi-file-earmark-pdf text-danger me-2"></i>
                                    <strong>Michael Brown</strong> downloaded <strong>Client_Contract_Template.pdf</strong>
                                </div>
                                <small class="text-muted">1 day ago</small>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="uploadDocumentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Upload New Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Select Files</label>
                            <input type="file" class="form-control" multiple required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" required>
                                <option value="">Select Category</option>
                                <option>Client Contracts</option>
                                <option>Tour Itineraries</option>
                                <option>Visa Documents</option>
                                <option>Insurance</option>
                                <option>Marketing Materials</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Related Booking (optional)</label>
                            <select class="form-select">
                                <option value="">Select Booking</option>
                                <option>9225155 (John Smith - Bali)</option>
                                <option>9225156 (Sarah Johnson - Japan)</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Description (optional)</label>
                            <textarea class="form-control" rows="2"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary">Upload Documents</button>
                </div>
            </div>
        </div>
    </div>

    <?php require_once __DIR__ . '../../components/footer.inc.php'; ?>
</body>

</html>