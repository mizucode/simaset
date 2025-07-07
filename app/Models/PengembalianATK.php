<?php

class PengembalianATK
{
  /**
   * Menyimpan riwayat transaksi (peminjaman atau pengembalian) untuk Sarana ATK.
   *
   * @param PDO $conn Koneksi database.
   * @param string $nomor_registrasi Nomor registrasi barang.
   * @param string $nama_barang Nama barang.
   * @param string $nama_peminjam Nama peminjam/pengembali.
   * @param string $nomor_identitas Nomor identitas peminjam/pengembali.
   * @param string $nomor_hp_peminjam Nomor HP peminjam/pengembali.
   * @param string $tanggal_peminjaman Tanggal barang dipinjam.
   * @param string $tanggal_rencana_pengembalian Tanggal rencana pengembalian.
   * @param string $lokasi_penempatan_barang Lokasi barang saat transaksi.
   * @param string $status Status transaksi, contoh: 'Dipinjam' atau 'Dikembalikan'.
   * @return bool True jika berhasil, false jika gagal.
   */
  public static function catatRiwayat(
    PDO $conn,
    string $nomor_registrasi,
    string $nama_barang,
    ?string $nama_peminjam,
    ?string $nomor_identitas,
    ?string $nomor_hp_peminjam,
    ?string $tanggal_peminjaman,
    ?string $tanggal_rencana_pengembalian,
    string $lokasi_penempatan_barang,
    string $status // 'Dipinjam' atau 'Dikembalikan'
  ): bool {
    try {
      // Menambahkan kolom tanggal_aktual_pengembalian jika statusnya 'Dikembalikan'
      $tanggal_aktual_pengembalian = ($status === 'Dikembalikan') ? date('Y-m-d H:i:s') : null;

      $stmt = $conn->prepare("
          INSERT INTO pengembalian_atk (
              nomor_registrasi,
              nama_barang,
              nama_peminjam,
              nomor_identitas,
              nomor_hp_peminjam,
              tanggal_peminjaman,
              tanggal_rencana_pengembalian,
              tanggal_aktual_pengembalian,
              lokasi_penempatan_barang,
              status
          ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
      ");

      return $stmt->execute([
        $nomor_registrasi,
        $nama_barang,
        $nama_peminjam,
        $nomor_identitas,
        $nomor_hp_peminjam,
        $tanggal_peminjaman,
        $tanggal_rencana_pengembalian,
        $tanggal_aktual_pengembalian,
        $lokasi_penempatan_barang,
        $status
      ]);
    } catch (PDOException $e) {
      error_log("Error saat mencatat riwayat ATK: " . $e->getMessage());
      return false;
    }
  }

  /**
   * Mengambil semua data riwayat dari tabel pengembalian_atk.
   */
  public static function getAllData(PDO $conn): array
  {
    try {
      $stmt = $conn->query("SELECT * FROM pengembalian_atk ORDER BY created_at DESC");
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      error_log("Error mengambil data riwayat ATK: " . $e->getMessage());
      return [];
    }
  }
}
