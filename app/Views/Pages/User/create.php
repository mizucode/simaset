<!DOCTYPE html>
<html lang="id">
<?php require_once './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">
    <?php require_once './app/Views/Components/navbar.php'; ?>
    <?php require_once './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white mb-5 pt-3">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12 lg-12">
            <?php include './app/Views/Components/helper.php'; ?>
            <div class="card">
              <div class="card-header bg-navy mb-3">
                <h3 class="card-title text-bold">
                  TAMBAH USER
                </h3>
              </div>
              <form action="/admin/user/store" method="post">
                <div class="card-body">
                  <div class="row">
                    <div class="col-12">
                      <div class="col-12 border-bottom">
                        <div class="border-bottom pb-2 mb-3">
                          <h5 class="text-bold fs-4 text-navy">
                            IDENTITAS USER
                          </h5>
                          <span class="form-text">Silakan isi data user dengan lengkap.</span>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="username" class="fw-bold">Username <span class="text-danger">*</span></label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Masukkan username" required>
                            <span class="form-text">Username harus unik dan mudah diingat.</span>
                          </div>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="email" class="fw-bold">Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="Masukkan email aktif" required>
                            <span class="form-text">Pastikan email valid dan aktif.</span>
                          </div>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="password" class="fw-bold">Password <span class="text-danger">*</span></label>
                            <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan password" required>
                            <span class="form-text">Gunakan password yang kuat dan mudah diingat.</span>
                          </div>
                        </div>
                        <div class="py-4 px-4 mb-4 border rounded-md">
                          <div class="form-group">
                            <label for="role" class="fw-bold">Role <span class="text-danger">*</span></label>
                            <select name="role" id="role" class="form-control select2-custom" required>
                              <option value="" disabled selected>Pilih Role</option>
                              <option value="admin">Admin</option>
                              <option value="superadmin">Superadmin</option>
                            </select>
                            <span class="form-text">Pilih peran user sesuai kebutuhan akses.</span>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <div class="d-flex flex-column align-items-end flex-md-row justify-content-md-end">
                    <a href="/admin/user" class="btn btn-secondary mb-2 mb-md-0 mr-md-2 d-flex align-items-center">
                      <span><i class="fas fa-arrow-alt-circle-left mr-2"></i></span>Kembali
                    </a>
                    <button type="submit" class="btn btn-primary mb-2 mb-md-0" id="submitBtn">
                      <i class="fas fa-save mr-2"></i>
                      Simpan
                    </button>
                  </div>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php require_once './app/Views/Components/footer.php'; ?>
  </div>
  <?php require_once './app/Views/Components/script.php'; ?>
  <script>
    $(document).ready(function() {
      $('#role').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Role",
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });
    });
  </script>
</body>

</html>