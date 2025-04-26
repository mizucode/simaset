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
                                <h3 class="h4">Data Penempatan Barang</h3>
                                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#modalPenempatan">Tambah Penempatan</button>
                            </div>
                            <!-- /.card-header -->

                            <!-- Card Body -->
                            <div class="card-body">
                                <?php if (isset($error)) : ?>
                                    <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
                                <?php endif; ?>
                                <div class="jsgrid-wrapper">
                                    <table class="jsgrid-table table table-striped">
                                        <thead>
                                            <tr class="jsgrid-header-row">
                                                <th>No</th>
                                                <th>Jenis Barang</th>
                                                <th>Nama Barang</th>
                                                <th>Ruangan</th>
                                                <th>Kondisi</th>
                                                <th>Tanggal Penempatan</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (is_array($penempatanData)) : ?>
                                                <?php $no = 1; ?>
                                                <?php foreach ($penempatanData as $p) : ?>
                                                    <tr>
                                                        <td><?= $no++; ?></td>
                                                        <td><?= htmlspecialchars($p['jenis_barang']); ?></td>
                                                        <td><?= htmlspecialchars($p['nama_barang']); ?></td>
                                                        <td><?= htmlspecialchars($p['nama_ruangan']); ?></td>
                                                        <td><?= htmlspecialchars($p['nama_kondisi'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($p['tanggal_penempatan']); ?></td>
                                                        <td><?= htmlspecialchars($p['keterangan']); ?></td>
                                                        <td class="align-middle">
                                                            <div class="d-flex flex-column gap-2">
                                                                <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#modalPenempatan"
                                                                    data-id="<?= $p['id_penempatan']; ?>"
                                                                    data-jenis="<?= $p['jenis_barang']; ?>"
                                                                    data-idbarang="<?= $p['id_barang']; ?>"
                                                                    data-ruangan="<?= $p['id_ruangan']; ?>"
                                                                    data-kondisi="<?= $p['id_kondisi_barang']; ?>"
                                                                    data-tanggal="<?= $p['tanggal_penempatan']; ?>"
                                                                    data-keterangan="<?= htmlspecialchars($p['keterangan']); ?>">
                                                                    <i class="fas fa-edit mr-1"></i>Edit
                                                                </button>
                                                                <a href="/admin/penempatan/list?delete=<?= $p['id_penempatan']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                                    <i class="fas fa-trash mr-1"></i>Hapus
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

        <!-- Modal Penempatan -->
        <div class="modal fade" id="modalPenempatan" tabindex="-1" role="dialog" aria-labelledby="modalPenempatanLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" id="modalTitle">Form Penempatan Barang</h3>
                        </div>
                        <form action="/admin/penempatan/list" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="id_penempatan" id="id_penempatan">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Jenis Barang</label>
                                            <select name="jenis_barang" id="jenis_barang" class="form-control" required>
                                                <option value="elektronik">Elektronik</option>
                                                <option value="atk">ATK</option>
                                                <option value="mebel">Mebel</option>
                                                <option value="bergerak">Barang Bergerak</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>ID Barang</label>
                                            <input type="text" name="id_barang" id="id_barang" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Ruangan</label>
                                            <select name="id_ruangan" id="id_ruangan" class="form-control" required>
                                                <?php foreach ($ruanganList as $r) : ?>
                                                    <option value="<?= $r['id_ruangan']; ?>"><?= htmlspecialchars($r['nama_ruangan']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kondisi Barang</label>
                                            <select name="id_kondisi_barang" id="id_kondisi_barang" class="form-control" required>
                                                <?php foreach ($kondisiList as $k) : ?>
                                                    <option value="<?= $k['id_kondisi_barang']; ?>"><?= htmlspecialchars($k['kondisi']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Penempatan</label>
                                            <input type="date" name="tanggal_penempatan" id="tanggal_penempatan" class="form-control" required>
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
            <strong>&copy; 2025 Lpptsi. Umkuningan.</strong>
        </footer>
    </div>

    <!-- Script -->
    <?php include 'components/script.php'; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".btn-edit");

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    // Set modal title & button style
                    document.getElementById("modalTitle").textContent = "Edit Penempatan Barang";
                    document.getElementById("submitBtn").textContent = "Update";
                    document.getElementById("submitBtn").className = "btn btn-warning";

                    // Fill form values
                    document.getElementById("id_penempatan").value = this.dataset.id;
                    document.getElementById("jenis_barang").value = this.dataset.jenis;
                    document.getElementById("id_barang").value = this.dataset.idbarang;
                    document.getElementById("id_ruangan").value = this.dataset.ruangan;
                    document.getElementById("id_kondisi_barang").value = this.dataset.kondisi;
                    document.getElementById("tanggal_penempatan").value = this.dataset.tanggal;
                    document.getElementById("keterangan").value = this.dataset.keterangan;
                });
            });

            // Reset modal on close
            $('#modalPenempatan').on('hidden.bs.modal', function() {
                document.getElementById("modalTitle").textContent = "Form Penempatan Barang";
                document.getElementById("submitBtn").textContent = "Simpan";
                document.getElementById("submitBtn").className = "btn btn-primary";
                document.querySelector("form").reset();
                document.getElementById("id_penempatan").value = "";
            });
        });
    </script>
</body>

</html>