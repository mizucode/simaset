<?php


class MutasiBarangKeluar
{
    public static function getAllData($conn)
    {
        $query = "SELECT * FROM mutasi_barang_keluar";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }
    public static function getById($conn, $id)
    {
        $query = "SELECT * FROM mutasi_barang_keluar WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC); // Use fetch() instead of fetchAll() for single row
        } catch (Exception $e) {
            error_log("Error in getById: " . $e->getMessage());
            return false; // Return false on failure
        }
    }

    public static function storeData(
        $conn,
        $tanggal_keluar,
        $nama_barang,
        $jumlah,
        $tujuan,
        $penerima,
        $keterangan
    ) {
        $fields = [
            'tanggal_keluar' => $tanggal_keluar,
            'nama_barang' => $nama_barang,
            'jumlah' => $jumlah,
            'tujuan' => $tujuan,
            'penerima' => $penerima,
            'keterangan' => $keterangan
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO mutasi_barang_keluar ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public static function updateData(
        $conn,
        $id,
        $tanggal_keluar,
        $nama_barang,
        $jumlah,
        $tujuan,
        $penerima,
        $keterangan
    ) {
        $query = "UPDATE mutasi_barang_keluar SET 
            tanggal_keluar = :tanggal_keluar,
            nama_barang = :nama_barang,
            jumlah = :jumlah,
            tujuan = :tujuan,
            penerima = :penerima,
            keterangan = :keterangan
            WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':tanggal_keluar', $tanggal_keluar);
        $stmt->bindParam(':nama_barang', $nama_barang);
        $stmt->bindParam(':jumlah', $jumlah);
        $stmt->bindParam(':tujuan', $tujuan);
        $stmt->bindParam(':penerima', $penerima);
        $stmt->bindParam(':keterangan', $keterangan);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM mutasi_barang_keluar WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
