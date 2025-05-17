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
                                    Formulir Data Sarana Mebelair
                                </h3>
                            </div>

                            <form action="/admin/sarana/mebelair/tambah" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="kategori_barang_id" value="2" id="kategori_barang_id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Data Identitas Sarana -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    IDENTITAS SARANA MEBELAIR
                                                </h5>
                                                <!-- Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="barang_id" class="font-weight-bold">Jenis Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-boxes text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="barang_id" name="barang_id" required>
                                                            <option value="" disabled selected>Pilih Jenis Barang</option>
                                                            <?php foreach ($barangList as $barang): ?>
                                                                <?php if ($barang['kategori_id'] == 2): ?>
                                                                    <option value="<?= htmlspecialchars($barang['id']) ?>">
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
                                                            placeholder="Contoh: Meja Rapat Kayu Jati" required>
                                                    </div>
                                                </div>
                                                <!-- No Registrasi -->
                                                <div class="form-group mb-4">
                                                    <label for="no_registrasi" class="font-weight-bold">Nomor Registrasi</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="no_registrasi" name="no_registrasi"
                                                            placeholder="Contoh: REG-MBL-001" required>
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
                                                            placeholder="Contoh: IKEA, Informa, dll">
                                                    </div>
                                                </div>
                                                <!-- Material -->
                                                <div class="form-group mb-4">
                                                    <label for="bahan" class="font-weight-bold">Bahan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-copyright text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="bahan" name="bahan">
                                                            <option value="" selected disabled>Pilih Bahan...</option>
                                                            <option value="Kayu">Kayu</option>
                                                            <option value="Besi">Besi</option>
                                                            <option value="Aluminium">Aluminium</option>
                                                            <option value="Stainless Steel">Stainless Steel</option>
                                                            <option value="Rotan">Rotan</option>
                                                            <option value="Plastik">Plastik</option>
                                                            <option value="Kaca">Kaca</option>
                                                            <option value="Bambu">Bambu</option>
                                                            <option value="Kulit">Kulit</option>
                                                            <option value="Kain">Kain</option>
                                                        </select>

                                                    </div>
                                                </div>
                                                <!-- Spesifikasi -->
                                                <div class="form-group mb-4">
                                                    <label for="spesifikasi" class="font-weight-bold">Spesifikasi</label>
                                                    <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                                                        placeholder="Masukkan spesifikasi lengkap (ukuran, warna, fitur, dll)"></textarea>
                                                </div>
                                            </div>

                                            <!-- Data Kondisi dan Kuantitas -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    KONDISI & KUANTITAS
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
                                                    <label for="sumber" class="font-weight-bold">Sumber</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hand-holding-usd text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="sumber" name="sumber">
                                                            <option value="" selected disabled>Pilih Sumber</option>
                                                            <option value="APBD">APBD</option>
                                                            <option value="APBN">APBN</option>
                                                            <option value="Hibah">Hibah</option>
                                                            <option value="CSR">CSR Perusahaan</option>
                                                            <option value="Lainnya">Lainnya</option>
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
                                                            value="1" min="1" required>
                                                        <div class="input-group-append">
                                                            <select class="form-control" id="satuan" name="satuan" required>
                                                                <option value="Unit" selected>Unit</option>
                                                                <option value="Buah">Buah</option>
                                                                <option value="Set">Set</option>
                                                                <option value="Pasang">Pasang</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data Tambahan -->
                                            <div class="col-12">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    INFORMASI TAMBAHAN
                                                </h5>
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
                                                <!-- Keterangan -->
                                                <div class="form-group mb-4">
                                                    <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                                                        placeholder="Tambahkan keterangan jika diperlukan"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right text-white">
                                        <a href="/admin/sarana/mebelair" class="btn btn-secondary">
                                            <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                            <i class="fas fa-save mr-2"></i>
                                            Simpan Data Sarana Mebelair
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