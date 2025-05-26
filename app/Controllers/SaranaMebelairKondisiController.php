<?php

// Asumsi ada model DokumenSaranaMebelair.php yang serupa dengan DokumenSaranaBergerak.php
require_once __DIR__ . '/../Models/SaranaMebelair.php';
require_once __DIR__ . '/../Models/DokumenSaranaMebelair.php'; // Diperlukan untuk fitur dokumen & gambar
// Model lain yang mungkin masih relevan (sesuai kebutuhan create/update form Mebelair)
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/Ruang.php';


class SaranaMebelairKondisiController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        // Path view disesuaikan untuk Mebelair
        require_once __DIR__ . "/../Views/Pages/Kondisi/SaranaMebelair/{$view}.php";
    }

    public function create()
    {
        global $conn;
        // Data yang mungkin diperlukan untuk form create Mebelair
        $kategoriList = KategoriBarang::getAllData($conn);
        $barangList = Barang::getAllData($conn); // Akan difilter nanti
        $kondisiList = KondisiBarang::getAllData($conn);
        $lapangData = Lapang::getAllData($conn);
        $ruangData = Ruang::getAllData($conn);

        // Filter barang untuk kategori mebelair (misal kategori_id = 2, sesuaikan jika berbeda)
        $filteredBarangList = array_filter($barangList, function ($barang) {
            return $barang['kategori_id'] == 2; // Pastikan ID kategori ini benar untuk Mebelair
        });

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Field spesifik untuk Sarana Mebelair
            $kategori_barang_id = $_POST['kategori_barang_id'];
            $barang_id = $_POST['barang_id'];
            $kondisi_barang_id = $_POST['kondisi_barang_id'];
            $nama_detail_barang = $_POST['nama_detail_barang'];
            $merk = $_POST['merk'] ?? null;
            $spesifikasi = $_POST['spesifikasi'] ?? null;
            $sumber = $_POST['sumber'] ?? null;
            $jumlah = $_POST['jumlah'] ?? 1;
            $satuan = $_POST['satuan'] ?? 'Unit';
            $lokasi = $_POST['lokasi']; // Bisa jadi gabungan lapang/ruang
            $bahan = $_POST['bahan'] ?? null;
            $keterangan = $_POST['keterangan'] ?? null;
            // Asumsi tanggal_pembelian dan biaya_pembelian juga ada di form Mebelair,
            // jika tidak, sesuaikan atau set default null. Ini diperlukan untuk generateUniqueRegistrationNumber
            $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;
            $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;


            // Menggunakan generator nomor registrasi dari template, disesuaikan untuk Mebelair
            $no_registrasi = $this->generateUniqueRegistrationNumber(
                $conn,
                $barang_id,
                $tanggal_pembelian, // Atau tanggal input lain yang relevan
                $barangList // Daftar barang untuk mendapatkan kode barang
            );

            try {
                $success = SaranaMebelair::storeData(
                    $conn,
                    $kategori_barang_id,
                    $barang_id,
                    $kondisi_barang_id,
                    $no_registrasi, // Nomor registrasi yang di-generate
                    $nama_detail_barang,
                    $merk,
                    $spesifikasi,
                    $sumber,
                    $jumlah,
                    $satuan,
                    $lokasi,
                    $bahan,
                    $keterangan,
                    $biaya_pembelian, // tambahkan jika ada
                    $tanggal_pembelian // tambahkan jika ada
                );

                $message = $success ? 'Data sarana mebelair berhasil ditambahkan.' : 'Gagal menambahkan data sarana mebelair.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/sarana/mebelair'); // Path redirect disesuaikan
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('create', [
            // 'saranaData' => $saranaData, // Tidak digunakan di create, tapi bisa jika ada list di halaman create
            'kategoriList' => $kategoriList,
            'barangList' => $filteredBarangList, // Barang yang sudah difilter
            'kondisiList' => $kondisiList,
            "lapangData" => $lapangData,
            "ruangData" => $ruangData,
        ]);
    }

    public function update($id)
    {
        global $conn;
        $sarana = SaranaMebelair::getById($conn, $id);
        $kategoriList = KategoriBarang::getAllData($conn);
        $barangList = Barang::getAllData($conn); // Tidak perlu difilter di update, karena barang sudah terpilih
        $kondisiList = KondisiBarang::getAllData($conn);
        $lapangData = Lapang::getAllData($conn);
        $ruangData = Ruang::getAllData($conn);

        if (!$sarana) {
            $_SESSION['error'] = 'Data sarana mebelair tidak ditemukan.';
            header('Location: /admin/sarana/mebelair'); // Path redirect disesuaikan
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Field spesifik untuk Sarana Mebelair
            $kategori_barang_id = $_POST['kategori_barang_id'];
            $barang_id = $_POST['barang_id'];
            $kondisi_barang_id = $_POST['kondisi_barang_id'];
            // $no_registrasi dari $sarana['no_registrasi'] (tidak diubah saat update, sesuai template)
            $nama_detail_barang = $_POST['nama_detail_barang'];
            $merk = $_POST['merk'] ?? null;
            $spesifikasi = $_POST['spesifikasi'] ?? null;
            $sumber = $_POST['sumber'] ?? null;
            $jumlah = $_POST['jumlah'] ?? 1;
            $satuan = $_POST['satuan'] ?? 'Unit';
            $lokasi = $_POST['lokasi'];
            $bahan = $_POST['bahan'] ?? null;
            $keterangan = $_POST['keterangan'] ?? null;
            $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? $sarana['tanggal_pembelian']; // Ambil dari post atau existing
            $biaya_pembelian = $_POST['biaya_pembelian'] ?? $sarana['biaya_pembelian']; // Ambil dari post atau existing


            try {
                $success = SaranaMebelair::updateData(
                    $conn,
                    $id,
                    $kategori_barang_id,
                    $barang_id,
                    $kondisi_barang_id,
                    $sarana['no_registrasi'], // Nomor registrasi tidak diubah saat update
                    $nama_detail_barang,
                    $merk,
                    $spesifikasi,
                    $sumber,
                    $jumlah,
                    $satuan,
                    $lokasi,
                    $bahan,
                    $keterangan,
                    $biaya_pembelian, // tambahkan jika ada
                    $tanggal_pembelian // tambahkan jika ada
                );

                $message = $success ? 'Data sarana mebelair berhasil diperbarui.' : 'Gagal memperbarui data sarana mebelair.';
                $_SESSION['update'] = $message;

                header('Location: /admin/sarana/mebelair?detail=' . $id); // Path redirect disesuaikan
                exit();
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('update', [
            'sarana' => $sarana,
            'kategoriList' => $kategoriList,
            'barangList' => $barangList, // Kirim semua barang untuk dropdown
            'kondisiList' => $kondisiList,
            "lapangData" => $lapangData,
            "ruangData" => $ruangData,
        ]);
    }

    // Diadaptasi dari template SaranaBergerakController
    private function generateUniqueRegistrationNumber($conn, $barangId, $tanggal_pembelian, $barangList)
    {
        $year = $tanggal_pembelian ? date('Y', strtotime($tanggal_pembelian)) : date('Y');
        $barangCode = 'MBL'; // Kode default untuk Mebelair jika tidak ditemukan

        foreach ($barangList as $barang) {
            if ($barang['id'] == $barangId) {
                $barangCode = $barang['kode_barang']; // Ambil kode barang dari tabel barang
                break;
            }
        }

        do {
            $randomNumber = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
            // Format nomor registrasi disesuaikan untuk Mebelair
            $registrationNumber = "MBL-{$barangCode}-{$year}-{$randomNumber}"; // Prefix MBL untuk Mebelair

            // Cek ke tabel sarana_mebelair
            $stmt = $conn->prepare("SELECT COUNT(*) FROM sarana_mebelair WHERE no_registrasi = ?");
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
            if (SaranaMebelair::deleteData($conn, $id)) {
                $_SESSION['success'] = 'Data sarana mebelair berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus data sarana mebelair.';
            }
            header('Location: /admin/sarana/mebelair'); // Path redirect disesuaikan
            exit();
        }
    }

    public function index()
    {
        global $conn;
        $saranaData = SaranaMebelair::getAllData($conn);
        $this->delete(); // Memanggil fungsi delete jika ada parameter ?delete=id

        $this->renderView('index', [
            'saranaData' => $saranaData,
        ]);
    }

    // --- DOKUMEN LOGIC (Adapted from SaranaBergerakController) ---
    // Asumsi Model DokumenSaranaMebelair memiliki method yang serupa dengan DokumenSaranaBergerak
    // seperti storeDokumenMebelair, getDokumenById, delete, dll.

    public function dokumen($id) // $id adalah ID Sarana Mebelair
    {
        global $conn;
        // Mengambil data Sarana Mebelair untuk konteks, bukan data dokumen itu sendiri
        $mebelairData = SaranaMebelair::getById($conn, $id);
        if (!$mebelairData) {
            $_SESSION['error'] = 'Data Sarana Mebelair tidak ditemukan.';
            header('Location: /admin/sarana/mebelair');
            exit();
        }
        $mebelairDataId = $mebelairData['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $aset_mebelair_id = $_POST['aset_mebelair_id']; // Hidden field di form dengan ID Sarana Mebelair
            $nama_dokumen = $_POST['nama_dokumen'];
            $path_dokumen = '';

            if (!empty($_FILES['path_dokumen']['name'])) {
                // Path storage disesuaikan untuk dokumen mebelair
                $uploadDir = __DIR__ . '/../../storage/dokumen_sarana_mebelair/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $originalName = basename($_FILES['path_dokumen']['name']);
                $sanitizedName = preg_replace("/[^a-zA-Z0-9.\-\_]/", "_", $originalName); // Sanitasi nama file
                $fileName = time() . '_' . $sanitizedName;
                $targetFile = $uploadDir . $fileName;

                if (move_uploaded_file($_FILES['path_dokumen']['tmp_name'], $targetFile)) {
                    $path_dokumen = $fileName;
                } else {
                    $_SESSION['error'] = 'Gagal mengupload file dokumen. Error: ' . $_FILES['path_dokumen']['error'];
                    // Render view create dokumen lagi dengan data mebelair, bukan dokumenData
                    $this->renderView('/Dokumen/create', ['mebelairData' => $mebelairData]);
                    return;
                }
            } else {
                $_SESSION['error'] = 'File dokumen tidak boleh kosong.';
                $this->renderView('/Dokumen/create', ['mebelairData' => $mebelairData]);
                return;
            }

            try {
                // Asumsi DokumenSaranaMebelair::storeDokumenMebelair() sudah ada
                $success = DokumenSaranaMebelair::storeDokumenMebelair(
                    $conn,
                    $aset_mebelair_id,
                    $nama_dokumen,
                    $path_dokumen
                );
                $message = $success ? 'Dokumen sarana mebelair berhasil ditambahkan.' : 'Gagal menambahkan dokumen.';
                $_SESSION['update'] = $message;

                if ($success) {
                    // Redirect ke detail Sarana Mebelair
                    header('Location: /admin/sarana/mebelair?detail=' . $mebelairDataId);
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }
        // Path view untuk form tambah dokumen, kirim data mebelair untuk konteks
        $this->renderView('/Dokumen/create', ['mebelairData' => $mebelairData]);
    }

    public function downloadDokumen($id) // $id adalah ID Dokumen Mebelair
    {
        global $conn;
        // Asumsi DokumenSaranaMebelair::getDokumenById() sudah ada
        $dokumen = DokumenSaranaMebelair::getDokumenById($conn, $id);

        if (!$dokumen || empty($dokumen['path_dokumen'])) {
            $_SESSION['error'] = 'Dokumen tidak ditemukan.';
            // Redirect ke halaman utama mebelair jika dokumen tidak ada
            header('Location: /admin/sarana/mebelair');
            exit();
        }

        // Path storage disesuaikan
        $filePath = __DIR__ . '/../../storage/dokumen_sarana_mebelair/' . $dokumen['path_dokumen'];

        if (!file_exists($filePath)) {
            $_SESSION['error'] = 'File tidak ditemukan di server.';
            header('Location: /admin/sarana/mebelair?detail=' . $dokumen['aset_mebelair_id']); // Kembali ke detail aset
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
            $id = $_GET['delete-dokumen']; // ID Dokumen Mebelair
            // Ambil ID Sarana Mebelair dari dokumen untuk redirect
            $dokumenData = DokumenSaranaMebelair::getDokumenById($conn, $id);
            $aset_mebelair_id = $dokumenData ? $dokumenData['aset_mebelair_id'] : null;


            // Asumsi DokumenSaranaMebelair::delete() sudah ada
            if (DokumenSaranaMebelair::delete($conn, $id)) {
                $_SESSION['success'] = 'Dokumen berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus dokumen.';
            }

            if ($aset_mebelair_id) {
                header('Location: /admin/sarana/mebelair?detail=' . $aset_mebelair_id);
            } else {
                header('Location: /admin/sarana/mebelair'); // Fallback redirect
            }
            exit();
        }
    }

    // --- DOKUMENTASI GAMBAR LOGIC (Adapted from SaranaBergerakController) ---
    // Asumsi Model DokumenSaranaMebelair memiliki method yang serupa
    // seperti storeDokumentasiMebelair, getDokumenGambarById, deleteGambar, dll.

    public function dokumenGambar($id) // $id adalah ID Sarana Mebelair
    {
        global $conn;
        $mebelairData = SaranaMebelair::getById($conn, $id);
        if (!$mebelairData) {
            $_SESSION['error'] = 'Data Sarana Mebelair tidak ditemukan.';
            header('Location: /admin/sarana/mebelair');
            exit();
        }
        $mebelairDataId = $mebelairData['id'];

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $aset_mebelair_id = $_POST['aset_mebelair_id'];
            $nama_dokumen = $_POST['nama_dokumen']; // Atau nama gambar
            $path_dokumen = ''; // Akan menjadi path gambar

            if (!empty($_FILES['path_dokumen']['name'])) {
                // Path storage disesuaikan untuk dokumentasi gambar mebelair
                $uploadDir = __DIR__ . '/../../storage/dokumentasi_sarana_mebelair/';
                if (!is_dir($uploadDir)) {
                    mkdir($uploadDir, 0777, true);
                }

                $originalName = basename($_FILES['path_dokumen']['name']);
                $sanitizedName = preg_replace("/[^a-zA-Z0-9.\-\_]/", "_", $originalName);
                $fileName = time() . '_' . $sanitizedName;
                $targetFile = $uploadDir . $fileName;

                // Validasi tipe file gambar
                $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
                $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                if (!in_array($imageFileType, $allowedTypes)) {
                    $_SESSION['error'] = 'Hanya file gambar (JPG, JPEG, PNG, GIF, WEBP) yang diizinkan.';
                    $this->renderView('/Dokumen/createFoto', ['mebelairData' => $mebelairData]);
                    return;
                }


                if (move_uploaded_file($_FILES['path_dokumen']['tmp_name'], $targetFile)) {
                    $path_dokumen = $fileName;
                } else {
                    $_SESSION['error'] = 'Gagal mengupload file gambar. Error: ' . $_FILES['path_dokumen']['error'];
                    $this->renderView('/Dokumen/createFoto', ['mebelairData' => $mebelairData]);
                    return;
                }
            } else {
                $_SESSION['error'] = 'File gambar tidak boleh kosong.';
                $this->renderView('/Dokumen/createFoto', ['mebelairData' => $mebelairData]);
                return;
            }

            try {
                // Asumsi DokumenSaranaMebelair::storeDokumentasiMebelair() sudah ada
                $success = DokumenSaranaMebelair::storeDokumentasiMebelair(
                    $conn,
                    $aset_mebelair_id,
                    $nama_dokumen,
                    $path_dokumen
                );
                $message = $success ? 'Dokumentasi gambar berhasil ditambahkan.' : 'Gagal menambahkan dokumentasi gambar.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/sarana/mebelair?detail=' . $mebelairDataId);
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }
        // Path view untuk form tambah gambar
        $this->renderView('/Dokumen/createFoto', ['mebelairData' => $mebelairData]);
    }

    public function previewDokumen($id) // $id adalah ID Dokumen Gambar Mebelair
    {
        global $conn;
        // Asumsi DokumenSaranaMebelair::getDokumenGambarById() sudah ada
        $dokumen = DokumenSaranaMebelair::getDokumenGambarById($conn, $id);

        if (!$dokumen || empty($dokumen['path_dokumen'])) {
            header("HTTP/1.0 404 Not Found");
            exit('Dokumen gambar tidak ditemukan.');
        }

        // Path storage disesuaikan
        $filePath = __DIR__ . '/../../storage/dokumentasi_sarana_mebelair/' . $dokumen['path_dokumen'];

        if (!file_exists($filePath)) {
            header("HTTP/1.0 404 Not Found");
            exit('File gambar tidak ditemukan di server.');
        }

        $mimeType = mime_content_type($filePath);
        $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        if (!in_array($mimeType, $allowedMimeTypes)) {
            header("HTTP/1.0 403 Forbidden");
            exit('File bukan gambar yang valid.');
        }

        header('Content-Type: ' . $mimeType);
        header('Content-Length: ' . filesize($filePath));
        ob_clean();
        flush();
        readfile($filePath);
        exit;
    }

    public function deleteDokumentasi()
    {
        if (isset($_GET['delete-gambar']) && is_numeric($_GET['delete-gambar'])) {
            global $conn;
            $id = $_GET['delete-gambar']; // ID Dokumen Gambar Mebelair
            $dokumenData = DokumenSaranaMebelair::getDokumenGambarById($conn, $id);
            $aset_mebelair_id = $dokumenData ? $dokumenData['aset_mebelair_id'] : null;

            // Asumsi DokumenSaranaMebelair::deleteGambar() sudah ada
            if (DokumenSaranaMebelair::deleteGambar($conn, $id)) {
                $_SESSION['success'] = 'Dokumentasi gambar berhasil dihapus.';
            } else {
                $_SESSION['error'] = 'Gagal menghapus dokumentasi gambar.';
            }

            if ($aset_mebelair_id) {
                header('Location: /admin/sarana/mebelair?detail=' . $aset_mebelair_id);
            } else {
                header('Location: /admin/sarana/mebelair'); // Fallback redirect
            }
            exit();
        }
    }

    public function detail($id)
    {
        global $conn;
        $detailData = SaranaMebelair::getById($conn, $id);

        if (!$detailData) {
            $_SESSION['error'] = 'Data sarana mebelair tidak ditemukan.';
            header('Location: /admin/sarana/mebelair');
            exit();
        }

        // Mengambil dokumen dan gambar terkait Sarana Mebelair
        // Asumsi DokumenSaranaMebelair::getAllData() mengambil dokumen non-gambar
        // dan DokumenSaranaMebelair::getAllDataGambar() mengambil dokumen gambar
        $dokumenAsetMebelair = DokumenSaranaMebelair::getAllData($conn, $id);
        $dokumenGambarMebelair = DokumenSaranaMebelair::getAllDataGambar($conn, $id);

        if (!is_array($dokumenAsetMebelair)) {
            $dokumenAsetMebelair = [];
        }
        if (!is_array($dokumenGambarMebelair)) {
            $dokumenGambarMebelair = [];
        }

        // Tidak perlu filter manual lagi jika method model sudah menerima $id aset
        // $filteredDokumen = array_filter($dokumenAsetMebelair, function ($dokumen) use ($detailData) {
        //     return $dokumen['aset_mebelair_id'] == $detailData['id'];
        // });
        // $filteredGambar = array_filter($dokumenGambarMebelair, function ($dokumen) use ($detailData) {
        //     return $dokumen['aset_mebelair_id'] == $detailData['id'];
        // });

        // Panggil method delete terkait jika ada parameter di URL
        $this->delete(); // Untuk menghapus Sarana Mebelair itu sendiri
        $this->deleteDokumen(); // Untuk menghapus dokumen terkait
        $this->deleteDokumentasi(); // Untuk menghapus gambar terkait

        $this->renderView('detail', [
            'detailData' => $detailData,
            'dokumenSaranaMebelair' => $dokumenAsetMebelair, // Data dokumen
            'dokumenGambar' => $dokumenGambarMebelair,     // Data gambar
        ]);
    }

    // download all qr (diadaptasi dari template)
    public function downloadAllQr()
    {
        global $conn;
        $saranaData = SaranaMebelair::getAllData($conn); // Mengambil semua data Mebelair
        $this->renderView('downloadAll', [ // View ini mungkin perlu disesuaikan juga
            'saranaData' => $saranaData,
        ]);
    }
}
