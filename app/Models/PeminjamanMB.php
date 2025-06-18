<?php

class PeminjamanMB
{
  /**
   * Stores a new loan record for a Sarana Bergerak item.
   * The item is identified by its registration number and name.
   *
   * @param PDO $conn The database connection.
   * @param string $nomor_registrasi The registration number of the borrowed item.
   * @param string $nama_barang The name of the borrowed item.
   * @param string $nama_peminjam The name of the borrower.
   * @param string $nomor_identitas The identity number of the borrower.
   * @param string $nomor_hp_peminjam The phone number of the borrower.
   * @param string $tanggal_peminjaman The date the item was borrowed (e.g., 'YYYY-MM-DD').
   * @param string $tanggal_rencana_pengembalian The planned return date (e.g., 'YYYY-MM-DD').
   * @param string $lokasi_penempatan_barang The placement location of the item.
   * @return bool True on success, false on failure.
   */
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
    try {
      $stmt = $conn->prepare("
                INSERT INTO peminjaman_mb (
                    nomor_registrasi,
                    nama_barang,
                    nama_peminjam,
                    nomor_identitas,
                    nomor_hp_peminjam,
                    tanggal_peminjaman,
                    tanggal_rencana_pengembalian,
                    lokasi_penempatan_barang,
                    status -- Default status 'Dipinjam' upon creation
                ) VALUES (
                    ?, ?, ?, ?, ?, ?, ?, ?, 'Dipinjam'
                )
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
      // Log the error for debugging purposes
      error_log("Error saving peminjaman_mb history: " . $e->getMessage());
      // Depending on requirements, you might want to re-throw or handle differently
      return false; // Indicate failure to save history
    }
  }

  /**
   * Retrieves all loan records from the peminjaman_bb table.
   *
   * @param PDO $conn The database connection.
   * @return array An array of all loan records, or an empty array on failure or if no records exist.
   */
  public static function getAllData(PDO $conn): array
  {
    try {
      $stmt = $conn->query("SELECT * FROM peminjaman_mb");
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      // Log the error for debugging purposes
      error_log("Error retrieving peminjaman_mb data: " . $e->getMessage());
      return []; // Indicate failure or no data
    }
  }
  // Add other methods like getById, updateStatus, etc. if needed later
}
