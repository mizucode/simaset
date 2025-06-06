<?php
require_once __DIR__ . '/../Models/SurveySaranaBergerak.php';
require_once __DIR__ . '/../Models/SurveySaranaATK.php';

class SurveySaranaATKController {
  private function renderView(string $view, $data = []) {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/SurveySarana/SaranaATK/{$view}.php";
  }

  public function index() {
    global $conn;
    $SurveyData = SurveySaranaATK::getAllData($conn);

    $this->renderView('index', [
      'surveyData' => $SurveyData,
    ]);
  }
  public function create() {
    global $conn;
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $penanggung_jawab = $_POST['penanggung_jawab'] ?? null;
      $semester = $_POST['semester'] ?? null;
      $tahun_akademik = $_POST['tahun_akademik'] ?? null;
      $tanggal_pengecekan = $_POST['tanggal_pengecekan'] ?? null;
      $lokasi_survey = $_POST['lokasi_survey'] ?? null;

      try {
        $success = SurveySaranaATK::storeData(
          $conn,
          $penanggung_jawab,
          $semester,
          $tahun_akademik,
          $tanggal_pengecekan,
          $lokasi_survey,

        );

        $message = $success ? 'Data survey sarana atk berhasil ditambahkan.' : 'Gagal menambahkan Data survey sarana atk.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/survey/sarana/sarana-atk'); // Path redirect disesuaikan
          exit();
        }
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database: ' . $e->getMessage();
      }
    }

    $this->renderView('create', [
      "lapangData" => $lapangData,
      "ruangData" => $ruangData,
    ]);
  }



  public function update($id) {
    global $conn;
    $survey = SurveySaranaATK::getById($conn, $id);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if (!$survey) {
      $_SESSION['error'] = 'Data survey sarana atk tidak ditemukan.';
      header('Location: /admin/survey/sarana/sarana-atk');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $penanggung_jawab = $_POST['penanggung_jawab'];
      $semester = $_POST['semester'];
      $tahun_akademik = $_POST['tahun_akademik'];
      $tanggal_pengecekan = $_POST['tanggal_pengecekan'];
      $lokasi_survey = $_POST['lokasi_survey'];

      try {
        $success = SurveySaranaATK::updateData(
          $conn,
          $id,
          $penanggung_jawab,
          $semester,
          $tahun_akademik,
          $tanggal_pengecekan,
          $lokasi_survey
        );

        $message = $success ? 'Data survey sarana atk berhasil diperbarui.' : 'Gagal memperbarui Data survey sarana atk.';
        $_SESSION['update'] = $message;

        // Redirect back to the edit page to show the success message
        header('Location: /admin/survey/sarana/sarana-atk');
        exit();
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database: ' . $e->getMessage();
      }
    }

    $this->renderView('update', [
      'survey' => $survey,
      "lapangData" => $lapangData,
      "ruangData" => $ruangData,
    ]);
  }




  public function delete() {
    if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
      global $conn;
      $id = $_GET['delete'];
      if (SurveySaranaATK::deleteData($conn, $id)) {
        $_SESSION['success'] = 'Data survey sarana atk berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus Data survey sarana atk.';
      }
      header('Location: /admin/survey/sarana/sarana-atk');;
      exit();
    }
  }
  public function deleteBarang($itemId) { // $itemId adalah ID dari data_survey_bb
    global $conn;

    // Ambil item untuk mendapatkan survey_id agar bisa redirect kembali ke halaman detail yang benar
    $item = SurveySaranaATK::getInventarisItemById($conn, $itemId);

    if (!$item) {
      $_SESSION['error'] = 'Data barang survey tidak ditemukan.';
      $redirectUrl = $_SERVER['HTTP_REFERER'] ?? '/admin/survey/sarana/sarana-atk';
      header('Location: ' . $redirectUrl);
      exit();
    }

    $surveyId = $item['survey_sarana_bergerak_id']; // Asumsi kolom ini ada di tabel data_survey_bb

    if (SurveySaranaATK::deleteDataInventaris($conn, $itemId)) {
      $_SESSION['success'] = 'Data barang dari survey berhasil dihapus.';
    } else {
      $_SESSION['error'] = 'Gagal menghapus data barang dari survey.';
    }
    header('Location: /admin/survey/sarana/sarana-atk?detail=' . $surveyId);
    exit();
  }


  // Data Barang
  public function tambahBarang($id) {
    global $conn;
    $SurveyData = SurveySaranaATK::getById($conn, $id);
    $barangBergerak = SaranaATK::getAllData($conn);
    $kondisiBarang = KondisiBarang::getAllData($conn);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $survey_sarana_bergerak_id = $_POST['survey_sarana_bergerak_id'] ?? null;
      $nama_barang = $_POST['nama_barang'] ?? null;
      $no_reg = $_POST['no_registrasi'] ?? null;
      $kondisi = $_POST['kondisi'] ?? null;
      $lokasi = $_POST['lokasi'] ?? null;

      try {
        $success = SurveySaranaATK::storeDataInventaris(
          $conn,
          $survey_sarana_bergerak_id,
          $nama_barang,
          $no_reg,
          $kondisi,
          $lokasi,

        );

        $message = $success ? 'Data survey sarana atk berhasil ditambahkan.' : 'Gagal menambahkan Data survey sarana atk.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/survey/sarana/sarana-atk?detail=' . $id);
          exit();
        }
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database: ' . $e->getMessage();
      }
    }

    $this->renderView('TambahBarang/create', [
      "kondisiBarang" => $kondisiBarang,
      "lapangData" => $lapangData,
      "ruangData" => $ruangData,
      "barangBergerak" => $barangBergerak,
      "surveyData" => $SurveyData,
    ]);
  }





  public function detail($id) {
    global $conn;

    $SurveyData = SurveySaranaATK::getById($conn, $id);
    $DataSurvey = SurveySaranaATK::getAllDataInventaris($conn, $id);

    // Pemanggilan deleteBarang() dan delete() di sini tidak diperlukan dan bisa menyebabkan masalah.
    // Router akan menangani action delete berdasarkan query parameter.
    // $this->deleteBarang(); // Hapus baris ini
    // $this->delete();       // Hapus baris ini

    $this->renderView('detail', [
      'surveyData' => $SurveyData,
      'dataSurvey' => $DataSurvey,

    ]);
  }
}
