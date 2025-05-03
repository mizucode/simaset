<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white py-4 mb-5 px-2">
            <div class="container-fluid">
                <?php include './app/Views/Components/helper.php'; ?>
                <div class="row">
                    <div class="col-12">



                        <div class="card">
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center align-content-center">
                                <h3 class="h4">Data Aset Tanah</h3>
                                <a href="/admin/penempatan/daftar-barang/tambah" class="btn btn-warning text-dark ml-auto">
                                    <div class="text-dark d-flex flex-row align-items-center gap-2">
                                        <i class="fas fa-plus mr-1"></i>
                                        Tambah Data
                                    </div>
                                </a>
                            </div>

                            <div class="card-body">
                                <div class="jsgrid-wrapper">
                                    <table class="jsgrid-table">
                                        <thead>
                                            <tr class="jsgrid-header-row">
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Lokasi Saat Ini</th>
                                                <th>Tanggal Masuk</th>
                                                <th>Tanggal Keluar</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($penempatanBarang)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($penempatanBarang as $pb) : ?>
                                                    <tr class="jsgrid-row">
                                                        <td><?= $counter++; ?></td>
                                                        <td><?= htmlspecialchars($pb['nama_barang'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($pb['lokasi'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($pb['status'] ?? '-'); ?></td>
                                                        <td><?= date($pb['tanggal_masuk'] ?? '-'); ?></td>
                                                        <td><?= date($pb['tanggal_keluar'] ?? '-'); ?></td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-2">

                                                                <a href="/admin/barang/daftar-barang?delete=<?= $barang['id']; ?>" class="btn btn-danger" onclick="return confirm('Yakin ingin menghapus data ini?')">
                                                                    <i class="fas fa-trash mr-1"></i> Hapus
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
                        </div> <!-- card -->
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Form -->
        <!-- Modal Form -->
        <div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="modalBarangLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card card-primary mb-0">
                        <div class="card-header">
                            <h3 class="card-title" id="modalTitle">Form Data Tanah</h3>
                        </div>
                        <form action="/admin/prasarana/tanah" method="POST">
                            <input type="hidden" name="id" id="id">
                            <input type="hidden" name="lokasi_id" id="lokasi_id" value="1">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Kode Tanah</label>
                                            <input type="text" name="kode_tanah" id="kode_tanah" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Tanah</label>
                                            <input type="text" name="nama_tanah" id="nama_tanah" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Luas</label>
                                            <input type="text" name="luas" id="luas" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Status Tanah</label>
                                            <input type="text" name="status_tanah" id="status_tanah" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nomor Sertifikat</label>
                                            <input type="text" name="sertifikat_nomor" id="sertifikat_nomor" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Tanggal Sertifikat</label>
                                            <input type="date" name="sertifikat_tanggal" id="sertifikat_tanggal" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Tanggal Pajak</label>
                                            <input type="date" name="pajak_tanggal" id="pajak_tanggal" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Penggunaan</label>
                                            <input type="text" name="penggunaan" id="penggunaan" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Sumber Dana</label>
                                            <input type="text" name="sumber_dana" id="sumber_dana" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Alamat</label>
                                            <input type="text" name="alamat" id="alamat" class="form-control">
                                        </div>
                                        <div class="form-group">
                                            <label>Keterangan</label>
                                            <textarea name="keterangan" id="keterangan" class="form-control"></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
                            </div>
                        </form>

                    </div> <!-- /.card -->
                </div>
            </div>
        </div>


        <footer class="main-footer bg-white text-black">
            <strong>&copy; 2025 <a href="#">Lpptsi</a>. Umkuningan.</strong>
        </footer>
    </div>

    <?php include './app/Views/Components/script.php'; ?>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const editButtons = document.querySelectorAll(".btn-edit");

            editButtons.forEach(button => {
                button.addEventListener("click", function() {
                    document.getElementById("modalTitle").textContent = "Edit Data Tanah";
                    document.getElementById("submitBtn").textContent = "Update Data";
                    document.getElementById("submitBtn").className = "btn btn-warning";
                    document.getElementById("id").value = this.dataset.id;
                    document.getElementById("kode_tanah").value = this.dataset.kode;
                    document.getElementById("nama_tanah").value = this.dataset.nama;
                    document.getElementById("lokasi_id").value = this.dataset.lokasi;
                    document.getElementById("luas").value = this.dataset.luas;
                    document.getElementById("status_tanah").value = this.dataset.status;
                    document.getElementById("sertifikat_nomor").value = this.dataset.sertifikat_nomor;
                    document.getElementById("sertifikat_tanggal").value = this.dataset.sertifikat_tanggal;
                    document.getElementById("pajak_tanggal").value = this.dataset.pajak_tanggal;
                    document.getElementById("penggunaan").value = this.dataset.penggunaan;
                    document.getElementById("sumber_dana").value = this.dataset.sumber_dana;
                    document.getElementById("alamat").value = this.dataset.alamat;
                    document.getElementById("keterangan").value = this.dataset.keterangan;
                });
            });

            $('#modalBarang').on('hidden.bs.modal', function() {
                document.getElementById("modalTitle").textContent = "Form Data Barang";
                document.getElementById("submitBtn").textContent = "Simpan";
                document.getElementById("submitBtn").className = "btn btn-primary";
                document.querySelector("form").reset();
                document.getElementById("id").value = "";
            });
        });
    </script>
</body>

</html>