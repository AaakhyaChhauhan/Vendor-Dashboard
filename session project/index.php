<?php session_start(); ?>
<!DOCTYPE html>
<html>
<head><title>Login</title></head>
<body>
  <h2>Login Page</h2>
  <form method="POST" action="login.php">
    <input type="text" name="username" placeholder="Username" required><br><br>
    <input type="password" name="password" placeholder="Password" required><br><br>
    <button type="submit">Login</button>
  </form>
</body>
</html>
