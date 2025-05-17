<?php
require_once __DIR__ . '/../Models/MutasiBarangMasuk.php';

class MutasiBarangMasukController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Mutasi/BarangMasuk/{$view}.php";
    }

    private function delete()
    {
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            global $conn;
            $id = $_GET['delete'];
            if (MutasiBarangMasuk::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data penerimaan berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data penerimaan.';
            }
            header('Location: /admin/transaksi/mutasi/barang-masuk');
            exit();
        }
    }

    public function index()
    {
        global $conn;
        $mutasiBM = MutasiBarangMasuk::getAllData($conn);
        $this->delete();
        $this->renderView('index', [
            'mutasiBM' => $mutasiBM,
        ]);
    }

    public function create()
    {
        global $conn;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tanggal_penerimaan = $_POST['tanggal_penerimaan'];
            $sumber_barang = $_POST['sumber_barang'];
            $nama_barang = $_POST['nama_barang'];
            $jumlah = $_POST['jumlah'];
            $kondisi = $_POST['kondisi'];
            $nomor_nota = $_POST['nomor_nota'] ?? null;
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                $success = MutasiBarangMasuk::storeData(
                    $conn,
                    $tanggal_penerimaan,
                    $sumber_barang,
                    $nama_barang,
                    $jumlah,
                    $kondisi,
                    $nomor_nota,
                    $keterangan
                );

                $message = $success ? 'Data mutasi barang masuk berhasil ditambahkan.' : 'Gagal menambahkan data mutasi barang masuk.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/transaksi/mutasi/barang-masuk');
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
        $mutasi = MutasiBarangMasuk::getById($conn, $id);

        if (!$mutasi) {
            $_SESSION['error'] = 'Data mutasi barang masuk tidak ditemukan.';
            header('Location: /admin/transaksi/mutasi/barang-masuk');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $tanggal_penerimaan = $_POST['tanggal_penerimaan'];
            $sumber_barang = $_POST['sumber_barang'];
            $nama_barang = $_POST['nama_barang'];
            $jumlah = $_POST['jumlah'];
            $kondisi = $_POST['kondisi'];
            $nomor_nota = $_POST['nomor_nota'] ?? null;
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                $success = MutasiBarangMasuk::updateData(
                    $conn,
                    $id,
                    $tanggal_penerimaan,
                    $sumber_barang,
                    $nama_barang,
                    $jumlah,
                    $kondisi,
                    $nomor_nota,
                    $keterangan
                );

                $message = $success ? 'Data mutasi barang masuk berhasil diperbarui.' : 'Gagal memperbarui data mutasi.';
                $_SESSION['update'] = $message;

                header('Location: /admin/transaksi/mutasi/barang-masuk');
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('update', [
            'mutasi' => $mutasi
        ]);
    }
}
