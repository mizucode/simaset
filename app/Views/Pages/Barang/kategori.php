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
                <div class="row">
                    <div class="col-12">

                        <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
                        <?php endif; ?>

                        <div class="card">
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                                <h3 class="h4">Daftar Data Barang</h3>
                                <a href="/admin/barang/kategori-barang/tambah" class="btn btn-warning text-dark ml-auto">
                                    <div class="text-dark d-flex flex-row align-items-center gap-2">
                                        <i class="fas fa-plus mr-1"></i>
                                        Tambah Kategori
                                    </div>
                                </a>
                            </div>

                            <div class="card-body">
                                <div class="jsgrid-wrapper">
                                    <table class="jsgrid-table">
                                        <thead>
                                            <tr class="jsgrid-header-row">
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($barangData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($barangData as $barang) : ?>
                                                    <tr class="jsgrid-row">
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= htmlspecialchars($barang['kode_barang'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_barang'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_kategori'] ?? '-'); ?></td>

                                                        <td>
                                                            <div class="d-flex flex-column gap-2">
                                                                <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#modalBarang"
                                                                    data-id="<?= $barang['id']; ?>"
                                                                    data-kode="<?= $barang['kode_barang']; ?>"
                                                                    data-nama="<?= $barang['nama_barang']; ?>"
                                                                    data-kategori="<?= $barang['kategori_id']; ?>"
                                                                    data-tahun="<?= $barang['tahun_perolehan']; ?>"
                                                                    data-kondisi="<?= $barang['kondisi_id']; ?>"
                                                                    data-jumlah="<?= $barang['jumlah']; ?>">
                                                                    <i class="fas fa-edit mr-1"></i> Edit
                                                                </button>
                                                                <a href="/admin/barang/kategori-barang?delete=<?= $barang['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                                    <i class="fas fa-trash mr-1"></i> Hapus
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="8" class="text-center">Data tidak ditemukan</td>
                                                </tr>
                                            <?php endif; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div> <!-- card -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Form -->
        <div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="modalBarangLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card card-primary mb-0">
                        <div class="card-header">
                            <h3 class="card-title" id="modalTitle">Form Data Barang</h3>
                        </div>
                        <form action="/admin/barang/kategori-barang" method="POST">
                            <input type="hidden" name="id" id="id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Kode Kategori Barang</label>
                                            <input type="text" name="kode_barang" id="kode_barang" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Kategori</label>
                                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kategori</label>
                                            <select name="kategori_id" id="kategori_id" class="form-control" required>
                                                <option value="">Pilih Kategori</option>
                                                <?php foreach ($kategoriBarang as $kategori) : ?>
                                                    <option value="<?= $kategori['id']; ?>"><?= htmlspecialchars($kategori['nama_kategori']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>

                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
                                </div>
                        </form>
                    </div> <!-- /.card -->
                </div>
            </div>
        </div>

    </div>
    <footer class="main-footer bg-white text-black">
        <strong>&copy; 2025 <a href="#">Lpptsi</a>. Umkuningan.</strong>
    </footer>

    <?php include './app/Views/Components/script.php'; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".btn-edit");

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    document.getElementById("modalTitle").textContent = "Edit Data Barang";
                    document.getElementById("submitBtn").textContent = "Update Data";
                    document.getElementById("submitBtn").className = "btn btn-warning";
                    document.getElementById("id").value = this.dataset.id;
                    document.getElementById("kode_barang").value = this.dataset.kode;
                    document.getElementById("nama_barang").value = this.dataset.nama;
                    document.getElementById("kategori_id").value = this.dataset.kategori;
                    document.getElementById("tahun_perolehan").value = this.dataset.tahun;
                    document.getElementById("kondisi_id").value = this.dataset.kondisi;
                    document.getElementById("jumlah").value = this.dataset.jumlah;
                });
            });

            $('#modalBarang').on('hidden.bs.modal', function() {
                document.getElementById("modalTitle").textContent = "Form Data Barang";
                document.getElementById("submitBtn").textContent = "Simpan";
                document.getElementById("submitBtn").className = "btn btn-primary";
                document.querySelector("form").reset();
                document.getElementById("id").value = "";
            });
        });
    </script>
</body>

</html>