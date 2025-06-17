<?php

class SaranaElektronik
{
  /**
   * Mendapatkan semua data barang elektronik dengan join ke tabel terkait
   * 
   * @param PDO $conn Koneksi database
   * @return array|string Array data atau pesan error
   */
  public static function getAllData($conn)
  {
    $query = "SELECT se.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
                  FROM sarana_elektronik se
                  JOIN kategori_barang kb ON se.kategori_barang_id = kb.id
                  JOIN barang b ON se.barang_id = b.id
                  JOIN kondisi_barang kond ON se.kondisi_barang_id = kond.id";

    try {
      $stmt = $conn->query($query);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error in SaranaElektronik::getAllData - " . $e->getMessage());
      return [];
    }
  }

  public static function getAllStatus($conn)
  {
    $query = "SELECT se.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
                  FROM sarana_elektronik se
                  JOIN kategori_barang kb ON se.kategori_barang_id = kb.id
                  JOIN barang b ON se.barang_id = b.id
                  JOIN kondisi_barang kond ON se.kondisi_barang_id = kond.id
                  WHERE se.status = 'Dipinjam'";

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
    $query = "SELECT se.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
                  FROM sarana_elektronik se
                  JOIN kategori_barang kb ON se.kategori_barang_id = kb.id
                  JOIN barang b ON se.barang_id = b.id
                  JOIN kondisi_barang kond ON se.kondisi_barang_id = kond.id
                  WHERE se.status = 'Tersedia'";

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
    $query = "SELECT se.*, kb.nama_kategori AS kategori, b.nama_barang AS barang, kond.nama_kondisi AS kondisi
                  FROM sarana_elektronik se
                  JOIN kategori_barang kb ON se.kategori_barang_id = kb.id
                  JOIN barang b ON se.barang_id = b.id
                  JOIN kondisi_barang kond ON se.kondisi_barang_id = kond.id
                  WHERE se.status != 'Dipinjam'";

    $stmt = $conn->prepare($query);
    try {
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return "Query gagal: " . $e->getMessage();
    }
  }

  /**
   * Menyimpan data baru barang elektronik
   * 
   * @param PDO $conn Koneksi database
   * @param array $data Data barang elektronik
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
    $tipe,
    $sumber, // Tambahkan parameter sumber
    $jumlah,
    $satuan,
    $lokasi,
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
      'tipe' => $tipe,
      'sumber' => $sumber,
      'jumlah' => $jumlah,
      'satuan' => $satuan,
      'lokasi' => $lokasi,
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

    $query = "INSERT INTO sarana_elektronik ($columns) VALUES ($placeholders)";

    try {
      $stmt = $conn->prepare($query);
      return $stmt->execute($fields);
    } catch (PDOException $e) {
      error_log("Error in SaranaElektronik::storeData - " . $e->getMessage());
      return false;
    }
  }

  /**
   * Memperbarui data barang elektronik
   * 
   * @param PDO $conn Koneksi database
   * @param int $id ID barang elektronik
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
    $tipe,
    $sumber, // Tambahkan parameter sumber
    $jumlah,
    $satuan,
    $lokasi,
    $biaya_pembelian,
    $tanggal_pembelian,
    $keterangan,
    $status, // Parameter status ditambahkan
    $nama_peminjam,
    $identitas_peminjam,
    $no_hp_peminjam,
    $tanggal_peminjaman,
    $tanggal_pengembalian
  ) {
    $query = "UPDATE sarana_elektronik SET
            kategori_barang_id = :kategori_barang_id,
            barang_id = :barang_id,
            kondisi_barang_id = :kondisi_barang_id,
            no_registrasi = :no_registrasi,
            nama_detail_barang = :nama_detail_barang,
            merk = :merk,
            spesifikasi = :spesifikasi,
            tipe = :tipe,
            sumber = :sumber,
            jumlah = :jumlah,
            satuan = :satuan,
            lokasi = :lokasi,
            biaya_pembelian = :biaya_pembelian,
            tanggal_pembelian = :tanggal_pembelian,
            keterangan = :keterangan,
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
      $stmt->bindParam(':tipe', $tipe);
      $stmt->bindParam(':sumber', $sumber);
      $stmt->bindParam(':jumlah', $jumlah);
      $stmt->bindParam(':satuan', $satuan);
      $stmt->bindParam(':lokasi', $lokasi);
      $stmt->bindParam(':biaya_pembelian', $biaya_pembelian);
      $stmt->bindParam(':tanggal_pembelian', $tanggal_pembelian);
      $stmt->bindParam(':keterangan', $keterangan);
      $stmt->bindParam(':status', $status);
      $stmt->bindParam(':nama_peminjam', $nama_peminjam);
      $stmt->bindParam(':identitas_peminjam', $identitas_peminjam);
      $stmt->bindParam(':no_hp_peminjam', $no_hp_peminjam);
      $stmt->bindParam(':tanggal_peminjaman', $tanggal_peminjaman);
      $stmt->bindParam(':tanggal_pengembalian', $tanggal_pengembalian);
      $stmt->bindParam(':id', $id);
      return $stmt->execute();
    } catch (PDOException $e) {
      error_log("Error in SaranaElektronik::updateData - " . $e->getMessage());
      return false;
    }
  }

  /**
   * Menghapus data barang elektronik
   * 
   * @param PDO $conn Koneksi database
   * @param int $id ID barang elektronik
   * @return bool|string True jika berhasil, pesan error jika gagal
   */
  public static function deleteData($conn, $id)
  {
    $query = "DELETE FROM sarana_elektronik WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

  /**
   * Mendapatkan data barang elektronik berdasarkan ID
   * 
   * @param PDO $conn Koneksi database
   * @param int $id ID barang elektronik
   * @return array|false Array data atau false jika tidak ditemukan
   */
  public static function getById($conn, $id)
  {
    $query = "SELECT se.*, 
                 kb.nama_kategori, 
                 b.nama_barang, 
                 kond.nama_kondisi
                 FROM sarana_elektronik se
                 LEFT JOIN kategori_barang kb ON se.kategori_barang_id = kb.id
                 LEFT JOIN barang b ON se.barang_id = b.id
                 LEFT JOIN kondisi_barang kond ON se.kondisi_barang_id = kond.id
                 WHERE se.id = :id";

    try {
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':id', $id, PDO::PARAM_INT);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error in SaranaElektronik::getById - " . $e->getMessage());
      return false;
    }
  }

  /**
   * Memperbarui kondisi dan lokasi barang elektronik berdasarkan nomor registrasi.
   *
   * @param PDO $conn Koneksi database.
   * @param string $no_registrasi Nomor registrasi barang.
   * @param int $kondisi_barang_id_baru ID kondisi barang yang baru.
   * @param string $lokasi_baru Lokasi barang yang baru.
   * @return bool True jika berhasil, false jika gagal.
   */
  public static function updateKondisiLokasiByNoReg($conn, $no_registrasi, $kondisi_barang_id_baru, $lokasi_baru)
  {
    $query = "UPDATE sarana_elektronik SET 
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
      error_log("Error in SaranaElektronik::updateKondisiLokasiByNoReg - " . $e->getMessage());
      return false;
    }
  }

  /**
   * Mendapatkan data barang elektronik berdasarkan Nomor Registrasi
   * 
   * @param PDO $conn Koneksi database
   * @param string $no_registrasi Nomor Registrasi barang elektronik
   * @return array|false Array data atau false jika tidak ditemukan
   */
  public static function getByNoRegistrasi($conn, $no_registrasi)
  {
    $query = "SELECT se.*, 
                 kb.nama_kategori, 
                 b.nama_barang, 
                 kond.nama_kondisi
                 FROM sarana_elektronik se
                 LEFT JOIN kategori_barang kb ON se.kategori_barang_id = kb.id
                 LEFT JOIN barang b ON se.barang_id = b.id
                 LEFT JOIN kondisi_barang kond ON se.kondisi_barang_id = kond.id
                 WHERE se.no_registrasi = :no_registrasi";
    try {
      $stmt = $conn->prepare($query);
      $stmt->bindParam(':no_registrasi', $no_registrasi, PDO::PARAM_STR);
      $stmt->execute();
      return $stmt->fetch(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error in SaranaElektronik::getByNoRegistrasi - " . $e->getMessage());
      return false;
    }
  }
}
