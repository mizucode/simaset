<?php

require_once __DIR__ . '/../Models/DokumenSaranaBergerak.php';
require_once __DIR__ . '/../Models/BaseUrlQr.php';

class SaranaBergerakController {
  private function renderView(string $view, $data = []) {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/BarangBergerak/{$view}.php";
  }

  public function create() {
    global $conn;
    $saranaData = SaranaBergerak::getAllData($conn);
    $kategoriList = KategoriBarang::getAllData($conn);
    $barangList = Barang::getAllData($conn);
    $kondisiList = KondisiBarang::getAllData($conn);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    $filteredBarangList = array_filter($barangList, function ($barang) {
      return $barang['kategori_id'] == 1;
    });

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $kategori_barang_id = $_POST['kategori_barang_id'];
      $barang_id = $_POST['barang_id'];
      $kondisi_barang_id = $_POST['kondisi_barang_id'];
      $nama_detail_barang = $_POST['nama_detail_barang'];
      $merk = $_POST['merk'] ?? null;
      $spesifikasi = $_POST['spesifikasi'] ?? null;
      $no_polisi = $_POST['no_polisi'] ?? null;
      $sumber = $_POST['sumber'] ?? null;
      $lokasi = $_POST['lokasi'];
      $keterangan = $_POST['keterangan'] ?? null;
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;
      $status = $_POST['status'] ?? 'Tersedia'; // Ambil status dari POST, default 'Tersedia' jika tidak ada

      $no_registrasi = $this->generateUniqueRegistrationNumber(
        $conn,
        $barang_id,
        $tanggal_pembelian,
        $barangList
      );

      try {
        $success = SaranaBergerak::storeData(
          $conn,
          $kategori_barang_id,
          $barang_id,
          $kondisi_barang_id,
          $no_registrasi,
          $nama_detail_barang,
          $merk,
          $spesifikasi,
          $no_polisi,
          $sumber,
          $lokasi,
          $keterangan,
          $biaya_pembelian,
          $tanggal_pembelian,
          $status // Tambahkan status ke pemanggilan storeData
        );

        $message = $success ? 'Data sarana bergerak berhasil ditambahkan.' : 'Gagal menambahkan data sarana bergerak.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/sarana/bergerak');
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
      "lapangData" => $lapangData,
      "ruangData" => $ruangData,
    ]);
  }

  public function update($id) {
    global $conn;
    $sarana = SaranaBergerak::getById($conn, $id);
    $kategoriList = KategoriBarang::getAllData($conn);
    $barangList = Barang::getAllData($conn);
    $kondisiList = KondisiBarang::getAllData($conn);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if (!$sarana) {
      $_SESSION['error'] = 'Data sarana bergerak tidak ditemukan.';
      header('Location: /admin/sarana/bergerak');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $kategori_barang_id = $_POST['kategori_barang_id'];
      $barang_id = $_POST['barang_id'];
      $kondisi_barang_id = $_POST['kondisi_barang_id'];
      $nama_detail_barang = $_POST['nama_detail_barang'];
      $merk = $_POST['merk'] ?? null;
      $spesifikasi = $_POST['spesifikasi'] ?? null;
      $no_polisi = $_POST['no_polisi'] ?? null;
      $sumber = $_POST['sumber'] ?? null;
      $lokasi = $_POST['lokasi'];
      $keterangan = $_POST['keterangan'] ?? null;
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;
      $status = $_POST['status'] ?? $sarana['status']; // Ambil status dari POST atau dari data sarana yang ada

      try {
        $success = SaranaBergerak::updateData(
          $conn,
          $id,
          $kategori_barang_id,
          $barang_id,
          $kondisi_barang_id,
          $sarana['no_registrasi'], // Keep existing registration number
          $nama_detail_barang,
          $merk,
          $spesifikasi,
          $no_polisi,
          $sumber,
          $lokasi,
          $keterangan,
          $biaya_pembelian,
          $tanggal_pembelian,
          $status, // Tambahkan status ke pemanggilan updateData
          $sarana['nama_peminjam'], // Pastikan parameter ini ada jika diperlukan oleh model
          $sarana['identitas_peminjam'], // Pastikan parameter ini ada jika diperlukan oleh model
          $sarana['no_hp_peminjam'] // Pastikan parameter ini ada jika diperlukan oleh model
        );

        $message = $success ? 'Data sarana bergerak berhasil diperbarui.' : 'Gagal memperbarui data sarana bergerak.';
        $_SESSION['update'] = $message;

        header('Location: /admin/sarana/bergerak?detail=' . $id);
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
      "lapangData" => $lapangData,
      "ruangData" => $ruangData,
    ]);
  }

  private function generateUniqueRegistrationNumber($conn, $barangId, $tanggal_pembelian, $barangList) {
    $year = $tanggal_pembelian ? date('Y', strtotime($tanggal_pembelian)) : date('Y');
    $barangCode = 'BGR';

    foreach ($barangList as $barang) {
      if ($barang['id'] == $barangId) {
        $barangCode = $barang['kode_barang'];
        break;
      }
    }

    do {
      $randomNumber = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
      $registrationNumber = "BGR-{$barangCode}-{$year}-{$randomNumber}";

      $stmt = $conn->prepare("SELECT COUNT(*) FROM sarana_bergerak WHERE no_registrasi = ?");
      $stmt->execute([$registrationNumber]);
      $exists = $stmt->fetchColumn() > 0;
    } while ($exists);

    return $registrationNumber;
  }

  public function delete() {
    if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
      global $conn;
      $id = $_GET['delete'];
      if (SaranaBergerak::deleteData($conn, $id)) {
        $_SESSION['success'] = 'Data sarana bergerak berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data sarana bergerak.';
      }
      header('Location: /admin/sarana/bergerak');
      exit();
    }
  }

  public function index() {
    global $conn;
    $saranaData = SaranaBergerak::getAllData($conn);
    $this->delete();

    $this->renderView('index', [
      'saranaData' => $saranaData,
    ]);
  }


  // dokumen

  public function dokumen($id) {
    global $conn;
    $dokumenData = SaranaBergerak::getById($conn, $id);
    $dokumenDataId = SaranaBergerak::getById($conn, $id)['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $aset_bergerak_id = $_POST['aset_bergerak_id'];
      $nama_dokumen = $_POST['nama_dokumen'];
      $path_dokumen = '';

      if (!empty($_FILES['path_dokumen']['name'])) {
        $uploadDir = __DIR__ . '/../../storage/dokumen_sarana_bergerak/';
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
            'dokumenData' => $dokumenData,
          ]);
          return;
        }
      }

      try {
        $success = DokumenSaranaBergerak::storeDokumenBergerak(
          $conn,
          $aset_bergerak_id,
          $nama_dokumen,
          $path_dokumen, // Now this contains the filename if upload was successful
        );
        $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/sarana/bergerak?detail=' . $dokumenDataId);
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

  public function downloadDokumen($id) {
    global $conn;

    // 1. Ambil data dokumen dari database
    $dokumen = DokumenSaranaBergerak::getDokumenById($conn, $id);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      $_SESSION['error'] = 'Dokumen tidak ditemukan.';
      header('Location: /admin/sarana/bergerak');
      exit();
    }

    // 2. Tentukan path file
    $filePath = __DIR__ . '/../../storage/dokumen_sarana_bergerak/' . $dokumen['path_dokumen'];

    // 3. Validasi file
    if (!file_exists($filePath)) {
      $_SESSION['error'] = 'File tidak ditemukan di server.';
      header('Location: /admin/sarana/bergerak');
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

  public function deleteDokumen() {
    if (isset($_GET['delete-dokumen']) && is_numeric($_GET['delete-dokumen'])) {
      global $conn;
      $id = $_GET['delete-dokumen'];
      $aset_bergerak_id = DokumenSaranaBergerak::getDokumenById($conn, $id)['aset_bergerak_id'];

      if (DokumenSaranaBergerak::delete($conn, $id)) {
        $_SESSION['success'] = 'Data berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data.';
      }


      header('Location: /admin/sarana/bergerak?detail=' . $aset_bergerak_id);
      exit();
    }
  }

  // dokumen gambar
  public function dokumenGambar($id) {
    global $conn;
    $bergerakData = SaranaBergerak::getById($conn, $id);
    $bergerakDataId = SaranaBergerak::getById($conn, $id)['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $aset_tanah_id = $_POST['aset_bergerak_id'];
      $nama_dokumen = $_POST['nama_dokumen'];
      $path_dokumen = '';

      if (!empty($_FILES['path_dokumen']['name'])) {
        $uploadDir = __DIR__ . '/../../storage/dokumentasi_sarana_bergerak/';
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
            'bergerakDataId' => $bergerakDataId,
          ]);
          return;
        }
      }

      try {
        $success = DokumenSaranaBergerak::storeDokumentasiBergerak(
          $conn,
          $aset_tanah_id,
          $nama_dokumen,
          $path_dokumen, // Now this contains the filename if upload was successful
        );
        $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/sarana/bergerak?detail=' . $bergerakDataId);
          exit();
        }
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database: ' . $e->getMessage();
      }
    }

    $this->renderView('/Dokumen/createFoto', [  // Fixed typo in view path (changed from '/Doumen/create')
      'bergerakData' => $bergerakData,
    ]);
  }
  public function previewDokumen($id) {
    global $conn;

    // Ambil data dokumen dari database
    $dokumen = DokumenSaranaBergerak::getDokumenGambarById($conn, $id);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      header("HTTP/1.0 404 Not Found");
      exit();
    }

    $filePath = __DIR__ . '/../../storage/dokumentasi_sarana_bergerak/' . $dokumen['path_dokumen'];

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
  public function deleteDokumentasi() {
    if (isset($_GET['delete-gambar']) && is_numeric($_GET['delete-gambar'])) {
      global $conn;
      $id = $_GET['delete-gambar'];
      $aset_bergerak_id = DokumenSaranaBergerak::getDokumenGambarById($conn, $id)['aset_bergerak_id'];

      if (DokumenSaranaBergerak::deleteGambar($conn, $id)) {
        $_SESSION['success'] = 'Data berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data.';
      }


      header('Location: /admin/sarana/bergerak?detail=' . $aset_bergerak_id);
      exit();
    }
  }

  public function detail($id) {
    global $conn;
    $detailData = SaranaBergerak::getById($conn, $id);
    $dokumenAsetGedung = DokumenSaranaBergerak::getAllData($conn, $id);
    $dokumenGambarGedung = DokumenSaranaBergerak::getAllDataGambar($conn, $id);
    $BaseUrlQr = BaseUrlQr::BaseUrlQr();

    if (!is_array($dokumenAsetGedung)) {
      $dokumenAsetGedung = [];
    }
    if (!is_array($dokumenGambarGedung)) {
      $dokumenGambarGedung = [];
    }

    $filteredDokumen = array_filter($dokumenAsetGedung, function ($dokumen) use ($detailData) {
      return $dokumen['aset_bergerak_id'] == $detailData['id'];
    });

    $filteredGambar = array_filter($dokumenGambarGedung, function ($dokumen) use ($detailData) {
      return $dokumen['aset_bergerak_id'] == $detailData['id'];
    });



    $this->delete();
    $this->deleteDokumentasi();
    $this->deleteDokumen();

    $this->renderView('detail', [
      'detailData' => $detailData,
      'dokumenSaranaBergerak' => $filteredDokumen,
      'dokumenGambar' => $filteredGambar,
      'BaseUrlQr' => $BaseUrlQr,
    ]);
  }

  // download all qr
  public function downloadAllQr() {
    global $conn;
    $saranaData = SaranaBergerak::getAllData($conn);
    $BaseUrlQr = BaseUrlQr::BaseUrlQr();

    $this->renderView('downloadAll', [
      'saranaData' => $saranaData,
      'BaseUrlQr' => $BaseUrlQr,
    ]);
  }
}
