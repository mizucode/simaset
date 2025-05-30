<?php
// Matikan error display di production dan log error ke file
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);
ini_set('log_errors', 1);
ini_set('error_log', __DIR__ . '/logs/error.log');

// Set header keamanan
header("X-Frame-Options: DENY");
header("X-Content-Type-Options: nosniff");
header("X-XSS-Protection: 1; mode=block");
header("Referrer-Policy: strict-origin-when-cross-origin");

// Pastikan folder log tersedia
if (!is_dir(__DIR__ . '/logs')) {
  mkdir(__DIR__ . '/logs', 0755, true);
}

// Mulai session dengan konfigurasi aman
session_start([
  'name' => 'SecureSessionID',
  'cookie_lifetime' => 86400,
  'cookie_httponly' => true,
  'cookie_secure' => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on',
  'cookie_samesite' => 'Strict',
  'use_strict_mode' => true,
  'use_only_cookies' => 1
]);

// Hindari session fixation dan validasi IP/User-Agent
if (!isset($_SESSION['initiated'])) {
  session_regenerate_id(true);
  $_SESSION['initiated'] = true;
  $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'] ?? '';
  $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'] ?? '';
} else {
  if (
    ($_SESSION['ip_address'] ?? '') !== ($_SERVER['REMOTE_ADDR'] ?? '') ||
    ($_SESSION['user_agent'] ?? '') !== ($_SERVER['HTTP_USER_AGENT'] ?? '')
  ) {
    session_unset();
    session_destroy();
    session_start();
    session_regenerate_id(true);
    die('Session tidak valid!');
  }
}

// Regenerasi ID session setiap 5 menit
if (!isset($_SESSION['last_regeneration']) || time() - $_SESSION['last_regeneration'] >= 300) {
  session_regenerate_id(true);
  $_SESSION['last_regeneration'] = time();
}

// Fungsi untuk membersihkan input
function clean_input($data) {
  return htmlspecialchars(trim(stripslashes($data)), ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

// Bersihkan semua input GET, POST, dan COOKIE (hati-hati pada data penting)
foreach ($_GET as $key => $value) {
  $_GET[$key] = clean_input($value);
}
foreach ($_POST as $key => $value) {
  $_POST[$key] = clean_input($value);
}
foreach ($_COOKIE as $key => $value) {
  $_COOKIE[$key] = clean_input($value);
}

// Autoload / require route
require_once __DIR__ . '/config/route.php';

// Routing
$router = new Router();
$router->route();
