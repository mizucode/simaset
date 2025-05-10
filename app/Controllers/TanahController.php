<?php
require_once __DIR__ . '/../Models/Tanah.php';
require_once __DIR__ . '/../Models/JenisAset.php';

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
        $jenis_aset_id = JenisAset::GetAllData($conn);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kode_aset = $_POST['kode_aset'];
            $nama_aset = $_POST['nama_aset'];
            $jenis_aset_id = $_POST['jenis_aset_id'];
            $nomor_sertifikat = $_POST['nomor_sertifikat'];
            $luas = $_POST['luas'];
            $lokasi = $_POST['lokasi'];
            $tgl_pajak = $_POST['tgl_pajak'];
            $fungsi = $_POST['fungsi'];
            $keterangan = $_POST['keterangan'];

            // Handle file upload
            $file_sertifikat = '';
            if (!empty($_FILES['file_sertifikat']['name'])) {
                $uploadDir = __DIR__ . '/../../storage/sertifikat/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // buat folder kalau belum ada
                }

                $fileName = time() . '_' . basename($_FILES['file_sertifikat']['name']);
                $targetFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['file_sertifikat']['tmp_name'], $targetFile)) {
                    $file_sertifikat = $fileName;
                } else {
                    $_SESSION['error'] = 'Gagal mengupload file sertifikat.';
                    $this->renderView('create', [
                        'tanahData' => $tanahData,
                        'jenisAsetId' => $jenis_aset_id
                    ]);
                    return;
                }
            }

            try {
                $success = Tanah::storeData(
                    $conn,
                    $kode_aset,
                    $nama_aset,
                    $jenis_aset_id,
                    $nomor_sertifikat,
                    $luas,
                    $lokasi,
                    $tgl_pajak,
                    $fungsi,
                    $keterangan,
                    $file_sertifikat // tambahkan di model
                );
                $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/prasarana/tanah');
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('create', [
            'tanahData' => $tanahData,
            'jenisAsetId' => $jenis_aset_id
        ]);
    }


    public function update($id)
    {
        global $conn;
        $tanah = Tanah::getById($conn, $id);
        $jenis_aset_id = JenisAset::GetAllData($conn);

        if (!$tanah) {
            $_SESSION['error'] = 'Data tidak ditemukan.';
            header('Location: /admin/prasarana/tanah');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kode_aset = $_POST['kode_aset'];
            $nama_aset = $_POST['nama_aset'];
            $jenis_aset_id = $_POST['jenis_aset_id'];
            $nomor_sertifikat = $_POST['nomor_sertifikat'];
            $luas = $_POST['luas'];
            $lokasi = $_POST['lokasi'];
            $tgl_pajak = $_POST['tgl_pajak'];
            $fungsi = $_POST['fungsi'];
            $keterangan = $_POST['keterangan'];

            // Handle file upload
            $file_sertifikat = $tanah['file_sertifikat']; // tetap gunakan file lama kalau tidak upload baru
            if (!empty($_FILES['file_sertifikat']['name'])) {
                $uploadDir = __DIR__ . '/../../storage/sertifikat/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true); // Membuat direktori jika belum ada
                }

                $fileName = time() . '_' . basename($_FILES['file_sertifikat']['name']);
                $targetFile = $uploadDir . $fileName;

                // Proses upload file
                if (move_uploaded_file($_FILES['file_sertifikat']['tmp_name'], $targetFile)) {
                    // Jika upload berhasil, simpan nama file baru
                    $file_sertifikat = $fileName;

                    // Hapus file lama jika ada
                    $oldFile = $uploadDir . $tanah['file_sertifikat'];
                    if (!empty($tanah['file_sertifikat']) && file_exists($oldFile)) {
                        unlink($oldFile); // Menghapus file lama
                    }
                } else {
                    // Jika upload gagal, tampilkan pesan error
                    $_SESSION['error'] = 'Gagal mengupload file sertifikat.';
                    $this->renderView('update', [
                        'tanah' => $tanah,
                        'jenisAsetId' => $jenis_aset_id
                    ]);
                    return;
                }
            }

            // Update data tanah setelah file sertifikat berhasil diupload atau tidak ada perubahan file
            try {
                $success = Tanah::updateData(
                    $conn,
                    $id,
                    $kode_aset,
                    $nama_aset,
                    $jenis_aset_id,
                    $nomor_sertifikat,
                    $luas,
                    $lokasi,
                    $tgl_pajak,
                    $fungsi,
                    $keterangan,
                    $file_sertifikat // tambahkan di model
                );

                // Menampilkan pesan sesuai dengan status update
                $message = $success ? 'Data berhasil diperbarui.' : 'Gagal memperbarui data.';
                $_SESSION['update'] = $message;

                header('Location: /admin/prasarana/tanah');
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        // Menampilkan halaman update
        $this->renderView('update', [
            'tanah' => $tanah,
            'jenisAsetId' => $jenis_aset_id
        ]);
    }


    private function delete()
    {
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            global $conn;
            $id = $_GET['delete'];
            if (Tanah::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data.';
            }
            header('Location: /admin/prasarana/tanah');
            exit();
        }
    }

    public function tanah()
    {
        global $conn;
        $tanahData = Tanah::getAllData($conn);

        $this->delete();

        $this->renderView('index', [
            'tanahData' => $tanahData,
        ]);
    }
}
