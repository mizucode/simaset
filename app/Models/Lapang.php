<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Lapang
{
    public static function getAllData($conn)
    {
        $query = "SELECT aset_lapang.*, jenis_aset.jenis_aset 
              FROM aset_lapang 
              JOIN jenis_aset ON aset_lapang.jenis_aset_id = jenis_aset.id";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }

    public static function getById($conn, $id)
    {
        $query = "SELECT aset_lapang.*, jenis_aset.jenis_aset 
              FROM aset_lapang 
              JOIN jenis_aset ON aset_lapang.jenis_aset_id = jenis_aset.id 
              WHERE aset_lapang.id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public static function storeData(
        $conn,
        $jenis_aset_id,
        $kode_lapang,
        $nama_lapang,
        $luas,
        $kategori,
        $fungsi,
        $lokasi,
        $status,
        $kondisi,
        $keterangan
    ) {
        $fields = [
            'jenis_aset_id' => $jenis_aset_id,
            'kode_lapang' => $kode_lapang,
            'nama_lapang' => $nama_lapang,
            'luas' => $luas,
            'kategori' => $kategori,
            'fungsi' => $fungsi,
            'lokasi' => $lokasi,
            'status' => $status,
            'kondisi' => $kondisi,
            'keterangan' => $keterangan
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO aset_lapang ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public static function updateData(
        $conn,
        $id,
        $jenis_aset_id,
        $kode_lapang,
        $nama_lapang,
        $luas,
        $kategori,
        $fungsi,
        $lokasi,
        $status,
        $kondisi,
        $keterangan
    ) {
        $query = "UPDATE aset_lapang SET 
                jenis_aset_id = :jenis_aset_id,
                kode_lapang = :kode_lapang,
                nama_lapang = :nama_lapang,
                luas = :luas,
                kategori = :kategori,
                fungsi = :fungsi,
                lokasi = :lokasi,
                status = :status,
                kondisi = :kondisi,
                keterangan = :keterangan
                WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':jenis_aset_id', $jenis_aset_id);
        $stmt->bindParam(':kode_lapang', $kode_lapang);
        $stmt->bindParam(':nama_lapang', $nama_lapang);
        $stmt->bindParam(':luas', $luas);
        $stmt->bindParam(':kategori', $kategori);
        $stmt->bindParam(':fungsi', $fungsi);
        $stmt->bindParam(':lokasi', $lokasi);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':kondisi', $kondisi);
        $stmt->bindParam(':keterangan', $keterangan);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM aset_lapang WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Tambahan method untuk mendapatkan lapang berdasarkan jenis aset
    public static function getByJenisAsetId($conn, $jenis_aset_id)
    {
        $query = "SELECT * FROM aset_lapang WHERE jenis_aset_id = :jenis_aset_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':jenis_aset_id', $jenis_aset_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
