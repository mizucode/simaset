<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class SaranaBergerak {
  public static function getAllData($conn) {
    $query = "SELECT sb.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
                  FROM sarana_bergerak sb
                  JOIN kategori_barang kb ON sb.kategori_barang_id = kb.id
                  JOIN barang b ON sb.barang_id = b.id
                  JOIN kondisi_barang kond ON sb.kondisi_barang_id = kond.id";
    $stmt = $conn->prepare($query);
    try {
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return "Query gagal: " . $e->getMessage();
    }
  }
  public static function getAllStatus($conn) {
    $query = "SELECT sb.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
              FROM sarana_bergerak sb
              JOIN kategori_barang kb ON sb.kategori_barang_id = kb.id
              JOIN barang b ON sb.barang_id = b.id
              JOIN kondisi_barang kond ON sb.kondisi_barang_id = kond.id
              WHERE sb.status = 'Dipinjam'";

    $stmt = $conn->prepare($query);
    try {
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return "Query gagal: " . $e->getMessage();
    }
  }
  public static function getAllStatusTersedia($conn) {
    $query = "SELECT sb.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
              FROM sarana_bergerak sb
              JOIN kategori_barang kb ON sb.kategori_barang_id = kb.id
              JOIN barang b ON sb.barang_id = b.id
              JOIN kondisi_barang kond ON sb.kondisi_barang_id = kond.id
              WHERE sb.status = 'Tersedia'";

    $stmt = $conn->prepare($query);
    try {
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return "Query gagal: " . $e->getMessage();
    }
  }

  public static function getAllStatusExDipinjam($conn) {
    $query = "SELECT sb.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
              FROM sarana_bergerak sb
              JOIN kategori_barang kb ON sb.kategori_barang_id = kb.id
              JOIN barang b ON sb.barang_id = b.id
              JOIN kondisi_barang kond ON sb.kondisi_barang_id = kond.id
              WHERE sb.status != 'Dipinjam'";

    $stmt = $conn->prepare($query);
    try {
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return "Query gagal: " . $e->getMessage();
    }
  }


  public static function getById($conn, $id) {
    $query = "SELECT sb.*, 
                     kb.nama_kategori AS kategori, 
                     b.nama_barang AS barang, 
                     kond.nama_kondisi AS kondisi
              FROM sarana_bergerak sb
              JOIN kategori_barang kb ON sb.kategori_barang_id = kb.id
              JOIN barang b ON sb.barang_id = b.id
              JOIN kondisi_barang kond ON sb.kondisi_barang_id = kond.id
              WHERE sb.id = :id
              LIMIT 1";

    $stmt = $conn->prepare($query);
    $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT); // lebih aman, pastikan integer
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }


  public static function storeData(
    $conn,
    $kategori_barang_id,
    $barang_id,
    $kondisi_barang_id,
    $no_registrasi,
    $nama_detail_barang,
    $merk,
    $spesifikasi,
    $no_polisi,
    $sumber,
    $lokasi,
    $keterangan,
    $biaya_pembelian,
    $tanggal_pembelian,
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
      'no_polisi' => $no_polisi,
      'sumber' => $sumber,
      'lokasi' => $lokasi,
      'keterangan' => $keterangan,
      'biaya_pembelian' => $biaya_pembelian,
      'tanggal_pembelian' => $tanggal_pembelian,
      'status' => $status, // Tambahkan status ke array fields
      'nama_peminjam' => $nama_peminjam,
      'identitas_peminjam' => $identitas_peminjam,
      'no_hp_peminjam' => $no_hp_peminjam,
      'tanggal_peminjaman' => $tanggal_peminjaman,
      'tanggal_pengembalian' => $tanggal_pengembalian,
    ];

    $columns = implode(', ', array_keys($fields));
    $placeholders = ':' . implode(', :', array_keys($fields));

    $query = "INSERT INTO sarana_bergerak ($columns) VALUES ($placeholders)";
    $stmt = $conn->prepare($query);

    foreach ($fields as $key => $value) {
      $stmt->bindValue(":$key", $value);
    }

    return $stmt->execute();
  }

  public static function updateData(
    $conn,
    $id,
    $kategori_barang_id,
    $barang_id,
    $kondisi_barang_id,
    $no_registrasi,
    $nama_detail_barang,
    $merk,
    $spesifikasi,
    $no_polisi,
    $sumber,
    $lokasi,
    $keterangan,
    $biaya_pembelian,
    $tanggal_pembelian,
    $status,
    $nama_peminjam,
    $identitas_peminjam,
    $no_hp_peminjam,
    $tanggal_peminjaman,
    $tanggal_pengembalian
  ) {
    $fields = [
      'kategori_barang_id' => $kategori_barang_id,
      'barang_id' => $barang_id,
      'kondisi_barang_id' => $kondisi_barang_id,
      'no_registrasi' => $no_registrasi,
      'nama_detail_barang' => $nama_detail_barang,
      'merk' => $merk,
      'spesifikasi' => $spesifikasi,
      'no_polisi' => $no_polisi,
      'sumber' => $sumber,
      'lokasi' => $lokasi,
      'keterangan' => $keterangan,
      'biaya_pembelian' => $biaya_pembelian,
      'tanggal_pembelian' => $tanggal_pembelian,
      'status' => $status,
      'nama_peminjam' => $nama_peminjam,
      'identitas_peminjam' => $identitas_peminjam,
      'no_hp_peminjam' =>  $no_hp_peminjam,
      'tanggal_peminjaman' => $tanggal_peminjaman,
      'tanggal_pengembalian' => $tanggal_pengembalian,
    ];

    $setClause = implode(', ', array_map(function ($key) {
      return "$key = :$key";
    }, array_keys($fields)));

    $query = "UPDATE sarana_bergerak SET $setClause WHERE id = :id";
    $stmt = $conn->prepare($query);

    foreach ($fields as $key => $value) {
      $stmt->bindValue(":$key", $value);
    }

    $stmt->bindValue(':id', $id);

    return $stmt->execute();
  }


  public static function deleteData($conn, $id) {
    $query = "DELETE FROM sarana_bergerak WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

  // Method untuk mendapatkan data berdasarkan kategori barang
  public static function getByKategoriId($conn, $kategori_id) {
    $query = "SELECT * FROM sarana_bergerak WHERE kategori_barang_id = :kategori_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':kategori_id', $kategori_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  // Method untuk mendapatkan data berdasarkan kondisi barang
  public static function getByKondisiId($conn, $kondisi_id) {
    $query = "SELECT * FROM sarana_bergerak WHERE kondisi_barang_id = :kondisi_id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':kondisi_id', $kondisi_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public static function isRegistrationNumberUnique($conn, $registrationNumber) {
    $sql = "SELECT COUNT(*) FROM sarana_bergerak WHERE no_registrasi = :no_registrasi";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':no_registrasi', $registrationNumber);
    $stmt->execute();
    return $stmt->fetchColumn() == 0;
  }

  /**
   * Memperbarui kondisi dan lokasi barang bergerak berdasarkan nomor registrasi.
   *
   * @param PDO $conn Koneksi database.
   * @param string $no_registrasi Nomor registrasi barang.
   * @param int $kondisi_barang_id_baru ID kondisi barang yang baru.
   * @param string $lokasi_baru Lokasi barang yang baru.
   * @return bool True jika berhasil, false jika gagal.
   */
  public static function updateKondisiLokasiByNoReg($conn, $no_registrasi, $kondisi_barang_id_baru, $lokasi_baru) {
    $query = "UPDATE sarana_bergerak SET 
                  kondisi_barang_id = :kondisi_barang_id, 
                  lokasi = :lokasi 
                WHERE no_registrasi = :no_registrasi";
    try {
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':kondisi_barang_id', $kondisi_barang_id_baru, PDO::PARAM_INT);
      $stmt->bindParam(':lokasi', $lokasi_baru, PDO::PARAM_STR);
      $stmt->bindParam(':no_registrasi', $no_registrasi, PDO::PARAM_STR);
      return $stmt->execute();
    } catch (PDOException $e) {
      error_log("Error in SaranaBergerak::updateKondisiLokasiByNoReg - " . $e->getMessage());
      return false;
    }
  }
}
