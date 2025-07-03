<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: index.php");
  exit;
}

include "db.php";

$username = $_SESSION['username'];
$role = $_SESSION['role'];


$recentInvoices = [];
$sql = "SELECT * FROM invoices ORDER BY created_at DESC LIMIT 5";
$result = $conn->query($sql);
if ($result && $result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $recentInvoices[] = $row;
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Dashboard</title>
  <style>
    body { font-family: Arial; padding: 40px; background: #f4f4f4; }
    h1, h2 { text-align: center; }
    .dashboard { max-width: 1000px; margin: auto; }
    .button-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
      gap: 20px;
      margin-top: 30px;
    }
    .btn {
      background-color: #007bff;
      color: white;
      padding: 14px;
      border: none;
      border-radius: 6px;
      cursor: pointer;
      text-decoration: none;
      text-align: center;
    }
    .btn:hover { background-color: #0056b3; }
    .user-info {
      text-align: right;
      font-size: 14px;
    }
    .logout-link { color: red; text-decoration: none; margin-left: 10px; }
    .activity {
      background: #fff; padding: 20px; margin-top: 40px; border-radius: 8px;
    }
    .invoice-entry {
      border-bottom: 1px solid #ccc;
      padding-bottom: 10px;
      margin-bottom: 15px;
    }
    .status { font-weight: bold; }
    .status-Approved { color: green; }
    .status-Pending { color: orange; }
    .status-Paid { color: blue; }
  </style>
</head>
<body>

  <div class="dashboard">
    <div class="user-info">
      Logged in as: <strong><?= htmlspecialchars($username) ?></strong> (<?= htmlspecialchars($role) ?>)
      | <a class="logout-link" href="logout.php">Logout</a>
    </div>

    <h1>Vendor Dashboard</h1>

    <div class="button-grid">
      <a href="upload_form.php" class="btn">Add New Invoice</a>
      <button class="btn">Bulk Upload</button>
      <button class="btn">Export Data</button>
      <button class="btn">Add Vendor</button>

      <?php if ($role === 'admin'): ?>
        <button class="btn">Approve Batch</button>
        <button class="btn">Send Reminders</button>
        <button class="btn">Generate Report</button>
        <button class="btn">Process Payment</button>
      <?php endif; ?>
    </div>

    <h2>Recent Activity</h2>
    <div class="activity">
      <?php foreach ($recentInvoices as $invoice): ?>
        <div class="invoice-entry">
          <strong>Invoice #<?= htmlspecialchars($invoice['invoice_id']) ?></strong><br>
          <?= htmlspecialchars($invoice['vendor_name']) ?> – <?= htmlspecialchars($invoice['created_at']) ?><br>
          <span class="status status-<?= $invoice['status'] ?>">
            <?= htmlspecialchars($invoice['status']) ?>
          </span>
        </div>
      <?php endforeach; ?>
    </div>
  </div>

</body>
</html>
