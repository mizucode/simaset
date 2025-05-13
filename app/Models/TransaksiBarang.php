<?php
class TransaksiBarang
{

    public static function getAllData($conn)
    {
        $query = "SELECT * FROM transaksi_peminjaman";

        try {
            $stmt = $conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in TransaksiBarang::getAllData - " . $e->getMessage());
            return [];
        }
    }
    public static function getAllDataPengembalian($conn)
    {
        $query = "SELECT * FROM transaksi_pengembalian";

        try {
            $stmt = $conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in TransaksiBarang::getAllData - " . $e->getMessage());
            return [];
        }
    }

    public static function storePeminjaman(
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
        $fields = [
            'nama_peminjam' => $nama_peminjam,
            'nik' => $nik,
            'jabatan' => $jabatan,
            'no_telepon' => $no_telepon,
            'nama_barang' => $nama_barang,
            'jumlah_barang' => $jumlah_barang,
            'kondisi' => $kondisi,
            'tanggal_peminjaman' => $tanggal_peminjaman,
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'lokasi' => $lokasi,
            'status' => $status,
            'tujuan_peminjaman' => $tujuan_peminjaman
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO transaksi_peminjaman ($columns) VALUES ($placeholders)";

        try {
            $stmt = $conn->prepare($query);
            return $stmt->execute($fields);
        } catch (PDOException $e) {
            error_log("Error in storePeminjaman - " . $e->getMessage());
            return "Query gagal: " . $e->getMessage();
        }
    }



    // Simpan data penempatan barang


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
