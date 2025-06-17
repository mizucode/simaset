<?php
require_once __DIR__ . '/../Models/SaranaATK.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';
require_once __DIR__ . '/../Models/DokumenSaranaATK.php';
require_once __DIR__ . '/../Models/BaseUrlQr.php';

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
      $sumber = $_POST['sumber'] ?? null;
      $status = $_POST['status'] ?? 'Terpakai'; // Ambil status dari POST, default 'Terpakai'
      $keterangan = !empty($_POST['keterangan']) ? $_POST['keterangan'] : null;
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;
      $tanggal_peminjaman = null; // Untuk data baru, default null
      $tanggal_pengembalian = null; // Untuk data baru, default null

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
          $sumber,
          $biaya_pembelian,
          $tanggal_pembelian,
          $keterangan,
          $status, // Gunakan status dari form
          null,
          null,
          null, // Peminjam details default null
          $tanggal_peminjaman,
          $tanggal_pengembalian
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

  public function update($no_registrasi_param)
  {
    global $conn;
    // Mengambil data sarana berdasarkan no_registrasi
    $sarana = SaranaATK::getByNoRegistrasi($conn, $no_registrasi_param);

    $kategoriList = KategoriBarang::getAllData($conn);
    $barangList = Barang::getAllData($conn);
    $kondisiList = KondisiBarang::getAllData($conn);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if (!$sarana) {
      $_SESSION['error'] = 'Data sarana ATK tidak ditemukan dengan No. Registrasi: ' . htmlspecialchars($no_registrasi_param);
      header('Location: /admin/sarana/atk');
      exit();
    }

    $actual_id = $sarana['id']; // ID primary key untuk operasi update

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
      $sumber = $_POST['sumber'] ?? $sarana['sumber'] ?? null; // Tangkap input sumber
      $satuan = $_POST['satuan'] ?? 'Unit';
      $lokasi = $_POST['lokasi'] ?? null;
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;
      $keterangan = !empty($_POST['keterangan']) ? $_POST['keterangan'] : ($sarana['keterangan'] ?? null);
      $status = $_POST['status'] ?? $sarana['status'] ?? 'Tersedia';
      $nama_peminjam = $_POST['nama_peminjam'] ?? $sarana['nama_peminjam'] ?? null;
      $identitas_peminjam = $_POST['identitas_peminjam'] ?? $sarana['identitas_peminjam'] ?? null;
      $no_hp_peminjam = $_POST['no_hp_peminjam'] ?? $sarana['no_hp_peminjam'] ?? null;
      $tanggal_peminjaman = $_POST['tanggal_peminjaman'] ?? $sarana['tanggal_peminjaman'] ?? null;
      $tanggal_pengembalian = $_POST['tanggal_pengembalian'] ?? $sarana['tanggal_pengembalian'] ?? null;


      try {
        $success = SaranaATK::updateData(
          $conn,
          $actual_id, // Gunakan ID primary key untuk update
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
          $sumber, // Kirim sumber ke model
          $biaya_pembelian,
          $tanggal_pembelian,
          $keterangan,
          $status,
          $nama_peminjam,
          $identitas_peminjam,
          $no_hp_peminjam,
          $tanggal_peminjaman,
          $tanggal_pengembalian
        );

        $message = $success ? 'Data sarana ATK berhasil diperbarui.' : 'Gagal memperbarui data sarana ATK.';
        $_SESSION['update'] = $message;

        if ($success && $sarana && isset($sarana['no_registrasi'])) {
          header('Location: /admin/sarana/atk/detail/' . urlencode($sarana['no_registrasi']));
          exit();
        } else {
          header('Location: /admin/sarana/atk'); // Fallback
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
      $randomNumber = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
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

    $jenisList = [];
    if (!empty($saranaData)) {
      // 'barang' adalah alias untuk jenis barang dari SaranaATK::getAllData()
      $allJenis = array_column($saranaData, 'barang');
      $jenisList = array_unique($allJenis);
      sort($jenisList); // Urutkan jenis barang
    }

    $this->renderView('index', [
      'saranaData' => $saranaData,
      'jenisList' => $jenisList, // Kirim jenisList ke view
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
          // Pastikan $dokumenData (yang merupakan data Sarana ATK) ada dan memiliki no_registrasi
          if ($dokumenData && isset($dokumenData['no_registrasi'])) {
            header('Location: /admin/sarana/atk/detail/' . urlencode($dokumenData['no_registrasi']));
            exit();
          } else {
            // Fallback jika no_registrasi tidak ditemukan, meskipun seharusnya ada
            header('Location: /admin/sarana/atk');
            exit();
          }
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
      $dokumenEntry = DokumenSaranaATK::getDokumenById($conn, $id);
      $aset_atk_id = $dokumenEntry ? $dokumenEntry['aset_atk_id'] : null;

      if (DokumenSaranaATK::delete($conn, $id)) {
        $_SESSION['success'] = 'Data berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data.';
      }

      if ($aset_atk_id && ($saranaItem = SaranaATK::getById($conn, $aset_atk_id)) && isset($saranaItem['no_registrasi'])) {
        header('Location: /admin/sarana/atk/detail/' . urlencode($saranaItem['no_registrasi']));
        exit();
      } else {
        // Fallback jika no_registrasi tidak ditemukan atau aset_atk_id tidak ada
        header('Location: /admin/sarana/atk');
        exit();
      }
    }
  }

  // dokumen gambar
  public function dokumenGambar($id)
  {
    global $conn;
    $atkData = SaranaATK::getById($conn, $id);
    // $atkDataId = SaranaATK::getById($conn, $id)['id']; // Redundant, $atkData['id'] can be used if needed

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
          // Pastikan $atkData (yang merupakan data Sarana ATK) ada dan memiliki no_registrasi
          if ($atkData && isset($atkData['no_registrasi'])) {
            header('Location: /admin/sarana/atk/detail/' . urlencode($atkData['no_registrasi']));
            exit();
          } else {
            // Fallback jika no_registrasi tidak ditemukan
            $_SESSION['error'] = 'Gagal mendapatkan nomor registrasi untuk pengalihan setelah unggah gambar.';
            header('Location: /admin/sarana/atk');
            exit();
          }
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
      $dokumenEntry = DokumenSaranaATK::getDokumenGambarById($conn, $id);
      $aset_atk_id = $dokumenEntry ? $dokumenEntry['aset_atk_id'] : null;

      if (DokumenSaranaATK::deleteGambar($conn, $id)) {
        // Opsional: Hapus file dari storage jika model tidak menanganinya
        // if ($dokumenEntry && !empty($dokumenEntry['path_dokumen'])) {
        //    $filePath = __DIR__ . '/../../storage/dokumentasi_sarana_atk/' . $dokumenEntry['path_dokumen'];
        //    if (file_exists($filePath)) {
        //        unlink($filePath);
        //    }
        // }
        $_SESSION['success'] = 'Data berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data.';
      }

      if ($aset_atk_id && ($saranaItem = SaranaATK::getById($conn, $aset_atk_id)) && isset($saranaItem['no_registrasi'])) {
        header('Location: /admin/sarana/atk/detail/' . urlencode($saranaItem['no_registrasi']));
        exit();
      } else {
        header('Location: /admin/sarana/atk');
        exit();
      }
    }
  }

  public function previewFileDokumen($id_dokumen)
  {
    global $conn;
    // Menggunakan DokumenSaranaATK::getDokumenById
    $dokumen = DokumenSaranaATK::getDokumenById($conn, $id_dokumen);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      $_SESSION['error'] = 'Dokumen tidak ditemukan untuk pratinjau.';
      // Redirect ke halaman detail ATK jika ID aset tersedia, jika tidak ke halaman list ATK
      $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/admin/sarana/atk';
      if (isset($dokumen['aset_atk_id']) && ($saranaItem = SaranaATK::getById($conn, $dokumen['aset_atk_id'])) && isset($saranaItem['no_registrasi'])) {
        $redirect_url = '/admin/sarana/atk/detail/' . urlencode($saranaItem['no_registrasi']);
      } elseif (isset($dokumen['aset_atk_id'])) {
        // Fallback jika no_registrasi tidak ada, gunakan ID aset jika ada
        $redirect_url = '/admin/sarana/atk/detail/' . $dokumen['aset_atk_id'];
      }
      header('Location: ' . $redirect_url);
      exit();
    }

    $filePath = __DIR__ . '/../../storage/dokumen_sarana_atk/' . $dokumen['path_dokumen'];

    if (!file_exists($filePath)) {
      $_SESSION['error'] = 'File tidak ditemukan di server untuk pratinjau.';
      // Logika redirect yang sama seperti di atas
      $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/admin/sarana/atk';
      if (isset($dokumen['aset_atk_id']) && ($saranaItem = SaranaATK::getById($conn, $dokumen['aset_atk_id'])) && isset($saranaItem['no_registrasi'])) {
        $redirect_url = '/admin/sarana/atk/detail/' . urlencode($saranaItem['no_registrasi']);
      } elseif (isset($dokumen['aset_atk_id'])) {
        $redirect_url = '/admin/sarana/atk/detail/' . $dokumen['aset_atk_id'];
      }
      header('Location: ' . $redirect_url);
      exit();
    }

    // Asumsi file adalah PDF, sesuaikan jika perlu
    header('Content-Type: application/pdf');
    header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
  }

  public function detail($no_registrasi_param)
  {
    global $conn;
    // Mengambil data sarana berdasarkan no_registrasi
    $detailData = SaranaATK::getByNoRegistrasi($conn, $no_registrasi_param);

    if (!$detailData) {
      $_SESSION['error'] = 'Data sarana ATK tidak ditemukan dengan No. Registrasi: ' . htmlspecialchars($no_registrasi_param);
      header('Location: /admin/sarana/atk');
      exit();
    }
    $dokumenAsetATK = DokumenSaranaATK::getAllData($conn, $detailData['id']);
    $dokumenGambarATK = DokumenSaranaATK::getAllDataGambar($conn, $detailData['id']);
    $BaseUrlQr = BaseUrlQr::BaseUrlQr();


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
      'BaseUrlQr' => $BaseUrlQr,
    ]);
  }

  // download all qr
  public function downloadAllQr()
  {
    global $conn;
    $saranaData = SaranaATK::getAllData($conn);
    $BaseUrlQr = BaseUrlQr::BaseUrlQr();

    $this->renderView('downloadAll', [
      'saranaData' => $saranaData,
      'BaseUrlQr' => $BaseUrlQr,
    ]);
  }
}
