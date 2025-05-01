<?php

class Tanah
{
    // Ambil semua data tanah
    public static function getAllData($conn)
    {
        $query = "SELECT * FROM tanah";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }

    // Simpan data tanah baru
    public static function storeData(
        $conn,
        $lokasi_id,
        $kode_tanah,
        $nama_tanah,
        $luas,
        $status_tanah,
        $sertifikat_nomor,
        $sertifikat_tanggal,
        $pajak_tanggal,
        $penggunaan,
        $sumber_dana,
        $alamat,
        $keterangan
    ) {
        $fields = [
            'lokasi_id' => $lokasi_id,
            'kode_tanah' => $kode_tanah,
            'nama_tanah' => $nama_tanah,
            'luas' => $luas,
            'status_tanah' => $status_tanah,
            'sertifikat_nomor' => $sertifikat_nomor,
            'sertifikat_tanggal' => $sertifikat_tanggal,
            'pajak_tanggal' => $pajak_tanggal,
            'penggunaan' => $penggunaan,
            'sumber_dana' => $sumber_dana,
            'alamat' => $alamat,
            'keterangan' => $keterangan
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO tanah ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindParam(":$key", $fields[$key]);
        }

        return $stmt->execute();
    }

    // Update data tanah
    public static function updateData(
        $conn,
        $id,
        $lokasi_id,
        $kode_tanah,
        $nama_tanah,
        $luas,
        $status_tanah,
        $sertifikat_nomor,
        $sertifikat_tanggal,
        $pajak_tanggal,
        $penggunaan,
        $sumber_dana,
        $alamat,
        $keterangan
    ) {
        $query = "UPDATE tanah SET
            lokasi_id = :lokasi_id,
            kode_tanah = :kode_tanah,
            nama_tanah = :nama_tanah,
            luas = :luas,
            status_tanah = :status_tanah,
            sertifikat_nomor = :sertifikat_nomor,
            sertifikat_tanggal = :sertifikat_tanggal,
            pajak_tanggal = :pajak_tanggal,
            penggunaan = :penggunaan,
            sumber_dana = :sumber_dana,
            alamat = :alamat,
            keterangan = :keterangan
            WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':lokasi_id', $lokasi_id);
        $stmt->bindParam(':kode_tanah', $kode_tanah);
        $stmt->bindParam(':nama_tanah', $nama_tanah);
        $stmt->bindParam(':luas', $luas);
        $stmt->bindParam(':status_tanah', $status_tanah);
        $stmt->bindParam(':sertifikat_nomor', $sertifikat_nomor);
        $stmt->bindParam(':sertifikat_tanggal', $sertifikat_tanggal);
        $stmt->bindParam(':pajak_tanggal', $pajak_tanggal);
        $stmt->bindParam(':penggunaan', $penggunaan);
        $stmt->bindParam(':sumber_dana', $sumber_dana);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':keterangan', $keterangan);

        return $stmt->execute();
    }

    // Hapus data tanah
    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM tanah WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
