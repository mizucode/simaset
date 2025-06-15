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
      $lokasi = $_POST['lokasi'];
      $status = $_POST['status'] ?? 'Terpakai';

      // Handle optional fields: if empty, store as null
      $merk = !empty($_POST['merk']) ? $_POST['merk'] : null;
      $spesifikasi = !empty($_POST['spesifikasi']) ? $_POST['spesifikasi'] : null;
      $no_polisi = !empty($_POST['no_polisi']) ? $_POST['no_polisi'] : null;
      $sumber = !empty($_POST['sumber']) ? $_POST['sumber'] : null;
      $keterangan = !empty($_POST['keterangan']) ? $_POST['keterangan'] : null;
      $biaya_pembelian = !empty($_POST['biaya_pembelian']) ? $_POST['biaya_pembelian'] : null;
      $tanggal_pembelian = !empty($_POST['tanggal_pembelian']) ? $_POST['tanggal_pembelian'] : null;
      $nama_peminjam = !empty($_POST['nama_peminjam']) ? $_POST['nama_peminjam'] : null;
      $identitas_peminjam = !empty($_POST['identitas_peminjam']) ? $_POST['identitas_peminjam'] : null;
      $no_hp_peminjam = !empty($_POST['no_hp_peminjam']) ? $_POST['no_hp_peminjam'] : null;
      $tanggal_peminjaman = !empty($_POST['tanggal_peminjaman']) ? $_POST['tanggal_peminjaman'] : null;
      $tanggal_pengembalian = !empty($_POST['tanggal_pengembalian']) ? $_POST['tanggal_pengembalian'] : null;

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
          $status,
          $nama_peminjam,
          $identitas_peminjam,
          $no_hp_peminjam,
          $tanggal_peminjaman,
          $tanggal_pengembalian
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

  public function update($identifier) { // Mengubah parameter dari $id menjadi $identifier
    global $conn;
    $sarana = null;
    $actual_id = null;

    if (is_numeric($identifier)) {
      // Jika identifier numerik, anggap sebagai ID
      $sarana = SaranaBergerak::getById($conn, $identifier);
      if ($sarana) {
        $actual_id = $identifier;
      }
    } else {
      // Jika identifier bukan numerik, anggap sebagai no_registrasi
      $sarana = SaranaBergerak::getByNoRegistrasi($conn, $identifier);
      if ($sarana) {
        $actual_id = $sarana['id']; // Ambil ID dari data yang ditemukan
      }
    }

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
      $lokasi = $_POST['lokasi'];

      // Handle optional fields for update:
      // If field is submitted in POST: use it (empty string becomes null).
      // If field is not submitted in POST: keep existing value from $sarana.
      $merk_val = array_key_exists('merk', $_POST) ? (!empty($_POST['merk']) ? $_POST['merk'] : null) : $sarana['merk'];
      $spesifikasi_val = array_key_exists('spesifikasi', $_POST) ? (!empty($_POST['spesifikasi']) ? $_POST['spesifikasi'] : null) : $sarana['spesifikasi'];
      $no_polisi_val = array_key_exists('no_polisi', $_POST) ? (!empty($_POST['no_polisi']) ? $_POST['no_polisi'] : null) : $sarana['no_polisi'];
      $sumber_val = array_key_exists('sumber', $_POST) ? (!empty($_POST['sumber']) ? $_POST['sumber'] : null) : $sarana['sumber'];
      $keterangan_val = array_key_exists('keterangan', $_POST) ? (!empty($_POST['keterangan']) ? $_POST['keterangan'] : null) : $sarana['keterangan'];
      $biaya_pembelian_val = array_key_exists('biaya_pembelian', $_POST) ? (!empty($_POST['biaya_pembelian']) ? $_POST['biaya_pembelian'] : null) : $sarana['biaya_pembelian'];
      $tanggal_pembelian_val = array_key_exists('tanggal_pembelian', $_POST) ? (!empty($_POST['tanggal_pembelian']) ? $_POST['tanggal_pembelian'] : null) : $sarana['tanggal_pembelian'];

      $status_val = $_POST['status'] ?? $sarana['status'];

      $nama_peminjam_val = array_key_exists('nama_peminjam', $_POST) ? (!empty($_POST['nama_peminjam']) ? $_POST['nama_peminjam'] : null) : $sarana['nama_peminjam'];
      $identitas_peminjam_val = array_key_exists('identitas_peminjam', $_POST) ? (!empty($_POST['identitas_peminjam']) ? $_POST['identitas_peminjam'] : null) : $sarana['identitas_peminjam'];
      $no_hp_peminjam_val = array_key_exists('no_hp_peminjam', $_POST) ? (!empty($_POST['no_hp_peminjam']) ? $_POST['no_hp_peminjam'] : null) : $sarana['no_hp_peminjam'];
      $tanggal_peminjaman_val = array_key_exists('tanggal_peminjaman', $_POST) ? (!empty($_POST['tanggal_peminjaman']) ? $_POST['tanggal_peminjaman'] : null) : $sarana['tanggal_peminjaman'];
      $tanggal_pengembalian_val = array_key_exists('tanggal_pengembalian', $_POST) ? (!empty($_POST['tanggal_pengembalian']) ? $_POST['tanggal_pengembalian'] : null) : $sarana['tanggal_pengembalian'];

      try {
        $success = SaranaBergerak::updateData(
          $conn,
          $actual_id, // Gunakan ID yang sebenarnya
          $kategori_barang_id,
          $barang_id,
          $kondisi_barang_id,
          $sarana['no_registrasi'], // Keep existing registration number
          $nama_detail_barang,
          $merk_val,
          $spesifikasi_val,
          $no_polisi_val,
          $sumber_val,
          $lokasi,
          $keterangan_val,
          $biaya_pembelian_val,
          $tanggal_pembelian_val,
          $status_val,
          $nama_peminjam_val,
          $identitas_peminjam_val,
          $no_hp_peminjam_val,
          $tanggal_peminjaman_val,
          $tanggal_pengembalian_val
        );

        $message = $success ? 'Data sarana bergerak berhasil diperbarui.' : 'Gagal memperbarui data sarana bergerak.';
        $_SESSION['update'] = $message;

        if ($success && $sarana && isset($sarana['no_registrasi'])) {
          header('Location: /admin/sarana/bergerak/detail/' . urlencode($sarana['no_registrasi']));
          exit();
        } elseif ($success) {
          // Fallback jika no_registrasi tidak ada, meskipun seharusnya ada
          header('Location: /admin/sarana/bergerak');
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

        if ($success && $dokumenData && isset($dokumenData['no_registrasi'])) {
          header('Location: /admin/sarana/bergerak/detail/' . urlencode($dokumenData['no_registrasi']));
          exit();
        } elseif ($success) {
          // Fallback jika no_registrasi tidak ada di $dokumenData (yang merupakan data sarana)
          header('Location: /admin/sarana/bergerak');
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

  public function previewFileDokumen($id) {
    global $conn;

    // 1. Ambil data dokumen dari database
    $dokumen = DokumenSaranaBergerak::getDokumenById($conn, $id);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      $_SESSION['error'] = 'Dokumen tidak ditemukan untuk pratinjau.';
      // Redirect ke halaman sebelumnya atau halaman detail aset
      $redirect_url = $_SERVER['HTTP_REFERER'] ?? ('/admin/sarana/bergerak/detail/' . ($dokumen['aset_bergerak_id'] ?? ''));
      header('Location: ' . $redirect_url);
      exit();
    }

    // 2. Tentukan path file
    $filePath = __DIR__ . '/../../storage/dokumen_sarana_bergerak/' . $dokumen['path_dokumen'];

    // 3. Validasi file
    if (!file_exists($filePath)) {
      $_SESSION['error'] = 'File tidak ditemukan di server untuk pratinjau.';
      $redirect_url = $_SERVER['HTTP_REFERER'] ?? ('/admin/sarana/bergerak/detail/' . ($dokumen['aset_bergerak_id'] ?? ''));
      header('Location: ' . $redirect_url);
      exit();
    }

    // 4. Set headers untuk pratinjau (inline)
    header('Content-Type: application/pdf'); // Asumsi PDF, bisa dibuat dinamis jika perlu
    header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
  }

  public function deleteDokumen() {
    if (isset($_GET['delete-dokumen']) && is_numeric($_GET['delete-dokumen'])) {
      global $conn;
      $id = $_GET['delete-dokumen'];
      $dokumenEntry = DokumenSaranaBergerak::getDokumenById($conn, $id);
      $aset_bergerak_id = $dokumenEntry ? $dokumenEntry['aset_bergerak_id'] : null;

      if (DokumenSaranaBergerak::delete($conn, $id)) {
        $_SESSION['success'] = 'Data berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data.';
      }
      if ($aset_bergerak_id && ($saranaItem = SaranaBergerak::getById($conn, $aset_bergerak_id)) && isset($saranaItem['no_registrasi'])) {
        header('Location: /admin/sarana/bergerak/detail/' . urlencode($saranaItem['no_registrasi']));
      } else {
        header('Location: /admin/sarana/bergerak');
      }
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

        if ($success && $bergerakData && isset($bergerakData['no_registrasi'])) {
          header('Location: /admin/sarana/bergerak/detail/' . urlencode($bergerakData['no_registrasi']));
          exit();
        } elseif ($success) {
          // Fallback
          header('Location: /admin/sarana/bergerak');
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
      $gambarEntry = DokumenSaranaBergerak::getDokumenGambarById($conn, $id);
      $aset_bergerak_id = $gambarEntry ? $gambarEntry['aset_bergerak_id'] : null;

      if (DokumenSaranaBergerak::deleteGambar($conn, $id)) {
        $_SESSION['success'] = 'Data berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data.';
      }
      if ($aset_bergerak_id && ($saranaItem = SaranaBergerak::getById($conn, $aset_bergerak_id)) && isset($saranaItem['no_registrasi'])) {
        header('Location: /admin/sarana/bergerak/detail/' . urlencode($saranaItem['no_registrasi']));
      } else {
        header('Location: /admin/sarana/bergerak');
      }
      exit();
    }
  }

  public function detail($identifier) { // Mengubah parameter dari $id menjadi $identifier
    global $conn;
    $detailData = null;
    $id_for_related_data = null;

    if (is_numeric($identifier)) {
      // Jika identifier numerik, anggap sebagai ID
      $detailData = SaranaBergerak::getById($conn, $identifier);
      if ($detailData) {
        $id_for_related_data = $identifier;
      }
    } else {
      // Jika identifier bukan numerik, anggap sebagai no_registrasi
      // Pastikan method getByNoRegistrasi ada di model SaranaBergerak.php
      // Contoh: public static function getByNoRegistrasi($conn, $no_registrasi) { ... }
      $detailData = SaranaBergerak::getByNoRegistrasi($conn, $identifier);
      if ($detailData) {
        $id_for_related_data = $detailData['id']; // Ambil ID dari data yang ditemukan
      }
    }

    $dokumenAsetGedung = DokumenSaranaBergerak::getAllData($conn, $id_for_related_data);
    $dokumenGambarGedung = DokumenSaranaBergerak::getAllDataGambar($conn, $id_for_related_data);
    $BaseUrlQr = BaseUrlQr::BaseUrlQr();


    if (!is_array($dokumenAsetGedung)) {
      $dokumenAsetGedung = [];
    }
    if (!is_array($dokumenGambarGedung)) {
      $dokumenGambarGedung = [];
    }

    // Pastikan $detailData dan $detailData['id'] ada sebelum melakukan filter
    $filteredDokumen = [];
    if ($detailData && isset($detailData['id'])) {
      $filteredDokumen = array_filter($dokumenAsetGedung, function ($dokumen) use ($detailData) {
        return isset($dokumen['aset_bergerak_id']) && $dokumen['aset_bergerak_id'] == $detailData['id'];
      });

      $filteredGambar = array_filter($dokumenGambarGedung, function ($dokumen) use ($detailData) {
        return isset($dokumen['aset_bergerak_id']) && $dokumen['aset_bergerak_id'] == $detailData['id'];
      });
    }



    $this->delete();
    $this->deleteDokumentasi();
    $this->deleteDokumen();

    $this->renderView('detail', [
      'detailData' => $detailData, // $detailData akan berisi data barang, termasuk 'id' dan 'no_registrasi'
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
