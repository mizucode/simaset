<?php
require_once __DIR__ . '/../Models/JenisBarang.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';


class JenisBarangController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Barang/Jenis/{$view}.php";
    }

    public function index()
    {
        global $conn;
        $jenisBarang = jenisBarang::getAllData($conn);

        $this->renderView('index', [
            'jenisBarang' => $jenisBarang,
        ]);
    }

    public function create()
    {
        global $conn;
        $jenisBarang = jenisBarang::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kode_barang = $_POST['kode_barang'];
            $nama_barang = $_POST['nama_barang'];
            $kategori_id = $_POST['kategori_id'];


            try {
                $success = JenisBarang::storeData(
                    $conn,
                    $kode_barang,
                    $nama_barang,
                    $kategori_id
                );

                $message = $success ? 'Data jenis barang berhasil ditambahkan.' : 'Gagal menambahkan data jenis.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/barang/jenis-barang');
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('create', [
            'jenisBarang' => $jenisBarang,
        ]);
    }
}
