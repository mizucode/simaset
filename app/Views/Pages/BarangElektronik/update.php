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
                                    Formulir Data Sarana Elektronik
                                </h3>
                            </div>

                            <form action="/admin/sarana/elektronik?edit=<?= $sarana['id'] ?? '' ?>" method="POST" enctype="multipart/form-data">
                                <input type="hidden" name="id" id="id" value="<?= $sarana['id'] ?? '' ?>">
                                <input type="hidden" name="kategori_barang_id" value="1" id="kategori_barang_id">
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
                                                    <label for="barang_id" class="font-weight-bold">Jenis Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-boxes text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="barang_id" name="barang_id" required>
                                                            <option value="" disabled <?= !isset($sarana) ? 'selected' : '' ?>>Pilih Jenis Barang</option>
                                                            <?php foreach ($barangList as $barang): ?>
                                                                <?php if ($barang['kategori_id'] == 1): ?>
                                                                    <option value="<?= htmlspecialchars($barang['id']) ?>" <?= isset($sarana) && $sarana['barang_id'] == $barang['id'] ? 'selected' : '' ?>>
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
                                                            placeholder="Contoh: Laptop ASUS ROG Strix G15" required
                                                            value="<?= $sarana['nama_detail_barang'] ?? '' ?>">
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
                                                            placeholder="Contoh: REG-ELEC-001" required
                                                            value="<?= $sarana['no_registrasi'] ?? '' ?>">
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Data Spesifikasi -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    SPESIFIKASI TEKNIS
                                                </h5>
                                                <!-- Merk -->
                                                <div class="form-group mb-4">
                                                    <label for="merk" class="font-weight-bold">Merk</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-copyright text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="merk" name="merk"
                                                            placeholder="Contoh: ASUS, Dell, Lenovo"
                                                            value="<?= $sarana['merk'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <!-- Tipe -->
                                                <div class="form-group mb-4">
                                                    <label for="tipe" class="font-weight-bold">Tipe/Model</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-laptop-code text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="tipe" name="tipe"
                                                            placeholder="Contoh: ROG Strix G15, ThinkPad X1 Carbon"
                                                            value="<?= $sarana['tipe'] ?? '' ?>">
                                                    </div>
                                                </div>
                                                <!-- Spesifikasi -->
                                                <div class="form-group mb-4">
                                                    <label for="spesifikasi" class="font-weight-bold">Spesifikasi Teknis</label>
                                                    <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                                                        placeholder="Masukkan spesifikasi teknis (processor, RAM, storage, OS, dll)"><?= $sarana['spesifikasi'] ?? '' ?></textarea>
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
                                                            <option value="" disabled <?= !isset($sarana) ? 'selected' : '' ?>>Pilih Kondisi</option>
                                                            <?php foreach ($kondisiList as $kondisi): ?>
                                                                <option value="<?= htmlspecialchars($kondisi['id']) ?>" <?= isset($sarana) && $sarana['kondisi_barang_id'] == $kondisi['id'] ? 'selected' : '' ?>>
                                                                    <?= htmlspecialchars($kondisi['nama_kondisi']) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Jumlah -->
                                                <div class="form-group mb-4">
                                                    <label for="jumlah" class="font-weight-bold">Kuantitas</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-calculator text-primary"></i></span>
                                                        </div>
                                                        <input type="number" class="form-control" id="jumlah" name="jumlah"
                                                            value="<?= $sarana['jumlah'] ?? '1' ?>" min="1" required>
                                                        <div class="input-group-append">
                                                            <select class="form-control" id="satuan" name="satuan" required>
                                                                <option value="Unit" <?= (isset($sarana) && $sarana['satuan'] == 'Unit') ? 'selected' : '' ?>>Unit</option>
                                                                <option value="Buah" <?= (isset($sarana) && $sarana['satuan'] == 'Buah') ? 'selected' : '' ?>>Buah</option>
                                                                <option value="Set" <?= (isset($sarana) && $sarana['satuan'] == 'Set') ? 'selected' : '' ?>>Set</option>
                                                                <option value="Paket" <?= (isset($sarana) && $sarana['satuan'] == 'Paket') ? 'selected' : '' ?>>Paket</option>
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
                                                <!-- Keterangan -->
                                                <div class="form-group mb-4">
                                                    <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                                                        placeholder="Tambahkan keterangan jika diperlukan"><?= $sarana['keterangan'] ?? '' ?></textarea>
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
                                            Simpan Data Sarana Elektronik
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
            const barangSelect = document.getElementById('barang_id');
            const noRegInput = document.getElementById('no_registrasi');

            function generateNoRegistrasi() {
                const barangId = barangSelect.value;

                if (barangId && !noRegInput.value) {
                    const timestamp = new Date().getTime().toString().slice(-4);
                    noRegInput.value = `REG-ELEC-${barangId}-${timestamp}`;
                }
            }

            barangSelect.addEventListener('change', generateNoRegistrasi);
        });
    </script>
</body>

</html>