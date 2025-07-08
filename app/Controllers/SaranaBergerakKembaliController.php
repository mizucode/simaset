<?php

require_once __DIR__ . '/../Models/DokumenSaranaBergerak.php';
require_once __DIR__ . '/../Models/BaseUrlQr.php';
require_once __DIR__ . '/../Models/RiwayatPengembalian.php';


class SaranaBergerakKembaliController
{
  private function renderView(string $view, $data = [])
  {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Kembali/SaranaBergerak/{$view}.php";
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
      $tanggal_peminjaman = $_POST['tanggal_peminjaman'] ?? $sarana['tanggal_peminjaman'] ?? null;
      $tanggal_pengembalian = $_POST['tanggal_pengembalian'] ?? $sarana['tanggal_pengembalian'] ?? null;

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

        if ($success) {
          RiwayatPengembalian::storeData(
            $conn,
            $sarana['no_registrasi'],
            $nama_detail_barang,
            $nama_peminjam,
            $identitas_peminjam,
            $no_hp_peminjam,
            $tanggal_peminjaman,
            $tanggal_pengembalian,
            $lokasi,
            $status
          );
          header('Location: /admin/sarana/bergerak/kembali');
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


    $this->renderView('index', [
      'saranaData' => $saranaData,
    ]);
  }

  public function indexPengembalian()
  {
    global $conn;
    $saranaData = SaranaBergerak::getAllStatusExDipinjam($conn);
    $this->renderView('indexPeminjaman', [
      'saranaData' => $saranaData,
    ]);
  }
}
