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
                                <h3 class="h4">Data Barang Mebeler</h3>
                                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#modalMebeler">Tambah Data</button>
                            </div>
                            <!-- /.card-header -->

                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="jsgrid-wrapper">
                                    <table class="jsgrid-table">
                                        <thead>
                                            <tr class="jsgrid-header-row">
                                                <th>No</th>
                                                <th>Kode Mebeler</th>
                                                <th>Nama Mebeler</th>
                                                <th>Jenis Mebel</th>
                                                <th>Jumlah</th>
                                                <th>Kondisi</th>
                                                <th>Tahun Pengadaan</th>
                                                <th>Ruangan</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($barangMebelerData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($barangMebelerData as $barang) : ?>
                                                    <tr class="jsgrid-row">
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= htmlspecialchars($barang['kode_mebeler']); ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_mebeler']); ?></td>
                                                        <td><?= htmlspecialchars($barang['jenis_mebel']); ?></td>
                                                        <td><?= htmlspecialchars($barang['jumlah']); ?></td>
                                                        <td><?= htmlspecialchars($barang['kondisi']); ?></td>
                                                        <td><?= htmlspecialchars($barang['tahun_pengadaan']); ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_ruangan']); ?></td>
                                                        <td><?= htmlspecialchars($barang['keterangan']); ?></td>
                                                        <td class="align-middle">
                                                            <div class="d-flex flex-column gap-2">
                                                                <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#modalMebeler"
                                                                    data-id="<?= $barang['id_mebeler']; ?>"
                                                                    data-kode="<?= $barang['kode_mebeler']; ?>"
                                                                    data-nama="<?= $barang['nama_mebeler']; ?>"
                                                                    data-jenis="<?= $barang['jenis_mebel']; ?>"
                                                                    data-jumlah="<?= $barang['jumlah']; ?>"
                                                                    data-kondisi="<?= $barang['kondisi']; ?>"
                                                                    data-tahun="<?= $barang['tahun_pengadaan']; ?>"
                                                                    data-ruangan="<?= $barang['id_ruangan']; ?>"
                                                                    data-keterangan="<?= $barang['keterangan']; ?>">
                                                                    <i class="fas fa-edit mr-1"></i>
                                                                    Edit
                                                                </button>
                                                                <a href="/admin/sarana/mebeler?delete=<?= $barang['id_mebeler']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
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
        <div class="modal fade" id="modalMebeler" tabindex="-1" role="dialog" aria-labelledby="modalMebelerLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" id="modalTitle">Form Data Barang Mebeler</h3>
                        </div>
                        <form action="/admin/sarana/mebeler" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="id" id="id_mebeler">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Mebeler</label>
                                            <input type="text" name="kode_mebeler" id="kode_mebeler" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Mebeler</label>
                                            <input type="text" name="nama_mebeler" id="nama_mebeler" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Mebel</label>
                                            <input type="text" name="jenis_mebel" id="jenis_mebel" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kondisi</label>
                                            <select name="kondisi" id="kondisi" class="form-control">
                                                <option value="Baik">Baik</option>
                                                <option value="Rusak Ringan">Rusak Ringan</option>
                                                <option value="Rusak Berat">Rusak Berat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tahun Pengadaan</label>
                                            <input type="number" name="tahun_pengadaan" id="tahun_pengadaan" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Ruangan</label>
                                            <select name="id_ruangan" id="id_ruangan" class="form-control">
                                                <?php foreach ($ruanganList as $ruangan) : ?>
                                                    <option value="<?= $ruangan['id_ruangan']; ?>"><?= htmlspecialchars($ruangan['nama_ruangan']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control" rows="2"></textarea>
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
                    document.getElementById("modalTitle").textContent = "Edit Data Barang Mebeler";
                    document.getElementById("submitBtn").textContent = "Update Data";
                    document.getElementById("submitBtn").className = "btn btn-warning";

                    // Fill form with data
                    document.getElementById("id_mebeler").value = this.dataset.id;
                    document.getElementById("kode_mebeler").value = this.dataset.kode;
                    document.getElementById("nama_mebeler").value = this.dataset.nama;
                    document.getElementById("jenis_mebel").value = this.dataset.jenis;
                    document.getElementById("jumlah").value = this.dataset.jumlah;
                    document.getElementById("kondisi").value = this.dataset.kondisi;
                    document.getElementById("tahun_pengadaan").value = this.dataset.tahun;
                    document.getElementById("id_ruangan").value = this.dataset.ruangan;
                    document.getElementById("keterangan").value = this.dataset.keterangan;
                });
            });

            // Reset modal when closed
            $('#modalMebeler').on('hidden.bs.modal', function() {
                document.getElementById("modalTitle").textContent = "Form Data Barang Mebeler";
                document.getElementById("submitBtn").textContent = "Simpan";
                document.getElementById("submitBtn").className = "btn btn-primary";
                document.querySelector("form").reset();
                document.getElementById("id_mebeler").value = "";
            });
        });
    </script>
</body>

</html>