<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link bg-navy">
        <img
            src="/../../AdminLTE-3.2.0/dist/img/AdminLTELogo.png"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: 0.8" />
        <span class="brand-text font-weight-light font-weight-bold">Inventori Barang</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">Administrator</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->


        <!-- Sidebar Menu -->
        <nav class="mt-2">

            <ul
                class="nav nav-pills nav-sidebar flex-column"
                data-widget="treeview"
                role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->

                <div class="text-black">
                    <h1 class="nav-header h6" style="color: black">LAYANAN</h1>
                </div>
                <li class="nav-item">
                    <a href="/admin" class="nav-link">
                        <i class="nav-icon fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Prasarana -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Prasarana
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/prasarana/tanah" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tanah</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                href="/admin/prasarana/gedung"
                                class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Gedung</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/prasarana/ruangan" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Ruangan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/prasarana/lapang" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Lapang</p>
                            </a>
                        </li>





                    </ul>
                </li>
                <!-- End Barang -->

                <!-- Sarana -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box-open"></i>
                        <p>
                            Sarana
                            <i class="fas fa-angle-left right"></i>

                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/sarana/bergerak" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Bergerak</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a
                                href="/admin/sarana/mebeler"
                                class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Mebeler</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sarana/alat-tulis-kantor" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Alat Tulis Kantor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sarana/elektronik" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Elektronik</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- End Kategori Barang -->

                <!-- Data Ruangan -->
                <!-- Barang -->
                <!-- Transaksi -->
                <div class="text-black">
                    <h1 class="nav-header h6" style="color: black">BARANG</h1>
                </div>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            Barang
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/barang/daftar-barang" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/barang/daftar-barang/tambah" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Tambah Data Barang</p>
                            </a>
                        </li>


                    </ul>
                </li>

                <!-- End Transaksi -->
                <!-- End Barang -->
                <!-- End Kategori Barang -->

                <!-- Transaksi -->
                <div class="text-black">
                    <h1 class="nav-header h6" style="color: black">TRANSAKSI</h1>
                </div>

                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-handshake"></i>
                        <p>
                            Penempatan
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/penempatan/list" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>List Penempatan Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/penempatan/form" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Formulir Pemindahan Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/penempatan/detail" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Detail Pemindahan Barang</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Kondisi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/kondisi/daftar-kondisi" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Daftar Kondisi Barang</p>
                            </a>
                        </li>

                    </ul>
                </li>
                <!-- End Transaksi -->

                <!-- Laporan -->
                <div class="text-black">
                    <h1 class="nav-header h6" style="color: black">TRANSAKSI</h1>
                </div>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file"></i>
                        <p>
                            Laporan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/forms/general.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Data Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/advanced.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Mutasi Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/editors.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Pengajuan Barang Rusak / Hilang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/validation.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Laporan Barang per Ruangan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pages/forms/validation.html" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Export ke Excel/PDF</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- End Laporan -->
                <!-- Log out -->
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon fa fa-sign-out"></i>
                        <p>Log Out</p>
                    </a>
                </li>
                <!-- End Log out -->











            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>