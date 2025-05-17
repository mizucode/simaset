<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white mb-5 pt-3 px-4 ">
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
                                <h3 class="text-lg">
                                    Formulir Data Ruang
                                </h3>
                            </div>

                            <form action="/admin/prasarana/ruang/tambah" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Data Identitas Ruang -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    IDENTITAS RUANG
                                                </h5>
                                                <!-- Gedung -->
                                                <div class="form-group mb-4">
                                                    <label for="gedung_id" class="font-weight-bold">Gedung</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-building text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="gedung_id" name="gedung_id" required>
                                                            <option value="" disabled selected>Pilih Gedung</option>
                                                            <?php foreach ($gedungList as $gedung): ?>
                                                                <option value="<?= htmlspecialchars($gedung['id']) ?>">
                                                                    <?= htmlspecialchars($gedung['nama_gedung']) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Kode Ruang -->
                                                <div class="form-group mb-4">
                                                    <label for="kode_ruang" class="font-weight-bold">Kode Ruang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="kode_ruang" name="kode_ruang" placeholder="Contoh: RNG001" required>
                                                    </div>
                                                </div>
                                                <!-- Nama Ruang -->
                                                <div class="form-group mb-4">
                                                    <label for="nama_ruang" class="font-weight-bold">Nama Ruang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-door-open text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nama_ruang" name="nama_ruang" placeholder="Contoh: Ruang Kelas 101" required>
                                                    </div>
                                                </div>
                                                <!-- Kapasitas -->
                                                <div class="form-group mb-4">
                                                    <label for="kapasitas" class="font-weight-bold">Kapasitas</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-users text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="kapasitas" name="kapasitas" placeholder="Contoh: 30 orang">
                                                    </div>
                                                </div>
                                                <!-- Lantai -->
                                                <div class="form-group mb-4">
                                                    <label for="lantai" class="font-weight-bold">Letak Lantai</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-layer-group text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="lantai" name="lantai" placeholder="Contoh: 1" required>
                                                    </div>
                                                </div>
                                                <!-- Luas -->
                                                <div class="form-group mb-4">
                                                    <label for="luas" class="font-weight-bold">Luas Ruang (m²)</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-ruler-combined text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="luas" name="luas" placeholder="Masukkan luas ruang dalam meter persegi">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data Kondisi Ruang -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    KONDISI RUANG
                                                </h5>
                                                <!-- Status -->
                                                <div class="form-group mb-4">
                                                    <label for="status" class="font-weight-bold">Status Ruang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-info-circle text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="status" name="status" required>
                                                            <option value="" disabled selected>Pilih status ruang</option>
                                                            <option value="Terpakai">Terpakai</option>
                                                            <option value="Kosong">Kosong</option>
                                                            <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Kondisi Ruang -->
                                                <div class="form-group mb-4">
                                                    <label for="kondisi_ruang" class="font-weight-bold">Kondisi Ruang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-clipboard-check text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="kondisi_ruang" name="kondisi_ruang" required>
                                                            <option value="" disabled selected>Pilih kondisi ruang</option>
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak Ringan">Rusak Ringan</option>
                                                            <option value="Rusak Berat">Rusak Berat</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data Tambahan -->
                                            <div class="col-12">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    INFORMASI TAMBAHAN
                                                </h5>
                                                <!-- Fungsi -->
                                                <div class="form-group mb-4">
                                                    <label for="fungsi" class="font-weight-bold">Fungsi</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-info-circle text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="fungsi" name="fungsi" placeholder="Masukkan fungsi ruang dalam meter persegi">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Tambahkan keterangan jika diperlukan"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right text-white">
                                        <a href="/admin/prasarana/ruang" class="btn btn-secondary">
                                            <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                            <i class="fas fa-save mr-2"></i>
                                            Simpan Data Ruang
                                        </button>
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