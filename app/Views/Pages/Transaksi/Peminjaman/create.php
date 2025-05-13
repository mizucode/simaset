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
                                    Formulir Peminjaman Barang
                                </h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                </div>
                            </div>

                            <form action="/admin/transaksi/formulir-pemimjaman" method="POST">
                                <input type="hidden" name="id" id="id">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <!-- Identitas Peminjam -->
                                            <div class="col-12 mb-5">
                                                <h5 class="border-bottom pb-2 mb-3">
                                                    I. Data Peminjam
                                                </h5>
                                                <!-- Nama Peminjam -->
                                                <div class="form-group mb-4">
                                                    <label for="nama_peminjam" class="font-weight-bold">Nama Peminjam</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-user text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nama_peminjam" name="nama_peminjam" placeholder="Masukkan nama peminjam" required>
                                                    </div>
                                                </div>
                                                <!-- NIK -->
                                                <div class="form-group mb-4">
                                                    <label for="nik" class="font-weight-bold">NIM/NIK/NIP</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-id-badge text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="nik" name="nik" placeholder="Masukkan NIM/NIK/NIP peminjam" required>
                                                    </div>
                                                </div>
                                                <!-- Jabatan -->
                                                <div class="form-group mb-4">
                                                    <label for="jabatan" class="font-weight-bold">Jabatan</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-user-tag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="jabatan" name="jabatan" placeholder="Masukkan jabatan peminjam" required>
                                                    </div>
                                                </div>
                                                <!-- No telepon -->
                                                <div class="form-group mb-4">
                                                    <label for="no_telepon" class="font-weight-bold">No telepon</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-mobile-alt text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="no_telepon" name="no_telepon" placeholder="Masukkan No Telepon peminjam" required>
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Identitas Barang Dipinjam -->
                                            <div class="col-12 mb-5 <h5 class=" border-bottom pb-2 mb-3">
                                                II. Data Barang
                                                </h5>
                                                <!-- Nama Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="nama_barang" class="font-weight-bold">Nama Barang</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-laptop text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="nama_barang" name="nama_barang" required>
                                                            <option value="" disabled selected>Pilih Nama Barang</option>

                                                            <optgroup label="Alat Tulis Kantor">
                                                                <?php foreach ($barangATK as $barang) : ?>
                                                                    <option value="<?= $barang['nama_detail_barang']; ?>">
                                                                        <?= $barang['no_registrasi']; ?> - <?= $barang['nama_detail_barang']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>

                                                            <!-- Group Barang Bergerak -->
                                                            <optgroup label="Barang Bergerak">
                                                                <?php foreach ($barangBergerak as $barang) : ?>
                                                                    <option value="<?= $barang['nama_detail_barang']; ?>">
                                                                        <?= $barang['no_registrasi']; ?> - <?= $barang['nama_detail_barang']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>


                                                            <!-- Group Barang Mebel/Furniture -->
                                                            <optgroup label="BarangMebelair">
                                                                <?php foreach ($barangMebelair as $barang) : ?>
                                                                    <option value="<?= $barang['nama_detail_barang']; ?>">
                                                                        <?= $barang['no_registrasi']; ?> - <?= $barang['nama_detail_barang']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>

                                                            <optgroup label="Barang Elektronik">
                                                                <?php foreach ($barangElektronik as $barang) : ?>
                                                                    <option value="<?= $barang['nama_detail_barang']; ?>">
                                                                        <?= $barang['no_registrasi']; ?> - <?= $barang['nama_detail_barang']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>




                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Jumlah Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="jumlah_barang" class="font-weight-bold">Jumlah</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" id="jumlah_barang" name="jumlah_barang" placeholder="1 Unit" required>
                                                    </div>
                                                </div>
                                                <!-- Kondisi Barang -->
                                                <div class="form-group mb-4">
                                                    <label for="kondisi" class="font-weight-bold">Kondisi</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-heart text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="kondisi" name="kondisi" required>
                                                            <option value="" disabled selected>Pilih Kondisi Barang</option>
                                                            <option value="Baik">Baik</option>
                                                            <option value="Rusak">Rusak</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- Tanggal Dipinjam -->
                                                <div class="form-group mb-4">
                                                    <label for="tanggal_peminjaman" class="font-weight-bold">Tanggal Peminjaman</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="far fa-calendar-alt text-primary"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" id="tanggal_peminjaman" name="tanggal_peminjaman" required>
                                                    </div>
                                                </div>
                                                <!-- Tanggal Pengembalian -->
                                                <div class="form-group mb-4">
                                                    <label for="tanggal_pengembalian" class="font-weight-bold">Tanggal Pengembalian</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-calendar-check text-primary"></i></span>
                                                        </div>
                                                        <input type="date" class="form-control" id="tanggal_pengembalian" name="tanggal_pengembalian" required>
                                                    </div>
                                                </div>
                                                <!-- Lokasi -->
                                                <div class="form-group mb-4">
                                                    <label for="lokasi " class="font-weight-bold">Lokasi Peminjaman</label>
                                                    <div class="input-group">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text bg-light"><i class="fas fa-laptop text-primary"></i></span>
                                                        </div>
                                                        <select class="form-control" id="lokasi" name="lokasi" required>
                                                            <option value="" disabled selected>Pilih Lokasi Barang</option>

                                                            <optgroup label="Gedung">
                                                                <?php foreach ($gedungData as $lokasi) : ?>
                                                                    <option value="<?= $lokasi['nama_gedung']; ?>">
                                                                        <?= $lokasi['kode_gedung']; ?> - <?= $lokasi['nama_gedung']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                            <optgroup label="Lapang">
                                                                <?php foreach ($lapangData as $lokasi) : ?>
                                                                    <option value="<?= $lokasi['nama_lapang']; ?>">
                                                                        <?= $lokasi['kode_lapang']; ?> - <?= $lokasi['nama_lapang']; ?>
                                                                    </option>
                                                                <?php endforeach; ?>
                                                            </optgroup>
                                                            <optgroup label="Ruang">
                                                                <?php foreach ($ruangData as $lokasi) : ?>
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
                                                    III. Tujuan Peminjaman
                                                </h5>
                                                <div class="form-group mb-4">
                                                    <label for="status" class="font-weight-bold">Status</label>
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
                                                    <label for="tujuan_peminjaman" class="font-weight-bold">Tujuan Peminjaman</label>
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


</body>

</html>