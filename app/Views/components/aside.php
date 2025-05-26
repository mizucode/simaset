<aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="#" class="brand-link bg-navy">
        <img src="/img/favicon.png"
            alt="AdminLTE Logo"
            class="brand-image">
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
                <!-- LAYANAN -->
                <li class="nav-header">LAYANAN</li>
                <li class="nav-item">
                    <a href="/admin" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt me-2"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Prasarana -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-building me-2"></i>
                        <p>
                            Prasarana
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/prasarana/tanah" class="nav-link">
                                <i class="nav-icon fas fa-map-marked-alt me-2"></i>
                                <p>Tanah</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/prasarana/gedung" class="nav-link">
                                <i class="nav-icon far fa-building me-2"></i>
                                <p>Bangunan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/prasarana/ruang" class="nav-link">
                                <i class="nav-icon fas fa-door-open me-2"></i>
                                <p>Ruangan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/prasarana/lapang" class="nav-link">
                                <i class="nav-icon fas fa-draw-polygon me-2"></i>
                                <p>Lapang</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Sarana -->
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tools me-2"></i>
                        <p>
                            Sarana
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/sarana/bergerak" class="nav-link">
                                <i class="nav-icon fas fa-truck-moving me-2"></i>
                                <p>Bergerak</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sarana/mebelair" class="nav-link">
                                <i class="nav-icon fas fa-chair me-2"></i>
                                <p>Mebelair</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sarana/atk" class="nav-link">
                                <i class="nav-icon fas fa-pencil-ruler me-2"></i>
                                <p>Alat Tulis Kantor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sarana/elektronik" class="nav-link">
                                <i class="nav-icon fas fa-plug me-2"></i>
                                <p>Elektronik</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- BARANG (Jika ini adalah header, Anda bisa tambahkan ikon seperti fas fa-archive) -->


                <!-- TRANSAKSI -->
                <li class="nav-header">TRANSAKSI</li>


                <!-- Peminjaman Barang (jika diaktifkan lagi) -->
                <!-- <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-handshake me-2"></i> // Icon ini sudah cukup baik
                        <p>
                            Peminjaman Barang
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/transaksi/riwayat-barang" class="nav-link">
                                <i class="nav-icon fas fa-history me-2"></i>
                                <p>Riwayat Barang</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/transaksi/formulir-pemimjaman" class="nav-link">
                                <i class="nav-icon fas fa-file-signature me-2"></i>
                                <p>Form Peminjaman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/transaksi/formulir-pengembalian" class="nav-link">
                                <i class="nav-icon fas fa-undo-alt me-2"></i>
                                <p>Form Pengembalian</p>
                            </a>
                        </li>
                    </ul>
                </li> -->
                <li class="nav-item has-treeview"> <!-- Ini sepertinya untuk "Tambah Barang Baru" berdasarkan submenunya -->
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cart-plus me-2"></i> <!-- atau fas fa-plus-square -->
                        <p>
                            Barang Masuk (Stok) <!-- Ganti nama jika lebih sesuai, misal "Tambah Stok Barang" -->
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/sarana/bergerak/tambah" class="nav-link">
                                <i class="nav-icon fas fa-truck-moving me-2"></i>
                                <p>Bergerak</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sarana/mebelair/tambah" class="nav-link">
                                <i class="nav-icon fas fa-chair me-2"></i>
                                <p>Mebelair</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sarana/atk/tambah" class="nav-link">
                                <i class="nav-icon fas fa-pencil-ruler me-2"></i>
                                <p>Alat Tulis Kantor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sarana/elektronik/tambah" class="nav-link">
                                <i class="nav-icon fas fa-plug me-2"></i>
                                <p>Elektronik</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-truck-loading me-2"></i> <!-- atau fas fa-people-arrows -->
                        <p>
                            Pemindahan Barang
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/sarana/bergerak/pindah" class="nav-link">
                                <i class="nav-icon fas fa-truck-moving me-2"></i>
                                <p>Bergerak</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sarana/mebelair/pindah" class="nav-link">
                                <i class="nav-icon fas fa-chair me-2"></i>
                                <p>Mebelair</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sarana/atk/pindah" class="nav-link">
                                <i class="nav-icon fas fa-pencil-ruler me-2"></i>
                                <p>Alat Tulis Kantor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sarana/elektronik/pindah" class="nav-link">
                                <i class="nav-icon fas fa-plug me-2"></i>
                                <p>Elektronik</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">MASTER BARANG</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-clipboard-check me-2"></i> <!-- atau fas fa-shield-alt -->
                        <p>
                            Kondisi Barang
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/sarana/bergerak/kondisi" class="nav-link">
                                <i class="nav-icon fas fa-truck-moving me-2"></i>
                                <p>Bergerak</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sarana/mebelair/kondisi" class="nav-link">
                                <i class="nav-icon fas fa-chair me-2"></i>
                                <p>Mebelair</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sarana/atk/kondisi" class="nav-link">
                                <i class="nav-icon fas fa-pencil-ruler me-2"></i>
                                <p>Alat Tulis Kantor</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="/admin/sarana/elektronik/kondisi" class="nav-link">
                                <i class="nav-icon fas fa-plug me-2"></i>
                                <p>Elektronik</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-cogs me-2"></i>
                        <p>
                            Pengaturan Barang
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/barang/jenis-barang" class="nav-link">
                                <i class="nav-icon fas fa-tags me-2"></i> <!-- atau fas fa-sitemap -->
                                <p>Jenis Barang</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- LAPORAN -->
                <li class="nav-header">LAPORAN</li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-poll me-2"></i> <!-- atau fas fa-clipboard-list -->
                        <p>
                            Survey
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="/admin/survey/semesteran" class="nav-link">
                                <i class="nav-icon fas fa-calendar-check me-2"></i>
                                <p>Semesteran</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-file-alt me-2"></i> <!-- atau fas fa-chart-bar -->
                        <p>
                            Laporan
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="pages/forms/general.html" class="nav-link">
                                <i class="nav-icon fas fa-file-invoice-dollar me-2"></i> <!-- Atau fas fa-search-minus -->
                                <p>Laporan Barang Hilang</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Logout -->
                <li class="nav-item mb-5">
                    <a href="/logout" class="nav-link">
                        <i class="nav-icon fas fa-sign-out-alt me-2"></i> <!-- Icon ini sudah pas -->
                        <p>Log Out</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>