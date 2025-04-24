<?php

class Lapang
{
    public static function getAllData($conn)
    {
        $query = "SELECT * FROM lapang";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Optional: log error
            return []; // Kembalikan array kosong supaya view tetap bisa foreach
        }
    }

    public static function storeData(
        $conn,
        $kode_lapangan,
        $nama_lapangan,
        $lokasi,
        $jenis_lapangan,
        $luas,
        $tahun_dibangun,
        $kondisi,
        $status_kepemilikan,
        $dokumen_legalitas,
        $pengguna,
        $keterangan
    ) {
        $fields = [
            'kode_lapangan' => $kode_lapangan,
            'nama_lapangan' => $nama_lapangan,
            'lokasi' => $lokasi,
            'jenis_lapangan' => $jenis_lapangan,
            'luas' => $luas,
            'tahun_dibangun' => $tahun_dibangun,
            'kondisi' => $kondisi,
            'status_kepemilikan' => $status_kepemilikan,
            'dokumen_legalitas' => $dokumen_legalitas,
            'pengguna' => $pengguna,
            'keterangan' => $keterangan
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO lapang ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public static function updateData(
        $conn,
        $id_lapangan,
        $kode_lapangan,
        $nama_lapangan,
        $lokasi,
        $jenis_lapangan,
        $luas,
        $tahun_dibangun,
        $kondisi,
        $status_kepemilikan,
        $dokumen_legalitas,
        $pengguna,
        $keterangan
    ) {
        $query = "UPDATE lapang SET 
            kode_lapangan = :kode_lapangan,
            nama_lapangan = :nama_lapangan,
            lokasi = :lokasi,
            jenis_lapangan = :jenis_lapangan,
            luas = :luas,
            tahun_dibangun = :tahun_dibangun,
            kondisi = :kondisi,
            status_kepemilikan = :status_kepemilikan,
            dokumen_legalitas = :dokumen_legalitas,
            pengguna = :pengguna,
            keterangan = :keterangan,
            updated_at = CURRENT_TIMESTAMP
            WHERE id_lapangan = :id_lapangan";

        $stmt = $conn->prepare($query);

        $params = [
            ':id_lapangan' => $id_lapangan,
            ':kode_lapangan' => $kode_lapangan,
            ':nama_lapangan' => $nama_lapangan,
            ':lokasi' => $lokasi,
            ':jenis_lapangan' => $jenis_lapangan,
            ':luas' => $luas,
            ':tahun_dibangun' => $tahun_dibangun,
            ':kondisi' => $kondisi,
            ':status_kepemilikan' => $status_kepemilikan,
            ':dokumen_legalitas' => $dokumen_legalitas,
            ':pengguna' => $pengguna,
            ':keterangan' => $keterangan
        ];

        foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
        }

        return $stmt->execute();
    }

    public static function getById($conn, $id_lapangan)
    {
        $query = "SELECT * FROM lapang WHERE id_lapangan = :id_lapangan";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_lapangan', $id_lapangan);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        }
    }

    public static function deleteData($conn, $id_lapangan)
    {
        $query = "DELETE FROM lapang WHERE id_lapangan = :id_lapangan";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_lapangan', $id_lapangan);
        return $stmt->execute();
    }
}
