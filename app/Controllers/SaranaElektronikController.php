<?php

// Pastikan path ini benar dan file model ada
require_once __DIR__ . '/../Models/SaranaElektronik.php';
require_once __DIR__ . '/../Models/DokumenSaranaElektronik.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/Ruang.php';

class SaranaElektronikController {
  private function renderView(string $view, $data = []) {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/BarangElektronik/{$view}.php";
  }

  public function create() {
    global $conn;
    $kategoriList = KategoriBarang::getAllData($conn);
    $barangList = Barang::getAllData($conn);
    $kondisiList = KondisiBarang::getAllData($conn);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    $filteredBarangList = array_filter($barangList, function ($barang) {
      return $barang['kategori_id'] == 4; // ID kategori elektronik
    });

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $kategori_barang_id = $_POST['kategori_barang_id'];
      $barang_id = $_POST['barang_id'];
      $kondisi_barang_id = $_POST['kondisi_barang_id'];
      $nama_detail_barang = $_POST['nama_detail_barang'];
      $merk = $_POST['merk'] ?? null;
      $spesifikasi = $_POST['spesifikasi'] ?? null;
      $tipe = $_POST['tipe'] ?? null;
      $jumlah = $_POST['jumlah'] ?? 1;
      $satuan = $_POST['satuan'] ?? 'Unit';
      $lokasi = $_POST['lokasi'];
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;
      $keterangan = $_POST['keterangan'] ?? null;

      $no_registrasi = $this->generateUniqueRegistrationNumber(
        $conn,
        $barang_id,
        $tanggal_pembelian,
        $barangList
      );

      try {
        $success = SaranaElektronik::storeData(
          $conn,
          $kategori_barang_id,
          $barang_id,
          $kondisi_barang_id,
          $no_registrasi,
          $nama_detail_barang,
          $merk,
          $spesifikasi,
          $tipe,
          $jumlah,
          $satuan,
          $lokasi,
          $biaya_pembelian,
          $tanggal_pembelian,
          $keterangan
        );

        $message = $success ? 'Data sarana elektronik berhasil ditambahkan.' : 'Gagal menambahkan data sarana elektronik.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/sarana/elektronik');
          exit();
        }
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database: ' . $e->getMessage();
      }
    }

    $this->renderView('create', [
      'kategoriList' => $kategoriList,
      'barangList' => $filteredBarangList,
      'kondisiList' => $kondisiList,
      "lapangData" => $lapangData,
      "ruangData" => $ruangData,
    ]);
  }

  public function update($id) {
    global $conn;
    $sarana = SaranaElektronik::getById($conn, $id);
    $kategoriList = KategoriBarang::getAllData($conn);
    $barangList = Barang::getAllData($conn);
    $kondisiList = KondisiBarang::getAllData($conn);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if (!$sarana) {
      $_SESSION['error'] = 'Data sarana elektronik tidak ditemukan.';
      header('Location: /admin/sarana/elektronik');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $kategori_barang_id = $_POST['kategori_barang_id'];
      $barang_id = $_POST['barang_id'];
      $kondisi_barang_id = $_POST['kondisi_barang_id'];
      $nama_detail_barang = $_POST['nama_detail_barang'];
      $merk = $_POST['merk'] ?? null;
      $spesifikasi = $_POST['spesifikasi'] ?? null;
      $tipe = $_POST['tipe'] ?? null;
      $jumlah = $_POST['jumlah'] ?? $sarana['jumlah'];
      $satuan = $_POST['satuan'] ?? $sarana['satuan'];
      $lokasi = $_POST['lokasi'];
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;
      $keterangan = $_POST['keterangan'] ?? null;

      try {
        $success = SaranaElektronik::updateData(
          $conn,
          $id,
          $kategori_barang_id,
          $barang_id,
          $kondisi_barang_id,
          $sarana['no_registrasi'],
          $nama_detail_barang,
          $merk,
          $spesifikasi,
          $tipe,
          $jumlah,
          $satuan,
          $lokasi,
          $biaya_pembelian,
          $tanggal_pembelian,
          $keterangan
        );

        $message = $success ? 'Data sarana elektronik berhasil diperbarui.' : 'Gagal memperbarui data sarana elektronik.';
        $_SESSION['update'] = $message;

        header('Location: /admin/sarana/elektronik?detail=' . $id);
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
    $entityCode = 'ELK';
    $barangCode = 'BRG'; // Default

    foreach ($barangList as $barang) {
      if ($barang['id'] == $barangId) {
        $barangCode = $barang['kode_barang'];
        break;
      }
    }

    do {
      $randomNumber = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
      $registrationNumber = "{$entityCode}-{$barangCode}-{$year}-{$randomNumber}";

      $stmt = $conn->prepare("SELECT COUNT(*) FROM sarana_elektronik WHERE no_registrasi = ?");
      $stmt->execute([$registrationNumber]);
      $exists = $stmt->fetchColumn() > 0;
    } while ($exists);

    return $registrationNumber;
  }

  public function delete() {
    if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
      global $conn;
      $id = $_GET['delete'];

      // Hapus semua dokumen dan gambar terkait sebelum menghapus sarana utama
      // (Pastikan method ini ada dan bekerja dengan benar di model DokumenSaranaElektronik)
      // DokumenSaranaElektronik::deleteAllBySaranaId($conn, $id); 
      // DokumenSaranaElektronik::deleteAllGambarBySaranaId($conn, $id);

      if (SaranaElektronik::deleteData($conn, $id)) {
        $_SESSION['success'] = 'Data sarana elektronik berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data sarana elektronik.';
      }
      header('Location: /admin/sarana/elektronik');
      exit();
    }
  }

  public function index() {
    global $conn;
    $saranaData = SaranaElektronik::getAllData($conn);
    $this->delete();

    $this->renderView('index', [
      'saranaData' => $saranaData,
    ]);
  }

  // --- Manajemen Dokumen (File seperti PDF, DOCX) ---
  public function dokumen($id_sarana) // ID Sarana Elektronik
  {
    global $conn;
    $saranaElektronikData = SaranaElektronik::getById($conn, $id_sarana);
    if (!$saranaElektronikData) {
      $_SESSION['error'] = 'Data sarana elektronik tidak ditemukan.';
      header('Location: /admin/sarana/elektronik');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $aset_elektronik_id = $_POST['aset_elektronik_id'] ?? $id_sarana;
      $nama_dokumen = $_POST['nama_dokumen'];
      $path_dokumen = '';

      if (!empty($_FILES['path_dokumen']['name'])) {
        $uploadDir = __DIR__ . '/../../storage/dokumen_sarana_elektronik/';
        if (!is_dir($uploadDir)) {
          mkdir($uploadDir, 0777, true);
        }

        $originalName = basename($_FILES['path_dokumen']['name']);
        $sanitizedName = preg_replace("/[^a-zA-Z0-9.\-\_]/", "_", $originalName);
        $fileName = time() . '_' . $sanitizedName;
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['path_dokumen']['tmp_name'], $targetFile)) {
          $path_dokumen = $fileName;
        } else {
          $_SESSION['error'] = 'Gagal mengupload file dokumen. Error: ' . $_FILES['path_dokumen']['error'];
          $this->renderView('/Dokumen/create', [
            'saranaElektronikData' => $saranaElektronikData,
          ]);
          return;
        }
      } else {
        $_SESSION['error'] = 'File dokumen tidak boleh kosong.';
        $this->renderView('/Dokumen/create', [
          'saranaElektronikData' => $saranaElektronikData,
        ]);
        return;
      }

      try {
        // Menggunakan DokumenSaranaElektronik::storeDokumen
        $success = DokumenSaranaElektronik::storeDokumen(
          $conn,
          $aset_elektronik_id,
          $nama_dokumen,
          $path_dokumen
        );
        $message = $success ? 'Dokumen berhasil ditambahkan.' : 'Gagal menambahkan dokumen.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/sarana/elektronik?detail=' . $id_sarana);
          exit();
        }
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database saat menyimpan dokumen: ' . $e->getMessage();
      }
    }

    $this->renderView('/Dokumen/create', [
      'saranaElektronikData' => $saranaElektronikData,
    ]);
  }

  public function downloadDokumen($id_dokumen) {
    global $conn;
    // Menggunakan DokumenSaranaElektronik::getDokumenById
    $dokumen = DokumenSaranaElektronik::getDokumenById($conn, $id_dokumen);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      $_SESSION['error'] = 'Dokumen tidak ditemukan.';
      $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/admin/sarana/elektronik';
      header('Location: ' . $redirect_url);
      exit();
    }

    $filePath = __DIR__ . '/../../storage/dokumen_sarana_elektronik/' . $dokumen['path_dokumen'];

    if (!file_exists($filePath)) {
      $_SESSION['error'] = 'File tidak ditemukan di server.';
      // Pastikan field 'aset_elektronik_id' ada di tabel dokumen_sarana_elektronik
      $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/admin/sarana/elektronik?detail=' . ($dokumen['aset_elektronik_id'] ?? '');
      header('Location: ' . $redirect_url);
      exit();
    }

    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename="' . basename($dokumen['path_dokumen']) . '"');
    header('Content-Length: ' . filesize($filePath));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');

    ob_clean();
    flush();
    readfile($filePath);
    exit;
  }

  public function deleteDokumen() {
    if (isset($_GET['delete-dokumen']) && is_numeric($_GET['delete-dokumen'])) {
      global $conn;
      $id_dokumen = $_GET['delete-dokumen'];
      // Menggunakan DokumenSaranaElektronik::getDokumenById
      $dokumen = DokumenSaranaElektronik::getDokumenById($conn, $id_dokumen);

      if (!$dokumen) {
        $_SESSION['error'] = 'Dokumen tidak ditemukan untuk dihapus.';
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/admin/sarana/elektronik'));
        exit();
      }

      $aset_elektronik_id = $dokumen['aset_elektronik_id'];

      $filePath = __DIR__ . '/../../storage/dokumen_sarana_elektronik/' . $dokumen['path_dokumen'];
      if (file_exists($filePath)) {
        unlink($filePath);
      }

      // Menggunakan DokumenSaranaElektronik::delete
      if (DokumenSaranaElektronik::delete($conn, $id_dokumen)) {
        $_SESSION['success'] = 'Dokumen berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data dokumen dari database.';
      }

      header('Location: /admin/sarana/elektronik?detail=' . $aset_elektronik_id);
      exit();
    }
  }

  // --- Manajemen Gambar (Dokumentasi Foto) ---
  public function dokumenGambar($id_sarana) // ID Sarana Elektronik
  {
    global $conn;
    $saranaElektronikData = SaranaElektronik::getById($conn, $id_sarana);
    if (!$saranaElektronikData) {
      $_SESSION['error'] = 'Data sarana elektronik tidak ditemukan.';
      header('Location: /admin/sarana/elektronik');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $aset_elektronik_id = $_POST['aset_elektronik_id'] ?? $id_sarana;
      // Sesuaikan nama field jika di form berbeda, misal 'nama_gambar'
      $nama_dokumen_gambar = $_POST['nama_dokumen_gambar'] ?? $_POST['nama_dokumen'] ?? 'Gambar ' . time();
      $path_dokumen_gambar = '';

      // Sesuaikan nama field file jika di form berbeda, misal 'path_gambar'
      if (!empty($_FILES['path_dokumen_gambar']['name'])) {
        $fileInputName = 'path_dokumen_gambar';
      } elseif (!empty($_FILES['path_dokumen']['name'])) { // Fallback jika menggunakan field 'path_dokumen' untuk gambar
        $fileInputName = 'path_dokumen';
      } else {
        $_SESSION['error'] = 'File gambar tidak boleh kosong.';
        $this->renderView('/Dokumen/createFoto', [
          'saranaElektronikData' => $saranaElektronikData,
        ]);
        return;
      }


      if (!empty($_FILES[$fileInputName]['name'])) {
        $uploadDir = __DIR__ . '/../../storage/dokumentasi_sarana_elektronik/';
        if (!is_dir($uploadDir)) {
          mkdir($uploadDir, 0777, true);
        }

        $originalName = basename($_FILES[$fileInputName]['name']);
        $sanitizedName = preg_replace("/[^a-zA-Z0-9.\-\_]/", "_", $originalName);
        $fileName = time() . '_' . $sanitizedName;
        $targetFile = $uploadDir . $fileName;

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($imageFileType, $allowedTypes)) {
          $_SESSION['error'] = 'Hanya file gambar (JPG, JPEG, PNG, GIF, WEBP) yang diizinkan.';
          $this->renderView('/Dokumen/createFoto', [
            'saranaElektronikData' => $saranaElektronikData,
          ]);
          return;
        }

        if (move_uploaded_file($_FILES[$fileInputName]['tmp_name'], $targetFile)) {
          $path_dokumen_gambar = $fileName;
        } else {
          $_SESSION['error'] = 'Gagal mengupload file gambar. Error: ' . $_FILES[$fileInputName]['error'];
          $this->renderView('/Dokumen/createFoto', [
            'saranaElektronikData' => $saranaElektronikData,
          ]);
          return;
        }
      }
      // else case for empty file is already handled above

      try {
        // Menggunakan DokumenSaranaElektronik::storeDokumentasi
        $success = DokumenSaranaElektronik::storeDokumentasi(
          $conn,
          $aset_elektronik_id,
          $nama_dokumen_gambar, // $nama_dokumen di model
          $path_dokumen_gambar  // $path_dokumen di model
        );
        $message = $success ? 'Gambar dokumentasi berhasil ditambahkan.' : 'Gagal menambahkan gambar dokumentasi.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/sarana/elektronik?detail=' . $id_sarana);
          exit();
        }
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database saat menyimpan gambar: ' . $e->getMessage();
      }
    }

    $this->renderView('/Dokumen/createFoto', [
      'saranaElektronikData' => $saranaElektronikData,
    ]);
  }

  public function previewDokumen($id_gambar) // ID Gambar
  {
    global $conn;
    // Menggunakan DokumenSaranaElektronik::getDokumenGambarById
    $dokumenGambar = DokumenSaranaElektronik::getDokumenGambarById($conn, $id_gambar);

    if (!$dokumenGambar || empty($dokumenGambar['path_dokumen'])) {
      header("HTTP/1.0 404 Not Found");
      echo "Gambar tidak ditemukan."; // Atau redirect dengan pesan error
      exit();
    }

    $filePath = __DIR__ . '/../../storage/dokumentasi_sarana_elektronik/' . $dokumenGambar['path_dokumen'];

    if (!file_exists($filePath)) {
      header("HTTP/1.0 404 Not Found");
      echo "File gambar tidak ada di server."; // Atau redirect dengan pesan error
      exit();
    }

    $mimeType = mime_content_type($filePath);
    $allowedMimeTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];

    if (!in_array($mimeType, $allowedMimeTypes)) {
      header("HTTP/1.0 403 Forbidden");
      exit('Tipe file tidak diizinkan untuk preview.');
    }

    header('Content-Type: ' . $mimeType);
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
  }

  public function deleteDokumentasi() // Menghapus gambar/dokumentasi
  {
    if (isset($_GET['delete-gambar']) && is_numeric($_GET['delete-gambar'])) {
      global $conn;
      $id_gambar = $_GET['delete-gambar'];
      // Menggunakan DokumenSaranaElektronik::getDokumenGambarById
      $gambar = DokumenSaranaElektronik::getDokumenGambarById($conn, $id_gambar);

      if (!$gambar) {
        $_SESSION['error'] = 'Gambar dokumentasi tidak ditemukan untuk dihapus.';
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/admin/sarana/elektronik'));
        exit();
      }

      $aset_elektronik_id = $gambar['aset_elektronik_id'];

      $filePath = __DIR__ . '/../../storage/dokumentasi_sarana_elektronik/' . $gambar['path_dokumen'];
      if (file_exists($filePath)) {
        unlink($filePath);
      }

      // Menggunakan DokumenSaranaElektronik::deleteGambar
      if (DokumenSaranaElektronik::deleteGambar($conn, $id_gambar)) {
        $_SESSION['success'] = 'Gambar dokumentasi berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data gambar dokumentasi dari database.';
      }

      header('Location: /admin/sarana/elektronik?detail=' . $aset_elektronik_id);
      exit();
    }
  }

  public function detail($id) {
    global $conn;
    $detailData = SaranaElektronik::getById($conn, $id);
    $BaseUrlQr = BaseUrlQr::BaseUrlQr();


    if (!$detailData) {
      $_SESSION['error'] = 'Data sarana elektronik tidak ditemukan.';
      header('Location: /admin/sarana/elektronik');
      exit();
    }

    // Menggunakan DokumenSaranaElektronik::getAllData dan DokumenSaranaElektronik::getAllDataGambar
    $dokumenAsetElektronik = DokumenSaranaElektronik::getAllData($conn, $id) ?? [];
    $dokumenGambarElektronik = DokumenSaranaElektronik::getAllDataGambar($conn, $id) ?? [];

    $this->deleteDokumen();    // Menangani ?delete-dokumen=id
    $this->deleteDokumentasi(); // Menangani ?delete-gambar=id

    $this->renderView('detail', [
      'detailData' => $detailData,
      'dokumenSaranaElektronik' => $dokumenAsetElektronik,
      'dokumenGambarElektronik' => $dokumenGambarElektronik,
      'BaseUrlQr' =>  $BaseUrlQr

    ]);
  }

  public function downloadAllQr() {
    global $conn;
    $saranaData = SaranaElektronik::getAllData($conn);
    $BaseUrlQr = BaseUrlQr::BaseUrlQr();

    $this->renderView('downloadAll', [
      'saranaData' => $saranaData,
      'BaseUrlQr' =>  $BaseUrlQr
    ]);
  }
}
