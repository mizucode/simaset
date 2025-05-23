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
                                    Formulir Data Sarana Bergerak
                                </h3>
                            </div>

                            <form action="/admin/sarana/bergerak/tambah" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="kategori_barang_id" value="1" id="kategori_barang_id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Data Identitas Sarana -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    IDENTITAS SARANA BERGERAK
                                                </h5>
                                                <!-- Kategori Barang -->

                                                <!-- Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="barang_input" class="font-weight-bold">Jenis Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light">
                                                                <i class="fas fa-boxes text-primary"></i>
                                                            </span>
                                                        </div>
                                                        <select class="form-control" id="barang_input" name="barang_id" required>
                                                            <option value="" disabled selected>Pilih atau ketik jenis barang</option>
                                                            <?php foreach ($barangList as $barang): ?>
                                                                <option value="<?= htmlspecialchars($barang['id']) ?>">
                                                                    <?= htmlspecialchars($barang['nama_barang']) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Nama Detail Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="nama_detail_barang" class="font-weight-bold">Nama Detail Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-tag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nama_detail_barang" name="nama_detail_barang" placeholder="Contoh: Mobil Toyota Avanza" required>
                                                    </div>
                                                </div>
                                                <!-- No Registrasi -->
                                                <!-- No Registrasi -->

                                            </div>

                                            <!-- Data Spesifikasi -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    SPESIFIKASI
                                                </h5>
                                                <!-- Merk -->
                                                <div class="form-group mb-4">
                                                    <label for="merk" class="font-weight-bold">Merk</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-copyright text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="merk" name="merk" placeholder="Contoh: Toyota">
                                                    </div>
                                                </div>
                                                <!-- Spesifikasi -->
                                                <div class="form-group mb-4">
                                                    <label for="spesifikasi" class="font-weight-bold">Spesifikasi</label>
                                                    <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3" placeholder="Masukkan spesifikasi lengkap"></textarea>
                                                </div>
                                                <!-- No Polisi -->
                                                <div class="form-group mb-4">
                                                    <label for="no_polisi" class="font-weight-bold">Nomor Polisi</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-car text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="no_polisi" name="no_polisi" placeholder="Contoh: B 1234 ABC">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data Kondisi dan Kuantitas -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    INFORMASI KONDISI DAN TANGGAL
                                                </h5>
                                                <!-- Kondisi Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="kondisi_barang_id" class="font-weight-bold">Kondisi Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-clipboard-check text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="kondisi_barang_id" name="kondisi_barang_id" required>
                                                            <option value="" disabled selected>Pilih Kondisi</option>
                                                            <?php foreach ($kondisiList as $kondisi): ?>
                                                                <option value="<?= htmlspecialchars($kondisi['id']) ?>">
                                                                    <?= htmlspecialchars($kondisi['nama_kondisi']) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Sumber -->
                                                <div class="form-group mb-4">
                                                    <label for="sumber" class="font-weight-bold">Sumber Perolehan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hand-holding-usd text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="sumber" name="sumber">
                                                            <option value="" <?= !isset($sarana) ? 'selected' : '' ?>>Pilih Sumber</option>
                                                            <option value="APBD" <?= (isset($sarana) && $sarana['sumber'] == 'APBD') ? 'selected' : '' ?>>APBD</option>
                                                            <option value="APBN" <?= (isset($sarana) && $sarana['sumber'] == 'APBN') ? 'selected' : '' ?>>APBN</option>
                                                            <option value="Hibah" <?= (isset($sarana) && $sarana['sumber'] == 'Hibah') ? 'selected' : '' ?>>Hibah</option>
                                                            <option value="CSR" <?= (isset($sarana) && $sarana['sumber'] == 'CSR') ? 'selected' : '' ?>>CSR Perusahaan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-4">
                                                    <label for="biaya_pembelian" class="font-weight-bold">Biaya Pembelian</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-car text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="biaya_pembelian" name="biaya_pembelian" placeholder="Contoh: 100000000 tanpa titik">
                                                    </div>
                                                </div>
                                                <div class=" form-group mb-4">
                                                    <label for="tanggal_pembelian" class="font-weight-bold">Tanggal Pembelian</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="far fa-calendar-alt text-primary"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" required>
                                                    </div>
                                                </div>

                                            </div>

                                            <!-- Data Tambahan -->
                                            <div class="col-12">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    INFORMASI TAMBAHAN
                                                </h5>
                                                <!-- Keterangan -->
                                                <div class="form-group mb-4">
                                                    <label for="lokasi " class="font-weight-bold">Lokasi Penempatan Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-laptop text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="lokasi" name="lokasi" required>
                                                            <option value="" disabled selected>Pilih Lokasi Barang</option>

                                                            <optgroup label="Lapang">
                                                                <?php foreach ($lapangData as $lokasi) : ?>
                                                                    <option value="<?= $lokasi['nama_lapang']; ?>">
                                                                        <?= $lokasi['kode_lapang']; ?> - <?= $lokasi['nama_lapang']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                            <optgroup label="Ruang">
                                                                <?php foreach ($ruangData as $lokasi) : ?>
                                                                    <option value="<?= $lokasi['nama_ruang']; ?>">
                                                                        <?= $lokasi['kode_ruang']; ?> - <?= $lokasi['nama_ruang']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                        </select>
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
                                        <a href="/admin/sarana/bergerak" class="btn btn-secondary">
                                            <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                            <i class="fas fa-save mr-2"></i>
                                            Simpan Data Sarana Bergerak
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

    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <!-- jQuery (required by Select2) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Initialize Select2 -->
    <script>
        $(document).ready(function() {
            $('#barang_input').select2({
                placeholder: "Pilih atau ketik jenis barang",
                allowClear: true,
                width: '100%' // agar penuh
            });
        });
    </script>

</body>

</html>