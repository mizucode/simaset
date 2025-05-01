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
            $id = $_POST['id'] ?? null;
            $lokasi_id = $_POST['lokasi_id'];
            $kode_tanah = $_POST['kode_tanah'];
            $nama_tanah = $_POST['nama_tanah'];
            $luas = $_POST['luas'];
            $status_tanah = $_POST['status_tanah'];
            $sertifikat_nomor = $_POST['sertifikat_nomor'];
            $sertifikat_tanggal = $_POST['sertifikat_tanggal'];
            $pajak_tanggal = $_POST['pajak_tanggal'];
            $penggunaan = $_POST['penggunaan'];
            $sumber_dana = $_POST['sumber_dana'];
            $alamat = $_POST['alamat'];
            $keterangan = $_POST['keterangan'];

            try {
                if ($id) {
                    $success = Tanah::updateData(
                        $conn,
                        $id,
                        $lokasi_id,
                        $kode_tanah,
                        $nama_tanah,
                        $luas,
                        $status_tanah,
                        $sertifikat_nomor,
                        $sertifikat_tanggal,
                        $pajak_tanggal,
                        $penggunaan,
                        $sumber_dana,
                        $alamat,
                        $keterangan
                    );
                } else {
                    $success = Tanah::storeData(
                        $conn,
                        $lokasi_id,
                        $kode_tanah,
                        $nama_tanah,
                        $luas,
                        $status_tanah,
                        $sertifikat_nomor,
                        $sertifikat_tanggal,
                        $pajak_tanggal,
                        $penggunaan,
                        $sumber_dana,
                        $alamat,
                        $keterangan
                    );
                }

                if ($success) {
                    header('Location: /admin/prasarana/tanah');
                    exit();
                } else {
                    $this->renderView('index', [
                        'tanahData' => $tanahData,
                        'lokasi' => $lokasi,
                        'error' => 'Gagal menyimpan atau mengupdate data.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
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
            $id = $_POST['id'] ?? null;
            $lokasi_id = $_POST['lokasi_id'];
            $kode_tanah = $_POST['kode_tanah'];
            $nama_tanah = $_POST['nama_tanah'];
            $luas = $_POST['luas'];
            $status_tanah = $_POST['status_tanah'];
            $sertifikat_nomor = $_POST['sertifikat_nomor'];
            $sertifikat_tanggal = $_POST['sertifikat_tanggal'];
            $pajak_tanggal = $_POST['pajak_tanggal'];
            $penggunaan = $_POST['penggunaan'];
            $sumber_dana = $_POST['sumber_dana'];
            $alamat = $_POST['alamat'];
            $keterangan = $_POST['keterangan'];

            try {
                if ($id) {
                    $success = Tanah::updateData(
                        $conn,
                        $id,
                        $lokasi_id,
                        $kode_tanah,
                        $nama_tanah,
                        $luas,
                        $status_tanah,
                        $sertifikat_nomor,
                        $sertifikat_tanggal,
                        $pajak_tanggal,
                        $penggunaan,
                        $sumber_dana,
                        $alamat,
                        $keterangan
                    );
                    if ($success) {
                        $_SESSION['update'] = 'Data berhasil update.';
                    } else {
                        $_SESSION['error'] = 'Gagal memperbarui data.';
                    }
                } else {
                    $success = Tanah::storeData(
                        $conn,
                        $lokasi_id,
                        $kode_tanah,
                        $nama_tanah,
                        $luas,
                        $status_tanah,
                        $sertifikat_nomor,
                        $sertifikat_tanggal,
                        $pajak_tanggal,
                        $penggunaan,
                        $sumber_dana,
                        $alamat,
                        $keterangan
                    );
                    if ($success) {
                        $_SESSION['update'] = 'Data berhasil ditambahkan.';
                    } else {
                        $_SESSION['error'] = 'Gagal memperbarui data.';
                    }
                }

                if ($success) {
                    header('Location: /admin/prasarana/tanah');
                    exit();
                } else {
                    $this->renderView('index', [
                        'tanahData' => $tanahData,
                        'lokasi' => $lokasi,
                        'error' => 'Gagal menyimpan atau mengupdate data.'
                    ]);
                    return;
                }
            } catch (PDOException $e) {
                $this->renderView('index', [
                    'tanahData' => $tanahData,
                    'lokasi' => $lokasi,
                    'error' => 'Error DB: ' . $e->getMessage()
                ]);
                return;
            }
        }

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

        $this->renderView('index', [
            'tanahData' => $tanahData,
            'lokasi' => $lokasi,
        ]);
    }
}
