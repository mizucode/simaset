<?php

require_once __DIR__ . '/../Models/SaranaMebelair.php'; // Changed model
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/Ruang.php';
require_once __DIR__ . '/../Models/BaseUrlQr.php';
require_once __DIR__ . '/../Models/PeminjamanMB.php'; // Include the new model for MB loans

class SaranaMebelairPinjamController { // Renamed class
  private function renderView(string $view, $data = []) {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Pinjam/SaranaMebelair/{$view}.php"; // Changed view path
  }


  public function update($id) {
    global $conn;
    $sarana = SaranaMebelair::getById($conn, $id); // Changed model
    $kategoriList = KategoriBarang::getAllData($conn);
    $barangList = Barang::getAllData($conn);
    $kondisiList = KondisiBarang::getAllData($conn);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if (!$sarana) {
      $_SESSION['error'] = 'Data sarana mebelair tidak ditemukan.'; // Changed message and redirect
      header('Location: /admin/sarana/mebelair');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $kategori_barang_id = $_POST['kategori_barang_id'];
      $barang_id = $_POST['barang_id'];
      $kondisi_barang_id = $_POST['kondisi_barang_id'];
      $nama_detail_barang = $_POST['nama_detail_barang'];
      $merk = $_POST['merk'] ?? null;
      $spesifikasi = $_POST['spesifikasi'] ?? null; // no_polisi removed
      $sumber = $_POST['sumber'] ?? null;
      $lokasi = $_POST['lokasi'];
      $keterangan = $_POST['keterangan'] ?? null;
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;
      // Ambil jumlah, satuan, dan bahan dari data sarana yang ada, karena tidak diubah di form pinjam
      $jumlah = $sarana['jumlah'] ?? 1;
      $satuan = $sarana['satuan'] ?? 'Unit';
      $bahan = $sarana['bahan'] ?? null;
      $status = $_POST['status'] ?? $sarana['status'] ?? null;
      $nama_peminjam = $_POST['nama_peminjam'] ?? $sarana['nama_peminjam'] ?? null;
      $identitas_peminjam = $_POST['identitas_peminjam'] ?? $sarana['identitas_peminjam'] ?? null;
      $no_hp_peminjam = $_POST['no_hp_peminjam'] ?? $sarana['no_hp_peminjam'] ?? null;
      $tanggal_peminjaman = $_POST['tanggal_peminjaman'] ?? $sarana['tanggal_peminjaman'] ?? null;
      $tanggal_pengembalian = $_POST['tanggal_pengembalian'] ?? $sarana['tanggal_pengembalian'] ?? null;

      try {
        $success = SaranaMebelair::updateData(
          $conn,
          $id,
          $kategori_barang_id,
          $barang_id,
          $kondisi_barang_id,
          $sarana['no_registrasi'],
          $nama_detail_barang,
          $merk,
          $spesifikasi,
          $sumber,
          $jumlah, // Ditambahkan
          $satuan, // Ditambahkan
          $lokasi,
          $bahan,  // Ditambahkan
          $keterangan,
          $biaya_pembelian,
          $tanggal_pembelian,
          $status,
          $nama_peminjam,
          $identitas_peminjam,
          $no_hp_peminjam,
          $tanggal_peminjaman,
          $tanggal_pengembalian
        );

        // Jika update berhasil, simpan ke tabel peminjaman_mb sebagai riwayat
        if ($success && $nama_peminjam && $identitas_peminjam && $no_hp_peminjam && $tanggal_peminjaman && $tanggal_pengembalian) {
          $historySuccess = PeminjamanMB::storeData(
            $conn,
            $sarana['no_registrasi'],
            $nama_detail_barang,
            $nama_peminjam,
            $identitas_peminjam,
            $no_hp_peminjam,
            $tanggal_peminjaman,
            $tanggal_pengembalian,
            $lokasi
          );

          if (!$historySuccess) {
            // Log error jika gagal menyimpan riwayat, tapi tidak menghentikan proses
            error_log("Failed to save peminjaman_mb history for sarana: " . $sarana['no_registrasi']);
          }
        }

        $message = $success ? 'Data sarana mebelair berhasil diperbarui.' : 'Gagal memperbarui data sarana mebelair.'; // Changed message
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/sarana/mebelair/pinjam'); // Changed redirect
          exit();
        }
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database: ' . $e->getMessage();
      }
    }

    $this->renderView('update', [
      'sarana' => $sarana,
      'kategoriList' => $kategoriList,
      'barangList' => $barangList,
      'kondisiList' => $kondisiList,
      "lapangData" => $lapangData,
      "ruangData" => $ruangData,
    ]);
  }




  public function index() {
    global $conn;
    $saranaData = SaranaMebelair::getAllStatus($conn); // Changed model
    $peminjaman = PeminjamanMB::getAllData($conn); // Tambahkan data riwayat peminjaman

    $this->renderView('index', [
      'saranaData' => $saranaData,
      'peminjaman' => $peminjaman, // Kirim data riwayat ke view
    ]);
  }

  public function indexPeminjaman() {
    global $conn;
    $saranaData = SaranaMebelair::getAllStatusExDipinjam($conn); // Changed model
    $this->renderView('indexPeminjaman', [
      'saranaData' => $saranaData,
    ]);
  }

  /**
   * Menampilkan riwayat peminjaman sarana mebelair
   */
  public function riwayat() {
    global $conn;
    $peminjamanData = PeminjamanMB::getAllData($conn);
    
    $this->renderView('riwayat', [
      'peminjamanData' => $peminjamanData,
    ]);
  }
}
