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
}
