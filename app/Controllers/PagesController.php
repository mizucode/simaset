<?php
require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/KondisiBarang.php';

class PagesController
{
  private function renderView(string $view, $data = [])
  {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Login/{$view}.php";
  }

  public function index()
  {
    global $conn;
    // Prasarana
    $PrasaranaTanah = Tanah::getAllData($conn);
    $PrasaranaBangunan = Gedung::getAllData($conn);
    $PrasaranaRuang = Ruang::getAllData($conn);
    $PrasaranaLapang = Lapang::getAllData($conn);
    // Sarana
    $SaranaBergerak = SaranaBergerak::getAllData($conn);
    $SaranaMebelair = SaranaMebelair::getAllData($conn);
    $SaranaATK = SaranaATK::getAllData($conn);
    $SaranaElektronik = SaranaElektronik::getAllData($conn);
    // Total
    $totalPrasaranaData = [
      'tanah' => count($PrasaranaTanah),
      'gedung' => count($PrasaranaBangunan),
      'ruang' => count($PrasaranaRuang),
      'lapangan' => count($PrasaranaLapang),
      'total' => count($PrasaranaTanah) + count($PrasaranaBangunan) + count($PrasaranaRuang) + count($PrasaranaLapang),
    ];
    $totalSaranaData = [
      'bergerak' => count($SaranaBergerak),
      'mebelair' => count($SaranaMebelair),
      'atk' => count($SaranaATK),
      'elektronik' => count($SaranaElektronik),
      'total' => count($SaranaBergerak) + count($SaranaMebelair) + count($SaranaATK) + count($SaranaElektronik),
    ];
    // Barang Dipinjam
    $totalSaranaDipinjam = count(SaranaBergerak::getAllStatus($conn)) + count(SaranaMebelair::getAllStatus($conn)) + count(SaranaATK::getAllStatus($conn)) + count(SaranaElektronik::getAllStatus($conn));
    // Barang Rusak (Perlu Perhatian)
    $totalSaranaRusak = 0;
    foreach ([$SaranaBergerak, $SaranaMebelair, $SaranaATK, $SaranaElektronik] as $saranaList) {
      foreach ($saranaList as $item) {
        if (isset($item['kondisi']) && (stripos($item['kondisi'], 'rusak') !== false || stripos($item['kondisi'], 'hilang') !== false)) {
          $totalSaranaRusak++;
        }
      }
    }
    // Statistik User
    $stmtUser = $conn->query("SELECT COUNT(*) as total FROM user");
    $totalUser = $stmtUser->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    // Statistik Peminjaman Hari Ini
    $today = date('Y-m-d');
    $stmtPinjam = $conn->prepare("SELECT COUNT(*) as total FROM transaksi_peminjaman WHERE DATE(tanggal_peminjaman) = :today");
    $stmtPinjam->execute(['today' => $today]);
    $totalPinjamHariIni = $stmtPinjam->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    // Statistik Pengembalian Hari Ini
    $stmtKembali = $conn->prepare("SELECT COUNT(*) as total FROM transaksi_pengembalian WHERE DATE(tanggal_pengembalian) = :today");
    $stmtKembali->execute(['today' => $today]);
    $totalKembaliHariIni = $stmtKembali->fetch(PDO::FETCH_ASSOC)['total'] ?? 0;
    // Aktivitas Terbaru (5 terakhir)
    require_once __DIR__ . '/../Models/TransaksiBarang.php';
    $recentActivities = array_slice(TransaksiBarang::getAllDataDate($conn), 0, 5);
    // Link laporan sesuai aside
    $linkLaporan = [
      'prasarana' => '/admin/laporan/total-data-prasarana',
      'sarana' => '/admin/laporan/total-data-sarana',
      'dipinjam' => '/admin/laporan/barang-dipinjam',
      'rusak' => '/admin/laporan/kondisi-barang',
    ];
    $this->renderView('index', [
      'totalPrasaranaData' => $totalPrasaranaData,
      'totalSaranaData' => $totalSaranaData,
      'totalSaranaDipinjam' => $totalSaranaDipinjam,
      'totalSaranaRusak' => $totalSaranaRusak,
      'totalUser' => $totalUser,
      'totalPinjamHariIni' => $totalPinjamHariIni,
      'totalKembaliHariIni' => $totalKembaliHariIni,
      'recentActivities' => $recentActivities,
      'linkLaporan' => $linkLaporan,
    ]);
  }


  public function informasi()
  {
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

    // Filter array untuk hanya menyertakan item dengan status 'Dipinjam'
    $filteredArrayMerge = array_filter($arrayMerge, function ($item) {
      return isset($item['status']) && $item['status'] === 'Dipinjam';
    });

    $filteredArrayMergeTersedia = array_filter($arrayMerge, function ($item) {
      return isset($item['status']) && $item['status'] === 'Tersedia';
    });

    $this->renderView('informasi', [
      'saranaDataPinjam' => $filteredArrayMerge,
      'saranaDataTersedia' => $filteredArrayMergeTersedia
    ]);
  }

  public function faq()
  {
    $this->renderView('faq');
  }
  public function kontak()
  {
    $this->renderView('kontak');
  }
}
