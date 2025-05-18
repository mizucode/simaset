<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white py-4 mb-5 px-5">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger"><?= htmlspecialchars($error); ?></div>
                        <?php endif; ?>

                        <div class="card">
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                                <h3 class="h4">Daftar Barang Masuk</h3>
                            </div>

                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Penerimaan</th>
                                            <th>Sumber Barang</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Kondisi</th>
                                            <th>Nomor Nota</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($mutasiBM)) : ?>
                                            <?php $counter = 1; ?>
                                            <?php foreach ($mutasiBM as $barang) : ?>
                                                <tr>
                                                    <td><?= $counter++; ?></td>

                                                    <td>
                                                        <?= isset($barang['tanggal_penerimaan']) ? date('d-m-Y', strtotime($barang['tanggal_penerimaan'])) : '-'; ?>
                                                    </td>

                                                    <td><?= htmlspecialchars($barang['sumber_barang'] ?? '-'); ?></td>
                                                    <td><?= htmlspecialchars($barang['nama_barang'] ?? '-'); ?></td>
                                                    <td><?= htmlspecialchars($barang['jumlah'] ?? '-'); ?></td>
                                                    <td><?= htmlspecialchars($barang['kondisi'] ?? '-'); ?></td>
                                                    <td><?= htmlspecialchars($barang['nomor_nota'] ?? '-'); ?></td>
                                                    <td><?= htmlspecialchars($barang['keterangan'] ?? '-'); ?></td>


                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="4" class="text-center">Data tidak ditemukan</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card mt-5">
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                                <h3 class="h4">Daftar Barang Keluar</h3>
                            </div>

                            <div class="card-body">
                                <table id="example2" class="table table-bordered table-sm table-striped">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Tanggal Keluar</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah</th>
                                            <th>Tujuan</th>
                                            <th>Penerima</th>
                                            <th>Keterangan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php if (!empty($mutasiBK)) : ?>
                                            <?php $counter = 1; ?>
                                            <?php foreach ($mutasiBK as $barang) : ?>
                                                <tr>
                                                    <td><?= $counter++; ?></td>

                                                    <td>
                                                        <?= isset($barang['tanggal_keluar']) ? date('d-m-Y', strtotime($barang['tanggal_keluar'])) : '-'; ?>
                                                    </td>
                                                    <td><?= htmlspecialchars($barang['nama_barang'] ?? '-'); ?></td>
                                                    <td><?= htmlspecialchars($barang['jumlah'] ?? '-'); ?></td>
                                                    <td><?= htmlspecialchars($barang['tujuan'] ?? '-'); ?></td>
                                                    <td><?= htmlspecialchars($barang['penerima'] ?? '-'); ?></td>
                                                    <td><?= htmlspecialchars($barang['keterangan'] ?? '-'); ?></td>


                                                </tr>
                                            <?php endforeach; ?>
                                        <?php else : ?>
                                            <tr>
                                                <td colspan="4" class="text-center">Data tidak ditemukan</td>
                                            </tr>
                                        <?php endif; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Form -->
        <div class="modal fade" id="modalBarang" tabindex="-1" role="dialog" aria-labelledby="modalBarangLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="card card-primary mb-0">
                        <div class="card-header">
                            <h3 class="card-title" id="modalTitle">Form Data Barang</h3>
                        </div>
                        <form action="/admin/barang/daftar-barang" method="POST">
                            <input type="hidden" name="id" id="id">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Kode Kategori Barang</label>
                                            <input type="text" name="kode_barang" id="kode_barang" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Nama Kategori</label>
                                            <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label>Jenis Kategori</label>
                                            <select name="kategori_id" id="kategori_id" class="form-control" required>
                                                <option value="">Pilih Kategori</option>
                                                <?php foreach ($kategoriBarang as $kategori) : ?>
                                                    <option value="<?= $kategori['id']; ?>"><?= htmlspecialchars($kategori['nama_kategori']); ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div> <!-- /.card-body -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">Simpan</button>
                                </div>
                        </form>
                    </div> <!-- /.card -->
                </div>
            </div>
        </div>

    </div>
    <footer class="main-footer bg-white text-black">
        <strong>&copy; 2025 <a href="#">Lpptsi</a>. Umkuningan.</strong>
    </footer>

    <?php include './app/Views/Components/script.php'; ?>

    <script>
        $(function() {
            // Inisialisasi DataTable untuk example1 (Data Barang Masuk)
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "stripe": false,
                "buttons": [{
                        extend: 'copy',
                        title: 'Data Barang Masuk'
                    },
                    {
                        extend: 'csv',
                        title: 'Data Barang Masuk'
                    },
                    {
                        extend: 'excel',
                        title: 'Data Barang Masuk'
                    },
                    {
                        extend: 'pdf',
                        title: 'Data Barang Masuk'
                    },
                    {
                        extend: 'print',
                        title: 'Data Barang Masuk'
                    },
                    'colvis'
                ]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

            // Inisialisasi DataTable untuk example2 (Data Barang Keluar)
            $("#example2").DataTable({
                "responsive": true,
                "lengthChange": true,
                "autoWidth": false,
                "stripe": false,
                "buttons": [{
                        extend: 'copy',
                        title: 'Data Barang Keluar'
                    },
                    {
                        extend: 'csv',
                        title: 'Data Barang Keluar'
                    },
                    {
                        extend: 'excel',
                        title: 'Data Barang Keluar'
                    },
                    {
                        extend: 'pdf',
                        title: 'Data Barang Keluar'
                    },
                    {
                        extend: 'print',
                        title: 'Data Barang Keluar'
                    },
                    'colvis'
                ]
            }).buttons().container().appendTo('#example2_wrapper .col-md-6:eq(0)');
        });

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