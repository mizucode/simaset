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
                                <h3 class="h4">Data Barang Bergerak</h3>
                                <button type="button" class="btn btn-primary ml-auto" data-toggle="modal" data-target="#modalBarang">Tambah Data Barang</button>
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
                                                <th>Nama Barang</th>
                                                <th>Merk/Tipe</th>
                                                <th>Tipe Kendaraan</th>
                                                <th>Plat Nomor</th>
                                                <th>Tahun</th>
                                                <th>Kondisi</th>
                                                <th>Jumlah</th>
                                                <th>Satuan</th>
                                                <th>Lokasi</th>
                                                <th>Sumber</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($barangData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($barangData as $barang) : ?>
                                                    <tr class="jsgrid-row">
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= htmlspecialchars($barang['kode_bb']); ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_bb']); ?></td>
                                                        <td><?= htmlspecialchars($barang['merk_tipe']); ?></td>
                                                        <td><?= htmlspecialchars($barang['tipe_kendaraan'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['plat_nomor'] ?? '-'); ?></td>
                                                        <td><?= $barang['tahun_perolehan']; ?></td>
                                                        <td>
                                                            <span class="badge badge-<?=
                                                                                        $barang['kondisi'] == 'Baik' ? 'success' : ($barang['kondisi'] == 'Rusak Ringan' ? 'warning' : 'danger')
                                                                                        ?>">
                                                                <?= htmlspecialchars($barang['kondisi']); ?>
                                                            </span>
                                                        </td>
                                                        <td><?= $barang['jumlah']; ?></td>
                                                        <td><?= htmlspecialchars($barang['satuan']); ?></td>
                                                        <td><?= htmlspecialchars($barang['lokasi']); ?></td>
                                                        <td><?= htmlspecialchars($barang['sumber_perolehan']); ?></td>
                                                        <td class="align-middle">
                                                            <div class="d-flex flex-column gap-2">
                                                                <button class="btn btn-warning btn-edit mr-2"
                                                                    style="width: 90px;"
                                                                    data-id="<?= $barang['id_bb']; ?>"
                                                                    data-kode="<?= htmlspecialchars($barang['kode_bb'], ENT_QUOTES); ?>"
                                                                    data-nama="<?= htmlspecialchars($barang['nama_bb'], ENT_QUOTES); ?>"
                                                                    data-merktipe="<?= htmlspecialchars($barang['merk_tipe'], ENT_QUOTES); ?>"
                                                                    data-tipekendaraan="<?= htmlspecialchars($barang['tipe_kendaraan'], ENT_QUOTES); ?>"
                                                                    data-platnomor="<?= htmlspecialchars($barang['plat_nomor'], ENT_QUOTES); ?>"
                                                                    data-tahun="<?= $barang['tahun_perolehan']; ?>"
                                                                    data-kondisi="<?= htmlspecialchars($barang['kondisi'], ENT_QUOTES); ?>"
                                                                    data-jumlah="<?= $barang['jumlah']; ?>"
                                                                    data-satuan="<?= htmlspecialchars($barang['satuan'], ENT_QUOTES); ?>"
                                                                    data-lokasi="<?= htmlspecialchars($barang['lokasi'], ENT_QUOTES); ?>"
                                                                    data-sumber="<?= htmlspecialchars($barang['sumber_perolehan'], ENT_QUOTES); ?>"
                                                                    data-toggle="modal" data-target="#modalBarang">
                                                                    <i class="fas fa-edit mr-1"></i>
                                                                    Edit
                                                                </button>

                                                                <a href="/admin/sarana/bergerak?delete=<?= $barang['id_bb']; ?>"
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
        <div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="modalBarangLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title" id="modalTitle">Tambah Data Barang</h3>
                        </div>
                        <form action="/admin/sarana/bergerak" method="POST">
                            <div class="card-body">
                                <input type="hidden" name="id_bb" id="barangId">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="kode_bb">Kode Barang</label>
                                            <input type="text" id="kode_bb" name="kode_bb" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="nama_bb">Nama Barang</label>
                                            <input type="text" id="nama_bb" name="nama_bb" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="merk_tipe">Merk/Tipe</label>
                                            <input type="text" id="merk_tipe" name="merk_tipe" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="tipe_kendaraan">Tipe Kendaraan</label>
                                            <input type="text" id="tipe_kendaraan" name="tipe_kendaraan" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="plat_nomor">Plat Nomor</label>
                                            <input type="text" id="plat_nomor" name="plat_nomor" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label for="tahun_perolehan">Tahun Perolehan</label>
                                            <input type="number" id="tahun_perolehan" name="tahun_perolehan" class="form-control" required>
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
                                            <label for="jumlah">Jumlah</label>
                                            <input type="number" id="jumlah" name="jumlah" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="satuan">Satuan</label>
                                            <input type="text" id="satuan" name="satuan" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="lokasi">Lokasi</label>
                                    <input type="text" id="lokasi" name="lokasi" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label for="sumber_perolehan">Sumber Perolehan</label>
                                    <input type="text" id="sumber_perolehan" name="sumber_perolehan" class="form-control" required>
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
                    document.getElementById("modalTitle").textContent = "Edit Data Barang";
                    document.getElementById("submitBtn").textContent = "Update Data";
                    document.getElementById("submitBtn").className = "btn btn-warning";

                    // Fill form with data
                    document.getElementById("barangId").value = this.dataset.id;
                    document.getElementById("kode_bb").value = this.dataset.kode;
                    document.getElementById("nama_bb").value = this.dataset.nama;
                    document.getElementById("merk_tipe").value = this.dataset.merktipe;
                    document.getElementById("tipe_kendaraan").value = this.dataset.tipekendaraan;
                    document.getElementById("plat_nomor").value = this.dataset.platnomor;
                    document.getElementById("tahun_perolehan").value = this.dataset.tahun;
                    document.getElementById("kondisi").value = this.dataset.kondisi;
                    document.getElementById("jumlah").value = this.dataset.jumlah;
                    document.getElementById("satuan").value = this.dataset.satuan;
                    document.getElementById("lokasi").value = this.dataset.lokasi;
                    document.getElementById("sumber_perolehan").value = this.dataset.sumber;
                });
            });

            // Reset modal when closed
            $('#modalBarang').on('hidden.bs.modal', function() {
                document.getElementById("modalTitle").textContent = "Tambah Data Barang";
                document.getElementById("submitBtn").textContent = "Tambah Data";
                document.getElementById("submitBtn").className = "btn btn-primary";
                document.querySelector("form").reset();
                document.getElementById("barangId").value = "";
            });
        });
    </script>
</body>
</html>