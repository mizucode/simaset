<?php

class SaranaMebelair {
  /**
   * Mendapatkan semua data barang mebelair dengan join ke tabel terkait
   * 
   * @param PDO $conn Koneksi database
   * @return array|string Array data atau pesan error
   */
  public static function getAllData($conn) {
    $query = "SELECT sb.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
                  FROM sarana_mebelair sb
                  JOIN kategori_barang kb ON sb.kategori_barang_id = kb.id
                  JOIN barang b ON sb.barang_id = b.id
                  JOIN kondisi_barang kond ON sb.kondisi_barang_id = kond.id";

    try {
      $stmt = $conn->query($query);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error in BarangMebelair::getAllData - " . $e->getMessage());
      return [];
    }
  }

  public static function getAllStatus($conn) {
    $query = "SELECT sm.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
              FROM sarana_mebelair sm
              JOIN kategori_barang kb ON sm.kategori_barang_id = kb.id
              JOIN barang b ON sm.barang_id = b.id
              JOIN kondisi_barang kond ON sm.kondisi_barang_id = kond.id
              WHERE sm.status = 'Dipinjam'";

    $stmt = $conn->prepare($query);
    try {
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return "Query gagal: " . $e->getMessage();
    }
  }
  public static function getAllStatusTersedia($conn) {
    $query = "SELECT sm.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
              FROM sarana_mebelair sm
              JOIN kategori_barang kb ON sm.kategori_barang_id = kb.id
              JOIN barang b ON sm.barang_id = b.id
              JOIN kondisi_barang kond ON sm.kondisi_barang_id = kond.id
              WHERE sm.status = 'Tersedia'";

    $stmt = $conn->prepare($query);
    try {
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return "Query gagal: " . $e->getMessage();
    }
  }

  public static function getAllStatusExDipinjam($conn) {
    $query = "SELECT sm.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
              FROM sarana_mebelair sm
              JOIN kategori_barang kb ON sm.kategori_barang_id = kb.id
              JOIN barang b ON sm.barang_id = b.id
              JOIN kondisi_barang kond ON sm.kondisi_barang_id = kond.id
              WHERE sm.status != 'Dipinjam'";

    $stmt = $conn->prepare($query);
    try {
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return "Query gagal: " . $e->getMessage();
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
    $kategori_barang_id,
    $barang_id,
    $kondisi_barang_id,
    $no_registrasi,
    $nama_detail_barang,
    $merk,
    $spesifikasi,
    $sumber,
    $jumlah,
    $satuan,
    $lokasi,
    $bahan,
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
      'sumber' => $sumber,
      'jumlah' => $jumlah,
      'satuan' => $satuan,
      'lokasi' => $lokasi,
      'bahan' => $bahan,
      'keterangan' => $keterangan,
      'biaya_pembelian' => $biaya_pembelian,
      'tanggal_pembelian' => $tanggal_pembelian,
      'status' => $status,
      'nama_peminjam' => $nama_peminjam,
      'identitas_peminjam' => $identitas_peminjam,
      'no_hp_peminjam' => $no_hp_peminjam,
      'tanggal_peminjaman' => $tanggal_peminjaman,
      'tanggal_pengembalian' => $tanggal_pengembalian,
    ];

    $columns = implode(', ', array_keys($fields));
    $placeholders = ':' . implode(', :', array_keys($fields));

    $query = "INSERT INTO sarana_mebelair ($columns) VALUES ($placeholders)";

    try {
      $stmt = $conn->prepare($query);
      return $stmt->execute($fields);
    } catch (PDOException $e) {
      error_log("Error in BarangMebelair::storeData - " . $e->getMessage());
      return false;
    }
  }

  /**
   * Memperbarui data barang mebelair
   * 
   * @param PDO $conn Koneksi database
   * @param int $id ID barang mebelair
   * @param array $data Data yang akan diupdate
   * @return bool|string True jika berhasil, pesan error jika gagal
   */
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
    $sumber,
    $jumlah,
    $satuan,
    $lokasi,
    $bahan,
    $keterangan,
    $biaya_pembelian,
    $tanggal_pembelian,
    $status, // Tambahkan parameter status
    $nama_peminjam,
    $identitas_peminjam,
    $no_hp_peminjam,
    $tanggal_peminjaman,
    $tanggal_pengembalian
  ) {
    $query = "UPDATE sarana_mebelair SET
            kategori_barang_id = :kategori_barang_id,
            barang_id = :barang_id,
            kondisi_barang_id = :kondisi_barang_id,
            no_registrasi = :no_registrasi,
            nama_detail_barang = :nama_detail_barang,
            merk = :merk,
            lokasi = :lokasi,
            spesifikasi = :spesifikasi,
            sumber = :sumber,
            jumlah = :jumlah,
            satuan = :satuan,
            bahan = :bahan,
            keterangan = :keterangan,
            biaya_pembelian = :biaya_pembelian,
            tanggal_pembelian = :tanggal_pembelian,
            status = :status,
            nama_peminjam = :nama_peminjam,
            identitas_peminjam = :identitas_peminjam,
            no_hp_peminjam = :no_hp_peminjam,
            tanggal_peminjaman = :tanggal_peminjaman,
            tanggal_pengembalian = :tanggal_pengembalian,
            updated_at = CURRENT_TIMESTAMP
        WHERE id = :id";

    try {
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':kategori_barang_id', $kategori_barang_id);
      $stmt->bindParam(':barang_id', $barang_id);
      $stmt->bindParam(':kondisi_barang_id', $kondisi_barang_id);
      $stmt->bindParam(':no_registrasi', $no_registrasi);
      $stmt->bindParam(':nama_detail_barang', $nama_detail_barang);
      $stmt->bindParam(':merk', $merk);
      $stmt->bindParam(':spesifikasi', $spesifikasi);
      $stmt->bindParam(':sumber', $sumber);
      $stmt->bindParam(':jumlah', $jumlah);
      $stmt->bindParam(':satuan', $satuan);
      $stmt->bindParam(':lokasi', $lokasi);
      $stmt->bindParam(':bahan', $bahan);
      $stmt->bindParam(':keterangan', $keterangan);
      $stmt->bindParam(':biaya_pembelian', $biaya_pembelian);
      $stmt->bindParam(':tanggal_pembelian', $tanggal_pembelian);
      $stmt->bindParam(':status', $status);
      $stmt->bindParam(':nama_peminjam', $nama_peminjam);
      $stmt->bindParam(':identitas_peminjam', $identitas_peminjam);
      $stmt->bindParam(':no_hp_peminjam', $no_hp_peminjam);
      $stmt->bindParam(':tanggal_peminjaman', $tanggal_peminjaman);
      $stmt->bindParam(':tanggal_pengembalian', $tanggal_pengembalian);
      $stmt->bindParam(':id', $id);
      return $stmt->execute();
    } catch (PDOException $e) {
      error_log("Error in BarangMebelair::updateData - " . $e->getMessage());
      return false;
    }
  }

  /**
   * Menghapus data barang mebelair
   * 
   * @param PDO $conn Koneksi database
   * @param int $id ID barang mebelair
   * @return bool|string True jika berhasil, pesan error jika gagal
   */
  public static function deleteData($conn, $id) {
    $query = "DELETE FROM sarana_mebelair WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

  /**
   * Mendapatkan data barang mebelair berdasarkan ID
   * 
   * @param PDO $conn Koneksi database
   * @param int $id ID barang mebelair
   * @return array|false Array data atau false jika tidak ditemukan
   */
  public static function getById($conn, $id) {
    $query = "SELECT sm.*, 
                 kb.nama_kategori, 
                 b.nama_barang, 
                 kond.nama_kondisi
                 FROM sarana_mebelair sm
                 LEFT JOIN kategori_barang kb ON sm.kategori_barang_id = kb.id
                 LEFT JOIN barang b ON sm.barang_id = b.id
                 LEFT JOIN kondisi_barang kond ON sm.kondisi_barang_id = kond.id
                 WHERE sm.id = :id";

    try {
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error in BarangMebelair::getById - " . $e->getMessage());
      return false;
    }
  }
}
