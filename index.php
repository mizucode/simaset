<?php
session_start();

require 'config/config.php';

class Router
{
    private $uri;
    private $query;
    private $allowedRoutes = [
        // Public routes
        '/' => ['controller' => 'AuthController', 'method' => 'loginForm', 'auth' => false],
        '/login' => ['controller' => 'AuthController', 'method' => 'login', 'auth' => false],
        '/logout' => ['controller' => 'AuthController', 'method' => 'logout', 'auth' => true],

        // aktifkan untuk menambah user
        // '/superadmin/add' => ['controller' => 'AuthController', 'method' => 'adduser', 'auth' => false],

        // Admin routes
        '/admin' => ['controller' => 'AdminController', 'method' => 'index', 'auth' => true],
        '/mizu' => ['controller' => 'AdminController', 'method' => 'devView', 'auth' => true],

        // Prasarana - Tanah
        '/admin/prasarana/tanah' => ['controller' => 'TanahController', 'method' => 'tanah', 'auth' => true],
        '/admin/prasarana/tanah/tambah' => ['controller' => 'TanahController', 'method' => 'create', 'auth' => true],

        // Prasarana - Gedung
        '/admin/prasarana/gedung' => ['controller' => 'GedungController', 'method' => 'gedung', 'auth' => true],
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
        '/admin/sarana/bergerak/tambah' => ['controller' => 'SaranaBergerakController', 'method' => 'create', 'auth' => true],

        // Sarana - Mebelair
        '/admin/sarana/mebelair' => ['controller' => 'SaranaMebelairController', 'method' => 'index', 'auth' => true],
        '/admin/sarana/mebelair/tambah' => ['controller' => 'SaranaMebelairController', 'method' => 'create', 'auth' => true],

        // Sarana - ATK
        '/admin/sarana/atk' => ['controller' => 'SaranaATKController', 'method' => 'index', 'auth' => true],
        '/admin/sarana/atk/tambah' => ['controller' => 'SaranaATKController', 'method' => 'create', 'auth' => true],

        // Sarana - Elektronik
        '/admin/sarana/elektronik' => ['controller' => 'SaranaElektronikController', 'method' => 'index', 'auth' => true],
        '/admin/sarana/elektronik/tambah' => ['controller' => 'SaranaElektronikController', 'method' => 'create', 'auth' => true],

        // Barang routes

        '/admin/barang/daftar-barang' => ['controller' => 'BarangController', 'method' => 'indexDaftarBarang', 'auth' => true],
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

        //Laporan
        '/admin/survey/semesteran' => ['controller' => 'SurveySemesteranController', 'method' => 'index', 'auth' => true],
        '/admin/survey/semesteran/tambah' => ['controller' => 'SurveySemesteranController', 'method' => 'create', 'auth' => true],
        '/admin/survey/semesteran/data-inventaris' => ['controller' => 'DataInventarisController', 'method' => 'update', 'auth' => true],


        // Kondisi routes
        '/admin/kondisi/daftar-kondisi' => ['controller' => 'AdminController', 'method' => 'daftarKondisi', 'auth' => true],
    ];

    public function __construct()
    {
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $this->query = parse_url($_SERVER['REQUEST_URI'], PHP_URL_QUERY);
    }

    public function route()
    {
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

    private function handleRoute($config)
    {
        // Check authentication if required
        if ($config['auth'] && !$this->isAuthenticated()) {
            // Redirect to login or show error
            header('Location: /');
            exit;
        }

        // Instantiate controller and call method
        $controller = new $config['controller']();
        $method = $config['method'];
        $params = $config['params'] ?? [];

        // Handle query parameters for specific cases
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
            '/admin/survey/semesteran',
            '/admin/survey/semesteran/data-inventaris',
            '/admin/transaksi/mutasi/barang-keluar',
            '/admin/transaksi/mutasi/barang-masuk',
        ];

        if (in_array($this->uri, $allowedUris) && isset($_GET['edit']) && is_numeric($_GET['edit'])) {
            $controller->update($_GET['edit']);
            return;
        }

        if (in_array($this->uri, $allowedUris) && isset($_GET['tambah']) && is_numeric($_GET['tambah'])) {
            $controller->create($_GET['tambah']);
            return;
        }

        if (in_array($this->uri, $allowedUris) && isset($_GET['detail']) && is_numeric($_GET['detail'])) {
            $controller->detail($_GET['detail']);
            return;
        }
        if (in_array($this->uri, $allowedUris) && isset($_GET['download'])) {
            $controller->download(); // TANPA parameter
            return;
        }

        if (in_array($this->uri, $allowedUris) && isset($_GET['preview']) && isset($_GET['filename']) && isset($_GET['jenis'])) {
            $controller->preview(); // Tanpa parameter
            return;
        }






        call_user_func_array([$controller, $method], $params);
    }

    private function isAuthenticated()
    {
        // Implement your authentication check logic here
        return isset($_SESSION['user']);
    }

    private function notFound()
    {
        http_response_code(404);
        require __DIR__ . '/404.php';
        exit;
    }
}

// Initialize and run the router
$router = new Router();
$router->route();
