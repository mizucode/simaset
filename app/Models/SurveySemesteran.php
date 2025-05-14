<?php

class SurveySemesteran
{
    public static function getAllData($conn)
    {
        $query = "SELECT * FROM survey_semester";

        try {
            $stmt = $conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in SurveySemester::getAllData - " . $e->getMessage());
            return [];
        }
    }
    public static function getById($conn, $id)
    {
        $query = "SELECT * FROM survey_semester WHERE id = :id LIMIT 1";

        try {
            $stmt = $conn->prepare($query);
            $stmt->execute(['id' => $id]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Error in SurveySemesteran::getById - " . $e->getMessage());
            return false;
        }
    }





    /**
     * Menyimpan data baru barang mebelair
     * 
     * @param PDO $conn Koneksi database
     * @param array $data Data barang mebelair
     * @return bool|string True jika berhasil, pesan error jika gagal
     */
    public static function storeData(
        $conn,
        $penanggung_jawab,
        $semester,
        $tahun_akademik,
        $tanggal_pengecekan,
        $lokasi_survey,
    ) {
        $fields = [
            'penanggung_jawab'     => $penanggung_jawab,
            'semester'             => $semester,
            'tahun_akademik'       => $tahun_akademik,
            'tanggal_pengecekan'   => $tanggal_pengecekan,
            'lokasi_survey'        => $lokasi_survey,
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO survey_semester ($columns) VALUES ($placeholders)";

        try {
            $stmt = $conn->prepare($query);
            return $stmt->execute($fields);
        } catch (PDOException $e) {
            error_log("Error in SurveySemester::storeData - " . $e->getMessage());
            return false;
        }
    }
}
