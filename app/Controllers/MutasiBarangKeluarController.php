<?php
require_once __DIR__ . '/../Models/MutasiBarangKeluar.php';

class MutasiBarangKeluarController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Mutasi/BarangKeluar/{$view}.php";
    }

    public function index()
    {
        global $conn;
        $mutasiBK = MutasiBarangKeluar::getAllData($conn);
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
}
