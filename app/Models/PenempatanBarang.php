<?php
class PenempatanBarang
{
    // Ambil semua data penempatan lengkap dengan nama ruangan dan kondisi barang
    public static function getAllData($conn)
    {
        $query = "SELECT * FROM peminjaman";

        try {
            $stmt = $conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in PenempatanBarang::getAllData - " . $e->getMessage());
            return [];
        }
    }



    // Simpan data penempatan barang
    public static function storeData(
        $conn,
        $nama_peminjam,
        $nik,
        $jabatan,
        $no_telepon,
        $nama_barang,
        $jumlah_barang,
        $kondisi,
        $tanggal_peminjaman,
        $tanggal_pengembalian,
        $lokasi,
        $status,
        $tujuan_peminjaman
    ) {
        $query = "INSERT INTO peminjaman 
            (nama_peminjam, nik, jabatan, no_telepon, nama_barang, jumlah_barang, kondisi, tanggal_peminjaman, tanggal_pengembalian, lokasi, status, tujuan_peminjaman) 
          VALUES 
            (:nama_peminjam, :nik, :jabatan, :no_telepon, :nama_barang, :jumlah_barang, :kondisi, :tanggal_peminjaman, :tanggal_pengembalian, :lokasi, :status, :tujuan_peminjaman)";


        $stmt = $conn->prepare($query);

        $stmt->bindParam(':nama_peminjam', $nama_peminjam);
        $stmt->bindParam(':nik', $nik);
        $stmt->bindParam(':jabatan', $jabatan);
        $stmt->bindParam(':no_telepon', $no_telepon);
        $stmt->bindParam(':nama_barang', $nama_barang);
        $stmt->bindParam(':jumlah_barang', $jumlah_barang);
        $stmt->bindParam(':kondisi', $kondisi);
        $stmt->bindParam(':tanggal_peminjaman', $tanggal_peminjaman);
        $stmt->bindParam(':tanggal_pengembalian', $tanggal_pengembalian);
        $stmt->bindParam(':lokasi', $lokasi);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':tujuan_peminjaman', $tujuan_peminjaman);

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
