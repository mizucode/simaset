<?php

class SaranaElektronik
{
    /**
     * Mendapatkan semua data barang elektronik dengan join ke tabel terkait
     * 
     * @param PDO $conn Koneksi database
     * @return array|string Array data atau pesan error
     */
    public static function getAllData($conn)
    {
        $query = "SELECT se.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
                  FROM sarana_elektronik se
                  JOIN kategori_barang kb ON se.kategori_barang_id = kb.id
                  JOIN barang b ON se.barang_id = b.id
                  JOIN kondisi_barang kond ON se.kondisi_barang_id = kond.id";

        try {
            $stmt = $conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in SaranaElektronik::getAllData - " . $e->getMessage());
            return [];
        }
    }

    /**
     * Menyimpan data baru barang elektronik
     * 
     * @param PDO $conn Koneksi database
     * @param array $data Data barang elektronik
     * @return bool|string True jika berhasil, pesan error jika gagal
     */
    public static function storeData(
        $conn,
        $kategori_barang_id,
        $barang_id,
        $kondisi_barang_id,
        $no_registrasi,
        $nama_detail_barang,
        $merk,
        $spesifikasi,
        $tipe,
        $jumlah,
        $satuan,
        $keterangan
    ) {
        $fields = [
            'kategori_barang_id' => $kategori_barang_id,
            'barang_id' => $barang_id,
            'kondisi_barang_id' => $kondisi_barang_id,
            'no_registrasi' => $no_registrasi,
            'nama_detail_barang' => $nama_detail_barang,
            'merk' => $merk,
            'spesifikasi' => $spesifikasi,
            'tipe' => $tipe,
            'jumlah' => $jumlah,
            'satuan' => $satuan,
            'keterangan' => $keterangan
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO sarana_elektronik ($columns) VALUES ($placeholders)";

        try {
            $stmt = $conn->prepare($query);
            return $stmt->execute($fields);
        } catch (PDOException $e) {
            error_log("Error in SaranaElektronik::storeData - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Memperbarui data barang elektronik
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID barang elektronik
     * @param array $data Data yang akan diupdate
     * @return bool|string True jika berhasil, pesan error jika gagal
     */
    public static function updateData(
        $conn,
        $id,
        $kategori_barang_id,
        $barang_id,
        $kondisi_barang_id,
        $no_registrasi,
        $nama_detail_barang,
        $merk,
        $spesifikasi,
        $tipe,
        $jumlah,
        $satuan,
        $keterangan
    ) {
        $query = "UPDATE sarana_elektronik SET
            kategori_barang_id = :kategori_barang_id,
            barang_id = :barang_id,
            kondisi_barang_id = :kondisi_barang_id,
            no_registrasi = :no_registrasi,
            nama_detail_barang = :nama_detail_barang,
            merk = :merk,
            spesifikasi = :spesifikasi,
            tipe = :tipe,
            jumlah = :jumlah,
            satuan = :satuan,
            keterangan = :keterangan,
            updated_at = CURRENT_TIMESTAMP
        WHERE id = :id";

        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':kategori_barang_id', $kategori_barang_id);
            $stmt->bindParam(':barang_id', $barang_id);
            $stmt->bindParam(':kondisi_barang_id', $kondisi_barang_id);
            $stmt->bindParam(':no_registrasi', $no_registrasi);
            $stmt->bindParam(':nama_detail_barang', $nama_detail_barang);
            $stmt->bindParam(':merk', $merk);
            $stmt->bindParam(':spesifikasi', $spesifikasi);
            $stmt->bindParam(':tipe', $tipe);
            $stmt->bindParam(':jumlah', $jumlah);
            $stmt->bindParam(':satuan', $satuan);
            $stmt->bindParam(':keterangan', $keterangan);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error in SaranaElektronik::updateData - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Menghapus data barang elektronik
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID barang elektronik
     * @return bool|string True jika berhasil, pesan error jika gagal
     */
    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM sarana_elektronik WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /**
     * Mendapatkan data barang elektronik berdasarkan ID
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID barang elektronik
     * @return array|false Array data atau false jika tidak ditemukan
     */
    public static function getById($conn, $id)
    {
        $query = "SELECT se.*, 
                 kb.nama_kategori, 
                 b.nama_barang, 
                 kond.nama_kondisi
                 FROM sarana_elektronik se
                 LEFT JOIN kategori_barang kb ON se.kategori_barang_id = kb.id
                 LEFT JOIN barang b ON se.barang_id = b.id
                 LEFT JOIN kondisi_barang kond ON se.kondisi_barang_id = kond.id
                 WHERE se.id = :id";

        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in SaranaElektronik::getById - " . $e->getMessage());
            return false;
        }
    }
}
