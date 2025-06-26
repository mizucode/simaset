<?php

require_once __DIR__ . '/../Models/User.php';
require_once __DIR__ . '/../Models/Tanah.php';
require_once __DIR__ . '/../Models/Gedung.php';
require_once __DIR__ . '/../Models/Ruang.php';
require_once __DIR__ . '/../Models/Lapang.php';
require_once __DIR__ . '/../Models/PeminjamanBB.php';
require_once __DIR__ . '/../Models/PeminjamanATK.php';
require_once __DIR__ . '/../Models/PeminjamanMB.php';
require_once __DIR__ . '/../Models/PeminjamanELK.php';
require_once __DIR__ . '/../Models/PengembalianBB.php';
require_once __DIR__ . '/../Models/PengembalianATK.php';
require_once __DIR__ . '/../Models/PengembalianMB.php';
require_once __DIR__ . '/../Models/PengembalianELK.php';
require_once __DIR__ . '/../Models/SaranaBergerak.php';
require_once __DIR__ . '/../Models/SaranaMebelair.php';
require_once __DIR__ . '/../Models/SaranaATK.php';
require_once __DIR__ . '/../Models/SaranaElektronik.php';

class LaporanController
{
  private function renderView(string $view, $data = [])
  {
    extract($data);
    require_once __DIR__ . "/../Views/Pages/Laporan/{$view}.php";
  }

  public function totalDataPrasarana()
  {
    global $conn;
    $PrasaranaTanah = Tanah::getAllData($conn);
    $PrasaranaBangunan = Gedung::getAllData($conn);
    $PrasaranaRuang = Ruang::getAllData($conn);
    $PrasaranaLapang = Lapang::getAllData($conn);

    $totalTanah = count($PrasaranaTanah);
    $totalGedung = count($PrasaranaBangunan);
    $totalRuang = count($PrasaranaRuang);
    $totalLapang = count($PrasaranaLapang);

    $chartData = [
      'labels' => ['Tanah', 'Bangunan', 'Ruang', 'Lapang'],
      'datasets' => [
        [
          'label' => 'Total Prasarana',
          'data' => [$totalTanah, $totalGedung, $totalRuang, $totalLapang],
          'backgroundColor' => ['#007bff', '#28a745', '#ffc107', '#dc3545'],
        ]
      ]
    ];

    $this->renderView('Prasarana/index', [
      'chartData' => json_encode($chartData)
    ]);
  }

  public function totalDataPengembalian()
  {
    global $conn;
    $peminjamanBB = PengembalianBB::getAllData($conn) ?: [];
    $peminjamanATK = PengembalianATK::getAllData($conn) ?: [];
    $peminjamanMB = PengembalianMB::getAllData($conn) ?: [];
    $peminjamanELK = PengembalianELK::getAllData($conn) ?: [];

    $mergedData = array_merge(
      $this->formatPeminjamanData($peminjamanBB, 'BB'),
      $this->formatPeminjamanData($peminjamanATK, 'ATK'),
      $this->formatPeminjamanData($peminjamanMB, 'MB'),
      $this->formatPeminjamanData($peminjamanELK, 'ELK')
    );

    $filteredData = array_filter($mergedData, function ($item) {
      return is_array($item) &&
        isset($item['nomor_registrasi']) &&
        isset($item['nama_barang']) &&
        isset($item['nama_peminjam']);
    });

    $filteredData = array_map(function ($item) {
      if (!empty($item['tanggal_peminjaman'])) {
        $item['tanggal_peminjaman'] = date('Y-m-d', strtotime($item['tanggal_peminjaman']));
      }
      if (!empty($item['tanggal_rencana_pengembalian'])) {
        $item['tanggal_rencana_pengembalian'] = date('Y-m-d', strtotime($item['tanggal_rencana_pengembalian']));
      }
      return $item;
    }, $filteredData);

    $this->renderView('BarangDikembalikan/index', [
      'saranaData' => array_values($filteredData)
    ]);
  }
  public function totalDataPeminjaman()
  {
    global $conn;
    $peminjamanBB = PeminjamanBB::getAllData($conn) ?: [];
    $peminjamanATK = PeminjamanATK::getAllData($conn) ?: [];
    $peminjamanMB = PeminjamanMB::getAllData($conn) ?: [];
    $peminjamanELK = PeminjamanELK::getAllData($conn) ?: [];

    $mergedData = array_merge(
      $this->formatPeminjamanData($peminjamanBB, 'BB'),
      $this->formatPeminjamanData($peminjamanATK, 'ATK'),
      $this->formatPeminjamanData($peminjamanMB, 'MB'),
      $this->formatPeminjamanData($peminjamanELK, 'ELK')
    );

    $filteredData = array_filter($mergedData, function ($item) {
      return is_array($item) &&
        isset($item['nomor_registrasi']) &&
        isset($item['nama_barang']) &&
        isset($item['nama_peminjam']);
    });

    $filteredData = array_map(function ($item) {
      if (!empty($item['tanggal_peminjaman'])) {
        $item['tanggal_peminjaman'] = date('Y-m-d', strtotime($item['tanggal_peminjaman']));
      }
      if (!empty($item['tanggal_rencana_pengembalian'])) {
        $item['tanggal_rencana_pengembalian'] = date('Y-m-d', strtotime($item['tanggal_rencana_pengembalian']));
      }
      return $item;
    }, $filteredData);

    $this->renderView('BarangDipinjam/index', [
      'saranaData' => array_values($filteredData)
    ]);
  }

  private function formatPeminjamanData(array $data, string $type): array
  {
    return array_map(function ($item) use ($type) {
      $lokasi = isset($item['lokasi_penempatan_barang']) && trim($item['lokasi_penempatan_barang']) !== '' && $item['lokasi_penempatan_barang'] !== '-' ? trim($item['lokasi_penempatan_barang']) : '';
      $formatted = [
        'nomor_registrasi' => $item['nomor_registrasi'] ?? '-',
        'nama_barang' => $item['nama_barang'] ?? '-',
        'nama_peminjam' => $item['nama_peminjam'] ?? '-',
        'nomor_identitas' => $item['nomor_identitas'] ?? '-',
        'nomor_hp_peminjam' => $item['nomor_hp_peminjam'] ?? '-',
        'tanggal_peminjaman' => $item['tanggal_peminjaman'] ?? null,
        'tanggal_rencana_pengembalian' => $item['tanggal_rencana_pengembalian'] ?? null,
        'lokasi_penempatan_barang' => $lokasi,
        'jenis_peminjaman' => $type
      ];

      if ($formatted['tanggal_peminjaman']) {
        $formatted['tanggal_peminjaman'] = date('Y-m-d', strtotime($formatted['tanggal_peminjaman']));
      }
      if ($formatted['tanggal_rencana_pengembalian']) {
        $formatted['tanggal_rencana_pengembalian'] = date('Y-m-d', strtotime($formatted['tanggal_rencana_pengembalian']));
      }
      return $formatted;
    }, $data);
  }

  public function totalDataBarangRusak($lokasi = null)
  {
    global $conn;
    $saranaBergerak = SaranaBergerak::getAllData($conn) ?: [];
    $saranaMebelair = SaranaMebelair::getAllData($conn) ?: [];
    $saranaATK = SaranaATK::getAllData($conn) ?: [];
    $saranaElektronik = SaranaElektronik::getAllData($conn) ?: [];

    $mergedData = array_merge(
      $saranaBergerak,
      $saranaMebelair,
      $saranaATK,
      $saranaElektronik
    );

    $filteredData = array_filter($mergedData, function ($item) use ($lokasi) {
      if (!is_array($item) || !isset($item['kondisi'])) {
        return false;
      }
      $isDamaged = in_array($item['kondisi'], ["Rusak Ringan", "Rusak Berat"]);
      if ($lokasi !== null) {
        $locationMatch = isset($item['lokasi']) && $item['lokasi'] == $lokasi;
        return $isDamaged && $locationMatch;
      }
      return $isDamaged;
    });

    $this->renderView('BarangRusak/index', [
      'saranaData' => array_values($filteredData)
    ]);
  }

  public function totalDataSarana()
  {
    global $conn;
    $saranaBergerak = SaranaBergerak::getAllData($conn) ?: [];
    $saranaMebelair = SaranaMebelair::getAllData($conn) ?: [];
    $saranaATK = SaranaATK::getAllData($conn) ?: [];
    $saranaElektronik = SaranaElektronik::getAllData($conn) ?: [];

    $totalBergerak = count($saranaBergerak);
    $totalMebelair = count($saranaMebelair);
    $totalATK = count($saranaATK);
    $totalElektronik = count($saranaElektronik);

    $chartData = [
      'labels' => ['Bergerak', 'Mebelair', 'ATK', 'Elektronik'],
      'datasets' => [
        [
          'label' => 'Total Sarana',
          'data' => [$totalBergerak, $totalMebelair, $totalATK, $totalElektronik],
          'backgroundColor' => ['#17a2b8', '#6f42c1', '#fd7e14', '#20c997'],
        ]
      ]
    ];

    $this->renderView('Sarana/index', [
      'chartData' => json_encode($chartData)
    ]);
  }

  public function kondisiBarang()
  {
    global $conn;
    $saranaBergerak = SaranaBergerak::getAllData($conn) ?: [];
    $saranaMebelair = SaranaMebelair::getAllData($conn) ?: [];
    $saranaATK = SaranaATK::getAllData($conn) ?: [];
    $saranaElektronik = SaranaElektronik::getAllData($conn) ?: [];

    $addKategori = function (array $data, string $kategoriNama): array {
      return array_map(function ($item) use ($kategoriNama) {
        if (is_array($item)) {
          $item['kategori'] = $kategoriNama;
        }
        return $item;
      }, $data);
    };

    $dataBergerak = $addKategori($saranaBergerak, 'Sarana Bergerak');
    $dataMebelair = $addKategori($saranaMebelair, 'Sarana Mebelair');
    $dataATK = $addKategori($saranaATK, 'Sarana ATK');
    $dataElektronik = $addKategori($saranaElektronik, 'Sarana Elektronik');

    $mergedData = array_merge(
      $dataBergerak,
      $dataMebelair,
      $dataATK,
      $dataElektronik
    );

    $kondisiCount = [];
    $warnaKondisi = [
      'Baik' => '#28a745',
      'Rusak Ringan' => '#ffc107',
      'Rusak Berat' => '#dc3545',
      'Hilang' => '#6c757d',
      'Lainnya' => '#17a2b8'
    ];
    foreach ($mergedData as $item) {
      $kondisi = isset($item['kondisi']) ? $item['kondisi'] : 'Lainnya';
      if ($kondisi === '' || $kondisi === null) $kondisi = 'Lainnya';
      if (!isset($kondisiCount[$kondisi])) $kondisiCount[$kondisi] = 0;
      $kondisiCount[$kondisi]++;
    }
    $labels = array_keys($kondisiCount);
    $data = array_values($kondisiCount);
    $backgroundColor = array_map(function ($k) use ($warnaKondisi) {
      return $warnaKondisi[$k] ?? '#17a2b8';
    }, $labels);
    $chartKondisiData = [
      'labels' => $labels,
      'datasets' => [[
        'label' => 'Jumlah Barang',
        'data' => $data,
        'backgroundColor' => $backgroundColor
      ]]
    ];

    $this->renderView('Kondisi/index', [
      'saranaData' => $mergedData,
      'chartKondisiData' => json_encode($chartKondisiData)
    ]);
  }

  public function kondisiRuangan()
  {
    global $conn;
    $ruangData = Ruang::getAllData($conn) ?: [];

    // Mengambil data filter dari database
    $jenisRuanganFilter = [];
    $kondisiFilter = [];

    foreach ($ruangData as $item) {
      // Filter jenis ruangan
      if (isset($item['jenis_ruangan']) && !empty($item['jenis_ruangan'])) {
        $jenisRuanganFilter[$item['jenis_ruangan']] = $item['jenis_ruangan'];
      }

      // Filter kondisi
      if (isset($item['kondisi_ruang']) && !empty($item['kondisi_ruang'])) {
        $kondisiFilter[$item['kondisi_ruang']] = $item['kondisi_ruang'];
      }
    }

    // Sort filter data
    sort($jenisRuanganFilter);
    sort($kondisiFilter);

    // Menghitung kondisi ruangan untuk chart
    $kondisiCount = [];
    $warnaKondisi = [
      'Baik' => '#28a745',
      'Rusak Ringan' => '#ffc107',
      'Rusak Berat' => '#dc3545',
      'Hilang' => '#6c757d',
      'Lainnya' => '#17a2b8'
    ];

    foreach ($ruangData as $item) {
      $kondisi = isset($item['kondisi_ruang']) ? $item['kondisi_ruang'] : 'Lainnya';
      if ($kondisi === '' || $kondisi === null) $kondisi = 'Lainnya';
      if (!isset($kondisiCount[$kondisi])) $kondisiCount[$kondisi] = 0;
      $kondisiCount[$kondisi]++;
    }

    $labels = array_keys($kondisiCount);
    $data = array_values($kondisiCount);
    $backgroundColor = array_map(function ($k) use ($warnaKondisi) {
      return $warnaKondisi[$k] ?? '#17a2b8';
    }, $labels);

    $chartKondisiData = [
      'labels' => $labels,
      'datasets' => [[
        'label' => 'Jumlah Ruangan',
        'data' => $data,
        'backgroundColor' => $backgroundColor
      ]]
    ];

    $this->renderView('KondisiRuangan/index', [
      'ruangData' => $ruangData,
      'chartKondisiData' => json_encode($chartKondisiData),
      'jenisRuanganFilter' => $jenisRuanganFilter,
      'kondisiFilter' => $kondisiFilter
    ]);
  }
}
