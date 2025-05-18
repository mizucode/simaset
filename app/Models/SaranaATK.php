<?php

class SaranaATK
{
    /**
     * Mendapatkan semua data barang ATK dengan join ke tabel terkait
     * 
     * @param PDO $conn Koneksi database
     * @return array|string Array data atau pesan error
     */
    public static function getAllData($conn)
    {
        $query = "SELECT sa.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
                  FROM sarana_atk sa
                  JOIN kategori_barang kb ON sa.kategori_barang_id = kb.id
                  JOIN barang b ON sa.barang_id = b.id
                  JOIN kondisi_barang kond ON sa.kondisi_barang_id = kond.id";

        try {
            $stmt = $conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in SaranaATK::getAllData - " . $e->getMessage());
            return [];
        }
    }

    /**
     * Menyimpan data baru barang ATK
     * 
     * @param PDO $conn Koneksi database
     * @param array $data Data barang ATK
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
        $jumlah,
        $satuan,
        $lokasi,
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
            'jumlah' => $jumlah,
            'satuan' => $satuan,
            'lokasi' => $lokasi,
            'keterangan' => $keterangan
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO sarana_atk ($columns) VALUES ($placeholders)";

        try {
            $stmt = $conn->prepare($query);
            return $stmt->execute($fields);
        } catch (PDOException $e) {
            error_log("Error in SaranaATK::storeData - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Memperbarui data barang ATK
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID barang ATK
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
        $jumlah,
        $satuan,
        $lokasi,
        $keterangan
    ) {
        $query = "UPDATE sarana_atk SET
            kategori_barang_id = :kategori_barang_id,
            barang_id = :barang_id,
            kondisi_barang_id = :kondisi_barang_id,
            no_registrasi = :no_registrasi,
            nama_detail_barang = :nama_detail_barang,
            merk = :merk,
            spesifikasi = :spesifikasi,
            jumlah = :jumlah,
            satuan = :satuan,
            lokasi = :lokasi,
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
            $stmt->bindParam(':jumlah', $jumlah);
            $stmt->bindParam(':satuan', $satuan);
            $stmt->bindParam(':keterangan', $keterangan);
            $stmt->bindParam(':lokasi', $lokasi);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error in SaranaATK::updateData - " . $e->getMessage());
            return false;
        }
    }

    /**
     * Menghapus data barang ATK
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID barang ATK
     * @return bool|string True jika berhasil, pesan error jika gagal
     */
    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM sarana_atk WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /**
     * Mendapatkan data barang ATK berdasarkan ID
     * 
     * @param PDO $conn Koneksi database
     * @param int $id ID barang ATK
     * @return array|false Array data atau false jika tidak ditemukan
     */
    public static function getById($conn, $id)
    {
        $query = "SELECT sa.*, 
                 kb.nama_kategori, 
                 b.nama_barang, 
                 kond.nama_kondisi
                 FROM sarana_atk sa
                 LEFT JOIN kategori_barang kb ON sa.kategori_barang_id = kb.id
                 LEFT JOIN barang b ON sa.barang_id = b.id
                 LEFT JOIN kondisi_barang kond ON sa.kondisi_barang_id = kond.id
                 WHERE sa.id = :id";

        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in SaranaATK::getById - " . $e->getMessage());
            return false;
        }
    }
}
