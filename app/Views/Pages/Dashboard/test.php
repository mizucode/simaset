<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">
        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white mb-5 pt-5 px-4">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-12">
                        <div class="card card-navy">
                            <div class="card-header text-white">
                                <h3 class="text-lg">
                                    Formulir Inventarisasi Sarpras Semesteran
                                </h3>
                            </div>

                            <form action="/admin/sarana/ruangan/tambah" method="POST" enctype="multipart/form-data">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-12">
                                            <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                IDENTITAS PENGISI
                                            </h5>
                                            <div class="form-group mb-4">
                                                <label for="penanggung_jawab">Penanggung Jawab Sarpras</label>
                                                <input type="text" class="form-control" id="penanggung_jawab" name="penanggung_jawab" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="semester">Semester</label>
                                                <input type="text" class="form-control" id="semester" name="semester" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="tahun_akademik">Tahun Akademik</label>
                                                <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="tanggal_pengecekan">Tanggal Pengecekan</label>
                                                <input type="date" class="form-control" id="tanggal_pengecekan" name="tanggal_pengecekan" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="lokasi_survey">Semester</label>
                                                <input type="text" class="form-control" id="lokasi_survey" name="lokasi_survey" placeholder="Ruang A204" required>
                                            </div>
                                            <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                DATA INVENTARIS SARPRAS
                                            </h5>

                                            <div class="table-responsive mb-4">
                                                <table class="table table-bordered" id="tabel-inventaris">
                                                    <thead class="bg-light">
                                                        <tr>
                                                            <th width="5%">No</th>
                                                            <th width="25%">Nama Barang</th>
                                                            <th width="10%">Jumlah</th>
                                                            <th width="20%">Kondisi</th>
                                                            <th width="20%">Kebutuhan Perbaikan/Pengadaan</th>
                                                            <th width="20%">Keterangan</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td>1</td>
                                                            <td><input type="text" class="form-control" name="nama_barang" placeholder="Meja Kuliah"></td>
                                                            <td><input type="number" class="form-control" name="jumlah" min="0"></td>
                                                            <td>
                                                                <select class="form-control" name="kondisi">
                                                                    <option value="Baik">Baik</option>
                                                                    <option value="Rusak Ringan">Rusak Ringan</option>
                                                                    <option value="Rusak Berat">Rusak Berat</option>
                                                                </select>
                                                            </td>
                                                            <td><input type="text" class="form-control" name="keterangan"></td>
                                                            <td><input type="text" class="form-control" name="kebutuhan"></td>
                                                        </tr>
                                                        <!-- Baris tambahan akan ditambahkan via JavaScript -->
                                                    </tbody>
                                                </table>
                                                <button type="button" class="btn btn-sm btn-primary mt-2" id="tambah-barang">
                                                    <i class="fas fa-plus mr-1"></i>Tambah Barang
                                                </button>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right text-white">
                                    <a href="/admin/sarana/ruangan" class="btn btn-secondary">
                                        <i class="fas fa-arrow-alt-circle-left mr-2"></i>Kembali
                                    </a>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save mr-2"></i>Simpan Inventaris
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php include './app/Views/Components/footer.php'; ?>
    </div>

    <?php include './app/Views/Components/script.php'; ?>

    <script>
        $(document).ready(function() {
            // Fungsi untuk menambah baris inventaris
            $('#tambah-barang').click(function() {
                var rowCount = $('#tabel-inventaris tbody tr').length + 1;
                var newRow = `
                    <tr>
                        <td>${rowCount}</td>
                        <td><input type="text" class="form-control" name="nama_barang[]"></td>
                        <td><input type="number" class="form-control" name="jumlah[]" min="0"></td>
                        <td>
                            <select class="form-control" name="kondisi[]">
                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="keterangan[]"></td>
                        <td><input type="text" class="form-control" name="kebutuhan[]"></td>
                    </tr>
                `;
                $('#tabel-inventaris tbody').append(newRow);
            });
        });
    </script>
</body>

</html>