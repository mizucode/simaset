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

    // Mengambil data sarana yang berstatus 'Dipinjam' dari masing-masing model
    $saranaBergerakDipinjam = SaranaBergerak::getAllStatus($conn);
    $saranaMebelairDipinjam = SaranaMebelair::getAllStatus($conn);
    $saranaATKDipinjam = SaranaATK::getAllStatus($conn);
    $saranaElektronikDipinjam = SaranaElektronik::getAllStatus($conn);

    // Menggabungkan semua data sarana yang dipinjam
    $filteredSaranaDenganStatusDipinjam = array_merge(
      $saranaBergerakDipinjam,
      $saranaMebelairDipinjam,
      $saranaATKDipinjam,
      $saranaElektronikDipinjam
    );

    $arrayMerge = array_merge(
      $SaranaBergerak,
      $SaranaMebelair,
      $SaranaATK,
      $SaranaElektronik
    );

    $saranaRusak = array_filter($arrayMerge, function ($item) {
      return isset($item['kondisi']) && (in_array($item['kondisi'], ["Rusak Ringan", "Rusak Berat"]));
    });

    // Prepare data for Kondisi Aset Chart
    $kondisiAsetChartData = [
      'Baik' => 0,
      'Rusak Ringan' => 0,
      'Rusak Berat' => 0,
      'Hilang' => 0, // Assuming 'Hilang' is a potential condition or should be shown as 0
    ];

    foreach ($arrayMerge as $item) { // $arrayMerge contains all sarana items
      if (isset($item['kondisi'])) {
        if (array_key_exists($item['kondisi'], $kondisiAsetChartData)) {
          $kondisiAsetChartData[$item['kondisi']]++;
        }
      }
    }

    $totalSaranaDenganStatusDipinjam = count($filteredSaranaDenganStatusDipinjam);
    $totalSaranaRusak = count($saranaRusak);
    $this->renderView('index', [
      'totalPrasaranaData' => $totalPrasaranaData,
      'totalSaranaData' => $totalSaranaData,
      'totalSaranaDipinjam' => $totalSaranaDenganStatusDipinjam, // Mengirim data yang sudah difilter ke view
      'totalSaranaRusak' => $totalSaranaRusak,
      'kondisiAsetChartData' => $kondisiAsetChartData,
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
