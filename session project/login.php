<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  if ($username === 'admin' && $password === '1234') {
    $_SESSION['username'] = 'admin';
    $_SESSION['role'] = 'admin';
  } elseif ($username === 'user' && $password === 'user') {
    $_SESSION['username'] = 'user';
    $_SESSION['role'] = 'user';
  } else {
    echo "<script>alert('Invalid login'); window.location.href='index.php';</script>";
    exit;
  }

  header("Location: dashboard.php");
  exit;
}
?>
