<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white mb-5 pt-3 px-4 ">
      <div class=" container-fluid ">
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
            <!-- Pesan sukses jika ada dari session (misalnya setelah tambah/edit) -->
            <?php if (!empty($_SESSION['success_message'])) : ?>
              <div class="alert alert-success alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <?= htmlspecialchars($_SESSION['success_message']); ?>
                <?php unset($_SESSION['success_message']); ?>
              </div>
            <?php endif; ?>


            <div class="card">
              <div class="card-header bg-navy mb-3 text-white">
                <h1 class="text-xl font-weight-bold">
                  <!-- Judul dinamis berdasarkan mode (tambah/edit) -->
                  <?= isset($sarana) ? 'Edit Data Sarana Mebelair' : 'Formulir Data Sarana Mebelair' ?>
                </h1>
              </div>

              <form action="<?= isset($sarana) ? '/admin/sarana/mebelair?edit=' . $sarana['id'] : '/admin/sarana/mebelair/tambah' ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= $sarana['id'] ?? '' ?>">
                <input type="hidden" name="kategori_barang_id" value="2" id="kategori_barang_id"> <!-- ID Kategori Mebelair -->

                <div class="card-body">
                  <div class="row">
                    <div class="col-12">

                      <div class="col-12 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            IDENTITAS SARANA MEBELAIR
                          </h5>
                          <span class="form-text">Silahkan <?= isset($sarana) ? 'perbarui' : 'isi' ?> data identitas sarana mebelair dengan lengkap.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">

                          <div class="form-group">
                            <label for="barang_id" class="fw-bold">Jenis Barang Mebelair <span class="text-danger">*</span></label>
                            <select class="form-control select2-custom" id="barang_id" name="barang_id" required>
                              <option value="" <?= !isset($sarana['barang_id']) ? 'disabled selected' : 'disabled' ?>>
                                Pilih atau ketik jenis barang mebelair
                              </option>
                              <?php foreach ($barangList as $barang): ?>
                                <?php if ($barang['kategori_id'] == 2):
                                ?>
                                  <option value="<?= htmlspecialchars($barang['id']) ?>"
                                    <?= isset($sarana['barang_id']) && $sarana['barang_id'] == $barang['id'] ? 'selected' : '' ?>>
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
                            <input type="text" class="form-control" id="nama_detail_barang" name="nama_detail_barang" placeholder="Contoh: Meja Rapat Kayu Jati, Kursi Direktur Ergonomis" required value="<?= htmlspecialchars($sarana['nama_detail_barang'] ?? '') ?>">
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
                            <input type="text" class="form-control" id="merk" name="merk" placeholder="Contoh: IKEA, Informa, Olympic, dll" value="<?= htmlspecialchars($sarana['merk'] ?? '') ?>">
                            <span class="form-text">Masukkan merk produk jika ada.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">

                          <div class="form-group">
                            <label for="bahan" class="fw-bold">Bahan</label>
                            <select class="form-control" id="bahan" name="bahan">
                              <option value="" <?= !isset($sarana['bahan']) ? 'selected disabled' : 'disabled' ?>>Pilih Bahan...</option>
                              <option value="Kayu" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Kayu') ? 'selected' : '' ?>>Kayu</option>
                              <option value="Besi" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Besi') ? 'selected' : '' ?>>Besi</option>
                              <option value="Aluminium" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Aluminium') ? 'selected' : '' ?>>Aluminium</option>
                              <option value="Stainless Steel" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Stainless Steel') ? 'selected' : '' ?>>Stainless Steel</option>
                              <option value="Rotan" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Rotan') ? 'selected' : '' ?>>Rotan</option>
                              <option value="Plastik" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Plastik') ? 'selected' : '' ?>>Plastik</option>
                              <option value="Kaca" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Kaca') ? 'selected' : '' ?>>Kaca</option>
                              <option value="Bambu" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Bambu') ? 'selected' : '' ?>>Bambu</option>
                              <option value="Kulit" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Kulit') ? 'selected' : '' ?>>Kulit</option>
                              <option value="Kain" <?= (isset($sarana['bahan']) && $sarana['bahan'] == 'Kain') ? 'selected' : '' ?>>Kain</option>
                            </select>
                            <span class="form-text">Pilih bahan utama sarana.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">

                          <div class="form-group">
                            <label for="spesifikasi" class="fw-bold">Spesifikasi</label>
                            <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                              placeholder="Masukkan spesifikasi lengkap (ukuran PxLxT, warna, fitur tambahan, dll)"><?= htmlspecialchars($sarana['spesifikasi'] ?? '') ?></textarea>
                            <span class="form-text">Jelaskan spesifikasi teknis sarana.</span>
                          </div>
                        </div>
                      </div>


                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            KONDISI, SUMBER, & KUANTITAS
                          </h5>
                          <span class="form-text">Isi informasi kondisi, sumber, dan kuantitas sarana.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">

                          <div class="form-group">
                            <label for="kondisi_barang_id" class="fw-bold">Kondisi Barang <span class="text-danger">*</span></label>
                            <select class="form-control" id="kondisi_barang_id" name="kondisi_barang_id" required>
                              <option value="" disabled <?= !isset($sarana['kondisi_barang_id']) ? 'selected' : '' ?>>Pilih Kondisi</option>
                              <?php foreach ($kondisiList as $kondisi): ?>
                                <option value="<?= htmlspecialchars($kondisi['id']) ?>"
                                  <?= isset($sarana['kondisi_barang_id']) && $sarana['kondisi_barang_id'] == $kondisi['id'] ? 'selected' : '' ?>>
                                  <?= htmlspecialchars($kondisi['nama_kondisi']) ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <span class="form-text">Pilih kondisi fisik sarana saat ini.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">

                          <div class="form-group">
                            <label for="sumber" class="fw-bold">Sumber Perolehan</label>
                            <select class="form-control" id="sumber" name="sumber">
                              <option value="" <?= !isset($sarana['sumber']) || empty($sarana['sumber']) ? 'selected disabled' : 'disabled' ?>>Pilih Sumber</option>
                              <option value="APBD" <?= isset($sarana) && $sarana['sumber'] == 'APBD' ? 'selected' : ''; ?>>APBD</option>
                              <option value="APBN" <?= isset($sarana) && $sarana['sumber'] == 'APBN' ? 'selected' : ''; ?>>APBN</option>
                              <option value="Hibah" <?= isset($sarana) && $sarana['sumber'] == 'Hibah' ? 'selected' : ''; ?>>Hibah</option>
                              <option value="CSR" <?= isset($sarana) && $sarana['sumber'] == 'CSR' ? 'selected' : ''; ?>>CSR Perusahaan</option>
                              <option value="Lainnya" <?= isset($sarana) && $sarana['sumber'] == 'Lainnya' ? 'selected' : ''; ?>>Lainnya</option>
                            </select>
                            <span class="form-text">Pilih sumber perolehan sarana.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">

                          <div class="form-group">
                            <label for="jumlah" class="fw-bold">Kuantitas <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <input type="number" class="form-control" id="jumlah" name="jumlah"
                                value="<?= htmlspecialchars($sarana['jumlah'] ?? '1') ?>" min="1" required>
                              <div class="input-group-append">
                                <select class="custom-select" id="satuan" name="satuan" required>
                                  <option value="Unit" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Unit' ? 'selected' : (!isset($sarana['satuan']) ? 'selected' : '')) ?>>Unit</option>
                                  <option value="Buah" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Buah' ? 'selected' : '') ?>>Buah</option>
                                  <option value="Set" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Set' ? 'selected' : '') ?>>Set</option>
                                  <option value="Pasang" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Pasang' ? 'selected' : '') ?>>Pasang</option>
                                </select>
                              </div>
                            </div>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md"> <!-- Biaya Pembelian -->
                          <div class="form-group">
                            <label for="biaya_pembelian" class="fw-bold">Biaya Pembelian</label>
                            <input type="number" class="form-control" id="biaya_pembelian" name="biaya_pembelian" placeholder="Contoh: 1500000 (tanpa titik/koma)" min="0" value="<?= htmlspecialchars($sarana['biaya_pembelian'] ?? '') ?>">
                            <span class="form-text">Masukkan harga per satuan barang dalam rupiah (tanpa titik/koma).</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-0 border rounded-md"> <!-- Tanggal Pembelian -->
                          <div class="form-group">
                            <label for="tanggal_pembelian" class="fw-bold">Tanggal Pembelian <span class="text-danger">*</span></label>
                            <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="<?= htmlspecialchars($sarana['tanggal_pembelian'] ?? '') ?>" required>
                            <span class="form-text">Masukkan tanggal pembelian barang.</span>
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
                                <option value="" <?= !isset($sarana['lokasi']) || empty($sarana['lokasi']) ? 'disabled selected' : 'disabled' ?>>
                                  Pilih atau ketik lokasi barang
                                </option>
                                <optgroup label="Lapang">
                                  <?php foreach ($lapangData as $itemLokasi) : ?>
                                    <option value="<?= htmlspecialchars($itemLokasi['nama_lapang']); ?>"
                                      <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $itemLokasi['nama_lapang'] ? 'selected' : '') ?>>
                                      <?= htmlspecialchars($itemLokasi['kode_lapang']); ?> - <?= htmlspecialchars($itemLokasi['nama_lapang']); ?>
                                    </option>
                                  <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="Ruang">
                                  <?php foreach ($ruangData as $itemLokasi) : ?>
                                    <option value="<?= htmlspecialchars($itemLokasi['nama_ruang']); ?>"
                                      <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $itemLokasi['nama_ruang'] ? 'selected' : '') ?>>
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
                              <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                                placeholder="Tambahkan keterangan jika diperlukan"><?= htmlspecialchars($sarana['keterangan'] ?? '') ?></textarea>
                              <span class="form-text">Tambahkan catatan khusus tentang sarana ini jika ada.</span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="card-footer text-right">
                      <a href="/admin/sarana/mebelair" class="btn btn-secondary">
                        <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                      </a>
                      <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save mr-2"></i>
                        <?= isset($sarana) ? 'Update Data Sarana Mebelair' : 'Simpan Data Sarana Mebelair' ?>
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
      // Inisialisasi Select2 untuk Jenis Barang dan Lokasi
      // Menggunakan class .select2-custom untuk inisialisasi umum
      $('.select2-custom').select2({
        theme: 'bootstrap4',
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });

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
    });
  </script>
</body>

</html>