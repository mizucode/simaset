<?php
session_start();

// Menghasilkan string acak untuk CAPTCHA
function generateRandomString($length = 6)
{
    return substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, $length);
}

// Mengatur teks CAPTCHA
$captchaText = generateRandomString();
$_SESSION['captcha'] = $captchaText;

// Mengatur ukuran gambar
$width = 150;
$height = 50;

// Membuat gambar
$image = imagecreatetruecolor($width, $height);

// Mengatur warna
$backgroundColor = imagecolorallocate($image, 255, 255, 255); // Putih
$textColor = imagecolorallocate($image, 0, 0, 0); // Hitam

// Mengisi latar belakang
imagefilledrectangle($image, 0, 0, $width, $height, $backgroundColor);

// Menambahkan teks ke gambar
$fontSize = 20;
$fontFile = __DIR__ . '/arial.ttf'; // Pastikan Anda memiliki file font TTF
imagettftext($image, $fontSize, 0, 10, 30, $textColor, $fontFile, $captchaText);

// Mengatur header untuk gambar
header('Content-Type: image/png');

// Menghasilkan gambar
imagepng($image);
imagedestroy($image);
