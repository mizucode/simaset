<?php
require_once __DIR__ . '/../Models/SaranaATK.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';
require_once __DIR__ . '/../Models/DokumenSaranaATK.php';

class SaranaATKController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/BarangATK/{$view}.php";
    }

    public function create()
    {
        global $conn;
        $saranaData = SaranaATK::getAllData($conn);
        $kategoriList = KategoriBarang::getAllData($conn);
        $barangList = Barang::getAllData($conn);
        $kondisiList = KondisiBarang::getAllData($conn);
        $lapangData = Lapang::getAllData($conn);
        $ruangData = Ruang::getAllData($conn);

        // Filter barang untuk kategori ATK (asumsi ID kategori ATK = 3)
        $filteredBarangList = array_filter($barangList, function ($barang) {
            return $barang['kategori_id'] == 3;
        });

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kategori_barang_id = $_POST['kategori_barang_id'];
            $barang_id = $_POST['barang_id'];
            $kondisi_barang_id = $_POST['kondisi_barang_id'];
            $nama_detail_barang = $_POST['nama_detail_barang'];
            $merk = $_POST['merk'] ?? null;
            $spesifikasi = $_POST['spesifikasi'] ?? null;
            $jumlah = $_POST['jumlah'] ?? 1;
            $satuan = $_POST['satuan'] ?? 'Unit';
            $lokasi = $_POST['lokasi'] ?? null;
            $keterangan = $_POST['keterangan'] ?? null;
            $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;
            $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;

            $no_registrasi = $this->generateUniqueRegistrationNumber(
                $conn,
                $barang_id,
                $tanggal_pembelian,
                $barangList
            );

            try {
                $success = SaranaATK::storeData(
                    $conn,
                    $kategori_barang_id,
                    $barang_id,
                    $kondisi_barang_id,
                    $no_registrasi,
                    $nama_detail_barang,
                    $merk,
                    $spesifikasi,
                    $jumlah,
                    $satuan,
                    $lokasi,
                    $biaya_pembelian,
                    $tanggal_pembelian,
                    $keterangan,
                );

                $message = $success ? 'Data sarana ATK berhasil ditambahkan.' : 'Gagal menambahkan data sarana ATK.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/sarana/atk');
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('create', [
            'saranaData' => $saranaData,
            'kategoriList' => $kategoriList,
            'barangList' => $filteredBarangList,
            'kondisiList' => $kondisiList,
            'lapangData' => $lapangData,
            'ruangData' => $ruangData
        ]);
    }

    public function update($id)
    {
        global $conn;
        $sarana = SaranaATK::getById($conn, $id);
        $kategoriList = KategoriBarang::getAllData($conn);
        $barangList = Barang::getAllData($conn);
        $kondisiList = KondisiBarang::getAllData($conn);
        $lapangData = Lapang::getAllData($conn);
        $ruangData = Ruang::getAllData($conn);

        if (!$sarana) {
            $_SESSION['error'] = 'Data sarana ATK tidak ditemukan.';
            header('Location: /admin/sarana/atk');
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $kategori_barang_id = $_POST['kategori_barang_id'];
            $barang_id = $_POST['barang_id'];
            $kondisi_barang_id = $_POST['kondisi_barang_id'];
            $nama_detail_barang = $_POST['nama_detail_barang'];
            $merk = $_POST['merk'] ?? null;
            $spesifikasi = $_POST['spesifikasi'] ?? null;
            $jumlah = $_POST['jumlah'] ?? 1;
            $satuan = $_POST['satuan'] ?? 'Unit';
            $lokasi = $_POST['lokasi'] ?? null;
            $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;
            $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;
            $keterangan = $_POST['keterangan'] ?? null;


            try {
                $success = SaranaATK::updateData(
                    $conn,
                    $id,
                    $kategori_barang_id,
                    $barang_id,
                    $kondisi_barang_id,
                    $sarana['no_registrasi'], // Keep existing registration number
                    $nama_detail_barang,
                    $merk,
                    $spesifikasi,
                    $jumlah,
                    $satuan,
                    $lokasi,
                    $biaya_pembelian,
                    $tanggal_pembelian,
                    $keterangan,

                );

                $message = $success ? 'Data sarana ATK berhasil diperbarui.' : 'Gagal memperbarui data sarana ATK.';
                $_SESSION['update'] = $message;

                header('Location: /admin/sarana/atk?detail=' . $id);
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('update', [
            'sarana' => $sarana,
            'kategoriList' => $kategoriList,
            'barangList' => $barangList,
            'kondisiList' => $kondisiList,
            'lapangData' => $lapangData,
            'ruangData' => $ruangData
        ]);
    }

    private function generateUniqueRegistrationNumber($conn, $barangId, $tanggal_pembelian, $barangList)
    {
        $year = $tanggal_pembelian ? date('Y', strtotime($tanggal_pembelian)) : date('Y');
        $barangCode = 'ATK';

        foreach ($barangList as $barang) {
            if ($barang['id'] == $barangId) {
                $barangCode = $barang['kode_barang'];
                break;
            }
        }

        do {
            $randomNumber = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
            $registrationNumber = "ATK-{$barangCode}-{$year}-{$randomNumber}";

            $stmt = $conn->prepare("SELECT COUNT(*) FROM sarana_atk WHERE no_registrasi = ?");
            $stmt->execute([$registrationNumber]);
            $exists = $stmt->fetchColumn() > 0;
        } while ($exists);

        return $registrationNumber;
    }

    public function delete()
    {
        if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
            global $conn;
            $id = $_GET['delete'];
            if (SaranaATK::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data sarana ATK berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data sarana ATK.';
            }
            header('Location: /admin/sarana/atk');
            exit();
        }
    }

    public function index()
    {
        global $conn;
        $saranaData = SaranaATK::getAllData($conn);
        $this->delete();

        $this->renderView('index', [
            'saranaData' => $saranaData,
        ]);
    }

    // dokumen
    public function dokumen($id)
    {
        global $conn;
        $dokumenData = SaranaATK::getById($conn, $id);
        $dokumenDataId = SaranaATK::getById($conn, $id)['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $aset_atk_id = $_POST['aset_atk_id'];
            $nama_dokumen = $_POST['nama_dokumen'];
            $path_dokumen = '';

            if (!empty($_FILES['path_dokumen']['name'])) {
                $uploadDir = __DIR__ . '/../../storage/dokumen_sarana_atk/';
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
                $success = DokumenSaranaATK::storeDokumenATK(
                    $conn,
                    $aset_atk_id,
                    $nama_dokumen,
                    $path_dokumen,
                );
                $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/sarana/atk?detail=' . $dokumenDataId);
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('/Dokumen/create', [
            'dokumenData' => $dokumenData,
        ]);
    }

    public function downloadDokumen($id)
    {
        global $conn;

        $dokumen = DokumenSaranaATK::getDokumenById($conn, $id);

        if (!$dokumen || empty($dokumen['path_dokumen'])) {
            $_SESSION['error'] = 'Dokumen tidak ditemukan.';
            header('Location: /admin/sarana/atk');
            exit();
        }

        $filePath = __DIR__ . '/../../storage/dokumen_sarana_atk/' . $dokumen['path_dokumen'];

        if (!file_exists($filePath)) {
            $_SESSION['error'] = 'File tidak ditemukan di server.';
            header('Location: /admin/sarana/atk');
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
            $aset_atk_id = DokumenSaranaATK::getDokumenById($conn, $id)['aset_atk_id'];

            if (DokumenSaranaATK::delete($conn, $id)) {
                $_SESSION['success'] = 'Data berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data.';
            }

            header('Location: /admin/sarana/atk?detail=' . $aset_atk_id);
            exit();
        }
    }

    // dokumen gambar
    public function dokumenGambar($id)
    {
        global $conn;
        $atkData = SaranaATK::getById($conn, $id);
        $atkDataId = SaranaATK::getById($conn, $id)['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $aset_atk_id = $_POST['aset_atk_id'];
            $nama_dokumen = $_POST['nama_dokumen'];
            $path_dokumen = '';

            if (!empty($_FILES['path_dokumen']['name'])) {
                $uploadDir = __DIR__ . '/../../storage/dokumentasi_sarana_atk/';
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
                        'atkData' => $atkData,
                    ]);
                    return;
                }
            }

            try {
                $success = DokumenSaranaATK::storeDokumentasiATK(
                    $conn,
                    $aset_atk_id,
                    $nama_dokumen,
                    $path_dokumen,
                );
                $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/sarana/atk?detail=' . $atkDataId);
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('/Dokumen/createFoto', [
            'atkData' => $atkData,
        ]);
    }

    public function previewDokumen($id)
    {
        global $conn;

        $dokumen = DokumenSaranaATK::getDokumenGambarById($conn, $id);

        if (!$dokumen || empty($dokumen['path_dokumen'])) {
            header("HTTP/1.0 404 Not Found");
            exit();
        }

        $filePath = __DIR__ . '/../../storage/dokumentasi_sarana_atk/' . $dokumen['path_dokumen'];

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
            $aset_atk_id = DokumenSaranaATK::getDokumenGambarById($conn, $id)['aset_atk_id'];

            if (DokumenSaranaATK::deleteGambar($conn, $id)) {
                $_SESSION['success'] = 'Data berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data.';
            }

            header('Location: /admin/sarana/atk?detail=' . $aset_atk_id);
            exit();
        }
    }

    public function detail($id)
    {
        global $conn;
        $detailData = SaranaATK::getById($conn, $id);
        $dokumenAsetATK = DokumenSaranaATK::getAllData($conn, $id);
        $dokumenGambarATK = DokumenSaranaATK::getAllDataGambar($conn, $id);

        if (!is_array($dokumenAsetATK)) {
            $dokumenAsetATK = [];
        }
        if (!is_array($dokumenGambarATK)) {
            $dokumenGambarATK = [];
        }

        $filteredDokumen = array_filter($dokumenAsetATK, function ($dokumen) use ($detailData) {
            return $dokumen['aset_atk_id'] == $detailData['id'];
        });

        $filteredGambar = array_filter($dokumenGambarATK, function ($dokumen) use ($detailData) {
            return $dokumen['aset_atk_id'] == $detailData['id'];
        });

        $this->delete();
        $this->deleteDokumentasi();
        $this->deleteDokumen();

        $this->renderView('detail', [
            'detailData' => $detailData,
            'dokumenSaranaATK' => $filteredDokumen,
            'dokumenGambar' => $filteredGambar,
        ]);
    }

    // download all qr
    public function downloadAllQr()
    {
        global $conn;
        $saranaData = SaranaATK::getAllData($conn);
        $this->renderView('downloadAll', [
            'saranaData' => $saranaData,
        ]);
    }
}
