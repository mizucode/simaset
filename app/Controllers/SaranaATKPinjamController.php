<?php

require_once __DIR__ . '/../Models/SaranaATK.php'; // Changed model
require_once __DIR__ . '/../Models/BaseUrlQr.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/Ruang.php';
require_once __DIR__ . '/../Models/PeminjamanATK.php'; // Include the new model for ATK loans

class SaranaATKPinjamController
{
  private function renderView(string $view, $data = [])
  {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Pinjam/SaranaATK/{$view}.php"; // Changed view path
  }


  public function update($id)
  {
    global $conn;
    $sarana = SaranaATK::getById($conn, $id); // Changed model
    $kategoriList = KategoriBarang::getAllData($conn);
    $barangList = Barang::getAllData($conn);
    $kondisiList = KondisiBarang::getAllData($conn);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if (!$sarana) {
      $_SESSION['error'] = 'Data sarana ATK tidak ditemukan.'; // Changed message
      header('Location: /admin/sarana/atk/pinjam'); // Changed redirect
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      // Fields for SaranaATK::updateData, taken from POST if available, otherwise from $sarana
      // Note: The Pinjam/SaranaATK/update.php view posts most of these as hidden/readonly fields
      $kategori_barang_id = $_POST['kategori_barang_id'] ?? $sarana['kategori_barang_id'];
      $barang_id = $_POST['barang_id'] ?? $sarana['barang_id'];
      $kondisi_barang_id = $_POST['kondisi_barang_id'] ?? $sarana['kondisi_barang_id'];
      $nama_detail_barang = $_POST['nama_detail_barang'] ?? $sarana['nama_detail_barang'];
      $merk = $_POST['merk'] ?? $sarana['merk'];
      $spesifikasi = $_POST['spesifikasi'] ?? $sarana['spesifikasi'];
      // jumlah & satuan are not in the pinjam form, take from existing $sarana data
      $jumlah = $sarana['jumlah'];
      $satuan = $sarana['satuan'];
      $lokasi = $_POST['lokasi'];
      $sumber = $sarana['sumber'] ?? null; // Get sumber from existing sarana data
      $keterangan = $_POST['keterangan'] ?? $sarana['keterangan'];
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? $sarana['biaya_pembelian'];
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? $sarana['tanggal_pembelian'];

      // Pinjam specific fields
      $status = $_POST['status'] ?? $sarana['status'] ?? null;
      $nama_peminjam = $_POST['nama_peminjam'] ?? $sarana['nama_peminjam'] ?? null;
      $identitas_peminjam = $_POST['identitas_peminjam'] ?? $sarana['identitas_peminjam'] ?? null;
      $no_hp_peminjam = $_POST['no_hp_peminjam'] ?? $sarana['no_hp_peminjam'] ?? null;
      $tanggal_peminjaman = $_POST['tanggal_peminjaman'] ?? null; // Ambil dari form
      $tanggal_pengembalian = $_POST['tanggal_pengembalian'] ?? null; // Ambil dari form

      try {
        // SaranaATK::updateData now handles peminjam details. Status is not handled by this model method.
        $success = SaranaATK::updateData( // Changed model
          $conn,
          $id,
          $kategori_barang_id,
          $barang_id,
          $kondisi_barang_id,
          $sarana['no_registrasi'], // no_registrasi is not changed
          $nama_detail_barang,
          $merk,
          $spesifikasi,
          $jumlah, // from $sarana
          $satuan, // from $sarana
          $lokasi,
          $sumber, // Pass sumber to updateData
          $biaya_pembelian,
          $tanggal_pembelian,
          $keterangan,
          $status, // Ditambahkan argumen status
          $nama_peminjam,
          $identitas_peminjam,
          $no_hp_peminjam,
          $tanggal_peminjaman,
          $tanggal_pengembalian
        );

        $message = $success ? 'Data sarana ATK berhasil diperbarui.' : 'Gagal memperbarui data sarana ATK.'; // Changed message
        $_SESSION['update'] = $message;

        // If the update was successful AND the status is being set to 'Dipinjam',
        // save the transaction history.
        if ($success && $status === 'Dipinjam') {
          // Check if required loan fields are present before saving history
          if (!empty($nama_peminjam) && !empty($identitas_peminjam) && !empty($no_hp_peminjam) && !empty($tanggal_peminjaman) && !empty($tanggal_pengembalian)) {
            // Assuming PeminjamanATK model and storeData method exist
            $historySuccess = PeminjamanATK::storeData(
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
            error_log("Warning: Sarana ATK ID {$id} status set to Dipinjam, but loan details are incomplete. History not saved.");
          }
        }

        if ($success) {
          header('Location: /admin/sarana/atk/pinjam'); // Changed redirect
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
    $saranaData = SaranaATK::getAllStatus($conn); // Changed model


    $this->renderView('index', [
      'saranaData' => $saranaData,
    ]);
  }

  public function indexPeminjaman()
  {
    global $conn;
    $saranaData = SaranaATK::getAllStatusExDipinjam($conn); // Changed model
    $this->renderView('indexPeminjaman', [
      'saranaData' => $saranaData,
    ]);
  }
}
