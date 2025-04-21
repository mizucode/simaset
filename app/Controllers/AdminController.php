<?php
require_once __DIR__ . '/../Models/Tanah.php';

class AdminController
{
    private function renderView(string $view, $data = [])
    {
        // Ekstrak data agar bisa dipakai langsung sebagai variabel di view
        extract($data);
        require_once __DIR__ . "/../Views/{$view}.php";
    }

    public function index()
    {
        $this->renderView('admin');
    }

    public function barang()
    {
        $this->renderView('barang');
    }

    public function exportTanah()
    {
        global $conn;
        // Ambil semua data tanah
        $tanahData = Tanah::getAllData($conn);
        $this->renderView('export/exportTanah', [
            'tanahData' => $tanahData,
        ]);
    }



    public function tanah()
    {
        global $conn;

        // Hapus data
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            $id = $_GET['delete'];
            Tanah::deleteData($conn, $id);
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
                } else {
                    // STORE
                    $success = Tanah::storeData($conn, $nama_lokasi, $alamat, $luas, $status_kepemilikan, $no_sertifikat, $tanggal_perolehan, $penggunaan, $keterangan);
                }

                if ($success) {
                    header('Location: /admin/prasarana/tanah');
                    exit();
                } else {
                    $this->renderView('tanah', ['error' => 'Gagal menyimpan atau mengupdate data.']);
                    return;
                }
            } catch (PDOException $e) {
                $this->renderView('tanah', ['error' => 'Error DB: ' . $e->getMessage()]);
                return;
            }
        }

        // Ambil semua data tanah
        $tanahData = Tanah::getAllData($conn);
        $this->renderView('tanah', [
            'tanahData' => $tanahData,
            'editData' => $editData
        ]);
    }

    public function gedung()
    {
        $this->renderView('gedung');
    }

    public function ruangan()
    {
        $this->renderView('ruangan');
    }

    public function lapang()
    {
        $this->renderView('lapang');
    }
    public function bergerak()
    {
        $this->renderView('bergerak');
    }
    public function mebeler()
    {
        $this->renderView('mebeler');
    }
    public function atk()
    {
        $this->renderView('atk');
    }
    public function elektronik()
    {
        $this->renderView('elektronik');
    }
    public function listPenempatan()
    {
        $this->renderView('listPenempatan');
    }
    public function formPenempatan()
    {
        $this->renderView('formPenempatan');
    }
    public function detailPenempatan()
    {
        $this->renderView('detailPenempatan');
    }
    public function daftarKondisi()
    {
        $this->renderView('daftarKondisi');
    }
}
