<?php
require_once __DIR__ . '/../Models/Gedung.php';

class GedungController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Gedung/{$view}.php";
    }

    public function gedung()
    {
        global $conn;

        // Hapus data
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            $id = $_GET['delete'];
            if (Gedung::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data.';
            }
            header('Location: /admin/prasarana/gedung');
            exit();
        }

        // Edit data → ambil data untuk isi form
        $editData = null;
        if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
            $id = $_GET['edit'];
            $editData = Gedung::getById($conn, $id);
        }

        // Store atau Update data
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id_gedung'] ?? null;

            // Ambil data dari form
            $kode_gedung        = $_POST['kode_gedung'];
            $nama_gedung        = $_POST['nama_gedung'];
            $lokasi             = $_POST['lokasi'];
            $alamat             = $_POST['alamat'];
            $luas_tanah         = $_POST['luas_tanah'];
            $luas_bangunan      = $_POST['luas_bangunan'];
            $jumlah_lantai      = $_POST['jumlah_lantai'];
            $tahun_dibangun     = $_POST['tahun_dibangun'];
            $tahun_perolehan    = $_POST['tahun_perolehan'];
            $nilai_perolehan    = $_POST['nilai_perolehan'];
            $status_kepemilikan = $_POST['status_kepemilikan'];
            $status_penggunaan  = $_POST['status_penggunaan'];
            $kondisi            = $_POST['kondisi'];
            $pengguna           = $_POST['pengguna'];
            $dokumen_legalitas  = $_POST['dokumen_legalitas'];
            $keterangan         = $_POST['keterangan'];

            try {
                if ($id) {
                    // UPDATE
                    $success = Gedung::updateData(
                        $conn,
                        $id,
                        $kode_gedung,
                        $nama_gedung,
                        $lokasi,
                        $alamat,
                        $luas_tanah,
                        $luas_bangunan,
                        $jumlah_lantai,
                        $tahun_dibangun,
                        $tahun_perolehan,
                        $nilai_perolehan,
                        $status_kepemilikan,
                        $status_penggunaan,
                        $kondisi,
                        $pengguna,
                        $dokumen_legalitas,
                        $keterangan
                    );
                    if ($success) {
                        $_SESSION['success'] = 'Data berhasil diperbarui.';
                    } else {
                        $_SESSION['error'] = 'Gagal memperbarui data.';
                    }
                } else {
                    // STORE
                    $success = Gedung::storeData(
                        $conn,
                        $kode_gedung,
                        $nama_gedung,
                        $lokasi,
                        $alamat,
                        $luas_tanah,
                        $luas_bangunan,
                        $jumlah_lantai,
                        $tahun_dibangun,
                        $tahun_perolehan,
                        $nilai_perolehan,
                        $status_kepemilikan,
                        $status_penggunaan,
                        $kondisi,
                        $pengguna,
                        $dokumen_legalitas,
                        $keterangan
                    );
                    if ($success) {
                        $_SESSION['success'] = 'Data berhasil ditambahkan.';
                    } else {
                        $_SESSION['error'] = 'Gagal menambahkan data.';
                    }
                }

                header('Location: /admin/prasarana/gedung');
                exit();
            } catch (PDOException $e) {
                $this->renderView('index', ['error' => 'Error DB: ' . $e->getMessage()]);
                return;
            }
        }

        // Ambil semua data gedung
        $gedungData = Gedung::getAllData($conn);
        $this->renderView('index', [
            'gedungData' => $gedungData,
            'editData' => $editData
        ]);
    }
}
