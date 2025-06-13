<?php

class KondisiBarang {
  /**
   * Ambil semua data kondisi barang
   *
   * @param PDO $conn
   * @return array|string
   */
  public static function getAllData($conn) {
    $query = "SELECT * FROM kondisi_barang";
    $stmt = $conn->prepare($query);
    try {
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return 'Query gagal: ' . $e->getMessage();
    }
  }

  /**
   * Simpan data kondisi barang baru
   *
   * @param PDO    $conn
   * @param string $kondisi
   * @param string $tanggal_perubahan (YYYY-MM-DD)
   * @param string $catatan
   * @return bool
   */
  public static function storeData($conn, $kondisi, $tanggal_perubahan, $catatan = null) {
    $query = "INSERT INTO kondisi_barang (kondisi, tanggal_perubahan, catatan) \
                  VALUES (:kondisi, :tanggal_perubahan, :catatan)";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(':kondisi', $kondisi);
    $stmt->bindParam(':tanggal_perubahan', $tanggal_perubahan);
    $stmt->bindParam(':catatan', $catatan);

    return $stmt->execute();
  }

  /**
   * Perbarui data kondisi barang
   *
   * @param PDO    $conn
   * @param int    $id_kondisi_barang
   * @param string $kondisi
   * @param string $tanggal_perubahan (YYYY-MM-DD)
   * @param string $catatan
   * @return bool
   */
  public static function updateData($conn, $id_kondisi_barang, $kondisi, $tanggal_perubahan, $catatan = null) {
    $query = "UPDATE kondisi_barang SET
                  kondisi = :kondisi,
                  tanggal_perubahan = :tanggal_perubahan,
                  catatan = :catatan
                  WHERE id_kondisi_barang = :id_kondisi_barang";
    $stmt = $conn->prepare($query);

    $stmt->bindParam(':id_kondisi_barang', $id_kondisi_barang);
    $stmt->bindParam(':kondisi', $kondisi);
    $stmt->bindParam(':tanggal_perubahan', $tanggal_perubahan);
    $stmt->bindParam(':catatan', $catatan);

    return $stmt->execute();
  }

  /**
   * Hapus data kondisi barang
   *
   * @param PDO $conn
   * @param int $id_kondisi_barang
   * @return bool
   */
  public static function deleteData($conn, $id_kondisi_barang) {
    $query = "DELETE FROM kondisi_barang WHERE id_kondisi_barang = :id_kondisi_barang";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id_kondisi_barang', $id_kondisi_barang);
    return $stmt->execute();
  }

  /**
   * Mengambil ID kondisi berdasarkan nama kondisi.
   *
   * @param PDO $conn Koneksi database.
   * @param string $nama_kondisi Nama kondisi yang dicari.
   * @return int|false ID kondisi jika ditemukan, false jika tidak.
   */
  public static function getIdByName($conn, $nama_kondisi) {
    $query = "SELECT id FROM kondisi_barang WHERE nama_kondisi = :nama_kondisi LIMIT 1";
    try {
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':nama_kondisi', $nama_kondisi, PDO::PARAM_STR);
      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);
      return $result ? (int)$result['id'] : false;
    } catch (PDOException $e) {
      error_log("Error in KondisiBarang::getIdByName - " . $e->getMessage());
      return false;
    }
  }
}
