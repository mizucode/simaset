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
                                <h3 class="text-lg">Tambah Dokumentasi Barang ATK</h3>
                            </div>

                            <form action="/admin/sarana/atk?tambah-gambar=<?= $atkData['id'] ?? '' ?>" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12 mb-5">
                                            <h5 class="border-bottom pb-2 mb-3 text-bold">DATA DOKUMENTASI BARANG ATK</h5>

                                            <!-- Aset ATK -->
                                            <div class="form-group mb-4">
                                                <label for="aset_atk_id" class="font-weight-bold">Pilih Barang ATK</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-box-open text-primary"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="aset_atk_id" name="aset_atk_id"
                                                        value="<?= htmlspecialchars($atkData['id']) ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="nama_dokumen" class="font-weight-bold">Nama Dokumentasi</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-file-image text-primary"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="nama_dokumen" name="nama_dokumen" value="" required>
                                                </div>
                                                <small class="form-text text-muted">Contoh: Foto kondisi barang, kemasan, dll.</small>
                                            </div>
                                            <!-- Upload Gambar -->
                                            <div class="form-group mb-4">
                                                <label for="path_dokumen" class="font-weight-bold">Upload Dokumentasi Barang ATK</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-camera text-primary"></i></span>
                                                    </div>
                                                    <div class="custom-file">
                                                        <input type="file" class="custom-file-input" id="path_dokumen" name="path_dokumen"
                                                            accept="image/jpeg, image/png, image/jpg, image/webp" required>
                                                        <label class="custom-file-label" for="path_dokumen">Pilih file gambar</label>
                                                    </div>
                                                </div>
                                                <small class="form-text text-muted">Format file: JPG, PNG, WEBP (maks. 5MB)</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right text-white">
                                    <a href="/admin/sarana/atk?detail=<?= htmlspecialchars($atkData['id']) ?>" class="btn btn-secondary">
                                        <i class="fas fa-arrow-alt-circle-left mr-2"></i> Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <i class="fas fa-save mr-2"></i>
                                        Simpan Dokumentasi ATK
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
        // Update file input label
        document.getElementById('path_dokumen').addEventListener('change', function(e) {
            var fileName = e.target.files[0]?.name || 'Pilih file gambar';
            var label = e.target.nextElementSibling;
            label.innerText = fileName;

            // Preview image before upload
            const preview = document.createElement('div');
            preview.className = 'mt-3';
            preview.innerHTML = '<h6>Pratinjau Gambar:</h6>';

            const imgPreview = document.createElement('img');
            imgPreview.src = URL.createObjectURL(e.target.files[0]);
            imgPreview.style.maxWidth = '100%';
            imgPreview.style.maxHeight = '200px';
            imgPreview.className = 'img-thumbnail';

            preview.appendChild(imgPreview);

            // Remove previous preview if exists
            const oldPreview = document.querySelector('.image-preview');
            if (oldPreview) {
                oldPreview.remove();
            }

            preview.className = 'image-preview mt-3';
            e.target.closest('.form-group').appendChild(preview);
        });

        // Form validation
        document.querySelector('form').addEventListener('submit', function(e) {
            const fileInput = document.getElementById('path_dokumen');
            if (fileInput.files.length > 0) {
                const fileSize = fileInput.files[0].size / 1024 / 1024; // in MB
                if (fileSize > 5) {
                    e.preventDefault();
                    alert('Ukuran file terlalu besar. Maksimal 5MB');
                    return false;
                }

                const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
                if (!validTypes.includes(fileInput.files[0].type)) {
                    e.preventDefault();
                    alert('Format file tidak didukung. Harap upload gambar JPG, PNG, atau WEBP');
                    return false;
                }
            }
            return true;
        });
    </script>

</body>

</html>