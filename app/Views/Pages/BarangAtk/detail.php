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
                                        Detail Barang ATK
                                    </h3>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#deleteModal" data-id="<?= $detailData['id']; ?>">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                        <a href="/admin/sarana/atk?edit=<?= $detailData['id']; ?>" class="btn btn-warning btn-sm mr-2">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <a href="/admin/sarana/atk" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-success"><i class="fas fa-barcode"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">No Registrasi</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['no_registrasi'] ?? '-') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-info"><i class="fas fa-box-open"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Nama Barang</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['nama_detail_barang'] ?? '-') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-purple"><i class="fas fa-tags"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Jenis Barang</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['barang'] ?? '-') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-primary"><i class="fas fa-cubes"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Jumlah</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['jumlah'] ?? '0') ?> <?= htmlspecialchars($detailData['satuan'] ?? 'Unit') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-orange"><i class="fas fa-industry"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Merk</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['merk'] ?? '-') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-<?= ($detailData['kondisi'] ?? 'Baik') === 'Baik' ? 'green' : ($detailData['kondisi'] === 'Rusak Ringan' ? 'warning' : 'danger') ?>">
                                                <i class="fas fa-heartbeat"></i>
                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Kondisi</span>
                                                <span class="info-box-number">
                                                    <span class="badge badge-<?= ($detailData['kondisi'] ?? 'Baik') === 'Baik' ? 'success' : ($detailData['kondisi'] === 'Rusak Ringan' ? 'warning' : 'danger') ?>">
                                                        <?= htmlspecialchars($detailData['kondisi'] ?? 'Baik') ?>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-bottom pb-2 mb-3">
                                    <h5 class="text-bold">
                                        Spesifikasi Barang
                                    </h5>
                                </div>

                                <div class="row">
                                    <div class="col-12">
                                        <div class="form-group">
                                            <label>Spesifikasi Lengkap</label>
                                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                                <?= htmlspecialchars($detailData['spesifikasi'] ?? 'Tidak ada spesifikasi') ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-bottom pb-2 mb-3 mt-3">
                                    <h5 class="text-bold">
                                        Informasi Tambahan
                                    </h5>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Masuk</label>
                                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                                <?= htmlspecialchars($detailData['tanggal_masuk'] ?? '-') ?>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Sumber Dana</label>
                                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                                <?= htmlspecialchars($detailData['sumber_dana'] ?? '-') ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Lokasi Penyimpanan</label>
                                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                                <?= htmlspecialchars($detailData['lokasi'] ?? '-') ?>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                                <?= htmlspecialchars($detailData['keterangan'] ?? '-') ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-bottom pb-2 mb-3 mt-3">
                                    <h5 class="text-bold">
                                        Dokumentasi Barang
                                    </h5>
                                </div>

                                <div class="row">
                                    <?php if (!empty($detailData['dokumentasi'])): ?>
                                        <?php $dokumentasi = json_decode($detailData['dokumentasi'], true); ?>
                                        <?php foreach ($dokumentasi as $index => $doc): ?>
                                            <div class="col-md-3 mb-3">
                                                <a href="<?= htmlspecialchars($doc) ?>" data-toggle="lightbox" data-gallery="dokumentasi-gallery">
                                                    <img src="<?= htmlspecialchars($doc) ?>" class="img-fluid rounded" alt="Dokumentasi <?= $index + 1 ?>">
                                                </a>
                                            </div>
                                        <?php endforeach; ?>
                                    <?php else: ?>
                                        <div class="col-12">
                                            <p class="text-muted">Tidak ada dokumentasi tersedia</p>
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
                        <p>Apakah Anda yakin ingin menghapus barang ATK ini? Tindakan ini tidak dapat dibatalkan.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <a id="deleteButton" href="#" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
        <?php include './app/Views/Components/footer.php'; ?>
    </div>

    <?php include './app/Views/Components/script.php'; ?>

    <!-- Ekstensi untuk lightbox gambar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>

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
                var deleteUrl = '/admin/sarana/atk?delete=' + id;

                // Set URL hapus ke tombol Hapus di modal
                $('#deleteButton').attr('href', deleteUrl);
            });
        });
    </script>
</body>

</html>