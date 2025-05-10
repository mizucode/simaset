<?php

class JenisAset
{
    public static function getAllData($conn)
    {
        $query = "SELECT * from jenis_aset";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }
}
