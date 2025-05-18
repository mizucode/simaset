<?php
require_once __DIR__ . '/../Models/SaranaATK.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';

class SaranaATKController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/BarangATK/{$view}.php";
    }

    public function create()
    {
        global $conn;
        $saranaData = SaranaATK::getAllData($conn);
        $kategoriList = KategoriBarang::getAllData($conn);
        $barangList = Barang::getAllData($conn);
        $kondisiList = KondisiBarang::getAllData($conn);
        $lapangData = Lapang::getAllData($conn);
        $ruangData = Ruang::getAllData($conn);

        // Filter barang untuk kategori ATK (asumsi ID kategori ATK = 1)
        $filteredBarangList = array_filter($barangList, function ($barang) {
            return $barang['kategori_id'] == 3;
        });

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kategori_barang_id = $_POST['kategori_barang_id'];
            $barang_id = $_POST['barang_id'];
            $kondisi_barang_id = $_POST['kondisi_barang_id'];
            $no_registrasi = $_POST['no_registrasi'];
            $nama_detail_barang = $_POST['nama_detail_barang'];
            $merk = $_POST['merk'] ?? null;
            $spesifikasi = $_POST['spesifikasi'] ?? null;
            $jumlah = $_POST['jumlah'] ?? 1;
            $satuan = $_POST['satuan'] ?? 'Unit';
            $lokasi = $_POST['lokasi'] ?? null;
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                $success = SaranaATK::storeData(
                    $conn,
                    $kategori_barang_id,
                    $barang_id,
                    $kondisi_barang_id,
                    $no_registrasi,
                    $nama_detail_barang,
                    $merk,
                    $spesifikasi,
                    $jumlah,
                    $satuan,
                    $lokasi,
                    $keterangan
                );

                $message = $success ? 'Data sarana ATK berhasil ditambahkan.' : 'Gagal menambahkan data sarana ATK.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/sarana/atk');
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
            'kondisiList' => $kondisiList,
            'lapangData' => $lapangData,
            'ruangData' => $ruangData
        ]);
    }

    public function update($id)
    {
        global $conn;
        $sarana = SaranaATK::getById($conn, $id);
        $kategoriList = KategoriBarang::getAllData($conn);
        $barangList = Barang::getAllData($conn);
        $kondisiList = KondisiBarang::getAllData($conn);
        $lapangData = Lapang::getAllData($conn);
        $ruangData = Ruang::getAllData($conn);

        if (!$sarana) {
            $_SESSION['error'] = 'Data sarana ATK tidak ditemukan.';
            header('Location: /admin/sarana/atk');
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
            $jumlah = $_POST['jumlah'] ?? 1;
            $satuan = $_POST['satuan'] ?? 'Unit';
            $lokasi = $_POST['lokasi'] ?? null;
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                $success = SaranaATK::updateData(
                    $conn,
                    $id,
                    $kategori_barang_id,
                    $barang_id,
                    $kondisi_barang_id,
                    $no_registrasi,
                    $nama_detail_barang,
                    $merk,
                    $spesifikasi,
                    $jumlah,
                    $satuan,
                    $lokasi,
                    $keterangan
                );

                $message = $success ? 'Data sarana ATK berhasil diperbarui.' : 'Gagal memperbarui data sarana ATK.';
                $_SESSION['update'] = $message;

                header('Location: /admin/sarana/atk?detail=' . $id);
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('update', [
            'sarana' => $sarana,
            'kategoriList' => $kategoriList,
            'barangList' => $barangList,
            'kondisiList' => $kondisiList,
            'lapangData' => $lapangData,
            'ruangData' => $ruangData
        ]);
    }

    private function delete()
    {
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            global $conn;
            $id = $_GET['delete'];
            if (SaranaATK::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data sarana ATK berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data sarana ATK.';
            }
            header('Location: /admin/sarana/atk');
            exit();
        }
    }

    public function index()
    {
        global $conn;
        $saranaData = SaranaATK::getAllData($conn);

        $this->delete();

        $this->renderView('index', [
            'saranaData' => $saranaData,
        ]);
    }

    public function detail($id)
    {
        global $conn;

        $detailData = SaranaATK::getById($conn, $id);

        $this->delete();
        $this->renderView('detail', [
            'detailData' => $detailData,
        ]);
    }
}
