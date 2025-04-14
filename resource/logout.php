<?php
session_start();
session_unset(); // Menghapus semua variabel sesi
session_destroy(); // Menghancurkan sesi
header("Location: /home.php"); // Arahkan ke halaman home setelah logout
exit();
