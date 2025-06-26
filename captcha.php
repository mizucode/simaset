<?php
session_start();

// Ukuran gambar
$width = 120;
$height = 40;

// Membuat gambar
$image = imagecreatetruecolor($width, $height);

// Warna
$background_color = imagecolorallocate($image, 0, 0, 128); // Navy
$text_color = imagecolorallocate($image, 255, 255, 255); // Putih

// Isi background
imagefilledrectangle($image, 0, 0, $width, $height, $background_color);

// String acak
$captcha_code = substr(str_shuffle("ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789"), 0, 6);

// Simpan ke session
$_SESSION['captcha'] = $captcha_code;

// Path font
$font_path = __DIR__ . '/arial.ttf';
if (!file_exists($font_path)) {
  // Jika font tidak ada, tampilkan error sederhana
  imagestring($image, 5, 10, 10, 'NO FONT', $text_color);
} else {
  // Tulis captcha ke gambar
  imagettftext($image, 20, 0, 10, 30, $text_color, $font_path, $captcha_code);
}

// Header gambar
header('Content-Type: image/png');
imagepng($image);
imagedestroy($image);
