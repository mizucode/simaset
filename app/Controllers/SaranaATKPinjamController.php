<?php

require_once __DIR__ . '/../Models/SaranaATK.php';
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/Ruang.php';
require_once __DIR__ . '/../Models/PeminjamanATK.php';

class SaranaATKPinjamController
{
  private function renderView(string $view, $data = [])
  {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Pinjam/SaranaATK/{$view}.php";
  }

  public function update($id)
  {
    global $conn;
    $sarana = SaranaATK::getById($conn, $id);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if (!$sarana) {
      $_SESSION['error'] = 'Data sarana ATK tidak ditemukan.';
      header('Location: /admin/sarana/atk/pinjam');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $lokasi = $_POST['lokasi'];
      $nama_peminjam = $_POST['nama_peminjam'];
      $identitas_peminjam = $_POST['identitas_peminjam'];
      $no_hp_peminjam = $_POST['no_hp_peminjam'];
      $status_baru = 'Dipinjam';

      $tanggal_peminjaman = !empty($_POST['tanggal_peminjaman']) ? $_POST['tanggal_peminjaman'] : null;
      $tanggal_pengembalian = !empty($_POST['tanggal_pengembalian']) ? $_POST['tanggal_pengembalian'] : null;

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
          $lokasi,
          $sarana['sumber'],
          $sarana['biaya_pembelian'],
          $sarana['tanggal_pembelian'],
          $sarana['keterangan'],
          $status_baru,
          $nama_peminjam,
          $identitas_peminjam,
          $no_hp_peminjam,
          $tanggal_peminjaman,
          $tanggal_pengembalian
        );

        if ($updateSuccess) {
          $riwayatDicatat = PeminjamanATK::storeData(
            $conn,
            $sarana['no_registrasi'],
            $sarana['nama_detail_barang'],
            $nama_peminjam,
            $identitas_peminjam,
            $no_hp_peminjam,
            $tanggal_peminjaman,
            $tanggal_pengembalian,
            $lokasi
          );

          if ($riwayatDicatat) {
            $conn->commit();
            $_SESSION['update'] = 'Barang berhasil dipinjam dan riwayat telah dicatat.';
          } else {
            $conn->rollBack();
            $_SESSION['error'] = 'Gagal mencatat riwayat peminjaman. Proses dibatalkan.';
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

      header('Location: /admin/sarana/atk');
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
    $saranaData = SaranaATK::getAllStatusExDipinjam($conn);
    $this->renderView('index', ['saranaData' => $saranaData]);
  }

  public function indexPeminjaman()
  {
    global $conn;
    $saranaData = SaranaATK::getAllStatusExDipinjam($conn);
    $this->renderView('indexPeminjaman', ['saranaData' => $saranaData]);
  }
}
