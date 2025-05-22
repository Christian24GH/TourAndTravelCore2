<div class="container p-1">
    <div class="w-100 bg-warning bg-gradient">
        <h5 class="text-center py-2">Passport Information</h5>
    </div>
    <div class="card border border border-0">
        <div class="card-body">
            <h5 class="card-title"> Application No. <span id="applicationID"></span></h5>
            <div class="row mb-3">
                <div class="col-auto flex-fill">
                    <label for="customerName" class="form-label">Customer Name</label>
                    <input type="text" class="form-control" id="customerName" placeholder="Customer Name" required>
                </div>
            </div>
            <div class="row mb-3 gap-3">
                <div class="flex-fill col-auto">
                    <label for="dateofbirth" class="form-label">Date of Birth</label>
                    <input type="date" class="form-control" id="dateofbirth" required>
                </div>
                <div class="flex-fill col-auto">
                    <label for="gender" class="form-label">Gender</label>
                    <select class="form-select"name="gender" id="gender" required>
                        <option value="">Select here</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
            </div>
            <!--
            <div class="accordion accordion-flush" id="contactInfo">
                <div class="accordion-item">
                    <h2 class="accordion-header">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#contactInfoBody">
                        Contacts
                    </button>
                    </h2>
                    <div id="contactInfoBody" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                        <li class="list-group">
                            <div class="row mb-3">
                                <div class="flex-fill col-auto">
                                    <label for="address" class="form-label">Address</label>
                                    <input type="text" class="form-control" id="address" placeholder="Address" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="flex-fill col-auto">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="email" placeholder="Email" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="flex-fill col-auto">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" class="form-control" id="phone" placeholder="Phone" required>
                                </div>
                            </div>
                        </li>
                    </div>
                </div>
            </div>
            -->
        </div>
    </div>
    <div class="card p-2 border border-0">
        <div class="card-body">
            <h5 class="py-2">Documents</h5>
            <ul id="document_section" class="list-group unordered-list"></ul>
        </div>
    </div>
    <hr class="border border-2">
    <div class="d-flex justify-content-end gap-1">
        <button id="rejectModalBtn" class="btn btn-primary" style="min-width:5rem" data-bs-toggle="modal" data-bs-target="#approveModal">Approve</button>
        <button id="approveModalBtn" class="btn btn-danger" style="min-width:5rem" data-bs-toggle="modal" data-bs-target="#rejectModal">Reject</button>
    </div>
</div>