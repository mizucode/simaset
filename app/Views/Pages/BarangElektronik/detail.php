<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; // Path diasumsikan benar 
?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>
        <?php include './app/Views/Components/css.php'; // Jika ada CSS spesifik 
        ?>

        <div class="content-wrapper bg-white mb-5 pt-3 px-4">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <?php include './app/Views/Components/helper.php'; // Untuk pesan session, dll. 
                        ?>
                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title text-lg">
                                        Detail Barang Elektronik <!-- DIUBAH -->
                                    </h3>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#deleteModal" data-id="<?= htmlspecialchars($detailData['id'] ?? ''); ?>">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                        <!-- DIUBAH URL -->
                                        <a href="/admin/sarana/elektronik?edit=<?= htmlspecialchars($detailData['id'] ?? ''); ?>" class="btn btn-warning btn-sm mr-2">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <!-- DIUBAH URL -->
                                        <a href="/admin/sarana/elektronik" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="">
                                            <div class="text-center d-flex flex-column align-items-center">
                                                <?php
                                                $namaBarang = $detailData['nama_detail_barang'] ?? 'Barang Tidak Bernama';
                                                $nomorRegistrasi = $detailData['no_registrasi'] ?? 'REG-TIDAK-ADA';
                                                $qrCanvasId = "qrCanvas_" . htmlspecialchars($detailData['id'] ?? uniqid());
                                                ?>
                                                <div>
                                                    <div class="stk-card" id="qrCardToExport">
                                                        <div class="stk-content">
                                                            <div class="stk-header">
                                                                <div class="stk-logo-wrapper">
                                                                    <img src="/img/logo.png" width="70" alt="Logo Perusahaan">
                                                                </div>
                                                                <div class="stk-favicon-wrapper">
                                                                    <img src="/img/favicon.png" width="35" alt="Favicon">
                                                                </div>
                                                            </div>

                                                            <div class="stk-item-info">
                                                                <span class="stk-item-name"><?= htmlspecialchars($namaBarang) ?></span>
                                                                <span class="stk-item-reg-number">REG: <?= htmlspecialchars($nomorRegistrasi) ?></span>
                                                            </div>

                                                            <div class="stk-qr-area">
                                                                <div id="<?= $qrCanvasId ?>" class="stk-qr-image-container" data-qr-content="<?= htmlspecialchars($nomorRegistrasi) ?>">
                                                                    <!-- QR Code akan digenerate oleh JavaScript di sini -->
                                                                </div>
                                                                <span class="stk-scan-text text-navy pt-2">
                                                                    <i class="fas fa-qrcode mr-1"></i> SCAN DI SINI
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <button id="downloadQR" class="btn btn-sm btn-success mt-4 mb-5">
                                                    <i class="fas fa-download mr-1"></i> Download QR Card
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.col -->
                                    <div class="col-md-9">
                                        <div class="card">
                                            <div class="card-body">
                                                <div class="border-bottom pb-2 mb-3">
                                                    <h5 class="text-bold">
                                                        Informasi Tambahan
                                                    </h5>
                                                </div>
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-info"><i class="fas fa-box-open"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-number">Nama Barang</span>
                                                        <span class="info-box-text"><?= htmlspecialchars($detailData['nama_detail_barang'] ?? '-') ?></span>
                                                    </div>
                                                </div>
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-purple"><i class="fas fa-trademark"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-number">Merk</span>
                                                        <span class="info-box-text"><?= htmlspecialchars($detailData['merk'] ?? '-') ?></span>
                                                    </div>
                                                </div>
                                                <!-- TAMBAHKAN FIELD TIPE UNTUK ELEKTRONIK -->
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-secondary"><i class="fas fa-tag"></i></span> <!-- Ganti ikon jika perlu -->
                                                    <div class="info-box-content">
                                                        <span class="info-box-number">Tipe</span>
                                                        <span class="info-box-text text-wrap text-justify"><?= htmlspecialchars($detailData['tipe'] ?? '-') ?></span>
                                                    </div>
                                                </div>
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-primary"><i class="fas fa-boxes"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-number">Jumlah</span>
                                                        <span class="info-box-text"><?= htmlspecialchars($detailData['jumlah'] ?? '1') ?> <?= htmlspecialchars($detailData['satuan'] ?? 'Unit') ?></span>
                                                    </div>
                                                </div>
                                                <?php
                                                // Logika badge kondisi tetap sama
                                                $kondisi = $detailData['nama_kondisi'] ?? ($detailData['kondisi'] ?? 'Baik'); // Ambil dari join atau field langsung
                                                $kondisiBadge = 'info'; // Default
                                                if ($kondisi === 'Baik') $kondisiBadge = 'success';
                                                elseif ($kondisi === 'Rusak Ringan') $kondisiBadge = 'warning';
                                                elseif ($kondisi === 'Rusak Berat') $kondisiBadge = 'danger';
                                                elseif ($kondisi === 'Hilang') $kondisiBadge = 'dark';
                                                ?>
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-<?= $kondisiBadge ?>"><i class="fas fa-clipboard-check"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-number">Kondisi</span>
                                                        <span class="info-box-text">
                                                            <span class="badge badge-<?= $kondisiBadge ?>">
                                                                <?= htmlspecialchars($kondisi) ?>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-warning"><i class="fas fa-cash-register"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-number">Biaya Pembelian</span>
                                                        <span class="info-box-text text-wrap text-justify">
                                                            <?= isset($detailData['biaya_pembelian']) ? 'Rp. ' . number_format((float)$detailData['biaya_pembelian'], 0, ',', '.') : '-' ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-navy"><i class="fas fa-calendar-alt"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-number">Tanggal Pembelian</span>
                                                        <span class="info-box-text text-wrap text-justify">
                                                            <?php
                                                            if (!empty($detailData['tanggal_pembelian'])) {
                                                                try {
                                                                    $tanggal = new DateTime($detailData['tanggal_pembelian']);
                                                                    echo htmlspecialchars($tanggal->format('d F Y')); // Format lebih deskriptif
                                                                } catch (Exception $e) {
                                                                    echo htmlspecialchars($detailData['tanggal_pembelian']) . ' (format tidak valid)';
                                                                }
                                                            } else {
                                                                echo '-';
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-success"><i class="fas fa-map-marker-alt"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-number">Lokasi</span>
                                                        <span class="info-box-text text-wrap text-justify"><?= htmlspecialchars($detailData['lokasi'] ?? '-') ?></span>
                                                    </div>
                                                </div>
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-warning"><i class="fas fa-clipboard-list"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-number">Spesifikasi</span>
                                                        <span class="info-box-text text-wrap text-justify"><?= htmlspecialchars($detailData['spesifikasi'] ?? '-') ?></span>
                                                    </div>
                                                </div>
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-danger"><i class="fas fa-info-circle"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-number">Keterangan</span>
                                                        <span class="info-box-text text-wrap text-justify"><?= htmlspecialchars($detailData['keterangan'] ?? 'Tidak ada keterangan') ?></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-bottom pb-2 mt-5 mb-3 d-flex justify-content-between align-items-center">
                                    <h5 class="text-bold mb-0">
                                        File Dokumen
                                    </h5>
                                    <!-- DIUBAH URL -->
                                    <a href="/admin/sarana/elektronik?tambah-dokumen=<?= htmlspecialchars($detailData['id'] ?? '') ?>" class="btn btn-warning btn-sm">
                                        <div class="text-dark">
                                            <i class="fas fa-plus mr-1"></i> Tambah Data
                                        </div>
                                    </a>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-light">
                                            <tr class="text-center">
                                                <th width="5%">No</th>
                                                <th width="70%">Nama Dokumen</th>
                                                <th width="30%">Tindakan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <!-- DIUBAH VARIABEL LOOP -->
                                            <?php if (!empty($dokumenSaranaElektronik)): ?>
                                                <?php $no = 1; ?>
                                                <!-- DIUBAH VARIABEL ITEM LOOP -->
                                                <?php foreach ($dokumenSaranaElektronik as $dokumen): ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td><?= htmlspecialchars($dokumen['nama_dokumen'] ?? '-') ?></td>
                                                        <td class="text-center">
                                                            <!-- DIUBAH URL -->
                                                            <a href="/admin/sarana/elektronik?download-dokumen=<?= htmlspecialchars($dokumen['id'] ?? '') ?>"
                                                                class="btn btn-sm btn-success" title="Download">
                                                                <i class="fas fa-download"></i> Download
                                                            </a>
                                                            <button type="button" class="btn btn-sm btn-danger" title="Hapus"
                                                                onclick="confirmDeleteDokumen('<?= htmlspecialchars($dokumen['id'] ?? '') ?>', '<?= htmlspecialchars($detailData['id'] ?? '') ?>')">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="3" class="text-center">Tidak ada data dokumen</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="border-bottom pb-2 my-5 d-flex justify-content-between align-items-center">
                                    <h5 class="text-bold mb-0">
                                        Dokumentasi Gambar
                                    </h5>
                                    <!-- DIUBAH URL -->
                                    <a href="/admin/sarana/elektronik?tambah-gambar=<?= htmlspecialchars($detailData['id'] ?? '') ?>" class="btn btn-warning btn-sm">
                                        <div class="text-dark">
                                            <i class="fas fa-plus mr-1"></i> Tambah Data
                                        </div>
                                    </a>
                                </div>
                                <div class="row mb-4">
                                    <!-- DIUBAH VARIABEL LOOP -->
                                    <?php if (!empty($dokumenGambarElektronik)): ?>
                                        <!-- DIUBAH VARIABEL ITEM LOOP -->
                                        <?php foreach ($dokumenGambarElektronik as $gambar): ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="card h-100 shadow-sm">
                                                    <div class="card-img-top position-relative" style="height: 200px; overflow: hidden;">
                                                        <?php
                                                        $pathGambar = $gambar['path_dokumen'] ?? null; // path_dokumen adalah field di tabel dokumentasi_...
                                                        $idGambar = htmlspecialchars($gambar['id'] ?? '');
                                                        $namaDokumenGambar = htmlspecialchars($gambar['nama_dokumen'] ?? 'Dokumentasi Gambar'); // nama_dokumen adalah field di tabel
                                                        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
                                                        $extension = $pathGambar ? strtolower(pathinfo($pathGambar, PATHINFO_EXTENSION)) : '';
                                                        ?>
                                                        <?php if ($pathGambar && in_array($extension, $allowedExtensions)): ?>
                                                            <!-- DIUBAH URL -->
                                                            <a href="/admin/sarana/elektronik?preview-gambar=<?= $idGambar ?>" data-toggle="lightbox" data-title="<?= $namaDokumenGambar ?>" data-gallery="gallery-images">
                                                                <!-- DIUBAH URL -->
                                                                <img src="/admin/sarana/elektronik?preview-gambar=<?= $idGambar ?>"
                                                                    alt="<?= $namaDokumenGambar ?>"
                                                                    class="img-fluid h-100 w-100"
                                                                    style="object-fit: cover;"
                                                                    loading="lazy">
                                                            </a>
                                                        <?php else: ?>
                                                            <div class="img-fluid h-100 w-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                                                Preview Tidak Tersedia
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="card-body d-flex flex-column">
                                                        <h6 class="card-title text-center mb-3 text-truncate" title="<?= $namaDokumenGambar ?>"><?= $namaDokumenGambar ?></h6>
                                                        <div class="mt-auto text-center">
                                                            <button type="button" class="btn btn-sm btn-danger" title="Hapus Gambar"
                                                                onclick="confirmDeleteGambar('<?= $idGambar ?>', '<?= htmlspecialchars($detailData['id'] ?? '') ?>')">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </button>
                                                            <!-- DIUBAH URL -->
                                                            <a href="/admin/sarana/elektronik?preview-gambar=<?= $idGambar ?>"
                                                                class="btn btn-sm btn-primary" title="Lihat" target="_blank">
                                                                <i class="fas fa-eye"></i> Lihat
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="col-12">
                                            <div class="alert alert-info text-center" role="alert">
                                                Tidak ada dokumentasi gambar.
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Konfirmasi Hapus Barang Utama -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus Barang Elektronik</h5> <!-- DIUBAH -->
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus barang <strong id="itemNameModal"></strong>? Tindakan ini tidak dapat dibatalkan dan akan menghapus semua dokumen terkait.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <!-- URL Hapus diatur oleh JavaScript, pastikan JS di bawah juga diubah -->
                        <a href="/admin/sarana/elektronik?delete=<?= htmlspecialchars($detailData['id'] ?? '') ?>" id="confirmDeleteButton" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>

        <?php include './app/Views/Components/footer.php'; ?>
    </div>

    <?php include './app/Views/Components/script.php'; ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/davidshimjs/qrcodejs@gh-pages/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4.1/dist/html2canvas.min.js"></script>


    <script>
        // Fungsi konfirmasi hapus untuk dokumen dan gambar (agar tidak redirect langsung)
        // Fungsi confirmDelete tidak digunakan di view ini, bisa dihapus jika tidak dipakai di tempat lain
        // function confirmDelete(url, itemName, type) {
        //     if (confirm(`Apakah Anda yakin ingin menghapus ${type} "${itemName}"? Tindakan ini tidak dapat dibatalkan.`)) {
        //         window.location.href = url;
        //     }
        // }

        function confirmDeleteDokumen(dokumenId, saranaId) {
            if (confirm(`Apakah Anda yakin ingin menghapus dokumen ini? Tindakan ini tidak dapat dibatalkan.`)) {
                // DIUBAH URL
                window.location.href = `/admin/sarana/elektronik?delete-dokumen=${dokumenId}&sarana_id=${saranaId}`;
            }
        }

        function confirmDeleteGambar(gambarId, saranaId) {
            if (confirm(`Apakah Anda yakin ingin menghapus gambar ini? Tindakan ini tidak dapat dibatalkan.`)) {
                // DIUBAH URL
                window.location.href = `/admin/sarana/elektronik?delete-gambar=${gambarId}&sarana_id=${saranaId}`;
            }
        }

        $(document).ready(function() {
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox({
                    alwaysShowClose: true
                });
            });

            $('#deleteModal').on('show.bs.modal', function(event) {
                var button = $(event.relatedTarget);
                var itemId = button.data('id');
                var itemName = "<?= htmlspecialchars($detailData['nama_detail_barang'] ?? 'Barang Ini') ?>";

                var modal = $(this);
                modal.find('#itemNameModal').text(itemName);
                // DIUBAH URL
                var deleteUrl = '/admin/sarana/elektronik?delete=' + itemId;
                modal.find('#confirmDeleteButton').attr('href', deleteUrl);
            });

            const qrContainer = document.getElementById('<?= $qrCanvasId ?>');
            if (qrContainer) {
                const qrContent = qrContainer.getAttribute('data-qr-content');
                if (qrContent) {
                    try {
                        new QRCode(qrContainer, {
                            text: qrContent,
                            width: 150,
                            height: 150,
                            colorDark: "#000000",
                            colorLight: "#ffffff",
                            correctLevel: QRCode.CorrectLevel.H
                        });
                    } catch (e) {
                        console.error("Error generating QR Code for container ID: <?= $qrCanvasId ?>", e);
                        qrContainer.innerHTML = "<small>Error QR</small>";
                    }
                } else {
                    console.warn("QR Code container <?= $qrCanvasId ?> missing data-qr-content.");
                    qrContainer.innerHTML = "<small>Data QR Kosong</small>";
                }
            } else {
                console.warn("QR Code container element with ID '<?= $qrCanvasId ?>' not found.");
            }

            const downloadButton = document.getElementById("downloadQR");
            if (downloadButton) {
                downloadButton.addEventListener("click", function() {
                    const targetElement = document.getElementById("qrCardToExport");
                    const namaBarangClean = "<?= preg_replace('/[^a-zA-Z0-9_.-]/', '_', $namaBarang) ?>";
                    const nomorRegClean = "<?= preg_replace('/[^a-zA-Z0-9_.-]/', '_', $nomorRegistrasi) ?>";
                    const fileName = `QR-${namaBarangClean}-${nomorRegClean}.png`;

                    if (!targetElement) {
                        console.error("Target element for QR download ('qrCardToExport') not found!");
                        alert("Tidak dapat menemukan elemen kartu QR untuk diunduh.");
                        return;
                    }

                    html2canvas(targetElement, {
                        scale: 3,
                        useCORS: true,
                        logging: false,
                        backgroundColor: null
                    }).then(canvas => {
                        const link = document.createElement("a");
                        link.download = fileName;
                        link.href = canvas.toDataURL("image/png");
                        link.click();
                    }).catch(err => {
                        console.error("Error during html2canvas operation:", err);
                        alert("Gagal membuat gambar kartu QR. Cek console untuk detail.");
                    });
                });
            } else {
                console.warn("Download button with ID 'downloadQR' not found.");
            }
        });
    </script>
</body>

</html>