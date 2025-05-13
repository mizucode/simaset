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

    public function create()
    {
        global $conn;
        $jenisBarangData = JenisBarang::getAllData($conn);
        $kategoriList = KategoriBarang::getAllData($conn);

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

                $message = $success ? 'Data jenis barang berhasil ditambahkan.' : 'Gagal menambahkan data jenis barang.';
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
            'jenisBarangData' => $jenisBarangData,
            'kategoriList' => $kategoriList
        ]);
    }

    public function update($id)
    {
        global $conn;
        $jenisBarangData = JenisBarang::getById($conn, $id);
        $kategoriList = KategoriBarang::getAllData($conn);

        if (!$jenisBarangData) {
            $_SESSION['error'] = 'Data sarana mebelair tidak ditemukan.';
            header('Location: /admin/barang/jenis-barang');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kode_barang = $_POST['kode_barang'] ?? '';
            $nama_barang = $_POST['nama_barang'] ?? '';
            $kategori_id = $_POST['kategori_id'] ?? '';

            // Validate input data
            if (empty($kode_barang) || empty($nama_barang) || empty($kategori_id)) {
                $_SESSION['error'] = 'Semua field harus diisi.';
                header('Location: /admin/barang/jenis-barang/update/' . $id);
                exit();
            }

            try {
                $success = JenisBarang::updateData(
                    $conn,
                    $id,
                    $kode_barang,
                    $nama_barang,
                    $kategori_id
                );

                $message = $success ? 'Data sarana jenis barang berhasil diperbarui.' : 'Gagal memperbarui data.';
                $_SESSION['update'] = $message;

                header('Location: /admin/barang/jenis-barang');
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
                error_log('Database error: ' . $e->getMessage());
            }
        }

        $this->renderView('update', [
            'jenisBarangData' => $jenisBarangData,
            'kategoriList' => $kategoriList
        ]);
    }



    private function delete()
    {
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            global $conn;
            $id = $_GET['delete'];
            if (JenisBarang::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data jenis barang berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data jenis barang.';
            }
            header('Location: /admin/barang/jenis-barang');
            exit();
        }
    }

    public function index()
    {
        global $conn;
        $jenisBarangData = JenisBarang::getAllData($conn);

        $this->delete();

        $this->renderView('index', [
            'jenisBarangData' => $jenisBarangData,
        ]);
    }
}
