<?php

class SaranaATK
{
  /**
   * Mendapatkan semua data barang ATK dengan join ke tabel terkait
   * 
   * @param PDO $conn Koneksi database
   * @return array|string Array data atau pesan error
   */
  public static function getAllData($conn)
  {
    $query = "SELECT sa.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
                  FROM sarana_atk sa
                  JOIN kategori_barang kb ON sa.kategori_barang_id = kb.id
                  JOIN barang b ON sa.barang_id = b.id
                  JOIN kondisi_barang kond ON sa.kondisi_barang_id = kond.id";

    try {
      $stmt = $conn->query($query);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error in SaranaATK::getAllData - " . $e->getMessage());
      return [];
    }
  }

  public static function getAllStatus($conn)
  {
    $query = "SELECT sa.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
              FROM sarana_atk sa
              JOIN kategori_barang kb ON sa.kategori_barang_id = kb.id
              JOIN barang b ON sa.barang_id = b.id
              JOIN kondisi_barang kond ON sa.kondisi_barang_id = kond.id
              WHERE sa.status = 'Dipinjam'";

    $stmt = $conn->prepare($query);
    try {
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return "Query gagal: " . $e->getMessage();
    }
  }
  public static function getAllStatusTersedia($conn)
  {
    $query = "SELECT sa.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
              FROM sarana_atk sa
              JOIN kategori_barang kb ON sa.kategori_barang_id = kb.id
              JOIN barang b ON sa.barang_id = b.id
              JOIN kondisi_barang kond ON sa.kondisi_barang_id = kond.id
              WHERE sa.status = 'Tersedia'";

    $stmt = $conn->prepare($query);
    try {
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return "Query gagal: " . $e->getMessage();
    }
  }

  public static function getAllStatusExDipinjam($conn)
  {
    $query = "SELECT sa.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
              FROM sarana_atk sa
              JOIN kategori_barang kb ON sa.kategori_barang_id = kb.id
              JOIN barang b ON sa.barang_id = b.id
              JOIN kondisi_barang kond ON sa.kondisi_barang_id = kond.id
              WHERE sa.status != 'Dipinjam'";

    $stmt = $conn->prepare($query);
    try {
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return "Query gagal: " . $e->getMessage();
    }
  }
  public static function getAllStatusDipinjam($conn)
  {
    $query = "SELECT sa.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
              FROM sarana_atk sa
              JOIN kategori_barang kb ON sa.kategori_barang_id = kb.id
              JOIN barang b ON sa.barang_id = b.id
              JOIN kondisi_barang kond ON sa.kondisi_barang_id = kond.id
              WHERE sa.status = 'Dipinjam'";

    $stmt = $conn->prepare($query);
    try {
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return "Query gagal: " . $e->getMessage();
    }
  }
  /**
   * Menyimpan data baru barang ATK
   * 
   * @param PDO $conn Koneksi database
   * @param array $data Data barang ATK
   * @return bool|string True jika berhasil, pesan error jika gagal
   */
  public static function storeData(
    $conn,
    $kategori_barang_id,
    $barang_id,
    $kondisi_barang_id,
    $no_registrasi,
    $nama_detail_barang,
    $merk,
    $spesifikasi,
    $jumlah,
    $satuan,
    $lokasi,
    $sumber,
    $biaya_pembelian,
    $tanggal_pembelian,
    $keterangan,
    $status = 'Tersedia', // Default status untuk data baru
    $nama_peminjam = null,
    $identitas_peminjam = null,
    $no_hp_peminjam = null,
    $tanggal_peminjaman = null,
    $tanggal_pengembalian = null
  ) {
    $fields = [
      'kategori_barang_id' => $kategori_barang_id,
      'barang_id' => $barang_id,
      'kondisi_barang_id' => $kondisi_barang_id,
      'no_registrasi' => $no_registrasi,
      'nama_detail_barang' => $nama_detail_barang,
      'merk' => $merk,
      'spesifikasi' => $spesifikasi,
      'jumlah' => $jumlah,
      'satuan' => $satuan,
      'lokasi' => $lokasi,
      'sumber' => $sumber,
      'biaya_pembelian' => $biaya_pembelian,
      'tanggal_pembelian' => $tanggal_pembelian,
      'keterangan' => $keterangan,
      'status' => $status,
      'nama_peminjam' => $nama_peminjam,
      'identitas_peminjam' => $identitas_peminjam,
      'no_hp_peminjam' => $no_hp_peminjam,
      'tanggal_peminjaman' => $tanggal_peminjaman,
      'tanggal_pengembalian' => $tanggal_pengembalian,
    ];

    $columns = implode(', ', array_keys($fields));
    $placeholders = ':' . implode(', :', array_keys($fields));

    $query = "INSERT INTO sarana_atk ($columns) VALUES ($placeholders)";

    try {
      $stmt = $conn->prepare($query);
      return $stmt->execute($fields);
    } catch (PDOException $e) {
      error_log("Error in SaranaATK::storeData - " . $e->getMessage());
      return false;
    }
  }

  /**
   * Memperbarui data barang ATK
   * 
   * @param PDO $conn Koneksi database
   * @param int $id ID barang ATK
   * @param array $data Data yang akan diupdate
   * @return bool|string True jika berhasil, pesan error jika gagal
   */
  public static function updateData(
    PDO $conn,
    int $id,
    int $kategori_barang_id,
    int $barang_id,
    int $kondisi_barang_id,
    string $no_registrasi,
    string $nama_detail_barang,
    string $merk,
    string $spesifikasi,
    int $jumlah,
    string $satuan,
    string $lokasi,
    ?string $sumber, // <--- PERUBAHAN DI SINI
    ?float $biaya_pembelian,
    ?string $tanggal_pembelian,
    ?string $keterangan, // Direkomendasikan untuk diubah juga
    // Parameter untuk status dan peminjaman
    ?string $status,
    ?string $nama_peminjam,
    ?string $identitas_peminjam,
    ?string $no_hp_peminjam,
    ?string $tanggal_peminjaman,
    ?string $tanggal_pengembalian
  ): bool {
    try {
      $stmt = $conn->prepare("
            UPDATE sarana_atk SET 
                kategori_barang_id = ?, 
                barang_id = ?, 
                kondisi_barang_id = ?, 
                no_registrasi = ?, 
                nama_detail_barang = ?, 
                merk = ?, 
                spesifikasi = ?, 
                jumlah = ?, 
                satuan = ?, 
                lokasi = ?, 
                sumber = ?, 
                biaya_pembelian = ?, 
                tanggal_pembelian = ?, 
                keterangan = ?,
                status = ?, 
                nama_peminjam = ?, 
                identitas_peminjam = ?, 
                no_hp_peminjam = ?, 
                tanggal_peminjaman = ?, 
                tanggal_pengembalian = ?
            WHERE id = ?
        ");

      return $stmt->execute([
        $kategori_barang_id,
        $barang_id,
        $kondisi_barang_id,
        $no_registrasi,
        $nama_detail_barang,
        $merk,
        $spesifikasi,
        $jumlah,
        $satuan,
        $lokasi,
        $sumber,
        $biaya_pembelian,
        $tanggal_pembelian,
        $keterangan,
        $status,
        $nama_peminjam,
        $identitas_peminjam,
        $no_hp_peminjam,
        $tanggal_peminjaman,
        $tanggal_pengembalian,
        $id
      ]);
    } catch (PDOException $e) {
      error_log("Error updating Sarana ATK: " . $e->getMessage());
      return false;
    }
  }

  /**
   * Menghapus data barang ATK
   * 
   * @param PDO $conn Koneksi database
   * @param int $id ID barang ATK
   * @return bool|string True jika berhasil, pesan error jika gagal
   */
  public static function deleteData($conn, $id)
  {
    $query = "DELETE FROM sarana_atk WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

  /**
   * Mendapatkan data barang ATK berdasarkan ID
   * 
   * @param PDO $conn Koneksi database
   * @param int $id ID barang ATK
   * @return array|false Array data atau false jika tidak ditemukan
   */
  public static function getById($conn, $id)
  {
    $query = "SELECT sa.*, 
                 kb.nama_kategori, 
                 b.nama_barang, 
                 kond.nama_kondisi
                 FROM sarana_atk sa
                 LEFT JOIN kategori_barang kb ON sa.kategori_barang_id = kb.id
                 LEFT JOIN barang b ON sa.barang_id = b.id
                 LEFT JOIN kondisi_barang kond ON sa.kondisi_barang_id = kond.id
                 WHERE sa.id = :id";

    try {
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error in SaranaATK::getById - " . $e->getMessage());
      return false;
    }
  }

  /**
   * Memperbarui kondisi dan lokasi barang ATK berdasarkan nomor registrasi.
   *
   * @param PDO $conn Koneksi database.
   * @param string $no_registrasi Nomor registrasi barang.
   * @param int $kondisi_barang_id_baru ID kondisi barang yang baru.
   * @param string $lokasi_baru Lokasi barang yang baru.
   * @return bool True jika berhasil, false jika gagal.
   */
  public static function updateKondisiLokasiByNoReg($conn, $no_registrasi, $kondisi_barang_id_baru, $lokasi_baru, $tanggal_survey_terakhir = null)
  {
    $query = "UPDATE sarana_atk SET 
                  kondisi_barang_id = :kondisi_barang_id, 
                  lokasi = :lokasi,
                  tanggal_survey_terakhir = :tanggal_survey_terakhir
                WHERE no_registrasi = :no_registrasi";
    try {
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':kondisi_barang_id', $kondisi_barang_id_baru, PDO::PARAM_INT);
      $stmt->bindParam(':lokasi', $lokasi_baru, PDO::PARAM_STR);
      $stmt->bindParam(':tanggal_survey_terakhir', $tanggal_survey_terakhir, PDO::PARAM_STR);
      $stmt->bindParam(':no_registrasi', $no_registrasi, PDO::PARAM_STR);
      return $stmt->execute();
    } catch (PDOException $e) {
      error_log("Error in SaranaATK::updateKondisiLokasiByNoReg - " . $e->getMessage());
      return false;
    }
  }

  /**
   * Mendapatkan data barang ATK berdasarkan Nomor Registrasi
   * 
   * @param PDO $conn Koneksi database
   * @param string $no_registrasi Nomor Registrasi barang ATK
   * @return array|false Array data atau false jika tidak ditemukan
   */
  public static function getByNoRegistrasi($conn, $no_registrasi)
  {
    $query = "SELECT sa.*, 
                 kb.nama_kategori, 
                 b.nama_barang, 
                 kond.nama_kondisi
                 FROM sarana_atk sa
                 LEFT JOIN kategori_barang kb ON sa.kategori_barang_id = kb.id
                 LEFT JOIN barang b ON sa.barang_id = b.id
                 LEFT JOIN kondisi_barang kond ON sa.kondisi_barang_id = kond.id
                 WHERE sa.no_registrasi = :no_registrasi";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':no_registrasi', $no_registrasi, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
}
