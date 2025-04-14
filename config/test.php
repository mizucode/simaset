<?php
require_once 'database.php';

if ($conn) {
    echo "Koneksi Database Berhasil!";
} else {
    echo "Koneksi Gagal: " . mysqli_connect_error();
}
