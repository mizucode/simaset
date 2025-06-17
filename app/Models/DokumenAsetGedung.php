<?php

class DokumenAsetGedung
{
    public static function getAllData($conn, $aset_gedung_id = null)
    {
        $query = "SELECT * FROM dokumen_aset_gedung";
        if ($aset_gedung_id !== null) {
            $query .= " WHERE aset_gedung_id = :aset_gedung_id";
        }
        $stmt = $conn->prepare($query);
        if ($aset_gedung_id !== null) {
            $stmt->bindParam(':aset_gedung_id', $aset_gedung_id, PDO::PARAM_INT);
        }
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error in DokumenAsetGedung::getAllData: " . $e->getMessage());
            return [];
        }
    }

    public static function delete($conn, $id)
    {
        $query = "DELETE FROM dokumen_aset_gedung WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function deleteGambar($conn, $id)
    {
        $query = "DELETE FROM dokumentasi_gedung WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function getDokumenById($conn, $id)
    {
        $query = "SELECT * FROM dokumen_aset_gedung WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function storeDokumenGedung(
        $conn,
        $aset_gedung_id,
        $nama_dokumen,
        $path_dokumen
    ) {
        $fields = [
            'aset_gedung_id' => $aset_gedung_id,
            'nama_dokumen' => $nama_dokumen,
            'path_dokumen' => $path_dokumen

        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO dokumen_aset_gedung ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public static function storeDokumentasiGedung(
        $conn,
        $aset_gedung_id,
        $nama_dokumen,
        $path_dokumen
    ) {
        $fields = [
            'aset_gedung_id' => $aset_gedung_id,
            'nama_dokumen' => $nama_dokumen,
            'path_dokumen' => $path_dokumen

        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO dokumentasi_gedung ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public static function getAllDataGambar($conn, $aset_gedung_id = null)
    {
        $query = "SELECT * FROM dokumentasi_gedung";
        if ($aset_gedung_id !== null) {
            $query .= " WHERE aset_gedung_id = :aset_gedung_id";
        }
        $stmt = $conn->prepare($query);
        if ($aset_gedung_id !== null) {
            $stmt->bindParam(':aset_gedung_id', $aset_gedung_id, PDO::PARAM_INT);
        }
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error in DokumenAsetGedung::getAllDataGambar: " . $e->getMessage());
            return [];
        }
    }
    public static function getDokumenGambarById($conn, $id)
    {
        $query = "SELECT * FROM dokumentasi_gedung WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
