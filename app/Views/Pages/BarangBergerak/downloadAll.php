<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Stiker Barang A4 (3 per Halaman - Ukuran Disesuaikan)</title>
  <!-- Google Fonts: Roboto -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <!-- Font Awesome (diperlukan untuk ikon fas fa-qrcode dan fa-print) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <style>
    /* General Body and Page Setup */
    body {
      font-family: 'Roboto', 'Arial', sans-serif;
      margin: 0;
      padding: 20px;
      background-color: #f4f6f8;
      -webkit-font-smoothing: antialiased;
      -moz-osx-font-smoothing: grayscale;
      color: #333;
    }

    .print-button-container {
      text-align: center;
      margin-bottom: 20px;
    }

    .print-action-button {
      padding: 12px 25px;
      font-size: 1.1rem;
      background-color: #007bff;
      /* Warna biru yang umum */
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      transition: background-color 0.3s ease;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .print-action-button:hover {
      background-color: #0056b3;
      /* Warna biru lebih gelap saat hover */
    }

    .print-action-button i {
      margin-right: 8px;
    }


    .a4-page {
      width: 210mm;
      min-height: 297mm;
      margin: 0 auto 20px auto;
      padding: 5mm;
      background-color: white;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      box-sizing: border-box;
      display: flex;
      flex-direction: row;
      flex-wrap: wrap;
      justify-content: space-around;
      align-items: flex-start;
      align-content: flex-start;
      gap: 10mm 5mm;
      /* Sesuaikan gap ini jika perlu */
    }

    .sticker-item {
      page-break-inside: avoid;
    }

    /* === KODE CARD BARU CSS START === */
    .stk-card {
      width: 220px;
      /* Sekitar 58.2mm - Cek agar 3 muat + gap di 210mm */
      height: 350px;
      /* Sekitar 92.6mm */
      box-sizing: border-box;
      overflow: hidden;
      background-color: #ffffff;
      border-radius: 10px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
      page-break-inside: avoid;
    }

    .stk-content {
      width: 100%;
      height: 100%;
      border: 2px solid #04294d;
      border-radius: 10px;
      box-sizing: border-box;
      padding: 12px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }

    .stk-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-bottom: 10px;
      border-bottom: 1px solid #e0e0e0;
      margin-bottom: 10px;
      flex: 0 0 auto;
    }

    .stk-logo-wrapper img,
    .stk-favicon-wrapper img {
      display: block;
      max-width: 100%;
      height: auto;
    }

    .stk-favicon-wrapper img {
      margin-right: 3px;
    }

    .stk-item-info {
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      text-align: center;
      flex: 0 0 auto;
      margin-bottom: 10px;
      padding: 5px 0;
    }

    .stk-item-name {
      font-size: 1.1rem;
      font-weight: 700;
      margin-bottom: 5px;
      color: #2c3e50;
      word-break: break-word;
      line-height: 1.3;
      /* Batasi tinggi dan tampilkan elipsis jika terlalu panjang */
      max-height: calc(1.3em * 3);
      /* Sekitar 3 baris */
      overflow: hidden;
      text-overflow: ellipsis;
      display: -webkit-box;
      /* autoprefixer: ignore next */
      -webkit-line-clamp: 3;
      -webkit-box-orient: vertical;
    }

    .stk-item-reg-number {
      font-size: 0.85rem;
      color: #555e68;
    }

    .stk-qr-area {
      text-align: center;
      flex: 1 1 auto;
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      margin-top: auto;
      /* Dorong ke bawah */
    }

    .stk-qr-image-container {
      width: 150px;
      height: 150px;
      margin: 0 auto;
      /* Pusatkan QR */
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .stk-qr-image-container img,
    .stk-qr-image-container canvas {
      max-width: 100%;
      max-height: 100%;
      object-fit: contain;
    }

    .stk-scan-text {
      margin-top: 10px;
      font-weight: 500;
      font-size: 0.9rem;
      text-transform: uppercase;
      font-weight: bold;
    }

    .text-navy {
      color: #04294d !important;
    }

    /* === KODE CARD BARU CSS END === */


    /* Print Instructions (non-printable area) */
    .print-instructions {
      margin-top: 30px;
      padding: 20px;
      background-color: #e9f5ff;
      border: 1px solid #b8d6eb;
      border-radius: 8px;
      color: #31708f;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
    }

    .print-instructions h3 {
      margin-top: 0;
      color: #23527c;
    }

    .print-instructions ol {
      margin-left: 20px;
      padding-left: 0;
    }

    .print-instructions li {
      margin-bottom: 5px;
    }


    /* Print Specific Styles */
    @media print {
      body {
        padding: 0;
        margin: 0;
        background-color: white;
        color: #000;
        -webkit-print-color-adjust: exact !important;
        /* Chrome, Safari, Edge */
        color-adjust: exact !important;
        /* Firefox */
      }

      .print-button-container {
        display: none;
      }

      .a4-page {
        width: 100%;
        min-height: initial;
        height: auto;
        margin: 0;
        padding: 0;
        box-shadow: none;
        gap: 10mm 5mm;
        /* Pastikan gap konsisten atau sesuaikan jika perlu */
        align-content: flex-start;
      }

      .stk-card {
        box-shadow: none;
      }




      .stk-header {
        border-bottom-color: #adadad !important;
      }

      .print-instructions {
        display: none;
      }
    }

    @page {
      size: A4 portrait;
      margin: 5mm;
      /* Sesuaikan margin ini dengan printer Anda */
    }
  </style>
</head>

<body>

  <div class="print-button-container">
    <button id="printButton" class="print-action-button">
      <i class="fas fa-print"></i> Cetak Stiker
    </button>
  </div>

  <div class="a4-page" id="pageToPrint">
    <?php
    // $saranaData is passed by the controller. This is the full list for the category.
    $dataToDisplay = []; // Initialize with empty

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['selected_ids']) && is_array($_POST['selected_ids'])) {
      // This is a "Download Selected QR" action
      $selectedIds = $_POST['selected_ids'];
      // Ensure $saranaData from controller exists and is an array before filtering
      if (!empty($selectedIds) && isset($saranaData) && is_array($saranaData)) {
        $dataToDisplay = array_filter($saranaData, function ($item) use ($selectedIds) {
          return isset($item['id']) && in_array((string)$item['id'], $selectedIds);
        });
      }
      // If $selectedIds is empty, $dataToDisplay remains [], which is correct (display no items).
    } else {
      // This is a "Download All QR" action or direct access without selection
      if (isset($saranaData) && !empty($saranaData)) {
        $dataToDisplay = $saranaData;
      } else {
        // Fallback to mock data ONLY if controller sent nothing for "Download All"
        $dataToDisplay = [
          ['id' => '1', 'nama_detail_barang' => 'Mobil Avanza Mockup', 'no_registrasi' => 'MOCK-BGR-AVZ-001'],
          ['id' => '2', 'nama_detail_barang' => 'Motor Vario Mockup', 'no_registrasi' => 'MOCK-BGR-VRO-002'],
        ];
      }
    }
    ?>
    <?php foreach ($dataToDisplay as $detailData): ?>
      <?php
      $itemId = htmlspecialchars($detailData['id'] ?? uniqid());
      $namaBarang = $detailData['nama_detail_barang'] ?? 'Nama Barang Tidak Tersedia';
      $nomorRegistrasi = $detailData['no_registrasi'] ?? 'REG-TIDAK-ADA';
      $qrContainerId = "stkQrCanvas_" . $itemId;
      $qrContentForJs = "";
      // Menggunakan no_registrasi untuk URL detail jika tersedia
      if (!empty($nomorRegistrasi) && $nomorRegistrasi !== 'REG-TIDAK-ADA') {
        $qrPath = "/admin/sarana/bergerak/detail/" . urlencode($nomorRegistrasi);
        $qrContentForJs = rtrim($BaseUrlQr, '/') . $qrPath;
      } else {
        // Fallback jika no_registrasi tidak ada, bisa menggunakan ID atau pesan error
        // Untuk konsistensi, jika no_registrasi tidak ada, QR mungkin tidak valid atau mengarah ke error
        $qrContentForJs = $nomorRegistrasi;
      }

      ?>
      <div class="sticker-item">
        <div class="stk-card" id="qrCardToExport_<?= $itemId ?>">
          <div class="stk-content">
            <div class="stk-header">
              <div class="stk-logo-wrapper">
                <img src="/img/logo.png" width="70" alt="Logo Perusahaan">
              </div>
              <div class="stk-favicon-wrapper">
                <img src="/img/logo.svg" width="35" alt="Favicon">
              </div>
            </div>

            <div class="stk-item-info">
              <span class="stk-item-name"><?= htmlspecialchars($namaBarang) ?></span>
              <span class="stk-item-reg-number">REG: <?= htmlspecialchars($nomorRegistrasi) ?></span>
            </div>

            <div class="stk-qr-area">
              <div id="<?= $qrContainerId ?>" class="stk-qr-image-container" data-qr-content="<?= htmlspecialchars($qrContentForJs) ?>">
              </div>
              <span class="stk-scan-text text-navy pt-2">
                <i class="fas fa-qrcode mr-1"></i> SCAN DI SINI
              </span>
            </div>
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="print-instructions">
    <h3>Petunjuk Mencetak Stiker</h3>
    <ol>
      <li>Gunakan browser **Chrome** atau **Firefox** untuk hasil terbaik.</li>
      <li>Tekan **Ctrl+P** (atau Cmd+P di Mac) atau klik tombol **"Cetak Stiker"** di atas untuk membuka dialog print.</li>
      <li>Set **Destinasi** ke printer Anda.</li>
      <li>Set **Layout** ke "Portrait".</li>
      <li>Set **Ukuran Kertas** ke "A4".</li>
      <li>Set **Margin**:
        <ul>
          <li>Disarankan: "Minimum" atau "Minimal".</li>
          <li>Atau: "Default" jika printer Anda memiliki margin bawaan yang kecil.</li>
          <li>Jika printer mendukung: "None" untuk cetak tanpa batas (borderless).</li>
        </ul>
      </li>
      <li>Set **Skala** ke "Default" atau "100%". (Ukuran stiker sudah disesuaikan).</li>
      <li>Pastikan opsi **"Grafis latar belakang"** (Background graphics) **DICENTANG**. Jika tidak, border dan warna mungkin tidak tercetak.</li>
      <li>Cetak pada kertas stiker A4.</li>
    </ol>
    <p><em><strong>Catatan:</strong> Setiap stiker berukuran sekitar 220px (lebar) x 350px (tinggi). Ukuran aktual dalam mm: lebar ~58mm, tinggi ~92mm. Pastikan 3 stiker dengan gap 5mm (total 15mm) muat dalam lebar A4 (210mm - 10mm margin = 200mm). 58*3 + 5*2 = 174 + 10 = 184mm. Ini seharusnya muat.</em></p>
  </div>

  <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs@gh-pages/qrcode.min.js"></script>


  <script>
    document.addEventListener('DOMContentLoaded', function() {

      const qrContainers = document.querySelectorAll('.stk-qr-image-container');
      <?= htmlspecialchars($BaseUrlQr ?? '', ENT_QUOTES, 'UTF-8'); ?>

      qrContainers.forEach(function(container) {
        const qrContent = container.getAttribute('data-qr-content');
        const containerId = container.id;

        if (qrContent) {
          try {
            new QRCode(container, {
              text: qrContent,
              width: 140,
              height: 140,
              colorDark: "#000000",
              colorLight: "#ffffff",
              correctLevel: QRCode.CorrectLevel.H
            });

          } catch (e) {
            console.error("Error generating QR Code for container ID:", containerId, "with content:", qrContent, e);
            container.innerHTML = "<small style='color:red; font-size:10px;'>Error QR</small>";
          }
        } else {
          console.warn("Atribut 'data-qr-content' kosong atau tidak ditemukan untuk kontainer:", containerId);
          container.innerHTML = "<small style='color:orange; font-size:10px;'>Konten QR Kosong</small>";
        }
      });

      const printButton = document.getElementById('printButton');
      if (printButton) {
        printButton.addEventListener('click', function() {
          window.print();
        });
      }



    });
  </script>

</body>

</html>