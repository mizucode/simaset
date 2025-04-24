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
                                <h3 class="h4">Data Alat Tulis Kantor (ATK)</h3>
                                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#modalATK">Tambah Data ATK</button>
                            </div>
                            <!-- /.card-header -->

                            <!-- Card Body -->
                            <div class="card-body">
                                <div class="jsgrid-wrapper">
                                    <table class="jsgrid-table">
                                        <thead>
                                            <tr class="jsgrid-header-row">
                                                <th>No</th>
                                                <th>Kode ATK</th>
                                                <th>Nama ATK</th>
                                                <th>Merk</th>
                                                <th>Jumlah</th>
                                                <th>Satuan</th>
                                                <th>Kondisi</th>
                                                <th>Lokasi</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($atkData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($atkData as $atk) : ?>
                                                    <tr class="jsgrid-row">
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= htmlspecialchars($atk['kode_atk']); ?></td>
                                                        <td><?= htmlspecialchars($atk['nama_atk']); ?></td>
                                                        <td><?= htmlspecialchars($atk['merk'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($atk['jumlah']); ?></td>
                                                        <td><?= htmlspecialchars($atk['satuan']); ?></td>
                                                        <td>
                                                            <span class="badge badge-<?=
                                                                                        $atk['kondisi'] == 'Baik' ? 'success' : ($atk['kondisi'] == 'Rusak Ringan' ? 'warning' : 'danger')
                                                                                        ?>">
                                                                <?= htmlspecialchars($atk['kondisi']); ?>
                                                            </span>
                                                        </td>
                                                        <td><?= htmlspecialchars($atk['lokasi']); ?></td>
                                                        <td><?= htmlspecialchars($atk['tanggal_masuk']); ?></td>
                                                        <td class="align-middle">
                                                            <div class="d-flex flex-column gap-2">
                                                                <button class="btn btn-warning btn-edit" data-toggle="modal" data-target="#modalATK"
                                                                    data-id="<?= $atk['id_atk']; ?>"
                                                                    data-kode="<?= $atk['kode_atk']; ?>"
                                                                    data-nama="<?= $atk['nama_atk']; ?>"
                                                                    data-merk="<?= $atk['merk']; ?>"
                                                                    data-jumlah="<?= $atk['jumlah']; ?>"
                                                                    data-satuan="<?= $atk['satuan']; ?>"
                                                                    data-kondisi="<?= $atk['kondisi']; ?>"
                                                                    data-lokasi="<?= $atk['lokasi']; ?>"
                                                                    data-tanggal="<?= $atk['tanggal_masuk']; ?>">
                                                                    <i class="fas fa-edit mr-1"></i>
                                                                    Edit
                                                                </button>
                                                                <a href="/admin/sarana/alat-tulis-kantor?delete=<?= $atk['id_atk']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
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
        <div class="modal fade" id="modalATK" tabindex="-1" role="dialog" aria-labelledby="modalATKLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" id="modalTitle">Form Data ATK</h3>
                        </div>
                        <form action="/admin/sarana/alat-tulis-kantor" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="id_atk" id="id_atk">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode ATK</label>
                                            <input type="text" name="kode_atk" id="kode_atk" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama ATK</label>
                                            <input type="text" name="nama_atk" id="nama_atk" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Merk</label>
                                            <input type="text" name="merk" id="merk" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Jumlah</label>
                                            <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Satuan</label>
                                            <input type="text" name="satuan" id="satuan" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Kondisi</label>
                                            <select name="kondisi" id="kondisi" class="form-control" required>
                                                <option value="Baik">Baik</option>
                                                <option value="Rusak Ringan">Rusak Ringan</option>
                                                <option value="Rusak Berat">Rusak Berat</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Lokasi</label>
                                            <input type="text" name="lokasi" id="lokasi" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Masuk</label>
                                            <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="form-control" required>
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
                    document.getElementById("modalTitle").textContent = "Edit Data ATK";
                    document.getElementById("submitBtn").textContent = "Update Data";
                    document.getElementById("submitBtn").className = "btn btn-warning";

                    // Fill form with data
                    document.getElementById("id_atk").value = this.dataset.id;
                    document.getElementById("kode_atk").value = this.dataset.kode;
                    document.getElementById("nama_atk").value = this.dataset.nama;
                    document.getElementById("merk").value = this.dataset.merk;
                    document.getElementById("jumlah").value = this.dataset.jumlah;
                    document.getElementById("satuan").value = this.dataset.satuan;
                    document.getElementById("kondisi").value = this.dataset.kondisi;
                    document.getElementById("lokasi").value = this.dataset.lokasi;
                    document.getElementById("tanggal_masuk").value = this.dataset.tanggal;
                });
            });

            // Reset modal when closed
            $('#modalATK').on('hidden.bs.modal', function() {
                document.getElementById("modalTitle").textContent = "Form Data ATK";
                document.getElementById("submitBtn").textContent = "Simpan";
                document.getElementById("submitBtn").className = "btn btn-primary";
                document.querySelector("form").reset();
                document.getElementById("id_atk").value = "";
            });
        });
    </script>
</body>

</html>