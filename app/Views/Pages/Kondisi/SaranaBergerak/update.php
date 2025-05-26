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
                                    <span aria-hidden="true">×</span>
                                </button>
                                <?= htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['update'])) : ?>
                            <div class="alert alert-success alert-dismissible fade show mb-4">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <?= htmlspecialchars($_SESSION['update']); ?>
                            </div>
                            <?php unset($_SESSION['update']); ?>
                        <?php endif; ?>

                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <h3 class="text-lg">
                                    Edit Data Sarana Bergerak
                                </h3>
                            </div>

                            <form action="/admin/sarana/bergerak/pindah?edit=<?= htmlspecialchars($sarana['id']) ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" value="<?= htmlspecialchars($sarana['id']) ?>">
                                <input type="hidden" name="kategori_barang_id" value="1" id="kategori_barang_id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Data Identitas Sarana -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    IDENTITAS SARANA BERGERAK
                                                </h5>

                                                <!-- Barang -->
                                                <div class="form-group mb-4 hidden"> <!-- Hapus class 'hidden' jika sebelumnya ada -->
                                                    <label for="barang_id" class="font-weight-bold text-dark mb-2">Jenis Barang</label>
                                                    <div class="rounded-md d-flex align-items-stretch border bg-white select2-custom-wrapper">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text border-0 bg-light">
                                                                <i class="fas fa-boxes text-primary"></i>
                                                            </span>
                                                        </div>
                                                        <select class="form-control rounded border-0 select2-custom" id="barang_id" name="barang_id" required>
                                                            <!-- Opsi placeholder bisa ditambahkan jika diperlukan, namun karena ini form edit, value akan langsung terpilih -->
                                                            <!-- <option value="" disabled>Pilih atau ketik jenis barang</option> -->
                                                            <?php foreach ($barangList as $barang): ?>
                                                                <option value="<?= htmlspecialchars($barang['id']) ?>" <?= ($sarana['barang_id'] == $barang['id']) ? 'selected' : '' ?>>
                                                                    <?= htmlspecialchars($barang['nama_barang']) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <small class="form-text text-muted mt-1">Pilih barang dari daftar atau ketik untuk mencari</small>
                                                </div>

                                                <!-- Nama Detail Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="nama_detail_barang" class="font-weight-bold">Nama Detail Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-tag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" readonly class="form-control" id="nama_detail_barang" name="nama_detail_barang"
                                                            value="<?= htmlspecialchars($sarana['nama_detail_barang']) ?>"
                                                            placeholder="Contoh: Mobil Toyota Avanza" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data Spesifikasi -->
                                            <div class="col-12 mb-5 hidden">
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
                                                        <input type="text" class="form-control" id="merk" name="merk"
                                                            value="<?= htmlspecialchars($sarana['merk']) ?>"
                                                            placeholder="Contoh: Toyota">
                                                    </div>
                                                </div>
                                                <!-- No Polisi -->
                                                <div class="form-group mb-4">
                                                    <label for="no_polisi" class="font-weight-bold">Nomor Polisi</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-car text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="no_polisi" name="no_polisi"
                                                            value="<?= htmlspecialchars($sarana['no_polisi']) ?>"
                                                            placeholder="Contoh: B 1234 ABC">
                                                    </div>
                                                </div>
                                                <!-- Spesifikasi -->
                                                <div class="form-group mb-4">
                                                    <label for="spesifikasi" class="font-weight-bold">Spesifikasi</label>
                                                    <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                                                        placeholder="Masukkan spesifikasi lengkap"><?= htmlspecialchars($sarana['spesifikasi']) ?></textarea>
                                                </div>
                                            </div>

                                            <!-- Data Kondisi dan Kuantitas -->
                                            <div class="col-12 mb-5 ">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    PERUBAHAN KONDISI
                                                </h5>
                                                <!-- Kondisi Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="kondisi_barang_id" class="font-weight-bold">Kondisi Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-clipboard-check text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="kondisi_barang_id" name="kondisi_barang_id" required>
                                                            <option value="" disabled>Pilih Kondisi</option>
                                                            <?php foreach ($kondisiList as $kondisi): ?>
                                                                <option value="<?= htmlspecialchars($kondisi['id']) ?>" <?= ($sarana['kondisi_barang_id'] == $kondisi['id']) ? 'selected' : '' ?>>
                                                                    <?= htmlspecialchars($kondisi['nama_kondisi']) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Sumber -->
                                                <div class="form-group mb-4 hidden">
                                                    <label for="sumber" class="font-weight-bold">Sumber Perolehan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hand-holding-usd text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="sumber" name="sumber">
                                                            <option value="">Pilih Sumber</option>
                                                            <option value="APBD" <?= ($sarana['sumber'] == 'APBD') ? 'selected' : '' ?>>APBD</option>
                                                            <option value="APBN" <?= ($sarana['sumber'] == 'APBN') ? 'selected' : '' ?>>APBN</option>
                                                            <option value="Hibah" <?= ($sarana['sumber'] == 'Hibah') ? 'selected' : '' ?>>Hibah</option>
                                                            <option value="CSR" <?= ($sarana['sumber'] == 'CSR') ? 'selected' : '' ?>>CSR Perusahaan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-4 hidden">
                                                    <label for="biaya_pembelian" class="font-weight-bold">Biaya Pembelian</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-money-bill-wave text-primary"></i></span> <!-- Ikon disesuaikan -->
                                                        </div>
                                                        <input type="text" class="form-control" id="biaya_pembelian" name="biaya_pembelian"
                                                            value="<?= htmlspecialchars($sarana['biaya_pembelian']) ?>"
                                                            placeholder="Contoh: 100000000 tanpa titik">
                                                    </div>
                                                </div>
                                                <div class="form-group mb-4 hidden <?php echo (isset($sarana['tanggal_pembelian']) && !empty($sarana['tanggal_pembelian'])) ? '' : 'hidden'; ?>"> <!-- Tetap hidden jika memang disembunyikan atau tampilkan jika ada nilainya -->
                                                    <label for="tanggal_pembelian" class="font-weight-bold">Tanggal Pembelian</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="far fa-calendar-alt text-primary"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian"
                                                            value="<?= htmlspecialchars($sarana['tanggal_pembelian']) ?>"> <!-- required dihilangkan jika bisa kosong -->
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data Tambahan -->
                                            <div class="col-12 hidden">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    LOKASI PEMINDAHAN
                                                </h5>

                                                <!-- Lokasi Penempatan Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="lokasi" class="font-weight-bold text-dark mb-2">Lokasi Penempatan Barang</label>
                                                    <div class="rounded-md d-flex align-items-stretch border bg-white select2-custom-wrapper">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text border-0 bg-light">
                                                                <i class="fas fa-map-marker-alt text-primary"></i> <!-- Ganti ikon -->
                                                            </span>
                                                        </div>
                                                        <select class="form-control rounded border-0 select2-custom" id="lokasi" name="lokasi" required>
                                                            <!-- <option value="" disabled>Pilih atau ketik lokasi barang</option> -->
                                                            <optgroup label="Lapang">
                                                                <?php foreach ($lapangData as $lokasi_item) : ?>
                                                                    <option value="<?= htmlspecialchars($lokasi_item['nama_lapang']); ?>" <?= ($sarana['lokasi'] == $lokasi_item['nama_lapang']) ? 'selected' : '' ?>>
                                                                        <?= htmlspecialchars($lokasi_item['kode_lapang']); ?> - <?= htmlspecialchars($lokasi_item['nama_lapang']); ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                            <optgroup label="Ruang">
                                                                <?php foreach ($ruangData as $lokasi_item) : ?>
                                                                    <option value="<?= htmlspecialchars($lokasi_item['nama_ruang']); ?>" <?= ($sarana['lokasi'] == $lokasi_item['nama_ruang']) ? 'selected' : '' ?>>
                                                                        <?= htmlspecialchars($lokasi_item['kode_ruang']); ?> - <?= htmlspecialchars($lokasi_item['nama_ruang']); ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                    <small class="form-text text-muted mt-1">Pilih lokasi dari daftar atau ketik untuk mencari</small>
                                                </div>

                                                <div class="form-group mb-4 hidden">
                                                    <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                                                        placeholder="Tambahkan keterangan jika diperlukan"><?= htmlspecialchars($sarana['keterangan']) ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right text-white"> <!-- Latar belakang card-footer di view tambah adalah putih, disamakan -->
                                        <a href="/admin/sarana/bergerak/kondisi" class="btn btn-secondary">
                                            <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                            <i class="fas fa-save mr-2"></i>
                                            Update Data Sarana Bergerak
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

    <!-- Initialize Select2 -->
    <script>
        $(document).ready(function() {
            // Inisialisasi Select2 untuk Jenis Barang
            $('#barang_id').select2({ // ID disesuaikan dengan id select jenis barang di form edit
                placeholder: "Pilih atau ketik jenis barang",
                allowClear: false,
                minimumResultsForSearch: 1,
            });

            // Inisialisasi Select2 untuk Lokasi Penempatan Barang
            $('#lokasi').select2({
                placeholder: "Pilih atau ketik lokasi barang",
                allowClear: false,
                minimumResultsForSearch: 1,
            });
        });
    </script>
    <style>
        .select2-custom-wrapper .select2-selection {
            border: none !important;
            background: transparent !important;
            height: auto !important;
            padding: 0 !important;
        }

        .select2-custom-wrapper .select2-selection__rendered {
            padding-left: 10px !important;
            line-height: inherit !important;
        }

        .select2-custom-wrapper .select2-selection__arrow {
            height: 100% !important;
        }

        .select2-dropdown {
            border: 1px solid #ddd !important;
        }

        .select2-custom-wrapper .select2-selection--single:focus {
            outline: none !important;
        }

        .select2-custom-wrapper .select2-selection--single {
            height: 38px !important;
            display: flex !important;
            align-items: center !important;
        }

        /* Jika card-footer di form tambah tidak berwarna, maka hilangkan text-white */
        /* .card-footer { background-color: #f8f9fa; border-top: 1px solid #dee2e6; } */
        /* Contoh jika ingin footer abu-abu terang */
    </style>

</body>

</html>