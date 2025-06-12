<?php

require_once __DIR__ . '/BaseSaranaController.php';
require_once __DIR__ . '/../Models/SaranaBergerak.php';
require_once __DIR__ . '/../Models/DokumenSaranaBergerak.php';


class MasterSaranaBergerakController extends BaseSaranaController {

  protected function initializeSpecificProperties(): void {
    $this->saranaModelClass = SaranaBergerak::class;
    $this->dokumenModelClass = DokumenSaranaBergerak::class;
    $this->entityName = "sarana bergerak";
    $this->entityNameSingular = "SaranaBergerak"; // Used for method name generation e.g. storeDokumenSaranaBergerak
    $this->entityCodePrefix = "BGR";
    $this->baseViewPathFolder = "BarangBergerak";
    $this->mainRedirectPath = "/admin/sarana/bergerak";
    $this->documentStorageFolder = "dokumen_sarana_bergerak";
    $this->imageStorageFolder = "dokumentasi_sarana_bergerak";
    $this->kategoriIdFilter = 1;
    $this->dbTableName = "sarana_bergerak";
  }

  public function create() {
    $commonData = $this->getCommonViewData();


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
        $barang_id,
        $tanggal_pembelian,
        $commonData['allBarangList'] // Use allBarangList from common data
      );

      try {
        $success = SaranaBergerak::storeData(
          $this->conn,
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
        $this->setSessionMessage($success ? 'update' : 'error', $message);

        if ($success) {
          $this->redirect($this->mainRedirectPath);
        }
      } catch (PDOException $e) {
        $this->setSessionMessage('error', 'Error database: ' . $e->getMessage());
      }
    }

    $this->_renderView('create', array_merge($commonData, []));
  }

  public function update($id) {
    $saranaModel = $this->getSaranaModel();
    $sarana = $saranaModel::getById($this->conn, $id);
    $commonData = $this->getCommonViewData();
    // For update, we usually need the full barang list for the dropdown, not pre-filtered
    $commonData['barangList'] = Barang::getAllData($this->conn);

    if (!$sarana) {
      $this->setSessionMessage('error', 'Data sarana bergerak tidak ditemukan.');
      $this->redirect($this->mainRedirectPath);
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $postData = $this->getPostData([
        'kategori_barang_id',
        'barang_id',
        'kondisi_barang_id',
        'nama_detail_barang',
        'merk',
        'spesifikasi',
        'no_polisi',
        'sumber',
        'lokasi',
        'keterangan',
        'biaya_pembelian',
        'tanggal_pembelian',
        'status'
      ]);

      try {
        $success = SaranaBergerak::updateData(
          $this->conn,
          $id,
          $postData['kategori_barang_id'],
          $postData['barang_id'],
          $postData['kondisi_barang_id'],
          $sarana['no_registrasi'], // Keep existing registration number
          $postData['nama_detail_barang'],
          $postData['merk'],
          $postData['spesifikasi'],
          $postData['no_polisi'],
          $postData['sumber'],
          $postData['lokasi'],
          $postData['keterangan'],
          $postData['biaya_pembelian'],
          $postData['tanggal_pembelian'],
          $postData['status'] ?? $sarana['status'],
          $sarana['nama_peminjam'], // Pastikan parameter ini ada jika diperlukan oleh model
          $sarana['identitas_peminjam'], // Pastikan parameter ini ada jika diperlukan oleh model
          $sarana['no_hp_peminjam'], // Pastikan parameter ini ada jika diperlukan oleh model
          $sarana['tanggal_peminjaman'], // Sesuaikan dengan model
          $sarana['tanggal_pengembalian'] // Sesuaikan dengan model
        );

        $message = $success ? 'Data sarana bergerak berhasil diperbarui.' : 'Gagal memperbarui data sarana bergerak.';
        $this->setSessionMessage($success ? 'update' : 'error', $message);
        $this->redirect($this->mainRedirectPath . '?detail=' . $id);
      } catch (PDOException $e) {
        $this->setSessionMessage('error', 'Error database: ' . $e->getMessage());
      }
    }

    $this->_renderView('update', array_merge($commonData, ['sarana' => $sarana]));
  }

  public function index() {
    $saranaModel = $this->getSaranaModel();
    $saranaData = $saranaModel::getAllData($this->conn);
    parent::delete(); // Call delete from BaseSaranaController if applicable

    $this->_renderView('index', [
      'saranaData' => $saranaData,
    ]);
  }

  public function detail($id) {
    $saranaModel = $this->getSaranaModel();
    $dokumenModel = $this->getDokumenModel();

    $detailData = $saranaModel::getById($this->conn, $id);
    if (!$detailData) {
      $this->setSessionMessage('error', "Data {$this->entityName} tidak ditemukan.");
      $this->redirect($this->mainRedirectPath);
    }

    // Pass $id to filter documents/images for this specific asset
    $dokumenSarana = $dokumenModel::getAllData($this->conn, $id);
    $dokumenGambar = $dokumenModel::getAllDataGambar($this->conn, $id);

    if (!is_array($dokumenSarana)) {
      $dokumenSarana = [];
    }
    if (!is_array($dokumenGambar)) {
      $dokumenGambar = [];
    }

    // These are now handled by the router calling the specific methods in BaseSaranaController
    // $this->delete(); 
    // $this->deleteDokumentasi();
    // $this->deleteDokumen();

    $this->_renderView('detail', [
      'detailData' => $detailData,
      'dokumenSaranaBergerak' => $dokumenSarana, // Use the filtered data
      'dokumenGambar' => $dokumenGambar,       // Use the filtered data
      'BaseUrlQr' => BaseUrlQr::BaseUrlQr(),
    ]);
  }

  // download all qr
  public function downloadAllQr() {
    $saranaModel = $this->getSaranaModel();
    $saranaData = $saranaModel::getAllData($this->conn);

    $this->_renderView('downloadAll', [
      'saranaData' => $saranaData,
      'BaseUrlQr' => BaseUrlQr::BaseUrlQr(),
    ]);
  }
}
