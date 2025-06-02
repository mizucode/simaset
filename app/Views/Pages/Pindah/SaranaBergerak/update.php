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

            <?php if (isset($_SESSION['update'])) : ?>
              <div class="alert alert-success alert-dismissible fade show mb-4">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">×</span>
                </button>
                <?= htmlspecialchars($_SESSION['update']); ?>
              </div>
              <?php unset($_SESSION['update']); ?>
            <?php endif; ?>

            <div class="card bg-"> <!-- Class bg- disamakan dengan ATK, meskipun ATK tidak ada class ini, ini dari template awal Bergerak -->
              <div class="card-header bg-navy mb-3">
                <h1 class="text-xl font-weight-bold">
                  EDIT DATA SARANA BERGERAK
                </h1>
              </div>

              <form action="/admin/sarana/bergerak/pindah?edit=<?= htmlspecialchars($sarana['id']) ?>" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?= htmlspecialchars($sarana['id']) ?>">
                <input type="hidden" name="kategori_barang_id" value="1" id="kategori_barang_id">

                <!-- Hidden fields from previously visible sections -->
                <input type="hidden" name="barang_id" value="<?= htmlspecialchars($sarana['barang_id'] ?? '') ?>">
                <input type="hidden" name="merk" value="<?= htmlspecialchars($sarana['merk'] ?? '') ?>">
                <input type="hidden" name="spesifikasi" value="<?= htmlspecialchars($sarana['spesifikasi'] ?? '') ?>">
                <input type="hidden" name="no_polisi" value="<?= htmlspecialchars($sarana['no_polisi'] ?? '') ?>">
                <input type="hidden" name="sumber" value="<?= htmlspecialchars($sarana['sumber'] ?? '') ?>">
                <input type="hidden" name="kondisi_barang_id" value="<?= htmlspecialchars($sarana['kondisi_barang_id'] ?? '') ?>">
                <input type="hidden" name="biaya_pembelian" value="<?= htmlspecialchars($sarana['biaya_pembelian'] ?? '') ?>">
                <input type="hidden" name="tanggal_pembelian" value="<?= htmlspecialchars($sarana['tanggal_pembelian'] ?? '') ?>">
                <input type="hidden" name="keterangan" value="<?= htmlspecialchars($sarana['keterangan'] ?? '') ?>">

                <div class="card-body">
                  <div class="row">
                    <!-- Bagian Identitas Sarana Bergerak -->
                    <div class="col-12 ">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          IDENTITAS SARANA BERGERAK
                        </h5>
                        <span class="form-text">Silahkan pastikan data sarana bergerak dan pilih lokasi pemindahan baru.</span>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <!-- Nama Detail Barang -->
                        <div class="form-group">
                          <label for="nama_detail_barang" class="fw-bold">Nama Detail Barang <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <div class="input-group-prepend">
                              <span class="input-group-text bg-light"><i class="fas fa-tag text-primary"></i></span>
                            </div>
                            <input type="text" readonly class="form-control" id="nama_detail_barang" name="nama_detail_barang"
                              placeholder="Contoh: Mobil Toyota Avanza" required
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
                                <i class="fas fa-map-marker-alt text-primary"></i>
                              </span>
                            </div>
                            <select class="form-control rounded border-0 select2-custom" id="lokasi" name="lokasi" required>
                              <optgroup label="Lapang">
                                <?php foreach ($lapangData as $lokasi_item) : ?>
                                  <option value="<?= htmlspecialchars($lokasi_item['nama_lapang']); ?>" <?= ($sarana['lokasi'] == $lokasi_item['nama_lapang']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($lokasi_item['kode_lapang']); ?> - <?= htmlspecialchars($lokasi_item['nama_lapang']); ?>
                                  </option>
                                <?php endforeach; ?>
                              </optgroup>
                              <optgroup label="Ruang">
                                <?php foreach ($ruangData as $lokasi_item) : ?>
                                  <option value="<?= htmlspecialchars($lokasi_item['nama_ruang']); ?>" <?= ($sarana['lokasi'] == $lokasi_item['nama_ruang']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($lokasi_item['kode_ruang']); ?> - <?= htmlspecialchars($lokasi_item['nama_ruang']); ?>
                                  </option>
                                <?php endforeach; ?>
                              </optgroup>
                            </select>
                          </div>
                          <span class="form-text text-muted mt-1">Pilih lokasi penempatan baru untuk sarana bergerak.</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div> <!-- Penutup card-body -->

                <div class="card-footer text-right">
                  <a href="/admin/sarana/bergerak/pindah" class="btn btn-secondary">
                    <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                  </a>
                  <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save mr-2"></i>
                    Update Data Sarana Bergerak
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
      // Select2 for Jenis Barang removed as the field is now hidden.

      $('#lokasi').select2({
        placeholder: "Pilih atau ketik lokasi barang",
        allowClear: false,
        minimumResultsForSearch: 1,
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

    /* .card-footer { background-color: #f8f9fa; border-top: 1px solid #dee2e6; } */
  </style>

</body>

</html>