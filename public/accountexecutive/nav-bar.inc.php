<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
?>

<div class="col-md-2 sidebar p-3">
  <div class="text-center mb-4">
    <img src="<?= BASE_URL ?>/home/images/logo.jpg" alt="Logo" style="max-height: 140px;">
    <h6>Travel and Tours</h6>
    <small class="text-muted"><?= ucfirst($role) ?> Panel</small>
    <div class="mt-3">
      <strong><?= ucfirst($username) ?></strong><br>
      <small class="text-muted"><?= ucfirst($role) ?></small>
    </div>
  </div>

  <nav class="nav flex-column">
    <a class="nav-link" href="<?= BASE_URL ?>home/index.php">
      <i class="bi bi-speedometer2 me-2"></i>Dashboard
    </a>
    <a class="nav-link" href="<?= BASE_URL ?>home/public/client.php">
      <i class="bi bi-people me-2"></i>Client Management
    </a>
    <a class="nav-link" href="<?= BASE_URL ?>home/public/quotations.php">
      <i class="bi bi-file-earmark-text me-2"></i>Quotations
    </a>
    <a class="nav-link" href="<?= BASE_URL ?>home/public/booking.php">
      <i class="bi bi-calendar-check me-2"></i>Booking Management
    </a>
    <a class="nav-link" href="<?= BASE_URL ?>home/public/payment.php">
      <i class="bi bi-credit-card me-2"></i>Payment Processing
    </a>
    <a class="nav-link" href="<?= BASE_URL ?>home/public/reports.php">
      <i class="bi bi-graph-up me-2"></i>Reports & Analytics
    </a>
    <a class="nav-link" href="<?= BASE_URL ?>home/public/followup.php">
      <i class="bi bi-headset me-2"></i>Follow-up Service
    </a>
    <a class="nav-link" href="<?= BASE_URL ?>home/public/documents.php">
      <i class="bi bi-folder me-2"></i>Document Support
    </a>
    <form class="" action="<?= BASE_URL ?>/util/process_logout.php" method='POST'>
      <button data-mdb-button-init data-mdb-ripple-init class="btn btn-danger btn-block fa-lg gradient-custom-2 mb-3" type="submit">Log Out</button>
    </form>
  </nav>
</div>