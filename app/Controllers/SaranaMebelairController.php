<?php
require_once __DIR__ . '/../Models/SaranaMebelair.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';

class SaranaMebelairController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/BarangMebeler/{$view}.php";
    }

    public function create()
    {
        global $conn;
        $saranaData = SaranaMebelair::getAllData($conn);
        $kategoriList = KategoriBarang::getAllData($conn);
        $barangList = Barang::getAllData($conn);
        $kondisiList = KondisiBarang::getAllData($conn);

        // Filter barang untuk kategori mebelair (asumsi ID kategori mebelair = 2)
        $filteredBarangList = array_filter($barangList, function ($barang) {
            return $barang['kategori_id'] == 2;
        });

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kategori_barang_id = $_POST['kategori_barang_id'];
            $barang_id = $_POST['barang_id'];
            $kondisi_barang_id = $_POST['kondisi_barang_id'];
            $no_registrasi = $_POST['no_registrasi'];
            $nama_detail_barang = $_POST['nama_detail_barang'];
            $merk = $_POST['merk'] ?? null;
            $spesifikasi = $_POST['spesifikasi'] ?? null;
            $sumber = $_POST['sumber'] ?? null;
            $jumlah = $_POST['jumlah'] ?? 1;
            $satuan = $_POST['satuan'] ?? 'Unit';
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                $success = SaranaMebelair::storeData(
                    $conn,
                    $kategori_barang_id,
                    $barang_id,
                    $kondisi_barang_id,
                    $no_registrasi,
                    $nama_detail_barang,
                    $merk,
                    $spesifikasi,
                    $sumber,
                    $jumlah,
                    $satuan,
                    $keterangan
                );

                $message = $success ? 'Data sarana mebelair berhasil ditambahkan.' : 'Gagal menambahkan data sarana mebelair.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/sarana/mebelair');
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('create', [
            'saranaData' => $saranaData,
            'kategoriList' => $kategoriList,
            'barangList' => $filteredBarangList,
            'kondisiList' => $kondisiList
        ]);
    }

    public function update($id)
    {
        global $conn;
        $sarana = SaranaMebelair::getById($conn, $id);
        $kategoriList = KategoriBarang::getAllData($conn);
        $barangList = Barang::getAllData($conn);
        $kondisiList = KondisiBarang::getAllData($conn);

        if (!$sarana) {
            $_SESSION['error'] = 'Data sarana mebelair tidak ditemukan.';
            header('Location: /admin/sarana/mebelair');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kategori_barang_id = $_POST['kategori_barang_id'];
            $barang_id = $_POST['barang_id'];
            $kondisi_barang_id = $_POST['kondisi_barang_id'];
            $no_registrasi = $_POST['no_registrasi'];
            $nama_detail_barang = $_POST['nama_detail_barang'];
            $merk = $_POST['merk'] ?? null;
            $spesifikasi = $_POST['spesifikasi'] ?? null;
            $sumber = $_POST['sumber'] ?? null;
            $jumlah = $_POST['jumlah'] ?? 1;
            $satuan = $_POST['satuan'] ?? 'Unit';
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                $success = SaranaMebelair::updateData(
                    $conn,
                    $id,
                    $kategori_barang_id,
                    $barang_id,
                    $kondisi_barang_id,
                    $no_registrasi,
                    $nama_detail_barang,
                    $merk,
                    $spesifikasi,
                    $sumber,
                    $jumlah,
                    $satuan,
                    $keterangan
                );

                $message = $success ? 'Data sarana mebelair berhasil diperbarui.' : 'Gagal memperbarui data sarana mebelair.';
                $_SESSION['update'] = $message;

                header('Location: /admin/sarana/mebelair');
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('update', [
            'sarana' => $sarana,
            'kategoriList' => $kategoriList,
            'barangList' => $barangList,
            'kondisiList' => $kondisiList
        ]);
    }

    private function delete()
    {
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            global $conn;
            $id = $_GET['delete'];
            if (SaranaMebelair::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data sarana mebelair berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data sarana mebelair.';
            }
            header('Location: /admin/sarana/mebelair');
            exit();
        }
    }

    public function index()
    {
        global $conn;
        $saranaData = SaranaMebelair::getAllData($conn);

        $this->delete();

        $this->renderView('index', [
            'saranaData' => $saranaData,
        ]);
    }
}
