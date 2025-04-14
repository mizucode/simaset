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
                    <div class="col-12">
                        <div class="card bg-white shadow-sm">
                            <div class="card-header bg-navy text-white">
                                <h3 class="card-title mb-0">Data Aset Lapangan Kampus</h3>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover text-sm text-center">
                                        <thead class="bg-navy text-white">
                                            <tr>
                                                <th>Nama Lapangan</th>
                                                <th>Jenis</th>
                                                <th>Lokasi</th>
                                                <th>Luas (m²)</th>
                                                <th>Kondisi</th>
                                                <th>Status</th>
                                                <th>Tanggal Tercatat</th>
                                                <th>Keterangan</th>
                                            </tr>
                                        </thead>
                                        <tbody class="bg-gray-50">
                                            <tr>
                                                <td>Lapangan Futsal A</td>
                                                <td>Futsal</td>
                                                <td>Belakang Gedung Olahraga</td>
                                                <td>800</td>
                                                <td><span class="badge bg-success">Baik</span></td>
                                                <td><span class="badge bg-primary">Aktif</span></td>
                                                <td>2024-01-10</td>
                                                <td>Digunakan untuk pertandingan rutin</td>
                                            </tr>
                                            <tr>
                                                <td>Lapangan Basket B</td>
                                                <td>Basket</td>
                                                <td>Depan Asrama Mahasiswa</td>
                                                <td>900</td>
                                                <td><span class="badge bg-warning text-dark">Rusak Ringan</span></td>
                                                <td><span class="badge bg-secondary">Perbaikan</span></td>
                                                <td>2023-11-22</td>
                                                <td>Ada kerusakan di lantai lapangan</td>
                                            </tr>
                                            <!-- Tambahkan baris lain sesuai data -->
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


        <!-- /.card-body -->
    </div>
    <!-- /.card -->
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