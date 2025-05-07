<?php

class Lapang
{
    // Ambil semua data lapang
    public static function getAllData($conn)
    {
        $query = "SELECT * FROM lapang";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }

    // Simpan data lapang baru
    public static function storeData(
        $conn,
        $kode_lapang,
        $nama_lapang
    ) {
        $fields = [
            'kode_lapang' => $kode_lapang,
            'nama_lapang' => $nama_lapang
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO lapang ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindParam(":$key", $fields[$key]);
        }

        return $stmt->execute();
    }

    // Update data lapang
    public static function updateData(
        $conn,
        $id,
        $kode_lapang,
        $nama_lapang
    ) {
        $query = "UPDATE lapang SET
            kode_lapang = :kode_lapang,
            nama_lapang = :nama_lapang
            WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':kode_lapang', $kode_lapang);
        $stmt->bindParam(':nama_lapang', $nama_lapang);

        return $stmt->execute();
    }

    // Hapus data lapang
    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM lapang WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
