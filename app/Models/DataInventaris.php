<?php

class DataInventaris
{
    public static function getByPenanggungJawabID($conn, $penanggung_jawab_id)
    {
        $query = "SELECT * FROM survey_semesteran_barang WHERE penanggung_jawab_id = :penanggung_jawab_id";

        try {
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':penanggung_jawab_id', $penanggung_jawab_id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in SurveySemesteranBarang::getByPenanggungJawabID - " . $e->getMessage());
            return [];
        }
    }

    public static function store(
        $conn,
        $penanggung_jawab_id,
        $nama_barang_survey,
        $jumlah,
        $kondisi,
        $kebutuhan,
        $keterangan
    ) {
        $fields = [
            'penanggung_jawab_id' => $penanggung_jawab_id,
            'nama_barang_survey' => $nama_barang_survey,
            'jumlah' => $jumlah,
            'kondisi' => $kondisi,
            'kebutuhan' => $kebutuhan,
            'keterangan' => $keterangan
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO survey_semesteran_barang ($columns) VALUES ($placeholders)";

        try {
            $stmt = $conn->prepare($query);
            return $stmt->execute($fields);
        } catch (PDOException $e) {
            error_log("Error in storePeminjaman - " . $e->getMessage());
            return "Query gagal: " . $e->getMessage();
        }
    }

    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM survey_semesteran_barang WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
