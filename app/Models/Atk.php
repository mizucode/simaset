<?php

class Atk
{
    public static function getAllData($conn)
    {
        $query = "SELECT * FROM atk";
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
        $query = "SELECT id_atk, nama_atk FROM atk ORDER BY nama_atk ASC";
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
        $kode_atk,
        $nama_atk,
        $merk,
        $jumlah,
        $satuan,
        $kondisi,
        $lokasi,
        $tanggal_masuk,
        $keterangan
    ) {
        $fields = [
            'kode_atk'        => $kode_atk,
            'nama_atk'        => $nama_atk,
            'merk'            => $merk,
            'jumlah'          => $jumlah,
            'satuan'          => $satuan,
            'kondisi'         => $kondisi,
            'lokasi'          => $lokasi,
            'tanggal_masuk'   => $tanggal_masuk,
            'keterangan'      => $keterangan
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO atk ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindParam(":$key", $fields[$key]);
        }

        return $stmt->execute();
    }

    public static function updateData(
        $conn,
        $id_atk,
        $kode_atk,
        $nama_atk,
        $merk,
        $jumlah,
        $satuan,
        $kondisi,
        $lokasi,
        $tanggal_masuk,
        $keterangan
    ) {
        $query = "UPDATE atk SET 
            kode_atk = :kode_atk,
            nama_atk = :nama_atk,
            merk = :merk,
            jumlah = :jumlah,
            satuan = :satuan,
            kondisi = :kondisi,
            lokasi = :lokasi,
            tanggal_masuk = :tanggal_masuk,
            keterangan = :keterangan
            WHERE id_atk = :id_atk";

        $stmt = $conn->prepare($query);

        $stmt->bindParam(':id_atk', $id_atk);
        $stmt->bindParam(':kode_atk', $kode_atk);
        $stmt->bindParam(':nama_atk', $nama_atk);
        $stmt->bindParam(':merk', $merk);
        $stmt->bindParam(':jumlah', $jumlah);
        $stmt->bindParam(':satuan', $satuan);
        $stmt->bindParam(':kondisi', $kondisi);
        $stmt->bindParam(':lokasi', $lokasi);
        $stmt->bindParam(':tanggal_masuk', $tanggal_masuk);
        $stmt->bindParam(':keterangan', $keterangan);

        return $stmt->execute();
    }

    public static function getById($conn, $id_atk)
    {
        $query = "SELECT * FROM atk WHERE id_atk = :id_atk";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_atk', $id_atk);
        try {
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return null;
        }
    }

    public static function deleteData($conn, $id_atk)
    {
        $query = "DELETE FROM atk WHERE id_atk = :id_atk";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id_atk', $id_atk);
        return $stmt->execute();
    }
}
