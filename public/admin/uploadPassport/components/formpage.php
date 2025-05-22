<div class="container-sm" style="min-height:50vh; max-width:50rem">
    <div id="formpage">
        <div class="row w-100 d-flex" >
            <div class="col-auto flex-fill p-3">
                <form autocomplete="off" id="passport_form" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="customer_id" class="form-label">Customer</label>
                        <select class="form-select" id="customer_id" name="customer_id" required>
                            <option value="">Select Customer</option>
                            <?php
                            // Replace these with your actual DB connection values
                            $conn = new mysqli("localhost", "root", "", "core2");

                            if ($conn->connect_error) {
                                die("Connection failed: " . $conn->connect_error);
                            }

                            // Assuming your table is called 'customers' with columns 'id' and 'name'
                            $result = $conn->query("SELECT id, first_name, last_name FROM customers ORDER BY last_name ASC");

                            if ($result->num_rows > 0) {
                                while($row = $result->fetch_assoc()){
                                    echo "<option value='" . $row['id'] . "'>" . htmlspecialchars($row['first_name']). ' ' . htmlspecialchars($row['last_name']) . "</option>";
                                }
                            } else {
                                echo "<option value=''>No customers found</option>";
                            }

                            $conn->close();
                            ?>
                        </select>
                    </div>

                    <div class="row mb-3 gap-3">
                        <div class="col-auto flex-fill">
                            <label for="passport_type" class="form-label">Passport Type</label>
                            <select class="form-select" id="passport_type" required>
                                <option value="">Select Here Passport</option>
                                <option value="P">Ordinary Passport</option>
                                <option value="D">Diplomatic Passport</option>
                                <option value="O">Official Passport</option>
                                <option value="S">Service Passport</option>
                            </select>
                        </div>
                        <div class="col-auto flex-fill">
                            <label for="passport_number" class="form-label">Passport Number</label>
                            <input id="passport_number" type="text" class="form-control" placeholder="Passport Number" required>
                        </div>
                    </div>
                    <div class="row mb-3 gap-3">
                        <div class="col-auto flex-fill">
                            <label for="issued_date" class="form-label">Issued Date</label>
                            <input id="issued_date" type="date" class="form-control" required>
                        </div>
                        <div class="col-auto flex-fill">
                            <label for="expiry_date" class="form-label">Expiry Date</label>
                            <input id="expiry_date" type="date" class="form-control" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="Input_file_passport" class="form-label">Passport Picture: Front/Back/Single Picture</label>
                        <input class="form-control" type="file" id="Input_file_passport" required accept="image/*">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="lastpage" style="display:none">
        <div class="row w-100 d-flex align-items-center justify-content-center">
            <div class="col-auto p-3 text-center d-flex flex-column justify-content-center">
                <div class="header">
                    <h1>Application Status</h1>
                </div>
                <div class="content">
                    <div class="container">
                        <div class="icon" style="font-size: 50px;">✔️</div>
                        <div class="message">The document was submitted and is waiting for approval. We will notify you once done.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
