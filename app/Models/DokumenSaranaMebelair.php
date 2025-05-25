<?php

class DokumenSaranaMebelair
{
    /**
     * Mengambil semua data dokumen file terkait dengan aset mebelair tertentu.
     */
    public static function getAllData($conn, $aset_mebelair_id)
    {
        // Kueri diubah untuk mengambil dokumen berdasarkan aset_mebelair_id
        $query = "SELECT * FROM dokumen_sarana_mebelair WHERE aset_mebelair_id = :aset_mebelair_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':aset_mebelair_id', $aset_mebelair_id);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Sebaiknya log error atau handle dengan lebih baik daripada return string
            error_log("Query gagal getAllData DokumenSaranaMebelair: " . $e->getMessage());
            return []; // Kembalikan array kosong jika gagal
        }
    }

    /**
     * Menghapus data dokumen file berdasarkan ID dokumen.
     */
    public static function delete($conn, $id)
    {
        // Nama tabel diubah menjadi dokumen_sarana_mebelair
        $query = "DELETE FROM dokumen_sarana_mebelair WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /**
     * Menghapus data dokumentasi gambar berdasarkan ID gambar.
     */
    public static function deleteGambar($conn, $id)
    {
        // Nama tabel diubah menjadi dokumentasi_sarana_mebelair
        $query = "DELETE FROM dokumentasi_sarana_mebelair WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    /**
     * Mengambil satu data dokumen file berdasarkan ID dokumen.
     */
    public static function getDokumenById($conn, $id)
    {
        // Nama tabel diubah menjadi dokumen_sarana_mebelair
        $query = "SELECT * FROM dokumen_sarana_mebelair WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /**
     * Menyimpan data dokumen file baru untuk sarana mebelair.
     */
    public static function storeDokumenMebelair( // Nama metode diubah
        $conn,
        $aset_mebelair_id, // Kolom foreign key diubah
        $nama_dokumen,
        $path_dokumen
    ) {
        $fields = [
            'aset_mebelair_id' => $aset_mebelair_id, // Kolom foreign key diubah
            'nama_dokumen' => $nama_dokumen,
            'path_dokumen' => $path_dokumen
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        // Nama tabel diubah menjadi dokumen_sarana_mebelair
        $query = "INSERT INTO dokumen_sarana_mebelair ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    /**
     * Menyimpan data dokumentasi gambar baru untuk sarana mebelair.
     */
    public static function storeDokumentasiMebelair( // Nama metode diubah
        $conn,
        $aset_mebelair_id, // Kolom foreign key diubah
        $nama_dokumen, // Bisa juga disebut nama_gambar
        $path_dokumen  // Bisa juga disebut path_gambar
    ) {
        $fields = [
            'aset_mebelair_id' => $aset_mebelair_id, // Kolom foreign key diubah
            'nama_dokumen' => $nama_dokumen,
            'path_dokumen' => $path_dokumen
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        // Nama tabel diubah menjadi dokumentasi_sarana_mebelair
        $query = "INSERT INTO dokumentasi_sarana_mebelair ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    /**
     * Mengambil semua data dokumentasi gambar terkait dengan aset mebelair tertentu.
     */
    public static function getAllDataGambar($conn, $aset_mebelair_id)
    {
        // Kueri diubah untuk mengambil gambar berdasarkan aset_mebelair_id
        // Nama tabel diubah menjadi dokumentasi_sarana_mebelair
        $query = "SELECT * FROM dokumentasi_sarana_mebelair WHERE aset_mebelair_id = :aset_mebelair_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':aset_mebelair_id', $aset_mebelair_id);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            // Sebaiknya log error atau handle dengan lebih baik daripada return string
            error_log("Query gagal getAllDataGambar DokumenSaranaMebelair: " . $e->getMessage());
            return []; // Kembalikan array kosong jika gagal
        }
    }

    /**
     * Mengambil satu data dokumentasi gambar berdasarkan ID gambar.
     */
    public static function getDokumenGambarById($conn, $id)
    {
        // Nama tabel diubah menjadi dokumentasi_sarana_mebelair
        $query = "SELECT * FROM dokumentasi_sarana_mebelair WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
