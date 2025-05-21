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
                                <h3 class="text-lg">Tambah Dokumentasi Lapang</h3>
                            </div>

                            <form action="/admin/prasarana/lapang?tambah-gambar=<?= $lapangData['id'] ?? '' ?>" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-5">
                                            <h5 class="border-bottom pb-2 mb-3 text-bold">DATA DOKUMEN TANAH</h5>

                                            <!-- Aset Tanah -->
                                            <div class="form-group mb-4">
                                                <label for="aset_lapang_id" class="font-weight-bold">Pilih Aset Tanah</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-map-marker-alt text-primary"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="aset_lapang_id" name="aset_lapang_id"
                                                        value="<?= htmlspecialchars($lapangData['id']) ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="nama_dokumen" class="font-weight-bold">Nama Dokumen</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-file-alt text-primary"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" value="">
                                                </div>
                                            </div>
                                            <!-- Upload Dokumen -->
                                            <div class="form-group mb-4">
                                                <label for="path_dokumen" class="font-weight-bold">Upload Dokumen Lapang</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-file-upload text-primary"></i></span>
                                                    </div>
                                                    <input type="file" class="form-control" id="path_dokumen" name="path_dokumen"
                                                        accept="image/jpeg, image/png, image/jpg, image/png" required>
                                                </div>
                                                <small class="form-text text-muted">Format file: JPG, PNG (maks. 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right text-white">
                                    <a href="/admin/prasarana/lapang?detail=<?= htmlspecialchars($lapangData['id']) ?>" class="btn btn-secondary">
                                        <i class="fas fa-arrow-alt-circle-left mr-2"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <i class="fas fa-save mr-2"></i>
                                        <?= isset($lapang) ? 'Update Data Lapang' : 'Simpan Data Lapang' ?>
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
            const namaAsetInput = document.getElementById('nama_aset');
            const kodeAsetInput = document.getElementById('kode_aset');

            namaAsetInput.addEventListener('input', function() {
                let namaAset = namaAsetInput.value.trim();

                if (namaAset.length > 0) {
                    // Ambil huruf pertama dari setiap kata
                    let singkatan = namaAset
                        .split(' ')
                        .filter(kata => kata.length > 0)
                        .map(kata => kata.charAt(0).toUpperCase())
                        .join('');

                    // Gabungkan dengan awalan TNH-
                    let kodeAset = `TNH-${singkatan}`;
                    kodeAsetInput.value = kodeAset;
                } else {
                    // Kosongkan jika nama aset kosong
                    kodeAsetInput.value = '';
                }
            });
        });
    </script>

    <script>
        document.getElementById('file_sertifikat').addEventListener('change', function(e) {
            var fileName = e.target.files[0]?.name || 'Pilih File Sertifikat';
            var nextSibling = e.target.nextElementSibling;
            nextSibling.innerText = fileName;
        });
    </script>

</body>

</html>