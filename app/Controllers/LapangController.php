<?php
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/JenisAset.php';
require_once __DIR__ . '/../Models/SaranaBergerak.php';

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

                header('Location: /admin/prasarana/lapang?detail=' . $id);
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

    public function dokumen($id)
    {
        global $conn;
        $dokumenData = Lapang::getById($conn, $id);
        $dokumenDataId = Lapang::getById($conn, $id)['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $aset_lapang_id = $_POST['aset_lapang_id'];
            $nama_dokumen = $_POST['nama_dokumen'];
            $path_dokumen = '';

            if (!empty($_FILES['path_dokumen']['name'])) {
                $uploadDir = __DIR__ . '/../../storage/dokumen_lapang/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $originalName = basename($_FILES['path_dokumen']['name']);
                $sanitizedName = str_replace(' ', '_', $originalName);
                $fileName = time() . '_' . $sanitizedName;
                $targetFile = $uploadDir . $fileName;

                error_log("Attempting to upload file to: " . $targetFile);

                if (move_uploaded_file($_FILES['path_dokumen']['tmp_name'], $targetFile)) {
                    $path_dokumen = $fileName;
                    error_log("File uploaded successfully: " . $path_dokumen);
                } else {
                    error_log("File upload failed. Error: " . $_FILES['path_dokumen']['error']);
                    $_SESSION['error'] = 'Gagal mengupload file dokumen.';
                    $this->renderView('create', [
                        'dokumenData' => $dokumenData,
                    ]);
                    return;
                }
            }

            try {
                $success = DokumenAsetLapang::storeDokumenLapang(
                    $conn,
                    $aset_lapang_id,
                    $nama_dokumen,
                    $path_dokumen,
                );
                $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/prasarana/lapang?detail=' . $dokumenDataId);
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('/Dokumen/create', [
            'dokumenData' => $dokumenData,
            'dokumenDataId' => $dokumenDataId
        ]);
    }

    public function downloadDokumen($id)
    {
        global $conn;

        $dokumen = DokumenAsetLapang::getDokumenById($conn, $id);

        if (!$dokumen || empty($dokumen['path_dokumen'])) {
            $_SESSION['error'] = 'Dokumen tidak ditemukan.';
            header('Location: /admin/prasarana/lapang');
            exit();
        }

        $filePath = __DIR__ . '/../../storage/dokumen_lapang/' . $dokumen['path_dokumen'];

        if (!file_exists($filePath)) {
            $_SESSION['error'] = 'File tidak ditemukan di server.';
            header('Location: /admin/prasarana/lapang');
            exit();
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        ob_clean();
        flush();
        readfile($filePath);
        exit;
    }

    public function deleteDokumen()
    {
        if (isset($_GET['delete-dokumen']) && is_numeric($_GET['delete-dokumen'])) {
            global $conn;
            $id = $_GET['delete-dokumen'];
            $aset_lapang_id = DokumenAsetLapang::getDokumenById($conn, $id)['aset_lapang_id'];

            if (DokumenAsetLapang::delete($conn, $id)) {
                $_SESSION['success'] = 'Data berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data.';
            }

            header('Location: /admin/prasarana/lapang?detail=' . $aset_lapang_id);
            exit();
        }
    }

    // dokumen gambar
    public function dokumenGambar($id)
    {
        global $conn;
        $lapangData = Lapang::getById($conn, $id);
        $lapangDataId = Lapang::getById($conn, $id)['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $aset_lapang_id = $_POST['aset_lapang_id'];
            $nama_dokumen = $_POST['nama_dokumen'];
            $path_dokumen = '';

            if (!empty($_FILES['path_dokumen']['name'])) {
                $uploadDir = __DIR__ . '/../../storage/dokumentasi_lapang/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $originalName = basename($_FILES['path_dokumen']['name']);
                $sanitizedName = str_replace(' ', '_', $originalName);
                $fileName = time() . '_' . $sanitizedName;
                $targetFile = $uploadDir . $fileName;

                error_log("Attempting to upload file to: " . $targetFile);

                if (move_uploaded_file($_FILES['path_dokumen']['tmp_name'], $targetFile)) {
                    $path_dokumen = $fileName;
                    error_log("File uploaded successfully: " . $path_dokumen);
                } else {
                    error_log("File upload failed. Error: " . $_FILES['path_dokumen']['error']);
                    $_SESSION['error'] = 'Gagal mengupload file gambar.';
                    $this->renderView('create', [
                        'lapangData' => $lapangData,
                    ]);
                    return;
                }
            }

            try {
                $success = DokumenAsetLapang::storeDokumentasiLapang(
                    $conn,
                    $aset_lapang_id,
                    $nama_dokumen,
                    $path_dokumen,
                );
                $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/prasarana/lapang?detail=' . $lapangDataId);
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('/Dokumen/createFoto', [
            'lapangData' => $lapangData,
            'lapangDataId' => $lapangDataId,
        ]);
    }

    public function previewDokumen($id)
    {
        global $conn;

        $dokumen = DokumenAsetLapang::getDokumenGambarById($conn, $id);

        if (!$dokumen || empty($dokumen['path_dokumen'])) {
            header("HTTP/1.0 404 Not Found");
            exit();
        }

        $filePath = __DIR__ . '/../../storage/dokumentasi_lapang/' . $dokumen['path_dokumen'];

        if (!file_exists($filePath)) {
            header("HTTP/1.0 404 Not Found");
            exit();
        }

        $mimeType = mime_content_type($filePath);

        $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($mimeType, $allowedTypes)) {
            header("HTTP/1.0 403 Forbidden");
            exit('File bukan gambar yang valid');
        }

        header('Content-Type: ' . $mimeType);
        header('Content-Length: ' . filesize($filePath));
        readfile($filePath);
        exit;
    }

    public function deleteDokumentasi()
    {
        if (isset($_GET['delete-gambar']) && is_numeric($_GET['delete-gambar'])) {
            global $conn;
            $id = $_GET['delete-gambar'];
            $aset_lapang_id = DokumenAsetLapang::getDokumenGambarById($conn, $id)['aset_lapang_id'];

            if (DokumenAsetLapang::deleteGambar($conn, $id)) {
                $_SESSION['success'] = 'Data berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data.';
            }

            header('Location: /admin/prasarana/lapang?detail=' . $aset_lapang_id);
            exit();
        }
    }

    public function detail($id)
    {
        global $conn;

        $detailData = Lapang::getById($conn, $id);
        $barangList = SaranaBergerak::getAllData($conn);
        $barangMebel = SaranaMebelair::getAllData($conn);
        $barangATK = SaranaATK::getAllData($conn);
        $barangElektronik = SaranaElektronik::getAllData($conn);
        $dokumenAsetLapang = DokumenAsetLapang::getAllData($conn, $id);
        $dokumenGambarLapang = DokumenAsetLapang::getAllDataGambar($conn, $id);


        if (!is_array($dokumenAsetLapang)) {
            $dokumenAsetLapang = [];
        }
        if (!is_array($dokumenGambarLapang)) {
            $dokumenGambarLapang = [];
        }

        $filteredDokumen = array_filter($dokumenAsetLapang, function ($dokumen) use ($detailData) {
            return $dokumen['aset_lapang_id'] == $detailData['id'];
        });

        $filteredGambar = array_filter($dokumenGambarLapang, function ($dokumen) use ($detailData) {
            return $dokumen['aset_lapang_id'] == $detailData['id'];
        });


        // Gabungkan kedua array barang
        $semuaBarang = array_merge($barangList, $barangMebel, $barangATK, $barangElektronik);

        // Filter barang berdasarkan lokasi lapangan yang sedang dilihat
        $filteredBarangList = array_filter($semuaBarang, function ($barang) use ($detailData) {
            return $barang['lokasi'] == $detailData['nama_lapang'];
        });

        $this->delete();
        $this->deleteDokumen();
        $this->deleteDokumentasi();
        $this->renderView('detail', [
            'detailData' => $detailData,
            'filteredBarangList' => $filteredBarangList,
            'dokumenAsetLapang' => $filteredDokumen,
            'dokumenGambar' => $filteredGambar,
        ]);
    }
}
