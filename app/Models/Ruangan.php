<?php

class Ruangan
{
    public static function getAllData($conn)
    {
        $query = "SELECT r.*, g.nama_gedung 
                  FROM ruangan r
                  JOIN gedung g ON r.id_gedung = g.id_gedung";
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
        $kode_ruangan,
        $nama_ruangan,
        $lokasi,
        $id_gedung,
        $kapasitas,
        $jenis_ruangan,
        $luas,
        $status_penggunaan,
        $keterangan,
    ) {
        $fields = [
            'kode_ruangan' => $kode_ruangan,
            'nama_ruangan' => $nama_ruangan,
            'lokasi' => $lokasi,
            'id_gedung' => $id_gedung,
            'kapasitas' => $kapasitas,
            'jenis_ruangan' => $jenis_ruangan,
            'luas' => $luas,
            'status_penggunaan' => $status_penggunaan,
            'keterangan' => $keterangan

        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO ruangan ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindParam(":$key", $fields[$key]);
        }

        return $stmt->execute();
    }

    public static function updateData(
        $conn,
        $id,
        $kode_ruangan,
        $nama_ruangan,
        $lokasi,
        $id_gedung,
        $kapasitas,
        $jenis_ruangan,
        $luas,
        $status_penggunaan,
        $keterangan
    ) {
        $query = "UPDATE ruangan SET 
            kode_ruangan = :kode_ruangan,
            nama_ruangan = :nama_ruangan, 
            lokasi = :lokasi,
            id_gedung = :id_gedung,
            kapasitas = :kapasitas,
            jenis_ruangan = :jenis_ruangan,
            luas = :luas,
            status_penggunaan = :status_penggunaan,
            keterangan = :keterangan
            WHERE id_ruangan = :id"; // ✅ perbaikan di sini

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':kode_ruangan', $kode_ruangan);
        $stmt->bindParam(':nama_ruangan', $nama_ruangan);
        $stmt->bindParam(':lokasi', $lokasi);
        $stmt->bindParam(':id_gedung', $id_gedung);
        $stmt->bindParam(':kapasitas', $kapasitas);
        $stmt->bindParam(':jenis_ruangan', $jenis_ruangan);
        $stmt->bindParam(':luas', $luas);
        $stmt->bindParam(':status_penggunaan', $status_penggunaan);
        $stmt->bindParam(':keterangan', $keterangan);

        return $stmt->execute();
    }



    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM ruangan WHERE id_ruangan = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
