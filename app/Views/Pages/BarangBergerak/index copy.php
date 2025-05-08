<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white py-4 mb-5 px-2">
            <div class="container-fluid">
                <?php include './app/Views/Components/helper.php'; ?>

                <!-- Flash Messages -->

                <?php var_dump($_POST); ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card card-success card-outline">
                            <div class="card-header">
                                <h3 class="card-title">Formulir Tambah Data Barang Bergerak</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <form action="/admin/sarana/bergerak" method="POST">
                                    <input type="hidden" name="id" id="form_id" value="">
                                    <input type="hidden" name="kategori_id" value="1">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Kode Barang</label>
                                                    <input type="text" name="kode_barang_bergerak" id="kode_barang_bergerak" class="form-control" required>
                                                </div>
                                                <div class="form-group">
                                                    <label>Nama Barang</label>
                                                    <input type="text" name="nama_barang_bergerak" id="nama_barang_bergerak" class="form-control" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>Pilih Jenis Barang</label>
                                                    <select name="barang_id" id="barang_id" class="form-control" required>
                                                        <option value="" disabled selected hidden>Pilih Barang</option>
                                                        <?php foreach ($barangData as $barang) : ?>
                                                            <?php if ($barang['kategori_id'] == 1) : ?>
                                                                <option value="<?= $barang['id']; ?>">
                                                                    <?= htmlspecialchars($barang['kode_barang']); ?> - <?= htmlspecialchars($barang['nama_barang']); ?>
                                                                </option>
                                                            <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                        <button type="submit" class="btn btn-primary">Simpan</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                                <h3 class="h4">Data Barang Bergerak</h3>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($barangBergerakData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($barangBergerakData as $barang) : ?>
                                                    <tr>
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= htmlspecialchars($barang['kode_barang_bergerak'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_barang_bergerak'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_kategori'] ?? '-'); ?></td>
                                                        <td>
                                                            <div class="d-flex gap-2">
                                                                <button class="btn btn-warning btn-edit"
                                                                    data-id="<?= $barang['id']; ?>"
                                                                    data-kode_barang="<?= $barang['kode_barang_bergerak']; ?>"
                                                                    data-nama_barang="<?= $barang['nama_barang_bergerak']; ?>"
                                                                    data-barang_id="<?= $barang['barang_id']; ?>"
                                                                    data-kategori_id="<?= $barang['kategori_id']; ?>">
                                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                                </button>

                                                                <a href="/admin/sarana/bergerak?delete=<?= $barang['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="5" class="text-center">Data tidak ditemukan</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".btn-edit");

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    // Set form values
                    document.getElementById("form_id").value = this.dataset.id;
                    document.getElementById("kode_barang_bergerak").value = this.dataset.kode_barang;
                    document.getElementById("nama_barang_bergerak").value = this.dataset.nama_barang;
                    document.getElementById("barang_id").value = this.dataset.barang_id;
                    document.getElementById("kategori_id").value = this.dataset.kategori_id;

                    // Scroll to form
                    document.querySelector('.card-success').scrollIntoView({
                        behavior: 'smooth'
                    });
                });
            });

            // Reset form when clicking cancel
            document.querySelector('[data-dismiss="modal"]').addEventListener('click', function() {
                document.querySelector("form").reset();
                document.getElementById("form_id").value = "";
            });
        });
    </script>
</body>

</html>