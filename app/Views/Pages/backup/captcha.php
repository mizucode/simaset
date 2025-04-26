<?php
session_start();

// Mengatur ukuran gambar
$width = 120;
$height = 40;

// Membuat gambar
$image = imagecreatetruecolor($width, $height);

// Mengatur warna
$background_color = imagecolorallocate($image, 255, 255, 255); // Putih
$text_color = imagecolorallocate($image, 0, 0, 0); // Hitam

// Mengisi latar belakang
imagefilledrectangle($image, 0, 0, $width, $height, $background_color);

// Menghasilkan string acak
$captcha_code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 6);

// Menyimpan kode CAPTCHA ke sesi
$_SESSION['captcha'] = $captcha_code;

// Menambahkan teks ke gambar
imagettftext($image, 20, 0, 10, 30, $text_color, __DIR__ . '/arial.ttf', $captcha_code);

// Mengatur header untuk gambar
header('Content-Type: image/png');

// Menghasilkan gambar
imagepng($image);
imagedestroy($image);
