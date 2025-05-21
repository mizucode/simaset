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

                        <?php if (isset($_SESSION['update'])) : ?>
                            <div class="alert alert-success alert-dismissible fade show mb-4">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?= htmlspecialchars($_SESSION['update']); ?>
                            </div>
                            <?php unset($_SESSION['update']); ?>
                        <?php endif; ?>

                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <h3 class="text-lg">
                                    <?= isset($ruang) ? 'Edit Data Ruang' : 'Formulir Data Ruang Baru' ?>
                                </h3>
                            </div>

                            <form action="<?= isset($ruang) ? '/admin/prasarana/ruang?edit=' . $ruang['id'] : '/admin/prasarana/ruang/tambah' ?>" method="POST">
                                <?php if (isset($ruang)) : ?>
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($ruang['id']) ?>">
                                <?php endif; ?>

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Data Identitas Ruang -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">IDENTITAS RUANG</h5>

                                                <!-- Gedung -->
                                                <div class="form-group mb-4">
                                                    <label for="gedung_id" class="font-weight-bold">Gedung</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-building text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="gedung_id" name="gedung_id" required>
                                                            <option value="" disabled <?= !isset($ruang) ? 'selected' : '' ?>>Pilih Gedung</option>
                                                            <?php foreach ($gedungList as $gedung): ?>
                                                                <option value="<?= htmlspecialchars($gedung['id']) ?>" <?= (isset($ruang) && $ruang['gedung_id'] == $gedung['id']) ? 'selected' : '' ?>>
                                                                    <?= htmlspecialchars($gedung['nama_gedung']) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Jenis Ruang -->
                                                <div class="form-group mb-4">
                                                    <label for="jenis_ruangan" class="font-weight-bold">Jenis Ruangan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-door-open text-primary"></i>
                                                            </span>
                                                        </div>
                                                        <select class="form-control" id="jenis_ruangan" name="jenis_ruangan" required>
                                                            <option value="" disabled <?= !isset($ruang) ? 'selected' : '' ?>>Pilih Jenis Ruangan</option>
                                                            <option value="Ruang Kelas" <?= (isset($ruang) && $ruang['jenis_ruangan'] == 'Ruang Kelas') ? 'selected' : '' ?>>Ruang Kelas</option>
                                                            <option value="Laboratorium" <?= (isset($ruang) && $ruang['jenis_ruangan'] == 'Laboratorium') ? 'selected' : '' ?>>Laboratorium</option>
                                                            <option value="Ruang Seminar" <?= (isset($ruang) && $ruang['jenis_ruangan'] == 'Ruang Seminar') ? 'selected' : '' ?>>Ruang Seminar</option>
                                                            <option value="Ruang Sidang" <?= (isset($ruang) && $ruang['jenis_ruangan'] == 'Ruang Sidang') ? 'selected' : '' ?>>Ruang Sidang</option>
                                                            <option value="Ruang Dosen" <?= (isset($ruang) && $ruang['jenis_ruangan'] == 'Ruang Dosen') ? 'selected' : '' ?>>Ruang Dosen</option>
                                                            <option value="Ruang Kaprodi" <?= (isset($ruang) && $ruang['jenis_ruangan'] == 'Ruang Kaprodi') ? 'selected' : '' ?>>Ruang Kaprodi</option>
                                                            <option value="Perpustakaan" <?= (isset($ruang) && $ruang['jenis_ruangan'] == 'Perpustakaan') ? 'selected' : '' ?>>Perpustakaan</option>
                                                            <option value="Ruang Baca" <?= (isset($ruang) && $ruang['jenis_ruangan'] == 'Ruang Baca') ? 'selected' : '' ?>>Ruang Baca</option>
                                                            <option value="Ruang Multimedia" <?= (isset($ruang) && $ruang['jenis_ruangan'] == 'Ruang Multimedia') ? 'selected' : '' ?>>Ruang Multimedia</option>
                                                            <option value="Ruang UKM" <?= (isset($ruang) && $ruang['jenis_ruangan'] == 'Ruang UKM') ? 'selected' : '' ?>>Ruang UKM</option>
                                                            <option value="Kantin" <?= (isset($ruang) && $ruang['jenis_ruangan'] == 'Kantin') ? 'selected' : '' ?>>Kantin</option>
                                                            <option value="Toilet" <?= (isset($ruang) && $ruang['jenis_ruangan'] == 'Toilet') ? 'selected' : '' ?>>Toilet</option>
                                                            <option value="Gudang" <?= (isset($ruang) && $ruang['jenis_ruangan'] == 'Gudang') ? 'selected' : '' ?>>Gudang</option>
                                                            <option value="Mushola" <?= (isset($ruang) && $ruang['jenis_ruangan'] == 'Mushola') ? 'selected' : '' ?>>Mushola</option>
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
                                                        <input type="text" class="form-control" id="kode_ruang" name="kode_ruang"
                                                            value="<?= isset($ruang) ? htmlspecialchars($ruang['kode_ruang']) : '' ?>" required>
                                                    </div>
                                                </div>
                                                <!-- Nama Ruang -->
                                                <div class="form-group mb-4">
                                                    <label for="nama_ruang" class="font-weight-bold">Nama Ruang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-door-open text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nama_ruang" name="nama_ruang"
                                                            value="<?= isset($ruang) ? htmlspecialchars($ruang['nama_ruang']) : '' ?>"
                                                            placeholder="Contoh: Ruang Kelas 101" required>
                                                    </div>
                                                </div>

                                                <!-- Kapasitas -->
                                                <div class="form-group mb-4">
                                                    <label for="kapasitas" class="font-weight-bold">Kapasitas</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-users text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="kapasitas" name="kapasitas"
                                                            value="<?= isset($ruang) ? htmlspecialchars($ruang['kapasitas']) : '' ?>"
                                                            placeholder="Contoh: 30 orang">
                                                    </div>
                                                </div>

                                                <!-- Lantai -->
                                                <div class="form-group mb-4">
                                                    <label for="lantai" class="font-weight-bold">Lantai</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-layer-group text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="lantai" name="lantai"
                                                            value="<?= isset($ruang) ? htmlspecialchars($ruang['lantai']) : '' ?>"
                                                            placeholder="Contoh: 1" required>
                                                    </div>
                                                </div>

                                                <!-- Luas -->
                                                <div class="form-group mb-4">
                                                    <label for="luas" class="font-weight-bold">Luas Ruang (m²)</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-ruler-combined text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="luas" name="luas"
                                                            value="<?= isset($ruang) ? htmlspecialchars($ruang['luas']) : '' ?>"
                                                            placeholder="Masukkan luas ruang dalam meter persegi">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data Kondisi Ruang -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">KONDISI RUANG</h5>

                                                <!-- Status -->
                                                <div class="form-group mb-4">
                                                    <label for="status" class="font-weight-bold">Status Ruang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-info-circle text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="status" name="status" required>
                                                            <option value="" disabled <?= !isset($ruang) ? 'selected' : '' ?>>Pilih status ruang</option>
                                                            <option value="Terpakai" <?= (isset($ruang) && $ruang['status'] == 'Terpakai') ? 'selected' : '' ?>>Terpakai</option>
                                                            <option value="Kosong" <?= (isset($ruang) && $ruang['status'] == 'Kosong') ? 'selected' : '' ?>>Kosong</option>
                                                            <option value="Dalam Perbaikan" <?= (isset($ruang) && $ruang['status'] == 'Dalam Perbaikan') ? 'selected' : '' ?>>Dalam Perbaikan</option>
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
                                                            <option value="" disabled <?= !isset($ruang) ? 'selected' : '' ?>>Pilih kondisi ruang</option>
                                                            <option value="Baik" <?= (isset($ruang) && $ruang['kondisi_ruang'] == 'Baik') ? 'selected' : '' ?>>Baik</option>
                                                            <option value="Rusak Ringan" <?= (isset($ruang) && $ruang['kondisi_ruang'] == 'Rusak Ringan') ? 'selected' : '' ?>>Rusak Ringan</option>
                                                            <option value="Rusak Berat" <?= (isset($ruang) && $ruang['kondisi_ruang'] == 'Rusak Berat') ? 'selected' : '' ?>>Rusak Berat</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Informasi Tambahan -->
                                            <div class="col-12">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">INFORMASI TAMBAHAN</h5>
                                                <div class="form-group mb-4">
                                                    <label for="fungsi" class="font-weight-bold">Fungsi</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-info-circle text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="fungsi" name="fungsi" placeholder="Masukkan fungsi ruang dalam meter persegi" value="<?= isset($ruang) ? htmlspecialchars($ruang['fungsi'] ?? 'belum ada keterangan') : '' ?>">
                                                    </div>

                                                    <!-- Keterangan -->
                                                    <div class="form-group mb-4">
                                                        <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                                                            placeholder="Tambahkan keterangan jika diperlukan"><?= isset($ruang) ? htmlspecialchars($ruang['keterangan']) : '' ?></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right text-white">
                                        <a href="/admin/prasarana/ruang" class="btn btn-secondary">
                                            <i class="fas fa-arrow-alt-circle-left mr-2"></i>Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                            <i class="fas fa-save mr-2"></i>
                                            <?= isset($ruang) ? 'Update Data Ruang' : 'Simpan Data Ruang' ?>
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const namaRuangInput = document.getElementById('nama_ruang');
            const kodeRuangInput = document.getElementById('kode_ruang');
            const gedungSelect = document.getElementById('gedung_id');

            <?php if (!isset($ruang)) : ?>

                function generateKodeRuang() {
                    let namaRuang = namaRuangInput.value.trim();
                    let gedungId = gedungSelect.value;

                    if (namaRuang.length > 0 && gedungId) {
                        let singkatan = namaRuang
                            .split(' ')
                            .filter(kata => kata.length > 0)
                            .map(kata => kata.charAt(0).toUpperCase())
                            .join('');
                        let kodeRuang = `RNG-${gedungId}-${singkatan}`;
                        kodeRuangInput.value = kodeRuang;
                    } else {
                        kodeRuangInput.value = '';
                    }
                }

                namaRuangInput.addEventListener('input', generateKodeRuang);
                gedungSelect.addEventListener('change', generateKodeRuang);
            <?php endif; ?>
        });
    </script>
</body>

</html>