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
        require_once __DIR__ . '/../Views/login.php';
    }


    public function login()
    {
        global $conn;

        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM user WHERE username='$username' LIMIT 1";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) == 1) {
            $user = mysqli_fetch_assoc($result);

            if ($password == $user['password']) {
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
