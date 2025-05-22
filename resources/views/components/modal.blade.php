<div class="modal fade" id="addUserModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Add User</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <form id="addUserForm" action="" method="post">
                    @csrf
                    @method('post')
                    <div class="row mb-3">
                        <div class="col-auto flex-auto ">
                            <label for="fname" class="form-label">Firstname</label>
                            <input type="text" class="form-control" id="fname" name="Firstname"
                                placeholder="Firstname">
                        </div>
                        <div class="col-auto flex-auto">
                            <label for="lname" class="form-label">Lastname</label>
                            <input type="text" class="form-control" id="lname" name="Lastname"
                                placeholder="Lastname">
                        </div>
                        <div class="col-auto flex-auto">
                            <label for="mname" class="form-label">Middlename</label>
                            <input type="text" class="form-control" id="mname" name="Middlename"
                                placeholder="Middlename">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="gender">Gender</label>
                            <select class="form-select" name="gender" id="gender">
                                <option value="male">Male</option>
                                <option value="female">Female</option>
                                <option value="others">Others</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="nationality" class="form-label">Nationality</label>
                            <input type="text" class="form-control" id="nationality" name="nationality"
                                placeholder="Nationality">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="address" class="form-label">Email</label>
                            <input type="text" class="form-control" id="address" name="email"
                                placeholder="Address">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="text" class="form-control" id="contact" name="contact"
                                placeholder="Contact">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password"
                                placeholder="Password">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-12 d-flex align-items-center justify-content-end">
                            <button type="submit" id="adduser" class="btn btn-primary">Add</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
