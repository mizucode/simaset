<?php

class DokumenSaranaATK
{
    public static function getAllData($conn, $aset_atk_id = null)
    {
        $query = "SELECT * FROM dokumen_sarana_atk";
        if ($aset_atk_id) {
            $query .= " WHERE aset_atk_id = :aset_atk_id";
        }

        $stmt = $conn->prepare($query);
        if ($aset_atk_id) {
            $stmt->bindParam(':aset_atk_id', $aset_atk_id);
        }

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }

    public static function delete($conn, $id)
    {
        $query = "DELETE FROM dokumen_sarana_atk WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function deleteGambar($conn, $id)
    {
        $query = "DELETE FROM dokumentasi_sarana_atk WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function getDokumenById($conn, $id)
    {
        $query = "SELECT * FROM dokumen_sarana_atk WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function storeDokumenATK(
        $conn,
        $aset_atk_id,
        $nama_dokumen,
        $path_dokumen
    ) {
        $fields = [
            'aset_atk_id' => $aset_atk_id,
            'nama_dokumen' => $nama_dokumen,
            'path_dokumen' => $path_dokumen
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO dokumen_sarana_atk ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public static function storeDokumentasiATK(
        $conn,
        $aset_atk_id,
        $nama_dokumen,
        $path_dokumen
    ) {
        $fields = [
            'aset_atk_id' => $aset_atk_id,
            'nama_dokumen' => $nama_dokumen,
            'path_dokumen' => $path_dokumen
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO dokumentasi_sarana_atk ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public static function getAllDataGambar($conn, $aset_atk_id = null)
    {
        $query = "SELECT * FROM dokumentasi_sarana_atk";
        if ($aset_atk_id) {
            $query .= " WHERE aset_atk_id = :aset_atk_id";
        }

        $stmt = $conn->prepare($query);
        if ($aset_atk_id) {
            $stmt->bindParam(':aset_atk_id', $aset_atk_id);
        }

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }

    public static function getDokumenGambarById($conn, $id)
    {
        $query = "SELECT * FROM dokumentasi_sarana_atk WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
