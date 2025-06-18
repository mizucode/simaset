<?php
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/JenisAset.php';
require_once __DIR__ . '/../Models/SaranaBergerak.php';
require_once __DIR__ . '/../Models/SaranaMebelair.php';
require_once __DIR__ . '/../Models/SaranaATK.php';
require_once __DIR__ . '/../Models/SaranaElektronik.php';
require_once __DIR__ . '/../Models/DokumenAsetLapang.php';
require_once __DIR__ . '/../Models/BaseUrlQr.php';

class LapangController
{
  private function renderView(string $view, $data = [])
  {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Lapang/{$view}.php";
  }

  private function generateUniqueKodeLapang($conn)
  {
    $prefix = "PRS-LPG";

    do {
      // Generate 4 digit random number
      $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
      $kode_lapang = "{$prefix}-{$randomNumber}";

      // Check for uniqueness in the database
      $stmt = $conn->prepare("SELECT COUNT(*) FROM aset_lapang WHERE kode_lapang = ?");
      $stmt->execute([$kode_lapang]);
      $exists = $stmt->fetchColumn() > 0;
    } while ($exists);

    return $kode_lapang;
  }
  public function create()
  {
    global $conn;
    $lapangData = Lapang::getAllData($conn);
    $jenisAsetList = JenisAset::getAllData($conn);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $jenis_aset_id = $_POST['jenis_aset_id'];
      $nama_lapang = $_POST['nama_lapang'];
      $luas = $_POST['luas'] ?? null;
      $kategori = $_POST['kategori'] ?? null;
      $fungsi = $_POST['fungsi'];
      $lokasi = $_POST['lokasi'];
      $status = $_POST['status'];
      $kondisi = $_POST['kondisi'];
      $keterangan = !empty(trim($_POST['keterangan'])) ? trim($_POST['keterangan']) : null;

      $kode_lapang = $this->generateUniqueKodeLapang($conn);

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
        'kode_lapang' => $lapang['kode_lapang'], // Kode lapang tidak diubah saat update
        'nama_lapang' => $_POST['nama_lapang'],
        'luas' => $_POST['luas'] ?? null,
        'kategori' => $_POST['kategori'] ?? null,
        'fungsi' => $_POST['fungsi'],
        'lokasi' => $_POST['lokasi'],
        'status' => $_POST['status'],
        'kondisi' => $_POST['kondisi'],
        'keterangan' => !empty(trim($_POST['keterangan'])) ? trim($_POST['keterangan']) : null
      ];

      try {
        $success = Lapang::updateData(
          $conn,
          $id,
          $input['jenis_aset_id'],
          $input['kode_lapang'], // Pastikan parameter ini ada di model updateData
          $input['nama_lapang'],
          $input['luas'],
          $input['kategori'],
          $input['fungsi'],
          $input['lokasi'],
          $input['status'],
          $input['kondisi'],
          $input['keterangan']
        );

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


  public function delete()
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
    $kategoriListForFilter = [];
    // Status list is usually predefined, so we might not need to extract it from data
    // unless it's dynamic. For this example, let's assume predefined statuses.

    if (!empty($lapangData)) {
      // Get unique 'kategori' for filter
      $allKategori = array_column($lapangData, 'kategori');
      $allKategori = array_filter($allKategori, function ($value) {
        return !is_null($value) && $value !== '';
      });
      $kategoriListForFilter = array_unique($allKategori);
      sort($kategoriListForFilter);
    }

    $this->delete();

    $this->renderView('index', [
      'lapangData' => $lapangData,
      'kategoriListForFilter' => $kategoriListForFilter,
      // 'statusListForFilter' => $statusListForFilter, // If status were dynamic
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

  public function previewFileDokumen($id_dokumen)
  {
    global $conn;

    // 1. Ambil data dokumen dari database
    $dokumen = DokumenAsetLapang::getDokumenById($conn, $id_dokumen);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      $_SESSION['error'] = 'Dokumen tidak ditemukan untuk pratinjau.';
      // Redirect ke halaman detail Lapang jika ID aset tersedia, jika tidak ke halaman list Lapang
      $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/admin/prasarana/lapang';
      if (isset($dokumen['aset_lapang_id'])) {
        $redirect_url = '/admin/prasarana/lapang?detail=' . $dokumen['aset_lapang_id'];
      }
      header('Location: ' . $redirect_url);
      exit();
    }

    // 2. Tentukan path file
    $filePath = __DIR__ . '/../../storage/dokumen_lapang/' . $dokumen['path_dokumen'];

    // 3. Validasi file
    if (!file_exists($filePath)) {
      $_SESSION['error'] = 'File tidak ditemukan di server.';
      $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/admin/prasarana/lapang?detail=' . ($dokumen['aset_lapang_id'] ?? '');
      header('Location: ' . $redirect_url);
      exit();
    }

    // 4. Set headers untuk pratinjau (inline)
    header('Content-Type: ' . mime_content_type($filePath)); // Dinamis berdasarkan tipe file
    header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
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
    $dokumenAsetLapang = DokumenAsetLapang::getAllData($conn); // Model doesn't filter by ID here
    $dokumenGambarLapang = DokumenAsetLapang::getAllDataGambar($conn); // Model doesn't filter by ID here

    $BaseUrlQr = BaseUrlQr::BaseUrlQr();


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
      'BaseUrlQr' => $BaseUrlQr,
    ]);
  }
}
