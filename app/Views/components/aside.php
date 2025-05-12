<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link bg-navy">
        <img src="/../../AdminLTE-3.2.0/dist/img/AdminLTELogo.png"
            alt="AdminLTE Logo"
            class="brand-image img-circle elevation-3"
            style="opacity: 0.8">
        <span class="brand-text font-weight-bold">Inventori Barang</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- User panel -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
                <a href="#" class="d-block">Administrator</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

                <li class="nav-header">LAYANAN</li>
                <li class="nav-item">
                    <a href="/admin" class="nav-link">
                        <i class="nav-icon fas fa-home me-2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Prasarana -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box me-2"></i>
                        <p>
                            Prasarana
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="/admin/prasarana/tanah" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Tanah</p>
                            </a></li>
                        <li class="nav-item"><a href="/admin/prasarana/gedung" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Gedung</p>
                            </a></li>
                        <li class="nav-item"><a href="/admin/prasarana/ruang" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Ruangan</p>
                            </a></li>
                        <li class="nav-item"><a href="/admin/prasarana/lapang" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Lapang</p>
                            </a></li>
                    </ul>
                </li>

                <!-- Sarana -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box-open me-2"></i>
                        <p>
                            Sarana
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="/admin/sarana/bergerak" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Bergerak</p>
                            </a></li>
                        <li class="nav-item"><a href="/admin/sarana/mebelair" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Mebelair</p>
                            </a></li>
                        <li class="nav-item"><a href="/admin/sarana/atk" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Alat Tulis Kantor</p>
                            </a></li>
                        <li class="nav-item"><a href="/admin/sarana/elektronik" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Elektronik</p>
                            </a></li>
                    </ul>
                </li>

                <li class="nav-header">BARANG</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box me-2"></i>
                        <p>
                            Barang
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="/admin/barang/daftar-barang" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Daftar Barang</p>
                            </a></li>
                        <li class="nav-item"><a href="/admin/barang/kategori-barang" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Kategori Barang</p>
                            </a></li>
                    </ul>
                </li>

                <li class="nav-header">TRANSAKSI</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-handshake me-2"></i>
                        <p>
                            Penempatan Barang
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="/admin/penempatan/daftar-barang" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Daftar Peminjaman Barang</p>
                            </a></li>
                        <li class="nav-item"><a href="/admin/penempatan/daftar-barang/tambah" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Formulir Peminjaman Barang</p>
                            </a></li>
                        <li class="nav-item"><a href="/admin/penempatan/detail" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Detail Pemindahan Barang</p>
                            </a></li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit me-2"></i>
                        <p>
                            Kondisi
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="/admin/kondisi/daftar-kondisi" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Daftar Kondisi Barang</p>
                            </a></li>
                    </ul>
                </li>

                <li class="nav-header">LAPORAN</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file me-2"></i>
                        <p>
                            Laporan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item"><a href="pages/forms/general.html" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Laporan Data Barang</p>
                            </a></li>
                        <li class="nav-item"><a href="pages/forms/advanced.html" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Laporan Mutasi Barang</p>
                            </a></li>
                        <li class="nav-item"><a href="pages/forms/editors.html" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Laporan Pengajuan Barang Rusak / Hilang</p>
                            </a></li>
                        <li class="nav-item"><a href="pages/forms/validation.html" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Laporan Barang per Ruangan</p>
                            </a></li>
                        <li class="nav-item"><a href="pages/forms/validation.html" class="nav-link"><i class="far fa-circle nav-icon me-2"></i>
                                <p>Export ke Excel/PDF</p>
                            </a></li>
                    </ul>
                </li>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt me-2"></i>
                        <p>Log Out</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>