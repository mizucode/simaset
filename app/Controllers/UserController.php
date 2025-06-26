<?php
require_once __DIR__ . '/../../config/database.php';

class UserController
{
  public function index()
  {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'superadmin') {
      header('Location: /admin');
      exit;
    }
    global $conn;
    $stmt = $conn->query("SELECT * FROM user");
    $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
    require __DIR__ . '/../Views/Pages/User/index.php';
  }

  public function create()
  {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'superadmin') {
      header('Location: /admin');
      exit;
    }
    require __DIR__ . '/../Views/Pages/User/create.php';
  }

  public function store()
  {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'superadmin') {
      header('Location: /admin');
      exit;
    }
    global $conn;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    $stmt = $conn->prepare("INSERT INTO user (username, password, email, status, role) VALUES (:username, :password, :email, 'disetujui', :role)");
    $stmt->execute([
      'username' => $username,
      'password' => $password,
      'email' => $email,
      'role' => $role
    ]);
    header('Location: /admin/user');
    exit;
  }

  public function edit($id)
  {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'superadmin') {
      header('Location: /admin');
      exit;
    }
    global $conn;
    $stmt = $conn->prepare("SELECT * FROM user WHERE id = :id");
    $stmt->execute(['id' => $id]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    require __DIR__ . '/../Views/Pages/User/edit.php';
  }

  public function update($id)
  {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'superadmin') {
      header('Location: /admin');
      exit;
    }
    global $conn;
    $username = $_POST['username'];
    $email = $_POST['email'];
    $role = $_POST['role'];
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    if (!empty($password)) {
      $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
      $stmt = $conn->prepare("UPDATE user SET username = :username, email = :email, role = :role, password = :password WHERE id = :id");
      $stmt->execute([
        'username' => $username,
        'email' => $email,
        'role' => $role,
        'password' => $hashedPassword,
        'id' => $id
      ]);
    } else {
      $stmt = $conn->prepare("UPDATE user SET username = :username, email = :email, role = :role WHERE id = :id");
      $stmt->execute([
        'username' => $username,
        'email' => $email,
        'role' => $role,
        'id' => $id
      ]);
    }
    header('Location: /admin/user');
    exit;
  }

  public function delete($id)
  {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'superadmin') {
      header('Location: /admin');
      exit;
    }
    global $conn;
    $stmt = $conn->prepare("DELETE FROM user WHERE id = :id");
    $stmt->execute(['id' => $id]);
    header('Location: /admin/user');
    exit;
  }

  public function auditLogin()
  {
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'superadmin') {
      header('Location: /admin');
      exit;
    }
    global $conn;
    $stmt = $conn->query("SELECT * FROM audit_login ORDER BY waktu DESC LIMIT 50");
    $logs = $stmt->fetchAll(PDO::FETCH_ASSOC);
    require __DIR__ . '/../Views/Pages/User/audit_login.php';
  }
}
