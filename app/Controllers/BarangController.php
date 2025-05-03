<?php
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/BarangElektronik.php';

class BarangController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Barang/{$view}.php";
    }

    public function create()
    {
        global $conn;
        $barangData = Barang::getAllData($conn);
        $kondisiBarang = KondisiBarang::getAllData($conn);
        $kategoriBarang = KategoriBarang::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $id = $_POST['id'] ?? null;
            $nama_barang = $_POST['nama_barang'];
            $kategori_id = $_POST['kategori_id'];
            $kode_barang = $_POST['kode_barang'];
            $jumlah = $_POST['jumlah'];
            $kondisi_id = $_POST['kondisi_id'];
            $tahun_perolehan = $_POST['tahun_perolehan'] ?? null;

            try {
                if ($id) {
                    // Update data
                    $success = Barang::updateData($conn, $id, $nama_barang, $kategori_id, $kode_barang, $tahun_perolehan, $kondisi_id, $jumlah);
                } else {
                    // Simpan data baru
                    $success = Barang::storeData($conn, $nama_barang, $kategori_id, $kode_barang, $tahun_perolehan, $kondisi_id, $jumlah);
                }

                if ($success) {
                    // Redirect ke halaman mebeler
                    header('Location: /admin/barang/kategori-barang');
                    exit();
                } else {
                    // Tampilkan error jika gagal
                    $this->renderView('kategori', [
                        'barangData' => $barangData,
                        'kondisiBarang' => $kondisiBarang,
                        'kategoriBarang' => $kategoriBarang,
                        'error' => 'Gagal menyimpan atau mengupdate data.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                // Tampilkan error database
                $this->renderView('kategori', [
                    'barangData' => $barangData,
                    'kondisiBarang' => $kondisiBarang,
                    'kategoriBarang' => $kategoriBarang,
                    'error' => 'Error DB: ' . $e->getMessage()
                ]);
                return;
            }
        }


        $this->renderView('create', [
            'barangData' => $barangData,
            'kondisiBarang' => $kondisiBarang,
            'kategoriBarang' => $kategoriBarang,
        ]);
    }

    public function daftarBarang()
    {
        global $conn;
        $barangElektronik = BarangElektronik::getAllData($conn);
        // $barangMebeler = BarangMebeler::getAllData($conn);

        $allBarang = array_merge($barangElektronik);

        $this->renderView('index', [
            'allBarang' => $allBarang
        ]);
    }

    public function barang()
    {
        global $conn;
        $barangData = Barang::getAllData($conn);
        $kondisiBarang = KondisiBarang::getAllData($conn);
        $kategoriBarang = KategoriBarang::getAllData($conn);


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $id = $_POST['id'] ?? null;
            $nama_barang = $_POST['nama_barang'];
            $kategori_id = $_POST['kategori_id'];
            $kode_barang = $_POST['kode_barang'];
            $jumlah = $_POST['jumlah'];
            $kondisi_id = $_POST['kondisi_id'];
            $tahun_perolehan = $_POST['tahun_perolehan'] ?? null;

            try {
                if ($id) {
                    // Update data
                    $success = Barang::updateData($conn, $id, $nama_barang, $kategori_id, $kode_barang, $tahun_perolehan, $kondisi_id, $jumlah);
                    if ($success) {
                        $_SESSION['update'] = 'Data berhasil update.';
                    } else {
                        $_SESSION['error'] = 'Gagal memperbarui data.';
                    }
                } else {
                    // Simpan data baru
                    $success = Barang::storeData($conn, $nama_barang, $kategori_id, $kode_barang, $tahun_perolehan, $kondisi_id, $jumlah);
                    if ($success) {
                        $_SESSION['update'] = 'Data berhasil ditambahkan.';
                    } else {
                        $_SESSION['error'] = 'Gagal menambahkan data.';
                    }
                }

                if ($success) {
                    // Redirect ke halaman mebeler
                    header('Location: /admin/barang/kategori-barang');
                    exit();
                } else {
                    // Tampilkan error jika gagal
                    $this->renderView('kategori', [
                        'barangData' => $barangData,
                        'kondisiBarang' => $kondisiBarang,
                        'kategoriBarang' => $kategoriBarang,
                        'error' => 'Gagal menyimpan atau mengupdate data.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                // Tampilkan error database
                $this->renderView('kategori', [
                    'barangData' => $barangData,
                    'kondisiBarang' => $kondisiBarang,
                    'kategoriBarang' => $kategoriBarang,
                    'error' => 'Error DB: ' . $e->getMessage()
                ]);
                return;
            }
        }

        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            // Hapus data
            $id = $_GET['delete'];
            if (Barang::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data.';
            }
            header('Location: /admin/barang/kategori-barang');
            exit();
        }

        // Render default view
        $this->renderView('kategori', [
            'barangData' => $barangData,
            'kondisiBarang' => $kondisiBarang,
            'kategoriBarang' => $kategoriBarang,
        ]);
    }
}
