<!DOCTYPE html>
<html lang="id">
<?php require_once './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php require_once './app/Views/Components/navbar.php'; ?>
    <?php require_once './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white py-4 mb-5 px-3">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>
            <div class="card shadow-md">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Manajemen User</h3>
                <a href="/admin/user/create" class="btn btn-primary btn-sm ml-auto">
                  <i class="fas fa-plus mr-1"></i> Tambah User
                </a>
              </div>
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th>ID</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($users as $user): ?>
                        <tr>
                          <td class="text-center"><?= htmlspecialchars($user['id']) ?></td>
                          <td><?= htmlspecialchars($user['username']) ?></td>
                          <td><?= htmlspecialchars($user['email']) ?></td>
                          <td class="text-center"><?= htmlspecialchars($user['role']) ?></td>
                          <td class="text-center">
                            <a href="/admin/user/edit/<?= $user['id'] ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="#" class="btn btn-danger btn-sm btn-delete-user" data-id="<?= $user['id'] ?>" data-username="<?= htmlspecialchars($user['username']) ?>">Hapus</a>
                          </td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
                </div>
                <!-- Modal Hapus User -->
                <div class="modal fade" id="modalHapusUser" tabindex="-1" aria-labelledby="modalHapusUserLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header bg-danger text-white">
                        <h5 class="modal-title" id="modalHapusUserLabel">Konfirmasi Hapus User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <p>Apakah Anda yakin ingin menghapus user <span class="font-weight-bold" id="hapusUsername"></span>?</p>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <a href="#" id="btnConfirmDeleteUser" class="btn btn-danger">Hapus</a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
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
      $(document).on('click', '.btn-delete-user', function(e) {
        e.preventDefault();
        var userId = $(this).data('id');
        var username = $(this).data('username');
        $('#hapusUsername').text(username);
        $('#btnConfirmDeleteUser').attr('href', '/admin/user/delete/' + userId);
        $('#modalHapusUser').modal('show');
      });
    });
  </script>
</body>

</html>