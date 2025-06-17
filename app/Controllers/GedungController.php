<?php
require_once __DIR__ . '/../Models/Gedung.php';
require_once __DIR__ . '/../Models/Ruang.php';
require_once __DIR__ . '/../Models/JenisAset.php';
require_once __DIR__ . '/../Models/DokumenAsetGedung.php';
require_once __DIR__ . '/../Models/BaseUrlQr.php';

class GedungController
{
  private function renderView(string $view, $data = [])
  {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Gedung/{$view}.php";
  }

  private function generateUniqueKodeGedung($conn, $tahun_dibangun)
  {
    $year = $tahun_dibangun ? date('Y', strtotime($tahun_dibangun)) : date('Y');
    $prefix = "PRS-BNG";

    do {
      // Generate 4 digit random number
      $randomNumber = str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT);
      $kode_gedung = "{$prefix}-{$year}-{$randomNumber}";

      // Check for uniqueness in the database
      $stmt = $conn->prepare("SELECT COUNT(*) FROM aset_gedung WHERE kode_gedung = ?");
      $stmt->execute([$kode_gedung]);
      $exists = $stmt->fetchColumn() > 0;
    } while ($exists);

    return $kode_gedung;
  }

  public function create()
  {
    global $conn;
    $gedungData = Gedung::getAllData($conn);
    $jenis_aset_id = JenisAset::GetAllData($conn);
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $nama_gedung = $_POST['nama_gedung'];
      $jenis_aset_id = $_POST['jenis_aset_id'];
      $luas = $_POST['luas'];
      $jumlah_lantai = $_POST['jumlah_lantai'];
      $kontruksi = $_POST['kontruksi'];
      $lokasi = $_POST['lokasi'];
      $kondisi = $_POST['kondisi'];
      $unit_kepemilikan = $_POST['unit_kepemilikan'];
      $fungsi = $_POST['fungsi'];
      $tahun_dibangun = $_POST['tahun_dibangun'] ?? null;
      $jenis_bangunan = $_POST['jenis_bangunan'] ?? null;
      $keterangan = $_POST['keterangan'] ?? null;

      $kode_gedung = $this->generateUniqueKodeGedung($conn, $tahun_dibangun);

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
          $fungsi,
          $tahun_dibangun,
          $jenis_bangunan,
          $keterangan
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
      $tahun_dibangun = $_POST['tahun_dibangun'] ?? $gedung['tahun_dibangun'] ?? null;
      $jenis_bangunan = $_POST['jenis_bangunan'] ?? $gedung['jenis_bangunan'] ?? null;
      $keterangan = $_POST['keterangan'] ?? $gedung['keterangan'] ?? null;

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
          $fungsi,
          $tahun_dibangun,
          $jenis_bangunan,
          $keterangan
        );

        $message = $success ? 'Data gedung berhasil diperbarui.' : 'Gagal memperbarui data gedung.';
        $_SESSION['update'] = $message;

        header('Location: /admin/prasarana/gedung?detail=' . $id);
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

  public function delete()
  {
    if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
      global $conn;
      $id = $_GET['delete'];
      if (Gedung::deleteData($conn, $id)) {
        $_SESSION['success'] = 'Data berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data.';
      }
      header('Location: /admin/prasarana/gedung');
      exit();
    }
  }

  public function gedung()
  {
    global $conn;
    // Model Gedung::getAllData tidak menerima parameter filter.
    // Filtering dilakukan di sisi client (JavaScript DataTable).
    $gedungData = Gedung::getAllData($conn);

    // Data untuk filter Jenis Aset di view
    $jenisAsetList = JenisAset::GetAllData($conn);

    // Data untuk filter Jenis Bangunan di view
    $jenisBangunanList = [];
    if (!empty($gedungData)) {
      $allJenisBangunan = array_column($gedungData, 'jenis_bangunan');
      // Filter out null or empty strings before getting unique values
      $allJenisBangunan = array_filter($allJenisBangunan, function ($value) {
        return !is_null($value) && $value !== '';
      });
      $jenisBangunanList = array_unique($allJenisBangunan);
      sort($jenisBangunanList); // Optional: sort the list
    }

    $this->delete();
    $this->renderView('index', [
      'gedungData' => $gedungData,
      'jenisAsetList' => $jenisAsetList, // For the filter dropdown
      'jenisBangunanList' => $jenisBangunanList, // For the Jenis Bangunan filter dropdown
    ]);
  }




  // dokumen

  public function dokumen($id)
  {
    global $conn;
    $dokumenData = Gedung::getById($conn, $id);
    $dokumenDataId = Gedung::getById($conn, $id)['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $aset_gedung_id = $_POST['aset_gedung_id'];
      $nama_dokumen = $_POST['nama_dokumen'];
      $path_dokumen = '';

      if (!empty($_FILES['path_dokumen']['name'])) {
        $uploadDir = __DIR__ . '/../../storage/dokumen_gedung/';
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
        $success = DokumenAsetGedung::storeDokumenGedung(
          $conn,
          $aset_gedung_id,
          $nama_dokumen,
          $path_dokumen, // Now this contains the filename if upload was successful
        );
        $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/prasarana/gedung?detail=' . $dokumenDataId);
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

    // 1. Ambil data dokumen dari database
    $dokumen = DokumenAsetGedung::getDokumenById($conn, $id);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      $_SESSION['error'] = 'Dokumen tidak ditemukan.';
      header('Location: /admin/prasarana/gedung');
      exit();
    }

    // 2. Tentukan path file
    $filePath = __DIR__ . '/../../storage/dokumen_gedung/' . $dokumen['path_dokumen'];

    // 3. Validasi file
    if (!file_exists($filePath)) {
      $_SESSION['error'] = 'File tidak ditemukan di server.';
      header('Location: /admin/prasarana/gedung');
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

  public function deleteDokumen()
  {
    if (isset($_GET['delete-dokumen']) && is_numeric($_GET['delete-dokumen'])) {
      global $conn;
      $id = $_GET['delete-dokumen'];
      $aset_gedung_id = DokumenAsetGedung::getDokumenById($conn, $id)['aset_gedung_id'];

      if (DokumenAsetGedung::delete($conn, $id)) {
        $_SESSION['success'] = 'Data berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data.';
      }


      header('Location: /admin/prasarana/gedung?detail=' . $aset_gedung_id);
      exit();
    }
  }

  // dokumen gambar
  public function dokumenGambar($id)
  {
    global $conn;
    $gedungData = Gedung::getById($conn, $id);
    $gedungDataId = Gedung::getById($conn, $id)['id'];

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $aset_gedung_id = $_POST['aset_gedung_id'];
      $nama_dokumen = $_POST['nama_dokumen'];
      $path_dokumen = '';

      if (!empty($_FILES['path_dokumen']['name'])) {
        $uploadDir = __DIR__ . '/../../storage/dokumentasi_gedung/';
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
            'gedungData' => $gedungData,
          ]);
          return;
        }
      }

      try {
        $success = DokumenAsetGedung::storeDokumentasiGedung(
          $conn,
          $aset_gedung_id,
          $nama_dokumen,
          $path_dokumen, // Now this contains the filename if upload was successful
        );
        $message = $success ? 'Data berhasil ditambahkan.' : 'Gagal menambahkan data.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/prasarana/gedung?detail=' . $gedungDataId);
          exit();
        }
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database: ' . $e->getMessage();
      }
    }

    $this->renderView('/Dokumen/createFoto', [  // Fixed typo in view path (changed from '/Doumen/create')
      'gedungData' => $gedungData,
    ]);
  }
  public function previewDokumen($id)
  {
    global $conn;

    // Ambil data dokumen dari database
    $dokumen = DokumenAsetGedung::getDokumenGambarById($conn, $id);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      header("HTTP/1.0 404 Not Found");
      exit();
    }

    $filePath = __DIR__ . '/../../storage/dokumentasi_gedung/' . $dokumen['path_dokumen'];

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
  public function deleteDokumentasi()
  {
    if (isset($_GET['delete-gambar']) && is_numeric($_GET['delete-gambar'])) {
      global $conn;
      $id = $_GET['delete-gambar'];
      $aset_gedung_id = DokumenAsetGedung::getDokumenGambarById($conn, $id)['aset_gedung_id'];

      if (DokumenAsetGedung::deleteGambar($conn, $id)) {
        $_SESSION['success'] = 'Data berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data.';
      }


      header('Location: /admin/prasarana/gedung?detail=' . $aset_gedung_id);
      exit();
    }
  }


  // Detail
  public function detail($id)
  {
    global $conn;
    $BaseUrlQr = BaseUrlQr::BaseUrlQr();

    $detailData = Gedung::getById($conn, $id);
    $ruangList = Ruang::getAllData($conn);
    // Mengambil dokumen dan gambar khusus untuk gedung ini
    // Pastikan $detailData['id'] adalah ID yang benar untuk aset_gedung_id
    $dokumenAsetGedung = $detailData ? DokumenAsetGedung::getAllData($conn, $detailData['id']) : [];
    $dokumenGambarGedung = $detailData ? DokumenAsetGedung::getAllDataGambar($conn, $detailData['id']) : [];

    $dokumenAsetGedung = is_array($dokumenAsetGedung) ? $dokumenAsetGedung : [];
    $dokumenGambarGedung = is_array($dokumenGambarGedung) ? $dokumenGambarGedung : [];

    // Filter barang berdasarkan lokasi ruangan yang sedang dilihat
    $filteredRuangList = array_filter($ruangList, function ($ruang) use ($detailData) {
      return $ruang['gedung_id'] == $detailData['id'];
    });

    $this->delete();
    $this->deleteDokumen();
    $this->deleteDokumentasi();

    $this->renderView('detail', [
      'detailData' => $detailData,
      'filteredRuangList' => $filteredRuangList,
      'dokumenAsetGedung' => $dokumenAsetGedung,
      'dokumenGambar' => $dokumenGambarGedung,
      'BaseUrlQr' => $BaseUrlQr,
    ]);
  }
}
