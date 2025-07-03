<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Upload Invoice</title>
</head>
<body>
  <h2>Upload New Invoice</h2>
  <form method="POST" action="upload_invoice.php">
    <input type="text" name="invoice_id" placeholder="Invoice ID" required><br><br>
    <input type="text" name="vendor" placeholder="Vendor Name" required><br><br>
    <select name="status" required>
      <option value="Pending">Pending</option>
      <option value="Approved">Approved</option>
      <option value="Paid">Paid</option>
    </select><br><br>
    <button type="submit">Upload</button>
  </form>
</body>
</html>
