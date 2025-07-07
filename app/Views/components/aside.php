<?php
$currentUrl = strtok($_SERVER["REQUEST_URI"], '?'); // Mengambil path URL saat ini, tanpa query parameters
?>
<aside class="main-sidebar sidebar-light-primary elevation-4">

  <!-- Brand Logo -->
  <a href="#" class="brand-link bg-navy">
    <img src="/img/favicon.png"
      alt="AdminLTE Logo"
      class="brand-image">
    <span class="brand-text font-weight-bold">Inventori Barang</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- User panel -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="info">
        <a href="#" class="d-block">
          <?php
          echo isset($_SESSION['user']['username']) ? htmlspecialchars($_SESSION['user']['username']) : 'Administrator';
          ?>
        </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <?php
      // Pre-calculate active states for transactional/functional menus
      // This helps in determining if the main "Sarana" menu should be active

      // Tambahkan Barang
      $barangMasukBasePaths = [
        '/admin/sarana/bergerak/tambah',
        '/admin/sarana/mebelair/tambah',
        '/admin/sarana/atk/tambah',
        '/admin/sarana/elektronik/tambah'
      ];
      $isBarangMasukOpen = false;
      foreach ($barangMasukBasePaths as $basePath) {
        if (strpos($currentUrl, $basePath) === 0) {
          $isBarangMasukOpen = true;
          break;
        }
      }

      // Peminjaman
      $peminjamanBasePaths = [
        '/admin/sarana/bergerak/pinjam',
        '/admin/sarana/mebelair/pinjam',
        '/admin/sarana/atk/pinjam',
        '/admin/sarana/elektronik/pinjam'
      ];
      $isPeminjamanOpen = false;
      foreach ($peminjamanBasePaths as $basePath) {
        if (strpos($currentUrl, $basePath) === 0) {
          $isPeminjamanOpen = true;
          break;
        }
      }

      // Pengembalian
      $pengembalianBasePaths = [
        '/admin/sarana/bergerak/kembali',
        '/admin/sarana/mebelair/kembali',
        '/admin/sarana/atk/kembali',
        '/admin/sarana/elektronik/kembali'
      ];
      $isPengembalianOpen = false;
      foreach ($pengembalianBasePaths as $basePath) {
        if (strpos($currentUrl, $basePath) === 0) {
          $isPengembalianOpen = true;
          break;
        }
      }

      // Survey Sarana (Pindah Barang paths)
      $pemindahanBasePaths = [
        '/admin/sarana/bergerak/pindah',
        '/admin/sarana/mebelair/pindah',
        '/admin/sarana/atk/pindah',
        '/admin/sarana/elektronik/pindah'
      ];
      $isPemindahanOpen = false; // Used for "Survey Sarana" menu item that links to /pindah
      foreach ($pemindahanBasePaths as $basePath) {
        if (strpos($currentUrl, $basePath) === 0) {
          $isPemindahanOpen = true;
          break;
        }
      }

      // Kondisi Barang
      $kondisiBasePaths = [
        '/admin/sarana/bergerak/kondisi',
        '/admin/sarana/mebelair/kondisi',
        '/admin/sarana/atk/kondisi',
        '/admin/sarana/elektronik/kondisi'
      ];
      $isKondisiOpen = false;
      foreach ($kondisiBasePaths as $basePath) {
        if (strpos($currentUrl, $basePath) === 0) {
          $isKondisiOpen = true;
          break;
        }
      }
      ?>
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- LAYANAN -->
        <li class="nav-header">LAYANAN</li>
        <li class="nav-item">
          <a href="/admin" class="nav-link <?= ($currentUrl == '/admin') ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tachometer-alt me-2"></i>
            <p>Dashboard</p>
          </a>
        </li>

        <!-- Prasarana -->
        <?php
        $prasaranaBasePaths = [
          '/admin/prasarana/tanah',
          '/admin/prasarana/gedung',
          '/admin/prasarana/ruang',
          '/admin/prasarana/lapang'
        ];
        $isPrasaranaOpen = false;
        foreach ($prasaranaBasePaths as $basePath) {
          if (strpos($currentUrl, $basePath) === 0) {
            $isPrasaranaOpen = true;
            break;
          }
        }
        ?>
        <li class="nav-item has-treeview <?= $isPrasaranaOpen ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $isPrasaranaOpen ? 'active' : '' ?>">
            <i class="nav-icon fas fa-building me-2"></i>
            <p>
              Prasarana
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="<?= $isPrasaranaOpen ? 'display: block;' : '' ?>">
            <li class="nav-item">
              <a href="/admin/prasarana/tanah" class="nav-link <?= (strpos($currentUrl, '/admin/prasarana/tanah') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-map-marked-alt me-2"></i>
                <p>Tanah</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/prasarana/gedung" class="nav-link <?= (strpos($currentUrl, '/admin/prasarana/gedung') === 0) ? 'active' : '' ?>">
                <i class="nav-icon far fa-building me-2"></i>
                <p>Bangunan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/prasarana/ruang" class="nav-link <?= (strpos($currentUrl, '/admin/prasarana/ruang') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-door-open me-2"></i>
                <p>Ruangan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/prasarana/lapang" class="nav-link <?= (strpos($currentUrl, '/admin/prasarana/lapang') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-draw-polygon me-2"></i>
                <p>Lapang</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Sarana -->
        <?php
        $saranaBasePaths = [
          '/admin/sarana/bergerak',
          '/admin/sarana/mebelair',
          '/admin/sarana/atk',
          '/admin/sarana/elektronik'
        ];
        // Sarana hanya terbuka jika tidak sedang di menu transaksi
        $isSaranaTreeviewOpen = false;
        foreach ($saranaBasePaths as $basePath) {
          if (strpos($currentUrl, $basePath) === 0 && !$isBarangMasukOpen && !$isPeminjamanOpen && !$isPengembalianOpen && !$isPemindahanOpen && !$isKondisiOpen) {
            $isSaranaTreeviewOpen = true;
            break;
          }
        }
        $isSaranaLinkActive = $isSaranaTreeviewOpen;
        ?>
        <li class="nav-item has-treeview <?= $isSaranaTreeviewOpen ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $isSaranaLinkActive ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tools me-2"></i>
            <p>
              Sarana
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="<?= $isSaranaTreeviewOpen ? 'display: block;' : '' ?>">
            <?php
            $isSaranaBergerakActive = (strpos($currentUrl, '/admin/sarana/bergerak') === 0) && !$isBarangMasukOpen && !$isPeminjamanOpen && !$isPengembalianOpen && !$isPemindahanOpen && !$isKondisiOpen;
            $isSaranaMebelairActive = (strpos($currentUrl, '/admin/sarana/mebelair') === 0) && !$isBarangMasukOpen && !$isPeminjamanOpen && !$isPengembalianOpen && !$isPemindahanOpen && !$isKondisiOpen;
            $isSaranaAtkActive = (strpos($currentUrl, '/admin/sarana/atk') === 0) && !$isBarangMasukOpen && !$isPeminjamanOpen && !$isPengembalianOpen && !$isPemindahanOpen && !$isKondisiOpen;
            $isSaranaElektronikActive = (strpos($currentUrl, '/admin/sarana/elektronik') === 0) && !$isBarangMasukOpen && !$isPeminjamanOpen && !$isPengembalianOpen && !$isPemindahanOpen && !$isKondisiOpen;
            ?>
            <li class="nav-item">
              <a href="/admin/sarana/bergerak" class="nav-link <?= $isSaranaBergerakActive ? 'active' : '' ?>">
                <i class="nav-icon fas fa-truck-moving me-2"></i>
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/mebelair" class="nav-link <?= $isSaranaMebelairActive ? 'active' : '' ?>">
                <i class="nav-icon fas fa-chair me-2"></i>
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/atk" class="nav-link <?= $isSaranaAtkActive ? 'active' : '' ?>">
                <i class="nav-icon fas fa-pencil-ruler me-2"></i>
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/elektronik" class="nav-link <?= $isSaranaElektronikActive ? 'active' : '' ?>">
                <i class="nav-icon fas fa-plug me-2"></i>
                <p>Elektronik</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- BARANG (Jika ini adalah header, Anda bisa tambahkan ikon seperti fas fa-archive) -->


        <!-- TRANSAKSI -->
        <li class="nav-header">TRANSAKSI</li>


        <li class="nav-item has-treeview <?= $isBarangMasukOpen ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $isBarangMasukOpen ? 'active' : '' ?>">
            <i class="nav-icon fas fa-cart-plus me-2"></i> <!-- atau fas fa-plus-square -->
            <p>
              Tambahkan Barang
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="<?= $isBarangMasukOpen ? 'display: block;' : '' ?>">
            <li class="nav-item">
              <a href="/admin/sarana/bergerak/tambah" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/bergerak/tambah') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-truck-moving me-2"></i>
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/mebelair/tambah" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/mebelair/tambah') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-chair me-2"></i>
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/atk/tambah" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/atk/tambah') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-pencil-ruler me-2"></i>
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/elektronik/tambah" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/elektronik/tambah') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-plug me-2"></i>
                <p>Elektronik</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview <?= $isPeminjamanOpen ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $isPeminjamanOpen ? 'active' : '' ?>">
            <i class="nav-icon fas fa-people-arrows me-2"></i> <!-- Icon utama untuk menu -->
            <p>
              Peminjaman
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="<?= $isPeminjamanOpen ? 'display: block;' : '' ?>">
            <li class="nav-item">
              <a href="/admin/sarana/bergerak/pinjam" class="nav-link <?= ($currentUrl === '/admin/sarana/bergerak/pinjam') ? 'active' : '' ?>">
                <i class="fas fa-truck nav-icon me-2"></i> <!-- Icon untuk barang bergerak -->
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/mebelair/pinjam" class="nav-link <?= ($currentUrl === '/admin/sarana/mebelair/pinjam') ? 'active' : '' ?>">
                <i class="fas fa-couch nav-icon me-2"></i> <!-- Icon untuk mebelair -->
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/atk/pinjam" class="nav-link <?= ($currentUrl === '/admin/sarana/atk/pinjam') ? 'active' : '' ?>">
                <i class="fas fa-pen-nib nav-icon me-2"></i> <!-- Icon yang lebih representatif untuk ATK -->
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/elektronik/pinjam" class="nav-link <?= ($currentUrl === '/admin/sarana/elektronik/pinjam') ? 'active' : '' ?>">
                <i class="fas fa-tv nav-icon me-2"></i> <!-- Icon yang lebih jelas untuk elektronik -->
                <p>Elektronik</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-item has-treeview <?= $isPengembalianOpen ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $isPengembalianOpen ? 'active' : '' ?>">
            <i class="nav-icon fas fa-people-arrows me-2"></i> <!-- Icon utama untuk menu -->
            <p>
              Pengembalian <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="<?= $isPengembalianOpen ? 'display: block;' : '' ?>">
            <li class="nav-item">
              <a href="/admin/sarana/bergerak/kembali" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/bergerak/kembali') === 0) ? 'active' : '' ?>">
                <i class="fas fa-truck nav-icon me-2"></i> <!-- Icon untuk barang bergerak -->
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/mebelair/kembali" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/mebelair/kembali') === 0) ? 'active' : '' ?>">
                <i class="fas fa-couch nav-icon me-2"></i> <!-- Icon untuk mebelair -->
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/atk/kembali" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/atk/kembali') === 0) ? 'active' : '' ?>">
                <i class="fas fa-pen-nib nav-icon me-2"></i> <!-- Icon yang lebih representatif untuk ATK -->
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/elektronik/kembali" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/elektronik/kembali') === 0) ? 'active' : '' ?>">
                <i class="fas fa-tv nav-icon me-2"></i> <!-- Icon yang lebih jelas untuk elektronik -->
                <p>Elektronik</p>
              </a>
            </li>
          </ul>
        </li>


        <li class="nav-header">MASTER BARANG</li>

        <?php
        $pengaturanBarangBasePaths = [
          '/admin/barang/jenis-barang'
        ];
        $isPengaturanBarangOpen = false;
        foreach ($pengaturanBarangBasePaths as $basePath) {
          if (strpos($currentUrl, $basePath) === 0) {
            $isPengaturanBarangOpen = true;
            break;
          }
        }
        ?>
        <li class="nav-item has-treeview <?= $isPengaturanBarangOpen ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $isPengaturanBarangOpen ? 'active' : '' ?>">
            <i class="nav-icon fas fa-cogs me-2"></i>
            <p>
              Pengaturan Barang
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="<?= $isPengaturanBarangOpen ? 'display: block;' : '' ?>">
            <li class="nav-item">
              <a href="/admin/barang/jenis-barang" class="nav-link <?= (strpos($currentUrl, '/admin/barang/jenis-barang') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tags me-2"></i> <!-- atau fas fa-sitemap -->
                <p>Jenis Barang</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">SURVEY</li>
        <?php
        $surveySaranaBasePaths = [
          '/admin/survey/sarana/survey-barang',
          '/admin/survey/sarana/sarana-mebelair',
          '/admin/survey/sarana/sarana-atk',
          '/admin/survey/sarana/sarana-elektronik'
        ];
        $isSurveySaranaOpen = false;
        foreach ($surveySaranaBasePaths as $basePath) {
          if (strpos($currentUrl, $basePath) === 0) {
            $isSurveySaranaOpen = true;
            break;
          }
        }
        ?>
        <li class="nav-item has-treeview <?= $isSurveySaranaOpen ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $isSurveySaranaOpen ? 'active' : '' ?>">
            <i class="nav-icon fas fa-clipboard-check me-2"></i> <!-- atau fas fa-shield-alt -->
            <p>
              Survey Sarana
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="<?= $isSurveySaranaOpen ? 'display: block;' : '' ?>">
            <li class="nav-item">
              <a href="/admin/survey/sarana/survey-barang" class="nav-link <?= (strpos($currentUrl, '/admin/survey/sarana/survey-barang') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-truck-moving me-2"></i>
                <p>Sarana</p>
              </a>
            </li>

          </ul>
        </li>
        <!-- LAPORAN -->
        <li class="nav-header">LAPORAN</li>
        <?php
        $laporanBasePaths = [
          '/admin/laporan/total-data-prasarana',
          '/admin/laporan/total-data-sarana',
          '/admin/laporan/riwayat-peminjaman',
          '/admin/laporan/kondisi-barang',
          '/admin/laporan/kondisi-ruangan',
          '/admin/laporan/riwayat-pengembalian'
        ];
        $isLaporanOpen = false;
        foreach ($laporanBasePaths as $basePath) {
          if (strpos($currentUrl, $basePath) === 0) {
            $isLaporanOpen = true;
            break;
          }
        }
        ?>
        <li class="nav-item has-treeview <?= $isLaporanOpen ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $isLaporanOpen ? 'active' : '' ?>">
            <i class="nav-icon fas fa-file-alt me-2"></i> <!-- atau fas fa-chart-bar -->
            <p>
              Laporan
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="<?= $isLaporanOpen ? 'display: block;' : '' ?>">
            <li class="nav-item">
              <a href="/admin/laporan/total-data-prasarana" class="nav-link <?= (strpos($currentUrl, '/admin/laporan/total-data-prasarana') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-landmark me-2"></i>
                <p>Total Data Prasarana</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/laporan/total-data-sarana" class="nav-link <?= (strpos($currentUrl, '/admin/laporan/total-data-sarana') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-boxes me-2"></i>
                <p>Total Data Sarana</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/laporan/kondisi-barang" class="nav-link <?= (strpos($currentUrl, '/admin/laporan/kondisi-barang') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-handshake me-2"></i>
                <p>Kondisi Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/laporan/kondisi-ruangan" class="nav-link <?= (strpos($currentUrl, '/admin/laporan/kondisi-ruangan') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-building me-2"></i>
                <p>Kondisi Ruangan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/laporan/riwayat-peminjaman" class="nav-link <?= (strpos($currentUrl, '/admin/laporan/riwayat-peminjaman') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-handshake me-2"></i>
                <p>Riwayat Peminjaman</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/laporan/riwayat-pengembalian" class="nav-link <?= (strpos($currentUrl, '/admin/laporan/riwayat-pengembalian') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-handshake me-2"></i>
                <p>Riwayat Pengembalian</p>
              </a>
            </li>

          </ul>
        </li>
        <?php if (isset($_SESSION['user']['role']) && $_SESSION['user']['role'] === 'superadmin'): ?>
          <li class="nav-header">PENGATURAN</li>
          <li class="nav-item has-treeview <?= (strpos($currentUrl, '/admin/user') === 0) ? 'menu-open' : '' ?>">
            <a href="#" class="nav-link <?= (strpos($currentUrl, '/admin/user') === 0) ? 'active' : '' ?>">
              <i class="nav-icon fas fa-users-cog me-2"></i>
              <p>
                Pengaturan User
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview" style="<?= (strpos($currentUrl, '/admin/user') === 0) ? 'display: block;' : '' ?>">
              <li class="nav-item">
                <a href="/admin/user" class="nav-link <?= ($currentUrl == '/admin/user') ? 'active' : '' ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manajemen User</p>
                </a>
              </li>
              <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'superadmin'): ?>
                <li class="nav-item">
                  <a href="/admin/user/audit-login" class="nav-link <?= ($currentUrl == '/admin/user/audit-login') ? 'active' : '' ?>">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Audit Login</p>
                  </a>
                </li>
              <?php endif; ?>
            </ul>
          </li>
        <?php endif; ?>
        <!-- Logout -->
        <li class="nav-item mb-5">
          <a href="/logout" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt me-2"></i> <!-- Icon ini sudah pas -->
            <p>Log Out</p>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</aside>