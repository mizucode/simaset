<?php
require_once __DIR__ . '/../Models/MutasiBarangKeluar.php';

class MutasiBarangKeluarController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Mutasi/BarangKeluar/{$view}.php";
    }

    private function delete()
    {
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            global $conn;
            $id = $_GET['delete'];
            if (MutasiBarangKeluar::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data pengeluaran berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data pengeluaran.';
            }
            header('Location: /admin/transaksi/mutasi/barang-keluar');
            exit();
        }
    }

    public function index()
    {
        global $conn;
        $mutasiBK = MutasiBarangKeluar::getAllData($conn);
        $this->delete();
        $this->renderView('index', [
            'mutasiBK' => $mutasiBK,
        ]);
    }

    public function create()
    {
        global $conn;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tanggal_keluar = $_POST['tanggal_keluar'];
            $nama_barang = $_POST['nama_barang'];
            $jumlah = $_POST['jumlah'];
            $tujuan = $_POST['tujuan'];
            $penerima = $_POST['penerima'];
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                $success = MutasiBarangKeluar::storeData(
                    $conn,
                    $tanggal_keluar,
                    $nama_barang,
                    $jumlah,
                    $tujuan,
                    $penerima,
                    $keterangan
                );

                $message = $success ? 'Data mutasi barang keluar berhasil ditambahkan.' : 'Gagal menambahkan data mutasi barang keluar.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/transaksi/mutasi/barang-keluar');
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('create', []);
    }

    public function update($id)
    {
        global $conn;
        $mutasi = MutasiBarangKeluar::getById($conn, $id); // Assuming you have a getById method

        if (!$mutasi) {
            $_SESSION['error'] = 'Data mutasi barang keluar tidak ditemukan.';
            header('Location: /admin/transaksi/mutasi/barang-keluar'); // Adjust the redirect URL
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tanggal_keluar = $_POST['tanggal_keluar'];
            $nama_barang = $_POST['nama_barang'];
            $jumlah = $_POST['jumlah'];
            $tujuan = $_POST['tujuan'];
            $penerima = $_POST['penerima'];
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                $success = MutasiBarangKeluar::updateData(
                    $conn,
                    $id,
                    $tanggal_keluar,
                    $nama_barang,
                    $jumlah,
                    $tujuan,
                    $penerima,
                    $keterangan
                );

                $message = $success ? 'Data mutasi barang keluar berhasil diperbarui.' : 'Gagal memperbarui data mutasi.';
                $_SESSION['update'] = $message;

                header('Location: /admin/transaksi/mutasi/barang-keluar'); // Adjust the redirect URL
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('update', [ // Adjust the view path
            'mutasi' => $mutasi
        ]);
    }
}
