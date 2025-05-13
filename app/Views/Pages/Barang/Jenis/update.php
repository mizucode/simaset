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
                    <div class="col-md-8">
                        <!-- Session Messages -->
                        <?php if (isset($_SESSION['error'])) : ?>
                            <div class="alert alert-danger alert-dismissible fade show mb-4">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?= htmlspecialchars($_SESSION['error']);
                                unset($_SESSION['error']); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (isset($_SESSION['success'])) : ?>
                            <div class="alert alert-success alert-dismissible fade show mb-4">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?= htmlspecialchars($_SESSION['success']);
                                unset($_SESSION['success']); ?>
                            </div>
                        <?php endif; ?>

                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <h3 class="card-title">
                                    <i class="fas fa-edit mr-2"></i>
                                    <?= isset($jenisBarangData) ? 'Edit' : 'Tambah' ?> Jenis Barang
                                </h3>
                            </div>

                            <form action="/admin/barang/jenis-barang<?= isset($jenisBarangData) ? '?edit=' . $jenisBarangData['id'] : '' ?>" method="POST" id="formBarang">

                                <input type="hidden" name="id" value="<?= isset($jenisBarangData['id']) ? htmlspecialchars($jenisBarangData['id']) : '' ?>">

                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Kode Barang -->
                                            <div class="form-group mb-4">
                                                <label for="kode_barang" class="font-weight-bold">Kode Barang <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-barcode text-primary"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                                                        placeholder="Contoh: BRG-001" required
                                                        value="<?= htmlspecialchars($jenisBarangData['kode_barang'] ?? ''); ?>"
                                                        maxlength="20">
                                                </div>
                                                <small class="text-muted">Maksimal 20 karakter</small>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <!-- Nama Barang -->
                                            <div class="form-group mb-4">
                                                <label for="nama_barang" class="font-weight-bold">Nama Barang <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-box text-primary"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                                        placeholder="Contoh: Meja Kantor" required
                                                        value="<?= htmlspecialchars($jenisBarangData['nama_barang'] ?? ''); ?>"
                                                        maxlength="100">
                                                </div>
                                                <small class="text-muted">Maksimal 100 karakter</small>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6">
                                            <!-- Kategori -->
                                            <div class="form-group mb-4">
                                                <label for="kategori_id" class="font-weight-bold">Kategori Barang <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-tags text-primary"></i></span>
                                                    </div>
                                                    <select class="form-control select2" id="kategori_id" name="kategori_id" required style="width: 100%;">
                                                        <option value="">Pilih Kategori</option>
                                                        <?php foreach ($kategoriList as $kategori): ?>
                                                            <option value="<?= htmlspecialchars($kategori['id']) ?>"
                                                                <?= ($jenisBarangData['kategori_id'] ?? '') == $kategori['id'] ? 'selected' : ''; ?>>
                                                                <?= htmlspecialchars($kategori['nama_kategori']) ?>
                                                            </option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right bg-white">
                                    <a href="/admin/barang/jenis-barang" class="btn btn-secondary mr-2">
                                        <i class="fas fa-arrow-left mr-2"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <i class="fas fa-save mr-2"></i><?= isset($jenisBarangData) ? 'Simpan Perubahan' : 'Tambah Barang' ?>
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
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Kategori',
                allowClear: true
            });

            // Form validation
            $('#formBarang').validate({
                rules: {
                    kode_barang: {
                        required: true,
                        minlength: 3,
                        maxlength: 20
                    },
                    nama_barang: {
                        required: true,
                        minlength: 3,
                        maxlength: 100
                    },
                    kategori_id: {
                        required: true
                    }
                },
                messages: {
                    kode_barang: {
                        required: "Kode barang wajib diisi",
                        minlength: "Minimal 3 karakter",
                        maxlength: "Maksimal 20 karakter"
                    },
                    nama_barang: {
                        required: "Nama barang wajib diisi",
                        minlength: "Minimal 3 karakter",
                        maxlength: "Maksimal 100 karakter"
                    },
                    kategori_id: {
                        required: "Kategori wajib dipilih"
                    }
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) {
                    $(element).addClass('is-invalid');
                },
                unhighlight: function(element, errorClass, validClass) {
                    $(element).removeClass('is-invalid');
                },
                submitHandler: function(form) {
                    $('#submitBtn').prop('disabled', true);
                    form.submit();
                }
            });
        });
    </script>
</body>

</html>