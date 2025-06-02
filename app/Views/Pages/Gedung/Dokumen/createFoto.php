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
                  <span aria-hidden="true">&times;</span>
                </button>
                <?= htmlspecialchars($error); ?>
              </div>
            <?php endif; ?>

            <div class="card bg-">
              <div class="card-header bg-navy mb-3">
                <h1 class="text-xl font-weight-bold">
                  Tambah Dokumentasi Bangunan
                </h1>
              </div>

              <form action="/admin/prasarana/gedung?tambah-gambar=<?= $gedungData['id'] ?? '' ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          DATA DOKUMENTASI BANGUNAN
                        </h5>
                        <span class="form-text">Silahkan isi data dokumentasi bangunan dengan lengkap.</span>
                      </div>

                      <!-- Aset Gedung -->
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="aset_gedung_id" class="fw-bold">Pilih Aset Bangunan</label>
                          <div class="input-group">
                            <input type="text" class="form-control" id="aset_gedung_id" name="aset_gedung_id"
                              value="<?= htmlspecialchars($gedungData['id'] ?? '') ?>" readonly>
                          </div>
                        </div>
                      </div>
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="nama_dokumen" class="fw-bold">Nama Dokumentasi / Foto <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <input type="text" placeholder="Contoh: Foto Bangunan Bagian Depan" class="form-control" id="nama_dokumen" name="nama_dokumen" value="" required>
                          </div>
                          <span class="form-text">Masukkan nama untuk dokumentasi atau foto.</span>
                        </div>
                      </div>
                      <!-- Upload Dokumen -->
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="path_dokumen" class="fw-bold">Upload Dokumentasi / Foto Bangunan <span class="text-danger">*</span></label>
                          <div class="input-group">
                            <input type="file" class="form-control" id="path_dokumen" name="path_dokumen"
                              accept="image/jpeg, image/png, image/jpg" required>
                          </div>
                          <span class="form-text">Format file: JPG, PNG (maks. 5MB).</span>
                        </div>
                        <div class="input-group">
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="card-footer text-right">
                    <a href="/admin/prasarana/gedung?detail=<?= htmlspecialchars($gedungData['id'] ?? '') ?>" class="btn btn-secondary">
                      <i class="fas fa-arrow-alt-circle-left mr-2"></i>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary" id="submitBtn">
                      <i class="fas fa-save mr-2"></i>
                      Simpan Dokumentasi Bangunan
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

</body>

</html>