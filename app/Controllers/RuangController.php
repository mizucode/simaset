<?php
require_once __DIR__ . '/../Models/Ruang.php';
require_once __DIR__ . '/../Models/Gedung.php';
require_once __DIR__ . '/../Models/SaranaBergerak.php';
require_once __DIR__ . '/../Models/SaranaBergerak.php';
require_once __DIR__ . '/../Models/DokumenAsetRuang.php';
require_once __DIR__ . '/../Models/DokumenAsetLapang.php';

class RuangController {
  private function renderView(string $view, $data = []) {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Ruang/{$view}.php";
  }

  public function create() {
    global $conn;
    $ruangData = Ruang::getAllData($conn);
    $gedungList = Gedung::getAllData($conn);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $gedung_id = $_POST['gedung_id'];
      $kode_ruang = $_POST['kode_ruang'];
      $jenis_ruangan = $_POST['jenis_ruangan'];
      $nama_ruang = $_POST['nama_ruang'];
      $kapasitas = $_POST['kapasitas'] ?? null;
      $lantai = $_POST['lantai'];
      $luas = $_POST['luas'] ?? null;
      $status = $_POST['status'];
      $fungsi = $_POST['fungsi'];
      $kondisi_ruang = $_POST['kondisi_ruang'];
      $keterangan = $_POST['keterangan'] ?? null;

      try {
        $success = Ruang::storeData(
          $conn,
          $gedung_id,
          $kode_ruang,
          $jenis_ruangan,
          $nama_ruang,
          $kapasitas,
          $lantai,
          $luas,
          $status,
          $fungsi,
          $kondisi_ruang,
          $keterangan
        );

        $message = $success ? 'Data ruang berhasil ditambahkan.' : 'Gagal menambahkan data ruang.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/prasarana/ruang');
          exit();
        }
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database: ' . $e->getMessage();
      }
    }

    $this->renderView('create', [
      'ruangData' => $ruangData,
      'gedungList' => $gedungList
    ]);
  }

  public function update($id) {
    global $conn;
    $ruang = Ruang::getById($conn, $id);
    $gedungList = Gedung::getAllData($conn);

    if (!$ruang) {
      $_SESSION['error'] = 'Data ruang tidak ditemukan.';
      header('Location: /admin/prasarana/ruang');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $gedung_id = $_POST['gedung_id'];
      $jenis_ruangan = $_POST['jenis_ruangan'];
      $kode_ruang = $_POST['kode_ruang'];
      $nama_ruang = $_POST['nama_ruang'];
      $kapasitas = $_POST['kapasitas'] ?? null;
      $lantai = $_POST['lantai'];
      $luas = $_POST['luas'] ?? null;
      $status = $_POST['status'];
      $fungsi = $_POST['fungsi'];
      $kondisi_ruang = $_POST['kondisi_ruang'];
      $keterangan = $_POST['keterangan'] ?? null;

      try {
        $success = Ruang::updateData(
          $conn,
          $id,
          $gedung_id,
          $jenis_ruangan,
          $kode_ruang,
          $nama_ruang,
          $kapasitas,
          $lantai,
          $luas,
          $status,
          $fungsi,
          $kondisi_ruang,
          $keterangan
        );

        $message = $success ? 'Data ruang berhasil diperbarui.' : 'Gagal memperbarui data ruang.';
        $_SESSION['update'] = $message;

        header('Location: /admin/prasarana/ruang?detail=' . $id);
        exit();
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database: ' . $e->getMessage();
      }
    }

    $this->renderView('update', [
      'ruang' => $ruang,
      'gedungList' => $gedungList
    ]);
  }

  private function delete() {
    if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
      global $conn;
      $id = $_GET['delete'];
      if (Ruang::deleteData($conn, $id)) {
        $_SESSION['success'] = 'Data ruang berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data ruang.';
      }
      header('Location: /admin/prasarana/ruang');
      exit();
    }
  }

  public function ruang() {
    global $conn;
    $ruangData = Ruang::getAllData($conn);

    $this->delete();

    $this->renderView('index', [
      'ruangData' => $ruangData,
    ]);
  }
  // dokumen

  public function dokumen($id) {
    global $conn;
    $dokumenData = Ruang::getById($conn, $id);
    $dokumenDataId = Ruang::getById($conn, $id)['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $aset_ruang_id = $_POST['aset_ruang_id'];
      $nama_dokumen = $_POST['nama_dokumen'];
      $path_dokumen = '';

      if (!empty($_FILES['path_dokumen']['name'])) {
        $uploadDir = __DIR__ . '/../../storage/dokumen_ruang/';
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
          $_SESSION['error'] = 'Gagal mengupload file dokumen.';
          $this->renderView('create', [
            'dokumenData' => $dokumenData,
          ]);
          return;
        }
      }

      try {
        $success = DokumenAsetRuang::storeDokumenRuang(
          $conn,
          $aset_ruang_id,
          $nama_dokumen,
          $path_dokumen,
        );
        $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/prasarana/ruang?detail=' . $dokumenDataId);
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
    $dokumen = DokumenAsetRuang::getDokumenById($conn, $id);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      $_SESSION['error'] = 'Dokumen tidak ditemukan.';
      header('Location: /admin/prasarana/ruang');
      exit();
    }

    // 2. Tentukan path file
    $filePath = __DIR__ . '/../../storage/dokumen_ruang/' . $dokumen['path_dokumen'];

    // 3. Validasi file
    if (!file_exists($filePath)) {
      $_SESSION['error'] = 'File tidak ditemukan di server.';
      header('Location: /admin/prasarana/ruang');
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
      $aset_ruang_id = DokumenAsetRuang::getDokumenById($conn, $id)['aset_ruang_id'];

      if (DokumenAsetRuang::delete($conn, $id)) {
        $_SESSION['success'] = 'Data berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data.';
      }

      header('Location: /admin/prasarana/ruang?detail=' . $aset_ruang_id);
      exit();
    }
  }

  // dokumen gambar
  public function dokumenGambar($id) {
    global $conn;
    $ruangData = Ruang::getById($conn, $id);
    $ruangDataId = Ruang::getById($conn, $id)['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $aset_ruang_id = $_POST['aset_ruang_id'];
      $nama_dokumen = $_POST['nama_dokumen'];
      $path_dokumen = '';

      if (!empty($_FILES['path_dokumen']['name'])) {
        $uploadDir = __DIR__ . '/../../storage/dokumentasi_ruang/';
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
          $_SESSION['error'] = 'Gagal mengupload file gambar.';
          $this->renderView('create', [
            'ruangData' => $ruangData,
          ]);
          return;
        }
      }

      try {
        $success = DokumenAsetRuang::storeDokumentasiRuang(
          $conn,
          $aset_ruang_id,
          $nama_dokumen,
          $path_dokumen,
        );
        $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/prasarana/ruang?detail=' . $ruangDataId);
          exit();
        }
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database: ' . $e->getMessage();
      }
    }

    $this->renderView('/Dokumen/createFoto', [
      'ruangData' => $ruangData,
    ]);
  }

  public function previewDokumen($id) {
    global $conn;

    // Ambil data dokumen dari database
    $dokumen = DokumenAsetRuang::getDokumenGambarById($conn, $id);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      header("HTTP/1.0 404 Not Found");
      exit();
    }

    $filePath = __DIR__ . '/../../storage/dokumentasi_ruang/' . $dokumen['path_dokumen'];

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
      $aset_ruang_id = DokumenAsetRuang::getDokumenGambarById($conn, $id)['aset_ruang_id'];

      if (DokumenAsetRuang::deleteGambar($conn, $id)) {
        $_SESSION['success'] = 'Data berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data.';
      }

      header('Location: /admin/prasarana/ruang?detail=' . $aset_ruang_id);
      exit();
    }
  }


  public function detail($id) {
    global $conn;

    $detailData = Ruang::getById($conn, $id);
    $barangList = SaranaBergerak::getAllData($conn);
    $barangMebel = SaranaMebelair::getAllData($conn);
    $barangATK = SaranaATK::getAllData($conn);
    $barangElektronik = SaranaElektronik::getAllData($conn);
    $dokumenAsetRuang = DokumenAsetRuang::getAllData($conn, $id);
    $dokumenGambarRuang = DokumenAsetRuang::getAllDataGambar($conn, $id);

    if (!is_array($dokumenAsetRuang)) {
      $dokumenAsetRuang = [];
    }
    if (!is_array($dokumenGambarRuang)) {
      $dokumenGambarRuang = [];
    }

    $filteredDokumen = array_filter($dokumenAsetRuang, function ($dokumen) use ($detailData) {
      return $dokumen['aset_ruang_id'] == $detailData['id'];
    });

    $filteredGambar = array_filter($dokumenGambarRuang, function ($dokumen) use ($detailData) {
      return $dokumen['aset_ruang_id'] == $detailData['id'];
    });

    // Gabungkan kedua array barang
    $semuaBarang = array_merge($barangList, $barangMebel, $barangATK, $barangElektronik);

    // Filter barang berdasarkan lokasi ruangan yang sedang dilihat
    $filteredBarangList = array_filter($semuaBarang, function ($barang) use ($detailData) {
      return $barang['lokasi'] == $detailData['nama_ruang'];
    });

    $this->delete();
    $this->deleteDokumen();
    $this->deleteDokumentasi();
    $this->renderView('detail', [
      'detailData' => $detailData,
      'filteredBarangList' => $filteredBarangList,
      'dokumenAsetRuang' => $filteredDokumen,
      'dokumenGambar' => $filteredGambar,
    ]);
  }
}
