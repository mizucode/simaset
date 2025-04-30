<?php
session_start();

include 'config/config.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

$allowedRoutes = [
    '/',
    '/login',
    '/logout',
    '/admin',
    '/admin/prasarana/tanah',
    '/admin/prasarana/tanah/tambah',
    '/admin/prasarana/gedung',
    '/admin/prasarana/ruangan',
    '/admin/prasarana/lapang',
    '/admin/sarana/bergerak',
    '/admin/sarana/barang',
    '/admin/sarana/mebeler',
    '/admin/sarana/alat-tulis-kantor',
    '/admin/sarana/elektronik',
    '/admin/penempatan/list',
    '/admin/penempatan/form',
    '/admin/penempatan/detail',
    '/admin/kondisi/daftar-kondisi',
    '/admin/barang/daftar-barang',
    '/admin/barang/daftar-barang/tambah',

];

if (!in_array($uri, $allowedRoutes)) {
    http_response_code(404);
    require_once __DIR__ . '/404.php';
    exit;
}
// Routingan
switch ($uri) {
    case '/':
        $auth = new AuthController();
        $auth->loginForm();
        break;

    case '/login':
        $auth = new AuthController();
        $auth->login();
        break;

    case '/logout':
        $auth = new AuthController();
        $auth->logout();
        break;

    case '/admin':
        auth(); // Middleware: cek login
        $admin = new AdminController();
        $admin->index();
        break;



    case '/admin/prasarana/tanah':
        auth();
        $admin = new TanahController();
        $admin->tanah(); // Metode ini akan menangani baik POST maupun GET
        break;

    case  '/admin/prasarana/tanah/tambah':
        auth();
        $admin = new TanahController();
        $admin->create(); // Metode ini akan menangani baik POST maupun GET
        break;

    case '/admin/prasarana/gedung':
        auth();
        $admin = new GedungController();
        $admin->gedung();
        break;
    case '/admin/prasarana/ruangan':
        auth();
        $admin = new AdminController();
        $admin->ruangan();
        break;
    case '/admin/prasarana/lapang':
        auth();
        $admin = new AdminController();
        $admin->lapang();
        break;
    case '/admin/sarana/bergerak':
        auth();
        $admin = new AdminController();
        $admin->bergerak();
        break;
    case '/admin/sarana/barang':
        auth();
        $admin = new BarangController();
        $admin->barang();
        break;
    case '/admin/sarana/mebeler':
        auth();
        $admin = new AdminController();
        $admin->mebeler();
        break;
    case '/admin/sarana/alat-tulis-kantor':
        auth();
        $admin = new AdminController();
        $admin->atk();
        break;
    case '/admin/sarana/elektronik':
        auth();
        $admin = new BarangElektronikController();
        $admin->elektronik();
        break;
    // Barang


    case '/admin/barang/daftar-barang':
        auth();
        $admin = new BarangController();
        $admin->barang();
        break;

    case '/admin/barang/daftar-barang/tambah':
        auth();
        $admin = new BarangController();
        $admin->create();
        break;

    case '/admin/penempatan/list':
        auth();
        $admin = new AdminController();
        $admin->listPenempatan();
        break;
    case '/admin/penempatan/form':
        auth();
        $admin = new AdminController();
        $admin->formPenempatan();
        break;
    case '/admin/penempatan/detail':
        auth();
        $admin = new AdminController();
        $admin->detailPenempatan();
        break;
    case '/admin/kondisi/daftar-kondisi':
        auth();
        $admin = new AdminController();
        $admin->daftarKondisi();
        break;

    default:
        http_response_code(404);
        echo "404 Not Found";
        break;
}
