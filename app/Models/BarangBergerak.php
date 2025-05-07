<?php

class BarangBergerak
{
    /**
     * Mendapatkan semua data barang bergerak dengan join ke kategori
     * 
     * @param PDO $conn Koneksi database
     * @return array|string Array data atau pesan error
     */
    public static function getAllData($conn)
    {
        $query = "SELECT b.*, kb.nama_barang, kb.kode_barang, k.nama_kategori
        FROM barang_bergerak b
        LEFT JOIN barang kb ON b.barang_id = kb.id
        LEFT JOIN kategori_barang k ON b.kategori_id = k.id;";

        try {
            $stmt = $conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in BarangBergerak::getAllData - " . $e->getMessage());
            return [];
        }
    }

    /**
     * Menyimpan data baru barang bergerak
     * 
     * @param PDO $conn Koneksi database
     * @param array $data Data barang bergerak
     * @return bool|string True jika berhasil, pesan error jika gagal
     */
    public static function storeData(
        $conn,
        $kode_barang_bergerak,  // Changed from kode_barang_bergerak
        $nama_barang_bergerak,  // Changed from nama_barang_bergerak
        $barang_id,
        $kategori_id
    ) {
        $fields = [
            'kode_barang_bergerak' => $kode_barang_bergerak,
            'nama_barang_bergerak' => $nama_barang_bergerak,
            'barang_id' => $barang_id,
            'kategori_id' => $kategori_id
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO barang_bergerak ($columns) VALUES ($placeholders)";

        try {
            $stmt = $conn->prepare($query);
            return $stmt->execute($fields); // Using execute with array is cleaner
        } catch (PDOException $e) {
            error_log("Error in BarangBergerak::storeData - " . $e->getMessage());
            return false;
        }
    }

    public static function updateData(
        $conn,
        $id,
        $kode_barang_bergerak,  // Changed from kode_barang_bergerak
        $nama_barang_bergerak,  // Changed from nama_barang_bergerak
        $barang_id,
        $kategori_id
    ) {
        $query = "UPDATE barang_bergerak SET
            kode_barang_bergerak = :kode_barang_bergerak,
            nama_barang_bergerak = :nama_barang_bergerak,
            barang_id = :barang_id,
            kategori_id = :kategori_id
        WHERE id = :id";

        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':kode_barang_bergerak', $kode_barang_bergerak);
            $stmt->bindParam(':nama_barang_bergerak', $nama_barang_bergerak);
            $stmt->bindParam(':barang_id', $barang_id);
            $stmt->bindParam(':kategori_id', $kategori_id);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error in BarangBergerak::updateData - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Memperbarui data barang bergerak
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID barang bergerak
     * @param array $data Data yang akan diupdate
     * @return bool|string True jika berhasil, pesan error jika gagal
     */


    /**
     * Menghapus data barang bergerak
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID barang bergerak
     * @return bool|string True jika berhasil, pesan error jika gagal
     */
    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM barang_bergerak WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /**
     * Mendapatkan data barang bergerak berdasarkan ID
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID barang bergerak
     * @return array|false Array data atau false jika tidak ditemukan
     */
    public static function getById($conn, $id)
    {
        $query = "SELECT b.*, kb.nama_barang, kb.kode_barang, k.nama_kategori 
                  FROM barang_bergerak b
                  LEFT JOIN barang kb ON b.barang_id = kb.id
                  LEFT JOIN kategori_barang k ON b.kategori_id = k.id
                  WHERE b.id = :id";

        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in BarangBergerak::getById - " . $e->getMessage());
            return false;
        }
    }
}
