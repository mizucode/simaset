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
                                <h3 class="h4">Data Aset Lapangan</h3>
                                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#modalLapang">Tambah Data Lapangan</button>
                            </div>
                            <!-- /.card-header -->

                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="jsgrid-wrapper">
                                    <table class="jsgrid-table">
                                        <thead>
                                            <tr class="jsgrid-header-row">
                                                <th>No</th>
                                                <th>Kode</th>
                                                <th>Nama Lapangan</th>
                                                <th>Lokasi</th>
                                                <th>Jenis</th>
                                                <th>Luas (m²)</th>
                                                <th>Tahun Dibangun</th>
                                                <th>Kondisi</th>
                                                <th>Status Kepemilikan</th>
                                                <th>Dokumen Legalitas</th>
                                                <th>Pengguna</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($lapangData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($lapangData as $lapang) : ?>
                                                    <tr class="jsgrid-row">
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= htmlspecialchars($lapang['kode_lapangan']); ?></td>
                                                        <td><?= htmlspecialchars($lapang['nama_lapangan']); ?></td>
                                                        <td><?= htmlspecialchars($lapang['lokasi']); ?></td>
                                                        <td><?= htmlspecialchars($lapang['jenis_lapangan']); ?></td>
                                                        <td><?= $lapang['luas']; ?></td>
                                                        <td><?= $lapang['tahun_dibangun']; ?></td>
                                                        <td>
                                                            <span class="badge badge-<?=
                                                                                        $lapang['kondisi'] == 'Baik' ? 'success' : ($lapang['kondisi'] == 'Rusak Ringan' ? 'warning' : 'danger')
                                                                                        ?>">
                                                                <?= htmlspecialchars($lapang['kondisi']); ?>
                                                            </span>
                                                        </td>
                                                        <td><?= htmlspecialchars($lapang['status_kepemilikan']); ?></td>
                                                        <td><?= htmlspecialchars($lapang['dokumen_legalitas']); ?></td>
                                                        <td><?= htmlspecialchars($lapang['pengguna']); ?></td>
                                                        <td><?= htmlspecialchars($lapang['keterangan']); ?></td>
                                                        <td class="align-middle">
                                                            <div class="d-flex flex-column gap-2">
                                                                <button class="btn btn-warning btn-edit mr-2"
                                                                    style="width: 90px;"
                                                                    data-id="<?= $lapang['id_lapangan']; ?>"
                                                                    data-kode="<?= htmlspecialchars($lapang['kode_lapangan'], ENT_QUOTES); ?>"
                                                                    data-nama="<?= htmlspecialchars($lapang['nama_lapangan'], ENT_QUOTES); ?>"
                                                                    data-lokasi="<?= htmlspecialchars($lapang['lokasi'], ENT_QUOTES); ?>"
                                                                    data-jenis="<?= htmlspecialchars($lapang['jenis_lapangan'], ENT_QUOTES); ?>"
                                                                    data-luas="<?= $lapang['luas']; ?>"
                                                                    data-tahun="<?= $lapang['tahun_dibangun']; ?>"
                                                                    data-kondisi="<?= htmlspecialchars($lapang['kondisi'], ENT_QUOTES); ?>"
                                                                    data-kepemilikan="<?= htmlspecialchars($lapang['status_kepemilikan'], ENT_QUOTES); ?>"
                                                                    data-dokumen="<?= htmlspecialchars($lapang['dokumen_legalitas'], ENT_QUOTES); ?>"
                                                                    data-pengguna="<?= htmlspecialchars($lapang['pengguna'], ENT_QUOTES); ?>"
                                                                    data-keterangan="<?= htmlspecialchars($lapang['keterangan'], ENT_QUOTES); ?>"
                                                                    data-toggle="modal" data-target="#modalLapang">
                                                                    <i class="fas fa-edit mr-1"></i>
                                                                    Edit
                                                                </button>

                                                                <a href="/admin/prasarana/lapang?delete=<?= $lapang['id_lapangan']; ?>"
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
                                                    <td colspan="13" class="text-center">Data tidak ditemukan</td>
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
        <div class="modal fade" id="modalLapang" tabindex="-1" role="dialog" aria-labelledby="modalLapangLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" id="modalTitle">Tambah Data Lapangan</h3>
                        </div>
                        <form action="/admin/prasarana/lapang" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="id_lapangan" id="lapangId">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_lapangan">Kode Lapangan</label>
                                            <input type="text" id="kode_lapangan" name="kode_lapangan" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_lapangan">Nama Lapangan</label>
                                            <input type="text" id="nama_lapangan" name="nama_lapangan" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi">Lokasi</label>
                                            <input type="text" id="lokasi" name="lokasi" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jenis_lapangan">Jenis Lapangan</label>
                                            <select id="jenis_lapangan" name="jenis_lapangan" class="form-control" required>
                                                <?php foreach ($jenisLapanganOptions as $jenis) : ?>
                                                    <option value="<?= $jenis ?>"><?= $jenis ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="luas">Luas (m²)</label>
                                            <input type="number" step="0.01" id="luas" name="luas" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tahun_dibangun">Tahun Dibangun</label>
                                            <input type="number" id="tahun_dibangun" name="tahun_dibangun" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="kondisi">Kondisi</label>
                                            <select id="kondisi" name="kondisi" class="form-control" required>
                                                <?php foreach ($kondisiOptions as $kondisi) : ?>
                                                    <option value="<?= $kondisi ?>"><?= $kondisi ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status_kepemilikan">Status Kepemilikan</label>
                                            <select id="status_kepemilikan" name="status_kepemilikan" class="form-control" required>
                                                <?php foreach ($statusKepemilikanOptions as $status) : ?>
                                                    <option value="<?= $status ?>"><?= $status ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="dokumen_legalitas">Dokumen Legalitas</label>
                                            <input type="text" id="dokumen_legalitas" name="dokumen_legalitas" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="pengguna">Pengguna</label>
                                            <input type="text" id="pengguna" name="pengguna" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan</label>
                                            <textarea id="keterangan" name="keterangan" class="form-control" rows="2"></textarea>
                                        </div>
                                    </div>
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
                    document.getElementById("modalTitle").textContent = "Edit Data Lapangan";
                    document.getElementById("submitBtn").textContent = "Update Data";
                    document.getElementById("submitBtn").className = "btn btn-warning";

                    // Fill form with data
                    document.getElementById("lapangId").value = this.dataset.id;
                    document.getElementById("kode_lapangan").value = this.dataset.kode;
                    document.getElementById("nama_lapangan").value = this.dataset.nama;
                    document.getElementById("lokasi").value = this.dataset.lokasi;
                    document.getElementById("jenis_lapangan").value = this.dataset.jenis;
                    document.getElementById("luas").value = this.dataset.luas;
                    document.getElementById("tahun_dibangun").value = this.dataset.tahun;
                    document.getElementById("kondisi").value = this.dataset.kondisi;
                    document.getElementById("status_kepemilikan").value = this.dataset.kepemilikan;
                    document.getElementById("dokumen_legalitas").value = this.dataset.dokumen;
                    document.getElementById("pengguna").value = this.dataset.pengguna;
                    document.getElementById("keterangan").value = this.dataset.keterangan;
                });
            });

            // Reset modal when closed
            $('#modalLapang').on('hidden.bs.modal', function() {
                document.getElementById("modalTitle").textContent = "Tambah Data Lapangan";
                document.getElementById("submitBtn").textContent = "Tambah Data";
                document.getElementById("submitBtn").className = "btn btn-primary";
                document.querySelector("form").reset();
                document.getElementById("lapangId").value = "";
            });
        });
    </script>
</body>

</html>