<?php if (isset($_SESSION['success'])): ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
    <?= $_SESSION['success']; ?>
  </div>
  <?php unset($_SESSION['success']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['update'])): ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i>Berhasil!</h5>
    <?= $_SESSION['update']; ?>
  </div>
  <?php unset($_SESSION['update']); ?>
<?php endif; ?>

<?php if (isset($_SESSION['delete'])): ?>
  <div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    <h5><i class="icon fas fa-check"></i> Berhasil!</h5>
    <?= $_SESSION['delete']; ?>
  </div>
  <?php unset($_SESSION['delete']); ?>
<?php endif; ?>