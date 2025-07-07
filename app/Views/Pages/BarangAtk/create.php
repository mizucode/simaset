<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper  bg-white  mb-5 pt-3 ">
      <div class="container-fluid ">
        <div class="row justify-content-center ">
          <div class="col-12 ">
            <?php include './app/Views/Components/helper.php'; ?>

            <div class="card">
              <div class="card-header bg-navy mb-3 text-white">
                <h3 class="card-title text-bold">
                  TAMBAH DATA BARANG MASUK SARANA ATK
                </h3>
              </div>

              <form action="/admin/sarana/atk/tambah" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="kategori_barang_id" value="3" id="kategori_barang_id">
                <input type="hidden" name="status" value="Terpakai">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">

                      <!-- Data Identitas Sarana -->
                      <div class="col-12 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            IDENTITAS SARANA ATK
                          </h5>
                          <span class="form-text">Silahkan isi data identitas sarana ATK dengan lengkap.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Jenis Barang -->
                          <div class="form-group">
                            <label for="barang_id" class="fw-bold">Jenis Barang ATK <span class="text-danger">*</span></label>
                            <select class="form-control select2-custom" id="barang_id" name="barang_id" required>
                              <option value="" disabled selected>
                                Pilih atau ketik jenis barang ATK
                              </option>
                              <?php foreach ($barangList as $barang): ?>
                                <?php if ($barang['kategori_id'] == 3): ?>
                                  <option value="<?= htmlspecialchars($barang['id']) ?>">
                                    <?= htmlspecialchars($barang['nama_barang']) ?>
                                  </option>
                                <?php endif; ?>
                              <?php endforeach; ?>
                            </select>
                            <span class="form-text">Pilih jenis barang ATK dari daftar atau ketik untuk mencari.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Nama Detail Barang -->
                          <div class="form-group">
                            <label for="nama_detail_barang" class="fw-bold">Nama Detail Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_detail_barang" name="nama_detail_barang"
                              placeholder="Contoh: Pensil Faber-Castell 2B, Kertas HVS A4 70gr" required>
                            <span class="form-text">Masukkan nama lengkap atau deskriptif untuk barang ATK.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Data Spesifikasi -->
                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            SPESIFIKASI
                          </h5>
                          <span class="form-text">Isi informasi spesifikasi barang ATK.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Merk -->
                          <div class="form-group">
                            <label for="merk" class="fw-bold">Merk</label>
                            <input type="text" class="form-control" id="merk" name="merk"
                              placeholder="Contoh: Faber-Castell, Sinar Dunia, Joyko">
                            <span class="form-text">Masukkan merk produk jika ada.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Spesifikasi -->
                          <div class="form-group">
                            <label for="spesifikasi" class="fw-bold">Spesifikasi</label>
                            <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                              placeholder="Masukkan spesifikasi (warna, ukuran, jenis bahan, ketebalan, dll)"></textarea>
                            <span class="form-text">Jelaskan spesifikasi teknis barang.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Data Kondisi dan Kuantitas -->
                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            KONDISI, KUANTITAS, DAN PEMBELIAN
                          </h5>
                          <span class="form-text">Isi informasi kondisi dan kuantitas barang.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Kondisi Barang -->
                          <div class="form-group">
                            <label for="kondisi_barang_id" class="fw-bold">Kondisi Barang <span class="text-danger">*</span></label>
                            <select class="form-control" id="kondisi_barang_id" name="kondisi_barang_id" required>
                              <option value="" disabled selected>Pilih Kondisi</option>
                              <?php foreach ($kondisiList as $kondisi): ?>
                                <option value="<?= htmlspecialchars($kondisi['id']) ?>">
                                  <?= htmlspecialchars($kondisi['nama_kondisi']) ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <span class="form-text">Pilih kondisi fisik barang saat ini.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Jumlah -->
                          <div class="form-group">
                            <label for="jumlah" class="fw-bold">Kuantitas <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <input type="number" class="form-control" id="jumlah" name="jumlah"
                                value="1" min="1" required>
                              <div class="input-group-append">
                                <select class="form-control" id="satuan" name="satuan" required>
                                  <option value="Buah" selected>Buah</option>
                                  <option value="Unit">Unit</option>
                                  <option value="Pak">Pak</option>
                                  <option value="Rim">Rim</option>
                                  <option value="Lusin">Lusin</option>
                                  <option value="Set">Set</option>
                                </select>
                              </div>
                            </div>
                            <span class="form-text">Masukkan jumlah barang dengan satuan yang sesuai.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Sumber Perolehan -->
                          <div class="form-group">
                            <label for="sumber" class="fw-bold">Sumber Perolehan <span class="text-danger">*</span></label>
                            <select class="form-control select2-custom" id="sumber" name="sumber" required>
                              <option value="" disabled selected>Pilih Sumber Perolehan...</option>
                              <optgroup label="I. Dana Internal Universitas">
                                <option value="Dana Operasional (SPP & Sejenisnya)">Dana Operasional (SPP & Sejenisnya)</option>
                                <option value="Dana Pembangunan/Sumbangan Lainnya dari Mahasiswa">Dana Pembangunan/Sumbangan Lainnya dari Mahasiswa</option>
                                <option value="Dana Kegiatan Spesifik (KKN, KKL, dll.)">Dana Kegiatan Spesifik (KKN, KKL, dll.)</option>
                                <option value="Hasil Usaha & Unit Bisnis Universitas">Hasil Usaha & Unit Bisnis Universitas</option>
                                <option value="Hasil Investasi Universitas">Hasil Investasi Universitas</option>
                                <option value="Anggaran Internal Universitas (APB-PTM)">Anggaran Internal Universitas (APB-PTM)</option>
                              </optgroup>
                              <optgroup label="II. Dana Eksternal (Filantropi & Kemitraan)">
                                <option value="Hibah Penelitian">Hibah Penelitian</option>
                                <option value="Hibah Pengabdian kepada Masyarakat (PkM)">Hibah Pengabdian kepada Masyarakat (PkM)</option>
                                <option value="Hibah Kompetisi/Pengembangan Institusi">Hibah Kompetisi/Pengembangan Institusi</option>
                                <option value="Sumbangan/Donasi (Individu, Alumni, Korporasi)">Sumbangan/Donasi (Individu, Alumni, Korporasi)</option>
                                <option value="Corporate Social Responsibility (CSR)">Corporate Social Responsibility (CSR)</option>
                                <option value="Wakaf">Wakaf</option>
                              </optgroup>
                              <optgroup label="III. Bantuan Pemerintah">
                                <option value="Bantuan Dana APBN">Bantuan Dana APBN</option>
                                <option value="Bantuan Dana APBD">Bantuan Dana APBD</option>
                              </optgroup>
                              <optgroup label="IV. Perolehan Non-Pembelian">
                                <option value="Pertukaran Aset (Ruilslag)">Pertukaran Aset (Ruilslag)</option>
                                <option value="Hasil Lelang">Hasil Lelang</option>
                                <option value="Ketetapan Hukum/Peraturan">Ketetapan Hukum/Peraturan</option>
                              </optgroup>
                            </select>
                            <span class="form-text">Pilih sumber perolehan barang ATK.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Biaya Pembelian -->
                          <div class="form-group">
                            <label for="biaya_pembelian" class="fw-bold">Biaya Pembelian (Per Satuan)</label>
                            <input type="number" class="form-control" id="biaya_pembelian" name="biaya_pembelian"
                              placeholder="Contoh: 2500 (tanpa titik/koma)" min="0">
                            <span class="form-text">Masukkan harga per satuan barang dalam rupiah.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Tanggal Pembelian -->
                          <div class="form-group">
                            <label for="tanggal_pembelian" class="fw-bold">Tanggal Pembelian</label>
                            <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian">
                            <span class="form-text">Masukkan tanggal pembelian barang jika diketahui.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Data Tambahan -->
                      <div class="col-12 mt-4">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            INFORMASI TAMBAHAN
                          </h5>
                          <span class="form-text">Isi informasi tambahan terkait barang.</span>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="lokasi" class="fw-bold">Lokasi Penempatan Barang <span class="text-danger">*</span></label>
                            <select class="form-control select2-custom" id="lokasi" name="lokasi" required>
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
                            <span class="form-text">Pilih lokasi penyimpanan barang saat ini.</span>
                          </div>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Keterangan -->
                          <div class="form-group">
                            <label for="keterangan" class="fw-bold">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                              placeholder="Tambahkan keterangan jika diperlukan (misal: stok minimal, tanggal kadaluarsa jika ada)"></textarea>
                            <span class="form-text">Tambahkan catatan khusus tentang barang ini.</span>
                          </div>
                        </div>
                      </div>


                    </div>
                  </div>
                </div>

                <div class="card-footer text-right text-white">
                  <a href="/admin/sarana/atk" class="btn btn-secondary text-white">
                    <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                  </a>
                  <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save mr-2"></i>
                    <?= isset($sarana) ? 'Update Data Sarana ATK' : 'Simpan Data Sarana ATK' ?>
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
    $(document).ready(function() {
      // Inisialisasi Select2 untuk Jenis Barang dan Lokasi
      // Menggunakan class .select2-custom untuk inisialisasi umum
      $('.select2-custom').select2({
        theme: 'bootstrap4',
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });
      $('#barang_id').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih atau ketik jenis barang ATK",
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });

      $('#lokasi').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih atau ketik lokasi barang",
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });

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
      display: flex !important;
      align-items: center !important;
    }
  </style>
</body>

</html>