<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white mb-5 pt-3 ">
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

            <div class="card">
              <div class="card-header bg-navy mb-3 text-white">
                <h3 class="card-title text-bold">
                  Edit Data Sarana Elektronik
                </h3>
              </div>

              <form action="/admin/sarana/elektronik/edit/<?= htmlspecialchars($sarana['no_registrasi']) ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= htmlspecialchars($sarana['id'] ?? '') ?>">
                <input type="hidden" name="kategori_barang_id" value="4" id="kategori_barang_id">

                <div class="card-body">
                  <div class="row">
                    <div class="col-12">

                      <div class="col-12 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            IDENTITAS SARANA ELEKTRONIK
                          </h5>
                          <span class="form-text">Silahkan perbarui data identitas sarana elektronik dengan lengkap.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">

                          <div class="form-group">
                            <label for="barang_id" class="fw-bold">Jenis Barang Elektronik <span class="text-danger">*</span></label>
                            <select class="form-control select2-custom" id="barang_id" name="barang_id" required>
                              <option value="" <?= !isset($sarana['barang_id']) ? 'disabled selected' : 'disabled' ?>>
                                Pilih atau ketik jenis barang elektronik
                              </option>
                              <?php foreach ($barangList as $barang): ?>
                                <?php if ($barang['kategori_id'] == 4): ?>
                                  <option value="<?= htmlspecialchars($barang['id']) ?>" <?= isset($sarana['barang_id']) && $sarana['barang_id'] == $barang['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($barang['nama_barang']) ?>
                                  </option>
                                <?php endif; ?>
                              <?php endforeach; ?>
                            </select>
                            <span class="form-text">Pilih jenis barang elektronik dari daftar atau ketik untuk mencari.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">

                          <div class="form-group">
                            <label for="nama_detail_barang" class="fw-bold">Nama Detail Barang <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" id="nama_detail_barang" name="nama_detail_barang" placeholder="Contoh: Laptop Dell XPS 13, Proyektor Epson EB-S41" required value="<?= htmlspecialchars($sarana['nama_detail_barang'] ?? '') ?>">
                            <span class="form-text">Masukkan nama lengkap atau deskriptif untuk sarana elektronik.</span>
                          </div>
                        </div>
                      </div>


                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            SPESIFIKASI
                          </h5>
                          <span class="form-text">Isi informasi spesifikasi sarana elektronik.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">

                          <div class="form-group">
                            <label for="merk" class="fw-bold">Merk</label>
                            <input type="text" class="form-control" id="merk" name="merk" placeholder="Contoh: Dell, Epson, Samsung, LG, dll" value="<?= htmlspecialchars($sarana['merk'] ?? '') ?>">
                            <span class="form-text">Masukkan merk produk jika ada.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">

                          <div class="form-group">
                            <label for="tipe" class="fw-bold">Tipe/Model</label>
                            <input type="text" class="form-control" id="tipe" name="tipe" placeholder="Contoh: XPS 13 9310, EB-S41, Galaxy S21" value="<?= htmlspecialchars($sarana['tipe'] ?? '') ?>">
                            <span class="form-text">Masukkan tipe atau model produk jika ada.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">

                          <div class="form-group">
                            <label for="spesifikasi" class="fw-bold">Spesifikasi</label>
                            <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                              placeholder="Masukkan spesifikasi lengkap (RAM, Storage, Ukuran Layar, Resolusi, dll)"><?= htmlspecialchars($sarana['spesifikasi'] ?? '') ?></textarea>
                            <span class="form-text">Jelaskan spesifikasi teknis sarana.</span>
                          </div>
                        </div>
                      </div>


                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            KONDISI, KUANTITAS, DAN PEMBELIAN
                          </h5>
                          <span class="form-text">Isi informasi kondisi dan pembelian sarana elektronik.</span>
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
                            <label for="jumlah" class="fw-bold">Kuantitas <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <input type="number" class="form-control" id="jumlah" name="jumlah"
                                value="<?= htmlspecialchars($sarana['jumlah'] ?? '1') ?>" min="1" required>
                              <div class="input-group-append">
                                <select class="form-control" id="satuan" name="satuan" required>
                                  <option value="Unit" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Unit' ? 'selected' : (!isset($sarana['satuan']) ? 'selected' : '')) ?>>Unit</option>
                                  <option value="Buah" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Buah' ? 'selected' : '') ?>>Buah</option>
                                  <option value="Set" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Set' ? 'selected' : '') ?>>Set</option>
                                  <option value="Pcs" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Pcs' ? 'selected' : '') ?>>Pcs</option>
                                  <option value="Pack" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Pack' ? 'selected' : '') ?>>Pack</option>
                                  <option value="Box" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Box' ? 'selected' : '') ?>>Box</option>
                                  <option value="Roll" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Roll' ? 'selected' : '') ?>>Roll</option>
                                  <option value="Lusin" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Lusin' ? 'selected' : '') ?>>Lusin</option>
                                  <option value="Lainnya" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Lainnya' ? 'selected' : '') ?>>Lainnya</option>
                                </select>
                              </div>
                            </div>
                            <span class="form-text">Masukkan jumlah dan satuan barang.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">

                          <!-- Sumber Perolehan -->
                          <div class="form-group">
                            <label for="sumber" class="fw-bold">Sumber Perolehan <span class="text-danger">*</span></label>
                            <select class="form-control select2-custom" id="sumber" name="sumber" required>
                              <option value="" disabled <?= !isset($sarana['sumber']) || empty($sarana['sumber']) ? 'selected' : '' ?>>Pilih Sumber Perolehan...</option>
                              <optgroup label="I. Dana Internal Universitas">
                                <option value="Dana Operasional (SPP & Sejenisnya)" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Dana Operasional (SPP & Sejenisnya)') ? 'selected' : '' ?>>Dana Operasional (SPP & Sejenisnya)</option>
                                <option value="Dana Pembangunan/Sumbangan Lainnya dari Mahasiswa" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Dana Pembangunan/Sumbangan Lainnya dari Mahasiswa') ? 'selected' : '' ?>>Dana Pembangunan/Sumbangan Lainnya dari Mahasiswa</option>
                                <option value="Dana Kegiatan Spesifik (KKN, KKL, dll.)" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Dana Kegiatan Spesifik (KKN, KKL, dll.)') ? 'selected' : '' ?>>Dana Kegiatan Spesifik (KKN, KKL, dll.)</option>
                                <option value="Hasil Usaha & Unit Bisnis Universitas" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Hasil Usaha & Unit Bisnis Universitas') ? 'selected' : '' ?>>Hasil Usaha & Unit Bisnis Universitas</option>
                                <option value="Hasil Investasi Universitas" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Hasil Investasi Universitas') ? 'selected' : '' ?>>Hasil Investasi Universitas</option>
                                <option value="Anggaran Internal Universitas (APB-PTM)" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Anggaran Internal Universitas (APB-PTM)') ? 'selected' : '' ?>>Anggaran Internal Universitas (APB-PTM)</option>
                              </optgroup>
                              <optgroup label="II. Dana Eksternal (Filantropi & Kemitraan)">
                                <option value="Hibah Penelitian" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Hibah Penelitian') ? 'selected' : '' ?>>Hibah Penelitian</option>
                                <option value="Hibah Pengabdian kepada Masyarakat (PkM)" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Hibah Pengabdian kepada Masyarakat (PkM)') ? 'selected' : '' ?>>Hibah Pengabdian kepada Masyarakat (PkM)</option>
                                <option value="Hibah Kompetisi/Pengembangan Institusi" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Hibah Kompetisi/Pengembangan Institusi') ? 'selected' : '' ?>>Hibah Kompetisi/Pengembangan Institusi</option>
                                <option value="Sumbangan/Donasi (Individu, Alumni, Korporasi)" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Sumbangan/Donasi (Individu, Alumni, Korporasi)') ? 'selected' : '' ?>>Sumbangan/Donasi (Individu, Alumni, Korporasi)</option>
                                <option value="Corporate Social Responsibility (CSR)" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Corporate Social Responsibility (CSR)') ? 'selected' : '' ?>>Corporate Social Responsibility (CSR)</option>
                                <option value="Wakaf" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Wakaf') ? 'selected' : '' ?>>Wakaf</option>
                              </optgroup>
                              <optgroup label="III. Bantuan Pemerintah">
                                <option value="Bantuan Dana APBN" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Bantuan Dana APBN') ? 'selected' : '' ?>>Bantuan Dana APBN</option>
                                <option value="Bantuan Dana APBD" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Bantuan Dana APBD') ? 'selected' : '' ?>>Bantuan Dana APBD</option>
                              </optgroup>
                              <optgroup label="IV. Perolehan Non-Pembelian">
                                <option value="Pertukaran Aset (Ruilslag)" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Pertukaran Aset (Ruilslag)') ? 'selected' : '' ?>>Pertukaran Aset (Ruilslag)</option>
                                <option value="Hasil Lelang" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Hasil Lelang') ? 'selected' : '' ?>>Hasil Lelang</option>
                                <option value="Ketetapan Hukum/Peraturan" <?= (isset($sarana['sumber']) && $sarana['sumber'] == 'Ketetapan Hukum/Peraturan') ? 'selected' : '' ?>>Ketetapan Hukum/Peraturan</option>
                              </optgroup>
                            </select>
                            <span class="form-text">Pilih sumber perolehan sarana elektronik.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">

                          <div class="form-group">
                            <label for="biaya_pembelian" class="fw-bold">Biaya Pembelian</label>
                            <input type="number" class="form-control" id="biaya_pembelian" name="biaya_pembelian" placeholder="Contoh: 15000000 (tanpa titik/koma)" min="0" value="<?= htmlspecialchars($sarana['biaya_pembelian'] ?? '') ?>">
                            <span class="form-text">Masukkan harga per satuan barang dalam rupiah (tanpa titik/koma).</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">

                          <div class="form-group">
                            <label for="tanggal_pembelian" class="fw-bold">Tanggal Pembelian</label>
                            <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="<?= htmlspecialchars($sarana['tanggal_pembelian'] ?? '') ?>">
                            <span class="form-text">Masukkan tanggal pembelian barang jika diketahui.</span>
                          </div>
                        </div>
                      </div>



                      <!-- Status & Informasi Peminjaman (Hanya tampil saat edit) -->
                      <div class="col-12 mt-4">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            INFORMASI TAMBAHAN
                          </h5>
                          <span class="form-text">Isi informasi tambahan terkait barang, termasuk status dan lokasi.</span>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="status" class="fw-bold">Status <span class="text-danger">*</span></label>
                            <select class="form-control" id="status" name="status" required>
                              <option value="Tersedia" <?= (isset($sarana['status']) && $sarana['status'] == 'Tersedia') || !isset($sarana['status']) ? 'selected' : ''; ?>>Tersedia</option>
                              <option value="Terpakai" <?= (isset($sarana['status']) && $sarana['status'] == 'Terpakai') ? 'selected' : ''; ?>>Terpakai</option>
                              <option value="Dipinjam" <?= (isset($sarana['status']) && $sarana['status'] == 'Dipinjam') ? 'selected' : '' ?>>Dipinjam</option>
                            </select>
                            <span class="form-text">
                              Pilih status sarana saat ini.
                            </span>
                          </div>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="lokasi" class="fw-bold">Lokasi Penempatan Barang <span class="text-danger">*</span></label>
                            <select class="form-control select2-custom" id="lokasi" name="lokasi" required>
                              <option value="" <?= !isset($sarana['lokasi']) ? 'disabled selected' : 'disabled' ?>>
                                Pilih atau ketik lokasi barang
                              </option>
                              <optgroup label="Lapang">
                                <?php foreach ($lapangData as $itemLokasi) : ?>
                                  <option value="<?= htmlspecialchars($itemLokasi['nama_lapang']); ?>" <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $itemLokasi['nama_lapang'] ? 'selected' : '') ?>>
                                    <?= htmlspecialchars($itemLokasi['kode_lapang']); ?> - <?= htmlspecialchars($itemLokasi['nama_lapang']); ?>
                                  </option>
                                <?php endforeach; ?>
                              </optgroup>
                              <optgroup label="Ruang">
                                <?php foreach ($ruangData as $itemLokasi) : ?>
                                  <option value="<?= htmlspecialchars($itemLokasi['nama_ruang']); ?>" <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $itemLokasi['nama_ruang'] ? 'selected' : '') ?>>
                                    <?= htmlspecialchars($itemLokasi['kode_ruang']); ?> - <?= htmlspecialchars($itemLokasi['nama_ruang']); ?>
                                  </option>
                                <?php endforeach; ?>
                              </optgroup>
                            </select>
                          </div>
                          <span class="form-text">Pilih lokasi penempatan sarana saat ini.</span>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">

                          <div class="form-group">
                            <label for="keterangan" class="fw-bold">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                              placeholder="Tambahkan keterangan jika diperlukan (misal: kondisi garansi, catatan perbaikan, dll)"><?= htmlspecialchars($sarana['keterangan'] ?? '') ?></textarea>
                            <span class="form-text">Tambahkan catatan khusus tentang sarana ini jika ada.</span>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div> <!-- Penutup .row -->
                  <div class="card-footer">
                    <div class="text-right">
                      <?php
                      // Determine the correct back URL.
                      $backUrl = "/admin/sarana/elektronik"; // Default fallback to list page
                      if (isset($sarana['no_registrasi']) && !empty($sarana['no_registrasi'])) {
                        // If no_registrasi exists, link to detail page
                        $backUrl = "/admin/sarana/elektronik/detail/" . htmlspecialchars($sarana['no_registrasi']);
                      }
                      ?>
                      <a href="<?= $backUrl ?>" class="btn btn-secondary">
                        <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                      </a>
                      <button type="submit" class="btn btn-primary" id="submitBtn">
                        <i class="fas fa-save mr-2"></i> Simpan Perubahan
                      </button>
                    </div>
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
      // Inisialisasi Select2 untuk Jenis Barang Elektronik
      // dan Lokasi Penempatan Barang
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
        placeholder: "Pilih atau ketik jenis barang elektronik",
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
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });
    });
  </script>
</body>

</html>