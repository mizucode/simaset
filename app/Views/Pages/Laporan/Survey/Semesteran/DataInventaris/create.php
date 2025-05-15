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
                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <h3 class="text-lg">
                                    Formulir Inventarisasi Barang
                                </h3>
                            </div>

                            <form action="/admin/survey/semesteran/data-inventaris?tambah=<?= htmlspecialchars($semesterData['id']) ?>" method="POST">


                                <input type="hidden" name="_method" value="PUT">
                                <input type="text" id="nama_barang_survey" name="penanggung_jawab_id" value="<?= htmlspecialchars($semesterData['id']) ?>" required hidden>
                                <div class="card-body">
                                    <?php if (isset($_SESSION['error'])): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= $_SESSION['error'];
                                            unset($_SESSION['error']); ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif; ?>

                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-group mb-4">
                                                <label for="nama_barang_survey">Nama Barang</label>
                                                <input type="text" class="form-control" id="nama_barang_survey" name="nama_barang_survey" placeholder="Nama Barang Survey" required>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="jumlah">Jumlah</label>
                                                <input type="text" class="form-control" id="jumlah" name="jumlah" required>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="kondisi">Kondisi</label>
                                                <select class="form-control" name="kondisi" required>
                                                    <option value="Baik">Baik</option>
                                                    <option value="Rusak Ringan">Rusak Ringan</option>
                                                    <option value="Rusak Berat">Rusak Berat</option>
                                                </select>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="kebutuhan">Kebutuhan</label>
                                                <input type="text" class="form-control" id="kebutuhan" name="kebutuhan" required>
                                            </div>

                                            <div class="form-group mb-4">
                                                <label for="keterangan">keterangan</label>
                                                <input type="text" class="form-control" id="keterangan" name="keterangan" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <a href="/admin/survey/semesteran" class="btn btn-secondary">
                                        <i class="fas fa-arrow-alt-circle-left mr-2"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-2"></i>Simpan Inventaris
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