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
    // Prasarana - Gedung
    '/admin/prasarana/gedung',
    '/admin/prasarana/gedung/tambah',
    // Prasarana Ruang
    '/admin/prasarana/ruang',
    '/admin/prasarana/ruang/tambah',
    // 
    '/admin/prasarana/lapang',
    '/admin/prasarana/lapang/tambah',
    // 

    '/admin/sarana/bergerak',
    '/admin/sarana/barang',
    '/admin/sarana/mebeler',

    '/admin/sarana/atk',
    '/admin/sarana/elektronik',
    '/admin/penempatan/list',
    '/admin/penempatan/form',
    '/admin/penempatan/detail',
    '/admin/kondisi/daftar-kondisi',
    '/admin/barang/daftar-barang',
    // route barang
    '/admin/barang/kategori-barang',
    '/admin/barang/kategori-barang/tambah',
    // route penempatan
    '/admin/penempatan/daftar-barang',
    '/admin/penempatan/daftar-barang/tambah',
    '/admin/penempatan/kategori-barang/tambah',

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
    case '/admin/prasarana/gedung/tambah':
        auth();
        $admin = new GedungController();
        $admin->create();
        break;
    case '/admin/prasarana/ruang':
        auth();
        $admin = new RuangController();
        $admin->ruang();
        break;
    case '/admin/prasarana/ruang/tambah':
        auth();
        $admin = new RuangController();
        $admin->create();
        break;
    case '/admin/prasarana/lapang':
        auth();
        $admin = new LapangController();
        $admin->lapang();
        break;
    case '/admin/prasarana/lapang/tambah':
        auth();
        $admin = new LapangController();
        $admin->create();
        break;
    case '/admin/sarana/bergerak':
        auth();
        $admin = new BarangBergerakController();
        $admin->bergerak();
        break;
    case '/admin/sarana/barang':
        auth();
        $admin = new BarangController();
        $admin->barang();
        break;
    case '/admin/sarana/mebeler':
        auth();
        $admin = new BarangMebelerController();
        $admin->mebeler();
        break;
    case '/admin/sarana/atk':
        auth();
        $admin = new BarangAtkController();
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
        $admin->daftarBarang();
        break;
    case '/admin/barang/kategori-barang':
        auth();
        $admin = new BarangController();
        $admin->barang();
        break;

    case '/admin/barang/kategori-barang/tambah':
        auth();
        $admin = new BarangController();
        $admin->create();
        break;

    case '/admin/penempatan/daftar-barang':
        auth();
        $admin = new PenempatanController();
        $admin->PenempatanBarang();
        break;
    case '/admin/penempatan/daftar-barang/tambah':
        auth();
        $admin = new PenempatanController();
        $admin->create();
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
