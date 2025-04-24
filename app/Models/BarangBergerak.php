<?php

class BarangBergerak
{
    public static function getAllData($conn)
    {
        $query = "SELECT * FROM barang_bergerak";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }

    public static function getAll($conn)
    {
        $query = "SELECT id_bb, nama_bb FROM barang_bergerak ORDER BY nama_bb ASC";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return [];
        }
    }

    public static function storeData(
        $conn,
        $kode_bb,
        $nama_bb,
        $merk_tipe,
        $tipe_kendaraan,
        $plat_nomor,
        $tahun_perolehan,
        $kondisi,
        $jumlah,
        $satuan,
        $lokasi,
        $sumber_perolehan,
        $keterangan
    ) {
        $fields = [
            'kode_bb'            => $kode_bb,
            'nama_bb'            => $nama_bb,
            'merk_tipe'         => $merk_tipe,
            'tipe_kendaraan'     => $tipe_kendaraan,
            'plat_nomor'         => $plat_nomor,
            'tahun_perolehan'    => $tahun_perolehan,
            'kondisi'            => $kondisi,
            'jumlah'             => $jumlah,
            'satuan'             => $satuan,
            'lokasi'             => $lokasi,
            'sumber_perolehan'   => $sumber_perolehan,
            'keterangan'         => $keterangan
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO barang_bergerak ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindParam(":$key", $fields[$key]);
        }

        return $stmt->execute();
    }

    public static function updateData(
        $conn,
        $id_bb,
        $kode_bb,
        $nama_bb,
        $merk_tipe,
        $tipe_kendaraan,
        $plat_nomor,
        $tahun_perolehan,
        $kondisi,
        $jumlah,
        $satuan,
        $lokasi,
        $sumber_perolehan,
        $keterangan
    ) {
        $query = "UPDATE barang_bergerak SET 
            kode_bb = :kode_bb,
            nama_bb = :nama_bb,
            merk_tipe = :merk_tipe,
            tipe_kendaraan = :tipe_kendaraan,
            plat_nomor = :plat_nomor,
            tahun_perolehan = :tahun_perolehan,
            kondisi = :kondisi,
            jumlah = :jumlah,
            satuan = :satuan,
            lokasi = :lokasi,
            sumber_perolehan = :sumber_perolehan,
            keterangan = :keterangan
            WHERE id_bb = :id_bb";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id_bb', $id_bb);
        $stmt->bindParam(':kode_bb', $kode_bb);
        $stmt->bindParam(':nama_bb', $nama_bb);
        $stmt->bindParam(':merk_tipe', $merk_tipe);
        $stmt->bindParam(':tipe_kendaraan', $tipe_kendaraan);
        $stmt->bindParam(':plat_nomor', $plat_nomor);
        $stmt->bindParam(':tahun_perolehan', $tahun_perolehan);
        $stmt->bindParam(':kondisi', $kondisi);
        $stmt->bindParam(':jumlah', $jumlah);
        $stmt->bindParam(':satuan', $satuan);
        $stmt->bindParam(':lokasi', $lokasi);
        $stmt->bindParam(':sumber_perolehan', $sumber_perolehan);
        $stmt->bindParam(':keterangan', $keterangan);

        return $stmt->execute();
    }

    public static function getById($conn, $id_bb)
    {
        $query = "SELECT * FROM barang_bergerak WHERE id_bb = :id_bb";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_bb', $id_bb);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        }
    }

    public static function deleteData($conn, $id_bb)
    {
        $query = "DELETE FROM barang_bergerak WHERE id_bb = :id_bb";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_bb', $id_bb);
        return $stmt->execute();
    }
}
