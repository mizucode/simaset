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
                                <h3 class="text-lg">
                                    Formulir Data Lapang
                                </h3>
                            </div>

                            <form action="/admin/prasarana/lapang/tambah" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Data Identitas Lapang -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    IDENTITAS LAPANG
                                                </h5>
                                                <!-- Jenis Aset -->
                                                <div class="form-group mb-4">
                                                    <label for="jenis_aset_id" class="font-weight-bold">Jenis Aset</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-tag text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="jenis_aset_id" name="jenis_aset_id" required>
                                                            <option value="" disabled selected>Pilih Jenis Aset</option>
                                                            <?php foreach ($jenisAsetList as $jenisAset): ?>
                                                                <option value="<?= htmlspecialchars($jenisAset['id']) ?>">
                                                                    <?= htmlspecialchars($jenisAset['jenis_aset']) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Kode Lapang -->
                                                <div class="form-group mb-4">
                                                    <label for="kode_lapang" class="font-weight-bold">Kode Lapang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="kode_lapang" name="kode_lapang" placeholder="Contoh: LPN001" readonly required>
                                                    </div>
                                                </div>
                                                <!-- Nama Lapang -->
                                                <div class="form-group mb-4">
                                                    <label for="nama_lapang" class="font-weight-bold">Nama Lapang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-map-marked-alt text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nama_lapang" name="nama_lapang" placeholder="Contoh: Lapangan Basket Utama" required>
                                                    </div>
                                                </div>
                                                <!-- Luas -->
                                                <div class="form-group mb-4">
                                                    <label for="luas" class="font-weight-bold">Luas Lapang (m²)</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-ruler-combined text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="luas" name="luas" placeholder="Masukkan luas lapang dalam meter persegi" required>
                                                    </div>
                                                </div>
                                                <!-- Kategori -->
                                                <div class="form-group mb-4">
                                                    <label for="kategori" class="font-weight-bold">Kategori Lapang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-tags text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="kategori" name="kategori" placeholder="Contoh: Lapangan Olahraga, Taman, dll">
                                                    </div>
                                                </div>
                                                <!-- Lokasi -->
                                                <div class="form-group mb-4">
                                                    <label for="lokasi" class="font-weight-bold">Lokasi</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-map-marker-alt text-primary"></i></span>
                                                        </div>
                                                        <textarea class="form-control" id="lokasi" name="lokasi" rows="2" placeholder="Deskripsi lokasi lapang" required></textarea>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data Kondisi Lapang -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    KONDISI LAPANG
                                                </h5>
                                                <!-- Status -->
                                                <div class="form-group mb-4">
                                                    <label for="status" class="font-weight-bold">Status Lapang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-info-circle text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="status" name="status" required>
                                                            <option value="" disabled selected>Pilih status lapang</option>
                                                            <option value="Terpakai">Terpakai</option>
                                                            <option value="Kosong">Kosong</option>
                                                            <option value="Dalam Perbaikan">Dalam Perbaikan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Kondisi Lapang -->
                                                <div class="form-group mb-4">
                                                    <label for="kondisi" class="font-weight-bold">Kondisi Lapang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-clipboard-check text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="kondisi" name="kondisi" required>
                                                            <option value="" disabled selected>Pilih kondisi lapang</option>
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
                                                        <input type="text" class="form-control" id="fungsi" name="fungsi" placeholder="Masukkan fungsi lapang">
                                                    </div>
                                                </div>
                                                <!-- Keterangan -->
                                                <div class="form-group mb-4">
                                                    <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Tambahkan keterangan jika diperlukan"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right text-white">
                                        <a href="/admin/prasarana/lapang" class="btn btn-secondary">
                                            <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                            <i class="fas fa-save mr-2"></i>
                                            Simpan Data Lapang
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
            const namaLapangInput = document.getElementById('nama_lapang');
            const kodeLapangInput = document.getElementById('kode_lapang');
            const jenisAsetSelect = document.getElementById('jenis_aset_id');

            function generateKodeLapang() {
                let namaLapang = namaLapangInput.value.trim();
                let jenisAsetId = jenisAsetSelect.value;

                if (namaLapang.length > 0 && jenisAsetId) {
                    // Ambil huruf pertama dari setiap kata nama lapang
                    let singkatan = namaLapang
                        .split(' ')
                        .filter(kata => kata.length > 0)
                        .map(kata => kata.charAt(0).toUpperCase())
                        .join('');

                    // Gabungkan dengan awalan LPN- dan ID jenis aset
                    let kodeLapang = `LPN-${jenisAsetId}-${singkatan}`;
                    kodeLapangInput.value = kodeLapang;
                } else {
                    kodeLapangInput.value = '';
                }
            }

            namaLapangInput.addEventListener('input', generateKodeLapang);
            jenisAsetSelect.addEventListener('change', generateKodeLapang);
        });
    </script>
</body>

</html>