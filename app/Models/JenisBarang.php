<?php

class JenisBarang
{
    /**
     * Mendapatkan semua data barang elektronik dengan join ke tabel terkait
     * 
     * @param PDO $conn Koneksi database
     * @return array|string Array data atau pesan error
     */
    public static function getAllData($conn)
    {
        $query = "SELECT b.*, kb.nama_kategori 
              FROM barang b
              LEFT JOIN kategori_barang kb ON b.kategori_id = kb.id
              ORDER BY kb.nama_kategori ASC";

        try {
            $stmt = $conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in JenisBarang::getAllData - " . $e->getMessage());
            return [];
        }
    }


    /**
     * Menyimpan data baru barang elektronik
     * 
     * @param PDO $conn Koneksi database
     * @param array $data Data barang elektronik
     * @return bool|string True jika berhasil, pesan error jika gagal
     */
    public static function storeData(
        $conn,
        $kode_barang,
        $nama_barang,
        $kategori_id,

    ) {
        $fields = [
            'kode_barang' => $kode_barang,
            'nama_barang' => $nama_barang,
            'kategori_id' => $kategori_id
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO barang ($columns) VALUES ($placeholders)";

        try {
            $stmt = $conn->prepare($query);
            return $stmt->execute($fields);
        } catch (PDOException $e) {
            error_log("Error in JenisBarang::storeData - " . $e->getMessage());
            return false;
        }
    }

    public static function updateData(
        $conn,
        $id,
        $kode_barang,
        $nama_barang,
        $kategori_id
    ) {
        $fields = [
            'kode_barang' => $kode_barang,
            'nama_barang' => $nama_barang,
            'kategori_id' => $kategori_id
        ];

        $setClause = implode(', ', array_map(function ($key) {
            return "$key = :$key";
        }, array_keys($fields)));

        $query = "UPDATE barang SET $setClause WHERE id = :id";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    /**
     * Menghapus data barang elektronik
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID barang elektronik
     * @return bool|string True jika berhasil, pesan error jika gagal
     */
    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM barang WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /**
     * Mendapatkan data barang berdasarkan ID
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID barang
     * @return array|false Array data atau false jika tidak ditemukan
     */
    public static function getById($conn, $id)
    {
        $query = "SELECT b.*, 
             kb.nama_kategori
             FROM barang b
             LEFT JOIN kategori_barang kb ON b.kategori_id = kb.id
             WHERE b.id = :id";

        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in JenisBarang::getById - " . $e->getMessage());
            return false;
        }
    }
}
