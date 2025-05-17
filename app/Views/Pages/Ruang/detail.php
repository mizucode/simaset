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
                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title text-lg">
                                        Detail Ruangan
                                    </h3>
                                    <div class="text-right">
                                        <button type="button" class="btn btn-danger btn-sm mr-2" data-toggle="modal" data-target="#deleteModal" data-id="<?= $detailData['id']; ?>">
                                            <i class="fas fa-trash mr-1"></i> Hapus
                                        </button>
                                        <a href="/admin/prasarana/ruang?edit=<?= $detailData['id']; ?>" class="btn btn-warning btn-sm mr-2">
                                            <i class="fas fa-edit mr-1"></i> Edit
                                        </a>
                                        <a href="/admin/prasarana/ruang" class="btn btn-secondary btn-sm">
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
                                                <span class="info-box-text">Kode Ruangan</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['kode_ruang'] ?? '-') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-info"><i class="fas fa-door-open"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Nama Ruangan</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['nama_ruang'] ?? 'Ruang A1') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-success"><i class="fas fa-building"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Letak Gedung</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['nama_gedung'] ?? 'Belum terdata gedung') ?></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-primary"><i class="fas fa-ruler-combined"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Luas</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['luas'] ?? '50') ?> m²</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-purple"><i class="fas fa-users"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Kapasitas</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['kapasitas'] ?? '30') ?> orang</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-<?= ($detailData['status'] ?? 'Terpakai') === 'Terpakai' ? 'green' : 'blue' ?>"><i class="fas fa-info-circle"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Status</span>
                                                <span class="info-box-number">
                                                    <span class="badge badge-<?= ($detailData['status'] ?? 'Terpakai') === 'Terpakai' ? 'success' : 'primary' ?>">
                                                        <?= htmlspecialchars($detailData['status'] ?? 'Terpakai') ?>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-4">
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-warning"><i class="fas fa-layer-group"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Letak Lantai</span>
                                                <span class="info-box-number"><?= htmlspecialchars($detailData['lantai'] ?? '1') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-info"> <i class="fas fa-info-circle"></i></span>

                                            </span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Kondisi Ruang</span>
                                                <span class="info-box-number">
                                                    <span class="badge badge-<?=
                                                                                ($detailData['kondisi_ruang'] ?? 'Baik') === 'Baik' ? 'success' : (($detailData['kondisi_ruang'] ?? 'Baik') === 'Rusak Ringan' ? 'warning' : 'danger')
                                                                                ?>">
                                                        <?= htmlspecialchars($detailData['kondisi_ruang'] ?? 'Baik') ?>
                                                    </span>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="border-bottom pb-2 mb-3">
                                    <h5 class="text-bold">
                                        Barang Inventaris dalam Ruangan
                                    </h5>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-light">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="30%">Nama Barang</th>
                                                <th width="15%">Jumlah</th>
                                                <th width="20%">Kondisi</th>
                                                <th width="30%">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($filteredBarangList)): ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($filteredBarangList as $barang): ?>
                                                    <tr>
                                                        <td><?= $no++ ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_detail_barang'] ?? '-') ?></td>
                                                        <td><?= htmlspecialchars($barang['jumlah'] ?? '0') ?></td>
                                                        <td>
                                                            <?php if (isset($barang['kondisi'])): ?>
                                                                <?php if ($barang['kondisi'] == 'Baik'): ?>
                                                                    <span class="badge badge-success">Baik</span>
                                                                <?php elseif ($barang['kondisi'] == 'Rusak Ringan'): ?>
                                                                    <span class="badge badge-warning">Rusak Ringan</span>
                                                                <?php else: ?>
                                                                    <span class="badge badge-danger"><?= htmlspecialchars($barang['kondisi']) ?></span>
                                                                <?php endif; ?>
                                                            <?php else: ?>
                                                                -
                                                            <?php endif; ?>
                                                        </td>
                                                        <td><?= htmlspecialchars($barang['keterangan'] ?? '-') ?></td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else: ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">Tidak ada data barang di ruangan ini</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="border-bottom pb-2 mb-3 mt-5">
                                    <h5 class="text-bold">
                                        Informasi Tambahan
                                    </h5>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="callout callout-info">
                                            <h5>Fungsi Ruangan</h5>
                                            <p><?= htmlspecialchars($detailData['fungsi'] ?? 'Ruang kelas untuk perkuliahan regular') ?></p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="callout callout-warning">
                                            <h5>Keterangan</h5>
                                            <p><?= htmlspecialchars($detailData['keterangan'] ?? 'Tidak ada Keterangan') ?></p>
                                        </div>
                                    </div>
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
                        <p>Apakah Anda yakin ingin menghapus ruangan ini? Tindakan ini tidak dapat dibatalkan.</p>
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
        });
    </script>
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
                var deleteUrl = '/admin/prasarana/ruang?delete=' + id;

                // Set URL hapus ke tombol Hapus di modal
                $('#deleteButton').attr('href', deleteUrl);
            });
        });
    </script>
</body>

</html>