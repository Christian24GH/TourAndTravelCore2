<div class="col-md-2 sidebar p-3">
      <div class="text-center mb-4">
        <img src="<?php echo $server_url?>/admin/global/icons/logo.jpg" class="img-fluid" alt="Logo">
        <h6>Travel and Tours</h6>
        <small>Admin Panel</small>
        <div class="mt-3">
          <strong>Admin name</strong><br>
          <small class="text-muted">Position title</small>
        </div>
      </div>
      <a class="nav-link" href="<?php echo $server_url?>" style="color:var(--bs-link-color);">Dashboard</a>
      <nav class="nav flex-column">

        <p class="mt-4">Passport Verification</p>
        <a class="nav-link" href="<?php echo "$server_url/admin/passportInfo/index.php"?>">Passport Information</a>
        <a class="nav-link" href="<?php echo "$server_url/admin/uploadPassport/index.php"?>">Upload Passport</a>
        <a class="nav-link" href="<?php echo "$server_url/admin/apptrack/index.php"?>">Passport Tracking</a>
        <a class="nav-link" href="<?php echo "$server_url/admin/ticket/index.php"?>">Issued Tickets</a>

        <p class="mt-4">Customer Relation</p>
        <a class="nav-link " href="<?php echo $server_url.'/crm/customers' ?>">Customers</a>
        <a class="nav-link " href="<?php echo $server_url.'/crm/notes'?>">Notes</a>
        <a class="nav-link" href="<?php echo $server_url.'/crm/logs'?>">Logs</a>
        <a class="nav-link" href="<?php echo $server_url.'/crm/issues'?>">Issues and Complaints</a>

        <p class="mt-4">Schedule and Rates</p>
        <a class="nav-link" href="<?php echo $server_url.'/sr/schedule/index'?>">Schedule</a>
        <a class="nav-link" href="<?php echo $server_url.'/sr/rates/index'?>">Rates</a>
      </nav>
</div>