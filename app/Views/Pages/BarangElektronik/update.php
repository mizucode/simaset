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
                        <?php if (!empty($_SESSION['error'])) : ?>
                            <div class="alert alert-danger alert-dismissible fade show mb-4">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <?= htmlspecialchars($_SESSION['error']); ?>
                                <?php unset($_SESSION['error']); ?>
                            </div>
                        <?php endif; ?>
                        <?php if (!empty($_SESSION['update'])) : ?>
                            <div class="alert alert-success alert-dismissible fade show mb-4">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">×</span>
                                </button>
                                <?= htmlspecialchars($_SESSION['update']); ?>
                                <?php unset($_SESSION['update']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <h3 class="text-lg">
                                    Formulir Data Sarana Elektronik
                                </h3>
                            </div>

                            <form action="<?= isset($sarana) ? '/admin/sarana/elektronik?edit=' . $sarana['id'] : '/admin/sarana/elektronik/tambah' ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id" value="<?= $sarana['id'] ?? '' ?>">
                                <input type="hidden" name="kategori_barang_id" value="4" id="kategori_barang_id">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Data Identitas Sarana -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    IDENTITAS SARANA ELEKTRONIK
                                                </h5>
                                                <!-- Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="barang_id" class="font-weight-bold">Jenis Barang Elektronik</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-desktop text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="barang_id" name="barang_id" required>
                                                            <option value="" disabled selected>Pilih Jenis Barang</option>
                                                            <?php foreach ($barangList as $barang): ?>
                                                                <?php if ($barang['kategori_id'] == 4): ?>
                                                                    <option value="<?= htmlspecialchars($barang['id']) ?>"
                                                                        <?= isset($sarana['barang_id']) && $sarana['barang_id'] == $barang['id'] ? 'selected' : '' ?>>
                                                                        <?= htmlspecialchars($barang['nama_barang']) ?>
                                                                    </option>
                                                                <?php endif; ?>
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
                                                        <input type="text" class="form-control" id="nama_detail_barang" name="nama_detail_barang"
                                                            placeholder="Contoh: Laptop Dell XPS 13, Proyektor Epson EB-S41" required
                                                            value="<?= $sarana['nama_detail_barang'] ?? '' ?>">
                                                    </div>
                                                </div>
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
                                                        <input type="text" class="form-control" id="merk" name="merk"
                                                            placeholder="Contoh: Dell, Epson, Samsung, LG, dll"
                                                            value="<?= $sarana['merk'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <!-- Tipe -->
                                                <div class="form-group mb-4">
                                                    <label for="tipe" class="font-weight-bold">Tipe/Model</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-barcode text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="tipe" name="tipe"
                                                            placeholder="Contoh: XPS 13 9310, EB-S41, Galaxy S21"
                                                            value="<?= $sarana['tipe'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <!-- Spesifikasi -->
                                                <div class="form-group mb-4">
                                                    <label for="spesifikasi" class="font-weight-bold">Spesifikasi</label>
                                                    <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                                                        placeholder="Masukkan spesifikasi lengkap (RAM, Storage, Ukuran Layar, Resolusi, dll)"><?= $sarana['spesifikasi'] ?? '' ?></textarea>
                                                </div>
                                            </div>

                                            <!-- Data Kondisi dan Kuantitas -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    KONDISI & PEMBELIAN
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
                                                                <option value="<?= htmlspecialchars($kondisi['id']) ?>"
                                                                    <?= isset($sarana['kondisi_barang_id']) && $sarana['kondisi_barang_id'] == $kondisi['id'] ? 'selected' : '' ?>>
                                                                    <?= htmlspecialchars($kondisi['nama_kondisi']) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Jumlah -->
                                                <div class="form-group mb-4">
                                                    <label for="jumlah" class="font-weight-bold">Jumlah</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-calculator text-primary"></i></span>
                                                        </div>
                                                        <input type="number" class="form-control" id="jumlah" name="jumlah"
                                                            value="<?= $sarana['jumlah'] ?? '1' ?>" min="1" required>
                                                        <div class="input-group-append">
                                                            <select class="form-control" id="satuan" name="satuan" required>
                                                                <option value="Unit" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Unit' ? 'selected' : '') ?>>Unit</option>
                                                                <option value="Buah" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Buah' ? 'selected' : '') ?>>Buah</option>
                                                                <option value="Set" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Set' ? 'selected' : '') ?>>Set</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!-- Biaya Pembelian -->
                                                <div class="form-group mb-4">
                                                    <label for="biaya_pembelian" class="font-weight-bold">Biaya Pembelian</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-money-bill-wave text-primary"></i></span>
                                                        </div>
                                                        <input type="number" class="form-control" id="biaya_pembelian" name="biaya_pembelian"
                                                            placeholder="Contoh: 15000000 (tanpa titik/koma)" min="0"
                                                            value="<?= $sarana['biaya_pembelian'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <!-- Tanggal Pembelian -->
                                                <div class="form-group mb-4">
                                                    <label for="tanggal_pembelian" class="font-weight-bold">Tanggal Pembelian</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="far fa-calendar-alt text-primary"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian"
                                                            value="<?= $sarana['tanggal_pembelian'] ?? '' ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data Tambahan -->
                                            <div class="col-12">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    INFORMASI TAMBAHAN
                                                </h5>
                                                <!-- Lokasi Penempatan -->
                                                <div class="form-group mb-4">
                                                    <label for="lokasi" class="font-weight-bold">Lokasi Penempatan Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-map-marker-alt text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="lokasi" name="lokasi" required>
                                                            <option value="" disabled selected>Pilih Lokasi Barang</option>
                                                            <optgroup label="Lapang">
                                                                <?php foreach ($lapangData as $itemLokasi) : ?>
                                                                    <option value="<?= htmlspecialchars($itemLokasi['nama_lapang']); ?>"
                                                                        <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $itemLokasi['nama_lapang'] ? 'selected' : '') ?>>
                                                                        <?= htmlspecialchars($itemLokasi['kode_lapang']); ?> - <?= htmlspecialchars($itemLokasi['nama_lapang']); ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                            <optgroup label="Ruang">
                                                                <?php foreach ($ruangData as $itemLokasi) : ?>
                                                                    <option value="<?= htmlspecialchars($itemLokasi['nama_ruang']); ?>"
                                                                        <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $itemLokasi['nama_ruang'] ? 'selected' : '') ?>>
                                                                        <?= htmlspecialchars($itemLokasi['kode_ruang']); ?> - <?= htmlspecialchars($itemLokasi['nama_ruang']); ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Keterangan -->
                                                <div class="form-group mb-4">
                                                    <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                                                        placeholder="Tambahkan keterangan jika diperlukan (misal: kondisi garansi, catatan perbaikan, dll)"><?= $sarana['keterangan'] ?? '' ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right text-white">
                                        <a href="/admin/sarana/elektronik" class="btn btn-secondary">
                                            <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                            <i class="fas fa-save mr-2"></i>
                                            Simpan Perubahan Data Sarana Elektronik
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