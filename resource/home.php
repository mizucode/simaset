<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include 'auth.php'; // Mengimpor file auth.php

checkLogin(); // Memeriksa apakah pengguna sudah login
$error = processLogin(); // Memproses login
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
</head>

<body>
  <h2>Login</h2>
  <form action="home.php" method="POST"> <!-- Form mengirim data ke home.php -->
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <button type="submit">Masuk</button>
  </form>
  <?php if (isset($error)): ?>
    <p style="color: red;"><?php echo $error; ?></p>
  <?php endif; ?>
</body>

</html>