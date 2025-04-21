<?php
session_start();

$user_input = $_POST['captcha_input'] ?? '';
$captcha = $_SESSION['captcha'] ?? '';

if (strcasecmp($user_input, $captcha) == 0) {
    echo "CAPTCHA benar. Lanjut ke proses login.";
} else {
    echo "CAPTCHA salah. Silakan coba lagi.";
}
