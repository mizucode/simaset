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
        $isSaranaOpen = false;
        foreach ($saranaBasePaths as $basePath) {
          if (strpos($currentUrl, $basePath) === 0) {
            $isSaranaOpen = true;
            break;
          }
        }
        ?>
        <li class="nav-item has-treeview <?= $isSaranaOpen ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $isSaranaOpen ? 'active' : '' ?>">
            <i class="nav-icon fas fa-tools me-2"></i>
            <p>
              Sarana
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="<?= $isSaranaOpen ? 'display: block;' : '' ?>">
            <li class="nav-item">
              <a href="/admin/sarana/bergerak" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/bergerak') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-truck-moving me-2"></i>
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/mebelair" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/mebelair') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-chair me-2"></i>
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/atk" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/atk') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-pencil-ruler me-2"></i>
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/elektronik" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/elektronik') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-plug me-2"></i>
                <p>Elektronik</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- BARANG (Jika ini adalah header, Anda bisa tambahkan ikon seperti fas fa-archive) -->


        <!-- TRANSAKSI -->
        <li class="nav-header">TRANSAKSI</li>


        <?php
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
        ?>
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
        <?php
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
        ?>
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
              <a href="/admin/sarana/bergerak/pinjam" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/bergerak/pinjam') === 0) ? 'active' : '' ?>">
                <i class="fas fa-truck nav-icon me-2"></i> <!-- Icon untuk barang bergerak -->
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/mebelair/pinjam" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/mebelair/pinjam') === 0) ? 'active' : '' ?>">
                <i class="fas fa-couch nav-icon me-2"></i> <!-- Icon untuk mebelair -->
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/atk/pinjam" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/atk/pinjam') === 0) ? 'active' : '' ?>">
                <i class="fas fa-pen-nib nav-icon me-2"></i> <!-- Icon yang lebih representatif untuk ATK -->
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/elektronik/pinjam" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/elektronik/pinjam') === 0) ? 'active' : '' ?>">
                <i class="fas fa-tv nav-icon me-2"></i> <!-- Icon yang lebih jelas untuk elektronik -->
                <p>Elektronik</p>
              </a>
            </li>
          </ul>
        </li>
        <?php
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
        ?>
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

        <?php
        $pemindahanBasePaths = [ // Assuming these are for "Pindah Barang" rather than "Survey Sarana" based on paths
          '/admin/sarana/bergerak/pindah',
          '/admin/sarana/mebelair/pindah',
          '/admin/sarana/atk/pindah',
          '/admin/sarana/elektronik/pindah'
        ];
        $isPemindahanOpen = false; // This variable is used for the "Survey Sarana" menu item in the original code.
        foreach ($pemindahanBasePaths as $basePath) {
          if (strpos($currentUrl, $basePath) === 0) {
            $isPemindahanOpen = true;
            break;
          }
        }
        ?>
        <li class="nav-item has-treeview <?= $isPemindahanOpen ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $isPemindahanOpen ? 'active' : '' ?>">
            <i class="nav-icon fas fa-truck-loading me-2"></i> <!-- atau fas fa-people-arrows -->
            <p>
              Survey Sarana
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="<?= $isPemindahanOpen ? 'display: block;' : '' ?>">
            <li class="nav-item">
              <a href="/admin/sarana/bergerak/pindah" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/bergerak/pindah') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-truck-moving me-2"></i>
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/mebelair/pindah" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/mebelair/pindah') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-chair me-2"></i>
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/atk/pindah" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/atk/pindah') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-pencil-ruler me-2"></i>
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/elektronik/pindah" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/elektronik/pindah') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-plug me-2"></i>
                <p>Elektronik</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">MASTER BARANG</li>
        <?php
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
        <li class="nav-item has-treeview <?= $isKondisiOpen ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $isKondisiOpen ? 'active' : '' ?>">
            <i class="nav-icon fas fa-clipboard-check me-2"></i> <!-- atau fas fa-shield-alt -->
            <p>
              Kondisi Barang
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="<?= $isKondisiOpen ? 'display: block;' : '' ?>">
            <li class="nav-item">
              <a href="/admin/sarana/bergerak/kondisi" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/bergerak/kondisi') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-truck-moving me-2"></i>
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/mebelair/kondisi" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/mebelair/kondisi') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-chair me-2"></i>
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/atk/kondisi" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/atk/kondisi') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-pencil-ruler me-2"></i>
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/elektronik/kondisi" class="nav-link <?= (strpos($currentUrl, '/admin/sarana/elektronik/kondisi') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-plug me-2"></i>
                <p>Elektronik</p>
              </a>
            </li>
          </ul>
        </li>
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
          '/admin/survey/sarana/sarana-bergerak',
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
              <a href="/admin/survey/sarana/sarana-bergerak" class="nav-link <?= (strpos($currentUrl, '/admin/survey/sarana/sarana-bergerak') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-truck-moving me-2"></i>
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/survey/sarana/sarana-mebelair" class="nav-link <?= (strpos($currentUrl, '/admin/survey/sarana/sarana-mebelair') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-chair me-2"></i>
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/survey/sarana/sarana-atk" class="nav-link <?= (strpos($currentUrl, '/admin/survey/sarana/sarana-atk') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-pencil-ruler me-2"></i>
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/survey/sarana/sarana-elektronik" class="nav-link <?= (strpos($currentUrl, '/admin/survey/sarana/sarana-elektronik') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-plug me-2"></i>
                <p>Elektronik</p>
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
          '/admin/laporan/barang-dipinjam',
          '/admin/laporan/barang-rusak'
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
              <a href="/admin/laporan/barang-dipinjam" class="nav-link <?= (strpos($currentUrl, '/admin/laporan/barang-dipinjam') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-handshake me-2"></i>
                <p>Total Data Peminjaman Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/laporan/barang-rusak" class="nav-link <?= (strpos($currentUrl, '/admin/laporan/barang-rusak') === 0) ? 'active' : '' ?>">
                <i class="nav-icon fas fa-handshake me-2"></i>
                <p>Data Barang Rusak</p>
              </a>
            </li>
          </ul>
        </li>

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

</aside>