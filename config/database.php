<?php

$host = 'localhost';
$user = 'root';
$pass = '';
$dbname = 'inventoribarang';

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die('Koneksi Gagal: ' . mysqli_connect_error());
}
