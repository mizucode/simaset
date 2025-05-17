<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>SIK - Detail Barang</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- AdminLTE -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/css/adminlte.min.css">
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/css/bootstrap.min.css">
    <style>
        .info-box-small {
            min-height: 60px;
        }

        .info-box-small .info-box-icon {
            width: 50px;
            font-size: 1.2rem;
        }

        .info-box-small .info-box-content {
            padding: 5px 10px;
        }

        .info-box-small .info-box-text {
            font-size: 0.8rem;
        }

        .info-box-small .info-box-number {
            font-size: 1rem;
            font-weight: bold;
        }

        .barang-image {
            height: 250px;
            object-fit: cover;
            border: 1px solid #dee2e6;
            border-radius: 5px;
        }

        .detail-label {
            font-weight: 600;
            color: #495057;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="index.html" class="nav-link">Beranda</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#" role="button">
                        <i class="fas fa-bell"></i>
                        <span class="badge badge-warning navbar-badge">3</span>
                    </a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link" data-toggle="dropdown" href="#">
                        <i class="fas fa-user-circle"></i>
                        <span class="ml-2">Admin Inventori</span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-user mr-2"></i> Profil
                        </a>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </a>
                    </div>
                </li>
            </ul>
        </nav>

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <!-- Brand Logo -->
            <a href="index.html" class="brand-link text-center">
                <span class="brand-text font-weight-light"><i class="fas fa-university mr-2"></i> SIK UNS</span>
            </a>

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="index.html" class="nav-link">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>Dashboard</p>
                            </a>
                        </li>
                        <li class="nav-item menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-boxes"></i>
                                <p>
                                    Inventori
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="barang.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Daftar Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="kategori.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Kategori Barang</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="lokasi.html" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>Lokasi Barang</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="peminjaman.html" class="nav-link">
                                <i class="nav-icon fas fa-exchange-alt"></i>
                                <p>Peminjaman</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="laporan.html" class="nav-link">
                                <i class="nav-icon fas fa-file-alt"></i>
                                <p>Laporan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="pengaturan.html" class="nav-link">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Pengaturan</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Detail Barang Inventori</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="index.html">Beranda</a></li>
                                <li class="breadcrumb-item"><a href="barang.html">Inventori</a></li>
                                <li class="breadcrumb-item active">Detail Barang</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header bg-primary">
                                    <h3 class="card-title">Informasi Lengkap Barang</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                            <i class="fas fa-minus text-white"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <!-- Kolom Gambar -->
                                        <div class="col-md-4">
                                            <div class="text-center mb-3">
                                                <img src="https://via.placeholder.com/300x200?text=Barang+Kampus" class="img-fluid barang-image" alt="Gambar Barang">
                                            </div>
                                            <div class="row">
                                                <div class="col-6">
                                                    <div class="info-box bg-light info-box-small mb-3">
                                                        <span class="info-box-icon bg-info"><i class="fas fa-box"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Stok</span>
                                                            <span class="info-box-number">5</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="info-box bg-light info-box-small mb-3">
                                                        <span class="info-box-icon bg-warning"><i class="fas fa-barcode"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Kode</span>
                                                            <span class="info-box-number">LP-001</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="info-box bg-light info-box-small">
                                                        <span class="info-box-icon bg-success"><i class="fas fa-check-circle"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Kondisi</span>
                                                            <span class="info-box-number">Baik</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-6">
                                                    <div class="info-box bg-light info-box-small">
                                                        <span class="info-box-icon bg-danger"><i class="fas fa-calendar-alt"></i></span>
                                                        <div class="info-box-content">
                                                            <span class="info-box-text">Tahun</span>
                                                            <span class="info-box-number">2022</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <!-- Kolom Detail -->
                                        <div class="col-md-8">
                                            <h3 class="mb-3">Laptop ASUS VivoBook 14 A412FA</h3>

                                            <div class="row mb-4">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="detail-label">Kategori Barang</label>
                                                        <p>Elektronik - Laptop</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="detail-label">Lokasi Penyimpanan</label>
                                                        <p>Gedung Rektorat Lt.2 - Ruang TU</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="detail-label">Sumber Dana</label>
                                                        <p>DIPA Universitas</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="detail-label">Tanggal Pembelian</label>
                                                        <p>15 Maret 2022</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="detail-label">Masa Garansi</label>
                                                        <p>2 Tahun (s/d Maret 2024)</p>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="detail-label">Nomor Inventaris</label>
                                                        <p>UNS/IT/2022/00124</p>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="detail-label">Spesifikasi Teknis</label>
                                                <div class="border p-2 bg-light">
                                                    <ul class="mb-0">
                                                        <li>Processor: Intel Core i5-10210U</li>
                                                        <li>RAM: 8GB DDR4</li>
                                                        <li>Storage: 512GB SSD</li>
                                                        <li>Layar: 14" FHD IPS</li>
                                                        <li>Sistem Operasi: Windows 10 Pro</li>
                                                    </ul>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="detail-label">Deskripsi</label>
                                                <div class="border p-2 bg-light">
                                                    <p class="mb-0">Laptop untuk kebutuhan administrasi di Tata Usaha Rektorat. Dilengkapi dengan lisensi software original untuk produktivitas kantor.</p>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="detail-label">Riwayat Peminjaman (3 bulan terakhir)</label>
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-bordered">
                                                        <thead class="bg-light">
                                                            <tr>
                                                                <th>Tanggal</th>
                                                                <th>Peminjam</th>
                                                                <th>Unit</th>
                                                                <th>Keperluan</th>
                                                                <th>Status</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>12 Mei 2023</td>
                                                                <td>Budi Santoso (Fak. Teknik)</td>
                                                                <td>1</td>
                                                                <td>Workshop</td>
                                                                <td><span class="badge bg-success">Dikembalikan</span></td>
                                                            </tr>
                                                            <tr>
                                                                <td>28 April 2023</td>
                                                                <td>Ani Wijaya (Fak. Ekonomi)</td>
                                                                <td>1</td>
                                                                <td>Penelitian</td>
                                                                <td><span class="badge bg-success">Dikembalikan</span></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button class="btn btn-default mr-2">
                                        <i class="fas fa-print mr-1"></i> Cetak
                                    </button>
                                    <button class="btn btn-warning mr-2">
                                        <i class="fas fa-pencil-alt mr-1"></i> Edit
                                    </button>
                                    <button class="btn btn-danger">
                                        <i class="fas fa-trash-alt mr-1"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- Footer -->
        <footer class="main-footer">
            <strong>Sistem Inventori Kampus (SIK) &copy; 2023 <a href="#">Universitas Sebelas Maret</a>.</strong>
            <div class="float-right d-none d-sm-inline-block">
                <b>Versi</b> 1.0.0
            </div>
        </footer>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.2.3/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/admin-lte/3.2.0/js/adminlte.min.js"></script>
</body>

</html>