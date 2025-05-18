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

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['login'] = true;
            $_SESSION['user'] = $user;
            header('Location: /admin');
            exit;
        }

        $_SESSION['error'] = "Username atau Password Salah!";
        header('Location: /');
        exit;
    }


    public function adduser()
    {
        global $conn;

        // Untuk menambahkan admin baru
        $username = 'admin';
        $plain_password = 'akuatmin';
        $email = 'admin@example.com';

        // Pastikan pakai password_hash
        $hashed_password = password_hash($plain_password, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO user (username, password, email, status, role) VALUES (:username, :password, :email, 'disetujui', 'admin')");
        $stmt->execute([
            'username' => $username,
            'password' => $hashed_password,
            'email' => $email
        ]);

        echo "Admin berhasil ditambahkan!";
    }




    public function logout()
    {
        session_destroy();
        header('Location: /');
        exit;
    }
}
