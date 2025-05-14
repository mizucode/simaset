<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white mb-5 pt-5 px-4">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h3 class="card-title text-lg">
                                        Detail Inventarisasi Sarpras
                                    </h3>
                                    <a href="/admin/sarana/ruangan" class="btn btn-light btn-sm">
                                        <i class="fas fa-arrow-left mr-1"></i>Kembali
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-info"><i class="fas fa-user-tie"></i></span>

                                            <div class="info-box-content">
                                                <span class="info-box-text">Penanggung Jawab</span>
                                                <span class="info-box-number"><?= htmlspecialchars($data['penanggung_jawab'] ?? '-') ?></span>

                                            </div>

                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-success"><i class="fas fa-calendar-alt"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Semester</span>
                                                <span class="info-box-number"><?= htmlspecialchars($data['semester'] ?? '-') ?> - <?= htmlspecialchars($data['tahun_akademik'] ?? '-') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row mb-4">
                                    <div class="col-md-6">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-warning"><i class="fas fa-calendar-day"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Tanggal Pengecekan</span>
                                                <span class="info-box-number"><?= htmlspecialchars($data['tanggal_pengecekan'] ?? '-') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="info-box bg-light">
                                            <span class="info-box-icon bg-primary"><i class="fas fa-map-marker-alt"></i></span>
                                            <div class="info-box-content">
                                                <span class="info-box-text">Lokasi Survey</span>
                                                <span class="info-box-number"><?= htmlspecialchars($data['lokasi_survey'] ?? '-') ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="border-bottom pb-2 mb-3 flex justify-content-between">
                                    <h5 class=" text-bold">
                                        Daftar Inventaris Sarpras

                                    </h5>
                                    <a href="/admin/survey/semesteran/data-inventaris" class="btn btn-warning btn-sm ml-auto">
                                        <div class="text-dark">
                                            <i class="fas fa-plus mr-1"></i> Tambah Data
                                        </div>
                                    </a>
                                </div>


                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-light">

                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="25%">Nama Barang</th>
                                                <th width="10%">Jumlah</th>
                                                <th width="15%">Kondisi</th>
                                                <th width="20%">Kebutuhan Perbaikan/Pengadaan</th>
                                                <th width="25%">Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach ($inventarisData as $row): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= htmlspecialchars($row['nama_barang_survey']) ?></td>
                                                    <td><?= htmlspecialchars($row['jumlah']) ?></td>
                                                    <td>
                                                        <span class="badge badge-success">
                                                            <?= htmlspecialchars($row['kondisi']) ?>
                                                        </span>
                                                    </td>
                                                    <td><?= htmlspecialchars($row['kebutuhan']) ?: '-' ?></td>
                                                    <td><?= htmlspecialchars($row['keterangan']) ?: '-' ?></td>
                                                </tr>
                                            <?php endforeach; ?>


                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mt-4">
                                    <div class="col-md-6">
                                        <div class="callout callout-info">
                                            <h5>Catatan Tambahan</h5>
                                            <p>Ruangan ini secara keseluruhan dalam kondisi baik, hanya perlu perbaikan kecil pada beberapa kursi dan penggantian proyektor yang sudah rusak.</p>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="card">
                                            <div class="card-header bg-light">
                                                <h3 class="card-title">Dokumentasi</h3>
                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-4">
                                                        <a href="#" data-toggle="lightbox" data-title="Foto Ruangan">
                                                            <img src="https://via.placeholder.com/150" class="img-fluid mb-2" alt="Foto Ruangan" />
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="#" data-toggle="lightbox" data-title="Foto Kerusakan">
                                                            <img src="https://via.placeholder.com/150" class="img-fluid mb-2" alt="Foto Kerusakan" />
                                                        </a>
                                                    </div>
                                                    <div class="col-4">
                                                        <a href="#" data-toggle="lightbox" data-title="Foto Proyektor">
                                                            <img src="https://via.placeholder.com/150" class="img-fluid mb-2" alt="Foto Proyektor" />
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card-footer text-right">
                                <a href="/admin/sarana/ruangan/edit/1" class="btn btn-warning">
                                    <i class="fas fa-edit mr-2"></i>Edit Data
                                </a>
                                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus">
                                    <i class="fas fa-trash mr-2"></i>Hapus Data
                                </button>
                                <a href="#" class="btn btn-primary">
                                    <i class="fas fa-print mr-2"></i>Cetak Laporan
                                </a>
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
                        <p>Apakah Anda yakin ingin menghapus data inventaris ini? Data yang sudah dihapus tidak dapat dikembalikan.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="button" class="btn btn-danger">Hapus</button>
                    </div>
                </div>
            </div>
        </div>

        <?php include './app/Views/Components/footer.php'; ?>
    </div>

    <?php include './app/Views/Components/script.php'; ?>

    <!-- Ekstensi untuk lightbox gambar -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ekko-lightbox/5.3.0/ekko-lightbox.css">

    <script>
        $(document).ready(function() {
            // Inisialisasi lightbox untuk gambar dokumentasi
            $(document).on('click', '[data-toggle="lightbox"]', function(event) {
                event.preventDefault();
                $(this).ekkoLightbox();
            });
        });
    </script>
</body>

</html>