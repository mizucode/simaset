<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white py-4 mb-5 px-5">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger alert-dismissible fade show mb-4">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <i class="fas fa-exclamation-circle mr-2"></i><?= htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <div class="card card-outline card-navy shadow-sm">
                            <div class="card-header bg-navy text-white">
                                <h3 class="card-title">
                                    <i class="fas fa-clipboard-list mr-2"></i>Formulir Pengembalian Barang
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <form action="/admin/pengembalian/simpan" method="POST">
                                <input type="hidden" name="id" id="id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Data Pengembalian -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3">
                                                    Data Pengembalian Barang
                                                </h5>

                                                <!-- Barang yang Dipinjam -->
                                                <div class="form-group mb-4">
                                                    <label for="barang_pinjam_id" class="font-weight-bold">Barang yang Dikembalikan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-barcode text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control select2" id="barang_pinjam_id" name="barang_pinjam_id" required>
                                                            <!-- options -->
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Nama Pengembali -->
                                                <div class="form-group mb-4">
                                                    <label for="nama" class="font-weight-bold">Nama Pengembali</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-user-tie text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Masukkan Nama Pengembali" required>
                                                    </div>
                                                </div>

                                                <!-- Tanggal Pengembalian -->
                                                <div class="form-group mb-4">
                                                    <label for="tanggal_pengembalian" class="font-weight-bold">Tanggal Pengembalian</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-calendar text-primary"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required>
                                                    </div>
                                                </div>

                                                <!-- Kondisi Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="kondisi" class="font-weight-bold">Kondisi Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-heart text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="kondisi" name="kondisi" required>
                                                            <option value="" disabled selected>Pilih Kondisi Barang</option>
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak Ringan">Rusak Ringan</option>
                                                            <option value="Rusak Berat">Rusak Berat</option>
                                                            <option value="Hilang">Hilang</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Keterangan -->
                                                <div class="form-group mb-4">
                                                    <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-comment text-primary"></i></span>
                                                        </div>
                                                        <textarea class="form-control" id="keterangan" name="keterangan" rows="3" placeholder="Masukkan keterangan tambahan (misal: kerusakan, dll)"></textarea>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right bg-light">
                                    <button type="reset" class="btn btn-secondary mr-2">
                                        <i class="fas fa-undo mr-1"></i> Reset
                                    </button>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <i class="fas fa-save mr-1"></i> Simpan Pengembalian
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <footer class="main-footer bg-white text-black text-center">
            <strong>&copy; 2025 <a href="#">LP2TSI</a>. UMKuningan.</strong>
            All rights reserved.
        </footer>
    </div>

    <?php include './app/Views/Components/script.php'; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Inisialisasi Select2
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Barang yang Dipinjam',
                width: '100%',
                allowClear: true
            });

            // Set tanggal pengembalian default ke hari ini
            document.getElementById('tanggal_pengembalian').valueAsDate = new Date();

            // Auto-fill nama pengembali saat barang dipilih
            $('#barang_pinjam_id').change(function() {
                var selectedOption = $(this).find('option:selected');
                var namaPeminjam = selectedOption.data('peminjam');
                $('#nama').val(namaPeminjam);
            });

            // Validasi form sebelum submit
            $('form').submit(function(e) {
                if (!this.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
                $(this).addClass('was-validated');
            });
        });
    </script>
</body>

</html>