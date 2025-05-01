<?php
require_once __DIR__ . '/../Models/Tanah.php';
require_once __DIR__ . '/../Models/Lokasi.php';

class TanahController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Tanah/{$view}.php";
    }

    public function create()
    {
        global $conn;
        $tanahData = Tanah::getAllData($conn);
        $lokasi = Lokasi::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $id = $_POST['id'] ?? null;
            $lokasi_id = $_POST['lokasi_id'];
            $kode_tanah = $_POST['kode_tanah'];
            $nama_tanah = $_POST['nama_tanah'];

            try {
                if ($id) {
                    // Update data
                    $success = Tanah::updateData(
                        $conn,
                        $id,
                        $lokasi_id,
                        $kode_tanah,
                        $nama_tanah
                    );
                } else {
                    // Simpan data baru
                    $success = Tanah::storeData(
                        $conn,
                        $lokasi_id,
                        $kode_tanah,
                        $nama_tanah
                    );
                }

                if ($success) {
                    // Redirect ke halaman mebeler
                    header('Location: /admin/prasarana/tanah');
                    exit();
                } else {
                    // Tampilkan error jika gagal
                    $this->renderView('index', [
                        'tanahData' => $tanahData,
                        'lokasi' => $lokasi,
                        'error' => 'Gagal menyimpan atau mengupdate data.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                // Tampilkan error database
                $this->renderView('index', [
                    'tanahData' => $tanahData,
                    'lokasi' => $lokasi,
                    'error' => 'Error DB: ' . $e->getMessage()
                ]);
                return;
            }
        }


        $this->renderView('create', [
            'tanahData' => $tanahData,
            'lokasi' => $lokasi,
        ]);
    }

    public function tanah()
    {
        global $conn;
        $tanahData = Tanah::getAllData($conn);
        $lokasi = Lokasi::getAllData($conn);


        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Ambil data dari form
            $id = $_POST['id'] ?? null;
            $lokasi_id = $_POST['lokasi_id'];
            $kode_tanah = $_POST['kode_tanah'];
            $nama_tanah = $_POST['nama_tanah'];

            try {
                if ($id) {
                    // Update data
                    $success = Tanah::updateData(
                        $conn,
                        $id,
                        $lokasi_id,
                        $kode_tanah,
                        $nama_tanah
                    );
                } else {
                    // Simpan data baru
                    $success = Tanah::storeData(
                        $conn,
                        $lokasi_id,
                        $kode_tanah,
                        $nama_tanah
                    );
                }

                if ($success) {
                    // Redirect ke halaman mebeler
                    header('Location: /admin/prasarana/tanah');
                    exit();
                } else {
                    // Tampilkan error jika gagal
                    $this->renderView('index', [
                        'tanahData' => $tanahData,
                        'lokasi' => $lokasi,
                        'error' => 'Gagal menyimpan atau mengupdate data.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                // Tampilkan error database
                $this->renderView('index', [
                    'tanahData' => $tanahData,
                    'lokasi' => $lokasi,
                    'error' => 'Error DB: ' . $e->getMessage()
                ]);
                return;
            }
        }

        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            // Hapus data
            $id = $_GET['delete'];
            Barang::deleteData($conn, $id);
            header('Location: /admin/prasarana/tanah');
            exit();
        }

        $this->renderView('index', [
            'tanahData' => $tanahData,
            'lokasi' => $lokasi,
        ]);
    }
}
