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
            <?php if (!empty($_SESSION['success_message'])) : // Untuk pesan sukses 
            ?>
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
                  <?= isset($sarana) ? 'Edit Data Sarana ATK' : 'Formulir Data Sarana ATK' ?>
                </h1>
              </div>

              <form action="<?= isset($sarana) ? '/admin/sarana/atk?edit=' . htmlspecialchars($sarana['id']) : '/admin/sarana/atk/tambah' ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= htmlspecialchars($sarana['id'] ?? '') ?>">
                <input type="hidden" name="kategori_barang_id" value="3" id="kategori_barang_id"> <!-- ID Kategori ATK (sesuaikan jika beda) -->

                <div class="card-body">
                  <div class="row">
                    <!-- Data Identitas Sarana -->
                    <div class="col-12 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          IDENTITAS SARANA ATK
                        </h5>
                        <span class="form-text">Silahkan perbarui data identitas sarana ATK dengan lengkap.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Jenis Barang -->
                        <div class="form-group">
                          <label for="barang_id" class="fw-bold">Jenis Barang ATK <span class="text-danger">*</span></label>
                          <select class="form-control select2-custom" id="barang_id" name="barang_id" required>
                            <option value="" <?= !isset($sarana['barang_id']) ? 'disabled selected' : 'disabled' ?>>
                              Pilih atau ketik jenis barang ATK
                            </option>
                            <?php foreach ($barangList as $barang): ?>
                              <?php if ($barang['kategori_id'] == 3): ?>
                                <option value="<?= htmlspecialchars($barang['id']) ?>"
                                  <?= isset($sarana['barang_id']) && $sarana['barang_id'] == $barang['id'] ? 'selected' : ''; ?>>
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
                            placeholder="Contoh: Pensil Faber-Castell 2B, Kertas HVS A4 70gr" required
                            value="<?= htmlspecialchars($sarana['nama_detail_barang'] ?? '') ?>">
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
                            placeholder="Contoh: Faber-Castell, Sinar Dunia, Joyko"
                            value="<?= htmlspecialchars($sarana['merk'] ?? '') ?>">
                          <span class="form-text">Masukkan merk produk jika ada.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Spesifikasi -->
                        <div class="form-group">
                          <label for="spesifikasi" class="fw-bold">Spesifikasi</label>
                          <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                            placeholder="Masukkan spesifikasi (warna, ukuran, jenis bahan, ketebalan, dll)"><?= htmlspecialchars($sarana['spesifikasi'] ?? '') ?></textarea>
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
                            <option value="" disabled <?= !isset($sarana['kondisi_barang_id']) ? 'selected' : ''; ?>>Pilih Kondisi</option>
                            <?php foreach ($kondisiList as $kondisi): ?>
                              <option value="<?= htmlspecialchars($kondisi['id']) ?>" <?= isset($sarana['kondisi_barang_id']) && $sarana['kondisi_barang_id'] == $kondisi['id'] ? 'selected' : ''; ?>>
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
                              value="<?= htmlspecialchars($sarana['jumlah'] ?? '1') ?>"
                              min="1" required>
                            <div class="input-group-append">
                              <select class="form-control" id="satuan" name="satuan" required>
                                <option value="Buah" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Buah') || !isset($sarana['satuan']) ? 'selected' : '' ?>>Buah</option>
                                <option value="Unit" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Unit') ? 'selected' : '' ?>>Unit</option>
                                <option value="Pack" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Pack') ? 'selected' : '' ?>>Pack</option>
                                <option value="Rim" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Rim') ? 'selected' : '' ?>>Rim</option>
                                <option value="Lusin" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Lusin') ? 'selected' : '' ?>>Lusin</option>
                                <option value="Set" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Set') ? 'selected' : '' ?>>Set</option>
                              </select>
                            </div>
                          </div>
                          <span class="form-text">Masukkan jumlah barang dengan satuan yang sesuai.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Biaya Pembelian -->
                        <div class="form-group">
                          <label for="biaya_pembelian" class="fw-bold">Biaya Pembelian (Per Satuan)</label>
                          <input type="number" class="form-control" id="biaya_pembelian" name="biaya_pembelian"
                            placeholder="Contoh: 2500 (tanpa titik/koma)" min="0"
                            value="<?= htmlspecialchars($sarana['biaya_pembelian'] ?? '') ?>">
                          <span class="form-text">Masukkan harga per satuan barang dalam rupiah.</span>
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Tanggal Pembelian -->
                        <div class="form-group">
                          <label for="tanggal_pembelian" class="fw-bold">Tanggal Pembelian</label>
                          <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian"
                            value="<?= htmlspecialchars($sarana['tanggal_pembelian'] ?? '') ?>">
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
                            <option value="" disabled <?= !isset($sarana['lokasi']) || empty($sarana['lokasi']) ? 'selected' : '' ?>>Pilih atau ketik lokasi barang</option>
                            <optgroup label="Lapang">
                              <?php foreach ($lapangData as $lokasi_item) : ?>
                                <option value="<?= htmlspecialchars($lokasi_item['nama_lapang']); ?>" <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $lokasi_item['nama_lapang']) ? 'selected' : '' ?>>
                                  <?= htmlspecialchars($lokasi_item['kode_lapang']); ?> - <?= htmlspecialchars($lokasi_item['nama_lapang']); ?>
                                </option>
                              <?php endforeach; ?>
                            </optgroup>
                            <optgroup label="Ruang">
                              <?php foreach ($ruangData as $lokasi_item) : ?>
                                <option value="<?= htmlspecialchars($lokasi_item['nama_ruang']); ?>" <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $lokasi_item['nama_ruang']) ? 'selected' : '' ?>>
                                  <?= htmlspecialchars($lokasi_item['kode_ruang']); ?> - <?= htmlspecialchars($lokasi_item['nama_ruang']); ?>
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
                            placeholder="Tambahkan keterangan jika diperlukan (misal: stok minimal, tanggal kadaluarsa jika ada)"><?= htmlspecialchars($sarana['keterangan'] ?? '') ?></textarea>
                          <span class="form-text">Tambahkan catatan khusus tentang barang ini.</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> <!-- Penutup card-body -->

                <div class="card-footer text-right">
                  <a href="/admin/sarana/atk" class="btn btn-secondary"> <!-- Tombol kembali ke daftar ATK -->
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

  <!-- Initialize Select2 -->
  <script>
    $(document).ready(function() {
      // Inisialisasi Select2 Elements dengan tema Bootstrap 4
      // Ganti .select2bs4 menjadi .select2-custom agar sesuai dengan Mebeler
      $('.select2-custom').select2({
        theme: 'bootstrap4',
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%' // Tambahkan ini agar lebar konsisten
      });

      // Inisialisasi individual jika diperlukan placeholder berbeda (contoh dari Mebeler)
      $('#barang_id').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih atau ketik jenis barang ATK", // Disesuaikan untuk ATK
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });

      // Untuk #lokasi sudah dicakup oleh .select2-custom di atas jika placeholder di HTML sudah benar
      // Jika #kondisi_barang_id juga ingin Select2, bisa ditambahkan di sini:
      // $('#kondisi_barang_id').select2({ theme: 'bootstrap4', placeholder: "Pilih Kondisi", width: '100%' });
    });
  </script>

</body>

</html>