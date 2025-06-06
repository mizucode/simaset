<?php

class SurveySaranaATK {
  public static function getAllData($conn) {
    $query = "SELECT * FROM survey_sarana_atk";

    try {
      $stmt = $conn->query($query);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error in SurveySemester::getAllData - " . $e->getMessage());
      return [];
    }
  }
  public static function getAllDataInventaris($conn, $survey_id) {
    $query = "SELECT * FROM data_survey_atk WHERE survey_sarana_bergerak_id = :survey_id";

    try {
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':survey_id', $survey_id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error in SurveySaranaMebelair::getAllDataInventaris - " . $e->getMessage());
      return [];
    }
  }

  public static function getById($conn, $id) {
    $query = "SELECT * FROM survey_sarana_atk WHERE id = :id LIMIT 1";

    try {
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error in SurveySaranaMebelair::getById - " . $e->getMessage());
      return false;
    }
  }

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

    $query = "INSERT INTO survey_sarana_atk ($columns) VALUES ($placeholders)";
    $stmt = $conn->prepare($query);

    foreach ($fields as $key => $value) {
      $stmt->bindValue(":$key", $value);
    }

    return $stmt->execute();
  }

  public static function updateData(
    $conn,
    $id,
    $penanggung_jawab,
    $semester,
    $tahun_akademik,
    $tanggal_pengecekan,
    $lokasi_survey
  ) {
    $query = "UPDATE survey_sarana_atk SET
            penanggung_jawab = :penanggung_jawab,
            semester = :semester,
            tahun_akademik = :tahun_akademik,
            tanggal_pengecekan = :tanggal_pengecekan,
            lokasi_survey = :lokasi_survey
        WHERE id = :id";

    try {
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':penanggung_jawab', $penanggung_jawab);
      $stmt->bindParam(':semester', $semester);
      $stmt->bindParam(':tahun_akademik', $tahun_akademik);
      $stmt->bindParam(':tanggal_pengecekan', $tanggal_pengecekan);
      $stmt->bindParam(':lokasi_survey', $lokasi_survey);
      $stmt->bindParam(':id', $id);
      return $stmt->execute();
    } catch (PDOException $e) {
      error_log("Error in SurveySaranaMebelair::updateData - " . $e->getMessage());
      return false;
    }
  }


  public static function deleteData($conn, $id) {
    $query = "DELETE FROM survey_sarana_atk WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

  public static function storeDataInventaris(
    $conn,
    $survey_sarana_bergerak_id,
    $nama_barang,
    $no_registrasi,
    $kondisi,
    $lokasi
  ) {
    $fields = [
      'survey_sarana_bergerak_id' => $survey_sarana_bergerak_id,
      'nama_barang'               => $nama_barang,
      'no_registrasi'             => $no_registrasi,
      'kondisi'                   => $kondisi,
      'lokasi'                    => $lokasi,
    ];

    $columns = implode(', ', array_keys($fields));
    $placeholders = ':' . implode(', :', array_keys($fields));

    $query = "INSERT INTO data_survey_atk ($columns) VALUES ($placeholders)";

    try {
      $stmt = $conn->prepare($query);
      return $stmt->execute($fields);
    } catch (PDOException $e) {
      error_log("Error in SurveySaranaMebelair::storeDataInventaris - " . $e->getMessage());
      return false;
    }
  }

  public static function deleteDataInventaris($conn, $id) {
    $query = "DELETE FROM data_survey_atk WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

  public static function getInventarisItemById($conn, $id) {
    $query = "SELECT * FROM data_survey_atk WHERE id = :id LIMIT 1";
    try {
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error in SurveySaranaMebelair::getInventarisItemById - " . $e->getMessage());
      return false;
    }
  }
}
