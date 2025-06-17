<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">

  <div class="wrapper">

    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>
    <div class="content-wrapper bg-white mb-5 pt-3  ">
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
                  Tambah Dokumentasi Tanah
                  </h1>
              </div>

              <form action="/admin/prasarana/tanah?tambah-gambar=<?= $tanahData['id'] ?? '' ?>" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12 border-bottom">
                      <div class="border-bottom pb-2 mb-3">
                        <h5 class="text-bold fs-4 text-navy">
                          DATA DOKUMENTASI TANAH
                        </h5>
                        <span class="form-text">Silahkan isi data dokumentasi tanah dengan lengkap.</span>
                      </div>

                      <!-- Aset Tanah - Hidden field for ID, consistent with BarangATK -->
                      <div class="py-4 px-4 mb-4 border rounded-md hidden">
                        <div class="form-group">
                          <label for="aset_tanah_id_display" class="fw-bold">Pilih Aset Tanah</label>
                          <input type="text" class="form-control" id="aset_tanah_id_display"
                            value="<?= htmlspecialchars($tanahData['nama_aset'] ?? $tanahData['id']) ?>" readonly>
                          <input type="hidden" name="aset_tanah_id" value="<?= htmlspecialchars($tanahData['id']) ?>">
                        </div>
                      </div>

                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="nama_dokumen" class="fw-bold">Nama Dokumentasi / Foto <span class="text-danger">*</span></label>
                          <input type="text" placeholder="Contoh: Foto Tanah Bagian Depan" class="form-control" id="nama_dokumen" name="nama_dokumen" value="" required>
                          <span class="form-text">Masukkan nama untuk dokumentasi atau foto.</span>
                        </div>
                      </div>
                      <!-- Upload Gambar -->
                      <div class="py-4 px-4 mb-4 border rounded-md">
                        <div class="form-group">
                          <label for="path_dokumen" class="fw-bold">Upload Dokumentasi / Foto Tanah <span class="text-danger">*</span></label>
                          <input type="file" class="form-control" id="path_dokumen" name="path_dokumen"
                            accept="image/jpeg, image/png, image/jpg, image/webp" required>
                          <span class="form-text">Format file: JPG, PNG, WEBP (maks. 5MB).</span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>

                <div class="card-footer text-right">
                  <a href="/admin/prasarana/tanah?detail=<?= htmlspecialchars($tanahData['id'] ?? '') ?>" class="btn btn-secondary">
                    <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                  </a>
                  <button type="submit" class="btn btn-primary" id="submitBtn">
                    <i class="fas fa-save mr-2"></i>
                    Simpan Dokumentasi Tanah
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
    // Update file input label (optional, browser usually shows the name)
    // and Preview image before upload
    document.getElementById('path_dokumen').addEventListener('change', function(e) {
      var fileName = e.target.files[0]?.name || 'Pilih file gambar';

      // Preview image
      const previewContainer = document.createElement('div');
      previewContainer.className = 'mt-3 image-preview-container'; // Added a container class
      previewContainer.innerHTML = '<h6>Pratinjau Gambar:</h6>';

      const imgPreview = document.createElement('img');
      imgPreview.src = URL.createObjectURL(e.target.files[0]);
      imgPreview.style.maxWidth = '100%';
      imgPreview.style.maxHeight = '200px';
      imgPreview.className = 'img-thumbnail';
      imgPreview.onload = () => URL.revokeObjectURL(imgPreview.src); // Free memory

      previewContainer.appendChild(imgPreview);

      // Remove previous preview if exists
      const oldPreviewContainer = e.target.closest('.form-group').querySelector('.image-preview-container');
      if (oldPreviewContainer) {
        oldPreviewContainer.remove();
      }
      e.target.closest('.form-group').appendChild(previewContainer);
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
        // Client-side type validation can be added here if desired,
        // but server-side validation is more crucial.
      }
      return true;
    });
  </script>

</body>

</html>