<?php

class Ruang
{
    public static function getAllData($conn)
    {
        $query = "SELECT r.*, g.nama_gedung 
                   FROM ruang r
          JOIN gedung g ON r.gedung_id = g.id";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }

    public static function storeData(
        $conn,
        $kode_ruang,
        $nama_ruang,
        $gedung_id
    ) {
        $fields = [
            'kode_ruang' => $kode_ruang,
            'nama_ruang' => $nama_ruang,
            'gedung_id' => $gedung_id

        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO ruang ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }


        return $stmt->execute();
    }

    public static function updateData(
        $conn,
        $id,
        $kode_ruang,
        $nama_ruang,
        $gedung_id,
    ) {
        $query = "UPDATE ruang SET 
            kode_ruang = :kode_ruang,
            nama_ruang = :nama_ruang, 
            gedung_id = :gedung_id
            WHERE id = :id";
        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':kode_ruang', $kode_ruang);
        $stmt->bindParam(':nama_ruang', $nama_ruang);
        $stmt->bindParam(':gedung_id', $gedung_id);

        return $stmt->execute();
    }



    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM ruang WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
