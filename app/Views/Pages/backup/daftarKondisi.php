<!DOCTYPE html>
<html lang="en">
<?php include 'components/head.php' ?>

<body
    class="hold-transition dark-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <?php include 'components/navbar.php' ?>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <?php include 'components/aside.php' ?>
        <!-- End Sidebar -->

        <!-- content-wrapper -->
        <div class="content-wrapper bg-white py-4 px-2">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12 bgw">
                        <div class="card bg-white border shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h3 class="card-title mb-0">Data Kondisi Barang</h3>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-sm text-center align-middle">
                                        <thead class="bg-primary text-white">
                                            <tr>
                                                <th>No</th>
                                                <th>Nama Barang</th>
                                                <th>Kode Barang</th>
                                                <th>Lokasi / Ruangan</th>
                                                <th>Tanggal Cek</th>
                                                <th>Kondisi</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-white">
                                            <tr>
                                                <td>1</td>
                                                <td>Proyektor Epson</td>
                                                <td>BRG-001</td>
                                                <td>Lab Komputer - Gedung D</td>
                                                <td>2024-03-28</td>
                                                <td><span class="badge bg-success">Baik</span></td>
                                                <td>Masih berfungsi normal</td>
                                            </tr>
                                            <tr>
                                                <td>2</td>
                                                <td>Kursi Lipat</td>
                                                <td>BRG-032</td>
                                                <td>Ruang Serbaguna Baru</td>
                                                <td>2024-04-01</td>
                                                <td><span class="badge bg-warning text-dark">Rusak Ringan</span></td>
                                                <td>Beberapa baut longgar</td>
                                            </tr>
                                            <tr>
                                                <td>3</td>
                                                <td>Speaker Audio</td>
                                                <td>BRG-015</td>
                                                <td>Aula Utama</td>
                                                <td>2024-03-10</td>
                                                <td><span class="badge bg-danger">Rusak Berat</span></td>
                                                <td>Tidak mengeluarkan suara</td>
                                            </tr>
                                            <!-- Tambahkan data lainnya -->
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </div>






        <!-- End content-wrapper -->

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

        <!-- Main Footer -->
        <footer class="main-footer bg-white text-black">
            <strong>Copyright &copy; 2025 <a href="#">Lpptsi. </a>Umkuningan.</strong>
        </footer>
    </div>
    <!-- ./wrapper -->

    <!-- Script -->
    <?php include 'components/script.php' ?>
    <!-- End Script -->
</body>

</html>