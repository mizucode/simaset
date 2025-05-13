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

        // Admin routes
        '/admin' => ['controller' => 'AdminController', 'method' => 'index', 'auth' => true],
        '/mizu' => ['controller' => 'AdminController', 'method' => 'devView', 'auth' => true],

        // Prasarana - Tanah
        '/admin/prasarana/tanah' => ['controller' => 'TanahController', 'method' => 'tanah', 'auth' => true],
        '/admin/prasarana/tanah/tambah' => ['controller' => 'TanahController', 'method' => 'create', 'auth' => true],
        '/admin/prasarana/tanah/edit/([0-9]+)' => ['controller' => 'TanahController', 'method' => 'update', 'auth' => true],

        // Prasarana - Gedung
        '/admin/prasarana/gedung' => ['controller' => 'GedungController', 'method' => 'gedung', 'auth' => true],
        '/admin/prasarana/gedung/tambah' => ['controller' => 'GedungController', 'method' => 'create', 'auth' => true],

        // Prasarana - Ruang
        '/admin/prasarana/ruang' => ['controller' => 'RuangController', 'method' => 'ruang', 'auth' => true],
        '/admin/prasarana/ruang/tambah' => ['controller' => 'RuangController', 'method' => 'create', 'auth' => true],

        // Prasarana - Lapang
        '/admin/prasarana/lapang' => ['controller' => 'LapangController', 'method' => 'lapang', 'auth' => true],
        '/admin/prasarana/lapang/tambah' => ['controller' => 'LapangController', 'method' => 'create', 'auth' => true],

        // Sarana routes
        '/admin/sarana/bergerak' => ['controller' => 'SaranaBergerakController', 'method' => 'index', 'auth' => true],
        '/admin/sarana/bergerak/tambah' => ['controller' => 'SaranaBergerakController', 'method' => 'create', 'auth' => true],
        '/admin/sarana/barang' => ['controller' => 'BarangController', 'method' => 'barang', 'auth' => true],
        '/admin/sarana/mebelair' => ['controller' => 'SaranaMebelairController', 'method' => 'index', 'auth' => true],
        '/admin/sarana/mebelair/tambah' => ['controller' => 'SaranaMebelairController', 'method' => 'create', 'auth' => true],
        '/admin/sarana/atk' => ['controller' => 'SaranaATKController', 'method' => 'index', 'auth' => true],
        '/admin/sarana/atk/tambah' => ['controller' => 'SaranaATKController', 'method' => 'create', 'auth' => true],
        '/admin/sarana/elektronik' => ['controller' => 'BarangElektronikController', 'method' => 'elektronik', 'auth' => true],

        // Barang routes
        '/admin/barang/daftar-barang' => ['controller' => 'BarangController', 'method' => 'daftarBarang', 'auth' => true],
        '/admin/barang/kategori-barang' => ['controller' => 'BarangController', 'method' => 'barang', 'auth' => true],
        '/admin/barang/kategori-barang/tambah' => ['controller' => 'BarangController', 'method' => 'create', 'auth' => true],

        // Penempatan routes
        '/admin/penempatan/daftar-barang' => ['controller' => 'PenempatanController', 'method' => 'PenempatanBarang', 'auth' => true],
        '/admin/penempatan/daftar-barang/tambah' => ['controller' => 'PenempatanController', 'method' => 'create', 'auth' => true],
        '/admin/penempatan/form' => ['controller' => 'AdminController', 'method' => 'formPenempatan', 'auth' => true],
        '/admin/penempatan/detail' => ['controller' => 'AdminController', 'method' => 'detailPenempatan', 'auth' => true],

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
            '/admin/sarana/atk'
        ];

        if (in_array($this->uri, $allowedUris) && isset($_GET['edit']) && is_numeric($_GET['edit'])) {
            $controller->update($_GET['edit']);
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
