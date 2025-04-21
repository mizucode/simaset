<!DOCTYPE html>
<html lang="en">
<?php include 'components/head.php' ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <!-- Navbar -->
        <?php include 'components/navbar.php' ?>
        <!-- Sidebar -->
        <?php include 'components/aside.php' ?>
        <!-- Content -->
        <div class="content-wrapper bg-white py-4 px-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card bg-white">
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                                <h3 class="card-title">Data Aset Tanah</h3>
                                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target=".bd-example-modal-lg">Tambah Data Tanah</button>
                            </div>

                            <div class="card-body">
                                <div class="mb-2 d-flex justify-content-end">
                                    <a href="/admin/prasarana/tanah/export" class="btn btn-success">Export Excel</a>
                                </div>


                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-sm">
                                        <thead class="">
                                            <tr>
                                                <th>Nama Lokasi</th>
                                                <th>Alamat</th>
                                                <th>Luas</th>
                                                <th>Status Kepemilikan</th>
                                                <th>No Sertifikat</th>
                                                <th>Tanggal Perolehan</th>
                                                <th>Penggunaan</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($tanahData)) {
                                                foreach ($tanahData as $tanah) { ?>
                                                    <tr>
                                                        <td><?= htmlspecialchars($tanah['nama_lokasi']) ?></td>
                                                        <td><?= htmlspecialchars($tanah['alamat']) ?></td>
                                                        <td><?= number_format($tanah['luas'], 2) ?> m²</td>
                                                        <td><?= htmlspecialchars($tanah['status_kepemilikan']) ?></td>
                                                        <td><?= htmlspecialchars($tanah['no_sertifikat'] ?? 'data tidak ditemukan') ?></td>
                                                        <td><?= htmlspecialchars($tanah['tanggal_perolehan']) ?></td>
                                                        <td><?= htmlspecialchars($tanah['penggunaan']) ?></td>
                                                        <td><?= htmlspecialchars($tanah['keterangan']) ?></td>
                                                        <td class="d-flex flex-column gap-2">
                                                            <button type="button" class="btn btn-warning btn-edit"
                                                                data-id="<?= $tanah['id'] ?>"
                                                                data-nama="<?= htmlspecialchars($tanah['nama_lokasi'], ENT_QUOTES) ?>"
                                                                data-alamat="<?= htmlspecialchars($tanah['alamat'], ENT_QUOTES) ?>"
                                                                data-luas="<?= $tanah['luas'] ?>"
                                                                data-status="<?= $tanah['status_kepemilikan'] ?>"
                                                                data-sertifikat="<?= htmlspecialchars($tanah['no_sertifikat'], ENT_QUOTES) ?>"
                                                                data-tanggal="<?= $tanah['tanggal_perolehan'] ?>"
                                                                data-penggunaan="<?= htmlspecialchars($tanah['penggunaan'], ENT_QUOTES) ?>"
                                                                data-keterangan="<?= htmlspecialchars($tanah['keterangan'], ENT_QUOTES) ?>"
                                                                data-toggle="modal" data-target=".bd-example-modal-lg">Edit</button>

                                                            <a href="/admin/prasarana/tanah?delete=<?= $tanah['id'] ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                                        </td>


                                                    </tr>
                                            <?php }
                                            } else {
                                                echo "<tr><td colspan='10'>Data tidak ditemukan</td></tr>";
                                            } ?>
                                        </tbody>
                                    </table>



                                    <!-- Large modal -->


                                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <?php
                                                $isEdit = isset($editData);
                                                ?>

                                                <!-- Form Tambah/Edit -->

                                                <div class="card card-primary">
                                                    <div class="card-header">
                                                        <h3 class="card-title">Tambah Data Tanah</h3>
                                                    </div>
                                                    <!-- /.card-header -->
                                                    <!-- form start -->
                                                    <?php if ($isEdit): ?>
                                                        <input type="hidden" name="id" value="<?= $editData['id'] ?>">
                                                    <?php endif; ?>

                                                    <form action="/admin/prasarana/tanah" method="POST">
                                                        <div class="card-body">

                                                            <div class="form-group">
                                                                <label for="nama_lokasi">Nama Lokasi</label>
                                                                <input type="text" id="nama_lokasi" name="nama_lokasi" class="form-control" required
                                                                    value="<?= $isEdit ? htmlspecialchars($editData['nama_lokasi']) : '' ?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="alamat">Alamat</label>
                                                                <textarea id="alamat" name="alamat" class="form-control" required><?= $isEdit ? htmlspecialchars($editData['alamat']) : '' ?></textarea>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="luas">Luas (dalam meter persegi)</label>
                                                                <input type="number" step="0.01" id="luas" name="luas" class="form-control" required
                                                                    value="<?= $isEdit ? $editData['luas'] : '' ?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="status_kepemilikan">Status Kepemilikan</label>
                                                                <select id="status_kepemilikan" name="status_kepemilikan" class="form-control" required>
                                                                    <option value="Milik Kampus" <?= $isEdit && $editData['status_kepemilikan'] == 'Milik Kampus' ? 'selected' : '' ?>>Milik Kampus</option>
                                                                    <option value="Sewa" <?= $isEdit && $editData['status_kepemilikan'] == 'Sewa' ? 'selected' : '' ?>>Sewa</option>
                                                                    <option value="Pinjam Pakai" <?= $isEdit && $editData['status_kepemilikan'] == 'Pinjam Pakai' ? 'selected' : '' ?>>Pinjam Pakai</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="no_sertifikat">Nomor Sertifikat</label>
                                                                <input type="text" id="no_sertifikat" name="no_sertifikat" class="form-control"
                                                                    value="<?= $isEdit ? htmlspecialchars($editData['no_sertifikat']) : '' ?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="tanggal_perolehan">Tanggal Perolehan</label>
                                                                <input type="date" id="tanggal_perolehan" name="tanggal_perolehan" class="form-control"
                                                                    value="<?= $isEdit ? $editData['tanggal_perolehan'] : '' ?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="penggunaan">Penggunaan</label>
                                                                <input type="text" id="penggunaan" name="penggunaan" class="form-control"
                                                                    value="<?= $isEdit ? htmlspecialchars($editData['penggunaan']) : '' ?>">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="keterangan">Keterangan</label>
                                                                <textarea id="keterangan" name="keterangan" class="form-control"><?= $isEdit ? htmlspecialchars($editData['keterangan']) : '' ?></textarea>
                                                            </div>

                                                            <button type="submit" class="btn btn-<?= $isEdit ? 'warning' : 'primary' ?>">
                                                                <?= $isEdit ? 'Update Data' : 'Tambah Data' ?>
                                                            </button>
                                                        </div>

                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    </div>

                                    <!-- Small modal -->

                                </div>
                            </div>
                        </div>
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
    <?php include 'components/script.php' ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".btn-edit");
            editButtons.forEach(btn => {
                btn.addEventListener("click", function() {
                    // Ganti judul dan warna tombol
                    document.querySelector('.card-title').innerText = "Edit Data Tanah";
                    const form = document.querySelector(".modal form");
                    form.action = "/admin/prasarana/tanah";

                    // Ubah button submit
                    const submitBtn = form.querySelector("button[type='submit']");
                    submitBtn.classList.remove("btn-primary");
                    submitBtn.classList.add("btn-warning");
                    submitBtn.innerText = "Update Data";

                    // Set nilai input
                    form.innerHTML += `<input type="hidden" name="id" value="${this.dataset.id}">`;
                    form.nama_lokasi.value = this.dataset.nama;
                    form.alamat.value = this.dataset.alamat;
                    form.luas.value = this.dataset.luas;
                    form.status_kepemilikan.value = this.dataset.status;
                    form.no_sertifikat.value = this.dataset.sertifikat;
                    form.tanggal_perolehan.value = this.dataset.tanggal;
                    form.penggunaan.value = this.dataset.penggunaan;
                    form.keterangan.value = this.dataset.keterangan;
                });
            });

            // Reset modal saat ditutup
            $('.bd-example-modal-lg').on('hidden.bs.modal', function() {
                const form = document.querySelector(".modal form");
                form.reset();
                form.querySelector("input[name='id']")?.remove();
                document.querySelector('.card-title').innerText = "Tambah Data Tanah";
                const submitBtn = form.querySelector("button[type='submit']");
                submitBtn.classList.remove("btn-warning");
                submitBtn.classList.add("btn-primary");
                submitBtn.innerText = "Tambah Data";
            });
        });
    </script>

</body>

</html>