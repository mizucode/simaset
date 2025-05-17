<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Gedung
{
    public static function getAllData($conn)
    {
        $query = "SELECT aset_gedung.*, jenis_aset.jenis_aset 
              FROM aset_gedung 
              JOIN jenis_aset ON aset_gedung.jenis_aset_id = jenis_aset.id";
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
        $query = "SELECT aset_gedung.*, jenis_aset.jenis_aset 
              FROM aset_gedung 
              JOIN jenis_aset ON aset_gedung.jenis_aset_id = jenis_aset.id
              WHERE aset_gedung.id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function storeData(
        $conn,
        $kode_gedung,
        $nama_gedung,
        $jenis_aset_id,
        $luas,
        $jumlah_lantai,
        $kontruksi,
        $lokasi,
        $kondisi,
        $unit_kepemilikan,
        $fungsi
    ) {
        $fields = [
            'kode_gedung' => $kode_gedung,
            'nama_gedung' => $nama_gedung,
            'jenis_aset_id' => $jenis_aset_id,
            'luas' => $luas,
            'jumlah_lantai' => $jumlah_lantai,
            'kontruksi' => $kontruksi,
            'lokasi' => $lokasi,
            'kondisi' => $kondisi,
            'unit_kepemilikan' => $unit_kepemilikan,
            'fungsi' => $fungsi
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO aset_gedung ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public static function updateData(
        $conn,
        $id,
        $kode_gedung,
        $nama_gedung,
        $jenis_aset_id,
        $luas,
        $jumlah_lantai,
        $kontruksi,
        $lokasi,
        $kondisi,
        $unit_kepemilikan,
        $fungsi
    ) {
        $query = "UPDATE aset_gedung SET 
                kode_gedung = :kode_gedung,
                nama_gedung = :nama_gedung,
                jenis_aset_id = :jenis_aset_id,
                luas = :luas,
                jumlah_lantai = :jumlah_lantai,
                kontruksi = :kontruksi,
                lokasi = :lokasi,
                kondisi = :kondisi,
                unit_kepemilikan = :unit_kepemilikan,
                fungsi = :fungsi
                WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':kode_gedung', $kode_gedung);
        $stmt->bindParam(':nama_gedung', $nama_gedung);
        $stmt->bindParam(':jenis_aset_id', $jenis_aset_id);
        $stmt->bindParam(':luas', $luas);
        $stmt->bindParam(':jumlah_lantai', $jumlah_lantai);
        $stmt->bindParam(':kontruksi', $kontruksi);
        $stmt->bindParam(':lokasi', $lokasi);
        $stmt->bindParam(':kondisi', $kondisi);
        $stmt->bindParam(':unit_kepemilikan', $unit_kepemilikan);
        $stmt->bindParam(':fungsi', $fungsi);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public static function deleteData($conn, $id)
    {
        // 1. Hapus dulu semua ruang yang terkait
        $deleteRuangQuery = "DELETE FROM aset_ruang WHERE gedung_id = :id";
        $deleteRuangStmt = $conn->prepare($deleteRuangQuery);
        $deleteRuangStmt->bindParam(':id', $id);
        $deleteRuangStmt->execute();

        // 2. Hapus data gedung
        $query = "DELETE FROM aset_gedung WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
