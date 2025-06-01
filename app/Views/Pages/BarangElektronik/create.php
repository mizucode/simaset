<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white mb-5 pt-3 px-4 ">
      <div class="container-fluid ">
        <div class="row justify-content-center ">
          <div class="col-12 ">
            <?php if (!empty($_SESSION['error'])) : ?>
              <div class="alert alert-danger alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <?= htmlspecialchars($_SESSION['error']); ?>
                <?php unset($_SESSION['error']); ?>
              </div>
            <?php endif; ?>
            <?php if (!empty($_SESSION['update'])) : ?>
              <div class="alert alert-success alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <?= htmlspecialchars($_SESSION['update']); ?>
                <?php unset($_SESSION['update']); ?>
              </div>
            <?php endif; ?>


            <div class="card card-navy">
              <div class="card-header text-white">
                <h3 class="text-lg">
                  Formulir Data Sarana Elektronik
                </h3>
              </div>

              <form action="/admin/sarana/elektronik/tambah" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="kategori_barang_id" value="4" id="kategori_barang_id">

                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <!-- Data Identitas Sarana -->
                      <div class="col-12 mb-5">
                        <h5 class="border-bottom pb-2 mb-3 text-bold">
                          IDENTITAS SARANA ELEKTRONIK
                        </h5>
                        <!-- Barang -->
                        <div class="form-group mb-4">
                          <label for="barang_id" class="font-weight-bold text-dark mb-2">Jenis Barang Elektronik</label>
                          <div class="rounded-md d-flex align-items-stretch border bg-white select2-custom-wrapper">
                            <div class="input-group-prepend">
                              <span class="input-group-text border-0 bg-light">
                                <i class="fas fa-desktop text-primary"></i>
                              </span>
                            </div>
                            <select class="form-control rounded border-0 select2-custom" id="barang_id" name="barang_id" required>
                              <option value="" disabled selected>Pilih atau ketik jenis barang elektronik</option>
                              <?php foreach ($barangList as $barang): ?>
                                <?php if ($barang['kategori_id'] == 4): ?>
                                  <option value="<?= htmlspecialchars($barang['id']) ?>">
                                    <?= htmlspecialchars($barang['nama_barang']) ?>
                                  </option>
                                <?php endif; ?>
                              <?php endforeach; ?>
                            </select>
                          </div>
                          <small class="form-text text-muted mt-1">Pilih jenis barang elektronik dari daftar atau ketik untuk mencari</small>
                        </div>
                        <!-- Nama Detail Barang -->
                        <div class="form-group mb-4">
                          <label for="nama_detail_barang" class="font-weight-bold">Nama Detail Barang</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-light"><i class="fas fa-tag text-primary"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nama_detail_barang" name="nama_detail_barang"
                              placeholder="Contoh: Laptop Dell XPS 13, Proyektor Epson EB-S41" required>
                          </div>
                        </div>
                      </div>

                      <!-- Data Spesifikasi -->
                      <div class="col-12 mb-5">
                        <h5 class="border-bottom pb-2 mb-3 text-bold">
                          SPESIFIKASI
                        </h5>
                        <!-- Merk -->
                        <div class="form-group mb-4">
                          <label for="merk" class="font-weight-bold">Merk</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-light"><i class="fas fa-copyright text-primary"></i></span>
                            </div>
                            <input type="text" class="form-control" id="merk" name="merk"
                              placeholder="Contoh: Dell, Epson, Samsung, LG, dll">
                          </div>
                        </div>
                        <!-- Tipe (Baru untuk Elektronik) -->
                        <div class="form-group mb-4">
                          <label for="tipe" class="font-weight-bold">Tipe/Model</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-light"><i class="fas fa-barcode text-primary"></i></span>
                            </div>
                            <input type="text" class="form-control" id="tipe" name="tipe"
                              placeholder="Contoh: XPS 13 9310, EB-S41, Galaxy S21">
                          </div>
                        </div>
                        <!-- Spesifikasi -->
                        <div class="form-group mb-4">
                          <label for="spesifikasi" class="font-weight-bold">Spesifikasi</label>
                          <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                            placeholder="Masukkan spesifikasi lengkap (RAM, Storage, Ukuran Layar, Resolusi, dll)"></textarea>
                        </div>
                      </div>

                      <!-- Data Kondisi dan Kuantitas -->
                      <div class="col-12 mb-5">
                        <h5 class="border-bottom pb-2 mb-3 text-bold">
                          KONDISI & PEMBELIAN
                        </h5>
                        <!-- Kondisi Barang -->
                        <div class="form-group mb-4">
                          <label for="kondisi_barang_id" class="font-weight-bold">Kondisi Barang</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-light"><i class="fas fa-clipboard-check text-primary"></i></span>
                            </div>
                            <select class="form-control" id="kondisi_barang_id" name="kondisi_barang_id" required>
                              <option value="" disabled selected>Pilih Kondisi</option>
                              <?php foreach ($kondisiList as $kondisi): ?>
                                <option value="<?= htmlspecialchars($kondisi['id']) ?>">
                                  <?= htmlspecialchars($kondisi['nama_kondisi']) ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                          </div>
                        </div>
                        <!-- Jumlah -->
                        <div class="form-group mb-4">
                          <label for="jumlah" class="font-weight-bold">Jumlah</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-light"><i class="fas fa-calculator text-primary"></i></span>
                            </div>
                            <input type="number" class="form-control" id="jumlah" name="jumlah"
                              value="1" min="1" required>
                            <div class="input-group-append">
                              <select class="form-control" id="satuan" name="satuan" required>
                                <option value="Unit" selected>Unit</option>
                                <option value="Buah">Buah</option>
                                <option value="Set">Set</option>
                              </select>
                            </div>
                          </div>
                        </div>
                        <!-- Biaya Pembelian -->
                        <div class="form-group mb-4">
                          <label for="biaya_pembelian" class="font-weight-bold">Biaya Pembelian</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-light"><i class="fas fa-money-bill-wave text-primary"></i></span>
                            </div>
                            <input type="number" class="form-control" id="biaya_pembelian" name="biaya_pembelian" placeholder="Contoh: 15000000 (tanpa titik/koma)" min="0">
                          </div>
                        </div>
                        <!-- Tanggal Pembelian -->
                        <div class="form-group mb-4">
                          <label for="tanggal_pembelian" class="font-weight-bold">Tanggal Pembelian</label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-light"><i class="far fa-calendar-alt text-primary"></i></span>
                            </div>
                            <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian">
                          </div>
                        </div>
                      </div>

                      <!-- Data Tambahan -->
                      <div class="col-12">
                        <h5 class="border-bottom pb-2 mb-3 text-bold">
                          INFORMASI TAMBAHAN
                        </h5>
                        <!-- Lokasi Penempatan -->
                        <div class="form-group mb-4">
                          <label for="lokasi" class="font-weight-bold text-dark mb-2">Lokasi Penempatan Barang</label>
                          <div class="rounded-md d-flex align-items-stretch border bg-white select2-custom-wrapper">
                            <div class="input-group-prepend">
                              <span class="input-group-text border-0 bg-light">
                                <i class="fas fa-map-marker-alt text-primary"></i>
                              </span>
                            </div>
                            <select class="form-control rounded border-0 select2-custom" id="lokasi" name="lokasi" required>
                              <option value="" disabled selected>Pilih atau ketik lokasi barang</option>
                              <optgroup label="Lapang">
                                <?php foreach ($lapangData as $itemLokasi) : ?>
                                  <option value="<?= htmlspecialchars($itemLokasi['nama_lapang']); ?>">
                                    <?= htmlspecialchars($itemLokasi['kode_lapang']); ?> - <?= htmlspecialchars($itemLokasi['nama_lapang']); ?>
                                  </option>
                                <?php endforeach; ?>
                              </optgroup>
                              <optgroup label="Ruang">
                                <?php foreach ($ruangData as $itemLokasi) : ?>
                                  <option value="<?= htmlspecialchars($itemLokasi['nama_ruang']); ?>">
                                    <?= htmlspecialchars($itemLokasi['kode_ruang']); ?> - <?= htmlspecialchars($itemLokasi['nama_ruang']); ?>
                                  </option>
                                <?php endforeach; ?>
                              </optgroup>
                            </select>
                          </div>
                          <small class="form-text text-muted mt-1">Pilih lokasi dari daftar atau ketik untuk mencari</small>
                        </div>
                        <!-- Keterangan -->
                        <div class="form-group mb-4">
                          <label for="keterangan" class="font-weight-bold">Keterangan</label>
                          <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                            placeholder="Tambahkan keterangan jika diperlukan (misal: kondisi garansi, catatan perbaikan, dll)"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> <!-- Penutup card-body yang sebelumnya hilang -->
                <div class="card-footer text-right text-white">
                  <a href="/admin/sarana/elektronik" class="btn btn-secondary">
                    <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                  </a>
                  <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Data Sarana Elektronik
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

  <!-- Initialize Select2 -->
  <script>
    $(document).ready(function() {
      // Inisialisasi Select2 untuk Jenis Barang Elektronik
      $('#barang_id').select2({
        placeholder: "Pilih atau ketik jenis barang elektronik",
        allowClear: false, // Jika ingin ada tombol clear, set ke true
        minimumResultsForSearch: 1, // Tampilkan search box
      });

      // Inisialisasi Select2 untuk Lokasi Penempatan Barang
      $('#lokasi').select2({
        placeholder: "Pilih atau ketik lokasi barang",
        allowClear: false,
        minimumResultsForSearch: 1,
      });

      // Anda bisa menambahkan inisialisasi Select2 untuk field lain jika diperlukan,
      // misalnya untuk 'Kondisi Barang' jika daftarnya panjang.
      // Contoh:
      // $('#kondisi_barang_id').select2({
      //     placeholder: "Pilih Kondisi",
      //     minimumResultsForSearch: Infinity // Sembunyikan search box jika tidak perlu
      // });
    });
  </script>
  <style>
    .select2-custom-wrapper .select2-selection {
      border: none !important;
      background: transparent !important;
      height: auto !important;
      padding: 0 !important;
    }

    .select2-custom-wrapper .select2-selection__rendered {
      padding-left: 10px !important;
      line-height: inherit !important;
    }

    .select2-custom-wrapper .select2-selection__arrow {
      height: 100% !important;
    }

    .select2-dropdown {
      border: 1px solid #ddd !important;
    }

    .select2-custom-wrapper .select2-selection--single:focus {
      outline: none !important;
    }

    .select2-custom-wrapper .select2-selection--single {
      height: 38px !important;
      /* Sesuaikan dengan tinggi input lain jika perlu */
      display: flex !important;
      align-items: center !important;
    }

    /* Jika card-footer di form tambah tidak berwarna, maka hilangkan text-white */
    /* .card-footer { background-color: #f8f9fa; border-top: 1px solid #dee2e6; } */
  </style>

</body>

</html>