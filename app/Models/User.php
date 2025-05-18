<?php


class User
{
    private $conn;

    public function __construct()
    {
        global $conn;
        $this->conn = $conn;
    }

    /**
     * Tambah user admin baru
     * 
     * @param string $username
     * @param string $plainPassword
     * @return bool|string Return true jika berhasil, error message jika gagal
     */
    public function addAdminUser($username, $plainPassword, $email = null)
    {
        try {
            $hashedPassword = password_hash($plainPassword, PASSWORD_BCRYPT);

            $stmt = $this->conn->prepare("INSERT INTO user (username, password, email) VALUES (:username, :password, :email)");
            $stmt->execute([
                'username' => $username,
                'password' => $hashedPassword,
                'email' => $email ?? $username . '@example.com' // Default email jika tidak disediakan
            ]);

            return true;
        } catch (PDOException $e) {
            error_log("Error adding admin user: " . $e->getMessage());
            return $e->getMessage();
        }
    }
}
