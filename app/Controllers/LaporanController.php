<?php
require_once __DIR__ . '/../Models/User.php';
class LaporanController {
  private function renderView(string $view, $data = []) {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Laporan/{$view}.php";
  }

  public function totalDataPrasarana() {
    global $conn;
    $PrasaranaTanah = Tanah::getAllData($conn);
    $PrasaranaBangunan = Gedung::getAllData($conn);
    $PrasaranaRuang = Ruang::getAllData($conn);
    $PrasaranaLapang = Lapang::getAllData($conn);

    $this->renderView('Prasarana/index', [
      'PrasaranaTanah' => $PrasaranaTanah,
      'PrasaranaBangunan' => $PrasaranaBangunan,
      'PrasaranaRuang' => $PrasaranaRuang,
      'PrasaranaLapang' => $PrasaranaLapang,
    ]);
  }

  public function totalDataPeminjaman() {
    global $conn;
    $saranaBergerak = SaranaBergerak::getAllStatus($conn);
    $saranaMebelair = SaranaMebelair::getAllStatus($conn);
    $saranaATK = SaranaATK::getAllStatus($conn);
    $saranaElektronik = SaranaElektronik::getAllStatus($conn);

    $arrayMerge = array_merge(
      $saranaBergerak,
      $saranaMebelair,
      $saranaATK,
      $saranaElektronik
    );

    $this->renderView('BarangDipinjam/index', [
      'saranaData' => $arrayMerge
    ]);
  }
  public function totalDataBarangRusak() {
    global $conn;
    $saranaBergerak = SaranaBergerak::getAllData($conn);
    $saranaMebelair = SaranaMebelair::getAllData($conn);
    $saranaATK = SaranaATK::getAllData($conn);
    $saranaElektronik = SaranaElektronik::getAllData($conn);

    $arrayMerge = array_merge(
      $saranaBergerak,
      $saranaMebelair,
      $saranaATK,
      $saranaElektronik
    );

    $filteredArrayMerge = array_filter($arrayMerge, function ($item) {
      return isset($item['kondisi']) && (in_array($item['kondisi'], ["Rusak Ringan", "Rusak Berat"]));
    });

    $this->renderView('BarangRusak/index', [
      'saranaData' => $filteredArrayMerge
    ]);
  }
}
