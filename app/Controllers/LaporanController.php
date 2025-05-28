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
}
