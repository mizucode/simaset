<?php
session_start();
include 'config.php';

// Validasi input
if (empty($_POST['username']) || empty($_POST['password'])) {
    $_SESSION['error'] = "Username dan password harus diisi";
    header("Location: login.php");
    exit;
}

$username = $_POST['username'];
$password = $_POST['password'];

// Gunakan prepared statement untuk keamanan
$query = "SELECT * FROM user WHERE username = ? AND status = 'aktif' LIMIT 1";
$stmt = mysqli_prepare($conn, $query);
mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) === 1) {
    $data = mysqli_fetch_assoc($result);

    // Verifikasi password
    if (password_verify($password, $data['password'])) {
        // Regenerasi session ID untuk mencegah fixation
        session_regenerate_id(true);

        // Set session variables
        $_SESSION['logged_in'] = true;
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['username'] = $data['username'];
        $_SESSION['user_data'] = $data;

        // Redirect ke dashboard
        header("Location: dashboard.php");
        exit;
    } else {
        $_SESSION['error'] = "Password salah!";
        header("Location: login.php");
        exit;
    }
} else {
    $_SESSION['error'] = "User tidak ditemukan atau belum aktif!";
    header("Location: login.php");
    exit;
}

// Tutup statement
mysqli_stmt_close($stmt);
