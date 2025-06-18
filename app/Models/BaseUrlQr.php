<?php

class BaseUrlQr
{
  public static function BaseUrlQr()
  {
    $BaseUrlQr = "http://simaset.test";
    return $BaseUrlQr;
  }

  public static function getWhatsappMessage($namaPeminjam = "Peminjam Yth", $namaDetailBarang = "Barang", $noRegistrasi = "N/A")
  {
    date_default_timezone_set('Asia/Jakarta');
    $hour = (int)date('H');
    $greeting = "Assalamualaikum Wr. Wb.";

    if ($hour >= 5 && $hour < 10) {
      $greeting .= ", selamat pagi";
    } elseif ($hour >= 10 && $hour < 15) {
      $greeting .= ", selamat siang";
    } elseif ($hour >= 15 && $hour < 19) {
      $greeting .= ", selamat sore";
    } else {
      $greeting .= ", selamat malam";
    }

    $message = $greeting . " Sdr/i *" . htmlspecialchars($namaPeminjam) . "*. Kami dari bidang Sarpras Universitas Muhammadiyah Kuningan ingin mengingatkan bahwa barang yang Anda pinjam yaitu *" . htmlspecialchars($namaDetailBarang) . "* dengan kode registrasi *" . htmlspecialchars($noRegistrasi) . "* diharapkan untuk segera dikembalikan. Terima kasih atas perhatiannya. Wassalamualaikum Wr. Wb.";
    return rawurlencode($message);
  }
}
