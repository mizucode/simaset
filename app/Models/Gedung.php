<?php

class Gedung
{
    public static function getAllData($conn)
    {
        $query = "SELECT * FROM gedung";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }
    public static function getAll($conn)
    {
        $query = "SELECT id_gedung, nama_gedung FROM gedung ORDER BY nama_gedung ASC";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public static function storeData(
        $conn,
        $kode_gedung,
        $nama_gedung,
        $lokasi,
        $alamat,
        $luas_tanah,
        $luas_bangunan,
        $jumlah_lantai,
        $tahun_dibangun,
        $tahun_perolehan,
        $nilai_perolehan,
        $status_kepemilikan,
        $status_penggunaan,
        $kondisi,
        $pengguna,
        $dokumen_legalitas,
        $keterangan
    ) {
        $fields = [
            'kode_gedung'        => $kode_gedung,
            'nama_gedung'        => $nama_gedung,
            'lokasi'             => $lokasi,
            'alamat'             => $alamat,
            'luas_tanah'         => $luas_tanah,
            'luas_bangunan'      => $luas_bangunan,
            'jumlah_lantai'      => $jumlah_lantai,
            'tahun_dibangun'     => $tahun_dibangun,
            'tahun_perolehan'    => $tahun_perolehan,
            'nilai_perolehan'    => $nilai_perolehan,
            'status_kepemilikan' => $status_kepemilikan,
            'status_penggunaan'  => $status_penggunaan,
            'kondisi'            => $kondisi,
            'pengguna'           => $pengguna,
            'dokumen_legalitas'  => $dokumen_legalitas,
            'keterangan'         => $keterangan
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO gedung ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindParam(":$key", $fields[$key]);
        }

        return $stmt->execute();
    }

    public static function updateData(
        $conn,
        $id,
        $kode_gedung,
        $nama_gedung,
        $lokasi,
        $alamat,
        $luas_tanah,
        $luas_bangunan,
        $jumlah_lantai,
        $tahun_dibangun,
        $tahun_perolehan,
        $nilai_perolehan,
        $status_kepemilikan,
        $status_penggunaan,
        $kondisi,
        $pengguna,
        $dokumen_legalitas,
        $keterangan
    ) {
        $query = "UPDATE gedung SET 
            kode_gedung = :kode_gedung,
            nama_gedung = :nama_gedung,
            lokasi = :lokasi,
            alamat = :alamat,
            luas_tanah = :luas_tanah,
            luas_bangunan = :luas_bangunan,
            jumlah_lantai = :jumlah_lantai,
            tahun_dibangun = :tahun_dibangun,
            tahun_perolehan = :tahun_perolehan,
            nilai_perolehan = :nilai_perolehan,
            status_kepemilikan = :status_kepemilikan,
            status_penggunaan = :status_penggunaan,
            kondisi = :kondisi,
            pengguna = :pengguna,
            dokumen_legalitas = :dokumen_legalitas,
            keterangan = :keterangan
            WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':kode_gedung', $kode_gedung);
        $stmt->bindParam(':nama_gedung', $nama_gedung);
        $stmt->bindParam(':lokasi', $lokasi);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':luas_tanah', $luas_tanah);
        $stmt->bindParam(':luas_bangunan', $luas_bangunan);
        $stmt->bindParam(':jumlah_lantai', $jumlah_lantai);
        $stmt->bindParam(':tahun_dibangun', $tahun_dibangun);
        $stmt->bindParam(':tahun_perolehan', $tahun_perolehan);
        $stmt->bindParam(':nilai_perolehan', $nilai_perolehan);
        $stmt->bindParam(':status_kepemilikan', $status_kepemilikan);
        $stmt->bindParam(':status_penggunaan', $status_penggunaan);
        $stmt->bindParam(':kondisi', $kondisi);
        $stmt->bindParam(':pengguna', $pengguna);
        $stmt->bindParam(':dokumen_legalitas', $dokumen_legalitas);
        $stmt->bindParam(':keterangan', $keterangan);

        return $stmt->execute();
    }

    public static function getById($conn, $id)
    {
        $query = "SELECT * FROM gedung WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        }
    }

    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM gedung WHERE id_gedung = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
