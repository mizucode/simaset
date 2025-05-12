<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white mb-5 pt-5 px-4 ">
            <div class="container-fluid ">
                <div class="row justify-content-center ">
                    <div class="col-12 ">
                        <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger alert-dismissible fade show mb-4">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?= htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <h3 class="text-lg">Formulir Ubah Data Lapang</h3>
                            </div>

                            <form action="<?= isset($lapang) ? '/admin/prasarana/lapang?edit=' . $lapang['id'] : '/admin/prasarana/lapang/tambah' ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id" value="<?= $lapang['id'] ?>">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- IDENTITAS -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">IDENTITAS LAPANG</h5>

                                                <!-- Jenis Aset -->
                                                <div class="form-group mb-4">
                                                    <label for="jenis_aset_id" class="font-weight-bold">Jenis Aset</label>
                                                    <select class="form-control" id="jenis_aset_id" name="jenis_aset_id" required>
                                                        <option value="" disabled>Pilih Jenis Aset</option>
                                                        <?php foreach ($jenisAsetList as $jenisAset): ?>
                                                            <option value="<?= $jenisAset['id'] ?>" <?= $jenisAset['id'] == $lapang['jenis_aset_id'] ? 'selected' : '' ?>>
                                                                <?= htmlspecialchars($jenisAset['jenis_aset']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <!-- Kode Lapang -->
                                                <div class="form-group mb-4">
                                                    <label for="kode_lapang" class="font-weight-bold">Kode Lapang</label>
                                                    <input type="text" class="form-control" id="kode_lapang" name="kode_lapang" value="<?= htmlspecialchars($lapang['kode_lapang']) ?>" readonly required>
                                                </div>

                                                <!-- Nama Lapang -->
                                                <div class="form-group mb-4">
                                                    <label for="nama_lapang" class="font-weight-bold">Nama Lapang</label>
                                                    <input type="text" class="form-control" id="nama_lapang" name="nama_lapang" value="<?= htmlspecialchars($lapang['nama_lapang']) ?>" required>
                                                </div>

                                                <!-- Luas -->
                                                <div class="form-group mb-4">
                                                    <label for="luas" class="font-weight-bold">Luas Lapang (m²)</label>
                                                    <input type="text" class="form-control" id="luas" name="luas" value="<?= htmlspecialchars($lapang['luas']) ?>" required>
                                                </div>

                                                <!-- Kategori -->
                                                <div class="form-group mb-4">
                                                    <label for="kategori" class="font-weight-bold">Kategori Lapang</label>
                                                    <input type="text" class="form-control" id="kategori" name="kategori" value="<?= htmlspecialchars($lapang['kategori']) ?>">
                                                </div>

                                                <!-- Lokasi -->
                                                <div class="form-group mb-4">
                                                    <label for="lokasi" class="font-weight-bold">Lokasi</label>
                                                    <textarea class="form-control" id="lokasi" name="lokasi" rows="2" required><?= htmlspecialchars($lapang['lokasi']) ?></textarea>
                                                </div>
                                            </div>

                                            <!-- KONDISI -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">KONDISI LAPANG</h5>

                                                <!-- Status -->
                                                <div class="form-group mb-4">
                                                    <label for="status" class="font-weight-bold">Status Lapang</label>
                                                    <select class="form-control" id="status" name="status" required>
                                                        <option value="" disabled>Pilih status lapang</option>
                                                        <option value="Terpakai" <?= $lapang['status'] == 'Terpakai' ? 'selected' : '' ?>>Terpakai</option>
                                                        <option value="Kosong" <?= $lapang['status'] == 'Kosong' ? 'selected' : '' ?>>Kosong</option>
                                                        <option value="Dalam Perbaikan" <?= $lapang['status'] == 'Dalam Perbaikan' ? 'selected' : '' ?>>Dalam Perbaikan</option>
                                                    </select>
                                                </div>

                                                <!-- Kondisi -->
                                                <div class="form-group mb-4">
                                                    <label for="kondisi" class="font-weight-bold">Kondisi Lapang</label>
                                                    <select class="form-control" id="kondisi" name="kondisi" required>
                                                        <option value="" disabled>Pilih kondisi lapang</option>
                                                        <option value="Baik" <?= $lapang['kondisi'] == 'Baik' ? 'selected' : '' ?>>Baik</option>
                                                        <option value="Rusak Ringan" <?= $lapang['kondisi'] == 'Rusak Ringan' ? 'selected' : '' ?>>Rusak Ringan</option>
                                                        <option value="Rusak Berat" <?= $lapang['kondisi'] == 'Rusak Berat' ? 'selected' : '' ?>>Rusak Berat</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <!-- INFORMASI TAMBAHAN -->
                                            <div class="col-12">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">INFORMASI TAMBAHAN</h5>

                                                <!-- Fungsi -->
                                                <div class="form-group mb-4">
                                                    <label for="fungsi" class="font-weight-bold">Fungsi</label>
                                                    <input type="text" class="form-control" id="fungsi" name="fungsi" value="<?= htmlspecialchars($lapang['fungsi']) ?>">
                                                </div>

                                                <!-- Keterangan -->
                                                <div class="form-group mb-4">
                                                    <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="2"><?= htmlspecialchars($lapang['keterangan']) ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right text-white">
                                        <a href="/admin/prasarana/lapang" class="btn btn-secondary">
                                            <i class="fas fa-arrow-alt-circle-left mr-2"></i>Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                            <i class="fas fa-save mr-2"></i> Perbarui Data Lapang
                                        </button>
                                    </div>
                                </div>
                            </form>
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