<?php

class RiwayatPengembalian
{
  public static function storeData(
    PDO $conn,
    string $nomor_registrasi,
    string $nama_barang,
    string $nama_peminjam,
    string $nomor_identitas,
    string $nomor_hp_peminjam,
    string $tanggal_peminjaman,
    string $tanggal_rencana_pengembalian,
    string $lokasi_penempatan_barang
  ): bool {
    $fields = [
      'nomor_registrasi' => $nomor_registrasi,
      'nama_barang' => $nama_barang,
      'nama_peminjam' => $nama_peminjam,
      'nomor_identitas' => $nomor_identitas,
      'nomor_hp_peminjam' => $nomor_hp_peminjam,
      'tanggal_peminjaman' => $tanggal_peminjaman,
      'tanggal_rencana_pengembalian' => $tanggal_rencana_pengembalian,
      'lokasi_penempatan_barang' => $lokasi_penempatan_barang,
      'status' => 'Dikembalikan'
    ];

    $columns = implode(', ', array_keys($fields));
    $placeholders = ':' . implode(', :', array_keys($fields));

    $query = "INSERT INTO riwayat_pengembalian ($columns) VALUES ($placeholders)";

    try {
      $stmt = $conn->prepare($query);

      foreach ($fields as $key => $value) {
        $stmt->bindValue(":$key", $value);
      }

      return $stmt->execute();
    } catch (PDOException $e) {
      error_log("Error saving peminjaman_bb history: " . $e->getMessage());
      return false;
    }
  }


  public static function getAllData($conn)
  {
    $query = "SELECT * FROM riwayat_pengembalian ORDER BY id DESC;";

    try {
      $stmt = $conn->query($query);
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error in RiwayatPeminjaman::getAllData - " . $e->getMessage());
      return [];
    }
  }
}
