<?php

require_once __DIR__ . '/../../config/database.php';

class AuthController
{
    public function loginForm()
    {
        // Kalau sudah login langsung ke /admin
        if (isset($_SESSION['login'])) {
            header('Location: /admin');
            exit;
        }

        // View form login
        require_once __DIR__ . '/../Views/Pages/Login/index.php';
    }

    public function login()
    {
        global $conn;

        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username LIMIT 1");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Bandingkan password biasa
            if ($password == $user['password']) {
                // Kalau kamu pakai password_hash() di database, ganti dengan:
                // if (password_verify($password, $user['password']))

                $_SESSION['login'] = true;
                $_SESSION['user'] = $user;
                header('Location: /admin');
                exit;
            }
        }

        $_SESSION['error'] = "Username atau Password Salah!";
        header('Location: /');
        exit;
    }

    public function logout()
    {
        session_destroy();
        header('Location: /');
        exit;
    }
}
