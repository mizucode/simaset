<!DOCTYPE html>
<html lang="en">
<?php include 'components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include 'components/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include 'components/aside.php'; ?>
        <!-- End Sidebar -->

        <!-- Content Wrapper -->
        <div class="content-wrapper bg-white py-4 mb-5 px-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- Card Header -->
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                                <h3 class="h4">Data Barang</h3>
                                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#modalBarang">Tambah Data</button>
                            </div>
                            <!-- /.card-header -->

                            <!-- Card Body -->
                            <div class="card-body">
                                <?php if (isset($error)) : ?>
                                    <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
                                <?php endif; ?>
                                <div class="table-responsive">
                                    <table class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori</th>
                                                <th>Jumlah</th>
                                                <th>Kondisi</th>
                                                <th>Tahun Perolehan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($barangData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($barangData as $barang) : ?>
                                                    <tr>
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= htmlspecialchars($barang['kode_barang']); ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_barang']); ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_kategori'] ?? ''); ?></td>
                                                        <td><?= htmlspecialchars($barang['jumlah']); ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_kondisi'] ?? ''); ?></td>
                                                        <td><?= htmlspecialchars($barang['tahun_perolehan']); ?></td>
                                                        <td class="align-middle">
                                                            <div class="d-flex flex-column gap-2">
                                                                <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#modalBarang"
                                                                    data-id="<?= $barang['id']; ?>"
                                                                    data-kode="<?= $barang['kode_barang']; ?>"
                                                                    data-nama="<?= $barang['nama_barang']; ?>"
                                                                    data-kategori="<?= $barang['kategori_id']; ?>"
                                                                    data-jumlah="<?= $barang['jumlah']; ?>"
                                                                    data-kondisi="<?= $barang['kondisi_id']; ?>"
                                                                    data-tahun="<?= $barang['tahun_perolehan']; ?>">
                                                                    <i class="fas fa-edit mr-1"></i>
                                                                    Edit
                                                                </button>
                                                                <a href="/admin/sarana/barang?delete=<?= $barang['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                                    <i class="fas fa-trash mr-1"></i>
                                                                    Hapus
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
                            <!-- /.card-body -->
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="modalBarangLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" id="modalTitle">Form Data Barang</h3>
                        </div>
                        <form action="/admin/sarana/barang" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="id" id="id">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Barang</label>
                                            <input type="text" name="kode_barang" id="kode_barang" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Barang</label>
                                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kategori</label>
                                            <select name="kategori_id" id="kategori_id" class="form-control" required>
                                                <?php foreach ($kategoriList as $kategori) : ?>
                                                    <option value="<?= $kategori['id']; ?>"><?= htmlspecialchars($kategori['nama_kategori']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kondisi</label>
                                            <select name="kondisi_id" id="kondisi_id" class="form-control" required>
                                                <?php foreach ($kondisiList as $kondisi) : ?>
                                                    <option value="<?= $kondisi['id']; ?>"><?= htmlspecialchars($kondisi['nama_kondisi']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Perolehan</label>
                                            <input type="number" name="tahun_perolehan" id="tahun_perolehan" class="form-control">
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

        <!-- Footer -->
        <footer class="main-footer bg-white text-black">
            <strong>Copyright &copy; 2025 <a href="#">Lpptsi</a>. Umkuningan.</strong>
        </footer>
    </div>

    <!-- Script -->
    <?php include 'components/script.php'; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".btn-edit");

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    // Set modal title and button
                    document.getElementById("modalTitle").textContent = "Edit Data Barang";
                    document.getElementById("submitBtn").textContent = "Update Data";
                    document.getElementById("submitBtn").className = "btn btn-warning";

                    // Fill form with data
                    document.getElementById("id").value = this.dataset.id;
                    document.getElementById("kode_barang").value = this.dataset.kode;
                    document.getElementById("nama_barang").value = this.dataset.nama;
                    document.getElementById("kategori_id").value = this.dataset.kategori;
                    document.getElementById("jumlah").value = this.dataset.jumlah;
                    document.getElementById("kondisi_id").value = this.dataset.kondisi;
                    document.getElementById("tahun_perolehan").value = this.dataset.tahun;
                });
            });

            // Reset modal when closed
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