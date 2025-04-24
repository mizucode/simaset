<?php

class BarangElektronik
{
    public static function getAllData($conn)
    {
        $query = "SELECT be.*, r.nama_ruangan 
                  FROM barang_elektronik be
                  JOIN ruangan r ON be.id_ruangan = r.id_ruangan";
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
        $kode_be,
        $nama_be,
        $kategori_be,
        $status,
        $merk,
        $tipe_model,
        $tahun_perolehan,
        $kondisi,
        $id_ruangan,
        $jumlah,
        $satuan
    ) {
        $fields = [
            'kode_be' => $kode_be,
            'nama_be' => $nama_be,
            'kategori_be' => $kategori_be,
            'status' => $status,
            'merk' => $merk,
            'tipe_model' => $tipe_model,
            'tahun_perolehan' => $tahun_perolehan,
            'kondisi' => $kondisi,
            'id_ruangan' => $id_ruangan,
            'jumlah' => $jumlah,
            'satuan' => $satuan
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

    public static function updateData(
        $conn,
        $id_be,
        $kode_be,
        $nama_be,
        $kategori_be,
        $status,
        $merk,
        $tipe_model,
        $tahun_perolehan,
        $kondisi,
        $id_ruangan,
        $jumlah,
        $satuan
    ) {
        $query = "UPDATE barang_elektronik SET
            kode_be = :kode_be,
            nama_be = :nama_be,
            kategori_be = :kategori_be,
            status = :status,
            merk = :merk,
            tipe_model = :tipe_model,
            tahun_perolehan = :tahun_perolehan,
            kondisi = :kondisi,
            id_ruangan = :id_ruangan,
            jumlah = :jumlah,
            satuan = :satuan
            WHERE id_be = :id_be";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id_be', $id_be);
        $stmt->bindParam(':kode_be', $kode_be);
        $stmt->bindParam(':nama_be', $nama_be);
        $stmt->bindParam(':kategori_be', $kategori_be);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':merk', $merk);
        $stmt->bindParam(':tipe_model', $tipe_model);
        $stmt->bindParam(':tahun_perolehan', $tahun_perolehan);
        $stmt->bindParam(':kondisi', $kondisi);
        $stmt->bindParam(':id_ruangan', $id_ruangan);
        $stmt->bindParam(':jumlah', $jumlah);
        $stmt->bindParam(':satuan', $satuan);

        return $stmt->execute();
    }

    public static function deleteData($conn, $id_be)
    {
        $query = "DELETE FROM barang_elektronik WHERE id_be = :id_be";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_be', $id_be);
        return $stmt->execute();
    }
}
