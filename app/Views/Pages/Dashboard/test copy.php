<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">

    <div class="wrapper">

        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <div class="content-wrapper bg-white py-4 mb-5 px-4 ">
            <div class="container-fluid ">
                <div class="row justify-content-center ">
                    <div class="col-12 ">

                        <?php if (!empty($error)) : ?>
                            <div class="alert alert-danger alert-dismissible fade show mb-4">
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <?= htmlspecialchars($error); ?>
                            </div>
                        <?php endif; ?>

                        <div class="card card-navy">

                            <div class="card-header text-white">
                                <h3 class="text-lg">
                                    Fo
                                </h3>

                            </div>

                            <form action="/admin/tanah/tambah" method="POST">
                                <input type="hidden" name="id" id="id">
                                <div class="card-body">
                                    <div class="card-body">
                                        <div class="row">
                                            <!-- Kolom Gambar -->
                                            <div class="col-md-4">
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
                                </div>
                                <div class="row">
                                    <div class="col-12">
                                        <!-- Data Identitas Tanah -->
                                        <div class="col-12 mb-5">
                                            <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                IDENTITAS TANAH
                                            </h5>
                                            <!-- Nomor Sertifikat -->
                                            <div class="form-group mb-4">
                                                <label for="kode_aset" class="font-weight-bold">Kode Aset</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="kode_aset" name="kode_aset" placeholder="Contoh: T001" readonly required>
                                                </div>

                                            </div>
                                            <!-- Nama aset -->
                                            <div class="form-group mb-4">
                                                <label for="nama_aset" class="font-weight-bold">Nama Aset</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="nama_aset" name="nama_aset" placeholder="Contoh: Tanah Kampus Satu" required>
                                                </div>
                                                <div class="text-slate-500 flex align-center text-sm pt-2">
                                                    <div>
                                                        Masukan nama aset
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Luas Tanah -->
                                            <div class="form-group mb-4">
                                                <label for="luas" class="font-weight-bold">Luas Tanah (m²)</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                    </div>
                                                    <input type="number" class="form-control" id="luas" name="luas" placeholder="Masukkan luas tanah dalam meter persegi" required>
                                                </div>
                                            </div>
                                            <!-- Alamat Tanah -->
                                            <div class="form-group mb-4">
                                                <label for="lokasi" class="font-weight-bold">Lokasi Tanah</label>
                                                <textarea class="form-control" id="lokasi" name="lokasi" rows="2" placeholder="Contoh: Jalan raya cigugur no. 14" required></textarea>
                                            </div>
                                            <!-- Jenis Hak -->

                                        </div>

                                        <!-- Data Status Tanah -->
                                        <div class="col-12 mb-5">
                                            <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                STATUS TANAH
                                            </h5>
                                            <!-- Nomor sertifikat -->
                                            <div class="form-group mb-4">
                                                <label for="no_sertifikat" class="font-weight-bold">Nomor Sertifikat</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="no_sertifikat" name="no_sertifikat" placeholder="Masukan nomor sertifikat" required>
                                                </div>
                                            </div>
                                            <!-- Aset Tanah -->
                                            <div class="form-group mb-4">
                                                <label for="jenis_aset" class="font-weight-bold">Jenis Aset Tanah</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                    </div>
                                                    <select class="form-control" id="jenis_aset" name="jenis_aset" required>

                                                        <option value="" disabled selected>Pilih jenis aset tanah</option>
                                                        <option value="Aset Tetap">Aset Tetap</option>
                                                        <option value="Aset Tidak Tetap">Aset Tidak Tetap</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group mb-4">
                                                <label for="tgl_pajak" class="font-weight-bold">Tanaggal Pajak</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                    </div>
                                                    <input type="date" class="form-control" id="tgl_pajak" name="tgl_pajak" placeholder="Masukan Tanaggal Pajak" required>
                                                </div>
                                            </div>



                                        </div>

                                        <!-- Data Batas Tanah -->
                                        <div class="col-12 ">
                                            <h5 class="border-bottom pb-2 mb-3 text-bold">
                                                FUNGSI DAN KETERANGAN
                                            </h5>
                                            <!-- Fungsi Tanah -->
                                            <div class="form-group mb-4">
                                                <label for="fungsi" class="font-weight-bold">Fungsi tanah</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="fungsi" name="fungsi" placeholder="Masukan fungsi tanah" required>
                                                </div>
                                            </div>
                                            <!-- Keterangan -->
                                            <div class="form-group mb-4">
                                                <label for="keterangan" class="font-weight-bold">Keterangan</label>
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-light"><i class="fas fa-hashtag text-primary"></i></span>
                                                    </div>
                                                    <input type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Masukan keterangan" required>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-footer text-right text-white">
                                    <a href="/admin/prasarana/tanah" class="btn btn-secondary "><span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali</a>
                                    <button type="submit" class="btn btn-primary" id="submitBtn">
                                        <i class="fas fa-save mr-2"></i>
                                        Simpan Data Tanah
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
        document.addEventListener('DOMContentLoaded', function() {
            const namaAsetInput = document.getElementById('nama_aset');
            const kodeAsetInput = document.getElementById('kode_aset');

            namaAsetInput.addEventListener('input', function() {
                let namaAset = namaAsetInput.value.trim();

                if (namaAset.length > 0) {
                    // Ambil huruf pertama dari setiap kata
                    let singkatan = namaAset
                        .split(' ')
                        .filter(kata => kata.length > 0)
                        .map(kata => kata.charAt(0).toUpperCase())
                        .join('');

                    // Gabungkan dengan awalan TNH-
                    let kodeAset = `TNH-${singkatan}`;
                    kodeAsetInput.value = kodeAset;
                } else {
                    // Kosongkan jika nama aset kosong
                    kodeAsetInput.value = '';
                }
            });
        });
    </script>

</body>

</html>