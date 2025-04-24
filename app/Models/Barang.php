<?php
class Barang
{
    // Ambil semua data penempatan lengkap dengan nama ruangan dan kondisi barang
    public static function getAllData($conn)
    {
        $query = "SELECT 
                b.*, 
                kb.nama_kategori, 
                sb.nama_subkategori, 
                r.nama_ruangan, 
                k.nama_kondisi
              FROM barang b
              LEFT JOIN kategori_barang kb ON b.kategori_id = kb.id
              LEFT JOIN subkategori_barang sb ON b.subkategori_id = sb.id
              LEFT JOIN ruangan r ON b.ruangan_id = r.id_ruangan
              LEFT JOIN kondisi_barang k ON b.kondisi_id = k.id
              ORDER BY b.id DESC";

        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getAllData: " . $e->getMessage());
            return [];
        }
    }

    // Simpan data penempatan barang
    public static function storeData(
        $conn,
        $id_barang,
        $jenis_barang,
        $id_ruangan,
        $tanggal_penempatan,
        $id_kondisi_barang,
        $keterangan
    ) {
        $query = "INSERT INTO penempatan_barang 
                    (id_barang, jenis_barang, id_ruangan, tanggal_penempatan, id_kondisi_barang, keterangan) 
                  VALUES 
                    (:id_barang, :jenis_barang, :id_ruangan, :tanggal_penempatan, :id_kondisi_barang, :keterangan)";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id_barang', $id_barang, PDO::PARAM_INT);
        $stmt->bindParam(':jenis_barang', $jenis_barang, PDO::PARAM_STR);
        $stmt->bindParam(':id_ruangan', $id_ruangan, PDO::PARAM_INT);
        $stmt->bindParam(':tanggal_penempatan', $tanggal_penempatan, PDO::PARAM_STR);
        $stmt->bindParam(':id_kondisi_barang', $id_kondisi_barang, PDO::PARAM_INT);
        $stmt->bindParam(':keterangan', $keterangan, PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error in storeData: " . $e->getMessage());
            return false;
        }
    }

    // Perbarui data penempatan barang
    public static function updateData(
        $conn,
        $id_penempatan,
        $id_barang,
        $jenis_barang,
        $id_ruangan,
        $tanggal_penempatan,
        $id_kondisi_barang,
        $keterangan
    ) {
        $query = "UPDATE penempatan_barang SET
                    id_barang = :id_barang,
                    jenis_barang = :jenis_barang,
                    id_ruangan = :id_ruangan,
                    tanggal_penempatan = :tanggal_penempatan,
                    id_kondisi_barang = :id_kondisi_barang,
                    keterangan = :keterangan
                  WHERE id_penempatan = :id_penempatan";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id_penempatan', $id_penempatan, PDO::PARAM_INT);
        $stmt->bindParam(':id_barang', $id_barang, PDO::PARAM_INT);
        $stmt->bindParam(':jenis_barang', $jenis_barang, PDO::PARAM_STR);
        $stmt->bindParam(':id_ruangan', $id_ruangan, PDO::PARAM_INT);
        $stmt->bindParam(':tanggal_penempatan', $tanggal_penempatan, PDO::PARAM_STR);
        $stmt->bindParam(':id_kondisi_barang', $id_kondisi_barang, PDO::PARAM_INT);
        $stmt->bindParam(':keterangan', $keterangan, PDO::PARAM_STR);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error in updateData: " . $e->getMessage());
            return false;
        }
    }

    // Hapus data penempatan barang
    public static function deleteData($conn, $id_penempatan)
    {
        $query = "DELETE FROM penempatan_barang WHERE id_penempatan = :id_penempatan";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_penempatan', $id_penempatan, PDO::PARAM_INT);

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error in deleteData: " . $e->getMessage());
            return false;
        }
    }

    // Ambil barang berdasarkan kategori
    public static function getByKategori($conn, $kategori_id)
    {
        $query = "SELECT 
                    b.*, 
                    r.nama_ruangan, 
                    k.nama_kondisi,
                    sub.nama_subkategori
                  FROM barang b
                  LEFT JOIN ruangan r ON b.ruangan_id = r.id_ruangan
                  LEFT JOIN kondisi_barang k ON b.kondisi_id = k.id
                  LEFT JOIN subkategori_barang sub ON b.subkategori_id = sub.id
                  WHERE b.kategori_id = :kategori_id
                  ORDER BY b.nama_barang ASC";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':kategori_id', $kategori_id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in getByKategori: " . $e->getMessage());
            return [];
        }
    }
}
