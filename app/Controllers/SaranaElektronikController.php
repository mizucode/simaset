<?php

// Pastikan path ini benar dan file model ada
require_once __DIR__ . '/../Models/SaranaElektronik.php';
require_once __DIR__ . '/../Models/DokumenSaranaElektronik.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/Ruang.php';

class SaranaElektronikController
{
  private function renderView(string $view, $data = [])
  {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/BarangElektronik/{$view}.php";
  }

  public function create()
  {
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
      $sumber = $_POST['sumber'] ?? null; // Tambahkan pengambilan data sumber
      $jumlah = $_POST['jumlah'] ?? 1;
      $satuan = $_POST['satuan'] ?? 'Unit';
      $lokasi = $_POST['lokasi'];
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;
      $keterangan = !empty($_POST['keterangan']) ? $_POST['keterangan'] : null;
      $status = $_POST['status'] ?? 'Terpakai'; // Ambil status dari POST, default 'Terpakai'

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
          $sumber, // Tambahkan variabel sumber ke pemanggilan storeData
          $jumlah,
          $satuan,
          $lokasi,
          $biaya_pembelian,
          $tanggal_pembelian,
          $keterangan,
          $status // Teruskan status yang diambil dari form
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

  public function update($no_registrasi_param) // Mengubah parameter ke no_registrasi
  {
    global $conn;
    // Mengambil data sarana berdasarkan no_registrasi
    // Asumsi SaranaElektronik::getByNoRegistrasi() sudah ada atau akan dibuat
    $sarana = SaranaElektronik::getByNoRegistrasi($conn, $no_registrasi_param);

    $kategoriList = KategoriBarang::getAllData($conn);
    $barangList = Barang::getAllData($conn);
    $kondisiList = KondisiBarang::getAllData($conn);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if (!$sarana) {
      $_SESSION['error'] = 'Data sarana elektronik tidak ditemukan dengan No. Registrasi: ' . htmlspecialchars($no_registrasi_param);
      header('Location: /admin/sarana/elektronik');
      exit();
    }

    // Dapatkan ID aktual dari data sarana yang diambil, karena updateData mungkin memerlukan ID primary key
    $actual_id = $sarana['id'];

    // Jika $sarana tidak ditemukan setelah getByNoRegistrasi, seharusnya sudah ditangani di atas.
    // Baris ini bisa jadi redundan jika pengecekan di atas sudah cukup.
    // if (!$sarana) {
    //   $_SESSION['error'] = 'Data sarana elektronik tidak ditemukan.';
    //   header('Location: /admin/sarana/elektronik');
    //   exit();
    // }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $kategori_barang_id = $_POST['kategori_barang_id'];
      $barang_id = $_POST['barang_id'];
      $kondisi_barang_id = $_POST['kondisi_barang_id'];
      $nama_detail_barang = $_POST['nama_detail_barang'];
      $merk = $_POST['merk'] ?? null;
      $spesifikasi = $_POST['spesifikasi'] ?? null;
      $tipe = $_POST['tipe'] ?? null;
      $sumber = $_POST['sumber'] ?? $sarana['sumber'] ?? null; // Tambahkan pengambilan sumber untuk update
      $jumlah = $_POST['jumlah'] ?? $sarana['jumlah'];
      $satuan = $_POST['satuan'] ?? $sarana['satuan'];
      $lokasi = $_POST['lokasi'];
      $biaya_pembelian = $_POST['biaya_pembelian'] ?? null;
      $tanggal_pembelian = $_POST['tanggal_pembelian'] ?? null;
      $keterangan = $_POST['keterangan'] ?? null;
      // Ambil status dan detail peminjam dari POST atau data sarana yang ada
      $status = $_POST['status'] ?? $sarana['status'] ?? 'Terpakai';
      $nama_peminjam = $_POST['nama_peminjam'] ?? $sarana['nama_peminjam'] ?? null;
      $identitas_peminjam = $_POST['identitas_peminjam'] ?? $sarana['identitas_peminjam'] ?? null;
      $no_hp_peminjam = $_POST['no_hp_peminjam'] ?? $sarana['no_hp_peminjam'] ?? null;
      $tanggal_peminjaman = $_POST['tanggal_peminjaman'] ?? $sarana['tanggal_peminjaman'] ?? null;
      $tanggal_pengembalian = $_POST['tanggal_pengembalian'] ?? $sarana['tanggal_pengembalian'] ?? null;


      try {
        $success = SaranaElektronik::updateData(
          $conn,
          $actual_id, // Gunakan ID primary key untuk update
          $kategori_barang_id,
          $barang_id,
          $kondisi_barang_id,
          $sarana['no_registrasi'],
          $nama_detail_barang,
          $merk,
          $spesifikasi,
          $tipe,
          $sumber, // Tambahkan variabel sumber ke pemanggilan updateData
          $jumlah,
          $satuan,
          $lokasi,
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

        $message = $success ? 'Data sarana elektronik berhasil diperbarui.' : 'Gagal memperbarui data sarana elektronik.';
        $_SESSION['update'] = $message;

        // Redirect ke halaman detail menggunakan no_registrasi
        if ($success && isset($sarana['no_registrasi'])) {
          header('Location: /admin/sarana/elektronik/detail/' . urlencode($sarana['no_registrasi']));
        } else {
          header('Location: /admin/sarana/elektronik'); // Fallback
        }
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

  private function generateUniqueRegistrationNumber($conn, $barangId, $tanggal_pembelian, $barangList)
  {
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
      $randomNumber = str_pad(rand(1, 9999), 4, '0', STR_PAD_LEFT);
      $registrationNumber = "{$entityCode}-{$barangCode}-{$year}-{$randomNumber}";

      $stmt = $conn->prepare("SELECT COUNT(*) FROM sarana_elektronik WHERE no_registrasi = ?");
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

      // Hapus semua dokumen dan gambar terkait sebelum menghapus sarana utama
      // (Pastikan method ini ada dan bekerja dengan benar di model DokumenSaranaElektronik)
      DokumenSaranaElektronik::deleteAllBySaranaId($conn, $id);
      DokumenSaranaElektronik::deleteAllGambarBySaranaId($conn, $id);

      if (SaranaElektronik::deleteData($conn, $id)) {
        $_SESSION['success'] = 'Data sarana elektronik berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data sarana elektronik.';
      }
      header('Location: /admin/sarana/elektronik');
      exit();
    }
  }

  public function index()
  {
    global $conn;
    $saranaData = SaranaElektronik::getAllData($conn);
    $this->delete();

    $jenisList = [];
    if (!empty($saranaData)) {
      // Assuming 'barang' is the alias for jenis barang name from getAllData()
      // This matches how SaranaATKController prepares $jenisList
      $allJenis = array_column($saranaData, 'barang');
      $jenisList = array_unique($allJenis);
      sort($jenisList);
    }

    $this->renderView('index', [
      'saranaData' => $saranaData,
      'jenisList' => $jenisList, // Pass jenisList to the view
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
          // Redirect ke halaman detail menggunakan no_registrasi
          if ($saranaElektronikData && isset($saranaElektronikData['no_registrasi'])) {
            header('Location: /admin/sarana/elektronik/detail/' . urlencode($saranaElektronikData['no_registrasi']));
          } else {
            header('Location: /admin/sarana/elektronik'); // Fallback
          }
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

  public function downloadDokumen($id_dokumen)
  {
    global $conn;
    // Menggunakan DokumenSaranaElektronik::getDokumenById
    $dokumen = DokumenSaranaElektronik::getDokumenById($conn, $id_dokumen);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      $_SESSION['error'] = 'Dokumen tidak ditemukan.';
      $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/admin/sarana/elektronik'; // Default fallback
      // Coba redirect ke detail item jika aset_elektronik_id ada di dokumen
      if (isset($dokumen['aset_elektronik_id']) && ($saranaItem = SaranaElektronik::getById($conn, $dokumen['aset_elektronik_id'])) && isset($saranaItem['no_registrasi'])) {
        $redirect_url = '/admin/sarana/elektronik/detail/' . urlencode($saranaItem['no_registrasi']);
      }
      header('Location: ' . $redirect_url);
      exit();
    }

    $filePath = __DIR__ . '/../../storage/dokumen_sarana_elektronik/' . $dokumen['path_dokumen'];

    if (!file_exists($filePath)) {
      $_SESSION['error'] = 'File tidak ditemukan di server.';
      // Pastikan field 'aset_elektronik_id' ada di tabel dokumen_sarana_elektronik
      $redirect_url_error = $_SERVER['HTTP_REFERER'] ?? '/admin/sarana/elektronik';
      if (isset($dokumen['aset_elektronik_id']) && ($saranaItem = SaranaElektronik::getById($conn, $dokumen['aset_elektronik_id'])) && isset($saranaItem['no_registrasi'])) {
        $redirect_url_error = '/admin/sarana/elektronik/detail/' . urlencode($saranaItem['no_registrasi']);
      }
      header('Location: ' . $redirect_url_error);
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

  public function deleteDokumen()
  {
    if (isset($_GET['delete-dokumen']) && is_numeric($_GET['delete-dokumen'])) {
      global $conn;
      $id_dokumen = $_GET['delete-dokumen'];
      // Menggunakan DokumenSaranaElektronik::getDokumenById
      $dokumen = DokumenSaranaElektronik::getDokumenById($conn, $id_dokumen);

      if (!$dokumen) {
        $_SESSION['error'] = 'Dokumen tidak ditemukan untuk dihapus.';
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/admin/sarana/elektronik')); // Fallback ke list jika referer tidak ada
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

      // Redirect ke halaman detail menggunakan no_registrasi
      if ($aset_elektronik_id && ($saranaItem = SaranaElektronik::getById($conn, $aset_elektronik_id)) && isset($saranaItem['no_registrasi'])) {
        header('Location: /admin/sarana/elektronik/detail/' . urlencode($saranaItem['no_registrasi']));
      } else {
        header('Location: /admin/sarana/elektronik'); // Fallback
      }
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
      $nama_dokumen_gambar = $_POST['nama_dokumen'] ?? 'Gambar ' . time();
      $path_dokumen_gambar = '';
      $fileInputName = 'path_dokumen'; // Konsisten dengan form dokumen

      if (empty($_FILES[$fileInputName]['name'])) {
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
          // Redirect ke halaman detail menggunakan no_registrasi
          if ($saranaElektronikData && isset($saranaElektronikData['no_registrasi'])) {
            header('Location: /admin/sarana/elektronik/detail/' . urlencode($saranaElektronikData['no_registrasi']));
          } else {
            header('Location: /admin/sarana/elektronik'); // Fallback
          }
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
      $_SESSION['error'] = 'Gambar tidak ditemukan.'; // Tambahkan pesan error
      header("HTTP/1.0 404 Not Found");
      // Pertimbangkan redirect jika 404 tidak diinginkan untuk user experience
      // $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/admin/sarana/elektronik';
      // if(isset($dokumenGambar['aset_elektronik_id']) && ($item = SaranaElektronik::getById($conn, $dokumenGambar['aset_elektronik_id'])) && isset($item['no_registrasi'])) {
      //   $redirect_url = '/admin/sarana/elektronik/detail/' . urlencode($item['no_registrasi']);
      // }
      // header('Location: ' . $redirect_url);
      exit();
    }

    $filePath = __DIR__ . '/../../storage/dokumentasi_sarana_elektronik/' . $dokumenGambar['path_dokumen'];

    if (!file_exists($filePath)) {
      $_SESSION['error'] = 'File gambar tidak ada di server.'; // Tambahkan pesan error
      header("HTTP/1.0 404 Not Found");
      // Pertimbangkan redirect serupa seperti di atas
      // header('Location: ...');
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
        header('Location: ' . ($_SERVER['HTTP_REFERER'] ?? '/admin/sarana/elektronik')); // Fallback ke list jika referer tidak ada
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

      // Redirect ke halaman detail menggunakan no_registrasi
      if ($aset_elektronik_id && ($saranaItem = SaranaElektronik::getById($conn, $aset_elektronik_id)) && isset($saranaItem['no_registrasi'])) {
        header('Location: /admin/sarana/elektronik/detail/' . urlencode($saranaItem['no_registrasi']));
      } else {
        header('Location: /admin/sarana/elektronik'); // Fallback
      }
      exit();
    }
  }

  public function previewFileDokumen($id_dokumen)
  {
    global $conn;
    // Menggunakan DokumenSaranaElektronik::getDokumenById
    $dokumen = DokumenSaranaElektronik::getDokumenById($conn, $id_dokumen);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      $_SESSION['error'] = 'Dokumen tidak ditemukan untuk pratinjau.';
      // Redirect ke halaman detail Elektronik jika ID aset tersedia, jika tidak ke halaman list Elektronik
      $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/admin/sarana/elektronik';
      if (isset($dokumen['aset_elektronik_id']) && ($saranaItem = SaranaElektronik::getById($conn, $dokumen['aset_elektronik_id'])) && isset($saranaItem['no_registrasi'])) {
        $redirect_url = '/admin/sarana/elektronik/detail/' . urlencode($saranaItem['no_registrasi']);
      } else {
        // Jika no_registrasi tidak ditemukan, fallback ke list atau referer
        $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/admin/sarana/elektronik';
      }
      header('Location: ' . $redirect_url);
      exit();
    }

    $filePath = __DIR__ . '/../../storage/dokumen_sarana_elektronik/' . $dokumen['path_dokumen'];

    if (!file_exists($filePath)) {
      $_SESSION['error'] = 'File tidak ditemukan di server untuk pratinjau.';
      // Logika redirect yang sama seperti di atas
      $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/admin/sarana/elektronik';
      if (isset($dokumen['aset_elektronik_id']) && ($saranaItem = SaranaElektronik::getById($conn, $dokumen['aset_elektronik_id'])) && isset($saranaItem['no_registrasi'])) {
        $redirect_url = '/admin/sarana/elektronik/detail/' . urlencode($saranaItem['no_registrasi']);
      } else {
        // Jika no_registrasi tidak ditemukan, fallback ke list atau referer
        $redirect_url = $_SERVER['HTTP_REFERER'] ?? '/admin/sarana/elektronik';
      }
      header('Location: ' . $redirect_url);
      exit();
    }

    header('Content-Type: application/pdf'); // Asumsi file adalah PDF, sesuaikan jika perlu
    header('Content-Disposition: inline; filename="' . basename($filePath) . '"');
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
  }

  public function detail($no_registrasi_param) // Mengubah parameter ke no_registrasi
  {
    global $conn;
    // Mengambil data sarana berdasarkan no_registrasi
    // Asumsi SaranaElektronik::getByNoRegistrasi() sudah ada atau akan dibuat
    $detailData = SaranaElektronik::getByNoRegistrasi($conn, $no_registrasi_param);
    $BaseUrlQr = BaseUrlQr::BaseUrlQr();


    if (!$detailData) {
      $_SESSION['error'] = 'Data sarana elektronik tidak ditemukan dengan No. Registrasi: ' . htmlspecialchars($no_registrasi_param);
      header('Location: /admin/sarana/elektronik');
      exit();
    }

    // Menggunakan DokumenSaranaElektronik::getAllData dan DokumenSaranaElektronik::getAllDataGambar
    $dokumenAsetElektronik = DokumenSaranaElektronik::getAllData($conn, $detailData['id']) ?? [];
    $dokumenGambarElektronik = DokumenSaranaElektronik::getAllDataGambar($conn, $detailData['id']) ?? [];

    // Panggilan ini akan memeriksa query parameters dan melakukan aksi jika ada
    // Sesuai dengan pola di SaranaATKController dan logika router
    $this->deleteDokumen();
    $this->deleteDokumentasi();

    $this->renderView('detail', [
      'detailData' => $detailData,
      'dokumenSaranaElektronik' => $dokumenAsetElektronik,
      'dokumenGambarElektronik' => $dokumenGambarElektronik,
      'BaseUrlQr' =>  $BaseUrlQr

    ]);
  }

  public function downloadAllQr()
  {
    global $conn;
    $saranaData = SaranaElektronik::getAllData($conn);
    $BaseUrlQr = BaseUrlQr::BaseUrlQr();

    $this->renderView('downloadAll', [
      'saranaData' => $saranaData,
      'BaseUrlQr' =>  $BaseUrlQr
    ]);
  }
}
