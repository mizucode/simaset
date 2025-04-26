<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include './app/Views/Components/navbar.php'; ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include './app/Views/Components/aside.php'; ?>
        <!-- End Sidebar -->

        <!-- Content Wrapper -->
        <div class="content-wrapper bg-white py-4 mb-5 px-2">
            <div class="container-fluid">
                <?php include './app/Views/Components/helper.php'; ?>
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <!-- Card Header -->
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center align-content-center">
                                <h3 class="h4">Data Aset Gedung</h3>
                                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#modalGedung">Tambah Data Gedung</button>
                            </div>
                            <!-- /.card-header -->

                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="jsgrid-wrapper">
                                    <table class="jsgrid-table">
                                        <thead>
                                            <tr class="jsgrid-header-row">
                                                <th>No</th>
                                                <th>Kode Gedung</th>
                                                <th>Nama Gedung</th>
                                                <th>Lokasi</th>
                                                <th>Alamat</th>
                                                <th>Luas Tanah (m²)</th>
                                                <th>Luas Bangunan (m²)</th>
                                                <th>Jumlah Lantai</th>
                                                <th>Tahun Dibangun</th>
                                                <th>Tahun Perolehan</th>
                                                <th>Nilai Perolehan</th>
                                                <th>Status Kepemilikan</th>
                                                <th>Status Penggunaan</th>
                                                <th>Kondisi</th>
                                                <th>Pengguna</th>
                                                <th>Dokumen Legalitas</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($gedungData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($gedungData as $gedung) : ?>
                                                    <tr class="jsgrid-row">
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= htmlspecialchars($gedung['kode_gedung']); ?></td>
                                                        <td><?= htmlspecialchars($gedung['nama_gedung']); ?></td>
                                                        <td><?= htmlspecialchars($gedung['lokasi']); ?></td>
                                                        <td><?= htmlspecialchars($gedung['alamat']); ?></td>
                                                        <td><?= $gedung['luas_tanah']; ?></td>
                                                        <td><?= $gedung['luas_bangunan']; ?></td>
                                                        <td><?= $gedung['jumlah_lantai']; ?></td>
                                                        <td><?= $gedung['tahun_dibangun']; ?></td>
                                                        <td><?= $gedung['tahun_perolehan']; ?></td>
                                                        <td><?= number_format($gedung['nilai_perolehan'], 2, ',', '.'); ?></td>
                                                        <td><?= htmlspecialchars($gedung['status_kepemilikan']); ?></td>
                                                        <td><?= htmlspecialchars($gedung['status_penggunaan']); ?></td>
                                                        <td><?= htmlspecialchars($gedung['kondisi']); ?></td>
                                                        <td><?= htmlspecialchars($gedung['pengguna']); ?></td>
                                                        <td><?= htmlspecialchars($gedung['dokumen_legalitas']); ?></td>
                                                        <td><?= htmlspecialchars($gedung['keterangan']); ?></td>
                                                        <td class="align-middle">
                                                            <div class="d-flex flex-column gap-2">
                                                                <button class="btn btn-warning btn-edit mr-2"
                                                                    style="width: 90px;"
                                                                    data-id="<?= $gedung['id_gedung']; ?>"
                                                                    data-kode="<?= htmlspecialchars($gedung['kode_gedung'], ENT_QUOTES); ?>"
                                                                    data-nama="<?= htmlspecialchars($gedung['nama_gedung'], ENT_QUOTES); ?>"
                                                                    data-lokasi="<?= htmlspecialchars($gedung['lokasi'], ENT_QUOTES); ?>"
                                                                    data-alamat="<?= htmlspecialchars($gedung['alamat'], ENT_QUOTES); ?>"
                                                                    data-luas_tanah="<?= $gedung['luas_tanah']; ?>"
                                                                    data-luas_bangunan="<?= $gedung['luas_bangunan']; ?>"
                                                                    data-jumlah_lantai="<?= $gedung['jumlah_lantai']; ?>"
                                                                    data-tahun_dibangun="<?= $gedung['tahun_dibangun']; ?>"
                                                                    data-tahun_perolehan="<?= $gedung['tahun_perolehan']; ?>"
                                                                    data-nilai_perolehan="<?= $gedung['nilai_perolehan']; ?>"
                                                                    data-status_kepemilikan="<?= htmlspecialchars($gedung['status_kepemilikan'], ENT_QUOTES); ?>"
                                                                    data-status_penggunaan="<?= htmlspecialchars($gedung['status_penggunaan'], ENT_QUOTES); ?>"
                                                                    data-kondisi="<?= htmlspecialchars($gedung['kondisi'], ENT_QUOTES); ?>"
                                                                    data-pengguna="<?= htmlspecialchars($gedung['pengguna'], ENT_QUOTES); ?>"
                                                                    data-dokumen_legalitas="<?= htmlspecialchars($gedung['dokumen_legalitas'], ENT_QUOTES); ?>"
                                                                    data-keterangan="<?= htmlspecialchars($gedung['keterangan'], ENT_QUOTES); ?>"
                                                                    data-toggle="modal" data-target="#modalGedung">
                                                                    <i class="fas fa-edit mr-1"></i>
                                                                    Edit
                                                                </button>

                                                                <a href="/admin/prasarana/gedung?delete=<?= $gedung['id_gedung']; ?>"
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
                                                    <td colspan="18" class="text-center">Data tidak ditemukan</td>
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
        <div class="modal fade" id="modalGedung" tabindex="-1" role="dialog" aria-labelledby="modalGedungLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" id="modalTitle">Tambah Data Gedung</h3>
                        </div>
                        <form action="/admin/prasarana/gedung" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="id" id="gedungId">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_gedung">Kode Gedung</label>
                                            <input type="text" id="kode_gedung" name="kode_gedung" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_gedung">Nama Gedung</label>
                                            <input type="text" id="nama_gedung" name="nama_gedung" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="lokasi">Lokasi</label>
                                            <input type="text" id="lokasi" name="lokasi" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="alamat">Alamat</label>
                                            <textarea id="alamat" name="alamat" class="form-control" rows="2" required></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="luas_tanah">Luas Tanah (m²)</label>
                                            <input type="number" step="0.01" id="luas_tanah" name="luas_tanah" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="luas_bangunan">Luas Bangunan (m²)</label>
                                            <input type="number" step="0.01" id="luas_bangunan" name="luas_bangunan" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="jumlah_lantai">Jumlah Lantai</label>
                                            <input type="number" step="1" id="jumlah_lantai" name="jumlah_lantai" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tahun_dibangun">Tahun Dibangun</label>
                                            <input type="number" id="tahun_dibangun" name="tahun_dibangun" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun_perolehan">Tahun Perolehan</label>
                                            <input type="number" id="tahun_perolehan" name="tahun_perolehan" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="nilai_perolehan">Nilai Perolehan (Rp)</label>
                                            <input type="number" step="0.01" id="nilai_perolehan" name="nilai_perolehan" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="status_kepemilikan">Status Kepemilikan</label>
                                            <select id="status_kepemilikan" name="status_kepemilikan" class="form-control" required>
                                                <option value="Milik Kampus">Milik Kampus</option>
                                                <option value="Sewa">Sewa</option>
                                                <option value="Pinjam Pakai">Pinjam Pakai</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="status_penggunaan">Status Penggunaan</label>
                                            <input type="text" id="status_penggunaan" name="status_penggunaan" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="kondisi">Kondisi</label>
                                            <select id="kondisi" name="kondisi" class="form-control" required>
                                                <option value="Baik">Baik</option>
                                                <option value="Rusak Ringan">Rusak Ringan</option>
                                                <option value="Rusak Berat">Rusak Berat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="pengguna">Pengguna</label>
                                            <input type="text" id="pengguna" name="pengguna" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="dokumen_legalitas">Dokumen Legalitas</label>
                                            <input type="text" id="dokumen_legalitas" name="dokumen_legalitas" class="form-control">
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
    <?php include './app/Views/Components/script.php'; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".btn-edit");

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    // Set modal title and button
                    document.getElementById("modalTitle").textContent = "Edit Data Gedung";
                    document.getElementById("submitBtn").textContent = "Update Data";
                    document.getElementById("submitBtn").className = "btn btn-warning";

                    // Fill form with data
                    document.getElementById("gedungId").value = this.dataset.id;
                    document.getElementById("kode_gedung").value = this.dataset.kode;
                    document.getElementById("nama_gedung").value = this.dataset.nama;
                    document.getElementById("lokasi").value = this.dataset.lokasi;
                    document.getElementById("alamat").value = this.dataset.alamat;
                    document.getElementById("luas_tanah").value = this.dataset.luas_tanah;
                    document.getElementById("luas_bangunan").value = this.dataset.luas_bangunan;
                    document.getElementById("jumlah_lantai").value = this.dataset.jumlah_lantai;
                    document.getElementById("tahun_dibangun").value = this.dataset.tahun_dibangun;
                    document.getElementById("tahun_perolehan").value = this.dataset.tahun_perolehan;
                    document.getElementById("nilai_perolehan").value = this.dataset.nilai_perolehan;
                    document.getElementById("status_kepemilikan").value = this.dataset.status_kepemilikan;
                    document.getElementById("status_penggunaan").value = this.dataset.status_penggunaan;
                    document.getElementById("kondisi").value = this.dataset.kondisi;
                    document.getElementById("pengguna").value = this.dataset.pengguna;
                    document.getElementById("dokumen_legalitas").value = this.dataset.dokumen_legalitas;
                    document.getElementById("keterangan").value = this.dataset.keterangan;
                });
            });

            // Reset modal when closed
            $('#modalGedung').on('hidden.bs.modal', function() {
                document.getElementById("modalTitle").textContent = "Tambah Data Gedung";
                document.getElementById("submitBtn").textContent = "Tambah Data";
                document.getElementById("submitBtn").className = "btn btn-primary";
                document.querySelector("form").reset();
                document.getElementById("gedungId").value = "";
            });
        });
    </script>
</body>

</html>