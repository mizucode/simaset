<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Tanah
{
    // Ambil semua data tanah
    public static function getAllData($conn)
    {
        $query = "SELECT aset_tanah.*, jenis_aset.jenis_aset 
              FROM aset_tanah 
              JOIN jenis_aset ON aset_tanah.jenis_aset_id = jenis_aset.id";
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
        $kode_aset,
        $nama_aset,
        $jenis_aset_id,
        $nomor_sertifikat,
        $luas,
        $lokasi,
        $tgl_pajak,
        $fungsi,
        $keterangan

    ) {
        $fields = [
            'kode_aset' => $kode_aset,
            'nama_aset' => $nama_aset,
            'jenis_aset_id' => $jenis_aset_id,
            'nomor_sertifikat' => $nomor_sertifikat,
            'luas' => $luas,
            'lokasi' => $lokasi,
            'tgl_pajak' => $tgl_pajak,
            'fungsi' => $fungsi,
            'keterangan' => $keterangan,

        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO aset_tanah ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => &$value) {
            $stmt->bindParam(":$key", $value);
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
