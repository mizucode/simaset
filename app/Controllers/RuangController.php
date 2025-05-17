<?php
require_once __DIR__ . '/../Models/Ruang.php';
require_once __DIR__ . '/../Models/Gedung.php';
require_once __DIR__ . '/../Models/SaranaBergerak.php';

class RuangController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Ruang/{$view}.php";
    }

    public function create()
    {
        global $conn;
        $ruangData = Ruang::getAllData($conn);
        $gedungList = Gedung::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $gedung_id = $_POST['gedung_id'];
            $kode_ruang = $_POST['kode_ruang'];
            $nama_ruang = $_POST['nama_ruang'];
            $kapasitas = $_POST['kapasitas'] ?? null;
            $lantai = $_POST['lantai'];
            $luas = $_POST['luas'] ?? null;
            $status = $_POST['status'];
            $fungsi = $_POST['fungsi'];
            $kondisi_ruang = $_POST['kondisi_ruang'];
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                $success = Ruang::storeData(
                    $conn,
                    $gedung_id,
                    $kode_ruang,
                    $nama_ruang,
                    $kapasitas,
                    $lantai,
                    $luas,
                    $status,
                    $fungsi,
                    $kondisi_ruang,
                    $keterangan
                );

                $message = $success ? 'Data ruang berhasil ditambahkan.' : 'Gagal menambahkan data ruang.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/prasarana/ruang');
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('create', [
            'ruangData' => $ruangData,
            'gedungList' => $gedungList
        ]);
    }

    public function update($id)
    {
        global $conn;
        $ruang = Ruang::getById($conn, $id);
        $gedungList = Gedung::getAllData($conn);

        if (!$ruang) {
            $_SESSION['error'] = 'Data ruang tidak ditemukan.';
            header('Location: /admin/prasarana/ruang');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $gedung_id = $_POST['gedung_id'];
            $kode_ruang = $_POST['kode_ruang'];
            $nama_ruang = $_POST['nama_ruang'];
            $kapasitas = $_POST['kapasitas'] ?? null;
            $lantai = $_POST['lantai'];
            $luas = $_POST['luas'] ?? null;
            $status = $_POST['status'];
            $fungsi = $_POST['fungsi'];
            $kondisi_ruang = $_POST['kondisi_ruang'];
            $keterangan = $_POST['keterangan'] ?? null;

            try {
                $success = Ruang::updateData(
                    $conn,
                    $id,
                    $gedung_id,
                    $kode_ruang,
                    $nama_ruang,
                    $kapasitas,
                    $lantai,
                    $luas,
                    $status,
                    $fungsi,
                    $kondisi_ruang,
                    $keterangan
                );

                $message = $success ? 'Data ruang berhasil diperbarui.' : 'Gagal memperbarui data ruang.';
                $_SESSION['update'] = $message;

                header('Location: /admin/prasarana/ruang');
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('update', [
            'ruang' => $ruang,
            'gedungList' => $gedungList
        ]);
    }

    private function delete()
    {
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            global $conn;
            $id = $_GET['delete'];
            if (Ruang::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data ruang berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data ruang.';
            }
            header('Location: /admin/prasarana/ruang');
            exit();
        }
    }

    public function ruang()
    {
        global $conn;
        $ruangData = Ruang::getAllData($conn);

        $this->delete();

        $this->renderView('index', [
            'ruangData' => $ruangData,
        ]);
    }

    public function detail($id)
    {
        global $conn;

        $detailData = Ruang::getById($conn, $id);
        $barangList = SaranaBergerak::getAllData($conn);

        // Filter barang berdasarkan lokasi ruangan yang sedang dilihat
        $filteredBarangList = array_filter($barangList, function ($barang) use ($detailData) {
            return $barang['lokasi'] == $detailData['nama_ruang'];
        });

        $this->delete();
        $this->renderView('detail', [
            'detailData' => $detailData,
            'filteredBarangList' => $filteredBarangList
        ]);
    }
}
