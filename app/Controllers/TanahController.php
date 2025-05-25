<?php
require_once __DIR__ . '/../Models/Tanah.php';
require_once __DIR__ . '/../Models/JenisAset.php';
require_once __DIR__ . '/../Models/DokumenAsetTanah.php';

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

                // Replace spaces with underscores in filename
                $originalName = basename($_FILES['file_sertifikat']['name']);
                $sanitizedName = str_replace(' ', '_', $originalName);
                $fileName = time() . '_' . $sanitizedName;
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
                    $file_sertifikat
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
            $file_sertifikat = $tanah['file_sertifikat'];
            if (!empty($_FILES['file_sertifikat']['name'])) {
                $uploadDir = __DIR__ . '/../../storage/sertifikat/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                // Replace spaces with underscores in filename
                $originalName = basename($_FILES['file_sertifikat']['name']);
                $sanitizedName = str_replace(' ', '_', $originalName);
                $fileName = time() . '_' . $sanitizedName;
                $targetFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['file_sertifikat']['tmp_name'], $targetFile)) {
                    $file_sertifikat = $fileName;

                    // Hapus file lama jika ada
                    $oldFile = $uploadDir . $tanah['file_sertifikat'];
                    if (!empty($tanah['file_sertifikat']) && file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                } else {
                    $_SESSION['error'] = 'Gagal mengupload file sertifikat.';
                    $this->renderView('update', [
                        'tanah' => $tanah,
                        'jenisAsetId' => $jenis_aset_id
                    ]);
                    return;
                }
            }

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
                    $file_sertifikat
                );

                $message = $success ? 'Data berhasil diperbarui.' : 'Gagal memperbarui data.';
                $_SESSION['update'] = $message;

                header('Location: /admin/prasarana/tanah?detail=' . $id);
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

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
    public function deleteDokumen()
    {
        if (isset($_GET['delete-dokumen']) && is_numeric($_GET['delete-dokumen'])) {
            global $conn;
            $id = $_GET['delete-dokumen'];
            $aset_tanah_id = DokumenAsetTanah::getDokumenById($conn, $id)['aset_tanah_id'];

            if (DokumenAsetTanah::delete($conn, $id)) {
                $_SESSION['success'] = 'Data berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data.';
            }


            header('Location: /admin/prasarana/tanah?detail=' . $aset_tanah_id);
            exit();
        }
    }
    public function deleteDokumentasi()
    {
        if (isset($_GET['delete-gambar']) && is_numeric($_GET['delete-gambar'])) {
            global $conn;
            $id = $_GET['delete-gambar'];
            $aset_tanah_id = DokumenAsetTanah::getDokumenGambarById($conn, $id)['aset_tanah_id'];

            if (DokumenAsetTanah::deleteGambar($conn, $id)) {
                $_SESSION['success'] = 'Data berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data.';
            }


            header('Location: /admin/prasarana/tanah?detail=' . $aset_tanah_id);
            exit();
        }
    }

    public function download()
    {
        if (!isset($_SESSION['user'])) {
            header('HTTP/1.1 403 Forbidden');
            exit('Unauthorized');
        }

        if (!isset($_GET['filename']) || !isset($_GET['jenis'])) {
            http_response_code(400);
            echo "Invalid request.";
            exit;
        }

        $filename = basename($_GET['filename']); // hindari directory traversal
        $jenis = $_GET['jenis'];

        // Tentukan folder berdasarkan jenis file
        $folderMap = [
            'sertifikat' => __DIR__ . '/../../storage/sertifikat/',
            'bukti' => __DIR__ . '/../../storage/bukti_kepemilikan/',
        ];

        if (!array_key_exists($jenis, $folderMap)) {
            http_response_code(400);
            echo "Jenis file tidak valid.";
            exit;
        }

        $filepath = $folderMap[$jenis] . $filename;

        if (!file_exists($filepath)) {
            http_response_code(404);
            echo "File not found.";
            exit;
        }

        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    }

    public function preview()
    {
        if (!isset($_SESSION['user'])) {
            header('HTTP/1.1 403 Forbidden');
            exit('Unauthorized');
        }

        $filename = basename($_GET['filename']);
        $jenis = $_GET['jenis'];

        // Pastikan folder sesuai dengan jenis file
        $folder = '';
        if ($jenis === 'sertifikat') {
            $folder = 'sertifikat';
        } elseif ($jenis === 'bukti') {
            $folder = 'bukti';
        } else {
            http_response_code(400);
            echo "Invalid file type.";
            exit;
        }

        $filepath = __DIR__ . '/../../storage/' . $folder . '/' . $filename;

        if (!file_exists($filepath)) {
            http_response_code(404);
            echo "File not found.";
            exit;
        }

        // Tampilkan langsung file PDF di browser
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        readfile($filepath);
        exit;
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

    public function dokumen($id)
    {
        global $conn;
        $tanahData = Tanah::getById($conn, $id);
        $tanahDataId = Tanah::getById($conn, $id)['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $aset_tanah_id = $_POST['aset_tanah_id'];
            $nama_dokumen = $_POST['nama_dokumen'];
            $path_dokumen = '';

            if (!empty($_FILES['path_dokumen']['name'])) {
                $uploadDir = __DIR__ . '/../../storage/dokumen_tanah/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $originalName = basename($_FILES['path_dokumen']['name']);
                $sanitizedName = str_replace(' ', '_', $originalName);
                $fileName = time() . '_' . $sanitizedName;
                $targetFile = $uploadDir . $fileName;

                // Debug: print the target file path
                error_log("Attempting to upload file to: " . $targetFile);

                if (move_uploaded_file($_FILES['path_dokumen']['tmp_name'], $targetFile)) {
                    $path_dokumen = $fileName;
                    error_log("File uploaded successfully: " . $path_dokumen);
                } else {
                    error_log("File upload failed. Error: " . $_FILES['path_dokumen']['error']);
                    $_SESSION['error'] = 'Gagal mengupload file sertifikat.';
                    $this->renderView('create', [
                        'tanahData' => $tanahData,
                    ]);
                    return;
                }
            }

            try {
                $success = Tanah::storeDokumenTanah(
                    $conn,
                    $aset_tanah_id,
                    $nama_dokumen,
                    $path_dokumen, // Now this contains the filename if upload was successful
                );
                $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/prasarana/tanah?detail=' . $tanahDataId);
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('/Dokumen/create', [  // Fixed typo in view path (changed from '/Doumen/create')
            'tanahData' => $tanahData,
        ]);
    }

    public function downloadDokumen($id)
    {
        global $conn;

        // 1. Ambil data dokumen dari database
        $dokumen = DokumenAsetTanah::getDokumenById($conn, $id);

        if (!$dokumen || empty($dokumen['path_dokumen'])) {
            $_SESSION['error'] = 'Dokumen tidak ditemukan.';
            header('Location: /admin/prasarana/tanah');
            exit();
        }

        // 2. Tentukan path file
        $filePath = __DIR__ . '/../../storage/dokumen_tanah/' . $dokumen['path_dokumen'];

        // 3. Validasi file
        if (!file_exists($filePath)) {
            $_SESSION['error'] = 'File tidak ditemukan di server.';
            header('Location: /admin/prasarana/tanah');
            exit();
        }

        // 4. Set headers untuk download
        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename="' . basename($filePath) . '"');
        header('Content-Length: ' . filesize($filePath));
        header('Expires: 0');
        header('Cache-Control: must-revalidate');
        header('Pragma: public');

        // 5. Output file
        ob_clean();
        flush();
        readfile($filePath);
        exit;
    }

    public function previewDokumen($id)
    {
        global $conn;

        // Ambil data dokumen dari database
        $dokumen = DokumenAsetTanah::getDokumenGambarById($conn, $id);

        if (!$dokumen || empty($dokumen['path_dokumen'])) {
            header("HTTP/1.0 404 Not Found");
            exit();
        }

        $filePath = __DIR__ . '/../../storage/dokumentasi_tanah/' . $dokumen['path_dokumen'];

        // Validasi file dan pastikan hanya gambar yang ditampilkan
        if (!file_exists($filePath)) {
            header("HTTP/1.0 404 Not Found");
            exit();
        }

        $mimeType = mime_content_type($filePath);

        // Hanya izinkan tipe MIME gambar
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

    public function dokumenGambar($id)
    {
        global $conn;
        $tanahData = Tanah::getById($conn, $id);
        $tanahDataId = Tanah::getById($conn, $id)['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $aset_tanah_id = $_POST['aset_tanah_id'];
            $nama_dokumen = $_POST['nama_dokumen'];
            $path_dokumen = '';

            if (!empty($_FILES['path_dokumen']['name'])) {
                $uploadDir = __DIR__ . '/../../storage/dokumentasi_tanah/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $originalName = basename($_FILES['path_dokumen']['name']);
                $sanitizedName = str_replace(' ', '_', $originalName);
                $fileName = time() . '_' . $sanitizedName;
                $targetFile = $uploadDir . $fileName;

                // Debug: print the target file path
                error_log("Attempting to upload file to: " . $targetFile);

                if (move_uploaded_file($_FILES['path_dokumen']['tmp_name'], $targetFile)) {
                    $path_dokumen = $fileName;
                    error_log("File uploaded successfully: " . $path_dokumen);
                } else {
                    error_log("File upload failed. Error: " . $_FILES['path_dokumen']['error']);
                    $_SESSION['error'] = 'Gagal mengupload file sertifikat.';
                    $this->renderView('create', [
                        'tanahData' => $tanahData,
                    ]);
                    return;
                }
            }

            try {
                $success = Tanah::storeDokumentasiTanah(
                    $conn,
                    $aset_tanah_id,
                    $nama_dokumen,
                    $path_dokumen, // Now this contains the filename if upload was successful
                );
                $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/prasarana/tanah?detail=' . $tanahDataId);
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
                header('Location: /admin/prasarana/tanah?detail=' . $tanahDataId);
            }
        }

        $this->renderView('/Dokumen/createFoto', [  // Fixed typo in view path (changed from '/Doumen/create')
            'tanahData' => $tanahData,
        ]);
    }

    public function detail($id)
    {
        global $conn;
        $detailData = Tanah::getById($conn, $id);
        $dokumenAsetTanah = DokumenAsetTanah::getAllData($conn, $id);
        $dokumenGambarTanah = DokumenAsetTanah::getAllDataGambar($conn, $id);

        if (!is_array($dokumenAsetTanah)) {
            $dokumenAsetTanah = [];
        }
        if (!is_array($dokumenGambarTanah)) {
            $dokumenGambarTanah = [];
        }

        $filteredDokumen = array_filter($dokumenAsetTanah, function ($dokumen) use ($detailData) {
            return $dokumen['aset_tanah_id'] == $detailData['id'];
        });

        $filteredGambar = array_filter($dokumenGambarTanah, function ($dokumen) use ($detailData) {
            return $dokumen['aset_tanah_id'] == $detailData['id'];
        });

        $this->delete();
        $this->deleteDokumen();
        $this->deleteDokumentasi();
        $this->renderView('detail', [
            'detailData' => $detailData,
            'dokumenAsetTanah' => $filteredDokumen,
            'dokumenGambar' => $filteredGambar,
        ]);
    }
}
