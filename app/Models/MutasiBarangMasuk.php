<?php

class MutasiBarangMasuk
{
    public static function getAllData($conn)
    {
        $query = "SELECT * FROM mutasi_barang_masuk";
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
        $query = "SELECT * FROM mutasi_barang_masuk WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);

        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            error_log("Error in getById: " . $e->getMessage());
            return false;
        }
    }

    public static function storeData(
        $conn,
        $tanggal_penerimaan,
        $sumber_barang,
        $nama_barang,
        $jumlah,
        $kondisi,
        $nomor_nota = null,
        $keterangan = null
    ) {
        $fields = [
            'tanggal_penerimaan' => $tanggal_penerimaan,
            'sumber_barang' => $sumber_barang,
            'nama_barang' => $nama_barang,
            'jumlah' => $jumlah,
            'kondisi' => $kondisi,
            'nomor_nota' => $nomor_nota,
            'keterangan' => $keterangan
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO mutasi_barang_masuk ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public static function updateData(
        $conn,
        $id,
        $tanggal_penerimaan,
        $sumber_barang,
        $nama_barang,
        $jumlah,
        $kondisi,
        $nomor_nota = null,
        $keterangan = null
    ) {
        $query = "UPDATE mutasi_barang_masuk SET 
            tanggal_penerimaan = :tanggal_penerimaan,
            sumber_barang = :sumber_barang,
            nama_barang = :nama_barang,
            jumlah = :jumlah,
            kondisi = :kondisi,
            nomor_nota = :nomor_nota,
            keterangan = :keterangan
            WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':tanggal_penerimaan', $tanggal_penerimaan);
        $stmt->bindParam(':sumber_barang', $sumber_barang);
        $stmt->bindParam(':nama_barang', $nama_barang);
        $stmt->bindParam(':jumlah', $jumlah);
        $stmt->bindParam(':kondisi', $kondisi);
        $stmt->bindParam(':nomor_nota', $nomor_nota);
        $stmt->bindParam(':keterangan', $keterangan);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM mutasi_barang_masuk WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
