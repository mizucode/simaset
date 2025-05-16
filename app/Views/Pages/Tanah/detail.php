<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white mb-5 pt-4 px-4">

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <?php include './app/Views/Components/helper.php'; ?>
                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title mb-0">
                                        Detail Data Tanah
                                    </h3>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#modal-hapus">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                        <a href="/admin/prasarana/tanah?edit=<?= $detailData['id']; ?>" class="btn btn-warning btn-sm mr-2">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <a href="/admin/prasarana/tanah" class="btn btn-secondary btn-sm">
                                            <i class="fas fa-arrow-left mr-1"></i> Kembali
                                        </a>
                                    </div>
                                </div>
                            </div>


                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-danger"><i class="fas fa-id-card"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Nomor Sertifikat</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['nomor_sertifikat']) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-success"><i class="fas fa-map-marked-alt"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Nama Aset</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['nama_aset']) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-secondary"><i class="fas fa-calendar-alt"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Tanggal Pajak</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['tgl_pajak']) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-warning"><i class="fas fa-ruler-combined"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Luas Tanah</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['luas']) ?> m²</span>
                                            </div>
                                        </div>
                                    </div>

                                </div>



                                <div class="row mb-4">
                                    <div class="col-12">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-primary"><i class="fas fa-map-marker-alt"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Lokasi</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['lokasi']) ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="border-bottom pb-2 mb-3">
                                    <h5 class="text-bold">
                                        Informasi Tambahan
                                    </h5>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Fungsi</label>
                                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                                <?= htmlspecialchars($detailData['fungsi']) ?>
                                            </p>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Aset</label>
                                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                                <?= htmlspecialchars($detailData['jenis_aset_id']) ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <p class="form-control-plaintext border rounded p-2 bg-light">
                                                <?= htmlspecialchars($detailData['keterangan']) ?>
                                            </p>
                                        </div>
                                    </div>
                                </div>


                                <div class="border-bottom pb-2 mb-3 mt-4">
                                    <h5 class="text-bold">
                                        Dokumen
                                    </h5>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-12">
                                        <div class="card shadow-sm">
                                            <div class="card-header bg-primary text-white">
                                                <h3 class="card-title mb-0">
                                                    </i>Dokumen Sertifikat
                                                </h3>
                                            </div>
                                            <div class="card-body">
                                                <?php if (!empty($detailData['file_sertifikat'])): ?>
                                                    <div class="d-flex flex-column flex-md-row justify-content-between align-items-center p-3 bg-light rounded">
                                                        <div class="mb-2 mb-md-0">
                                                            <i class="fas fa-file-pdf text-danger mr-2"></i>
                                                            <span class="font-weight-bold"><?= htmlspecialchars(basename($detailData['file_sertifikat'])) ?></span>
                                                        </div>
                                                        <div class="d-flex flex-wrap gap-2">
                                                            <a href="/admin/prasarana/tanah?download=1&filename=<?= urlencode($detailData['file_sertifikat']); ?>&jenis=sertifikat"
                                                                class="btn btn-outline-primary btn-sm"
                                                                download>
                                                                <i class="fas fa-download mr-1"></i> Unduh
                                                            </a>
                                                            <a href="/admin/prasarana/tanah?preview=1&filename=<?= urlencode($detailData['file_sertifikat']); ?>&jenis=sertifikat"
                                                                target="_blank"
                                                                class="btn btn-info btn-sm">
                                                                <i class="fas fa-eye mr-1"></i> Pratinjau
                                                            </a>
                                                        </div>
                                                    </div>
                                                <?php else: ?>
                                                    <div class="text-center py-4">
                                                        <i class="fas fa-file-excel text-muted fa-3x mb-3"></i>
                                                        <p class="text-muted font-italic">Tidak ada dokumen sertifikat tersedia</p>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Hapus -->
        <div class="modal fade" id="modal-hapus" tabindex="-1" role="dialog" aria-labelledby="modal-hapus-label" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="modal-hapus-label">Konfirmasi Hapus Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus data tanah ini? Data yang sudah dihapus tidak dapat dikembalikan.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <a href="/admin/prasarana/tanah?delete=<?= $detailData['id']; ?>" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>

        <?php include './app/Views/Components/footer.php'; ?>
    </div>

    <?php include './app/Views/Components/script.php'; ?>
</body>

</html>