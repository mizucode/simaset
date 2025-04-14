<?php
session_start();
include 'config.php';

$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);

$query = "SELECT * FROM user WHERE username='$username' AND status='aktif'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) === 1) {
    $data = mysqli_fetch_assoc($result);

    if (password_verify($password, $data['password'])) {
        $_SESSION['username'] = $data['username'];
        header("Location: dashboard.php");
        exit;
    } else {
        echo "Password salah!";
    }
} else {
    echo "User tidak ditemukan atau belum aktif!";
}
