<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white py-4 mb-5 px-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <?php
                        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                            echo '<pre>';
                            var_dump($_POST);
                            echo '</pre>';
                        }
                        ?>
                        <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
                        <?php endif; ?>
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Data Ruangan</h3>
                            </div>

                            <form action="/admin/prasarana/ruang" method="POST">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Kode Ruangan</label>
                                                <input type="text" name="kode_ruang" id="kode_ruang" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Ruangan</label>
                                                <input type="text" name="nama_ruang" id="nama_ruang" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Pilih Gedung</label>
                                                <select name="gedung_id" id="" class="form-control" required>
                                                    <option value="" disabled selected hidden>Pilih Lokasi Gedung</option>
                                                    <?php foreach ($gedungData as $gedung): ?>
                                                        <option value="<?= $gedung['id']; ?>"><?= $gedung['nama_gedung']; ?> - <?= $gedung['kode_gedung']; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-footer bg-white text-black">
            <strong>&copy; 2025 <a href="#">Lpptsi</a>. Umkuningan.</strong>
        </footer>
    </div>

    <?php include './app/Views/Components/script.php'; ?>
</body>

</html>