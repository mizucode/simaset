<?php

require_once __DIR__ . '/../Models/DokumenSaranaBergerak.php';
require_once __DIR__ . '/../Models/BaseUrlQr.php';
require_once __DIR__ . '/../Models/PeminjamanBB.php'; // Include the new model

class SaranaBergerakPinjamController
{
  private function renderView(string $view, $data = [])
  {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Pinjam/SaranaBergerak/{$view}.php";
  }


  public function update($id)
  {
    global $conn;
    $sarana = SaranaBergerak::getById($conn, $id);
    $kategoriList = KategoriBarang::getAllData($conn);
    $barangList = Barang::getAllData($conn);
    $kondisiList = KondisiBarang::getAllData($conn);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if (!$sarana) {
      $_SESSION['error'] = 'Data sarana bergerak tidak ditemukan.';
      header('Location: /admin/sarana/bergerak');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $kategori_barang_id = $_POST['kategori_barang_id'];
      $barang_id = $_POST['barang_id'];
      $kondisi_barang_id = $_POST['kondisi_barang_id'];
      $nama_detail_barang = $_POST['nama_detail_barang'];
      $merk = $_POST['merk'] ?? null;
      $spesifikasi = $_POST['spesifikasi'] ?? null;
      $no_polisi = $_POST['no_polisi'] ?? null;
      $sumber = $_POST['sumber'] ?? null;
      $lokasi = $_POST['lokasi'];
      $keterangan = $_POST['keterangan'] ?? null;
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;
      $status = $_POST['status'] ?? $sarana['status'] ?? null;
      $nama_peminjam = $_POST['nama_peminjam'] ?? $sarana['nama_peminjam'] ?? null;
      $identitas_peminjam = $_POST['identitas_peminjam'] ?? $sarana['identitas_peminjam'] ?? null;
      $no_hp_peminjam = $_POST['no_hp_peminjam'] ?? $sarana['no_hp_peminjam'] ?? null;
      $tanggal_peminjaman = $_POST['tanggal_peminjaman'] ?? null; // Take from form
      $tanggal_pengembalian = $_POST['tanggal_pengembalian'] ?? null; // Take from form

      try {
        $success = SaranaBergerak::updateData(
          $conn,
          $id,
          $kategori_barang_id,
          $barang_id,
          $kondisi_barang_id,
          $sarana['no_registrasi'],
          $nama_detail_barang,
          $merk,
          $spesifikasi,
          $no_polisi,
          $sumber,
          $lokasi,
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

        $message = $success ? 'Data sarana bergerak berhasil diperbarui.' : 'Gagal memperbarui data sarana bergerak.';
        $_SESSION['update'] = $message;

        // If the update was successful AND the status is being set to 'Dipinjam',
        // save the transaction history.
        if ($success && $status === 'Dipinjam') {
          // Check if required loan fields are present before saving history
          if (!empty($nama_peminjam) && !empty($identitas_peminjam) && !empty($no_hp_peminjam) && !empty($tanggal_peminjaman) && !empty($tanggal_pengembalian)) {
            $historySuccess = PeminjamanBB::storeData(
              $conn,
              $sarana['no_registrasi'], // Pass nomor_registrasi
              $nama_detail_barang,      // Pass nama_barang
              $nama_peminjam,
              $identitas_peminjam,
              $no_hp_peminjam,
              $tanggal_peminjaman,
              $tanggal_pengembalian, // Use as planned return date
              $lokasi                   // Pass lokasi_penempatan_barang
            );
          } else {
            // Optionally log a warning if status is Dipinjam but loan details are missing
            error_log("Warning: Sarana ID {$id} status set to Dipinjam, but loan details are incomplete. History not saved.");
          }
        }

        if ($success) {
          header('Location: /admin/sarana/bergerak/pinjam');
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




  public function index()
  {
    global $conn;
    $saranaData = SaranaBergerak::getAllStatus($conn);
    $peminjaman = PeminjamanBB::getAllData($conn); // Anda mungkin masih memerlukan ini untuk data peminjaman lainnya

    $this->renderView('index', [
      'saranaData' => $saranaData,
      'peminjaman' => $peminjaman,
    ]);
  }

  public function indexPeminjaman()
  {
    global $conn;
    $saranaData = SaranaBergerak::getAllStatusTersedia($conn);
    $this->renderView('indexPeminjaman', [
      'saranaData' => $saranaData,
    ]);
  }
}
