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

                            <form action="/admin/survey/semesteran/tambah" method="POST">
                                <div class="card-body">
                                    <?php if (isset($_SESSION['error'])): ?>
                                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                            <?= $_SESSION['error'];
                                            unset($_SESSION['error']); ?>
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    <?php endif; ?>

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
                                                <select class="form-control" name="semester" required>
                                                    <option value="" selected disabled>Pilih Semester</option>
                                                    <option value="Ganjil">Ganjil</option>
                                                    <option value="Genap">Genap</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="tahun_akademik">Tahun Akademik</label>
                                                <input type="text" class="form-control" id="tahun_akademik" name="tahun_akademik" placeholder="2023/2024" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="tanggal_pengecekan">Tanggal Pengecekan</label>
                                                <input type="date" class="form-control" id="tanggal_pengecekan" name="tanggal_pengecekan" required>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="lokasi_survey">Lokasi Survey</label>
                                                <input type="text" class="form-control" id="lokasi_survey" name="lokasi_survey" placeholder="Ruang A204" required>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <a href="/admin/survey/semesteran" class="btn btn-secondary">
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
                        <td><input type="text" class="form-control" name="nama_barang[]" required></td>
                        <td><input type="number" class="form-control" name="jumlah[]" min="1" value="1" required></td>
                        <td>
                            <select class="form-control" name="kondisi[]" required>
                                <option value="Baik">Baik</option>
                                <option value="Rusak Ringan">Rusak Ringan</option>
                                <option value="Rusak Berat">Rusak Berat</option>
                            </select>
                        </td>
                        <td><input type="text" class="form-control" name="kebutuhan[]"></td>
                        <td><input type="text" class="form-control" name="keterangan[]"></td>
                        <td><button type="button" class="btn btn-sm btn-danger hapus-barang"><i class="fas fa-trash"></i></button></td>
                    </tr>
                `;
                $('#tabel-inventaris tbody').append(newRow);
            });

            // Fungsi untuk menghapus baris
            $(document).on('click', '.hapus-barang', function() {
                if ($('#tabel-inventaris tbody tr').length > 1) {
                    $(this).closest('tr').remove();
                    // Update nomor urut
                    $('#tabel-inventaris tbody tr').each(function(index) {
                        $(this).find('td:first').text(index + 1);
                    });
                } else {
                    alert('Minimal harus ada satu barang!');
                }
            });
        });
    </script>
</body>

</html>