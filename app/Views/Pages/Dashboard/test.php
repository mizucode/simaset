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
    <!-- <link rel="stylesheet" href="style.css"> Jika Anda punya file CSS terpisah -->
    <style>
        /* General Body and Page Setup */
        body {
            font-family: 'Roboto', 'Arial', sans-serif;
            /* Fallback ke Arial */
            margin: 0;
            padding: 20px;
            background-color: #f4f6f8;
            /* Warna latar lebih lembut */
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            color: #333;
            /* Warna teks default */
        }

        .a4-page {
            width: 210mm;
            min-height: 297mm;
            margin: 0 auto 20px auto;
            padding: 5mm;
            /* Padding dalam halaman A4 */
            background-color: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            /* Bayangan lebih halus */
            box-sizing: border-box;

            display: flex;
            flex-direction: row;
            flex-wrap: wrap;
            justify-content: space-around;
            /* Distribusi ruang horizontal */
            align-items: flex-start;
            align-content: flex-start;
            /* Penting untuk baris flex saat wrap */
            gap: 10mm 5mm;
            /* Jarak antar stiker (baris kolom) */
        }

        .sticker-item {
            /* Tidak perlu margin tambahan di sini jika sudah menggunakan 'gap' pada parent */
            page-break-inside: avoid;
            /* Hindari stiker terpotong saat print */
        }

        /* Styling untuk .info-box dan elemen di dalamnya */
        .info-box {
            width: 220px;
            /* Sesuaikan dengan perhitungan agar 3 muat di A4 */
            height: 350px;
            /* Sesuaikan tinggi stiker */
            box-sizing: border-box;
            overflow: hidden;
            background-color: #ffffff;
            /* Pastikan stiker putih jika ada shadow */
            border-radius: 10px;
            /* Sudut lebih rounded */
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
            /* Bayangan halus pada stiker */
        }

        .info-box-content {
            width: 100%;
            height: 100%;
            border: 2px solid #04294d;
            /* Border sedikit lebih tipis */
            border-radius: 10px;
            /* Sinkronkan dengan .info-box */
            box-sizing: border-box;
            padding: 12px;
            /* Padding internal seragam */
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Header Section: Logo and Favicon */
        .header-section {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 10px;
            /* Jarak ke bawah */
            border-bottom: 1px solid #e0e0e0;
            /* Garis pemisah halus */
            margin-bottom: 10px;
            /* Jarak setelah garis */
            flex: 0 0 auto;
        }

        .logo-container img,
        .favicon-container img {
            display: block;
            max-width: 100%;
            height: auto;
            /* Untuk responsivitas gambar */
        }

        .favicon-container img {
            margin-right: 3px;
        }

        /* Item Details Section */
        .item-details {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            flex: 0 0 auto;
            /* Tidak tumbuh, tidak menyusut, ukuran otomatis */
            margin-bottom: 10px;
            /* Jarak ke QR code */
            padding: 5px 0;
        }

        .info-box-number.item-name {
            font-size: 1.1rem;
            /* Sedikit lebih besar */
            font-weight: 700;
            /* Lebih tebal (bold) */
            margin-bottom: 5px;
            color: #2c3e50;
            /* Warna nama item lebih lembut */
            word-break: break-word;
            line-height: 1.3;
        }

        .item-reg {
            font-size: 0.85rem;
            color: #555e68;
            /* Warna abu-abu lebih modern */
        }

        /* QR Code Section */
        .qr-code-section {
            text-align: center;
            flex: 1 1 auto;
            /* Biarkan mengisi sisa ruang */
            display: flex;
            flex-direction: column;
            justify-content: center;
            /* Pusatkan QR secara vertikal */
            align-items: center;
            /* Pusatkan QR secara horizontal */
            margin-top: auto;
            /* Dorong ke bawah jika ada sisa ruang */
        }

        /* Container untuk QR code yang dihasilkan qrcode.js */
        .qr-code-container {
            width: 130px;
            /* Sesuaikan dengan opsi width/height di qrcode.js */
            height: 130px;
            margin: 0 auto;
            /* Pusatkan jika ada ruang ekstra */
            display: flex;
            /* Untuk memusatkan canvas jika ukurannya beda */
            justify-content: center;
            align-items: center;
        }

        .qr-code-container img,
        .qr-code-container canvas {
            /* qrcode.js menghasilkan img atau canvas, pastikan ukurannya pas */
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
        }


        .scan-me-text {
            margin-top: 10px;
            /* Jarak dari QR code */
            font-weight: 500;
            /* Medium weight */
            font-size: 0.9rem;
            color: #04294d;
            text-transform: uppercase;
            /* Kapital untuk penekanan */
        }

        /* Print Instructions (non-printable area) */
        .print-instructions {
            margin-top: 30px;
            padding: 20px;
            background-color: #e9f5ff;
            /* Warna info biru muda */
            border: 1px solid #b8d6eb;
            border-radius: 8px;
            color: #31708f;
            /* Warna teks untuk info */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
        }

        .print-instructions h3 {
            margin-top: 0;
            color: #23527c;
        }

        .print-instructions ol {
            margin-left: 20px;
            padding-left: 0;
            /* Reset padding default */
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
                /* Pastikan teks hitam saat print */
            }

            .a4-page {
                width: 100%;
                min-height: initial;
                /* Biarkan konten menentukan tinggi */
                height: auto;
                margin: 0;
                padding: 0;
                box-shadow: none;
                gap: 10mm 5mm;
                /* Pastikan gap diterapkan saat print */
                align-content: flex-start;
            }

            .sticker-item {
                /* page-break-inside: avoid; sudah di atas */
            }

            .info-box {
                box-shadow: none;
                /* Hilangkan bayangan stiker saat print */
            }

            .info-box-content {
                border: 2px solid #000000;
                /* Border hitam solid untuk print */
            }

            .scan-me-text,
            .item-name,
            .item-reg {
                color: #000000 !important;
                /* Pastikan semua teks penting hitam */
            }

            .header-section {
                border-bottom-color: #ccc;
                /* Garis pemisah lebih terang untuk print jika perlu */
            }


            .print-instructions {
                display: none;
            }
        }

        /* Pengaturan margin halaman untuk print */
        @page {
            size: A4 portrait;
            margin: 5mm;
            /* Margin printer, bisa disesuaikan */
        }
    </style>
</head>

<body>
    <div class="a4-page">
        <?php
        // Dummy data for testing if $saranaData is not available
        if (!isset($saranaData) || empty($saranaData)) {
            $saranaData = [
                ['id' => '001', 'nama_detail_barang' => 'Laptop Lenovo ThinkPad X1 Carbon Gen 9 Ruang Rapat Lt.3 No.Inv/Aset: LPTP/2023/001', 'no_registrasi' => 'ASSET-2023-001'],
                ['id' => '002', 'nama_detail_barang' => 'Proyektor Epson EB-S400 Aula Utama No.Inv/Aset: PROJ/2022/005', 'no_registrasi' => 'ASSET-2022-005'],
                ['id' => '003', 'nama_detail_barang' => 'Printer HP LaserJet Pro M404dn Ruang Admin Lt.1', 'no_registrasi' => 'ASSET-2023-017'],
                ['id' => '004', 'nama_detail_barang' => 'Meja Kerja Staff Kayu Jati Solid Ukuran Besar Sekali Panjang', 'no_registrasi' => 'FURN-2021-102'],
                ['id' => '005', 'nama_detail_barang' => 'Kursi Ergonomis Manager', 'no_registrasi' => 'FURN-2021-103'],
                ['id' => '006', 'nama_detail_barang' => 'AC Split 1PK Panasonic', 'no_registrasi' => 'ELEK-2023-050'],
            ];
        }
        ?>

        <?php foreach ($saranaData as $detailData): ?>
            <div class="sticker-item">
                <div class="info-box">
                    <div class="info-box-content">
                        <div class="header-section">
                            <div class="logo-container">
                                <!-- Pastikan path logo benar -->
                                <img src="/img/logo.png" width="70" alt="Logo Perusahaan">
                            </div>
                            <div class="favicon-container">
                                <!-- Pastikan path favicon benar -->
                                <img src="/img/favicon.png" width="35" alt="Favicon">
                            </div>
                        </div>

                        <div class="item-details">
                            <span class="info-box-number item-name"><?= htmlspecialchars($detailData['nama_detail_barang'] ?? 'Nama Barang Tidak Tersedia') ?></span>
                            <?php
                            $nomorRegistrasi = $detailData['no_registrasi'] ?? 'REG-TIDAK-ADA';
                            ?>
                            <span class="item-reg">REG: <?= htmlspecialchars($nomorRegistrasi) ?></span>
                        </div>

                        <div class="qr-code-section">
                            <?php
                            $qrCodeData = htmlspecialchars($nomorRegistrasi);
                            $canvasId = "qrCanvas_" . htmlspecialchars($detailData['id'] ?? uniqid());
                            ?>
                            <div id="<?= $canvasId ?>" class="qr-code-container" data-qr-content="<?= $qrCodeData ?>">
                                <!-- QR Code akan digenerate oleh JavaScript di sini -->
                            </div>
                            <span class="scan-me-text">SCAN DI SINI</span>
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
            <li>Tekan **Ctrl+P** (atau Cmd+P di Mac) untuk membuka dialog print.</li>
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
            <li>Pastikan opsi **"Grafis latar belakang"** (Background graphics) **DICENTANG**.</li>
            <li>Cetak pada kertas stiker A4.</li>
        </ol>
        <p><em><strong>Catatan:</strong> Setiap stiker berukuran sekitar 65mm x 90mm (setelah konversi dari px dan memperhitungkan padding halaman A4 dan gap antar stiker). Tiga stiker akan pas berjajar horizontal pada kertas A4.</em></p>
    </div>

    <!-- Library untuk generate QR Code -->
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs@gh-pages/qrcode.min.js"></script>

    <!-- jQuery (jika masih dibutuhkan untuk script lain, Ekko Lightbox butuh ini) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Ekko Lightbox (jika digunakan di halaman lain, tidak relevan langsung untuk stiker) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <!-- html2canvas (jika digunakan, biasanya untuk download satu elemen, bukan untuk print massal) -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script> -->


    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const qrContainers = document.querySelectorAll('.qr-code-container');

            qrContainers.forEach(function(container) {
                const content = container.getAttribute('data-qr-content');
                const containerId = container.id;

                if (content && containerId) {
                    try {
                        new QRCode(containerId, {
                            text: content,
                            width: 120, // Ukuran rendering internal QR Code, sesuaikan dengan .qr-code-container
                            height: 120,
                            colorDark: "#000000", // Hitam untuk kontras maksimal saat scan
                            colorLight: "#ffffff",
                            correctLevel: QRCode.CorrectLevel.H
                        });
                    } catch (e) {
                        console.error("Error generating QR Code for container ID: " + containerId, e);
                        container.innerHTML = "Error QR"; // Pesan error jika gagal
                    }
                } else {
                    console.warn("QR Code container missing ID or data-qr-content:", container);
                    if (container) container.innerHTML = "Data QR Hilang";
                }
            });
        });

        // Script berikut mungkin berasal dari halaman lain atau untuk fungsionalitas
        // yang tidak secara langsung berhubungan dengan tampilan/print stiker massal ini.
        // Anda bisa menghapusnya jika tidak relevan untuk halaman ini.
        /*
        $(document).ready(function() {
            // Inisialisasi lightbox untuk gambar dokumentasi
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });

            // Tangkap event klik tombol delete
            $('button[data-target="#deleteModal"]').on('click', function() {
                var id = $(this).data('id');
                var deleteUrl = '/admin/sarana/bergerak?delete=' + id;
                $('#deleteButton').attr('href', deleteUrl);
            });

            // Bagian ini sepertinya untuk satu QR code tunggal di halaman detail, bukan untuk loop stiker.
            // var noRegistrasi = "<? //= htmlspecialchars($detailData['no_registrasi'] ?? '') 
                                    ?>"; // $detailData tidak akan ada di scope ini
            // if (noRegistrasi && document.getElementById('qrPreview')) {
            //     QRCode.toCanvas(document.getElementById('qrPreview'), noRegistrasi, {
            //         width: 240,
            //         margin: 1,
            //         color: {
            //             dark: '#000000',
            //             light: '#f9fafa'
            //         }
            //     });
            // }

            // Ini juga untuk satu elemen spesifik 'exportArea', tidak cocok untuk multiple stiker.
            // Jika ingin download, mungkin perlu mekanisme per stiker atau download semua sebagai PDF.
            // const exportAreaButton = document.getElementById("downloadQR");
            // if (exportAreaButton) {
            //    exportAreaButton.addEventListener("click", function() {
            //        const target = document.getElementById("exportArea"); // 'exportArea' harus unik per stiker jika mau individual download
            //        if(target) {
            //            html2canvas(target, {
            //                scale: 2,
            //                useCORS: true,
            //                logging: true,
            //                allowTaint: true
            //            }).then(canvas => {
            //                const link = document.createElement("a");
            //                link.download = "nama_file_stiker.png"; // Perlu nama file dinamis
            //                link.href = canvas.toDataURL("image/png");
            //                link.click();
            //            });
            //        }
            //    });
            // }
        });
        */
    </script>
</body>

</html>