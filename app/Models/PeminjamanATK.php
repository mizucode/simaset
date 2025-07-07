<?php

class PeminjamanATK
{
  public static function storeData(
    PDO $conn,
    string $nomor_registrasi,
    string $nama_barang,
    ?string $nama_peminjam,
    ?string $nomor_identitas,
    ?string $nomor_hp_peminjam,
    ?string $tanggal_peminjaman,
    ?string $tanggal_rencana_pengembalian,
    string $lokasi_penempatan_barang
  ): bool {
    try {
      $stmt = $conn->prepare("
          INSERT INTO peminjaman_atk (
              nomor_registrasi,
              nama_barang,
              nama_peminjam,
              nomor_identitas,
              nomor_hp_peminjam,
              tanggal_peminjaman,
              tanggal_rencana_pengembalian,
              lokasi_penempatan_barang,
              status
          ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, 'Dipinjam')
      ");

      return $stmt->execute([
        $nomor_registrasi,
        $nama_barang,
        $nama_peminjam,
        $nomor_identitas,
        $nomor_hp_peminjam,
        $tanggal_peminjaman,
        $tanggal_rencana_pengembalian,
        $lokasi_penempatan_barang
      ]);
    } catch (PDOException $e) {
      error_log("Error saving peminjaman_atk history: " . $e->getMessage());
      return false;
    }
  }

  public static function getAllData(PDO $conn): array
  {
    try {
      $stmt = $conn->query("SELECT * FROM peminjaman_atk ORDER BY created_at DESC");
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error retrieving peminjaman_atk data: " . $e->getMessage());
      return [];
    }
  }
}
