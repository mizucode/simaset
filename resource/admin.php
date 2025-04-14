<?php
session_start();

// Cek apakah pengguna sudah login dan sesi masih valid
if (!isset($_SESSION['username']) || (time() - $_SESSION['login_time']) > 3600) {
    // Jika tidak login atau sesi sudah lebih dari 1 jam, arahkan ke login
    header("Location: /resources/home.php"); // Arahkan ke home.php di folder resources
    exit();
}

// Perbarui waktu login
$_SESSION['login_time'] = time();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Page</title>
</head>

<body>
    <h2>Welcome to Admin Page</h2>
    <p>Hello, <?php echo $_SESSION['username']; ?>!</p>
    <p>This is a protected area only for administrators.</p>
    <a href="logout.php">Logout</a>
</body>

</html>