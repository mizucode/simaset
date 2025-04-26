<!DOCTYPE html>
<html lang="en">
<?php include 'components/head.php' ?>

<body class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
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
                            <div class="card-header bg-navy text-white">
                                <h3 class="card-title">Data Aset Tanah</h3>
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">Large modal</button>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-sm">
                                        <thead class="bg-navy">
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
                                                        <td>
                                                            <a href="/admin/prasarana/tanah?edit=<?= $tanah['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                                                            <a href="/admin/prasarana/tanah?delete=<?= $tanah['id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus data ini?')">Hapus</a>
                                                        </td>
                                                    </tr>
                                            <?php }
                                            } else {
                                                echo "<tr><td colspan='10'>Data tidak ditemukan</td></tr>";
                                            } ?>
                                        </tbody>
                                    </table>

                                    <?php
                                    $isEdit = isset($editData);
                                    ?>

                                    <!-- Form Tambah/Edit -->
                                    <form action="/admin/prasarana/tanah" method="POST">
                                        <?php if ($isEdit): ?>
                                            <input type="hidden" name="id" value="<?= $editData['id'] ?>">
                                        <?php endif; ?>

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
                                    </form>

                                    <!-- Large modal -->


                                    <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                ...
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Small modal -->
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-sm">Small modal</button>

                                    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-sm">
                                            <div class="modal-content">
                                                ...
                                            </div>
                                        </div>
                                    </div>
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
</body>

</html>