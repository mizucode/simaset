<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <div class="wrapper">


        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white py-4 mb-5 px-5">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12 ">

                        <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger alert-dismissible fade show mb-4">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <i class="fas fa-exclamation-circle mr-2"></i><?= htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <div class="card card-outline card-navy shadow-sm">

                            <div class="card-header bg-navy text-white">
                                <h3 class="card-title">
                                    <i class="fas fa-clipboard-list mr-2"></i>Formulir Peminjaman Barang
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <form action="/admin/penempatan/daftar-barang/tambah" method="POST">
                                <input type="hidden" name="id" id="id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Identitas Peminjam -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3">
                                                    <i class="fas fa-user-circle text-primary mr-2"></i>
                                                    I. Data Peminjam
                                                </h5>
                                                <!-- Nama Peminjam -->
                                                <div class="form-group mb-4">
                                                    <label for="nama_peminjam" class="font-weight-bold"><i class="fas fa-user-tie mr-1"></i> Nama Peminjam</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-user text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" placeholder="Masukkan nama peminjam" required>
                                                    </div>
                                                </div>
                                                <!-- NIK -->
                                                <div class="form-group mb-4">
                                                    <label for="nik" class="font-weight-bold"><i class="fas fa-id-card mr-1"></i> NIM/NIK/NIP</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-id-badge text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIM/NIK/NIP peminjam" required>
                                                    </div>
                                                </div>
                                                <!-- Jabatan -->
                                                <div class="form-group mb-4">
                                                    <label for="jabatan" class="font-weight-bold"><i class="fas fa-briefcase mr-1"></i> Jabatan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-user-tag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan jabatan peminjam" required>
                                                    </div>
                                                </div>
                                                <!-- No telepon -->
                                                <div class="form-group mb-4">
                                                    <label for="no_telepon" class="font-weight-bold"><i class="fas fa-phone mr-1"></i> No telepon</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-mobile-alt text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="Masukkan No Telepon peminjam" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Identitas Barang Dipinjam -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3">
                                                    <i class="fas fa-boxes text-primary mr-2"></i>
                                                    II. Data Barang
                                                </h5>
                                                <!-- Nama Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="nama_barang" class="font-weight-bold"><i class="fas fa-box mr-1"></i> Nama Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-laptop text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="nama_barang" name="nama_barang" required>
                                                            <option value="" disabled selected>Pilih Nama Barang</option>

                                                            <!-- Group Barang Elektronik -->
                                                            <optgroup label="Barang Bergerak">
                                                                <?php foreach ($barangBergerak as $barang) : ?>
                                                                    <option value="<?= $barang['nama_barang_bergerak']; ?>">
                                                                        <?= $barang['kode_barang_bergerak']; ?> - <?= $barang['nama_barang_bergerak']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                            <optgroup label="Barang ">
                                                                <?php foreach ($barangBergerak as $barang) : ?>
                                                                    <option value="<?= $barang['nama_barang_bergerak']; ?>">
                                                                        <?= $barang['kode_barang_bergerak']; ?> - <?= $barang['nama_barang_bergerak']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>

                                                            <!-- Group Barang Mebel/Furniture -->
                                                            <optgroup label="Barang Mebel/Furniture">
                                                                <?php foreach ($barangAtk as $barang) : ?>
                                                                    <option value="<?= $barang['nama_barang_atk']; ?>">
                                                                        <?= $barang['kode_barang_atk']; ?> - <?= $barang['nama_barang_atk']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                            <optgroup label="Barang Elektronik">
                                                                <?php foreach ($barangElektronik as $barang) : ?>
                                                                    <option value="<?= $barang['tipe_model']; ?>">
                                                                        <?= $barang['merk']; ?> - <?= $barang['tipe_model']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Jumlah Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="jumlah_barang" class="font-weight-bold"><i class="fas fa-calculator mr-1"></i> Jumlah</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="jumlah_barang" name="jumlah_barang" placeholder="1 Unit" required>
                                                    </div>
                                                </div>
                                                <!-- Kondisi Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="kondisi" class="font-weight-bold"><i class="fas fa-clipboard-check mr-1"></i> Kondisi</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-heart text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="kondisi" name="kondisi" required>
                                                            <option value="" disabled selected>Pilih Kondisi Barang</option>
                                                            <option value="">Baik</option>
                                                            <option value="">Rusak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Tanggal Dipinjam -->
                                                <div class="form-group mb-4">
                                                    <label for="tanggal_peminjaman" class="font-weight-bold"><i class="far fa-calendar mr-1"></i> Tanggal Peminjaman</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="far fa-calendar-alt text-primary"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" required>
                                                    </div>
                                                </div>
                                                <!-- Tanggal Dipinjam -->
                                                <div class="form-group mb-4">
                                                    <label for="tanggal_pengembalian" class="font-weight-bold"><i class="far fa-calendar-check mr-1"></i> Tanggal Pengembalian</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-calendar-check text-primary"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required>
                                                    </div>
                                                </div>
                                                <!-- Lokasi -->
                                                <div class="form-group mb-4">
                                                    <label for="lokasi" class="font-weight-bold"><i class="fas fa-box mr-1"></i>Lokasi Peminjaman</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-laptop text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="lokasi" name="lokasi" required>
                                                            <option value="" disabled selected>Pilih Lokasi Barang</option>


                                                            <optgroup label="Gedung">
                                                                <?php foreach ($gedung as $lokasi) : ?>
                                                                    <option value="<?= $lokasi['nama_gedung']; ?>">
                                                                        <?= $lokasi['kode_gedung']; ?> - <?= $lokasi['nama_gedung']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                            <optgroup label="Lapang">
                                                                <?php foreach ($lapang as $lokasi) : ?>
                                                                    <option value="<?= $lokasi['nama_lapang']; ?>">
                                                                        <?= $lokasi['kode_lapang']; ?> - <?= $lokasi['nama_lapang']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                            <optgroup label="Ruang">
                                                                <?php foreach ($ruang as $lokasi) : ?>
                                                                    <option value="<?= $lokasi['nama_ruang']; ?>">
                                                                        <?= $lokasi['kode_ruang']; ?> - <?= $lokasi['nama_ruang']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>




                                                        </select>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Tujuan Peminjaman -->
                                            <div class="col-12 ">
                                                <h5 class="border-bottom pb-2 mb-3">
                                                    <i class="fas fa-bullseye text-primary mr-2"></i>
                                                    III. Tujuan Peminjaman
                                                </h5>
                                                <div class="form-group mb-4">
                                                    <label for="status" class="font-weight-bold"><i class="fas fa-clipboard-check mr-1"></i> Status</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-heart text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="status" name="status" required>
                                                            <option value="" disabled selected>Pilih Status</option>
                                                            <option value="Dipinjamkan">Dipinjamkan</option>
                                                            <option value="Tidak Dipinjamkan">Tidak Dipinjamkan</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-group mb-0">
                                                    <label for="tujuan_peminjaman" class="font-weight-bold"><i class="fas fa-info-circle mr-1"></i> Tujuan Peminjaman</label>
                                                    <textarea class="form-control" id="tujuan_peminjaman" name="tujuan_peminjaman" rows="3" placeholder="Masukan tujuan peminjaman barang"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right bg-light">
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <i class="fas fa-save mr-1"></i> Simpan
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
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
                    document.getElementById("modalTitle").textContent = "Edit Data Barang";
                    document.getElementById("submitBtn").innerHTML = '<i class="fas fa-edit mr-1"></i> Update Data';
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
                document.getElementById("submitBtn").innerHTML = '<i class="fas fa-save mr-1"></i> Simpan';
                document.getElementById("submitBtn").className = "btn btn-primary";
                document.querySelector("form").reset();
                document.getElementById("id").value = "";
            });

            // Inisialisasi Select2 dengan pengaturan tambahan
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: 'Pilih Barang',
                width: '100%',
                allowClear: true
            });

            // Set tanggal peminjaman default ke hari ini
            document.getElementById('tanggal_peminjaman').valueAsDate = new Date();

            // Validasi tahun perolehan
            document.getElementById('tahun_perolehan').addEventListener('change', function() {
                const currentYear = new Date().getFullYear();
                if (this.value < 2000 || this.value > currentYear + 1) {
                    this.setCustomValidity(`Tahun harus antara 2000 dan ${currentYear + 1}`);
                } else {
                    this.setCustomValidity('');
                }
            });
        });
    </script>
</body>

</html>