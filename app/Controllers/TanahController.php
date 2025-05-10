<?php
require_once __DIR__ . '/../Models/Tanah.php';
require_once __DIR__ . '/../Models/JenisAset.php';

class TanahController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Tanah/{$view}.php";
    }

    public function create()
    {
        global $conn;
        $tanahData = Tanah::getAllData($conn);
        $jenis_aset_id = JenisAset::GetAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kode_aset = $_POST['kode_aset'];
            $nama_aset = $_POST['nama_aset'];
            $jenis_aset_id = $_POST['jenis_aset_id'];
            $nomor_sertifikat = $_POST['nomor_sertifikat'];
            $luas = $_POST['luas'];
            $lokasi = $_POST['lokasi'];
            $tgl_pajak = $_POST['tgl_pajak'];
            $fungsi = $_POST['fungsi'];
            $keterangan = $_POST['keterangan'];

            try {
                // Simpan data baru
                $success = Tanah::storeData(
                    $conn,
                    $kode_aset,
                    $nama_aset,
                    $jenis_aset_id,
                    $nomor_sertifikat,
                    $luas,
                    $lokasi,
                    $tgl_pajak,
                    $fungsi,
                    $keterangan
                );
                $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/prasarana/tanah');
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('create', [
            'tanahData' => $tanahData,
            'jenisAsetId' => $jenis_aset_id
        ]);
    }

    public function tanah()
    {
        global $conn;
        $tanahData = Tanah::getAllData($conn);



        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            $id = $_GET['delete'];
            if (Tanah::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data.';
            }
            header('Location: /admin/prasarana/tanah');
            exit();
        }

        $this->renderView('index', [
            'tanahData' => $tanahData,

        ]);
    }
}
