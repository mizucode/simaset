<?php
require_once __DIR__ . '/../Models/Tanah.php';

class TanahController
{
    private function renderView(string $view, $data = [])
    {
        // Ekstrak data agar bisa dipakai langsung sebagai variabel di view
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Tanah/{$view}.php";
    }

    public function tanah()
    {
        global $conn;

        // Hapus data
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

        // Edit data → ambil data untuk isi form
        $editData = null;
        if (isset($_GET['edit']) && is_numeric($_GET['edit'])) {
            $id = $_GET['edit'];
            $editData = Tanah::getById($conn, $id);
        }

        // Store atau Update data
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? null;
            $nama_lokasi = $_POST['nama_lokasi'];
            $alamat = $_POST['alamat'];
            $luas = $_POST['luas'];
            $status_kepemilikan = $_POST['status_kepemilikan'];
            $no_sertifikat = $_POST['no_sertifikat'];
            $tanggal_perolehan = $_POST['tanggal_perolehan'];
            $penggunaan = $_POST['penggunaan'];
            $keterangan = $_POST['keterangan'];

            try {
                if ($id) {
                    // UPDATE
                    $success = Tanah::updateData($conn, $id, $nama_lokasi, $alamat, $luas, $status_kepemilikan, $no_sertifikat, $tanggal_perolehan, $penggunaan, $keterangan);
                    if ($success) {
                        $_SESSION['update'] = 'Data berhasil diperbarui.';
                    } else {
                        $_SESSION['error'] = 'Gagal memperbarui data.';
                    }
                } else {
                    // STORE
                    $success = Tanah::storeData($conn, $nama_lokasi, $alamat, $luas, $status_kepemilikan, $no_sertifikat, $tanggal_perolehan, $penggunaan, $keterangan);
                    if ($success) {
                        $_SESSION['success'] = 'Data berhasil ditambahkan.';
                    } else {
                        $_SESSION['error'] = 'Gagal menambahkan data.';
                    }
                }

                header('Location: /admin/prasarana/tanah');
                exit();
            } catch (PDOException $e) {
                $this->renderView('index', ['error' => 'Error DB: ' . $e->getMessage()]);
                return;
            }
        }

        // Ambil semua data tanah
        $tanahData = Tanah::getAllData($conn);
        $this->renderView('index', [
            'tanahData' => $tanahData,
            'editData' => $editData
        ]);
    }
}
