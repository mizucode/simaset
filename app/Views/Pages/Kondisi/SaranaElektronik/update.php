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
              <div class="card-header bg-navy mb-3">
                <h1 class="text-xl font-weight-bold">
                  <!-- Judul dinamis berdasarkan mode (tambah/edit) -->
                  <?= isset($sarana) ? 'Edit Data Sarana Elektronik' : 'Formulir Data Sarana Elektronik' ?>
                  </h3>
              </div>

              <form action="<?= isset($sarana) ? '/admin/sarana/elektronik?edit=' . $sarana['id'] : '/admin/sarana/elektronik/tambah' ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= $sarana['id'] ?? '' ?>">
                <input type="hidden" name="kategori_barang_id" value="4" id="kategori_barang_id">

                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <!-- Section 1: IDENTITAS SARANA ELEKTRONIK -->
                      <div class="col-12 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            IDENTITAS SARANA ELEKTRONIK
                          </h5>
                          <span class="form-text">Silahkan periksa data identitas sarana elektronik.</span>
                        </div>

                        <!-- Barang -->
                        <div class="py-4 px-4 mb-4 border rounded-md hidden">
                          <div class="form-group">
                            <label for="barang_id" class="font-weight-bold">Jenis Barang Elektronik</label>
                            <div class="rounded-md d-flex align-items-stretch border bg-white select2-custom-wrapper">
                              <div class="input-group-prepend">
                                <span class="input-group-text border-0 bg-light">
                                  <i class="fas fa-desktop text-primary"></i>
                                </span>
                              </div>
                              <select class="form-control rounded border-0 select2-custom" id="barang_id" name="barang_id" required>
                                <option value="" <?= !isset($sarana['barang_id']) ? 'disabled selected' : 'disabled' ?>>
                                  Pilih atau ketik jenis barang elektronik
                                </option>
                                <?php foreach ($barangList as $barang): ?>
                                  <?php if ($barang['kategori_id'] == 4): ?>
                                    <option value="<?= htmlspecialchars($barang['id']) ?>"
                                      <?= isset($sarana['barang_id']) && $sarana['barang_id'] == $barang['id'] ? 'selected' : '' ?>>
                                      <?= htmlspecialchars($barang['nama_barang']) ?>
                                    </option>
                                  <?php endif; ?>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <span class="form-text text-muted mt-1">Pilih jenis barang elektronik dari daftar atau ketik untuk mencari.</span>
                          </div>
                        </div>
                        <!-- Nama Detail Barang -->
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="nama_detail_barang" class="font-weight-bold">Nama Detail Barang <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-tag text-primary"></i></span>
                              </div>
                              <input type="text" class="form-control" id="nama_detail_barang" name="nama_detail_barang"
                                placeholder="Contoh: Laptop Dell XPS 13, Proyektor Epson EB-S41" required readonly
                                value="<?= htmlspecialchars($sarana['nama_detail_barang'] ?? '') ?>">
                            </div>
                            <span class="form-text">Nama detail barang (readonly).</span>
                          </div>
                        </div>
                      </div>

                      <!-- Section 2: SPESIFIKASI -->
                      <div class="col-12 mt-4 border-bottom hidden">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            SPESIFIKASI
                          </h5>
                          <span class="form-text">Data spesifikasi sarana elektronik.</span>
                        </div>
                        <!-- Merk -->
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="merk" class="font-weight-bold">Merk</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-copyright text-primary"></i></span>
                              </div>
                              <input type="text" class="form-control" id="merk" name="merk"
                                placeholder="Contoh: Dell, Epson, Samsung, LG, dll"
                                value="<?= htmlspecialchars($sarana['merk'] ?? '') ?>">
                            </div>
                            <span class="form-text">Masukkan merk barang elektronik.</span>
                          </div>
                        </div>
                        <!-- Tipe -->
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="tipe" class="font-weight-bold">Tipe/Model</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-barcode text-primary"></i></span>
                              </div>
                              <input type="text" class="form-control" id="tipe" name="tipe"
                                placeholder="Contoh: XPS 13 9310, EB-S41, Galaxy S21"
                                value="<?= htmlspecialchars($sarana['tipe'] ?? '') ?>">
                            </div>
                            <span class="form-text">Masukkan tipe atau model barang.</span>
                          </div>
                        </div>
                        <!-- Spesifikasi -->
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="spesifikasi" class="font-weight-bold">Spesifikasi</label>
                            <textarea class="form-control" id="spesifikasi" name="spesifikasi" rows="3"
                              placeholder="Masukkan spesifikasi lengkap (RAM, Storage, Ukuran Layar, Resolusi, dll)"><?= htmlspecialchars($sarana['spesifikasi'] ?? '') ?></textarea>
                            <span class="form-text">Jelaskan spesifikasi detail barang.</span>
                          </div>
                        </div>
                      </div>

                      <!-- Section 3: KONDISI -->
                      <div class="col-12 mt-4 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            KONDISI
                          </h5>
                          <span class="form-text">Pilih kondisi sarana elektronik saat ini.</span>
                        </div>
                        <!-- Kondisi Barang -->
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="kondisi_barang_id" class="font-weight-bold">Kondisi Barang <span class="text-danger">*</span></label>
                            <div class="input-group"> <!-- Bisa juga dibuat Select2 jika opsinya banyak -->
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-clipboard-check text-primary"></i></span>
                              </div>
                              <select class="form-control" id="kondisi_barang_id" name="kondisi_barang_id" required>
                                <option value="" disabled <?= !isset($sarana['kondisi_barang_id']) ? 'selected' : '' ?>>Pilih Kondisi</option>
                                <?php foreach ($kondisiList as $kondisi): ?>
                                  <option value="<?= htmlspecialchars($kondisi['id']) ?>"
                                    <?= isset($sarana['kondisi_barang_id']) && $sarana['kondisi_barang_id'] == $kondisi['id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($kondisi['nama_kondisi']) ?>
                                  </option>
                                <?php endforeach; ?>
                              </select>
                            </div>
                            <span class="form-text">Pilih kondisi aktual barang.</span>
                          </div>
                        </div>
                        <!-- Jumlah -->
                        <div class="py-4 px-4 mb-4 border rounded-md hidden">
                          <div class="form-group">
                            <label for="jumlah" class="font-weight-bold">Jumlah <span class="text-danger">*</span></label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-calculator text-primary"></i></span>
                              </div>
                              <input type="number" class="form-control" id="jumlah" name="jumlah"
                                value="<?= htmlspecialchars($sarana['jumlah'] ?? '1') ?>" min="1" required>
                              <div class="input-group-append">
                                <select class="form-control" id="satuan" name="satuan" required>
                                  <option value="Unit" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Unit' ? 'selected' : (!isset($sarana['satuan']) ? 'selected' : '')) ?>>Unit</option>
                                  <option value="Buah" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Buah' ? 'selected' : '') ?>>Buah</option>
                                  <option value="Set" <?= (isset($sarana['satuan']) && $sarana['satuan'] == 'Set' ? 'selected' : '') ?>>Set</option>
                                </select>
                              </div>
                            </div>
                            <span class="form-text">Masukkan jumlah barang dan pilih satuannya.</span>
                          </div>
                        </div>
                        <!-- Biaya Pembelian -->
                        <div class="py-4 px-4 mb-4 border rounded-md hidden">
                          <div class="form-group">
                            <label for="biaya_pembelian" class="font-weight-bold">Biaya Pembelian</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-money-bill-wave text-primary"></i></span>
                              </div>
                              <input type="number" class="form-control" id="biaya_pembelian" name="biaya_pembelian"
                                placeholder="Contoh: 15000000 (tanpa titik/koma)" min="0"
                                value="<?= htmlspecialchars($sarana['biaya_pembelian'] ?? '') ?>">
                            </div>
                            <span class="form-text">Masukkan biaya pembelian per satuan barang (opsional).</span>
                          </div>
                        </div>
                        <!-- Tanggal Pembelian -->
                        <div class="py-4 px-4 mb-4 border rounded-md hidden">
                          <div class="form-group">
                            <label for="tanggal_pembelian" class="font-weight-bold">Tanggal Pembelian</label>
                            <div class="input-group">
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="far fa-calendar-alt text-primary"></i></span>
                              </div>
                              <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian"
                                value="<?= htmlspecialchars($sarana['tanggal_pembelian'] ?? '') ?>">
                            </div>
                            <span class="form-text">Masukkan tanggal pembelian barang (opsional).</span>
                          </div>
                        </div>
                      </div>

                      <!-- Section 4: LOKASI PEMINDAHAN -->
                      <div class="col-12 mt-4 hidden">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            LOKASI PEMINDAHAN
                          </h5>
                          <span class="form-text">Isi data lokasi dan keterangan tambahan.</span>
                        </div>
                        <!-- Lokasi Penempatan -->
                        <div class="py-4 px-4 mb-4 border rounded-md hidden">
                          <div class="form-group">
                            <label for="lokasi" class="font-weight-bold">Lokasi Penempatan Barang <span class="text-danger">*</span></label>
                            <div class="rounded-md d-flex align-items-stretch border bg-white select2-custom-wrapper">
                              <div class="input-group-prepend">
                                <span class="input-group-text border-0 bg-light">
                                  <i class="fas fa-map-marker-alt text-primary"></i>
                                </span>
                              </div>
                              <select class="form-control rounded border-0 select2-custom" id="lokasi" name="lokasi"> <!-- Removed required as section is hidden -->
                                <option value="" <?= !isset($sarana['lokasi']) ? 'disabled selected' : 'disabled' ?>>
                                  Pilih atau ketik lokasi barang
                                </option>
                                <optgroup label="Lapang">
                                  <?php foreach ($lapangData as $itemLokasi) : ?>
                                    <option value="<?= htmlspecialchars($itemLokasi['nama_lapang']); ?>"
                                      <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $itemLokasi['nama_lapang']) ? 'selected' : '' ?>>
                                      <?= htmlspecialchars($itemLokasi['kode_lapang']); ?> - <?= htmlspecialchars($itemLokasi['nama_lapang']); ?>
                                    </option>
                                  <?php endforeach; ?>
                                </optgroup>
                                <optgroup label="Ruang">
                                  <?php foreach ($ruangData as $itemLokasi) : ?>
                                    <option value="<?= htmlspecialchars($itemLokasi['nama_ruang']); ?>"
                                      <?= (isset($sarana['lokasi']) && $sarana['lokasi'] == $itemLokasi['nama_ruang']) ? 'selected' : '' ?>>
                                      <?= htmlspecialchars($itemLokasi['kode_ruang']); ?> - <?= htmlspecialchars($itemLokasi['nama_ruang']); ?>
                                    </option>
                                  <?php endforeach; ?>
                                </optgroup>
                              </select>
                            </div>
                            <span class="form-text text-muted mt-1">Pilih lokasi penempatan barang.</span>
                          </div>
                        </div>
                        <!-- Keterangan -->
                        <div class="py-4 px-4 mb-4 border rounded-md hidden">
                          <div class="form-group">
                            <label for="keterangan" class="font-weight-bold">Keterangan</label>
                            <textarea class="form-control" id="keterangan" name="keterangan" rows="2"
                              placeholder="Tambahkan keterangan jika diperlukan (misal: kondisi garansi, catatan perbaikan, dll)"><?= htmlspecialchars($sarana['keterangan'] ?? '') ?></textarea>
                            <span class="form-text">Tambahkan keterangan tambahan jika diperlukan.</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <a href="/admin/sarana/elektronik/kondisi" class="btn btn-secondary">
                      <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                      <i class="fas fa-save mr-2"></i>
                      <?= isset($sarana) ? 'Update Data Sarana Elektronik' : 'Simpan Data Sarana Elektronik' ?>
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
      // Inisialisasi Select2 untuk Jenis Barang Elektronik
      $('#barang_id').select2({
        placeholder: "Pilih atau ketik jenis barang elektronik",
        allowClear: false,
        minimumResultsForSearch: 1,
      });

      // Inisialisasi Select2 untuk Lokasi Penempatan Barang
      $('#lokasi').select2({
        placeholder: "Pilih atau ketik lokasi barang",
        allowClear: false,
        minimumResultsForSearch: 1,
      });

      // Opsional: Jika ingin Kondisi Barang juga menggunakan Select2
      // $('#kondisi_barang_id').select2({
      //     placeholder: "Pilih Kondisi",
      //     minimumResultsForSearch: Infinity // Menyembunyikan box pencarian jika tidak banyak opsi
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
      display: flex !important;
      align-items: center !important;
    }

    /* Pertimbangkan untuk membuat style card-footer konsisten (misalnya, tanpa text-white jika form lain tidak menggunakannya) */
    /* .card-footer { background-color: #f8f9fa; border-top: 1px solid #dee2e6; } */
  </style>
</body>

</html>