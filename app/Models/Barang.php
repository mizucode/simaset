<?php

class Barang
{
    // Method untuk mengambil semua data barang
    public static function getAllData($conn)
    {
        $query = "SELECT b.*, kb.nama_kategori, k.nama_kondisi 
                  FROM barang b
                  LEFT JOIN kategori_barang kb ON b.kategori_id = kb.id
                  LEFT JOIN kondisi_barang k ON b.kondisi_id = k.id";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }

    // Method untuk menyimpan data barang baru
    public static function storeData(
        $conn,
        $nama_barang,
        $kategori_id,
        $kode_barang,
        $tahun_perolehan,
        $kondisi_id,
        $jumlah
    ) {
        $fields = [
            'nama_barang' => $nama_barang,
            'kategori_id' => $kategori_id,
            'kode_barang' => $kode_barang,
            'tahun_perolehan' => $tahun_perolehan,
            'kondisi_id' => $kondisi_id,
            'jumlah' => $jumlah
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO barang ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindParam(":$key", $fields[$key]);
        }

        return $stmt->execute();
    }

    // Method untuk memperbarui data barang
    public static function updateData(
        $conn,
        $id,
        $nama_barang,
        $kategori_id,
        $kode_barang,
        $tahun_perolehan,
        $kondisi_id,
        $jumlah
    ) {
        $query = "UPDATE barang SET
            nama_barang = :nama_barang,
            kategori_id = :kategori_id,
            kode_barang = :kode_barang,
            tahun_perolehan = :tahun_perolehan,
            kondisi_id = :kondisi_id,
            jumlah = :jumlah
            WHERE id = :id";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nama_barang', $nama_barang);
        $stmt->bindParam(':kategori_id', $kategori_id);
        $stmt->bindParam(':kode_barang', $kode_barang);
        $stmt->bindParam(':tahun_perolehan', $tahun_perolehan);
        $stmt->bindParam(':kondisi_id', $kondisi_id);
        $stmt->bindParam(':jumlah', $jumlah);

        return $stmt->execute();
    }

    // Method untuk menghapus data barang
    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM barang WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
