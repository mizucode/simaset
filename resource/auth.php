<?php
session_start();

function checkLogin()
{
    // Jika pengguna sudah login, arahkan ke halaman admin
    if (isset($_SESSION['username'])) {
        header("Location: /resource/admin.php"); // Arahkan ke admin.php di root
        exit();
    }
}

function processLogin()
{
    // Proses login jika metode request adalah POST
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        // Cek kredensial (contoh: username = mizu, password = mizu)
        if ($username === 'mizu' && $password === 'mizu') {
            // Set sesi
            $_SESSION['username'] = $username;
            $_SESSION['login_time'] = time(); // Waktu login
            header("Location: /resource/admin.php"); // Arahkan ke admin.php di root
            exit();
        } else {
            // Jika kredensial salah, kembalikan pesan kesalahan
            return "Username atau password salah!";
        }
    }
}
