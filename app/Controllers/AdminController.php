<?php
require_once __DIR__ . '/../Models/User.php';


class AdminController
{
  private function renderView(string $view, $data = [])
  {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Dashboard/{$view}.php";
  }

  public function index()
  {
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

    // --- Tambahan: Hitung total peminjaman hari ini dari seluruh sumber data peminjaman ---
    require_once __DIR__ . '/../Models/PeminjamanBB.php';
    require_once __DIR__ . '/../Models/PeminjamanATK.php';
    require_once __DIR__ . '/../Models/PeminjamanMB.php';
    require_once __DIR__ . '/../Models/PeminjamanELK.php';
    $peminjamanBB = PeminjamanBB::getAllData($conn) ?: [];
    $peminjamanATK = PeminjamanATK::getAllData($conn) ?: [];
    $peminjamanMB = PeminjamanMB::getAllData($conn) ?: [];
    $peminjamanELK = PeminjamanELK::getAllData($conn) ?: [];
    $mergedPeminjaman = array_merge($peminjamanBB, $peminjamanATK, $peminjamanMB, $peminjamanELK);
    $today = date('Y-m-d');
    $peminjamanHariIni = array_filter($mergedPeminjaman, function ($item) use ($today) {
      if (!isset($item['tanggal_peminjaman'])) return false;
      $tanggal = date('Y-m-d', strtotime($item['tanggal_peminjaman']));
      return $tanggal === $today;
    });
    $totalPinjamHariIni = count($peminjamanHariIni);
    // --- END Tambahan ---

    // --- Tambahan: Hitung total pengembalian hari ini dari seluruh sumber data pengembalian ---
    require_once __DIR__ . '/../Models/PengembalianBB.php';
    require_once __DIR__ . '/../Models/PengembalianATK.php';
    require_once __DIR__ . '/../Models/PengembalianMB.php';
    require_once __DIR__ . '/../Models/PengembalianELK.php';
    $pengembalianBB = PengembalianBB::getAllData($conn) ?: [];
    $pengembalianATK = PengembalianATK::getAllData($conn) ?: [];
    $pengembalianMB = PengembalianMB::getAllData($conn) ?: [];
    $pengembalianELK = PengembalianELK::getAllData($conn) ?: [];
    $mergedPengembalian = array_merge($pengembalianBB, $pengembalianATK, $pengembalianMB, $pengembalianELK);
    $pengembalianHariIni = array_filter($mergedPengembalian, function ($item) use ($today) {
      if (!isset($item['tanggal_peminjaman'])) return false;
      $tanggal = date('Y-m-d', strtotime($item['tanggal_peminjaman']));
      return $tanggal === $today;
    });
    $totalKembaliHariIni = count($pengembalianHariIni);
    // --- END Tambahan ---

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
    $linkLaporan = [
      'prasarana' => '/admin/laporan/total-data-prasarana',
      'sarana' => '/admin/laporan/total-data-sarana',
      'dipinjam' => '/admin/laporan/barang-dipinjam',
      'rusak' => '/admin/laporan/kondisi-barang',
    ];

    // --- Tambahan: Fitur Tidak Ada Aktivitas Terbaru & Aktivitas Terbaru ---
    $recentActivities = [];
    $noRecentActivity = false;

    // Gabungkan data peminjaman dan pengembalian hari ini dari seluruh sumber
    $aktivitasHariIni = [];
    foreach ($peminjamanBB as $item) {
      if (isset($item['tanggal_peminjaman']) && date('Y-m-d', strtotime($item['tanggal_peminjaman'])) === $today) {
        $item['jenis'] = 'Peminjaman';
        $item['sumber'] = 'Sarana Bergerak';
        $item['created_at'] = $item['tanggal_peminjaman'];
        $aktivitasHariIni[] = $item;
      }
    }
    foreach ($peminjamanATK as $item) {
      if (isset($item['tanggal_peminjaman']) && date('Y-m-d', strtotime($item['tanggal_peminjaman'])) === $today) {
        $item['jenis'] = 'Peminjaman';
        $item['sumber'] = 'Sarana ATK';
        $item['created_at'] = $item['tanggal_peminjaman'];
        $aktivitasHariIni[] = $item;
      }
    }
    foreach ($peminjamanMB as $item) {
      if (isset($item['tanggal_peminjaman']) && date('Y-m-d', strtotime($item['tanggal_peminjaman'])) === $today) {
        $item['jenis'] = 'Peminjaman';
        $item['sumber'] = 'Sarana Mebelair';
        $item['created_at'] = $item['tanggal_peminjaman'];
        $aktivitasHariIni[] = $item;
      }
    }
    foreach ($peminjamanELK as $item) {
      if (isset($item['tanggal_peminjaman']) && date('Y-m-d', strtotime($item['tanggal_peminjaman'])) === $today) {
        $item['jenis'] = 'Peminjaman';
        $item['sumber'] = 'Sarana Elektronik';
        $item['created_at'] = $item['tanggal_peminjaman'];
        $aktivitasHariIni[] = $item;
      }
    }
    foreach ($pengembalianBB as $item) {
      if (isset($item['tanggal_peminjaman']) && date('Y-m-d', strtotime($item['tanggal_peminjaman'])) === $today) {
        $item['jenis'] = 'Pengembalian';
        $item['sumber'] = 'Sarana Bergerak';
        $item['created_at'] = $item['tanggal_peminjaman'];
        $aktivitasHariIni[] = $item;
      }
    }
    foreach ($pengembalianATK as $item) {
      if (isset($item['tanggal_peminjaman']) && date('Y-m-d', strtotime($item['tanggal_peminjaman'])) === $today) {
        $item['jenis'] = 'Pengembalian';
        $item['sumber'] = 'Sarana ATK';
        $item['created_at'] = $item['tanggal_peminjaman'];
        $aktivitasHariIni[] = $item;
      }
    }
    foreach ($pengembalianMB as $item) {
      if (isset($item['tanggal_peminjaman']) && date('Y-m-d', strtotime($item['tanggal_peminjaman'])) === $today) {
        $item['jenis'] = 'Pengembalian';
        $item['sumber'] = 'Sarana Mebelair';
        $item['created_at'] = $item['tanggal_peminjaman'];
        $aktivitasHariIni[] = $item;
      }
    }
    foreach ($pengembalianELK as $item) {
      if (isset($item['tanggal_peminjaman']) && date('Y-m-d', strtotime($item['tanggal_peminjaman'])) === $today) {
        $item['jenis'] = 'Pengembalian';
        $item['sumber'] = 'Sarana Elektronik';
        $item['created_at'] = $item['tanggal_peminjaman'];
        $aktivitasHariIni[] = $item;
      }
    }
    // Urutkan berdasarkan waktu terbaru
    usort($aktivitasHariIni, function ($a, $b) {
      return strtotime($b['created_at']) - strtotime($a['created_at']);
    });
    // Ambil maksimal 5 aktivitas terakhir
    $recentActivities = array_slice($aktivitasHariIni, 0, 5);
    if ($totalPinjamHariIni == 0 && $totalKembaliHariIni == 0) {
      $noRecentActivity = true;
    }
    // --- END Tambahan ---

    $this->renderView('index', [
      'totalPrasaranaData' => $totalPrasaranaData,
      'totalSaranaData' => $totalSaranaData,
      'totalSaranaDipinjam' => $totalSaranaDenganStatusDipinjam, // Mengirim data yang sudah difilter ke view
      'totalSaranaRusak' => $totalSaranaRusak,
      'kondisiAsetChartData' => $kondisiAsetChartData,
      'linkLaporan' => $linkLaporan,
      'totalPinjamHariIni' => $totalPinjamHariIni,
      'totalKembaliHariIni' => $totalKembaliHariIni,
      'recentActivities' => $recentActivities,
      'noRecentActivity' => $noRecentActivity,
    ]);
  }


  public function devView()
  {
    global $conn;
    $saranaData = SaranaBergerak::getAllData($conn);
    $this->renderView('test', [
      'saranaData' => $saranaData,
    ]);
  }
}
