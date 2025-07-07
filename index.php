<?php
// Matikan error display di production
// Selama development, Anda bisa set ke 1 untuk melihat error
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Mulai atau lanjutkan sesi yang ada
session_start();

// TAMBAHKAN BARIS INI:
// Jalankan middleware keamanan sesi di setiap request
require_once __DIR__ . '/config/session_security.php';

// Autoload / require route
require_once __DIR__ . '/config/route.php';

// Routing
$router = new Router();
$router->route();
