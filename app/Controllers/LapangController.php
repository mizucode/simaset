<?php
require_once __DIR__ . '/../Models/Lapang.php';

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

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? null;
            $kode_lapang = $_POST['kode_lapang'];
            $nama_lapang = $_POST['nama_lapang'];

            try {
                if ($id) {
                    $success = Lapang::storeData(
                        $conn,
                        $kode_lapang,
                        $nama_lapang
                    );
                    if ($success) {
                        $_SESSION['update'] = 'Data berhasil ditambahkan.';
                    } else {
                        $_SESSION['error'] = 'Gagal memperbarui data.';
                    }
                } else {
                    $success = Lapang::storeData(
                        $conn,
                        $kode_lapang,
                        $nama_lapang
                    );
                    if ($success) {
                        $_SESSION['update'] = 'Data berhasil ditambahkan.';
                    } else {
                        $_SESSION['error'] = 'Gagal memperbarui data.';
                    }
                }

                if ($success) {
                    header('Location: /admin/prasarana/lapang');
                    exit();
                } else {
                    $this->renderView('create', [
                        'lapangData' => $lapangData,
                        'error' => 'Gagal menyimpan atau mengupdate data.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                $this->renderView('create', [
                    'lapangData' => $lapangData,
                    'error' => 'Error DB: ' . $e->getMessage()
                ]);
                return;
            }
        }

        $this->renderView('create', [
            'lapangData' => $lapangData
        ]);
    }

    public function lapang()
    {
        global $conn;
        $lapangData = Lapang::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'] ?? null;
            $kode_lapang = $_POST['kode_lapang'];
            $nama_lapang = $_POST['nama_lapang'];

            try {
                if ($id) {
                    $success = Lapang::updateData(
                        $conn,
                        $id,
                        $kode_lapang,
                        $nama_lapang
                    );
                    if ($success) {
                        $_SESSION['update'] = 'Data berhasil update.';
                    } else {
                        $_SESSION['error'] = 'Gagal memperbarui data.';
                    }
                } else {
                    $success = Lapang::storeData(
                        $conn,
                        $kode_lapang,
                        $nama_lapang
                    );
                    if ($success) {
                        $_SESSION['update'] = 'Data berhasil ditambahkan.';
                    } else {
                        $_SESSION['error'] = 'Gagal memperbarui data.';
                    }
                }

                if ($success) {
                    header('Location: /admin/prasarana/lapang');
                    exit();
                } else {
                    $this->renderView('index', [
                        'lapangData' => $lapangData,
                        'error' => 'Gagal menyimpan atau mengupdate data.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                $this->renderView('index', [
                    'lapangData' => $lapangData,
                    'error' => 'Error DB: ' . $e->getMessage()
                ]);
                return;
            }
        }

        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            $id = $_GET['delete'];
            if (Lapang::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data.';
            }
            header('Location: /admin/prasarana/lapang');
            exit();
        }

        $this->renderView('index', [
            'lapangData' => $lapangData
        ]);
    }
}
