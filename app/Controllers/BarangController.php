<?php
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';
class BarangController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Barang/{$view}.php";
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
                } else {
                    // Simpan data baru
                    $success = Barang::storeData($conn, $nama_barang, $kategori_id, $kode_barang, $tahun_perolehan, $kondisi_id, $jumlah);
                }

                if ($success) {
                    // Redirect ke halaman mebeler
                    header('Location: /admin/barang/daftar-barang');
                    exit();
                } else {
                    // Tampilkan error jika gagal
                    $this->renderView('index', [
                        'barangData' => $barangData,
                        'kondisiBarang' => $kondisiBarang,
                        'kategoriBarang' => $kategoriBarang,
                        'error' => 'Gagal menyimpan atau mengupdate data.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                // Tampilkan error database
                $this->renderView('index', [
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
            Barang::deleteData($conn, $id);
            header('Location: /admin/barang/daftar-barang');
            exit();
        }

        // Render default view
        $this->renderView('index', [
            'barangData' => $barangData,
            'kondisiBarang' => $kondisiBarang,
            'kategoriBarang' => $kategoriBarang,
        ]);
    }
}
