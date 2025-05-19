<?php
require_once __DIR__ . '/../../config/database.php';

// Data admin yang akan ditambahkan
$username = 'admin';  // Ganti dengan username yang diinginkan
$plain_password = 'prasarana';  // Ganti dengan password yang diinginkan

// Hash password menggunakan bcrypt
$hashed_password = password_hash($plain_password, PASSWORD_BCRYPT);

try {
    global $conn;

    // Query untuk menambahkan admin
    $stmt = $conn->prepare("INSERT INTO user (username, password) VALUES (:username, :password)");
    $stmt->execute([
        'username' => $username,
        'password' => $hashed_password
    ]);

    echo "Admin berhasil ditambahkan!";
    echo "<br>Username: " . $username;
    echo "<br>Password: " . $plain_password;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
