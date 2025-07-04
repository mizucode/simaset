<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Tanah
{
  public static function getAllData($conn)
  {
    $query = "SELECT aset_tanah.*, jenis_aset.jenis_aset 
              FROM aset_tanah 
              JOIN jenis_aset ON aset_tanah.jenis_aset_id = jenis_aset.id";
    $stmt = $conn->prepare($query);
    try {
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return "Query gagal: " . $e->getMessage();
    }
  }

  public static function getById($conn, $id)
  {
    $query = "SELECT aset_tanah.*, jenis_aset.jenis_aset 
              FROM aset_tanah 
              JOIN jenis_aset ON aset_tanah.jenis_aset_id = jenis_aset.id
              WHERE aset_tanah.id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public static function storeData(
    $conn,
    $kode_aset,
    $nama_aset,
    $jenis_aset_id,
    $nomor_sertifikat,
    $luas,
    $lokasi,
    $tgl_pajak,
    $sumber_perolehan,
    $tanggal_perolehan,
    $harga_perolehan_rp,
    $alamat_lengkap,
    $koordinat_centroid_lat,
    $koordinat_centroid_lon,
    $njop_bumi_per_m2,
    $unit_pengguna,
    $status_kepemilikan,
    $jenis_sertifikat,
    $tanggal_terbit_sertifikat,
    $nama_pemegang_hak,
    $fungsi,
    $keterangan,
  ) {
    $fields = [
      'kode_aset' => $kode_aset,
      'nama_aset' => $nama_aset,
      'jenis_aset_id' => $jenis_aset_id,
      'nomor_sertifikat' => $nomor_sertifikat,
      'luas' => $luas,
      'lokasi' => $lokasi,
      'tgl_pajak' => $tgl_pajak,
      'sumber_perolehan' => $sumber_perolehan,
      'tanggal_perolehan' => $tanggal_perolehan,
      'harga_perolehan_rp' => $harga_perolehan_rp,
      'alamat_lengkap' => $alamat_lengkap,
      'koordinat_centroid_lat' => $koordinat_centroid_lat,
      'koordinat_centroid_lon' => $koordinat_centroid_lon,
      'njop_bumi_per_m2' => $njop_bumi_per_m2,
      'unit_pengguna' => $unit_pengguna,
      'status_kepemilikan' => $status_kepemilikan,
      'jenis_sertifikat' => $jenis_sertifikat,
      'tanggal_terbit_sertifikat' => $tanggal_terbit_sertifikat,
      'nama_pemegang_hak' => $nama_pemegang_hak,
      'fungsi' => $fungsi,
      'keterangan' => $keterangan,
    ];

    $columns = implode(', ', array_keys($fields));
    $placeholders = ':' . implode(', :', array_keys($fields));

    $query = "INSERT INTO aset_tanah ($columns) VALUES ($placeholders)";
    $stmt = $conn->prepare($query);

    foreach ($fields as $key => $value) {
      $stmt->bindValue(":$key", $value);
    }

    return $stmt->execute();
  }

  public static function updateData(
    $conn,
    $id,
    $kode_aset,
    $nama_aset,
    $jenis_aset_id,
    $nomor_sertifikat,
    $luas,
    $lokasi,
    $tgl_pajak,
    $sumber_perolehan,
    $tanggal_perolehan,
    $harga_perolehan_rp,
    $alamat_lengkap,
    $koordinat_centroid_lat,
    $koordinat_centroid_lon,
    $njop_bumi_per_m2,
    $unit_pengguna,
    $status_kepemilikan,
    $jenis_sertifikat,
    $tanggal_terbit_sertifikat,
    $nama_pemegang_hak,
    $fungsi,
    $keterangan,
  ) {
    $query = "UPDATE aset_tanah SET 
                kode_aset = :kode_aset,
                nama_aset = :nama_aset,
                jenis_aset_id = :jenis_aset_id,
                nomor_sertifikat = :nomor_sertifikat,
                luas = :luas,
                lokasi = :lokasi,
                tgl_pajak = :tgl_pajak,
                sumber_perolehan = :sumber_perolehan,
                tanggal_perolehan = :tanggal_perolehan,
                harga_perolehan_rp = :harga_perolehan_rp,
                alamat_lengkap = :alamat_lengkap,
                koordinat_centroid_lat = :koordinat_centroid_lat,
                koordinat_centroid_lon = :koordinat_centroid_lon,
                njop_bumi_per_m2 = :njop_bumi_per_m2,
                unit_pengguna = :unit_pengguna,
                status_kepemilikan = :status_kepemilikan,
                jenis_sertifikat = :jenis_sertifikat,
                tanggal_terbit_sertifikat = :tanggal_terbit_sertifikat,
                nama_pemegang_hak = :nama_pemegang_hak,
                fungsi = :fungsi,
                keterangan = :keterangan
                WHERE id = :id";

    $stmt = $conn->prepare($query);
    $stmt->bindParam(':kode_aset', $kode_aset);
    $stmt->bindParam(':nama_aset', $nama_aset);
    $stmt->bindParam(':jenis_aset_id', $jenis_aset_id);
    $stmt->bindParam(':nomor_sertifikat', $nomor_sertifikat);
    $stmt->bindParam(':luas', $luas);
    $stmt->bindParam(':lokasi', $lokasi);
    $stmt->bindParam(':tgl_pajak', $tgl_pajak);
    $stmt->bindParam(':sumber_perolehan', $sumber_perolehan);
    $stmt->bindParam(':tanggal_perolehan', $tanggal_perolehan);
    $stmt->bindParam(':harga_perolehan_rp', $harga_perolehan_rp);
    $stmt->bindParam(':alamat_lengkap', $alamat_lengkap);
    $stmt->bindParam(':koordinat_centroid_lat', $koordinat_centroid_lat);
    $stmt->bindParam(':koordinat_centroid_lon', $koordinat_centroid_lon);
    $stmt->bindParam(':njop_bumi_per_m2', $njop_bumi_per_m2);
    $stmt->bindParam(':unit_pengguna', $unit_pengguna);
    $stmt->bindParam(':status_kepemilikan', $status_kepemilikan);
    $stmt->bindParam(':jenis_sertifikat', $jenis_sertifikat);
    $stmt->bindParam(':tanggal_terbit_sertifikat', $tanggal_terbit_sertifikat);
    $stmt->bindParam(':nama_pemegang_hak', $nama_pemegang_hak);
    $stmt->bindParam(':fungsi', $fungsi);
    $stmt->bindParam(':keterangan', $keterangan);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
  }

  public static function deleteData($conn, $id)
  {
    $query = "DELETE FROM aset_tanah WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    return $stmt->execute();
  }

  public static function storeDokumenTanah(
    $conn,
    $aset_tanah_id,
    $nama_dokumen,
    $path_dokumen
  ) {
    $fields = [
      'aset_tanah_id' => $aset_tanah_id,
      'nama_dokumen' => $nama_dokumen,
      'path_dokumen' => $path_dokumen

    ];

    $columns = implode(', ', array_keys($fields));
    $placeholders = ':' . implode(', :', array_keys($fields));

    $query = "INSERT INTO dokumen_aset_tanah ($columns) VALUES ($placeholders)";
    $stmt = $conn->prepare($query);

    foreach ($fields as $key => $value) {
      $stmt->bindValue(":$key", $value);
    }

    return $stmt->execute();
  }
  public static function storeDokumentasiTanah(
    $conn,
    $aset_tanah_id,
    $nama_dokumen,
    $path_dokumen
  ) {
    $fields = [
      'aset_tanah_id' => $aset_tanah_id,
      'nama_dokumen' => $nama_dokumen,
      'path_dokumen' => $path_dokumen

    ];

    $columns = implode(', ', array_keys($fields));
    $placeholders = ':' . implode(', :', array_keys($fields));

    $query = "INSERT INTO dokumentasi_tanah ($columns) VALUES ($placeholders)";
    $stmt = $conn->prepare($query);

    foreach ($fields as $key => $value) {
      $stmt->bindValue(":$key", $value);
    }

    return $stmt->execute();
  }
}
