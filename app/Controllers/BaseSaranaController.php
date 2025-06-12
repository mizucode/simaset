<?php

require_once __DIR__ . '/BaseController.php';
require_once __DIR__ . '/../Models/KategoriBarang.php';
require_once __DIR__ . '/../Models/Barang.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/Ruang.php';
require_once __DIR__ . '/../Models/BaseUrlQr.php';

abstract class BaseSaranaController extends BaseController {
  protected string $saranaModelClass;
  protected string $dokumenModelClass;
  protected string $entityName; // e.g., "sarana bergerak"
  protected string $entityNameSingular; // e.g., "SaranaBergerak"
  protected string $entityCodePrefix;
  protected string $baseViewPathFolder; // e.g., "BarangBergerak" (folder inside Pages)
  protected string $mainRedirectPath;
  protected string $documentStorageFolder;
  protected string $imageStorageFolder;
  protected int $kategoriIdFilter;
  protected string $dbTableName; // e.g., "sarana_bergerak"

  public function __construct(PDO $conn) {
    parent::__construct($conn);
    $this->initializeSpecificProperties();
  }

  // Child classes must implement this to set their specific properties
  abstract protected function initializeSpecificProperties(): void;

  protected function getSaranaModel() {
    return $this->saranaModelClass;
  }

  protected function getDokumenModel() {
    return $this->dokumenModelClass;
  }

  protected function _renderView(string $view, array $data = []) {
    parent::renderView("Pages/{$this->baseViewPathFolder}", $view, $data);
  }

  protected function getCommonViewData(): array {
    $barangList = Barang::getAllData($this->conn);
    $filteredBarangList = array_filter($barangList, function ($barang) {
      return $barang['kategori_id'] == $this->kategoriIdFilter;
    });

    return [
      'kategoriList' => KategoriBarang::getAllData($this->conn),
      'barangList' => $filteredBarangList, // Already filtered
      'allBarangList' => $barangList, // For registration number generation
      'kondisiList' => KondisiBarang::getAllData($this->conn),
      'lapangData' => Lapang::getAllData($this->conn),
      'ruangData' => Ruang::getAllData($this->conn),
      'BaseUrlQr' => BaseUrlQr::BaseUrlQr(),
    ];
  }

  protected function generateUniqueRegistrationNumber(string $barangId, ?string $tanggal_pembelian, array $allBarangList): string {
    $year = $tanggal_pembelian ? date('Y', strtotime($tanggal_pembelian)) : date('Y');
    $barangCode = $this->entityCodePrefix;

    foreach ($allBarangList as $barang) {
      if ($barang['id'] == $barangId) {
        $barangCode = $barang['kode_barang'];
        break;
      }
    }

    do {
      $randomNumber = str_pad(rand(1, 999), 3, '0', STR_PAD_LEFT);
      $registrationNumber = "{$this->entityCodePrefix}-{$barangCode}-{$year}-{$randomNumber}";

      $stmt = $this->conn->prepare("SELECT COUNT(*) FROM {$this->dbTableName} WHERE no_registrasi = ?");
      $stmt->execute([$registrationNumber]);
      $exists = $stmt->fetchColumn() > 0;
    } while ($exists);

    return $registrationNumber;
  }

  public function dokumen($saranaId) {
    $saranaModel = $this->getSaranaModel();
    $dokumenModel = $this->getDokumenModel();

    $entityData = $saranaModel::getById($this->conn, $saranaId);
    if (!$entityData) {
      $this->setSessionMessage('error', "Data {$this->entityName} tidak ditemukan.");
      $this->redirect($this->mainRedirectPath);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $aset_id_field_name = 'aset_' . strtolower(str_replace(' ', '_', $this->entityNameSingular)) . '_id';
      $aset_id = $_POST[$aset_id_field_name] ?? $saranaId;
      $nama_dokumen = $_POST['nama_dokumen'];
      $path_dokumen = '';

      if (!empty($_FILES['path_dokumen']['name'])) {
        $uploadDir = __DIR__ . '/../../storage/' . $this->documentStorageFolder . '/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $originalName = basename($_FILES['path_dokumen']['name']);
        $sanitizedName = preg_replace("/[^a-zA-Z0-9.\-\_]/", "_", $originalName);
        $fileName = time() . '_' . $sanitizedName;
        $targetFile = $uploadDir . $fileName;

        if (move_uploaded_file($_FILES['path_dokumen']['tmp_name'], $targetFile)) {
          $path_dokumen = $fileName;
        } else {
          $this->setSessionMessage('error', 'Gagal mengupload file dokumen. Error: ' . $_FILES['path_dokumen']['error']);
          $this->_renderView('Dokumen/create', ['entityData' => $entityData]);
          return;
        }
      } else {
        $this->setSessionMessage('error', 'File dokumen tidak boleh kosong.');
        $this->_renderView('Dokumen/create', ['dokumenData' => $entityData]);
        return;
      }

      try {
        $storeMethod = 'storeDokumen' . $this->entityNameSingular;
        $success = $dokumenModel::$storeMethod($this->conn, $aset_id, $nama_dokumen, $path_dokumen);
        $this->setSessionMessage($success ? 'update' : 'error', $success ? "Dokumen {$this->entityName} berhasil ditambahkan." : "Gagal menambahkan dokumen.");
        if ($success) $this->redirect($this->mainRedirectPath . '?detail=' . $saranaId);
      } catch (PDOException $e) {
        $this->setSessionMessage('error', 'Error database: ' . $e->getMessage());
      }
    }
    $this->_renderView('Dokumen/create', ['entityData' => $entityData]);
  }

  public function downloadDokumen($dokumenId) {
    $dokumenModel = $this->getDokumenModel();
    $dokumen = $dokumenModel::getDokumenById($this->conn, $dokumenId);

    if (!$dokumen || empty($dokumen['path_dokumen'])) {
      $this->setSessionMessage('error', 'Dokumen tidak ditemukan.');
      $this->redirect($this->mainRedirectPath);
    }

    $filePath = __DIR__ . '/../../storage/' . $this->documentStorageFolder . '/' . $dokumen['path_dokumen'];
    if (!file_exists($filePath)) {
      $this->setSessionMessage('error', 'File tidak ditemukan di server.');
      $this->redirect($this->mainRedirectPath . (isset($dokumen['aset_' . strtolower(str_replace(' ', '_', $this->entityNameSingular)) . '_id']) ? '?detail=' . $dokumen['aset_' . strtolower(str_replace(' ', '_', $this->entityNameSingular)) . '_id'] : ''));
    }
    // Headers for download
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
    $dokumenModel = $this->getDokumenModel();
    if (isset($_GET['delete-dokumen']) && is_numeric($_GET['delete-dokumen'])) {
      $dokumenId = $_GET['delete-dokumen'];
      $dokumen = $dokumenModel::getDokumenById($this->conn, $dokumenId);
      $assetIdKey = 'aset_' . strtolower(str_replace(' ', '_', $this->entityNameSingular)) . '_id';
      $assetId = $dokumen[$assetIdKey] ?? null;

      if ($dokumen && !empty($dokumen['path_dokumen'])) {
        $filePath = __DIR__ . '/../../storage/' . $this->documentStorageFolder . '/' . $dokumen['path_dokumen'];
        if (file_exists($filePath)) unlink($filePath);
      }

      if ($dokumenModel::delete($this->conn, $dokumenId)) {
        $this->setSessionMessage('success', 'Dokumen berhasil dihapus.');
      } else {
        $this->setSessionMessage('error', 'Gagal menghapus data dokumen.');
      }
      $this->redirect($this->mainRedirectPath . ($assetId ? '?detail=' . $assetId : ''));
    }
  }

  public function dokumenGambar($saranaId) {
    $saranaModel = $this->getSaranaModel();
    $dokumenModel = $this->getDokumenModel();
    $entityData = $saranaModel::getById($this->conn, $saranaId);
    if (!$entityData) {
      $this->setSessionMessage('error', "Data {$this->entityName} tidak ditemukan.");
      $this->redirect($this->mainRedirectPath);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $aset_id_field_name = 'aset_' . strtolower(str_replace(' ', '_', $this->entityNameSingular)) . '_id';
      $aset_id = $_POST[$aset_id_field_name] ?? $saranaId;
      $nama_dokumen = $_POST['nama_dokumen'] ?? 'Gambar ' . time();
      $path_dokumen = '';

      if (!empty($_FILES['path_dokumen']['name'])) {
        $uploadDir = __DIR__ . '/../../storage/' . $this->imageStorageFolder . '/';
        if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

        $originalName = basename($_FILES['path_dokumen']['name']);
        $sanitizedName = preg_replace("/[^a-zA-Z0-9.\-\_]/", "_", $originalName);
        $fileName = time() . '_' . $sanitizedName;
        $targetFile = $uploadDir . $fileName;

        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
        if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
          $this->setSessionMessage('error', 'Hanya file gambar (JPG, JPEG, PNG, GIF, WEBP) yang diizinkan.');
          $this->_renderView('Dokumen/createFoto', ['entityData' => $entityData]);
          return;
        }
        if (move_uploaded_file($_FILES['path_dokumen']['tmp_name'], $targetFile)) {
          $path_dokumen = $fileName;
        } else {
          $this->setSessionMessage('error', 'Gagal mengupload file gambar. Error: ' . $_FILES['path_dokumen']['error']);
          $this->_renderView('Dokumen/createFoto', ['entityData' => $entityData]);
          return;
        }
      } else {
        $this->setSessionMessage('error', 'File gambar tidak boleh kosong.');
        $this->_renderView('Dokumen/createFoto', ['entityData' => $entityData]);
        return;
      }

      try {
        $storeMethod = 'storeDokumentasi' . $this->entityNameSingular;
        $success = $dokumenModel::$storeMethod($this->conn, $aset_id, $nama_dokumen, $path_dokumen);
        $this->setSessionMessage($success ? 'update' : 'error', $success ? "Gambar dokumentasi {$this->entityName} berhasil ditambahkan." : "Gagal menambahkan gambar.");
        if ($success) $this->redirect($this->mainRedirectPath . '?detail=' . $saranaId);
      } catch (PDOException $e) {
        $this->setSessionMessage('error', 'Error database: ' . $e->getMessage());
      }
    }
    $this->_renderView('Dokumen/createFoto', ['entityData' => $entityData]);
  }

  public function previewDokumen($gambarId) {
    $dokumenModel = $this->getDokumenModel();
    $dokumenGambar = $dokumenModel::getDokumenGambarById($this->conn, $gambarId);

    if (!$dokumenGambar || empty($dokumenGambar['path_dokumen'])) {
      header("HTTP/1.0 404 Not Found");
      exit('Gambar tidak ditemukan.');
    }
    $filePath = __DIR__ . '/../../storage/' . $this->imageStorageFolder . '/' . $dokumenGambar['path_dokumen'];
    if (!file_exists($filePath)) {
      header("HTTP/1.0 404 Not Found");
      exit('File gambar tidak ada di server.');
    }
    $mimeType = mime_content_type($filePath);
    if (!in_array($mimeType, ['image/jpeg', 'image/png', 'image/gif', 'image/webp'])) {
      header("HTTP/1.0 403 Forbidden");
      exit('Tipe file tidak diizinkan.');
    }
    header('Content-Type: ' . $mimeType);
    header('Content-Length: ' . filesize($filePath));
    readfile($filePath);
    exit;
  }

  public function deleteDokumentasi() {
    $dokumenModel = $this->getDokumenModel();
    if (isset($_GET['delete-gambar']) && is_numeric($_GET['delete-gambar'])) {
      $gambarId = $_GET['delete-gambar'];
      $gambar = $dokumenModel::getDokumenGambarById($this->conn, $gambarId);
      $assetIdKey = 'aset_' . strtolower(str_replace(' ', '_', $this->entityNameSingular)) . '_id';
      $assetId = $gambar[$assetIdKey] ?? null;

      if ($gambar && !empty($gambar['path_dokumen'])) {
        $filePath = __DIR__ . '/../../storage/' . $this->imageStorageFolder . '/' . $gambar['path_dokumen'];
        if (file_exists($filePath)) unlink($filePath);
      }

      if ($dokumenModel::deleteGambar($this->conn, $gambarId)) {
        $this->setSessionMessage('success', 'Gambar dokumentasi berhasil dihapus.');
      } else {
        $this->setSessionMessage('error', 'Gagal menghapus data gambar dokumentasi.');
      }
      $this->redirect($this->mainRedirectPath . ($assetId ? '?detail=' . $assetId : ''));
    }
  }

  public function delete() {
    $saranaModel = $this->getSaranaModel();
    if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
      $id = $_GET['delete'];
      if ($saranaModel::deleteData($this->conn, $id)) {
        $this->setSessionMessage('success', "Data {$this->entityName} berhasil dihapus.");
      } else {
        $this->setSessionMessage('error', "Gagal menghapus data {$this->entityName}.");
      }
      $this->redirect($this->mainRedirectPath);
    }
  }
}
