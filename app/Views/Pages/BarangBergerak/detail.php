<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>


        <div class="content-wrapper bg-white mb-5 pt-3 px-4">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <?php include './app/Views/Components/helper.php'; ?>
                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title text-lg">
                                        Detail Barang Bergerak
                                    </h3>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#deleteModal" data-id="<?= $detailData['id']; ?>">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                        <a href="/admin/sarana/bergerak?edit=<?= $detailData['id']; ?>" class="btn btn-warning btn-sm mr-2">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <a href="/admin/sarana/bergerak" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-3">

                                        <!-- Profile Image -->
                                        <div class="">
                                            <div class="">
                                                <div class="text-center d-flex flex-column align-items-center">
                                                    <div class="info-box bg-light" id="exportArea" style="width: 280px; height: 450px;">
                                                        <div class="info-box-content border-2 border-[#04294d] border-4 rounded" style="width: 100%; height: 100%; display: flex; flex-direction: column;">
                                                            <div class="d-flex justify-content-between align-items-center pt-3" style="flex: 0 0 auto;">
                                                                <div class="d-flex align-items-center">
                                                                    <img src="/img/logo.png" width="80" alt="">
                                                                </div>
                                                                <div class="d-flex align-items-center">
                                                                    <img src="/img/favicon.png" width="40" alt="" class="me-1">
                                                                </div>
                                                            </div>

                                                            <div class="d-flex flex-column justify-content-center align-items-center pt-2" style="flex: 0 0 auto;">
                                                                <span class="info-box-number h5"><?= htmlspecialchars($detailData['nama_detail_barang'] ?? '-') ?></span>
                                                                <span class="">REG: <?= htmlspecialchars($detailData['no_registrasi'] ?? '-') ?></span>
                                                            </div>

                                                            <!-- QR Code section - centered and larger -->
                                                            <div class="text-center mt-2" style="flex: 1 1 auto; display: flex; justify-content: center; align-items: center;">
                                                                <!-- Large QR Code Preview -->
                                                                <canvas id="qrPreview" width="200" height="200" class="d-block mx-auto"></canvas>
                                                            </div>

                                                            <!-- Scan Me section with better styling -->

                                                        </div>
                                                    </div>
                                                    <button id="downloadQR" class="btn btn-sm btn-success mt-2 mb-5">
                                                        <i class="fas fa-download mr-1"></i> Download QR Code
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- /.card-body -->
                                        </div>
                                        <!-- /.card -->

                                        <!-- About Me Box -->

                                        <!-- /.card -->
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

                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-orange"><i class="fas fa-car"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-number">Nomor Polisi</span>
                                                        <span class="info-box-text"><?= htmlspecialchars($detailData['no_polisi'] ?? '0') ?></span>
                                                    </div>
                                                </div>
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-<?= ($detailData['kondisi'] ?? 'Baik') === 'Baik' ? 'green' : ($detailData['kondisi'] === 'Rusak Ringan' ? 'warning' : ($detailData['kondisi'] === 'Rusak Berat' ? 'danger' : ($detailData['kondisi'] === 'Hilang' ? 'dark' : 'info'))) ?>">
                                                        <i class="fas fa-clipboard-check"></i>
                                                    </span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-number">Kondisi</span>
                                                        <span class="info-box-text">
                                                            <span class="badge badge-<?= ($detailData['kondisi'] ?? 'Baik') === 'Baik' ? 'success' : ($detailData['kondisi'] === 'Rusak Ringan' ? 'warning' : ($detailData['kondisi'] === 'Rusak Berat' ? 'danger' : ($detailData['kondisi'] === 'Hilang' ? 'dark' : 'info'))) ?>">
                                                                <?= htmlspecialchars($detailData['kondisi'] ?? 'Baik') ?>
                                                            </span>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-warning"><i class="fas fa-cash-register"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-number">Biaya Pembelian</span>
                                                        <span class="info-box-text text-wrap text-justify">
                                                            <?= isset($detailData['biaya_pembelian']) ? 'Rp. ' . number_format($detailData['biaya_pembelian'], 0, ',', '.') : '-' ?>
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
                                                                $tanggal = date('d-m-Y', strtotime($detailData['tanggal_pembelian']));
                                                                echo htmlspecialchars($tanggal);
                                                            } else {
                                                                echo '-';
                                                            }
                                                            ?>
                                                        </span>
                                                    </div>
                                                </div>

                                                <div class="info-box bg-light">
                                                    <span class="info-box-icon bg-primary"><i class="fas fa-database"></i></span>
                                                    <div class="info-box-content">
                                                        <span class="info-box-number">Sumber</span>
                                                        <span class="info-box-text text-wrap text-justify"><?= htmlspecialchars($detailData['sumber'] ?? '-') ?></span>
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
                                        <!-- /.card -->
                                    </div>
                                    <!-- /.col -->
                                </div>
                                <div class="border-bottom pb-2 mt-5 mb-3 flex justify-content-between">
                                    <h5 class="text-bold">
                                        File Dokumen
                                    </h5>
                                    <a href="/admin/sarana/bergerak?tambah-dokumen=<?= htmlspecialchars($detailData['id']) ?>" class="btn btn-warning btn-sm ml-auto">
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
                                                <th width="30%">Link download</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($dokumenSaranaBergerak)): ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($dokumenSaranaBergerak as $barang): ?>
                                                    <tr>
                                                        <td class="text-center"><?= $no++ ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_dokumen'] ?? '-') ?></td>
                                                        <td class="text-center">
                                                            <a href="/admin/sarana/bergerak?download-dokumen=<?= htmlspecialchars($barang['id'] ?? '-') ?>"
                                                                class="btn btn-sm btn-success" title="Download" download>
                                                                <i class="fas fa-download"></i> Download
                                                            </a>
                                                            <a href="/admin/sarana/bergerak?delete-dokumen=<?= htmlspecialchars($barang['id'] ?? '-') ?>"
                                                                class="btn btn-sm btn-danger" title="Hapus"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </a>
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

                                <!-- Dokumentasi Gambar Section -->
                                <div class="border-bottom pb-2 my-5 flex justify-content-between">
                                    <h5 class="text-bold">
                                        Dokumen Gambar
                                    </h5>
                                    <a href="/admin/sarana/bergerak?tambah-gambar=<?= htmlspecialchars($detailData['id']) ?>" class="btn btn-warning btn-sm ml-auto">
                                        <div class="text-dark">
                                            <i class="fas fa-plus mr-1"></i> Tambah Data
                                        </div>
                                    </a>
                                </div>
                                <div class="row mb-4">
                                    <?php if (!empty($dokumenGambar)): ?>
                                        <?php $no = 1; ?>
                                        <?php foreach ($dokumenGambar as $barang): ?>
                                            <div class="col-md-4 mb-3">
                                                <div class="card h-100 shadow-sm">
                                                    <div class="card-img-top splash-art-container position-relative" style="height: 200px; overflow: hidden;">
                                                        <?php if ($barang['path_dokumen'] && in_array(pathinfo($barang['path_dokumen'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif', 'webp'])): ?>
                                                            <img src="/admin/sarana/bergerak?preview-gambar=<?= htmlspecialchars($barang['id']) ?>"
                                                                alt="<?= htmlspecialchars($barang['nama_dokumen'] ?? 'Dokumen Bergerak') ?>"
                                                                class="img-fluid h-100 w-100"
                                                                style="object-fit: cover;"
                                                                loading="lazy">

                                                        <?php else: ?>
                                                            <div class="img-fluid h-100 w-100 d-flex align-items-center justify-content-center bg-light text-muted">
                                                                Tidak ada preview
                                                            </div>
                                                        <?php endif; ?>
                                                    </div>
                                                    <div class="card-body d-flex flex-column">
                                                        <h6 class="card-title text-center mb-3"><?= htmlspecialchars($barang['nama_dokumen'] ?? 'Dokumen Bergerak') ?></h6>
                                                        <div class="mt-auto text-center">
                                                            <a href="/admin/sarana/bergerak?delete-gambar=<?= htmlspecialchars($barang['id'] ?? '-') ?>"
                                                                class="btn btn-sm btn-danger" title="Hapus"
                                                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">
                                                                <i class="fas fa-trash"></i> Hapus
                                                            </a>
                                                            <a href="/admin/sarana/bergerak?preview-gambar=<?= htmlspecialchars($barang['id'] ?? '-') ?>"
                                                                class="btn btn-sm btn-primary" title="Lihat">
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
                                                Tidak ada data dokumen
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





        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus barang ini? Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>

                        <a href="/admin/sarana/bergerak?delete=<?= htmlspecialchars($detailData['id'] ?? '-') ?>" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
        <?php include './app/Views/Components/footer.php'; ?>
    </div>

    <?php include './app/Views/Components/script.php'; ?>

    <!-- Ekstensi untuk lightbox gambar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jsbarcode@3.11.5/dist/JsBarcode.all.min.js"></script>
    <!-- Library untuk generate QR Code -->
    <script src="https://cdn.jsdelivr.net/npm/qrcode@1.5.1/build/qrcode.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/html2canvas@1.4/dist/html2canvas.min.js"></script>

    <script>
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

                // Set URL hapus ke tombol Hapus di modal
                $('#deleteButton').attr('href', deleteUrl);
            });

            var noRegistrasi = "<?= htmlspecialchars($detailData['no_registrasi'] ?? '') ?>";
            if (noRegistrasi) {
                QRCode.toCanvas(document.getElementById('qrPreview'), noRegistrasi, {
                    width: 240,
                    margin: 1,
                    color: {
                        dark: '#000000',
                        light: '#f9fafa'
                    }
                });
            }

            document.getElementById("downloadQR").addEventListener("click", function() {
                const target = document.getElementById("exportArea");
                html2canvas(target, {
                    scale: 2,
                    useCORS: true,
                    logging: true,
                    allowTaint: true
                }).then(canvas => {
                    const link = document.createElement("a");
                    link.download = "<?= htmlspecialchars($detailData['nama_detail_barang'] ?? '-') ?>.png";
                    link.href = canvas.toDataURL("image/png");
                    link.click();
                });
            });
        });
    </script>
</body>

</html>