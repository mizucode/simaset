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


            <div class="card bg-">
              <div class="card-header bg-navy mb-3">
                <h1 class="text-xl font-weight-bold">
                  <?= isset($sarana) ? 'EDIT DATA SARANA MEBELAIR' : 'FORMULIR TAMBAH DATA SARANA MEBELAIR' ?>
                </h1>
              </div>

              <form action="<?= isset($sarana) ? '/admin/sarana/mebelair/pindah?edit=' . htmlspecialchars($sarana['id']) : '/admin/sarana/mebelair/tambah' ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" id="id" value="<?= htmlspecialchars($sarana['id'] ?? '') ?>">
                <input type="hidden" name="kategori_barang_id" value="2" id="kategori_barang_id"> <!-- ID Kategori Mebelair -->

                <!-- Hidden fields from previously hidden sections -->
                <input type="hidden" name="barang_id" value="<?= htmlspecialchars($sarana['barang_id'] ?? '') ?>">
                <input type="hidden" name="merk" value="<?= htmlspecialchars($sarana['merk'] ?? '') ?>">
                <input type="hidden" name="bahan" value="<?= htmlspecialchars($sarana['bahan'] ?? '') ?>">
                <input type="hidden" name="spesifikasi" value="<?= htmlspecialchars($sarana['spesifikasi'] ?? '') ?>">
                <input type="hidden" name="kondisi_barang_id" value="<?= htmlspecialchars($sarana['kondisi_barang_id'] ?? '') ?>">
                <input type="hidden" name="sumber" value="<?= htmlspecialchars($sarana['sumber'] ?? '') ?>">
                <input type="hidden" name="jumlah" value="<?= htmlspecialchars($sarana['jumlah'] ?? '1') ?>">
                <input type="hidden" name="satuan" value="<?= htmlspecialchars($sarana['satuan'] ?? 'Unit') ?>">
                <input type="hidden" name="biaya_pembelian" value="<?= htmlspecialchars($sarana['biaya_pembelian'] ?? '') ?>">
                <input type="hidden" name="tanggal_pembelian" value="<?= htmlspecialchars($sarana['tanggal_pembelian'] ?? '') ?>">
                <input type="hidden" name="keterangan" value="<?= htmlspecialchars($sarana['keterangan'] ?? '') ?>">

                <div class="card-body">
                  <div class="row">
                    <!-- Bagian Identitas Sarana Mebelair -->
                    <div class="col-12 ">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          IDENTITAS SARANA MEBELAIR
                        </h5>
                        <span class="form-text">Silahkan isi data identitas sarana mebelair dengan lengkap.</span>
                      </div>

                      <!-- Jenis Barang Mebelair section removed as it's now a hidden input -->

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Nama Detail Barang -->
                        <div class="form-group">
                          <label for="nama_detail_barang" class="fw-bold">Nama Detail Barang <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-light"><i class="fas fa-tag text-primary"></i></span>
                            </div>
                            <input type="text" class="form-control" id="nama_detail_barang" name="nama_detail_barang" readonly
                              placeholder="Contoh: Meja Rapat Kayu Jati" required
                              value="<?= htmlspecialchars($sarana['nama_detail_barang'] ?? '') ?>">
                          </div>
                          <span class="form-text">Nama detail barang akan terisi otomatis.</span>
                        </div>
                      </div>
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="lokasi" class="fw-bold text-dark mb-2">Lokasi Penempatan Barang <span class="text-danger">*</span></label>
                          <div class="rounded-md d-flex align-items-stretch border bg-white select2-custom-wrapper">
                            <div class="input-group-prepend">
                              <span class="input-group-text border-0 bg-light">
                                <i class="fas fa-map-marker-alt text-primary"></i> <!-- Ikon Lokasi -->
                              </span>
                            </div>
                            <select class="form-control rounded border-0 select2-custom" id="lokasi" name="lokasi" required>
                              <optgroup label="Lapang">
                                <?php foreach ($lapangData as $itemLokasi) : ?>
                                  <option value="<?= htmlspecialchars($itemLokasi['nama_lapang']); ?>"
                                    <?= ($sarana['lokasi'] == $itemLokasi['nama_lapang']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($itemLokasi['kode_lapang']); ?> - <?= htmlspecialchars($itemLokasi['nama_lapang']); ?>
                                  </option>
                                <?php endforeach; ?>
                              </optgroup>
                              <optgroup label="Ruang">
                                <?php foreach ($ruangData as $itemLokasi) : ?>
                                  <option value="<?= htmlspecialchars($itemLokasi['nama_ruang']); ?>"
                                    <?= ($sarana['lokasi'] == $itemLokasi['nama_ruang']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($itemLokasi['kode_ruang']); ?> - <?= htmlspecialchars($itemLokasi['nama_ruang']); ?>
                                  </option>
                                <?php endforeach; ?>
                              </optgroup>
                            </select>
                          </div>
                          <span class="form-text text-muted mt-1">Pilih lokasi penempatan baru untuk sarana mebelair.</span>
                        </div>
                      </div>
                    </div>

                    <!-- Bagian Spesifikasi removed as its fields are now hidden inputs -->
                    <!-- Bagian Kondisi, Kuantitas, dan Pembelian removed as its fields are now hidden inputs -->

                  </div>
                </div> <!-- Penutup card-body -->
                <div class="card-footer text-right">
                  <a href="/admin/sarana/mebelair/pindah" class="btn btn-secondary"> <!-- Tombol kembali ke daftar Mebelair Pindah -->
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
      // Select2 for Jenis Barang Mebelair removed as the field is now hidden.

      $('#lokasi').select2({
        placeholder: "Pilih atau ketik lokasi barang",
        allowClear: false,
        minimumResultsForSearch: 1,
      });

      // Fungsi generateNoRegistrasi dan panggilannya dihapus karena 
      // field 'barang_id' tidak lagi interaktif dan 'no_registrasi' tidak ada di form ini.
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

    /* .card-footer { background-color: #f8f9fa; border-top: 1px solid #dee2e6; } */
  </style>

</body>

</html>