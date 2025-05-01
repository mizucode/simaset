<?php
class Lokasi
{
    public static function getAllData($conn)
    {
        $query = "SELECT * FROM lokasi";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }
}
