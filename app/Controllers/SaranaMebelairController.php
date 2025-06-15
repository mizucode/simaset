<?php


require_once __DIR__ . '/../Models/SaranaMebelair.php';
require_once __DIR__ . '/../Models/DokumenSaranaMebelair.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/Ruang.php';


class SaranaMebelairController {
  private function renderView(string $view, $data = []) {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/BarangMebeler/{$view}.php";
  }

  public function create() {
    global $conn;
    $kategoriList = KategoriBarang::getAllData($conn);
    $barangList = Barang::getAllData($conn);
    $kondisiList = KondisiBarang::getAllData($conn);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    $filteredBarangList = array_filter($barangList, function ($barang) {
      return $barang['kategori_id'] == 2;
    });

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
      $bahan = !empty($_POST['bahan']) ? $_POST['bahan'] : null;
      $keterangan = !empty($_POST['keterangan']) ? $_POST['keterangan'] : null;
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;
      $status = 'Tersedia';
      $nama_peminjam = null;
      $identitas_peminjam = null;
      $no_hp_peminjam = null;
      $tanggal_peminjaman = null;
      $tanggal_pengembalian = null;


      $no_registrasi = $this->generateUniqueRegistrationNumber(
        $conn,
        $barang_id,
        $tanggal_pembelian,
        $barangList
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
          $biaya_pembelian,
          $tanggal_pembelian,
          $status,
          $nama_peminjam,
          $identitas_peminjam,
          $no_hp_peminjam,
          $tanggal_peminjaman,
          $tanggal_pengembalian
        );

        $message = $success ? 'Data sarana mebelair berhasil ditambahkan.' : 'Gagal menambahkan data sarana mebelair.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/sarana/mebelair');
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

  public function update($identifier) {
    global $conn;
    $sarana = null;
    $actual_id = null;

    if (is_numeric($identifier)) {
      $sarana = SaranaMebelair::getById($conn, $identifier);
      if ($sarana) {
        $actual_id = $identifier;
      }
    } else {
      $sarana = SaranaMebelair::getByNoRegistrasi($conn, $identifier);
      if ($sarana) {
        $actual_id = $sarana['id'];
      }
    }

    $kategoriList = KategoriBarang::getAllData($conn);
    $barangList = Barang::getAllData($conn);
    $kondisiList = KondisiBarang::getAllData($conn);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);
    if (!$sarana) {
      $_SESSION['error'] = 'Data sarana mebelair tidak ditemukan.';
      header('Location: /admin/sarana/mebelair');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $kategori_barang_id = $_POST['kategori_barang_id'];
      $barang_id = $_POST['barang_id'];
      $kondisi_barang_id = $_POST['kondisi_barang_id'];
      $nama_detail_barang = $_POST['nama_detail_barang'];
      $merk = $_POST['merk'] ?? null;
      $spesifikasi = $_POST['spesifikasi'] ?? null;
      $sumber = $_POST['sumber'] ?? null;
      $jumlah = $_POST['jumlah'] ?? 1;
      $satuan = $_POST['satuan'] ?? 'Unit';
      $lokasi = $_POST['lokasi'];
      $bahan = array_key_exists('bahan', $_POST) ? (!empty($_POST['bahan']) ? $_POST['bahan'] : null) : $sarana['bahan'];
      $keterangan = array_key_exists('keterangan', $_POST) ? (!empty($_POST['keterangan']) ? $_POST['keterangan'] : null) : $sarana['keterangan'];
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? $sarana['tanggal_pembelian'];
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? $sarana['biaya_pembelian'];
      $status = $_POST['status'] ?? $sarana['status'] ?? 'Tersedia';
      $nama_peminjam = $_POST['nama_peminjam'] ?? $sarana['nama_peminjam'] ?? null;
      $identitas_peminjam = $_POST['identitas_peminjam'] ?? $sarana['identitas_peminjam'] ?? null;
      $no_hp_peminjam = $_POST['no_hp_peminjam'] ?? $sarana['no_hp_peminjam'] ?? null;
      $tanggal_peminjaman = $_POST['tanggal_peminjaman'] ?? $sarana['tanggal_peminjaman'] ?? null;
      $tanggal_pengembalian = $_POST['tanggal_pengembalian'] ?? $sarana['tanggal_pengembalian'] ?? null;


      try {
        $success = SaranaMebelair::updateData(
          $conn,
          $actual_id,
          $kategori_barang_id,
          $barang_id,
          $kondisi_barang_id,
          $sarana['no_registrasi'],
          $nama_detail_barang,
          $merk,
          $spesifikasi,
          $sumber,
          $jumlah,
          $satuan,
          $lokasi,
          $bahan,
          $keterangan,
          $biaya_pembelian,
          $tanggal_pembelian,
          $status,
          $nama_peminjam,
          $identitas_peminjam,
          $no_hp_peminjam,
          $tanggal_peminjaman,
          $tanggal_pengembalian
        );

        $message = $success ? 'Data sarana mebelair berhasil diperbarui.' : 'Gagal memperbarui data sarana mebelair.';
        $_SESSION['update'] = $message;

        if ($success && $sarana && isset($sarana['no_registrasi'])) {
          header('Location: /admin/sarana/mebelair/detail/' . urlencode($sarana['no_registrasi']));
          exit();
        } elseif ($success) {
          header('Location: /admin/sarana/mebelair');
          exit();
        }
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
    $barangCode = 'MBL';

    foreach ($barangList as $barang) {
      if ($barang['id'] == $barangId) {
        $barangCode = $barang['kode_barang'];
        break;
      }
    }

    do {
      $randomNumber = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
      $registrationNumber = "MBL-{$barangCode}-{$year}-{$randomNumber}";
      $stmt = $conn->prepare("SELECT COUNT(*) FROM sarana_mebelair WHERE no_registrasi = ?");
      $stmt->execute([$registrationNumber]);
      $exists = $stmt->fetchColumn() > 0;
    } while ($exists);

    return $registrationNumber;
  }

  public function delete() {
    if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
      global $conn;
      $id = $_GET['delete'];
      if (SaranaMebelair::deleteData($conn, $id)) {
        $_SESSION['success'] = 'Data sarana mebelair berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data sarana mebelair.';
      }
      header('Location: /admin/sarana/mebelair');
      exit();
    }
  }




  public function index() {
    global $conn;
    $saranaData = SaranaMebelair::getAllData($conn);
    $this->delete();

    $jenisList = [];
    if (!empty($saranaData)) {
      $allJenis = array_column($saranaData, 'barang');
      $jenisList = array_unique($allJenis);
      sort($jenisList);
    }

    $this->renderView('index', [
      'saranaData' => $saranaData,
      'jenisList' => $jenisList,
    ]);
  }



  public function dokumen($id) {
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
      $nama_dokumen = $_POST['nama_dokumen'];
      $path_dokumen = '';

      if (!empty($_FILES['path_dokumen']['name'])) {
        $uploadDir = __DIR__ . '/../../storage/dokumen_sarana_mebelair/';
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
          $this->renderView('Dokumen/create', ['mebelairData' => $mebelairData]);
          return;
        }
      } else {
        $_SESSION['error'] = 'File dokumen tidak boleh kosong.';
        $this->renderView('Dokumen/create', ['mebelairData' => $mebelairData]);
        return;
      }

      try {
        $success = DokumenSaranaMebelair::storeDokumenMebelair(
          $conn,
          $aset_mebelair_id,
          $nama_dokumen,
          $path_dokumen
        );
        $message = $success ? 'Dokumen sarana mebelair berhasil ditambahkan.' : 'Gagal menambahkan dokumen.';
        $_SESSION['update'] = $message;

        if ($success) {
          if ($mebelairData && isset($mebelairData['no_registrasi'])) {
            header('Location: /admin/sarana/mebelair/detail/' . urlencode($mebelairData['no_registrasi']));
            exit();
          } else {
            header('Location: /admin/sarana/mebelair');
            exit();
          }
        }
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database: ' . $e->getMessage();
      }
    }
    $this->renderView('Dokumen/create', ['mebelairData' => $mebelairData]);
  }

  public function downloadDokumen($id) {
    global $conn;
    $dokumen = DokumenSaranaMebelair::getDokumenById($conn, $id);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      $_SESSION['error'] = 'Dokumen tidak ditemukan.';
      header('Location: /admin/sarana/mebelair');
      exit();
    }

    $filePath = __DIR__ . '/../../storage/dokumen_sarana_mebelair/' . $dokumen['path_dokumen'];

    if (!file_exists($filePath)) {
      $_SESSION['error'] = 'File tidak ditemukan di server.';
      if (isset($dokumen['aset_mebelair_id']) && ($saranaItem = SaranaMebelair::getById($conn, $dokumen['aset_mebelair_id'])) && isset($saranaItem['no_registrasi'])) {
        header('Location: /admin/sarana/mebelair/detail/' . urlencode($saranaItem['no_registrasi']));
      } else {
        header('Location: /admin/sarana/mebelair');
      }
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

  public function deleteDokumen() {
    if (isset($_GET['delete-dokumen']) && is_numeric($_GET['delete-dokumen'])) {
      global $conn;
      $id = $_GET['delete-dokumen'];
      $dokumenData = DokumenSaranaMebelair::getDokumenById($conn, $id);
      $aset_mebelair_id = $dokumenData ? $dokumenData['aset_mebelair_id'] : null;

      if (DokumenSaranaMebelair::delete($conn, $id)) {
        $_SESSION['success'] = 'Dokumen berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus dokumen.';
      }

      if ($aset_mebelair_id && ($saranaItem = SaranaMebelair::getById($conn, $aset_mebelair_id)) && isset($saranaItem['no_registrasi'])) {
        header('Location: /admin/sarana/mebelair/detail/' . urlencode($saranaItem['no_registrasi']));
      } else {
        header('Location: /admin/sarana/mebelair');
      }
      exit();
    }
  }

  public function dokumenGambar($id) {
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
      $nama_dokumen = $_POST['nama_dokumen'];
      $path_dokumen = '';

      if (!empty($_FILES['path_dokumen']['name'])) {
        $uploadDir = __DIR__ . '/../../storage/dokumentasi_sarana_mebelair/';
        if (!is_dir($uploadDir)) {
          mkdir($uploadDir, 0777, true);
        }

        $originalName = basename($_FILES['path_dokumen']['name']);
        $sanitizedName = preg_replace("/[^a-zA-Z0-9.\-\_]/", "_", $originalName);
        $fileName = time() . '_' . $sanitizedName;
        $targetFile = $uploadDir . $fileName;

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($imageFileType, $allowedTypes)) {
          $_SESSION['error'] = 'Hanya file gambar (JPG, JPEG, PNG, GIF, WEBP) yang diizinkan.';
          $this->renderView('Dokumen/createFoto', ['mebelairData' => $mebelairData]);
          return;
        }


        if (move_uploaded_file($_FILES['path_dokumen']['tmp_name'], $targetFile)) {
          $path_dokumen = $fileName;
        } else {
          $_SESSION['error'] = 'Gagal mengupload file gambar. Error: ' . $_FILES['path_dokumen']['error'];
          $this->renderView('Dokumen/createFoto', ['mebelairData' => $mebelairData]);
          return;
        }
      } else {
        $_SESSION['error'] = 'File gambar tidak boleh kosong.';
        $this->renderView('Dokumen/createFoto', ['mebelairData' => $mebelairData]);
        return;
      }

      try {
        $success = DokumenSaranaMebelair::storeDokumentasiMebelair(
          $conn,
          $aset_mebelair_id,
          $nama_dokumen,
          $path_dokumen
        );
        $message = $success ? 'Dokumentasi gambar berhasil ditambahkan.' : 'Gagal menambahkan dokumentasi gambar.';
        $_SESSION['update'] = $message;

        if ($success) {
          if ($mebelairData && isset($mebelairData['no_registrasi'])) {
            header('Location: /admin/sarana/mebelair/detail/' . urlencode($mebelairData['no_registrasi']));
            exit();
          } else {
            header('Location: /admin/sarana/mebelair');
            exit();
          }
        }
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database: ' . $e->getMessage();
      }
    }
    $this->renderView('Dokumen/createFoto', ['mebelairData' => $mebelairData]);
  }

  public function previewFileDokumen($id) {
    global $conn;
    $dokumen = DokumenSaranaMebelair::getDokumenById($conn, $id);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      $_SESSION['error'] = 'Dokumen tidak ditemukan untuk pratinjau.';
      $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/admin/sarana/mebelair';
      if (isset($dokumen['aset_mebelair_id']) && ($saranaItem = SaranaMebelair::getById($conn, $dokumen['aset_mebelair_id'])) && isset($saranaItem['no_registrasi'])) {
        $redirect_url = '/admin/sarana/mebelair/detail/' . urlencode($saranaItem['no_registrasi']);
      } elseif (isset($dokumen['aset_mebelair_id'])) {
        $redirect_url = '/admin/sarana/mebelair/detail/' . $dokumen['aset_mebelair_id'];
      }
      header('Location: ' . $redirect_url);
      exit();
    }

    $filePath = __DIR__ . '/../../storage/dokumen_sarana_mebelair/' . $dokumen['path_dokumen'];

    if (!file_exists($filePath)) {
      $_SESSION['error'] = 'File tidak ditemukan di server untuk pratinjau.';
      $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/admin/sarana/mebelair';
      if (isset($dokumen['aset_mebelair_id']) && ($saranaItem = SaranaMebelair::getById($conn, $dokumen['aset_mebelair_id'])) && isset($saranaItem['no_registrasi'])) {
        $redirect_url = '/admin/sarana/mebelair/detail/' . urlencode($saranaItem['no_registrasi']);
      } elseif (isset($dokumen['aset_mebelair_id'])) {
        $redirect_url = '/admin/sarana/mebelair/detail/' . $dokumen['aset_mebelair_id'];
      }
      header('Location: ' . $redirect_url);
      exit();
    }

    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
  }

  public function previewDokumen($id) {
    global $conn;
    $dokumen = DokumenSaranaMebelair::getDokumenGambarById($conn, $id);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      header("HTTP/1.0 404 Not Found");
      exit('Dokumen gambar tidak ditemukan.');
    }

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

  public function deleteDokumentasi() {
    if (isset($_GET['delete-gambar']) && is_numeric($_GET['delete-gambar'])) {
      global $conn;
      $id = $_GET['delete-gambar'];
      $dokumenData = DokumenSaranaMebelair::getDokumenGambarById($conn, $id);
      $aset_mebelair_id = $dokumenData ? $dokumenData['aset_mebelair_id'] : null;

      if (DokumenSaranaMebelair::deleteGambar($conn, $id)) {
        $_SESSION['success'] = 'Dokumentasi gambar berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus dokumentasi gambar.';
      }

      if ($aset_mebelair_id && ($saranaItem = SaranaMebelair::getById($conn, $aset_mebelair_id)) && isset($saranaItem['no_registrasi'])) {
        header('Location: /admin/sarana/mebelair/detail/' . urlencode($saranaItem['no_registrasi']));
      } else {
        header('Location: /admin/sarana/mebelair');
      }
      exit();
    }
  }

  public function detail($identifier) {
    global $conn;
    $detailData = null;
    $id_for_related_data = null;

    if (is_numeric($identifier)) {
      $detailData = SaranaMebelair::getById($conn, $identifier);
      if ($detailData) {
        $id_for_related_data = $identifier;
      }
    } else {
      $detailData = SaranaMebelair::getByNoRegistrasi($conn, $identifier);
      if ($detailData) {
        $id_for_related_data = $detailData['id']; // Ambil ID dari data yang ditemukan
      }
    }

    $BaseUrlQr = BaseUrlQr::BaseUrlQr();

    if (!$detailData) {
      $_SESSION['error'] = 'Data sarana mebelair tidak ditemukan.';
      header('Location: /admin/sarana/mebelair');
      exit();
    }
    $dokumenAsetMebelair = DokumenSaranaMebelair::getAllData($conn, $id_for_related_data);
    $dokumenGambarMebelair = DokumenSaranaMebelair::getAllDataGambar($conn, $id_for_related_data);

    if (!is_array($dokumenAsetMebelair)) {
      $dokumenAsetMebelair = [];
    }
    if (!is_array($dokumenGambarMebelair)) {
      $dokumenGambarMebelair = [];
    }

    $this->delete();
    $this->deleteDokumen();
    $this->deleteDokumentasi();

    $filteredDokumen = [];
    if ($detailData && isset($detailData['id'])) {
      $filteredDokumen = array_filter($dokumenAsetMebelair, function ($dokumen) use ($detailData) {
        return isset($dokumen['aset_mebelair_id']) && $dokumen['aset_mebelair_id'] == $detailData['id'];
      });
    }

    $this->renderView('detail', [
      'detailData' => $detailData,
      'dokumenSaranaMebelair' => $filteredDokumen,
      'dokumenGambar' => $dokumenGambarMebelair,
      'BaseUrlQr' => $BaseUrlQr
    ]);
  }


  public function downloadAllQr() {
    global $conn;
    $saranaData = SaranaMebelair::getAllData($conn);
    $BaseUrlQr = BaseUrlQr::BaseUrlQr();

    $this->renderView('downloadAll', [
      'saranaData' => $saranaData,
      'BaseUrlQr' => $BaseUrlQr
    ]);
  }
}
