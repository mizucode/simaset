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
                <div class="row justify-content-center">
                    <div class="col-md-8">
                        <div class="card bg-white shadow-sm">
                            <div class="card-header bg-navy text-white">
                                <h3 class="card-title mb-0">Formulir Pemindahan Barang</h3>
                            </div>

                            <div class="card-body">
                                <form action="/pemindahan-barang/store" method="POST">
                                    <!-- @csrf jika di Laravel -->

                                    <div class="form-group mb-3  ">
                                        <label for="barang_id">Pilih Barang</label>
                                        <select class="form-control bg-white" name="barang_id" id="barang_id" required>
                                            <option value="">-- Pilih Barang --</option>
                                            <option value="1">Proyektor Epson (BRG-001)</option>
                                            <option value="2">Kursi Lipat (BRG-032)</option>
                                            <!-- Data dinamis dari database -->
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="ruangan_lama">Ruangan Asal</label>
                                        <input type="text" class="form-control bg-white" id="ruangan_lama" name="ruangan_lama" placeholder="Contoh: Ruang 204 - Gedung A" readonly>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="ruangan_baru">Pilih Ruangan Tujuan</label>
                                        <select class="form-control bg-white" name="ruangan_baru" id="ruangan_baru" required>
                                            <option value="">-- Pilih Ruangan --</option>
                                            <option value="1">Ruang 101 - Gedung B</option>
                                            <option value="2">Lab Komputer - Gedung D</option>
                                            <!-- Data dinamis dari database -->
                                        </select>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="tanggal_pindah">Tanggal Pemindahan</label>
                                        <input type="date" class="form-control bg-white" name="tanggal_pindah" id="tanggal_pindah" required>
                                    </div>

                                    <div class="form-group mb-3">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control bg-white" name="keterangan" id="keterangan" rows="3" placeholder="Contoh: Dipindahkan karena renovasi ruangan"></textarea>
                                    </div>

                                    <button type="submit" class="btn btn-primary w-100">Simpan Pemindahan</button>
                                </form>
                            </div>
                        </div>
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