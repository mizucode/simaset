<?php

require_once __DIR__ . '/../Models/SaranaElektronik.php';
require_once __DIR__ . '/../Models/BaseUrlQr.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/Ruang.php';

class SaranaElektronikPinjamController {
  private function renderView(string $view, $data = []) {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Pinjam/SaranaElektronik/{$view}.php";
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
      header('Location: /admin/sarana/elektronik/pinjam');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Fields for SaranaElektronik::updateData, taken from POST if available, otherwise from $sarana
      $kategori_barang_id = $_POST['kategori_barang_id'] ?? $sarana['kategori_barang_id'];
      $barang_id = $_POST['barang_id'] ?? $sarana['barang_id'];
      $kondisi_barang_id = $_POST['kondisi_barang_id'] ?? $sarana['kondisi_barang_id'];
      $nama_detail_barang = $_POST['nama_detail_barang'] ?? $sarana['nama_detail_barang'];
      $merk = $_POST['merk'] ?? $sarana['merk'];
      $spesifikasi = $_POST['spesifikasi'] ?? $sarana['spesifikasi'];
      $tipe = $_POST['tipe'] ?? $sarana['tipe']; // Specific to Elektronik
      $jumlah = $sarana['jumlah']; // From existing, not from POST for pinjam
      $satuan = $sarana['satuan']; // From existing, not from POST for pinjam
      $lokasi = $_POST['lokasi'];
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? $sarana['biaya_pembelian'];
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? $sarana['tanggal_pembelian'];
      $keterangan_sarana = $_POST['keterangan'] ?? $sarana['keterangan'];

      // Pinjam specific fields (collected but NOT passed to SaranaElektronik::updateData as it doesn't accept them)
      $status = $_POST['status'] ?? $sarana['status'] ?? null;
      $nama_peminjam = $_POST['nama_peminjam'] ?? $sarana['nama_peminjam'] ?? null;
      $identitas_peminjam = $_POST['identitas_peminjam'] ?? $sarana['identitas_peminjam'] ?? null;
      $no_hp_peminjam = $_POST['no_hp_peminjam'] ?? $sarana['no_hp_peminjam'] ?? null;
      $tanggal_peminjaman = $_POST['tanggal_peminjaman'] ?? $sarana['tanggal_peminjaman'] ?? null;
      $tanggal_pengembalian = $_POST['tanggal_pengembalian'] ?? $sarana['tanggal_pengembalian'] ?? null;

      try {
        // SaranaElektronik::updateData now handles peminjam details. Status is not handled by this model method.
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
          $keterangan_sarana,
          $status, // Ditambahkan argumen status yang hilang
          $nama_peminjam,
          $identitas_peminjam,
          $no_hp_peminjam,
          $tanggal_peminjaman,
          $tanggal_pengembalian
        );

        $message = $success ? 'Data sarana elektronik berhasil diperbarui.' : 'Gagal memperbarui data sarana elektronik.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/sarana/elektronik/pinjam');
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
    $saranaData = SaranaElektronik::getAllStatus($conn);


    $this->renderView('index', [
      'saranaData' => $saranaData,
    ]);
  }

  public function indexPeminjaman() {
    global $conn;
    $saranaData = SaranaElektronik::getAllStatusExDipinjam($conn);
    $this->renderView('indexPeminjaman', [
      'saranaData' => $saranaData,
    ]);
  }
}
