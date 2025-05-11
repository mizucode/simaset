<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Ruang
{
    public static function getAllData($conn)
    {
        $query = "SELECT aset_ruang.*, aset_gedung.nama_gedung 
              FROM aset_ruang 
              JOIN aset_gedung ON aset_ruang.gedung_id = aset_gedung.id";
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
        $query = "SELECT aset_ruang.*, aset_gedung.nama_gedung 
              FROM aset_ruang 
              JOIN aset_gedung ON aset_ruang.gedung_id = aset_gedung.id
              WHERE aset_ruang.id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function storeData(
        $conn,
        $gedung_id,
        $kode_ruang,
        $nama_ruang,
        $kapasitas,
        $lantai,
        $luas,
        $status,
        $fungsi,
        $kondisi_ruang,
        $keterangan
    ) {
        $fields = [
            'gedung_id' => $gedung_id,
            'kode_ruang' => $kode_ruang,
            'nama_ruang' => $nama_ruang,
            'kapasitas' => $kapasitas,
            'lantai' => $lantai,
            'luas' => $luas,
            'status' => $status,
            'fungsi' => $fungsi,
            'kondisi_ruang' => $kondisi_ruang,
            'keterangan' => $keterangan
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO aset_ruang ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public static function updateData(
        $conn,
        $id,
        $gedung_id,
        $kode_ruang,
        $nama_ruang,
        $kapasitas,
        $lantai,
        $luas,
        $status,
        $fungsi,
        $kondisi_ruang,
        $keterangan
    ) {
        $query = "UPDATE aset_ruang SET 
                gedung_id = :gedung_id,
                kode_ruang = :kode_ruang,
                nama_ruang = :nama_ruang,
                kapasitas = :kapasitas,
                lantai = :lantai,
                luas = :luas,
                status = :status,
                fungsi = :fungsi,
                kondisi_ruang = :kondisi_ruang,
                keterangan = :keterangan
                WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':gedung_id', $gedung_id);
        $stmt->bindParam(':kode_ruang', $kode_ruang);
        $stmt->bindParam(':nama_ruang', $nama_ruang);
        $stmt->bindParam(':kapasitas', $kapasitas);
        $stmt->bindParam(':lantai', $lantai);
        $stmt->bindParam(':luas', $luas);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':fungsi', $fungsi);
        $stmt->bindParam(':kondisi_ruang', $kondisi_ruang);
        $stmt->bindParam(':keterangan', $keterangan);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM aset_ruang WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Tambahan method untuk mendapatkan ruang berdasarkan gedung
    public static function getByGedungId($conn, $gedung_id)
    {
        $query = "SELECT * FROM aset_ruang WHERE gedung_id = :gedung_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':gedung_id', $gedung_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
