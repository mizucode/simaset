<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <!-- Content Wrapper -->
        <div class="content-wrapper bg-white py-4 mb-5 px-2">
            <div class="container-fluid">
                <?php include './app/Views/Components/helper.php'; ?>

                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- Card Header -->
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center align-content-center">
                                <h3 class="h4">Data Aset Tanah</h3>
                                <div class="btn btn-primary ml-auto">
                                    <a href="/admin/prasarana/tanah/tambah" class="btn">
                                        <h3 class="card-title" id="modalTitle">Tambah Data Tanah</h3>
                                    </a>
                                </div>
                            </div>
                            <!-- /.card-header -->

                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="jsgrid-wrapper">
                                    <table class="jsgrid-table">
                                        <thead>
                                            <tr class="jsgrid-header-row">
                                                <th>No</th>
                                                <th>Kode Aset</th>
                                                <th>Nama Tanah</th>
                                                <th>Luas (m²)</th>
                                                <th>Status Kepemilikan</th>
                                                <th>No Sertifikat</th>
                                                <th>Tanggal Sertifikat</th>
                                                <th>Tanggal Perolehan</th>
                                                <th>Nilai Perolehan</th>
                                                <th>Sumber Dana</th>
                                                <th>Status Sertifikat</th>
                                                <th>Kondisi</th>
                                                <th>Akses</th>
                                                <th>Unit</th>
                                                <th>Penanggung Jawab</th>
                                                <th>Status</th>
                                                <th>Aksi</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $counter = 1; ?>
                                            <?php foreach ($tanahData as $index => $tanah): ?>
                                                <tr class="jsgrid-row">
                                                    <td><?= $counter++; ?></td>
                                                    <td><?= htmlspecialchars($tanah['kode_aset']); ?></td>
                                                    <td><?= htmlspecialchars($tanah['nama_tanah']); ?></td>
                                                    <td><?= number_format($tanah['luas'], 2); ?></td>
                                                    <td><?= htmlspecialchars($tanah['kepemilikan']); ?></td>
                                                    <td><?= $tanah['no_sertifikat'] ?? '-'; ?></td>
                                                    <td><?= date('d-m-Y', strtotime($tanah['tgl_sertifikat'])); ?></td>
                                                    <td><?= date('d-m-Y', strtotime($tanah['tgl_perolehan'])); ?></td>
                                                    <td><?= number_format($tanah['nilai_perolehan'], 2); ?></td>
                                                    <td><?= htmlspecialchars($tanah['sumber_dana']); ?></td>
                                                    <td><?= htmlspecialchars($tanah['status_sertifikat']); ?></td>
                                                    <td><?= htmlspecialchars($tanah['kondisi']); ?></td>
                                                    <td><?= htmlspecialchars($tanah['akses']); ?></td>
                                                    <td><?= htmlspecialchars($tanah['unit']); ?></td>
                                                    <td><?= htmlspecialchars($tanah['penanggung_jawab']); ?></td>
                                                    <td><?= htmlspecialchars($tanah['status']); ?></td>
                                                    <td class="align-middle">
                                                        <div class="d-flex flex-column gap-2">
                                                            <button class="btn btn-warning btn-edit mr-2"
                                                                style="width: 90px;"
                                                                data-id="<?= $tanah['id']; ?>"
                                                                data-nama="<?= htmlspecialchars($tanah['nama_tanah'], ENT_QUOTES); ?>"
                                                                data-alamat="<?= htmlspecialchars($tanah['alamat'], ENT_QUOTES); ?>"
                                                                data-luas="<?= $tanah['luas']; ?>"
                                                                data-kepemilikan="<?= htmlspecialchars($tanah['kepemilikan'], ENT_QUOTES); ?>"
                                                                data-no_sertifikat="<?= htmlspecialchars($tanah['no_sertifikat'], ENT_QUOTES); ?>"
                                                                data-tgl_sertifikat="<?= htmlspecialchars($tanah['tgl_sertifikat'], ENT_QUOTES); ?>"
                                                                data-tgl_perolehan="<?= htmlspecialchars($tanah['tgl_perolehan'], ENT_QUOTES); ?>"
                                                                data-nilai_perolehan="<?= htmlspecialchars($tanah['nilai_perolehan'], ENT_QUOTES); ?>"
                                                                data-sumber_dana="<?= htmlspecialchars($tanah['sumber_dana'], ENT_QUOTES); ?>"
                                                                data-status_sertifikat="<?= htmlspecialchars($tanah['status_sertifikat'], ENT_QUOTES); ?>"
                                                                data-kondisi="<?= htmlspecialchars($tanah['kondisi'], ENT_QUOTES); ?>"
                                                                data-akses="<?= htmlspecialchars($tanah['akses'], ENT_QUOTES); ?>"
                                                                data-unit="<?= htmlspecialchars($tanah['unit'], ENT_QUOTES); ?>"
                                                                data-penanggung_jawab="<?= htmlspecialchars($tanah['penanggung_jawab'], ENT_QUOTES); ?>"
                                                                data-status="<?= htmlspecialchars($tanah['status'], ENT_QUOTES); ?>"
                                                                data-toggle="modal" data-target="#modalTanah">
                                                                <i class="fas fa-edit mr-1"></i>
                                                                Edit
                                                            </button>

                                                            <a href="?delete=<?= $tanah['id']; ?>"
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
        <div class="modal fade" id="modalTanah" tabindex="-1" role="dialog" aria-labelledby="modalTanahLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card card-primary">
                        <div class="card-header">
                            <a href="/admin/prasarana/tanah/tambah">
                                <h3 class="card-title" id="modalTitle">Tambah Data Tanah</h3>
                            </a>

                        </div>
                        <form action="/admin/prasarana/tanah" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="id" id="tanahId">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="nama_lokasi">Nama Lokasi</label>
                                            <input type="text" id="nama_lokasi" name="nama_lokasi" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea id="alamat" name="alamat" class="form-control" rows="2" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="luas">Luas (m²)</label>
                                            <input type="number" step="0.01" id="luas" name="luas" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="status_kepemilikan">Status Kepemilikan</label>
                                            <select id="status_kepemilikan" name="status_kepemilikan" class="form-control" required>
                                                <option value="Milik Kampus">Milik Kampus</option>
                                                <option value="Sewa">Sewa</option>
                                                <option value="Pinjam Pakai">Pinjam Pakai</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="no_sertifikat">No Sertifikat</label>
                                            <input type="text" id="no_sertifikat" name="no_sertifikat" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="tanggal_perolehan">Tanggal Perolehan</label>
                                            <input type="date" id="tanggal_perolehan" name="tanggal_perolehan" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="penggunaan">Penggunaan</label>
                                            <input type="text" id="penggunaan" name="penggunaan" class="form-control">
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

        <?php include './app/Views/Components/foooter.php'; ?>
    </div>

    <!-- Script -->
    <?php include './app/Views/Components/script.php'; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".btn-edit");

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    // Set modal title and button
                    document.getElementById("modalTitle").textContent = "Edit Data Tanah";
                    document.getElementById("submitBtn").textContent = "Update Data";
                    document.getElementById("submitBtn").className = "btn btn-warning";

                    // Fill form with data
                    document.getElementById("tanahId").value = this.dataset.id;
                    document.getElementById("nama_lokasi").value = this.dataset.nama;
                    document.getElementById("alamat").value = this.dataset.alamat;
                    document.getElementById("luas").value = this.dataset.luas;
                    document.getElementById("status_kepemilikan").value = this.dataset.status_kepemilikan;
                    document.getElementById("no_sertifikat").value = this.dataset.no_sertifikat;
                    document.getElementById("tanggal_perolehan").value = this.dataset.tanggal_perolehan;
                    document.getElementById("penggunaan").value = this.dataset.penggunaan;
                    document.getElementById("keterangan").value = this.dataset.keterangan;
                });
            });

            // Reset modal when closed
            $('#modalTanah').on('hidden.bs.modal', function() {
                document.getElementById("modalTitle").textContent = "Tambah Data Tanah";
                document.getElementById("submitBtn").textContent = "Tambah Data";
                document.getElementById("submitBtn").className = "btn btn-primary";
                document.querySelector("form").reset();
                document.getElementById("tanahId").value = "";
            });
        });
    </script>
</body>

</html>