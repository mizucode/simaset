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
                                    Formulir Data Barang
                                </h3>
                            </div>

                            <form action="/admin/barang/jenis-barang/tambah" method="POST">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Data Barang -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                    IDENTITAS BARANG
                                                </h5>
                                                <!-- Kode Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="kode_barang" class="font-weight-bold">Kode Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                                                            placeholder="Contoh: MBL-001" required>
                                                    </div>
                                                </div>
                                                <!-- Nama Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="nama_barang" class="font-weight-bold">Nama Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-tag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                                            placeholder="Contoh: Meja Rapat" required>
                                                    </div>
                                                </div>
                                                <!-- Kategori -->
                                                <div class="form-group mb-4">
                                                    <label for="kategori_id" class="font-weight-bold">Kategori</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-boxes text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="kategori_id" name="kategori_id" required>
                                                            <option value="" disabled selected>Pilih Kategori</option>
                                                            <?php foreach ($kategoriList as $kategori): ?>
                                                                <option value="<?= htmlspecialchars($kategori['id']) ?>">
                                                                    <?= htmlspecialchars($kategori['nama_kategori']) ?>
                                                                </option>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="card-footer text-right text-white">
                                        <a href="/admin/barang" class="btn btn-secondary">
                                            <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                                        </a>
                                        <button type="submit" class="btn btn-primary" id="submitBtn">
                                            <i class="fas fa-save mr-2"></i>
                                            Simpan Data Barang
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