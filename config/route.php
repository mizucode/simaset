<?php


require 'config/config.php';


class Router {

  private $uri;
  private $query;
  private $allowedRoutes = [
    // Public routes
    '/' => ['controller' => 'AuthController', 'method' => 'loginForm', 'auth' => false],
    '/login' => ['controller' => 'AuthController', 'method' => 'login', 'auth' => false],
    '/logout' => ['controller' => 'AuthController', 'method' => 'logout', 'auth' => true],

    // Pages
    '/informasi' => ['controller' => 'PagesController', 'method' => 'informasi', 'auth' => false],

    // aktifkan untuk menambah user
    // '/superadmin/add' => ['controller' => 'AuthController', 'method' => 'adduser', 'auth' => false],

    // Admin routes
    '/admin' => ['controller' => 'AdminController', 'method' => 'index', 'auth' => true],
    '/mizu' => ['controller' => 'AdminController', 'method' => 'devView', 'auth' => true],

    // Prasarana - Tanah
    '/admin/prasarana/tanah' => ['controller' => 'TanahController', 'method' => 'tanah', 'auth' => true],
    '/admin/prasarana/tanah/tambah' => ['controller' => 'TanahController', 'method' => 'create', 'auth' => true],
    '/admin/prasarana/tanah/detail/([A-Za-z0-9\-]+)' => ['controller' => 'TanahController', 'method' => 'detail', 'auth' => true], // Menggunakan kode_aset

    // Prasarana - Gedung
    '/admin/prasarana/gedung' => ['controller' => 'GedungController', 'method' => 'gedung', 'auth' => true],
    '/admin/prasarana/gedung/detail/([A-Za-z0-9\-]+)' => ['controller' => 'GedungController', 'method' => 'detail', 'auth' => true], // Menggunakan kode_gedung
    '/admin/prasarana/gedung/tambah' => ['controller' => 'GedungController', 'method' => 'create', 'auth' => true],

    // Prasarana - Ruang
    '/admin/prasarana/ruang' => ['controller' => 'RuangController', 'method' => 'ruang', 'auth' => true],
    '/admin/prasarana/ruang/tambah' => ['controller' => 'RuangController', 'method' => 'create', 'auth' => true],

    // Prasarana - Lapang
    '/admin/prasarana/lapang' => ['controller' => 'LapangController', 'method' => 'lapang', 'auth' => true],
    '/admin/prasarana/lapang/tambah' => ['controller' => 'LapangController', 'method' => 'create', 'auth' => true],

    // Sarana - Barang
    '/admin/sarana/barang' => ['controller' => 'BarangController', 'method' => 'barang', 'auth' => true],


    // Sarana - Bergerak
    '/admin/sarana/bergerak' => ['controller' => 'SaranaBergerakController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/bergerak/pindah' => ['controller' => 'SaranaBergerakPindahController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/bergerak/pinjam' => ['controller' => 'SaranaBergerakPinjamController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/bergerak/pinjam/tambah' => ['controller' => 'SaranaBergerakPinjamController', 'method' => 'indexPeminjaman', 'auth' => true],
    '/admin/sarana/bergerak/kembali' => ['controller' => 'SaranaBergerakKembaliController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/bergerak/tambah' => ['controller' => 'SaranaBergerakController', 'method' => 'create', 'auth' => true], // Menggunakan SaranaBergerakController
    '/admin/sarana/bergerak/download-qr' => ['controller' => 'SaranaBergerakController', 'method' => 'downloadAllQr', 'auth' => true],
    '/admin/sarana/bergerak/edit/([A-Z]{3}-[A-Z]{3,4}-\d{4}-\d{3,4})' => ['controller' => 'SaranaBergerakController', 'method' => 'update', 'auth' => true], // Rute edit, random number bisa 3 atau 4 digit
    '/admin/sarana/bergerak/detail/([A-Z]{3}-[A-Z]{3,4}-\d{4}-\d{3,4})' => ['controller' => 'SaranaBergerakController', 'method' => 'detail', 'auth' => true], // Rute detail, random number bisa 3 atau 4 digit
    '/admin/sarana/bergerak/kondisi' => ['controller' => 'SaranaBergerakKondisiController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/atk/download-qr' => ['controller' => 'SaranaATKController', 'method' => 'downloadAllQr', 'auth' => true],
    '/admin/sarana/atk/edit/([A-Z]{3}-[A-Z]{3,4}-\d{4}-\d{3,4})' => ['controller' => 'SaranaATKController', 'method' => 'update', 'auth' => true], // Rute edit ATK, random number bisa 3 atau 4 digit
    '/admin/sarana/atk/detail/([A-Z]{3}-[A-Z]{3,4}-\d{4}-\d{3,4})' => ['controller' => 'SaranaATKController', 'method' => 'detail', 'auth' => true], // Rute detail ATK, random number bisa 3 atau 4 digit
    '/admin/sarana/mebelair/download-qr' => ['controller' => 'SaranaMebelairController', 'method' => 'downloadAllQr', 'auth' => true],
    '/admin/sarana/mebelair/detail/([A-Z0-9\-]+)' => ['controller' => 'SaranaMebelairController', 'method' => 'detail', 'auth' => true], // Asumsi no_registrasi
    '/admin/sarana/mebelair/edit/([A-Z]{3}-[A-Z]{3,4}-\d{4}-\d{3,4})' => ['controller' => 'SaranaMebelairController', 'method' => 'update', 'auth' => true], // Rute edit mebelair, random number bisa 3 atau 4 digit
    '/admin/sarana/elektronik/download-qr' => ['controller' => 'SaranaElektronikController', 'method' => 'downloadAllQr', 'auth' => true], // Rute edit mebelair by no_registrasi

    // Sarana - Mebelair
    '/admin/sarana/mebelair' => ['controller' => 'SaranaMebelairController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/mebelair/tambah' => ['controller' => 'SaranaMebelairController', 'method' => 'create', 'auth' => true],
    '/admin/sarana/mebelair/pindah' => ['controller' => 'SaranaMebelairPindahController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/mebelair/pinjam' => ['controller' => 'SaranaMebelairPinjamController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/mebelair/kembali' => ['controller' => 'SaranaMebelairKembaliController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/mebelair/pinjam/tambah' => ['controller' => 'SaranaMebelairPinjamController', 'method' => 'indexPeminjaman', 'auth' => true],
    '/admin/sarana/mebelair/kondisi' => ['controller' => 'SaranaMebelairKondisiController', 'method' => 'index', 'auth' => true],


    // Sarana - ATK
    '/admin/sarana/atk' => ['controller' => 'SaranaATKController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/atk/tambah' => ['controller' => 'SaranaATKController', 'method' => 'create', 'auth' => true],
    '/admin/sarana/atk/pindah' => ['controller' => 'SaranaATKPindahController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/atk/kondisi' => ['controller' => 'SaranaATKKondisiController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/atk/pinjam' => ['controller' => 'SaranaATKPinjamController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/atk/kembali' => ['controller' => 'SaranaATKKembaliController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/atk/pinjam/tambah' => ['controller' => 'SaranaATKPinjamController', 'method' => 'indexPeminjaman', 'auth' => true],


    // Sarana - Elektronik
    '/admin/sarana/elektronik' => ['controller' => 'SaranaElektronikController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/elektronik/tambah' => ['controller' => 'SaranaElektronikController', 'method' => 'create', 'auth' => true],
    '/admin/sarana/elektronik/pindah' => ['controller' => 'SaranaElektronikPindahController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/elektronik/pinjam' => ['controller' => 'SaranaElektronikPinjamController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/elektronik/kembali' => ['controller' => 'SaranaElektronikKembaliController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/elektronik/kondisi' => ['controller' => 'SaranaElektronikKondisiController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/elektronik/pinjam' => ['controller' => 'SaranaElektronikPinjamController', 'method' => 'index', 'auth' => true],
    '/admin/sarana/elektronik/detail/([A-Z0-9\-]+)' => ['controller' => 'SaranaElektronikController', 'method' => 'detail', 'auth' => true], // Asumsi no_registrasi
    '/admin/sarana/elektronik/pinjam/tambah' => ['controller' => 'SaranaElektronikPinjamController', 'method' => 'indexPeminjaman', 'auth' => true],


    // Barang routes

    '/admin/laporan/total-data-sarana' => ['controller' => 'BarangController', 'method' => 'indexDaftarBarang', 'auth' => true],
    '/admin/barang/jenis-barang' => ['controller' => 'JenisBarangController', 'method' => 'index', 'auth' => true],
    '/admin/barang/jenis-barang/tambah' => ['controller' => 'JenisBarangController', 'method' => 'create', 'auth' => true],
    '/admin/barang/kategori-barang' => ['controller' => 'BarangController', 'method' => 'barang', 'auth' => true],
    '/admin/barang/kategori-barang/tambah' => ['controller' => 'BarangController', 'method' => 'create', 'auth' => true],

    // Transaksi
    '/admin/transaksi/riwayat-barang' => ['controller' => 'TransaksiBarangController', 'method' => 'index', 'auth' => true],
    '/admin/transaksi/formulir-pemimjaman' => ['controller' => 'TransaksiBarangController', 'method' => 'createPeminjaman', 'auth' => true],
    '/admin/transaksi/formulir-pengembalian' => ['controller' => 'TransaksiBarangController', 'method' => 'createPengembalian', 'auth' => true],


    // Penempatan routes
    '/admin/penempatan/daftar-barang' => ['controller' => 'PenempatanController', 'method' => 'PenempatanBarang', 'auth' => true],
    '/admin/penempatan/daftar-barang/tambah' => ['controller' => 'PenempatanController', 'method' => 'create', 'auth' => true],
    '/admin/penempatan/daftar-barang/pengembalian' => ['controller' => 'PenempatanController', 'method' => 'pengembalian', 'auth' => true],
    '/admin/penempatan/form' => ['controller' => 'AdminController', 'method' => 'formPenempatan', 'auth' => true],
    '/admin/penempatan/detail' => ['controller' => 'AdminController', 'method' => 'detailPenempatan', 'auth' => true],

    //Mutasi
    '/admin/transaksi/mutasi/riwayat-barang' => ['controller' => 'MutasiController', 'method' => 'index', 'auth' => true],
    '/admin/transaksi/mutasi/barang-keluar' => ['controller' => 'MutasiBarangKeluarController', 'method' => 'index', 'auth' => true],
    '/admin/transaksi/mutasi/barang-keluar/tambah' => ['controller' => 'MutasiBarangKeluarController', 'method' => 'create', 'auth' => true],
    '/admin/transaksi/mutasi/barang-masuk' => ['controller' => 'MutasiBarangMasukController', 'method' => 'index', 'auth' => true],
    '/admin/transaksi/mutasi/barang-masuk/tambah' => ['controller' => 'MutasiBarangMasukController', 'method' => 'create', 'auth' => true],



    // Laporan routes

    '/admin/laporan/total-data-prasarana' => ['controller' => 'LaporanController', 'method' => 'totalDataPrasarana', 'auth' => true],
    '/admin/laporan/barang-dipinjam' => ['controller' => 'LaporanController', 'method' => 'totalDataPeminjaman', 'auth' => true],
    '/admin/laporan/barang-rusak' => ['controller' => 'LaporanController', 'method' => 'totalDataBarangRusak', 'auth' => true],



    // Kondisi routes
    '/admin/kondisi/daftar-kondisi' => ['controller' => 'AdminController', 'method' => 'daftarKondisi', 'auth' => true],

    // Survey
    '/admin/survey/sarana/sarana-bergerak' => ['controller' => 'SurveySaranaBergerakController', 'method' => 'index', 'auth' => true],
    '/admin/survey/sarana/sarana-bergerak/tambah' => ['controller' => 'SurveySaranaBergerakController', 'method' => 'create', 'auth' => true],
    '/admin/survey/sarana/sarana-mebelair' => ['controller' => 'SurveySaranaMebelairController', 'method' => 'index', 'auth' => true],
    '/admin/survey/sarana/sarana-mebelair/tambah' => ['controller' => 'SurveySaranaMebelairController', 'method' => 'create', 'auth' => true],
    '/admin/survey/sarana/sarana-atk' => ['controller' => 'SurveySaranaATKController', 'method' => 'index', 'auth' => true],
    '/admin/survey/sarana/sarana-atk/tambah' => ['controller' => 'SurveySaranaATKController', 'method' => 'create', 'auth' => true],
    '/admin/survey/sarana/sarana-elektronik' => ['controller' => 'SurveySaranaElektronikController', 'method' => 'index', 'auth' => true],
    '/admin/survey/sarana/sarana-elektronik/tambah' => ['controller' => 'SurveySaranaElektronikController', 'method' => 'create', 'auth' => true],

  ];


  public function __construct() {
    $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $this->query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
  }

  public function route() {
    $routeFound = false;

    foreach ($this->allowedRoutes as $route => $config) {

      if ($route === $this->uri) {
        $this->handleRoute($config);
        $routeFound = true;
        break;
      }


      if (strpos($route, '(') !== false && preg_match('#^' . $route . '$#', $this->uri, $matches)) {
        $config['params'] = array_slice($matches, 1);
        $this->handleRoute($config);
        $routeFound = true;
        break;
      }
    }

    if (!$routeFound) {
      $this->notFound();
    }
  }

  private function handleRoute(array $config): void {
    $this->checkAuthentication($config);

    $controller = new $config['controller']();
    $method = $config['method'];
    $params = $config['params'] ?? [];

    if ($this->shouldHandleQueryParameters()) {
      $this->handleQueryParameters($controller);
      return;
    }

    call_user_func_array([$controller, $method], $params);
  }

  private function checkAuthentication(array $config): void {
    if ($config['auth'] && !$this->isAuthenticated()) {
      header('Location: /');
      exit;
    }
  }

  private function shouldHandleQueryParameters(): bool {
    $allowedUris = [
      '/admin/prasarana/tanah',
      '/admin/prasarana/gedung',
      '/admin/prasarana/ruang',
      '/admin/prasarana/lapang',
      '/admin/sarana/bergerak',
      '/admin/sarana/mebelair',
      '/admin/sarana/atk',
      '/admin/sarana/elektronik',
      '/admin/barang/jenis-barang',
      // '/admin/barang/kategori-barang', // Jika kategori barang punya detail view via query param
      '/admin/transaksi/mutasi/barang-keluar',
      '/admin/transaksi/mutasi/barang-masuk',
      '/admin/sarana/bergerak/pindah',
      '/admin/sarana/mebelair/pindah',
      '/admin/sarana/atk/pindah',
      '/admin/sarana/elektronik/pindah',
      // Kondisi, Pinjam, Kembali biasanya tidak memiliki halaman detail sendiri per item, tapi daftar item.
      '/admin/sarana/atk/kondisi',
      '/admin/sarana/mebelair/kondisi',
      '/admin/sarana/bergerak/kondisi',
      '/admin/sarana/elektronik/kondisi',
      // Pinjam & Kembali
      '/admin/sarana/bergerak/pinjam',
      '/admin/sarana/mebelair/pinjam',
      '/admin/sarana/atk/pinjam',
      '/admin/sarana/elektronik/pinjam',
      '/admin/survey/sarana/sarana-bergerak',
      '/admin/survey/sarana/sarana-mebelair',
      '/admin/survey/sarana/sarana-atk',
      '/admin/survey/sarana/sarana-elektronik',
      '/admin/sarana/atk/kembali',
      '/admin/sarana/mebelair/kembali',
      '/admin/sarana/bergerak/kembali',
      '/admin/sarana/elektronik/kembali',
    ];

    return in_array($this->uri, $allowedUris) && !empty($_GET);
  }

  private function handleQueryParameters($controller): void {
    $queryHandlers = [
      'edit' => 'update',
      'tambah' => 'create',
      'tambah-dokumen' => 'dokumen',
      'delete' => 'delete',
      'delete-dokumen' => 'deleteDokumen',
      'delete-gambar' => 'deleteDokumentasi',
      'tambah-gambar' => 'dokumenGambar',
      'preview-file-dokumen' => 'previewFileDokumen', // Tambahkan ini
      'preview-gambar' => 'previewDokumen',
      'download-dokumen' => 'downloadDokumen',
      'tambah-barang' => 'tambahBarang',
      'delete-barang' => 'deleteBarang'
    ];

    // Jika semua detail view menggunakan path parameter, maka 'detail' bisa dihapus dari $queryHandlers
    // atau dibuat lebih spesifik jika masih ada yang menggunakan ?detail=
    // Untuk saat ini, saya akan membiarkannya, tetapi idealnya ini akan dihapus jika transisi selesai.
    if (!preg_match('/\/detail\/[^\/]+$/', $this->uri)) { // Hanya proses ?detail= jika bukan path /detail/xxx
      $queryHandlers['detail'] = 'detail';
    }

    foreach ($queryHandlers as $param => $method) {
      if (isset($_GET[$param]) && is_numeric($_GET[$param])) {
        $controller->$method($_GET[$param]);
        return;
      }
    }

    if (isset($_GET['download'])) {
      $controller->download();
      return;
    }

    if (isset($_GET['preview']) && isset($_GET['filename']) && isset($_GET['jenis'])) {
      $controller->preview();
      return;
    }
  }
  private function isAuthenticated() {
    // Implement your authentication check logic here
    return isset($_SESSION['user']);
  }

  private function notFound() {
    http_response_code(404);
    require __DIR__ . '/../404.php';
    exit;
  }
}
