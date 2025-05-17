<?php
require_once __DIR__ . '/../Models/Gedung.php';
require_once __DIR__ . '/../Models/JenisAset.php';

class GedungController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Gedung/{$view}.php";
    }

    public function create()
    {
        global $conn;
        $gedungData = Gedung::getAllData($conn);
        $jenis_aset_id = JenisAset::GetAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kode_gedung = $_POST['kode_gedung'];
            $nama_gedung = $_POST['nama_gedung'];
            $jenis_aset_id = $_POST['jenis_aset_id'];
            $luas = $_POST['luas'];
            $jumlah_lantai = $_POST['jumlah_lantai'];
            $kontruksi = $_POST['kontruksi'];
            $lokasi = $_POST['lokasi'];
            $kondisi = $_POST['kondisi'];
            $unit_kepemilikan = $_POST['unit_kepemilikan'];
            $fungsi = $_POST['fungsi'];

            try {
                $success = Gedung::storeData(
                    $conn,
                    $kode_gedung,
                    $nama_gedung,
                    $jenis_aset_id,
                    $luas,
                    $jumlah_lantai,
                    $kontruksi,
                    $lokasi,
                    $kondisi,
                    $unit_kepemilikan,
                    $fungsi
                );

                $message = $success ? 'Data gedung berhasil ditambahkan.' : 'Gagal menambahkan data gedung.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/prasarana/gedung');
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('create', [
            'gedungData' => $gedungData,
            'jenisAsetId' => $jenis_aset_id
        ]);
    }

    public function update($id)
    {
        global $conn;
        $gedung = Gedung::getById($conn, $id);
        $jenis_aset_id = JenisAset::GetAllData($conn);

        if (!$gedung) {
            $_SESSION['error'] = 'Data gedung tidak ditemukan.';
            header('Location: /admin/prasarana/gedung');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kode_gedung = $_POST['kode_gedung'];
            $nama_gedung = $_POST['nama_gedung'];
            $jenis_aset_id = $_POST['jenis_aset_id'];
            $luas = $_POST['luas'];
            $jumlah_lantai = $_POST['jumlah_lantai'];
            $kontruksi = $_POST['kontruksi'];
            $lokasi = $_POST['lokasi'];
            $kondisi = $_POST['kondisi'];
            $unit_kepemilikan = $_POST['unit_kepemilikan'];
            $fungsi = $_POST['fungsi'];

            try {
                $success = Gedung::updateData(
                    $conn,
                    $id,
                    $kode_gedung,
                    $nama_gedung,
                    $jenis_aset_id,
                    $luas,
                    $jumlah_lantai,
                    $kontruksi,
                    $lokasi,
                    $kondisi,
                    $unit_kepemilikan,
                    $fungsi
                );

                $message = $success ? 'Data gedung berhasil diperbarui.' : 'Gagal memperbarui data gedung.';
                $_SESSION['update'] = $message;

                header('Location: /admin/prasarana/gedung');
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('update', [
            'gedung' => $gedung,
            'jenisAsetId' => $jenis_aset_id
        ]);
    }

    private function delete()
    {
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            global $conn;
            $id = $_GET['delete'];
            if (Gedung::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data gedung berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data gedung.';
            }
            header('Location: /admin/prasarana/gedung');
            exit();
        }
    }

    public function gedung()
    {
        global $conn;
        $gedungData = Gedung::getAllData($conn);

        $this->delete();

        $this->renderView('index', [
            'gedungData' => $gedungData,
        ]);
    }

    public function detail($id)
    {
        global $conn;

        $detailData = Gedung::getById($conn, $id);

        $this->delete();
        $this->renderView('detail', [
            'detailData' => $detailData,
        ]);
    }
}
