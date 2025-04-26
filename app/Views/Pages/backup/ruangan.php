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
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center align-content-center">
                                <h3 class="h4">Data Aset Ruangan</h3>
                                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#modalRuangan">Tambah Data Ruangan</button>
                            </div>
                            <!-- /.card-header -->

                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="jsgrid-wrapper">
                                    <table class="jsgrid-table">
                                        <thead>
                                            <tr class="jsgrid-header-row">
                                                <th>No</th>
                                                <th>Kode Ruangan</th>
                                                <th>Nama Ruangan</th>
                                                <th>Lokasi</th>
                                                <th>Letak Gedung</th>
                                                <th>Kapasitas</th>
                                                <th>Jenis Ruangan</th>
                                                <th>Luas (m²)</th>
                                                <th>Status</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($ruanganData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($ruanganData as $ruangan) : ?>
                                                    <tr class="jsgrid-row">
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= htmlspecialchars($ruangan['kode_ruangan']); ?></td>
                                                        <td><?= htmlspecialchars($ruangan['nama_ruangan']); ?></td>
                                                        <td><?= htmlspecialchars($ruangan['lokasi']); ?></td>
                                                        <td><?= htmlspecialchars($ruangan['nama_gedung']); ?></td>
                                                        <td><?= $ruangan['kapasitas']; ?></td>
                                                        <td><?= htmlspecialchars($ruangan['jenis_ruangan']); ?></td>
                                                        <td><?= $ruangan['luas']; ?></td>
                                                        <td>
                                                            <span class="badge badge-<?=
                                                                                        $ruangan['status_penggunaan'] == 'Digunakan' ? 'success' : ($ruangan['status_penggunaan'] == 'Tidak Digunakan' ? 'danger' : 'warning')
                                                                                        ?>">
                                                                <?= htmlspecialchars($ruangan['status_penggunaan']); ?>
                                                            </span>
                                                        </td>
                                                        <td><?= htmlspecialchars($ruangan['keterangan']); ?></td>
                                                        <td class="align-middle">
                                                            <div class="d-flex flex-column gap-2">
                                                                <button class="btn btn-warning btn-edit mr-2"
                                                                    style="width: 90px;"
                                                                    data-id="<?= $ruangan['id_ruangan']; ?>"
                                                                    data-kode="<?= htmlspecialchars($ruangan['kode_ruangan'], ENT_QUOTES); ?>"
                                                                    data-nama="<?= htmlspecialchars($ruangan['nama_ruangan'], ENT_QUOTES); ?>"
                                                                    data-lokasi="<?= htmlspecialchars($ruangan['lokasi'], ENT_QUOTES); ?>"
                                                                    data-id_gedung="<?= $ruangan['id_gedung']; ?>"
                                                                    data-kapasitas="<?= $ruangan['kapasitas']; ?>"
                                                                    data-jenis="<?= htmlspecialchars($ruangan['jenis_ruangan'], ENT_QUOTES); ?>"
                                                                    data-luas="<?= $ruangan['luas']; ?>"
                                                                    data-status="<?= htmlspecialchars($ruangan['status_penggunaan'], ENT_QUOTES); ?>"
                                                                    data-keterangan="<?= htmlspecialchars($ruangan['keterangan'], ENT_QUOTES); ?>"
                                                                    data-toggle="modal" data-target="#modalRuangan">
                                                                    <i class="fas fa-edit mr-1"></i>
                                                                    Edit
                                                                </button>

                                                                <a href="/admin/prasarana/ruangan?delete=<?= $ruangan['id_ruangan']; ?>"
                                                                    class="btn btn-danger"
                                                                    style="width: 90px;"
                                                                    onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                                    <i class="fas fa-trash mr-1"></i>
                                                                    Hapus
                                                                </a>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr class="jsgrid-row">
                                                    <td colspan="11" class="text-center">Data tidak ditemukan</td>
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
        <div class="modal fade" id="modalRuangan" tabindex="-1" role="dialog" aria-labelledby="modalRuanganLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" id="modalTitle">Tambah Data Ruangan</h3>
                        </div>
                        <form action="/admin/prasarana/ruangan" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="id" id="ruanganId">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_ruangan">Kode Ruangan</label>
                                            <input type="text" id="kode_ruangan" name="kode_ruangan" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_ruangan">Nama Ruangan</label>
                                            <input type="text" id="nama_ruangan" name="nama_ruangan" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi">Lokasi</label>
                                            <input type="text" id="lokasi" name="lokasi" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="id_gedung">Letak Gedung</label>
                                            <select id="id_gedung" name="id_gedung" class="form-control" required>
                                                <option value="">-- Pilih Gedung --</option>
                                                <?php foreach ($gedungList as $gedung) : ?>
                                                    <option value="<?= $gedung['id_gedung']; ?>">
                                                        <?= htmlspecialchars($gedung['nama_gedung']); ?>
                                                    </option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kapasitas">Kapasitas (Orang)</label>
                                            <input type="number" step="1" id="kapasitas" name="kapasitas" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_ruangan">Jenis Ruangan</label>
                                            <select id="jenis_ruangan" name="jenis_ruangan" class="form-control" required>
                                                <option value="Kelas">Kelas</option>
                                                <option value="Laboratorium">Laboratorium</option>
                                                <option value="Kantor">Kantor</option>
                                                <option value="Lainnya">Lainnya</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="luas">Luas (m²)</label>
                                            <input type="number" step="0.01" id="luas" name="luas" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="status_penggunaan">Status Penggunaan</label>
                                            <select id="status_penggunaan" name="status_penggunaan" class="form-control" required>
                                                <option value="Digunakan">Digunakan</option>
                                                <option value="Tidak Digunakan">Tidak Digunakan</option>
                                                <option value="Renovasi">Renovasi</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="keterangan">Keterangan</label>
                                    <textarea id="keterangan" name="keterangan" class="form-control" rows="2"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="submitBtn">Tambah Data</button>
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
                    document.getElementById("modalTitle").textContent = "Edit Data Ruangan";
                    document.getElementById("submitBtn").textContent = "Update Data";
                    document.getElementById("submitBtn").className = "btn btn-warning";

                    // Fill form with data
                    document.getElementById("ruanganId").value = this.dataset.id;
                    document.getElementById("kode_ruangan").value = this.dataset.kode;
                    document.getElementById("nama_ruangan").value = this.dataset.nama;
                    document.getElementById("lokasi").value = this.dataset.lokasi;
                    document.getElementById("id_gedung").value = this.dataset.id_gedung;
                    document.getElementById("kapasitas").value = this.dataset.kapasitas;
                    document.getElementById("jenis_ruangan").value = this.dataset.jenis;
                    document.getElementById("luas").value = this.dataset.luas;
                    document.getElementById("status_penggunaan").value = this.dataset.status;
                    document.getElementById("keterangan").value = this.dataset.keterangan;
                });
            });

            // Reset modal when closed
            $('#modalRuangan').on('hidden.bs.modal', function() {
                document.getElementById("modalTitle").textContent = "Tambah Data Ruangan";
                document.getElementById("submitBtn").textContent = "Tambah Data";
                document.getElementById("submitBtn").className = "btn btn-primary";
                document.querySelector("form").reset();
                document.getElementById("ruanganId").value = "";
            });
        });
    </script>
</body>

</html>