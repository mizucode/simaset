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
            <div class="card shadow-md">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Audit Login</h3>
              </div>
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th>ID</th>
                        <th>Username</th>
                        <th>IP Address</th>
                        <th>User Agent</th>
                        <th>Aktivitas</th>
                        <th>Waktu</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($logs as $log): ?>
                        <tr>
                          <td class="text-center"><?= htmlspecialchars($log['id']) ?></td>
                          <td><?= htmlspecialchars($log['username']) ?></td>
                          <td><?= htmlspecialchars($log['ip_address']) ?></td>
                          <td><?= htmlspecialchars($log['user_agent']) ?></td>
                          <td class="text-center"><?= htmlspecialchars($log['aktivitas']) ?></td>
                          <td class="text-center"><?= htmlspecialchars($log['waktu']) ?></td>
                        </tr>
                      <?php endforeach; ?>
                    </tbody>
                  </table>
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
</body>

</html>