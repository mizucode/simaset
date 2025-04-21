<?php

class Tanah
{
    public static function getAllData($conn)
    {
        $query = "SELECT * FROM tanah";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Jika terjadi error dalam query, tampilkan pesan
            return "Query gagal: " . $e->getMessage();
        }
    }

    // 
    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM tanah WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function storeData(
        $conn,
        $nama_lokasi,
        $alamat,
        $luas,
        $status_kepemilikan,
        $no_sertifikat,
        $tanggal_perolehan,
        $penggunaan,
        $keterangan
    ) {
        $query = "INSERT INTO tanah (nama_lokasi, alamat, luas, status_kepemilikan, no_sertifikat, tanggal_perolehan, penggunaan, keterangan) VALUES (:nama_lokasi, :alamat, :luas, :status_kepemilikan, :no_sertifikat, :tanggal_perolehan, :penggunaan, :keterangan)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':nama_lokasi', $nama_lokasi);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':luas', $luas);
        $stmt->bindParam(':status_kepemilikan', $status_kepemilikan);
        $stmt->bindParam(':no_sertifikat', $no_sertifikat);
        $stmt->bindParam(':tanggal_perolehan', $tanggal_perolehan);
        $stmt->bindParam(':penggunaan', $penggunaan);
        $stmt->bindParam(':keterangan', $keterangan);
        return $stmt->execute(); // gunakan return biar bisa tahu hasilnya sukses/gagal
    }

    public static function getById($conn, $id)
    {
        $query = "SELECT * FROM tanah WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        }
    }

    public static function updateData(
        $conn,
        $id,
        $nama_lokasi,
        $alamat,
        $luas,
        $status_kepemilikan,
        $no_sertifikat,
        $tanggal_perolehan,
        $penggunaan,
        $keterangan
    ) {
        $query = "UPDATE tanah SET nama_lokasi = :nama_lokasi, alamat = :alamat, luas = :luas, status_kepemilikan = :status_kepemilikan, no_sertifikat = :no_sertifikat, tanggal_perolehan = :tanggal_perolehan, penggunaan = :penggunaan, keterangan = :keterangan WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama_lokasi', $nama_lokasi);
        $stmt->bindParam(':alamat', $alamat);
        $stmt->bindParam(':luas', $luas);
        $stmt->bindParam(':status_kepemilikan', $status_kepemilikan);
        $stmt->bindParam(':no_sertifikat', $no_sertifikat);
        $stmt->bindParam(':tanggal_perolehan', $tanggal_perolehan);
        $stmt->bindParam(':penggunaan', $penggunaan);
        $stmt->bindParam(':keterangan', $keterangan);
        return $stmt->execute();
    }
}
