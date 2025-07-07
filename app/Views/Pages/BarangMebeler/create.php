<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper  bg-white mb-5 pt-3">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>

            <div class="card">
              <div class="card-header bg-navy mb-3">
                <h3 class="card-title text-bold">
                  TAMBAH DATA BARANG MASUK SARANA MEBELAIR
                </h3>
              </div>

              <form action="/admin/sarana/mebelair/tambah" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id">
                <input type="hidden" name="kategori_barang_id" value="2" id="kategori_barang_id">
                <input type="hidden" name="status" value="Terpakai">

                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="col-12 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            IDENTITAS SARANA MEBELAIR
                          </h5>
                          <span class="form-text">Silahkan isi data identitas sarana mebelair dengan lengkap.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="barang_id" class="fw-bold">Jenis Barang Mebelair <span class="text-danger">*</span></label>
                            <select class="form-control select2-custom" id="barang_id" name="barang_id" required>
                              <option value="" disabled selected>
                                Pilih atau ketik jenis barang mebelair
                              </option>
                              <?php foreach ($barangList as $barang): ?>
                                <?php if ($barang['kategori_id'] == 2): ?>
                                  <option value="<?= htmlspecialchars($barang['id']) ?>">
                                    <?= htmlspecialchars($barang['nama_barang']) ?>
                                  </option>
                                <?php endif; ?>
                              <?php endforeach; ?>
                            </select>
                            <span class="form-text">Pilih jenis barang mebelair dari daftar atau ketik untuk mencari.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="nama_detail_barang" class="fw-bold">Nama Detail Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_detail_barang" name="nama_detail_barang" placeholder="Contoh: Meja Rapat Kayu Jati, Kursi Direktur Ergonomis" required>
                            <span class="form-text">Masukkan nama lengkap atau deskriptif untuk sarana mebelair.</span>
                          </div>
                        </div>
                      </div>

                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            SPESIFIKASI
                          </h5>
                          <span class="form-text">Isi informasi spesifikasi sarana mebelair.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="merk" class="fw-bold">Merk</label>
                            <input type="text" class="form-control" id="merk" name="merk" placeholder="Contoh: IKEA, Informa, Olympic, dll" required>
                            <span class="form-text">Masukkan merk produk jika ada.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="bahan" class="fw-bold">Bahan</label>
                            <select class="form-control select2-custom" id="bahan" name="bahan">
                              <option value="" selected disabled>Pilih Bahan...</option>
                              <option value="Panduan">Panduan</option>
                              <option value="Kayu">Kayu</option>
                              <option value="Besi">Besi</option>
                              <option value="Aluminium">Aluminium</option>
                              <option value="Stainless Steel">Stainless Steel</option>
                              <option value="Rotan">Rotan</option>
                              <option value="Plastik">Plastik</option>
                              <option value="Kaca">Kaca</option>
                              <option value="Bambu">Bambu</option>
                              <option value="Kulit">Kulit</option>
                              <option value="Kain">Kain</option>
                              <option value="Lainnya">Lainnya...</option>
                            </select>
                            <span class="form-text">Pilih bahan utama sarana.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="spesifikasi" class="fw-bold">Spesifikasi</label>
                            <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3" placeholder="Masukkan spesifikasi lengkap (ukuran PxLxT, warna, fitur tambahan, dll)" required></textarea>
                            <span class="form-text">Jelaskan spesifikasi teknis sarana.</span>
                          </div>
                        </div>
                      </div>

                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            INFORMASI KONDISI DAN PEROLEHAN
                          </h5>
                          <span class="form-text">Isi informasi kondisi dan detail perolehan sarana.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
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
                            <span class="form-text">Pilih kondisi fisik sarana saat ini.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="sumber" class="fw-bold">Sumber Perolehan <span class="text-danger">*</span></label>
                            <select class="form-control" id="sumber" name="sumber" required>
                              <option value="">Pilih Sumber Perolehan...</option>
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
                            <span class="form-text">Pilih sumber perolehan sarana sesuai klasifikasi yang direkomendasikan.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="biaya_pembelian" class="fw-bold">Biaya Pembelian <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" id="biaya_pembelian" name="biaya_pembelian" placeholder="Contoh: 1500000 (tanpa titik/koma)" min="0" required>
                            <span class="form-text">Masukkan harga per satuan barang dalam rupiah (tanpa titik/koma).</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="tanggal_pembelian" class="fw-bold">Tanggal Pembelian <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" required>
                            <span class="form-text">Masukkan tanggal pembelian barang.</span>
                          </div>
                        </div>
                      </div>

                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            KUANTITAS
                          </h5>
                          <span class="form-text">Isi informasi kuantitas sarana.</span>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="jumlah" class="fw-bold">Kuantitas <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <input type="number" class="form-control" id="jumlah" name="jumlah" value="1" min="1" required>
                              <div class="input-group-append">
                                <select class="custom-select" id="satuan" name="satuan" required>
                                  <option value="Unit" selected>Unit</option>
                                  <option value="Buah">Buah</option>
                                  <option value="Set">Set</option>
                                  <option value="Pasang">Pasang</option>
                                  <option value="Lembar">Lembar</option>
                                  <option value="Dus">Dus</option>
                                  <option value="Paket">Paket</option>
                                  <option value="Roll">Roll</option>
                                  <option value="Meter">Meter</option>
                                  <option value="Batang">Batang</option>
                                </select>
                              </div>
                            </div>
                            <span class="form-text">Masukkan jumlah dan satuan barang.</span>
                          </div>
                        </div>
                      </div>

                      <div class="col-12 mt-4">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            INFORMASI TAMBAHAN
                          </h5>
                          <span class="form-text">Isi informasi tambahan terkait sarana.</span>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="lokasi" class="fw-bold">Lokasi Penempatan Barang <span class="text-danger">*</span></label>
                            <select class="form-control select2-custom" id="lokasi" name="lokasi" required>
                              <option value="" disabled selected>
                                Pilih atau ketik lokasi barang
                              </option>
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
                            <span class="form-text">Pilih lokasi penempatan sarana saat ini.</span>
                          </div>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="keterangan" class="fw-bold">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2" placeholder="Tambahkan keterangan jika diperlukan"></textarea>
                            <span class="form-text">Tambahkan catatan khusus tentang sarana ini jika ada.</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="d-flex flex-column align-items-end flex-md-row justify-content-md-end">
                    <a href="/admin/sarana/mebelair" class="btn btn-secondary mb-2 mb-md-0 mr-md-2 d-flex align-items-center">
                      <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary mb-2 mb-md-0" id="submitBtn">
                      <i class="fas fa-save mr-2"></i>
                      Simpan
                    </button>
                  </div>
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
      // Inisialisasi individual jika placeholder berbeda atau konfigurasi khusus
      $('#barang_id').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih atau ketik jenis barang mebelair",
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

      $('#sumber').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Sumber Perolehan...",
        allowClear: true,
        minimumResultsForSearch: 1,
        width: '100%'
      });

      $('#bahan').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih atau ketik bahan",
        allowClear: true, // Memungkinkan opsi kosong dipilih kembali
        minimumResultsForSearch: 1, // Selalu tampilkan kotak pencarian
        width: '100%'
      });
    });
  </script>
</body>

</html>