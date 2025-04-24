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
                                <div class="jsgrid-wrapper">
                                    <table class="jsgrid-table">
                                        <thead>
                                            <tr class="jsgrid-header-row">
                                                <th>No</th>
                                                <th>Kode Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Kategori</th>
                                                <th>Subkategori</th>
                                                <th>Ruangan</th>
                                                <th>Tahun Perolehan</th>
                                                <th>Jumlah</th>
                                                <th>Kondisi</th>
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
                                                        <td><?= htmlspecialchars($barang['nama_subkategori'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_ruangan'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['tahun_perolehan'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['jumlah'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_kondisi'] ?? '-'); ?></td>
                                                        <td class="align-middle">
                                                            <div class="d-flex flex-column gap-2">
                                                                <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#modalBarang"
                                                                    data-id="<?= $barang['id']; ?>"
                                                                    data-kode="<?= $barang['kode_barang']; ?>"
                                                                    data-nama="<?= $barang['nama_barang']; ?>"
                                                                    data-kategori="<?= $barang['kategori_id']; ?>"
                                                                    data-subkategori="<?= $barang['subkategori_id']; ?>"
                                                                    data-ruangan="<?= $barang['ruangan_id']; ?>"
                                                                    data-tahun="<?= $barang['tahun_perolehan']; ?>"
                                                                    data-kondisi="<?= $barang['kondisi_id']; ?>"
                                                                    data-jumlah="<?= $barang['jumlah']; ?>">
                                                                    <i class="fas fa-edit mr-1"></i>
                                                                    Edit
                                                                </button>
                                                                <a href="/admin/barang?delete=<?= $barang['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                                    <i class="fas fa-trash mr-1"></i>
                                                                    Hapus
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="10" class="text-center">Data tidak ditemukan</td>
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
                        <form action="/admin/barang" method="POST">
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
                                                <!-- Options for categories should be populated here -->
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Subkategori</label>
                                            <select name="subkategori_id" id="subkategori_id" class="form-control">
                                                <!-- Options for subcategories should be populated here -->
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Perolehan</label>
                                            <input type="number" name="tahun_perolehan" id="tahun_perolehan" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Ruangan</label>
                                            <select name="ruangan_id" id="ruangan_id" class="form-control" required>
                                                <?php foreach ($ruanganList as $ruangan) : ?>
                                                    <option value="<?= $ruangan['id_ruangan']; ?>"><?= htmlspecialchars($ruangan['nama_ruangan']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Kondisi</label>
                                            <select name="kondisi_id" id="kondisi_id" class="form-control" required>
                                                <option value="1">Baik</option>
                                                <option value="2">Rusak Ringan</option>
                                                <option value="3">Rusak Berat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
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
                    document.getElementById("subkategori_id").value = this.dataset.subkategori;
                    document.getElementById("ruangan_id").value = this.dataset.ruangan;
                    document.getElementById("tahun_perolehan").value = this.dataset.tahun;
                    document.getElementById("kondisi_id").value = this.dataset.kondisi;
                    document.getElementById("jumlah").value = this.dataset.jumlah;
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