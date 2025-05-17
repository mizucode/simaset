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
                                    Formulir Data Gedung
                                </h3>
                            </div>

                            <form action="/admin/prasarana/gedung/tambah" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Data Identitas Gedung -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    IDENTITAS GEDUNG
                                                </h5>
                                                <!-- Kode Gedung -->
                                                <div class="form-group mb-4">
                                                    <label for="kode_gedung" class="font-weight-bold">Kode Gedung</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="kode_gedung" name="kode_gedung" placeholder="Contoh: GDG001" required>
                                                    </div>
                                                </div>
                                                <!-- Nama Gedung -->
                                                <div class="form-group mb-4">
                                                    <label for="nama_gedung" class="font-weight-bold">Nama Gedung</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-building text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nama_gedung" name="nama_gedung" placeholder="Contoh: Gedung Rektorat" required>
                                                    </div>
                                                </div>
                                                <!-- Luas Gedung -->
                                                <div class="form-group mb-4">
                                                    <label for="luas" class="font-weight-bold">Luas Gedung (m²)</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-ruler-combined text-primary"></i></span>
                                                        </div>
                                                        <input type="number" step="0.01" class="form-control" id="luas" name="luas" placeholder="Masukkan luas gedung dalam meter persegi" required>
                                                    </div>
                                                </div>
                                                <!-- Jumlah Lantai -->
                                                <div class="form-group mb-4">
                                                    <label for="jumlah_lantai" class="font-weight-bold">Jumlah Lantai</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-layer-group text-primary"></i></span>
                                                        </div>
                                                        <input type="number" class="form-control" id="jumlah_lantai" name="jumlah_lantai" placeholder="Masukkan jumlah lantai" required>
                                                    </div>
                                                </div>
                                                <!-- Lokasi Gedung -->
                                                <div class="form-group mb-4">
                                                    <label for="lokasi" class="font-weight-bold">Lokasi Gedung</label>
                                                    <textarea class="form-control" id="lokasi" name="lokasi" rows="2" placeholder="Contoh: Jalan raya cigugur no. 14" required></textarea>
                                                </div>
                                            </div>

                                            <!-- Data Konstruksi Gedung -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    KONSTRUKSI GEDUNG
                                                </h5>
                                                <!-- Konstruksi -->
                                                <div class="form-group mb-4">
                                                    <label for="kontruksi" class="font-weight-bold">Jenis Konstruksi</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hammer text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="kontruksi" name="kontruksi" required>
                                                            <option value="" disabled selected>Pilih jenis konstruksi</option>
                                                            <option value="Beton">Beton</option>
                                                            <option value="Baja">Baja</option>
                                                            <option value="Kayu">Kayu</option>
                                                            <option value="Kombinasi">Kombinasi</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Kondisi -->
                                                <div class="form-group mb-4">
                                                    <label for="kondisi" class="font-weight-bold">Kondisi Gedung</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-clipboard-check text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="kondisi" name="kondisi" required>
                                                            <option value="" disabled selected>Pilih kondisi gedung</option>
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak Ringan">Rusak Ringan</option>
                                                            <option value="Rusak Berat">Rusak Berat</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data Kepemilikan dan Fungsi -->
                                            <div class="col-12">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    KEPEMILIKAN DAN FUNGSI
                                                </h5>
                                                <!-- Unit Kepemilikan -->
                                                <div class="form-group mb-4">
                                                    <label for="unit_kepemilikan" class="font-weight-bold">Unit Kepemilikan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-university text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" name="unit_kepemilikan" id="unit_kepemilikan">
                                                            <option value="" disabled selected>Pilih Unit Kepemilikan</option>
                                                            <option value="FPST">Fakultas
                                                                pendidikan, sosial, dan teknologi</option>
                                                            <option value="FKKS">Fakultas
                                                                Farmasi, Kesehatan, Dan Sains</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Fungsi -->
                                                <div class="form-group mb-4">
                                                    <label for="fungsi" class="font-weight-bold">Fungsi Gedung</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-briefcase text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="fungsi" name="fungsi" placeholder="Contoh: Perkantoran, Pendidikan" required>
                                                    </div>
                                                </div>
                                                <!-- Jenis Aset -->
                                                <div class="form-group mb-4">
                                                    <label for="jenis_aset_id" class="font-weight-bold">Jenis Aset</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-tags text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="jenis_aset_id" name="jenis_aset_id" required>
                                                            <option value="" disabled selected>Pilih jenis aset</option>
                                                            <?php foreach ($jenisAsetId as $id): ?>
                                                                <option value="<?= htmlspecialchars($id['id']) ?>">
                                                                    <?= htmlspecialchars($id['jenis_aset']) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right text-white">
                                    <a href="/admin/prasarana/gedung" class="btn btn-secondary">
                                        <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <i class="fas fa-save mr-2"></i>
                                        Simpan Data Gedung
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