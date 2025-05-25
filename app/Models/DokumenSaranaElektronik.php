<?php

class DokumenSaranaElektronik
{
    /**
     * Mengambil semua data dokumen (file) untuk sarana elektronik.
     * 
     * @param PDO $conn Koneksi database
     * @param int|null $aset_elektronik_id ID sarana elektronik (opsional, untuk filter)
     * @return array|string Array data dokumen atau pesan error
     */
    public static function getAllData($conn, $aset_elektronik_id = null)
    {
        // Tabel untuk dokumen file (PDF, DOC, dll.)
        $query = "SELECT * FROM dokumen_sarana_elektronik";
        if ($aset_elektronik_id) {
            // Foreign key disesuaikan menjadi aset_elektronik_id
            $query .= " WHERE aset_elektronik_id = :aset_elektronik_id";
        }

        $stmt = $conn->prepare($query);
        if ($aset_elektronik_id) {
            $stmt->bindParam(':aset_elektronik_id', $aset_elektronik_id);
        }

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in DokumenSaranaElektronik::getAllData - " . $e->getMessage());
            return []; // Kembalikan array kosong jika error
        }
    }

    /**
     * Menghapus data dokumen (file) berdasarkan ID dokumen.
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID dokumen
     * @return bool True jika berhasil, false jika gagal
     */
    public static function delete($conn, $id)
    {
        // Tabel untuk dokumen file
        $query = "DELETE FROM dokumen_sarana_elektronik WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error in DokumenSaranaElektronik::delete - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Menghapus data dokumentasi/gambar berdasarkan ID gambar.
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID gambar/dokumentasi
     * @return bool True jika berhasil, false jika gagal
     */
    public static function deleteGambar($conn, $id)
    {
        // Tabel untuk dokumentasi/gambar
        $query = "DELETE FROM dokumentasi_sarana_elektronik WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error in DokumenSaranaElektronik::deleteGambar - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Mengambil data dokumen (file) berdasarkan ID dokumen.
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID dokumen
     * @return array|false Data dokumen atau false jika tidak ditemukan/error
     */
    public static function getDokumenById($conn, $id)
    {
        // Tabel untuk dokumen file
        $query = "SELECT * FROM dokumen_sarana_elektronik WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in DokumenSaranaElektronik::getDokumenById - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Menyimpan data dokumen (file) baru untuk sarana elektronik.
     * 
     * @param PDO $conn Koneksi database
     * @param int $aset_elektronik_id ID sarana elektronik terkait
     * @param string $nama_dokumen Nama dokumen
     * @param string $path_dokumen Path file dokumen
     * @return bool True jika berhasil, false jika gagal
     */
    public static function storeDokumen( // Mengganti nama dari storeDokumenATK
        $conn,
        $aset_elektronik_id, // Disesuaikan menjadi aset_elektronik_id
        $nama_dokumen,
        $path_dokumen
    ) {
        $fields = [
            'aset_elektronik_id' => $aset_elektronik_id, // Disesuaikan
            'nama_dokumen' => $nama_dokumen,
            'path_dokumen' => $path_dokumen
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        // Tabel untuk dokumen file
        $query = "INSERT INTO dokumen_sarana_elektronik ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        // Menggunakan execute dengan array lebih ringkas dan aman
        try {
            return $stmt->execute($fields);
        } catch (PDOException $e) {
            error_log("Error in DokumenSaranaElektronik::storeDokumen - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Menyimpan data dokumentasi/gambar baru untuk sarana elektronik.
     * 
     * @param PDO $conn Koneksi database
     * @param int $aset_elektronik_id ID sarana elektronik terkait
     * @param string $nama_dokumen Nama dokumentasi/gambar
     * @param string $path_dokumen Path file dokumentasi/gambar
     * @return bool True jika berhasil, false jika gagal
     */
    public static function storeDokumentasi( // Mengganti nama dari storeDokumentasiATK
        $conn,
        $aset_elektronik_id, // Disesuaikan menjadi aset_elektronik_id
        $nama_dokumen, // Bisa juga dinamai $nama_gambar
        $path_dokumen  // Bisa juga dinamai $path_gambar
    ) {
        $fields = [
            'aset_elektronik_id' => $aset_elektronik_id, // Disesuaikan
            'nama_dokumen' => $nama_dokumen, // Atau nama_gambar
            'path_dokumen' => $path_dokumen  // Atau path_gambar
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        // Tabel untuk dokumentasi/gambar
        $query = "INSERT INTO dokumentasi_sarana_elektronik ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        try {
            return $stmt->execute($fields);
        } catch (PDOException $e) {
            error_log("Error in DokumenSaranaElektronik::storeDokumentasi - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Mengambil semua data dokumentasi/gambar untuk sarana elektronik.
     * 
     * @param PDO $conn Koneksi database
     * @param int|null $aset_elektronik_id ID sarana elektronik (opsional, untuk filter)
     * @return array|string Array data gambar atau pesan error
     */
    public static function getAllDataGambar($conn, $aset_elektronik_id = null)
    {
        // Tabel untuk dokumentasi/gambar
        $query = "SELECT * FROM dokumentasi_sarana_elektronik";
        if ($aset_elektronik_id) {
            // Foreign key disesuaikan menjadi aset_elektronik_id
            $query .= " WHERE aset_elektronik_id = :aset_elektronik_id";
        }

        $stmt = $conn->prepare($query);
        if ($aset_elektronik_id) {
            $stmt->bindParam(':aset_elektronik_id', $aset_elektronik_id);
        }

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in DokumenSaranaElektronik::getAllDataGambar - " . $e->getMessage());
            return []; // Kembalikan array kosong jika error
        }
    }

    /**
     * Mengambil data dokumentasi/gambar berdasarkan ID gambar.
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID gambar/dokumentasi
     * @return array|false Data gambar atau false jika tidak ditemukan/error
     */
    public static function getDokumenGambarById($conn, $id)
    {
        // Tabel untuk dokumentasi/gambar
        $query = "SELECT * FROM dokumentasi_sarana_elektronik WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in DokumenSaranaElektronik::getDokumenGambarById - " . $e->getMessage());
            return false;
        }
    }

    // Method tambahan yang mungkin berguna (dipanggil dari controller sebelumnya)
    // Untuk menghapus semua dokumen terkait satu sarana (jika diperlukan saat menghapus sarana induk)
    public static function deleteAllBySaranaId($conn, $aset_elektronik_id)
    {
        $query = "DELETE FROM dokumen_sarana_elektronik WHERE aset_elektronik_id = :aset_elektronik_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':aset_elektronik_id', $aset_elektronik_id);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error in DokumenSaranaElektronik::deleteAllBySaranaId - " . $e->getMessage());
            return false;
        }
    }

    // Untuk menghapus semua gambar terkait satu sarana
    public static function deleteAllGambarBySaranaId($conn, $aset_elektronik_id)
    {
        $query = "DELETE FROM dokumentasi_sarana_elektronik WHERE aset_elektronik_id = :aset_elektronik_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':aset_elektronik_id', $aset_elektronik_id);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error in DokumenSaranaElektronik::deleteAllGambarBySaranaId - " . $e->getMessage());
            return false;
        }
    }
}
