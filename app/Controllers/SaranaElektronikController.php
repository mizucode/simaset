<?php


class SaranaElektronikController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/BarangElektronik/{$view}.php";
    }

    public function create()
    {
        global $conn;
        $saranaData = SaranaElektronik::getAllData($conn);
        $kategoriList = KategoriBarang::getAllData($conn);
        $barangList = Barang::getAllData($conn);
        $kondisiList = KondisiBarang::getAllData($conn);
        $lapangData = Lapang::getAllData($conn);
        $ruangData = Ruang::getAllData($conn);

        // Filter barang untuk kategori elektronik (asumsi ID kategori elektronik = 1)
        $filteredBarangList = array_filter($barangList, function ($barang) {
            return $barang['kategori_id'] == 4;
        });

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kategori_barang_id = $_POST['kategori_barang_id'];
            $barang_id = $_POST['barang_id'];
            $kondisi_barang_id = $_POST['kondisi_barang_id'];
            $no_registrasi = $_POST['no_registrasi'];
            $nama_detail_barang = $_POST['nama_detail_barang'];
            $merk = $_POST['merk'] ?? null;
            $spesifikasi = $_POST['spesifikasi'] ?? null;
            $tipe = $_POST['tipe'] ?? null;
            $jumlah = $_POST['jumlah'] ?? 1;
            $satuan = $_POST['satuan'] ?? 'Unit';
            $lokasi = $_POST['lokasi'] ?? null;
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                $success = SaranaElektronik::storeData(
                    $conn,
                    $kategori_barang_id,
                    $barang_id,
                    $kondisi_barang_id,
                    $no_registrasi,
                    $nama_detail_barang,
                    $merk,
                    $spesifikasi,
                    $tipe,
                    $jumlah,
                    $satuan,
                    $lokasi,
                    $keterangan
                );

                $message = $success ? 'Data sarana elektronik berhasil ditambahkan.' : 'Gagal menambahkan data sarana elektronik.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/sarana/elektronik');
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
            'ruangData' => $ruangData,
        ]);
    }

    public function update($id)
    {
        global $conn;
        $sarana = SaranaElektronik::getById($conn, $id);
        $kategoriList = KategoriBarang::getAllData($conn);
        $barangList = Barang::getAllData($conn);
        $kondisiList = KondisiBarang::getAllData($conn);
        $lapangData = Lapang::getAllData($conn);
        $ruangData = Ruang::getAllData($conn);

        if (!$sarana) {
            $_SESSION['error'] = 'Data sarana elektronik tidak ditemukan.';
            header('Location: /admin/sarana/elektronik');
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
            $tipe = $_POST['tipe'] ?? null;
            $jumlah = $_POST['jumlah'] ?? 1;
            $satuan = $_POST['satuan'] ?? 'Unit';
            $lokasi = $_POST['lokasi'] ?? null;
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                $success = SaranaElektronik::updateData(
                    $conn,
                    $id,
                    $kategori_barang_id,
                    $barang_id,
                    $kondisi_barang_id,
                    $no_registrasi,
                    $nama_detail_barang,
                    $merk,
                    $spesifikasi,
                    $tipe,
                    $jumlah,
                    $satuan,
                    $lokasi,
                    $keterangan
                );

                $message = $success ? 'Data sarana elektronik berhasil diperbarui.' : 'Gagal memperbarui data sarana elektronik.';
                $_SESSION['update'] = $message;

                header('Location: /admin/sarana/elektronik?detail=' . $id);
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
            if (SaranaElektronik::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data sarana elektronik berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data sarana elektronik.';
            }
            header('Location: /admin/sarana/elektronik');
            exit();
        }
    }

    public function index()
    {
        global $conn;
        $saranaData = SaranaElektronik::getAllData($conn);

        $this->delete();

        $this->renderView('index', [
            'saranaData' => $saranaData,
        ]);
    }

    public function detail($id)
    {
        global $conn;

        $detailData = SaranaElektronik::getById($conn, $id);

        $this->delete();
        $this->renderView('detail', [
            'detailData' => $detailData,
        ]);
    }
}
