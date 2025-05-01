<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white py-4 mb-5 px-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
                        <?php endif; ?>
                        <div class="card card-outline card-info">
                            <div class="card-header">
                                <h3 class="card-title">Tambah Data Barang</h3>
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
                                    <a href="/admin/prasarana/tanah" class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Form -->


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
                    document.getElementById("modalTitle").textContent = "Edit Data Barang";
                    document.getElementById("submitBtn").textContent = "Update Data";
                    document.getElementById("submitBtn").className = "btn btn-warning";
                    document.getElementById("id").value = this.dataset.id;
                    document.getElementById("kode_barang").value = this.dataset.kode;
                    document.getElementById("nama_barang").value = this.dataset.nama;
                    document.getElementById("kategori_id").value = this.dataset.kategori;
                    document.getElementById("tahun_perolehan").value = this.dataset.tahun;
                    document.getElementById("kondisi_id").value = this.dataset.kondisi;
                    document.getElementById("jumlah").value = this.dataset.jumlah;
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