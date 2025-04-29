<?php

class BarangElektronik
{
    /**
     * Mendapatkan semua data barang elektronik dengan join ke ruangan
     * 
     * @param PDO $conn Koneksi database
     * @return array|string Array data atau pesan error
     */
    public static function getAllData($conn)
    {
        $query = "SELECT b.*, kb.nama_barang, kb.kode_barang, k.nama_kategori
        FROM barang_elektronik b
        LEFT JOIN barang kb ON b.barang_id = kb.id
        LEFT JOIN kategori_barang k ON b.kategori_id = k.id;";

        try {
            $stmt = $conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in BarangElektronik::getAllData - " . $e->getMessage());
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
        $barang_id,
        $kategori_id,
        $status,
        $spesifikasi,
        $merk,
        $tipe_model,
        $jumlah,
        $satuan,
        $kondisi_terakhir,
        $keterangan
    ) {
        $fields = [
            'barang_id' => $barang_id,
            'kategori_id' => $kategori_id,
            'status' => $status,
            'spesifikasi' => $spesifikasi,
            'merk' => $merk,
            'tipe_model' => $tipe_model,
            'jumlah' => $jumlah,
            'satuan' => $satuan,
            'kondisi_terakhir' => $kondisi_terakhir,
            'keterangan' => $keterangan
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO barang_elektronik ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindParam(":$key", $fields[$key]);
        }

        return $stmt->execute();
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
        $barang_id,
        $kategori_id,
        $status,
        $spesifikasi,
        $merk,
        $tipe_model,
        $jumlah,
        $satuan,
        $kondisi_terakhir,
        $keterangan
    ) {
        $query = "UPDATE barang_elektronik SET
            barang_id = :barang_id,
            kategori_id = :kategori_id,
            status = :status,
            spesifikasi = :spesifikasi,
            merk = :merk,
            tipe_model = :tipe_model,
            jumlah = :jumlah,
            satuan = :satuan,
            kondisi_terakhir = :kondisi_terakhir,
            keterangan = :keterangan
        WHERE id = :id";

        $stmt = $conn->prepare($query);

        // Bind the parameters
        $stmt->bindParam(':barang_id', $barang_id);
        $stmt->bindParam(':kategori_id', $kategori_id);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':spesifikasi', $spesifikasi);
        $stmt->bindParam(':merk', $merk);
        $stmt->bindParam(':tipe_model', $tipe_model);
        $stmt->bindParam(':jumlah', $jumlah);
        $stmt->bindParam(':satuan', $satuan);
        $stmt->bindParam(':kondisi_terakhir', $kondisi_terakhir);
        $stmt->bindParam(':keterangan', $keterangan);
        $stmt->bindParam(':id', $id);

        // Execute the query
        return $stmt->execute();
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
        $query = "DELETE FROM barang_elektronik WHERE id = :id";
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
        $query = "SELECT be.*, r.nama_ruangan, k.nama_kategori 
                  FROM barang_elektronik be
                  JOIN ruangan r ON be.id_ruangan = r.id_ruangan
                  JOIN kategori k ON be.kategori_id = k.id
                  WHERE be.id = :id";

        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in BarangElektronik::getById - " . $e->getMessage());
            return false;
        }
    }

    public static function getStatusOptions($conn)
    {
        $stmt = $conn->query("SHOW COLUMNS FROM barang_elektronik LIKE 'status'");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return [];
        }

        // Ambil string enum
        preg_match('/enum\((.*)\)/', $row['Type'], $matches);

        if (!isset($matches[1])) {
            return [];
        }

        // Bersihkan tanda kutip dan ubah jadi array
        $enumStr = str_replace("'", '', $matches[1]);
        $options = explode(',', $enumStr);

        return $options;
    }

    public static function getTypeOptions($conn)
    {
        $stmt = $conn->query("SHOW COLUMNS FROM barang_elektronik LIKE 'spesifikasi'");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return [];
        }

        // Ambil string enum
        preg_match('/enum\((.*)\)/', $row['Type'], $matches);

        if (!isset($matches[1])) {
            return [];
        }

        // Bersihkan tanda kutip dan ubah jadi array
        $enumStr = str_replace("'", '', $matches[1]);
        $options = explode(',', $enumStr);

        return $options;
    }
    public static function getKondisiTerakhirOptions($conn)
    {
        $stmt = $conn->query("SHOW COLUMNS FROM barang_elektronik LIKE 'kondisi_terakhir'");
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$row) {
            return [];
        }

        // Ambil string enum
        preg_match('/enum\((.*)\)/', $row['Type'], $matches);

        if (!isset($matches[1])) {
            return [];
        }

        // Bersihkan tanda kutip dan ubah jadi array
        $enumStr = str_replace("'", '', $matches[1]);
        $options = explode(',', $enumStr);

        return $options;
    }
}
