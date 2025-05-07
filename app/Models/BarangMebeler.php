<?php

class BarangMebeler
{
    /**
     * Mendapatkan semua data barang mebeler dengan join ke kategori
     * 
     * @param PDO $conn Koneksi database
     * @return array|string Array data atau pesan error
     */
    public static function getAllData($conn)
    {
        $query = "SELECT b.*, kb.nama_barang, kb.kode_barang, k.nama_kategori
        FROM barang_mebeler b
        LEFT JOIN barang kb ON b.barang_id = kb.id
        LEFT JOIN kategori_barang k ON b.kategori_id = k.id;";

        try {
            $stmt = $conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in BarangMebeler::getAllData - " . $e->getMessage());
            return [];
        }
    }


    /**
     * Menyimpan data baru barang mebeler
     * 
     * @param PDO $conn Koneksi database
     * @param array $data Data barang mebeler
     * @return bool|string True jika berhasil, pesan error jika gagal
     */
    public static function storeData(
        $conn,
        $kode_barang_mebeler,  // Changed from kode_barang_mebeler
        $nama_barang_mebeler,  // Changed from nama_barang_mebeler
        $barang_id,
        $kategori_id
    ) {
        $fields = [
            'kode_barang_mebeler' => $kode_barang_mebeler,
            'nama_barang_mebeler' => $nama_barang_mebeler,
            'barang_id' => $barang_id,
            'kategori_id' => $kategori_id
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO barang_mebeler ($columns) VALUES ($placeholders)";

        try {
            $stmt = $conn->prepare($query);
            return $stmt->execute($fields); // Using execute with array is cleaner
        } catch (PDOException $e) {
            error_log("Error in BarangMebeler::storeData - " . $e->getMessage());
            return false;
        }
    }

    public static function updateData(
        $conn,
        $id,
        $kode_barang_mebeler,  // Changed from kode_barang_mebeler
        $nama_barang_mebeler,  // Changed from nama_barang_mebeler
        $barang_id,
        $kategori_id
    ) {
        $query = "UPDATE barang_mebeler SET
            kode_barang_mebeler = :kode_barang_mebeler,
            nama_barang_mebeler = :nama_barang_mebeler,
            barang_id = :barang_id,
            kategori_id = :kategori_id
        WHERE id = :id";

        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':kode_barang_mebeler', $kode_barang_mebeler);
            $stmt->bindParam(':nama_barang_mebeler', $nama_barang_mebeler);
            $stmt->bindParam(':barang_id', $barang_id);
            $stmt->bindParam(':kategori_id', $kategori_id);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error in BarangMebeler::updateData - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Memperbarui data barang mebeler
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID barang mebeler
     * @param array $data Data yang akan diupdate
     * @return bool|string True jika berhasil, pesan error jika gagal
     */


    /**
     * Menghapus data barang mebeler
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID barang mebeler
     * @return bool|string True jika berhasil, pesan error jika gagal
     */
    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM barang_mebeler WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /**
     * Mendapatkan data barang mebeler berdasarkan ID
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID barang mebeler
     * @return array|false Array data atau false jika tidak ditemukan
     */
    public static function getById($conn, $id)
    {
        $query = "SELECT b.*, kb.nama_barang, kb.kode_barang, k.nama_kategori 
                  FROM barang_mebeler b
                  LEFT JOIN barang kb ON b.barang_id = kb.id
                  LEFT JOIN kategori_barang k ON b.kategori_id = k.id
                  WHERE b.id = :id";

        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in Barangmebeler::getById - " . $e->getMessage());
            return false;
        }
    }
}
