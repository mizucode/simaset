<?php

class DokumenAsetLapang
{
    public static function getAllData($conn)
    {
        $query = "SELECT * FROM dokumen_aset_lapang";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }

    public static function delete($conn, $id)
    {
        $query = "DELETE FROM dokumen_aset_lapang WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function deleteGambar($conn, $id)
    {
        $query = "DELETE FROM dokumentasi_lapang WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function getDokumenById($conn, $id)
    {
        $query = "SELECT * FROM dokumen_aset_lapang WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function storeDokumenLapang(
        $conn,
        $aset_lapang_id,
        $nama_dokumen,
        $path_dokumen
    ) {
        $fields = [
            'aset_lapang_id' => $aset_lapang_id,
            'nama_dokumen' => $nama_dokumen,
            'path_dokumen' => $path_dokumen

        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO dokumen_aset_lapang ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public static function storeDokumentasiLapang(
        $conn,
        $aset_lapang_id,
        $nama_dokumen,
        $path_dokumen
    ) {
        $fields = [
            'aset_lapang_id' => $aset_lapang_id,
            'nama_dokumen' => $nama_dokumen,
            'path_dokumen' => $path_dokumen

        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO dokumentasi_lapang ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public static function getAllDataGambar($conn)
    {
        $query = "SELECT * FROM dokumentasi_lapang";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }

    public static function getDokumenGambarById($conn, $id)
    {
        $query = "SELECT * FROM dokumentasi_lapang WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
