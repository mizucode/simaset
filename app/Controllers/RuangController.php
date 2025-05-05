<?php
require_once __DIR__ . '/../Models/Ruang.php';
require_once __DIR__ . '/../Models/Gedung.php';

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
        $gedungData = Gedung::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $kode_ruang = $_POST['kode_ruang'];
            $nama_ruang = $_POST['nama_ruang'];
            $gedung_id = $_POST['gedung_id'] ?? null;

            try {
                if ($id) {
                    $success = Ruang::updateData(
                        $conn,
                        $id,
                        $kode_ruang,
                        $nama_ruang,
                        $gedung_id
                    );
                    if ($success) {
                        $_SESSION['update'] = 'Data berhasil diperbarui.';
                    } else {
                        $_SESSION['error'] = 'Gagal memperbarui data.';
                    }
                } else {
                    $success = Ruang::storeData(
                        $conn,
                        $kode_ruang,
                        $nama_ruang,
                        $gedung_id
                    );
                    if ($success) {
                        $_SESSION['update'] = 'Data berhasil ditambahkan.';
                    } else {
                        $_SESSION['error'] = 'Gagal menambahkan data.';
                    }
                }


                if ($success) {
                    header('Location: /admin/prasarana/ruang');
                    exit();
                } else {
                    $this->renderView('index', [
                        'ruangData' => $ruangData,
                        'error' => 'Gagal menyimpan atau mengupdate data.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                $this->renderView('index', [
                    'ruangData' => $ruangData,
                    'error' => 'Error DB: ' . $e->getMessage()
                ]);
                return;
            }
        }
        $this->renderView('create', [
            'ruangData' => $ruangData,
            'gedungData' => $gedungData
        ]);
    }
    public function ruang()
    {
        global $conn;
        $ruangData = Ruang::getAllData($conn);
        $gedungData = Gedung::getAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $id = $_POST['id'];
            $kode_ruang = $_POST['kode_ruang'];
            $nama_ruang = $_POST['nama_ruang'];
            $gedung_id = $_POST['gedung_id'] ?? null;

            try {
                if ($id) {
                    $success = Ruang::updateData(
                        $conn,
                        $id,
                        $kode_ruang,
                        $nama_ruang,
                        $gedung_id
                    );
                    if ($success) {
                        $_SESSION['update'] = 'Data berhasil diperbarui.';
                    } else {
                        $_SESSION['error'] = 'Gagal memperbarui data.';
                    }
                } else {
                    $success = Ruang::storeData(
                        $conn,
                        $kode_ruang,
                        $nama_ruang,
                        $gedung_id
                    );
                    if ($success) {
                        $_SESSION['update'] = 'Data berhasil ditambahkan.';
                    } else {
                        $_SESSION['error'] = 'Gagal menambahkan data.';
                    }
                }


                if ($success) {
                    header('Location: /admin/prasarana/ruang');
                    exit();
                } else {
                    $this->renderView('index', [
                        'ruangData' => $ruangData,
                        'error' => 'Gagal menyimpan atau mengupdate data.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                $this->renderView('index', [
                    'ruangData' => $ruangData,
                    'error' => 'Error DB: ' . $e->getMessage()
                ]);
                return;
            }
        }
        $this->renderView('index', [
            'ruangData' => $ruangData,
            'gedungData' =>   $gedungData
        ]);
    }
}
