<?php
require_once __DIR__ . '/../Models/SurveySaranaBergerak.php';
require_once __DIR__ . '/../Models/SaranaBergerak.php'; // Diperlukan untuk update data master
require_once __DIR__ . '/../Models/SaranaMebelair.php';
require_once __DIR__ . '/../Models/SaranaATK.php';
require_once __DIR__ . '/../Models/SaranaElektronik.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';  // Diperlukan untuk mendapatkan ID kondisi

class SurveySaranaBergerakController
{
  private function renderView(string $view, $data = [])
  {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/SurveySarana/SaranaBergerak/{$view}.php";
  }

  public function index()
  {
    global $conn;
    $SurveyData = SurveySaranaBergerak::getAllData($conn);

    $this->renderView('index', [
      'surveyData' => $SurveyData,
    ]);
  }
  public function create()
  {
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
        $success = SurveySaranaBergerak::storeData(
          $conn,
          $penanggung_jawab,
          $semester,
          $tahun_akademik,
          $tanggal_pengecekan,
          $lokasi_survey,

        );

        $message = $success ? 'Data survey sarana bergerak berhasil ditambahkan.' : 'Gagal menambahkan data survey sarana bergerak.';
        $_SESSION['update'] = $message;

        if ($success) {
          header('Location: /admin/survey/sarana/survey-barang');
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



  public function update($id)
  {
    global $conn;
    $survey = SurveySaranaBergerak::getById($conn, $id);
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if (!$survey) {
      $_SESSION['error'] = 'Data survey sarana bergerak tidak ditemukan.';
      header('Location: /admin/survey/sarana/survey-barang');
      exit();
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $penanggung_jawab = $_POST['penanggung_jawab'];
      $semester = $_POST['semester'];
      $tahun_akademik = $_POST['tahun_akademik'];
      $tanggal_pengecekan = $_POST['tanggal_pengecekan'];
      $lokasi_survey = $_POST['lokasi_survey'];

      try {
        $success = SurveySaranaBergerak::updateData(
          $conn,
          $id,
          $penanggung_jawab,
          $semester,
          $tahun_akademik,
          $tanggal_pengecekan,
          $lokasi_survey
        );

        $message = $success ? 'Data survey sarana bergerak berhasil diperbarui.' : 'Gagal memperbarui data survey sarana bergerak.';
        $_SESSION['update'] = $message;

        // Redirect back to the edit page to show the success message
        header('Location: /admin/survey/sarana/survey-barang');
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




  public function delete()
  {
    if (isset($_GET['delete']) && is_numeric($_GET['delete'])) {
      global $conn;
      $id = $_GET['delete'];
      if (SurveySaranaBergerak::deleteData($conn, $id)) {
        $_SESSION['success'] = 'Data survey sarana bergerak berhasil dihapus.';
      } else {
        $_SESSION['error'] = 'Gagal menghapus data survey sarana bergerak.';
      }
      header('Location: /admin/survey/sarana/survey-barang');;
      exit();
    }
  }
  public function deleteBarang($itemId)
  { // $itemId adalah ID dari data_survey_bb
    global $conn;

    // Ambil item untuk mendapatkan survey_id agar bisa redirect kembali ke halaman detail yang benar
    $item = SurveySaranaBergerak::getInventarisItemById($conn, $itemId);

    if (!$item) {
      $_SESSION['error'] = 'Data barang survey tidak ditemukan.';
      $redirectUrl = $_SERVER['HTTP_REFERER'] ?? '/admin/survey/sarana/survey-barang';
      header('Location: ' . $redirectUrl);
      exit();
    }

    $surveyId = $item['survey_sarana_bergerak_id'];

    if (SurveySaranaBergerak::deleteDataInventaris($conn, $itemId)) {
      $_SESSION['success'] = 'Data barang dari survey berhasil dihapus.';
    } else {
      $_SESSION['error'] = 'Gagal menghapus data barang dari survey.';
    }
    header('Location: /admin/survey/sarana/survey-barang?detail=' . $surveyId);
    exit();
  }


  // Data Barang
  public function tambahBarang($id)
  { // $id adalah survey_id
    global $conn;
    $SurveyData = SurveySaranaBergerak::getById($conn, $id);

    // Mengambil data dari semua model Sarana
    $barangBergerakList = SaranaBergerak::getAllData($conn);
    $barangMebelairList = SaranaMebelair::getAllData($conn);
    $barangATKList = SaranaATK::getAllData($conn);
    $barangElektronikList = SaranaElektronik::getAllData($conn);

    // Menggabungkan semua daftar barang menjadi satu dan menambahkan kategori asal
    $allAvailableItems = [];
    foreach (is_array($barangBergerakList) ? $barangBergerakList : [] as $item) {
      $item['kategori_asal'] = 'bergerak';
      $allAvailableItems[] = $item;
    }
    foreach (is_array($barangMebelairList) ? $barangMebelairList : [] as $item) {
      $item['kategori_asal'] = 'mebelair';
      $allAvailableItems[] = $item;
    }
    foreach (is_array($barangATKList) ? $barangATKList : [] as $item) {
      $item['kategori_asal'] = 'atk';
      $allAvailableItems[] = $item;
    }
    foreach (is_array($barangElektronikList) ? $barangElektronikList : [] as $item) {
      $item['kategori_asal'] = 'elektronik';
      $allAvailableItems[] = $item;
    }

    $kondisiBarangList = KondisiBarang::getAllData($conn); // Untuk dropdown pilih kondisi
    $lapangData = Lapang::getAllData($conn);
    $ruangData = Ruang::getAllData($conn);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
      $survey_sarana_bergerak_id_post = $_POST['survey_sarana_bergerak_id'] ?? null;
      $nama_barang_survey = $_POST['nama_barang'] ?? null; // Ini adalah nama_detail_barang
      $no_reg_survey = $_POST['no_registrasi'] ?? null;
      $kondisi_text_survey = $_POST['kondisi'] ?? null; // Ini adalah nama_kondisi (misal: "Baik")
      $lokasi_survey = $_POST['lokasi'] ?? null;
      $kategori_asal_survey = $_POST['kategori_asal_barang'] ?? null;

      if ($survey_sarana_bergerak_id_post != $id) {
        $_SESSION['error'] = 'ID Survey tidak valid pada request.';
        header('Location: /admin/survey/sarana/survey-barang?detail=' . $id);
        exit();
      }

      $updateOriginalSuccess = false;
      $storeHistorySuccess = false;

      // 1. Update data master Sarana berdasarkan kategori asal
      if ($no_reg_survey && $kondisi_text_survey && $lokasi_survey && $kategori_asal_survey) {
        $kondisi_barang_id_baru = KondisiBarang::getIdByName($conn, $kondisi_text_survey);

        if ($kondisi_barang_id_baru !== false) {
          switch ($kategori_asal_survey) {
            case 'bergerak':
              $updateOriginalSuccess = SaranaBergerak::updateKondisiLokasiByNoReg(
                $conn,
                $no_reg_survey,
                $kondisi_barang_id_baru,
                $lokasi_survey,
                $_POST['tanggal_survey_terakhir'] ?? null // update tanggal_survey_terakhir
              );
              break;
            case 'mebelair':
              $updateOriginalSuccess = SaranaMebelair::updateKondisiLokasiByNoReg(
                $conn,
                $no_reg_survey,
                $kondisi_barang_id_baru,
                $lokasi_survey,
                $_POST['tanggal_survey_terakhir'] ?? null // update tanggal_data_survey
              );
              break;
            case 'atk':
              $updateOriginalSuccess = SaranaATK::updateKondisiLokasiByNoReg(
                $conn,
                $no_reg_survey,
                $kondisi_barang_id_baru,
                $lokasi_survey,
                $_POST['tanggal_survey_terakhir'] ?? null // update tanggal_data_survey
              );
              break;
            case 'elektronik':
              $updateOriginalSuccess = SaranaElektronik::updateKondisiLokasiByNoReg(
                $conn,
                $no_reg_survey,
                $kondisi_barang_id_baru,
                $lokasi_survey,
                $_POST['tanggal_survey_terakhir'] ?? null // update tanggal_data_survey
              );
              break;
            default:
              error_log("Kategori asal barang tidak dikenal: " . $kategori_asal_survey . " untuk No.Reg: " . $no_reg_survey);
              $_SESSION['error_detail'] = "Kategori asal barang ('$kategori_asal_survey') tidak valid untuk pembaruan.";
              break;
          }

          if (!$updateOriginalSuccess) {
            // Pesan error spesifik jika kategori dikenal tapi update gagal
            if (in_array($kategori_asal_survey, ['bergerak', 'mebelair', 'atk', 'elektronik'])) {
              error_log("Gagal memperbarui data master barang kategori '$kategori_asal_survey': " . $no_reg_survey);
            }
          }
        } else {
          error_log("ID Kondisi tidak ditemukan untuk nama kondisi: " . $kondisi_text_survey);
          $_SESSION['error_detail'] = "Kondisi barang '$kondisi_text_survey' tidak valid.";
        }
      }

      // 2. Simpan riwayat ke data_survey_bb
      try {
        $tanggal_survey_terakhir = $_POST['tanggal_survey_terakhir'] ?? null;
        $storeHistorySuccess = SurveySaranaBergerak::storeDataInventaris(
          $conn,
          $id, // Gunakan $id dari parameter fungsi (survey_id)
          $nama_barang_survey,
          $no_reg_survey,
          $kondisi_text_survey, // Simpan nama kondisi sebagai teks
          $lokasi_survey,
          $tanggal_survey_terakhir // Kirim ke model
        );

        if ($storeHistorySuccess) {
          $message = 'Data barang survey berhasil ditambahkan ke riwayat.';
          if ($updateOriginalSuccess) {
            $message .= ' Data master barang juga berhasil diperbarui.';
          } elseif ($no_reg_survey && $kondisi_text_survey && $lokasi_survey && $kategori_asal_survey && !isset($_SESSION['error_detail'])) {
            $message .= ' Namun, pembaruan data master barang gagal.';
          }
          $_SESSION['update'] = $message;
          header('Location: /admin/survey/sarana/survey-barang?detail=' . $id);
          exit();
        }
      } catch (PDOException $e) {
        $_SESSION['error'] = 'Error database: ' . $e->getMessage();
      }
    }
    // Kirim data yang benar ke view
    $this->renderView('TambahBarang/create', [
      "kondisiBarang" => $kondisiBarangList, // Daftar semua kondisi barang
      "lapangData" => $lapangData,
      "ruangData" => $ruangData,
      "barangBergerak" => $allAvailableItems, // Mengirimkan daftar gabungan barang
      "surveyData" => $SurveyData,
    ]);
  }





  public function detail($id)
  {
    global $conn;

    $surveyData = SurveySaranaBergerak::getById($conn, $id);

    if (!$surveyData) {
      $_SESSION['error'] = 'Data survey sarana bergerak tidak ditemukan.';
      header('Location: /admin/survey/sarana/survey-barang');
      exit();
    }

    // Mengambil item inventaris yang terkait langsung dengan survey ini dari tabel data_survey_bb
    $surveyInventarisItems = SurveySaranaBergerak::getAllDataInventaris($conn, $id);

    $this->renderView('detail', [
      'surveyData' => $surveyData,
      'surveyInventarisItems' => $surveyInventarisItems, // Variabel ini yang digunakan di detail.php
    ]);
  }
}
