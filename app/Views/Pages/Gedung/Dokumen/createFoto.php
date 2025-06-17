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
                <h3 class="card-title text-bold">
                  Tambah Dokumentasi Bangunan
                </h3>
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
                      <div class="py-4 px-4 mb-4 border rounded-md hidden">
                        <div class="form-group">
                          <label for="aset_gedung_id" class="fw-bold">Pilih Aset Bangunan</label>
                          <input type="text" class="form-control" id="aset_gedung_id" name="aset_gedung_id"
                            value="<?= htmlspecialchars($gedungData['id'] ?? '') ?>" readonly>
                        </div>
                      </div>
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="nama_dokumen" class="fw-bold">Nama Dokumentasi / Foto <span class="text-danger">*</span></label>
                          <input type="text" placeholder="Contoh: Foto Bangunan Bagian Depan" class="form-control" id="nama_dokumen" name="nama_dokumen" value="" required>
                          <span class="form-text">Masukkan nama untuk dokumentasi atau foto.</span>
                        </div>
                      </div>
                      <!-- Upload Gambar -->
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="path_dokumen" class="fw-bold">Upload Dokumentasi / Foto Bangunan <span class="text-danger">*</span></label>
                          <input type="file" class="form-control" id="path_dokumen" name="path_dokumen"
                            accept="image/jpeg, image/png, image/jpg, image/webp" required>
                          <span class="form-text">Format file: JPG, PNG, WEBP (maks. 5MB).</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer text-right">
                  <?php
                  // URL Kembali disesuaikan dengan detail gedung
                  $backUrl = "/admin/prasarana/gedung"; // Default fallback
                  if (isset($gedungData['id']) && !empty($gedungData['id'])) {
                    // Link ke halaman detail gedung menggunakan ID
                    $backUrl = "/admin/prasarana/gedung?detail=" . htmlspecialchars($gedungData['id']);
                  }
                  // Jika ada kode_gedung dan ingin menggunakan itu untuk URL detail:
                  // elseif (isset($gedungData['kode_gedung']) && !empty($gedungData['kode_gedung'])) {
                  //   $backUrl = "/admin/prasarana/gedung/detail/" . htmlspecialchars($gedungData['kode_gedung']);
                  // }
                  ?>
                  <a href="<?= $backUrl ?>" class="btn btn-secondary">
                    <i class="fas fa-arrow-alt-circle-left mr-2"></i> Kembali
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

  <script>
    document.getElementById('path_dokumen').addEventListener('change', function(e) {
      var fileName = e.target.files[0]?.name || 'Pilih file gambar';

      // Preview image before upload
      const previewContainer = e.target.closest('.form-group');
      let previewWrapper = previewContainer.querySelector('.image-preview');

      // Remove previous preview if exists
      if (previewWrapper) {
        previewWrapper.remove();
      }

      // Create new preview wrapper
      previewWrapper = document.createElement('div');
      previewWrapper.className = 'image-preview mt-3';
      previewWrapper.innerHTML = '<h6>Pratinjau Gambar:</h6>';

      const imgPreview = document.createElement('img');
      imgPreview.src = URL.createObjectURL(e.target.files[0]);
      imgPreview.style.maxWidth = '100%';
      imgPreview.style.maxHeight = '200px';
      imgPreview.className = 'img-thumbnail';

      previewWrapper.appendChild(imgPreview);
      previewContainer.appendChild(previewWrapper);
    });

    // Form validation
    document.querySelector('form').addEventListener('submit', function(e) {
      const fileInput = document.getElementById('path_dokumen');
      if (fileInput.files.length > 0) {
        const fileSize = fileInput.files[0].size / 1024 / 1024; // in MB
        if (fileSize > 5) {
          e.preventDefault();
          alert('Ukuran file terlalu besar. Maksimal 5MB.');
          return false;
        }

        const validTypes = ['image/jpeg', 'image/png', 'image/jpg', 'image/webp'];
        if (!validTypes.includes(fileInput.files[0].type)) {
          e.preventDefault();
          alert('Format file tidak didukung. Harap upload gambar JPG, PNG, atau WEBP.');
          return false;
        }
      }
      // If no file is selected, and it's required, the browser's `required` attribute will handle it.
      // If it's not required, or if a file is selected and passes validation, allow submission.
      return true;
    });
  </script>

</body>

</html>