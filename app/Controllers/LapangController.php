<?php
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/JenisAset.php';

class LapangController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Lapang/{$view}.php";
    }

    public function create()
    {
        global $conn;
        $lapangData = Lapang::getAllData($conn);
        $jenisAsetList = JenisAset::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $jenis_aset_id = $_POST['jenis_aset_id'];
            $kode_lapang = $_POST['kode_lapang'];
            $nama_lapang = $_POST['nama_lapang'];
            $luas = $_POST['luas'] ?? null;
            $kategori = $_POST['kategori'] ?? null;
            $fungsi = $_POST['fungsi'];
            $lokasi = $_POST['lokasi'];
            $status = $_POST['status'];
            $kondisi = $_POST['kondisi'];
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                $success = Lapang::storeData(
                    $conn,
                    $jenis_aset_id,
                    $kode_lapang,
                    $nama_lapang,
                    $luas,
                    $kategori,
                    $fungsi,
                    $lokasi,
                    $status,
                    $kondisi,
                    $keterangan
                );

                $message = $success ? 'Data lapang berhasil ditambahkan.' : 'Gagal menambahkan data lapang.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/prasarana/lapang');
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('create', [
            'lapangData' => $lapangData,
            'jenisAsetList' => $jenisAsetList
        ]);
    }

    public function update($id)
    {
        global $conn;
        $lapang = Lapang::getById($conn, $id);
        $jenisAsetList = JenisAset::getAllData($conn);

        if (!$lapang) {
            $_SESSION['error'] = 'Data lapang tidak ditemukan.';
            header('Location: /admin/prasarana/lapang');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $input = [
                'jenis_aset_id' => $_POST['jenis_aset_id'],
                'kode_lapang' => $_POST['kode_lapang'],
                'nama_lapang' => $_POST['nama_lapang'],
                'luas' => $_POST['luas'] ?? null,
                'kategori' => $_POST['kategori'] ?? null,
                'fungsi' => $_POST['fungsi'],
                'lokasi' => $_POST['lokasi'],
                'status' => $_POST['status'],
                'kondisi' => $_POST['kondisi'],
                'keterangan' => $_POST['keterangan'] ?? null
            ];

            try {
                $success = Lapang::updateData($conn, $id, ...$input);

                $_SESSION['update'] = $success
                    ? 'Data lapang berhasil diperbarui.'
                    : 'Gagal memperbarui data lapang.';

                header('Location: /admin/prasarana/lapang');
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('update', [
            'lapang' => $lapang,
            'jenisAsetList' => $jenisAsetList
        ]);
    }


    private function delete()
    {
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            global $conn;
            $id = $_GET['delete'];
            if (Lapang::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data lapang berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data lapang.';
            }
            header('Location: /admin/prasarana/lapang');
            exit();
        }
    }

    public function lapang()
    {
        global $conn;
        $lapangData = Lapang::getAllData($conn);

        $this->delete();

        $this->renderView('index', [
            'lapangData' => $lapangData,
        ]);
    }
}
