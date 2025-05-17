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

                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="alert alert-danger alert-dismissible fade show mb-4">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?= htmlspecialchars($_SESSION['error']); ?>
                            </div>
                            <?php unset($_SESSION['error']); ?>
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
                                    Update Mutasi Barang Masuk
                                </h3>
                            </div>

                            <form action="/admin/transaksi/mutasi/barang-masuk?edit=<?= $mutasi['id'] ?>" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Data Mutasi Barang Masuk -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    DATA MUTASI BARANG MASUK
                                                </h5>

                                                <!-- Tanggal Penerimaan -->
                                                <div class="form-group mb-4">
                                                    <label for="tanggal_penerimaan" class="font-weight-bold">Tanggal Penerimaan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-calendar-alt text-primary"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal_penerimaan"
                                                            value="<?= htmlspecialchars($mutasi['tanggal_penerimaan']) ?>" required>
                                                    </div>
                                                </div>

                                                <!-- Sumber Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="sumber_barang" class="font-weight-bold">Sumber Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-truck text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="sumber_barang" name="sumber_barang"
                                                            value="<?= htmlspecialchars($mutasi['sumber_barang']) ?>" placeholder="Masukkan sumber barang" required>
                                                    </div>
                                                </div>

                                                <!-- Nama Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="nama_barang" class="font-weight-bold">Nama Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-box text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                                            value="<?= htmlspecialchars($mutasi['nama_barang']) ?>" placeholder="Masukkan nama barang" required>
                                                    </div>
                                                </div>

                                                <!-- Jumlah -->
                                                <div class="form-group mb-4">
                                                    <label for="jumlah" class="font-weight-bold">Jumlah</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="number" class="form-control" id="jumlah" name="jumlah"
                                                            value="<?= htmlspecialchars($mutasi['jumlah']) ?>" placeholder="Masukkan jumlah barang" required>
                                                    </div>
                                                </div>

                                                <!-- Kondisi -->
                                                <div class="form-group mb-4">
                                                    <label for="kondisi" class="font-weight-bold">Kondisi Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-check-circle text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="kondisi" name="kondisi" required>
                                                            <option value="">Pilih Kondisi</option>
                                                            <option value="Baik" <?= $mutasi['kondisi'] == 'Baik' ? 'selected' : '' ?>>Baik</option>
                                                            <option value="Rusak" <?= $mutasi['kondisi'] == 'Rusak' ? 'selected' : '' ?>>Rusak</option>
                                                            <option value="Perlu Perbaikan" <?= $mutasi['kondisi'] == 'Perlu Perbaikan' ? 'selected' : '' ?>>Perlu Perbaikan</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Nomor Nota -->
                                                <div class="form-group mb-4">
                                                    <label for="nomor_nota" class="font-weight-bold">Nomor Nota</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-file-invoice text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nomor_nota" name="nomor_nota"
                                                            value="<?= htmlspecialchars($mutasi['nomor_nota']) ?>" placeholder="Masukkan nomor nota (opsional)">
                                                    </div>
                                                </div>

                                                <!-- Keterangan -->
                                                <div class="form-group mb-4">
                                                    <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                                    <textarea class="form-control" id="keterangan" name="keterangan" rows="3"
                                                        placeholder="Masukkan keterangan tambahan"><?= htmlspecialchars($mutasi['keterangan']) ?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right text-white">
                                    <a href="/admin/transaksi/mutasi/barang-masuk" class="btn btn-secondary">
                                        <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <i class="fas fa-save mr-2"></i>
                                        Update Data Mutasi
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