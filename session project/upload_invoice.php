<?php
session_start();
include "db.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $invoice_id = $_POST['invoice_id'];
  $vendor = $_POST['vendor'];
  $status = $_POST['status'];
  $uploaded_by = $_SESSION['username'];

  $stmt = $conn->prepare("INSERT INTO invoices (invoice_id, vendor_name, status, uploaded_by) VALUES (?, ?, ?, ?)");
  $stmt->bind_param("ssss", $invoice_id, $vendor, $status, $uploaded_by);

  if ($stmt->execute()) {
    header("Location: dashboard.php");
  } else {
    echo "Error: " . $stmt->error;
  }
}
?>
