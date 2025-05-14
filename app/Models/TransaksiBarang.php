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

    public static function getAllDataDate($conn)
    {
        $query = "SELECT * FROM transaksi_peminjaman ORDER BY created_at DESC";

        // Ganti 'tanggal_pinjam' dengan kolom tanggal/waktu yang sesuai di tabel Anda
        // Misalnya: 'created_at', 'tgl_transaksi', dll.

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
        $query = "SELECT transaksi_pengembalian.*, transaksi_peminjaman.nama_peminjam,  transaksi_peminjaman.nik, transaksi_peminjaman.nama_barang 
          FROM transaksi_pengembalian 
          JOIN transaksi_peminjaman ON transaksi_pengembalian.barang_pinjam_id = transaksi_peminjaman.id";
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

    public static function storePengembalian(
        $conn,
        $barang_pinjam_id,
        $nama,
        $tanggal_pengembalian,
        $kondisi,
        $keterangan
    ) {
        $fields = [
            'barang_pinjam_id' => $barang_pinjam_id,
            'nama' => $nama,
            'tanggal_pengembalian' => $tanggal_pengembalian,
            'kondisi' => $kondisi,
            'keterangan' => $keterangan
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO transaksi_pengembalian ($columns) VALUES ($placeholders)";

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
