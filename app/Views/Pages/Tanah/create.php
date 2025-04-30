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

                            <form action="/admin/prasaran/tanah" method="POST">
                                <input type="hidden" name="id" id="id">
                                <input type="hidden" name="lokasi_id" value="1" id="lokasi_id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Kode Aset</label>
                                                <input type="text" name="kode_aset" id="kode_aset" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Nama Tanah</label>
                                                <input type="text" name="nama_tanah" id="nama_tanah" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Jenis</label>
                                                <select name="jenis" id="jenis" class="form-control" required>
                                                    <option value="">Pilih Jenis Bangunan</option>
                                                    <option value="Bangunan">Bangunan</option>
                                                    <option value="Kosong">Lahan Kosong</option>
                                                    <option value="Pertanian">Pertanian</option>
                                                    <option value="Parkir">Parkir</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label>Kepemilikan</label>
                                                <select name="kepemilikan" id="kepemimilkan" class="form-control" required>
                                                    <option value="">Pilih Jenis Kepemilikan</option>
                                                    <option value="SHM">SHM</option>
                                                    <option value="HGB">HGB</option>
                                                    <option value="Hak Pakai">Hak Pakai</option>
                                                    <option value="Sewa">Sewa</option>
                                                    <option value="Hibah">Hibah</option>
                                                    <option value="Wakaf">Wakaf</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="tgl_sertifikat">Tanggal Sertifikat</label>
                                                <input type="date" name="tgl_sertifikat" id="tgl_sertifikat" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label for="luas">Luas (m²)</label>
                                                <input type="number" name="luas" id="luas" class="form-control" step="0.01" placeholder="Masukkan luas dalam meter persegi">
                                            </div>
                                            <div class="form-group">
                                                <label>Alamat</label>
                                                <textarea name="alamt" id="alamat" class="form-control" required></textarea>

                                            </div>
                                            <div class="form-group">
                                                <label>Koordinat</label>
                                                <input type="text" name="koordinat" id="koordinat" class="form-control" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Letak Kampus</label>
                                                <input type="text" name="kampus" id="kampus" class="form-control" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Fungsi</label>
                                                <input type="text" name="fungsi" id="kampus" class="form-control" required>
                                            </div>

                                            <div class="form-group">
                                                <label for="nilai_perolehan">Nilai Perolehan</label>
                                                <input type="number" name="nilai_perolahan" id="nilai_perolehan" class="form-control" step="0.01" placeholder="Masukkan Nilai Rupiah">
                                            </div>

                                            <div class="form-group">
                                                <label for="tgl_perolehan">Tanggal Perolehan</label>
                                                <input type="date" name="tgl_sertifikat" id="tgl_sertifikat" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Sumber Dana</label>
                                                <select name="sumber_dana" id="sumber_dana" class="form-control" required>
                                                    <option value="">Pilih Jenis Kepemilikan</option>
                                                    <option value="APBN">APBN</option>
                                                    <option value="APBD">APBD</option>
                                                    <option value="Hibah">Hibah</option>
                                                    <option value="Swadaya">Swadaya</option>
                                                    <option value="Lainnya">Lainnya</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label for="nilai_pasar">Nilai Pasar</label>
                                                <input type="number" name="nilai_pasar" id="nilai_pasar" class="form-control" step="0.01" placeholder="Masukkan Nilai Rupiah">
                                            </div>


                                            <div class="form-group">
                                                <label for="tgl_nilai">Tanggal Nilai</label>
                                                <input type="date" name="tgl_nilai" id="tgl_nilai" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Pemilik Sertifikat</label>
                                                <input type="text" name="pemilik_sertifikat" id="pemilik_sertifikat" class="form-control" required>
                                            </div>

                                            <div class="form-group">
                                                <label>Status Sertifikat</label>
                                                <select name="status_sertifikat" id="status_sertifikat" class="form-control" required>
                                                    <option value="">Pilih Status Sertifikat</option>
                                                    <option value="Asli">APBN</option>
                                                    <option value="Pihak Lain">APBD</option>
                                                    <option value="Proses">Hibah</option>
                                                </select>
                                            </div>
                                            <!-- Chechkpoint -->
                                            <div class="form-group">
                                                <label>Status Sertifikat</label>
                                                <select name="status_sertifikat" id="status_sertifikat" class="form-control" required>
                                                    <option value="">Pilih Status Sertifikat</option>
                                                    <option value="Asli">APBN</option>
                                                    <option value="Pihak Lain">APBD</option>
                                                    <option value="Proses">Hibah</option>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label></label>
                                                <input type="text" name="" id="" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label></label>
                                                <input type="text" name="" id="" class="form-control" required>
                                            </div>

                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Jumlah</label>
                                                <input type="number" name="jumlah" id="jumlah" class="form-control" required>
                                            </div>
                                            <div class="form-group">
                                                <label>Kondisi</label>
                                                <select name="kondisi_id" id="kondisi_id" class="form-control" required>
                                                    <option value="">Pilih Kondisi</option>
                                                    <?php foreach ($kondisiBarang as $kondisi) : ?>
                                                        <option value="<?= $kondisi['id']; ?>"><?= htmlspecialchars($kondisi['nama_kondisi']); ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- /.card-body -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
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