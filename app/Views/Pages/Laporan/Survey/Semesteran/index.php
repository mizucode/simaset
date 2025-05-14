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
                                        Data Inventarisasi Sarpras Semesteran
                                    </h3>
                                    <a href="/admin/survey/semesteran/tambah" class="btn btn-warning btn-sm">
                                        <i class="fas fa-plus mr-1"></i>Tambah Data
                                    </a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-md-6">
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Cari data inventaris...">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="button">
                                                    <i class="fas fa-search"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 text-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-outline-secondary">
                                                <i class="fas fa-filter"></i> Filter
                                            </button>
                                            <button type="button" class="btn btn-outline-secondary">
                                                <i class="fas fa-download"></i> Export
                                            </button>
                                        </div>
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead class="bg-light">
                                            <tr>
                                                <th width="5%">No</th>
                                                <th width="15%">Penanggung Jawab</th>
                                                <th width="10%">Semester</th>
                                                <th width="15%">Tahun Akademik</th>
                                                <th width="15%">Tanggal Pengecekan</th>
                                                <th width="15%">Lokasi Survey</th>
                                                <th width="15%">Jumlah Barang</th>
                                                <th width="10%">Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $no = 1; ?>
                                            <?php foreach ($semesterData as $data): ?>
                                                <tr>
                                                    <td><?= $no++ ?></td>
                                                    <td><?= htmlspecialchars($data['penanggung_jawab'] ?? '') ?></td>
                                                    <td><?= htmlspecialchars($data['semester'] ?? '') ?></td>
                                                    <td><?= htmlspecialchars($data['tahun_akademik'] ?? '') ?></td>
                                                    <td><?= date('d M Y', strtotime($data['tanggal_pengecekan'] ?? '')) ?></td>
                                                    <td><?= htmlspecialchars($data['lokasi_survey'] ?? '') ?></td>
                                                    <td><?= htmlspecialchars($data['jumlah_barang'] ?? '0') ?></td>
                                                    <td>
                                                        <div class="btn-group btn-group-sm">
                                                            <a href="/admin/survey/semesteran?edit=<?= $data['id'] ?>" class="btn btn-info" title="Detail">
                                                                <i class="fas fa-eye"></i> Detail
                                                            </a>

                                                        </div>
                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>

                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="dataTables_info">
                                            Menampilkan 1 sampai <?= count($semesterData) ?> dari <?= count($semesterData) ?> entri
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <nav aria-label="Page navigation">
                                            <ul class="pagination justify-content-end">
                                                <li class="page-item disabled">
                                                    <a class="page-link" href="#" tabindex="-1">Sebelumnya</a>
                                                </li>
                                                <li class="page-item active"><a class="page-link" href="#">1</a></li>
                                                <li class="page-item">
                                                    <a class="page-link" href="#">Selanjutnya</a>
                                                </li>
                                            </ul>
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include './app/Views/Components/footer.php'; ?>
    </div>

    <?php include './app/Views/Components/script.php'; ?>
</body>

</html>