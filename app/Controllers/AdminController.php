<?php
require_once __DIR__ . '/../Models/User.php';
class AdminController {
  private function renderView(string $view, $data = []) {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Dashboard/{$view}.php";
  }

  public function index() {
    global $conn;
    $PrasaranaTanah = Tanah::getAllData($conn);
    $PrasaranaBangunan = Gedung::getAllData($conn);
    $PrasaranaRuang = Ruang::getAllData($conn);
    $PrasaranaLapang = Lapang::getAllData($conn);

    // Sarana
    $SaranaBergerak = SaranaBergerak::getAllData($conn);
    $SaranaMebelair = SaranaMebelair::getAllData($conn);
    $SaranaATK = SaranaATK::getAllData($conn);
    $SaranaElektronik = SaranaElektronik::getAllData($conn);

    $totalTanah = count($PrasaranaTanah);
    $totalGedung = count($PrasaranaBangunan);
    $totalRuang = count($PrasaranaRuang);
    $totalLapangan = count($PrasaranaLapang);

    $totalSaranaBergerak = count($SaranaBergerak);
    $totalSaranaMebelair = count($SaranaMebelair);
    $totalSaranaATK = count($SaranaATK);
    $totalSaranaElektronik = count($SaranaElektronik);

    $totalPrasaranaData = [
      'tanah' => $totalTanah,
      'gedung' => $totalGedung,
      'ruang' => $totalRuang,
      'lapangan' => $totalLapangan,
      'total' => $totalTanah + $totalGedung + $totalRuang + $totalLapangan,
    ];

    $totalSaranaData = [
      'bergerak' => $totalSaranaBergerak,
      'mebelair' => $totalSaranaMebelair,
      'atk' => $totalSaranaATK,
      'elektronik' => $totalSaranaElektronik,
      'total' => $totalSaranaBergerak + $totalSaranaMebelair + $totalSaranaATK + $totalSaranaElektronik,
    ];

    $this->renderView('index', [
      'totalPrasaranaData' => $totalPrasaranaData,
      'totalSaranaData' => $totalSaranaData,

    ]);
  }


  public function devView() {
    global $conn;
    $saranaData = SaranaBergerak::getAllData($conn);
    $this->renderView('test', [
      'saranaData' => $saranaData,
    ]);
  }
}
