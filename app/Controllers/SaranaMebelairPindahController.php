<?php

// Asumsi ada model DokumenSaranaMebelair.php yang serupa dengan DokumenSaranaBergerak.php
require_once __DIR__ . '/../Models/SaranaMebelair.php';
require_once __DIR__ . '/../Models/DokumenSaranaMebelair.php'; // Diperlukan untuk fitur dokumen & gambar
// Model lain yang mungkin masih relevan (sesuai kebutuhan create/update form Mebelair)
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/Ruang.php';
require_once __DIR__ . '/../Models/BaseUrlQr.php';


class SaranaMebelairPindahController {
  private function renderView(string $view, $data = []) {
    extract($data);
    // Path view disesuaikan untuk Mebelair
    require_once __DIR__ . "/../Views/Pages/Pindah/SaranaMebelair/{$view}.php";
  }


  public function update($id) {
    global $conn;
    $sarana = SaranaMebelair::getById($conn, $id);
    $kategoriList = KategoriBarang::getAllData($conn);
    $barangList = Barang::getAllData($conn); // Tidak perlu difilter di update, karena barang sudah terpilih
    $kondisiList = KondisiBarang::getAllData($conn);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if (!$sarana) {
      $_SESSION['error'] = 'Data sarana mebelair tidak ditemukan.';
      header('Location: /admin/sarana/mebelair/pindah'); // Path redirect disesuaikan for Pindah context
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Field spesifik untuk Sarana Mebelair
      $kategori_barang_id = $_POST['kategori_barang_id'];
      $barang_id = $_POST['barang_id'];
      $kondisi_barang_id = $_POST['kondisi_barang_id'];
      // $no_registrasi dari $sarana['no_registrasi'] (tidak diubah saat update, sesuai template)
      $nama_detail_barang = $_POST['nama_detail_barang'];
      $merk = $_POST['merk'] ?? null;
      $spesifikasi = $_POST['spesifikasi'] ?? null;
      $sumber = $_POST['sumber'] ?? null;
      $jumlah = $_POST['jumlah'] ?? 1;
      $satuan = $_POST['satuan'] ?? 'Unit';
      $lokasi = $_POST['lokasi'];
      $bahan = $_POST['bahan'] ?? null;
      $keterangan = $_POST['keterangan'] ?? null;
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? $sarana['tanggal_pembelian']; // Ambil dari post atau existing
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? $sarana['biaya_pembelian']; // Ambil dari post atau existing

      // Fields for status and peminjam details
      $status = $_POST['status'] ?? $sarana['status'] ?? 'Tersedia';
      $nama_peminjam = $_POST['nama_peminjam'] ?? $sarana['nama_peminjam'] ?? null;
      $identitas_peminjam = $_POST['identitas_peminjam'] ?? $sarana['identitas_peminjam'] ?? null;
      $no_hp_peminjam = $_POST['no_hp_peminjam'] ?? $sarana['no_hp_peminjam'] ?? null;
      $tanggal_peminjaman = $sarana['tanggal_peminjaman'] ?? null; // Ambil dari data sarana yang ada
      $tanggal_pengembalian = $sarana['tanggal_pengembalian'] ?? null; // Ambil dari data sarana yang ada

      try {
        $success = SaranaMebelair::updateData(
          $conn,
          $id,
          $kategori_barang_id,
          $barang_id,
          $kondisi_barang_id,
          $sarana['no_registrasi'], // Nomor registrasi tidak diubah saat update
          $nama_detail_barang,
          $merk,
          $spesifikasi,
          $sumber,
          $jumlah,
          $satuan,
          $lokasi,
          $bahan,
          $keterangan,
          $biaya_pembelian, // tambahkan jika ada
          $tanggal_pembelian, // tambahkan jika ada
          $status,
          $nama_peminjam,
          $identitas_peminjam,
          $no_hp_peminjam,
          $tanggal_peminjaman,    // Tambahkan parameter
          $tanggal_pengembalian   // Tambahkan parameter
        );

        $message = $success ? 'Data sarana mebelair berhasil diperbarui.' : 'Gagal memperbarui data sarana mebelair.';
        $_SESSION['update'] = $message;

        header('Location: /admin/sarana/mebelair/pindah'); // Path redirect disesuaikan for Pindah context
        exit();
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database: ' . $e->getMessage();
      }
    }

    $this->renderView('update', [
      'sarana' => $sarana,
      'kategoriList' => $kategoriList,
      'barangList' => $barangList, // Kirim semua barang untuk dropdown
      'kondisiList' => $kondisiList,
      "lapangData" => $lapangData,
      "ruangData" => $ruangData,
    ]);
  }




  public function index() {
    global $conn;
    $saranaData = SaranaMebelair::getAllData($conn);

    $this->renderView('index', [
      'saranaData' => $saranaData,
    ]);
  }
}
