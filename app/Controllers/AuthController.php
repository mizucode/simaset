<?php

require_once __DIR__ . '/../../config/database.php';

class AuthController
{
  public function loginForm()
  {
    if (isset($_SESSION['login'])) {
      header('Location: /admin');
      exit;
    }

    require_once __DIR__ . '/../Views/Pages/Login/index.php';
  }

  public function login()
  {
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
      // Jika sudah login, redirect ke /admin
      if (isset($_SESSION['login'])) {
        header('Location: /admin');
        exit;
      }
      // Jika belum login, redirect ke form login
      header('Location: /login');
      exit;
    }

    global $conn;

    $username = $_POST['username'];
    $password = $_POST['password'];
    $ip_address = $_SERVER['REMOTE_ADDR'];

    // Validasi CSRF token
    if (!isset($_POST['csrf_token']) || !isset($_SESSION['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
      $_SESSION['error'] = "Permintaan tidak valid (CSRF token salah). Silakan refresh halaman.";
      header('Location: /');
      exit;
    }

    // Validasi captcha
    if (!isset($_POST['captcha']) || !isset($_SESSION['captcha']) || strtolower($_POST['captcha']) !== strtolower($_SESSION['captcha'])) {
      $_SESSION['error'] = "Kode captcha salah!";
      header('Location: /');
      exit;
    }
    unset($_SESSION['captcha']); // Hapus captcha setelah dicek

    // Proteksi brute force: cek percobaan gagal dalam 10 menit terakhir
    $limit = 5;
    $interval = 10; // menit
    $stmt = $conn->prepare("SELECT COUNT(*) FROM login_attempts WHERE (username = :username OR ip_address = :ip) AND attempt_time > (NOW() - INTERVAL :interval MINUTE)");
    $stmt->execute([
      'username' => $username,
      'ip' => $ip_address,
      'interval' => $interval
    ]);
    $attempts = $stmt->fetchColumn();

    if ($attempts >= $limit) {
      $_SESSION['error'] = "Terlalu banyak percobaan login gagal. Silakan coba lagi dalam $interval menit.";
      header('Location: /');
      exit;
    }

    $stmt = $conn->prepare("SELECT * FROM user WHERE username = :username LIMIT 1");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
      // Proteksi anti session hijacking
      session_regenerate_id(true);
      $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
      $_SESSION['user_ip'] = $_SERVER['REMOTE_ADDR'];
      $_SESSION['login'] = true;
      $_SESSION['user'] = $user;
      // Hapus percobaan gagal jika login sukses
      $stmt = $conn->prepare("DELETE FROM login_attempts WHERE username = :username OR ip_address = :ip");
      $stmt->execute(['username' => $username, 'ip' => $ip_address]);
      // Catat log login
      $stmt = $conn->prepare("INSERT INTO audit_login (username, ip_address, user_agent, aktivitas) VALUES (:username, :ip, :agent, 'login')");
      $stmt->execute([
        'username' => $username,
        'ip' => $ip_address,
        'agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
      ]);
      header('Location: /admin');
      exit;
    }

    // Catat percobaan gagal
    $stmt = $conn->prepare("INSERT INTO login_attempts (username, ip_address) VALUES (:username, :ip)");
    $stmt->execute(['username' => $username, 'ip' => $ip_address]);

    $_SESSION['error'] = "Username atau Password Salah!";
    header('Location: /');
    exit;
  }

  public function adduser()
  {
    global $conn;

    $username = 'yogi';
    $plain_password = 'akuatmin';
    $email = 'admigiugiuun@example.com';
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
    global $conn;
    if (isset($_SESSION['user']['username'])) {
      $stmt = $conn->prepare("INSERT INTO audit_login (username, ip_address, user_agent, aktivitas) VALUES (:username, :ip, :agent, 'logout')");
      $stmt->execute([
        'username' => $_SESSION['user']['username'],
        'ip' => $_SERVER['REMOTE_ADDR'],
        'agent' => $_SERVER['HTTP_USER_AGENT'] ?? ''
      ]);
    }
    session_destroy();
    header('Location: /');
    exit;
  }
}
