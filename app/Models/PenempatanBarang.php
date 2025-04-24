<?php
class PenempatanBarang
{
    // Ambil semua data penempatan lengkap dengan nama ruangan dan kondisi barang
    public static function getAllData($conn)
    {
        $query = "SELECT 
                p.*, 
                r.nama_ruangan, 
                k.kondisi AS nama_kondisi,
                b.nama_barang
            FROM penempatan_barang p
            JOIN ruangan r ON p.id_ruangan = r.id_ruangan
            LEFT JOIN kondisi_barang k ON p.id_kondisi_barang = k.id_kondisi_barang
            LEFT JOIN (
                SELECT id_barang, 'bergerak' AS jenis_barang, nama_barang FROM bergerak
                UNION
                SELECT id_barang, 'mebel' AS jenis_barang, nama_barang FROM mebel
                UNION
                SELECT id_barang, 'atk' AS jenis_barang, nama_barang FROM atk
                UNION
                SELECT id_barang, 'elektronik' AS jenis_barang, nama_barang FROM elektronik
            ) AS b 
            ON p.id_barang = b.id_barang AND p.jenis_barang = b.jenis_barang
            ORDER BY p.tanggal_penempatan DESC";

        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
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

        $stmt->bindParam(':id_barang', $id_barang);
        $stmt->bindParam(':jenis_barang', $jenis_barang);
        $stmt->bindParam(':id_ruangan', $id_ruangan);
        $stmt->bindParam(':tanggal_penempatan', $tanggal_penempatan);
        $stmt->bindParam(':id_kondisi_barang', $id_kondisi_barang);
        $stmt->bindParam(':keterangan', $keterangan);

        try {
            return $stmt->execute();
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
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

        $stmt->bindParam(':id_penempatan', $id_penempatan);
        $stmt->bindParam(':id_barang', $id_barang);
        $stmt->bindParam(':jenis_barang', $jenis_barang);
        $stmt->bindParam(':id_ruangan', $id_ruangan);
        $stmt->bindParam(':tanggal_penempatan', $tanggal_penempatan);
        $stmt->bindParam(':id_kondisi_barang', $id_kondisi_barang);
        $stmt->bindParam(':keterangan', $keterangan);

        return $stmt->execute();
    }

    // Hapus data penempatan barang
    public static function deleteData($conn, $id_penempatan)
    {
        $query = "DELETE FROM penempatan_barang WHERE id_penempatan = :id_penempatan";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_penempatan', $id_penempatan);
        return $stmt->execute();
    }
}
