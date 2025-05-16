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
}
