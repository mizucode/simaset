<?php

class KategoriBarang
{
    public static function getAllData($conn)
    {
        $query = "SELECT id, nama_kategori FROM kategori_barang ORDER BY nama_kategori ASC";

        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getAllData: " . $e->getMessage());
            return [];
        }
    }
}
