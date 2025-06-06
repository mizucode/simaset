<?php
// Matikan error display di production
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(E_ALL);

session_start();


// Autoload / require route
require_once __DIR__ . '/config/route.php';

// Routing
$router = new Router();
$router->route();
