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
            <?php if (!empty($error)) : ?>
              <div class="alert alert-danger alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <?= htmlspecialchars($error); ?>
              </div>
            <?php endif; ?>

            <div class="card">
              <div class="card-header bg-navy mb-3 text-white">
                <h1 class="text-xl font-weight-bold">
                  Formulir Data Sarana Bergerak
                </h1>
              </div>

              <form action="/admin/sarana/bergerak/tambah" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="kategori_barang_id" value="1" id="kategori_barang_id">
                <input type="hidden" name="status" value="Tersedia">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <!-- Data Identitas Sarana -->
                      <div class="col-12 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            IDENTITAS SARANA BERGERAK
                          </h5>
                          <span class="form-text">Silahkan isi data identitas sarana bergerak dengan lengkap.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Barang -->
                          <div class="form-group">
                            <label for="barang_input" class="fw-bold">Jenis Barang <span class="text-danger">*</span></label>
                            <select class="form-control select2-custom" id="barang_input" name="barang_id" required>
                              <option value="" disabled selected>Pilih atau ketik jenis barang</option>
                              <?php foreach ($barangList as $barang) : ?>
                                <option value="<?= htmlspecialchars($barang['id']) ?>">
                                  <?= htmlspecialchars($barang['nama_barang']) ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <span class="form-text">Pilih jenis barang dari daftar atau ketik untuk mencari.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Nama Detail Barang -->
                          <div class="form-group">
                            <label for="nama_detail_barang" class="fw-bold">Nama Detail Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_detail_barang" name="nama_detail_barang" placeholder="Contoh: Mobil Toyota Avanza" required>
                            <span class="form-text">Masukkan nama lengkap atau deskriptif untuk sarana bergerak.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Data Spesifikasi -->
                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            SPESIFIKASI
                          </h5>
                          <span class="form-text">Isi informasi spesifikasi sarana bergerak.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Merk -->
                          <div class="form-group">
                            <label for="merk" class="fw-bold">Merk</label>
                            <input type="text" class="form-control" id="merk" name="merk" placeholder="Contoh: Toyota">
                            <span class="form-text">Masukkan merk produk jika ada.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- No Polisi -->
                          <div class="form-group">
                            <label for="no_polisi" class="fw-bold">Nomor Polisi</label>
                            <input type="text" class="form-control" id="no_polisi" name="no_polisi" placeholder="Contoh: B 1234 ABC">
                            <span class="form-text">Masukkan nomor polisi jika sarana adalah kendaraan.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Spesifikasi -->
                          <div class="form-group">
                            <label for="spesifikasi" class="fw-bold">Spesifikasi</label>
                            <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3" placeholder="Masukkan spesifikasi lengkap"></textarea>
                            <span class="form-text">Jelaskan spesifikasi teknis sarana.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Data Kondisi dan Kuantitas -->
                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            INFORMASI KONDISI DAN PEROLEHAN
                          </h5>
                          <span class="form-text">Isi informasi kondisi dan detail perolehan sarana.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Kondisi Barang -->
                          <div class="form-group">
                            <label for="kondisi_barang_id" class="fw-bold">Kondisi Barang <span class="text-danger">*</span></label>
                            <select class="form-control" id="kondisi_barang_id" name="kondisi_barang_id" required>
                              <option value="" disabled selected>Pilih Kondisi</option>
                              <?php foreach ($kondisiList as $kondisi) : ?>
                                <option value="<?= htmlspecialchars($kondisi['id']) ?>">
                                  <?= htmlspecialchars($kondisi['nama_kondisi']) ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <span class="form-text">Pilih kondisi fisik sarana saat ini.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Sumber -->
                          <div class="form-group">
                            <label for="sumber" class="fw-bold">Sumber Perolehan</label>
                            <select class="form-control" id="sumber" name="sumber">
                              <option value="" <?= !isset($sarana) ? 'selected' : '' ?>>Pilih Sumber</option>
                              <option value="APBD" <?= (isset($sarana) && $sarana['sumber'] == 'APBD') ? 'selected' : '' ?>>APBD</option>
                              <option value="APBN" <?= (isset($sarana) && $sarana['sumber'] == 'APBN') ? 'selected' : '' ?>>APBN</option>
                              <option value="Hibah" <?= (isset($sarana) && $sarana['sumber'] == 'Hibah') ? 'selected' : '' ?>>Hibah</option>
                              <option value="CSR" <?= (isset($sarana) && $sarana['sumber'] == 'CSR') ? 'selected' : '' ?>>CSR Perusahaan</option>
                            </select>
                            <span class="form-text">Pilih sumber perolehan sarana.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="biaya_pembelian" class="fw-bold">Biaya Pembelian</label>
                            <input type="text" class="form-control" id="biaya_pembelian" name="biaya_pembelian" placeholder="Contoh: 100000000 tanpa titik">
                            <span class="form-text">Masukkan harga perolehan sarana dalam rupiah (hanya angka).</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="tanggal_pembelian" class="fw-bold">Tanggal Pembelian <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" required>
                            <span class="form-text">Masukkan tanggal perolehan atau pembelian sarana.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Data Tambahan -->
                      <div class="col-12 mt-4">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            INFORMASI TAMBAHAN
                          </h5>
                          <span class="form-text">Isi informasi tambahan terkait sarana.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Lokasi Penempatan Barang -->
                          <div class="form-group">
                            <label for="lokasi" class="fw-bold">Lokasi Penempatan Barang <span class="text-danger">*</span></label>
                            <select class="form-control select2-custom" id="lokasi" name="lokasi" required>
                              <option value="" disabled selected>Pilih atau ketik lokasi barang</option>
                              <optgroup label="Lapang">
                                <?php foreach ($lapangData as $lokasi_item) : ?> <!-- Ubah nama variabel agar tidak konflik -->
                                  <option value="<?= htmlspecialchars($lokasi_item['nama_lapang']); ?>">
                                    <?= htmlspecialchars($lokasi_item['kode_lapang']); ?> - <?= htmlspecialchars($lokasi_item['nama_lapang']); ?>
                                  </option>
                                <?php endforeach; ?>
                              </optgroup>
                              <optgroup label="Ruang">
                                <?php foreach ($ruangData as $lokasi_item) : ?> <!-- Ubah nama variabel agar tidak konflik -->
                                  <option value="<?= htmlspecialchars($lokasi_item['nama_ruang']); ?>">
                                    <?= htmlspecialchars($lokasi_item['kode_ruang']); ?> - <?= htmlspecialchars($lokasi_item['nama_ruang']); ?>
                                  </option>
                                <?php endforeach; ?>
                              </optgroup>
                            </select>
                            <span class="form-text">Pilih lokasi penempatan sarana saat ini.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <!-- Keterangan -->
                          <div class="form-group">
                            <label for="keterangan" class="fw-bold">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Tambahkan keterangan jika diperlukan"></textarea>
                            <span class="form-text">Tambahkan catatan khusus tentang sarana ini jika ada.</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <a href="/admin/sarana/bergerak" class="btn btn-secondary">
                      <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                      <i class="fas fa-save mr-2"></i>
                      Simpan Data Sarana Bergerak
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
      $('#barang_input').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih atau ketik jenis barang",
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });

      // Inisialisasi Select2 untuk Lokasi Penempatan Barang
      $('#lokasi').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih atau ketik lokasi barang", // Placeholder spesifik untuk lokasi
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });
    });
  </script>

</body>

</html>