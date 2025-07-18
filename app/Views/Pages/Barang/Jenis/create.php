<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>
    <div class="content-wrapper bg-white mb-5 pt-3 px-4">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php if (!empty($_SESSION['error'])) : ?>
              <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <?= htmlspecialchars($_SESSION['error']); ?>
                <?php unset($_SESSION['error']); ?>
              </div>
            <?php endif; ?>
            <?php if (!empty($_SESSION['update'])) : ?>
              <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
                <?= htmlspecialchars($_SESSION['update']); ?>
                <?php unset($_SESSION['update']); ?>
              </div>
            <?php endif; ?>

            <div class="card">
              <div class="card-header bg-navy mb-3 text-white">
                <h3 class="card-title text-bold">
                  Formulir Data Jenis Barang
                </h3>
              </div>

              <form action="/admin/barang/jenis-barang/tambah" method="POST">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <!-- Identitas Jenis Barang Section -->
                      <div class="col-12 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            IDENTITAS JENIS BARANG
                          </h5>
                          <span class="form-text">Silahkan isi data identitas jenis barang dengan lengkap.</span>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="kode_barang" class="fw-bold">Kode Barang <span class="text-danger">*</span></label>
                            <div class="input-group"> <!-- Menggunakan input-group untuk ikon -->
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-barcode text-primary"></i></span>
                              </div>
                              <input type="text" class="form-control" id="kode_barang" name="kode_barang"
                                placeholder="Contoh: LMR, LPT, MJA" required maxlength="3">
                            </div>
                            <span class=" form-text">Masukkan kode unik untuk jenis barang. Maksimal 3 karakter.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="nama_barang" class="fw-bold">Nama Jenis Barang <span class="text-danger">*</span></label>
                            <div class="input-group"> <!-- Menggunakan input-group untuk ikon -->
                              <div class="input-group-prepend">
                                <span class="input-group-text bg-light"><i class="fas fa-box text-primary"></i></span>
                              </div>
                              <input type="text" class="form-control" id="nama_barang" name="nama_barang"
                                placeholder="Contoh: Lemari, Laptop, Meja" required maxlength="100">
                            </div>
                            <span class=" form-text">Masukkan nama deskriptif untuk jenis barang. Maksimal 100 karakter.</span>
                          </div>
                        </div>

                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="kategori_id" class="fw-bold">Kategori Barang <span class="text-danger">*</span></label>
                            <select class="form-control select2-custom" id="kategori_id" name="kategori_id" required>
                              <option value=""></option>
                              <?php foreach ($kategoriList as $kategori): ?>
                                <option value="<?= htmlspecialchars($kategori['id']) ?>" <?= (isset($_POST['kategori_id']) && $_POST['kategori_id'] == $kategori['id']) ? 'selected' : '' ?>>
                                  <?= htmlspecialchars($kategori['nama_kategori']) ?>
                                </option>
                              <?php endforeach; ?>
                            </select>
                            <span class="form-text">Pilih kategori yang sesuai untuk jenis barang ini.</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="card-footer text-right">
                    <a href="/admin/barang/jenis-barang" class="btn btn-secondary">
                      <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                      <i class="fas fa-save mr-2"></i>
                      Simpan Data Jenis Barang
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
      $('#kategori_id').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Kategori Barang",
        allowClear: true, // Memungkinkan placeholder terlihat jika tidak ada yang dipilih
        minimumResultsForSearch: Infinity, // Sembunyikan kotak pencarian jika tidak banyak opsi
        width: '100%'
      });
    });
  </script>

</body>

</html>