<?php

require_once __DIR__ . '/../Models/SaranaATK.php';
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/Ruang.php';
require_once __DIR__ . '/../Models/RiwayatPengembalian.php'; // Ganti ke model yang benar

class SaranaATKKembaliController
{
  private function renderView(string $view, $data = [])
  {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Kembali/SaranaATK/{$view}.php";
  }

  public function update($id)
  {
    global $conn;
    $sarana = SaranaATK::getById($conn, $id);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if (!$sarana) {
      $_SESSION['error'] = 'Data sarana ATK tidak ditemukan.';
      header('Location: /admin/sarana/atk/kembali');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $lokasi_baru = $_POST['lokasi'];
      $status_baru = $_POST['status'];

      // Data ini sudah disiapkan dengan benar
      $nama_peminjam_riwayat = !empty($_POST['nama_peminjam']) ? $_POST['nama_peminjam'] : ($sarana['nama_peminjam'] ?? 'Tidak Tercatat');
      $identitas_riwayat = !empty($_POST['identitas_peminjam']) ? $_POST['identitas_peminjam'] : ($sarana['identitas_peminjam'] ?? 'Tidak Tercatat');
      $no_hp_riwayat = !empty($_POST['no_hp_peminjam']) ? $_POST['no_hp_peminjam'] : ($sarana['no_hp_peminjam'] ?? 'Tidak Tercatat');

      try {
        $conn->beginTransaction();

        $updateSuccess = SaranaATK::updateData(
          $conn,
          $id,
          $sarana['kategori_barang_id'],
          $sarana['barang_id'],
          $sarana['kondisi_barang_id'],
          $sarana['no_registrasi'],
          $sarana['nama_detail_barang'],
          $sarana['merk'],
          $sarana['spesifikasi'],
          $sarana['jumlah'],
          $sarana['satuan'],
          $lokasi_baru,
          $sarana['sumber'],
          $sarana['biaya_pembelian'],
          $sarana['tanggal_pembelian'],
          $sarana['keterangan'],
          $status_baru,
          null,
          null,
          null,
          null,
          null
        );

        if ($updateSuccess) {
          // --- PERUBAHAN UTAMA DI SINI ---
          // Menggunakan RiwayatPengembalian::storeData() sesuai model yang Anda berikan.
          // Parameter disesuaikan dengan yang dibutuhkan oleh method storeData.
          $riwayatDicatat = RiwayatPengembalian::storeData(
            $conn,
            $sarana['no_registrasi'],
            $sarana['nama_detail_barang'],
            $nama_peminjam_riwayat,
            $identitas_riwayat,
            $no_hp_riwayat,
            $sarana['tanggal_peminjaman'],
            $sarana['tanggal_pengembalian'], // Diasumsikan ini adalah tanggal rencana pengembalian
            $lokasi_baru
          );
          // --- AKHIR PERUBAHAN ---

          if ($riwayatDicatat) {
            $conn->commit();
            $_SESSION['update'] = 'Barang berhasil dikembalikan dan riwayat pengembalian telah dicatat.';
          } else {
            $conn->rollBack();
            $_SESSION['error'] = 'Gagal mencatat riwayat pengembalian. Proses dibatalkan.';
          }
        } else {
          $conn->rollBack();
          $_SESSION['error'] = 'Gagal memperbarui status sarana ATK. Proses dibatalkan.';
        }
      } catch (PDOException $e) {
        if ($conn->inTransaction()) {
          $conn->rollBack();
        }
        $_SESSION['error'] = 'Error database: ' . $e->getMessage();
      }

      header('Location: /admin/sarana/atk/kembali');
      exit();
    }

    $this->renderView('update', [
      'sarana' => $sarana,
      'lapangData' => $lapangData,
      'ruangData' => $ruangData,
    ]);
  }

  public function index()
  {
    global $conn;
    $saranaData = SaranaATK::getAllStatus($conn);
    $this->renderView('index', ['saranaData' => $saranaData]);
  }

  public function indexPeminjaman()
  {
    global $conn;
    $saranaData = SaranaATK::getAllStatusExDipinjam($conn);
    $this->renderView('indexPeminjaman', ['saranaData' => $saranaData]);
  }
}
