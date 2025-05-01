<?php

class Tanah
{
    // Method untuk mengambil semua data barang
    public static function getAllData($conn)
    {
        $query = "SELECT * FROM tanah";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }

    // Method untuk menyimpan data barang baru
    public static function storeData(
        $conn,
        $lokasi_id,
        $kode_tanah,
        $nama_tanah
    ) {
        $fields = [
            'lokasi_id' => $lokasi_id,
            'kode_tanah' => $kode_tanah,
            'nama_tanah' => $nama_tanah
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO tanah ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindParam(":$key", $fields[$key]);
        }

        return $stmt->execute();
    }

    // Method untuk memperbarui data barang
    public static function updateData(
        $conn,
        $id,
        $lokasi_id,
        $kode_tanah,
        $nama_tanah
    ) {
        $query = "UPDATE tanah SET
            lokasi_id = :lokasi_id,
            kode_tanah = :kode_tanah
            WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':lokasi_id', $lokasi_id);
        $stmt->bindParam(':kode_tanah', $kode_tanah);
        $stmt->bindParam(':nama_tanah', $nama_tanah);

        return $stmt->execute();
    }

    // Method untuk menghapus data barang
    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM barang WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
