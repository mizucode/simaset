<?php
$customQrBaseUrl = "http://simaset.test";

// Jika font tidak ada, tampilkan error sederhana
if (!file_exists($font_path)) {
  imagestring($image, 5, 10, 10, 'NO FONT', $text_color);
} else {
  // Tulis captcha ke gambar
  $result = imagettftext($image, 20, 0, 10, 30, $text_color, $font_path, $captcha_code);
  if ($result === false) {
    imagestring($image, 5, 10, 10, 'TTF ERR', $text_color);
  }
}
