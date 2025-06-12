<?php

// Pastikan path ini benar dan file model ada
require_once __DIR__ . '/../Models/SaranaElektronik.php';
require_once __DIR__ . '/../Models/DokumenSaranaElektronik.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/Ruang.php';

class SaranaElektronikKondisiController {
  private function renderView(string $view, $data = []) {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Kondisi/SaranaElektronik/{$view}.php";
  }


  public function update($id) {
    global $conn;
    $sarana = SaranaElektronik::getById($conn, $id);
    $kategoriList = KategoriBarang::getAllData($conn);
    $barangList = Barang::getAllData($conn);
    $kondisiList = KondisiBarang::getAllData($conn);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if (!$sarana) {
      $_SESSION['error'] = 'Data sarana elektronik tidak ditemukan.';
      header('Location: /admin/sarana/elektronik');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $kategori_barang_id = $_POST['kategori_barang_id'];
      $barang_id = $_POST['barang_id'];
      $kondisi_barang_id = $_POST['kondisi_barang_id'];
      $nama_detail_barang = $_POST['nama_detail_barang'];
      $merk = $_POST['merk'] ?? null;
      $spesifikasi = $_POST['spesifikasi'] ?? null;
      $tipe = $_POST['tipe'] ?? null;
      $jumlah = $_POST['jumlah'] ?? $sarana['jumlah'];
      $satuan = $_POST['satuan'] ?? $sarana['satuan'];
      $lokasi = $_POST['lokasi'];
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;
      $keterangan = $_POST['keterangan'] ?? null;

      // Ambil status dan detail peminjam dari data sarana yang ada,
      // karena form ini fokus pada pembaruan kondisi.
      $status = $sarana['status'] ?? 'Tersedia'; // Default ke 'Tersedia' jika tidak ada
      $nama_peminjam = $sarana['nama_peminjam'] ?? null;
      $identitas_peminjam = $sarana['identitas_peminjam'] ?? null;
      $no_hp_peminjam = $sarana['no_hp_peminjam'] ?? null;
      $tanggal_peminjaman = $sarana['tanggal_peminjaman'] ?? null; // Ambil dari data sarana yang ada
      $tanggal_pengembalian = $sarana['tanggal_pengembalian'] ?? null; // Ambil dari data sarana yang ada

      try {
        $success = SaranaElektronik::updateData(
          $conn,
          $id,
          $kategori_barang_id,
          $barang_id,
          $kondisi_barang_id,
          $sarana['no_registrasi'],
          $nama_detail_barang,
          $merk,
          $spesifikasi,
          $tipe,
          $jumlah,
          $satuan,
          $lokasi,
          $biaya_pembelian,
          $tanggal_pembelian,
          $keterangan,
          $status,
          $nama_peminjam,
          $identitas_peminjam,
          $no_hp_peminjam,
          $tanggal_peminjaman,    // Tambahkan parameter
          $tanggal_pengembalian   // Tambahkan parameter
        );

        $message = $success ? 'Data sarana elektronik berhasil diperbarui.' : 'Gagal memperbarui data sarana elektronik.';
        $_SESSION['update'] = $message;

        header('Location: /admin/sarana/elektronik?detail=' . $id);
        exit();
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
    $saranaData = SaranaElektronik::getAllData($conn);

    $this->renderView('index', [
      'saranaData' => $saranaData,
    ]);
  }
}
