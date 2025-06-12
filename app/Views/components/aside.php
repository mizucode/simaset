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
        <?php $isPrasaranaOpen = in_array($currentUrl, ['/admin/prasarana/tanah', '/admin/prasarana/gedung', '/admin/prasarana/ruang', '/admin/prasarana/lapang']); ?>
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
              <a href="/admin/prasarana/tanah" class="nav-link <?= ($currentUrl == '/admin/prasarana/tanah') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-map-marked-alt me-2"></i>
                <p>Tanah</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/prasarana/gedung" class="nav-link <?= ($currentUrl == '/admin/prasarana/gedung') ? 'active' : '' ?>">
                <i class="nav-icon far fa-building me-2"></i>
                <p>Bangunan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/prasarana/ruang" class="nav-link <?= ($currentUrl == '/admin/prasarana/ruang') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-door-open me-2"></i>
                <p>Ruangan</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/prasarana/lapang" class="nav-link <?= ($currentUrl == '/admin/prasarana/lapang') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-draw-polygon me-2"></i>
                <p>Lapang</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- Sarana -->
        <?php $isSaranaOpen = in_array($currentUrl, ['/admin/sarana/bergerak', '/admin/sarana/mebelair', '/admin/sarana/atk', '/admin/sarana/elektronik']); ?>
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
              <a href="/admin/sarana/bergerak" class="nav-link <?= ($currentUrl == '/admin/sarana/bergerak') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-truck-moving me-2"></i>
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/mebelair" class="nav-link <?= ($currentUrl == '/admin/sarana/mebelair') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-chair me-2"></i>
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/atk" class="nav-link <?= ($currentUrl == '/admin/sarana/atk') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-pencil-ruler me-2"></i>
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/elektronik" class="nav-link <?= ($currentUrl == '/admin/sarana/elektronik') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-plug me-2"></i>
                <p>Elektronik</p>
              </a>
            </li>
          </ul>
        </li>
        <!-- BARANG (Jika ini adalah header, Anda bisa tambahkan ikon seperti fas fa-archive) -->


        <!-- TRANSAKSI -->
        <li class="nav-header">TRANSAKSI</li>


        <?php $isBarangMasukOpen = in_array($currentUrl, ['/admin/sarana/bergerak/tambah', '/admin/sarana/mebelair/tambah', '/admin/sarana/atk/tambah', '/admin/sarana/elektronik/tambah']); ?>
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
              <a href="/admin/sarana/bergerak/tambah" class="nav-link <?= ($currentUrl == '/admin/sarana/bergerak/tambah') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-truck-moving me-2"></i>
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/mebelair/tambah" class="nav-link <?= ($currentUrl == '/admin/sarana/mebelair/tambah') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-chair me-2"></i>
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/atk/tambah" class="nav-link <?= ($currentUrl == '/admin/sarana/atk/tambah') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-pencil-ruler me-2"></i>
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/elektronik/tambah" class="nav-link <?= ($currentUrl == '/admin/sarana/elektronik/tambah') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-plug me-2"></i>
                <p>Elektronik</p>
              </a>
            </li>
          </ul>
        </li>
        <?php $isPeminjamanOpen = in_array($currentUrl, ['/admin/sarana/bergerak/pinjam', '/admin/sarana/mebelair/pinjam', '/admin/sarana/atk/pinjam', '/admin/sarana/elektronik/pinjam']); ?>
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
              <a href="/admin/sarana/bergerak/pinjam" class="nav-link <?= ($currentUrl == '/admin/sarana/bergerak/pinjam') ? 'active' : '' ?>">
                <i class="fas fa-truck nav-icon me-2"></i> <!-- Icon untuk barang bergerak -->
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/mebelair/pinjam" class="nav-link <?= ($currentUrl == '/admin/sarana/mebelair/pinjam') ? 'active' : '' ?>">
                <i class="fas fa-couch nav-icon me-2"></i> <!-- Icon untuk mebelair -->
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/atk/pinjam" class="nav-link <?= ($currentUrl == '/admin/sarana/atk/pinjam') ? 'active' : '' ?>">
                <i class="fas fa-pen-nib nav-icon me-2"></i> <!-- Icon yang lebih representatif untuk ATK -->
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/elektronik/pinjam" class="nav-link <?= ($currentUrl == '/admin/sarana/elektronik/pinjam') ? 'active' : '' ?>">
                <i class="fas fa-tv nav-icon me-2"></i> <!-- Icon yang lebih jelas untuk elektronik -->
                <p>Elektronik</p>
              </a>
            </li>
          </ul>
        </li>
        <?php $isPengembalianOpen = in_array($currentUrl, ['/admin/sarana/bergerak/kembali', '/admin/sarana/mebelair/kembali', '/admin/sarana/atk/kembali', '/admin/sarana/elektronik/kembali']); ?>
        <li class="nav-item has-treeview <?= $isPengembalianOpen ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $isPengembalianOpen ? 'active' : '' ?>">
            <i class="nav-icon fas fa-people-arrows me-2"></i> <!-- Icon utama untuk menu -->
            <p>
              Pengembalian <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="<?= $isPengembalianOpen ? 'display: block;' : '' ?>">
            <li class="nav-item">
              <a href="/admin/sarana/bergerak/kembali" class="nav-link <?= ($currentUrl == '/admin/sarana/bergerak/kembali') ? 'active' : '' ?>">
                <i class="fas fa-truck nav-icon me-2"></i> <!-- Icon untuk barang bergerak -->
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/mebelair/kembali" class="nav-link <?= ($currentUrl == '/admin/sarana/mebelair/kembali') ? 'active' : '' ?>">
                <i class="fas fa-couch nav-icon me-2"></i> <!-- Icon untuk mebelair -->
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/atk/kembali" class="nav-link <?= ($currentUrl == '/admin/sarana/atk/kembali') ? 'active' : '' ?>">
                <i class="fas fa-pen-nib nav-icon me-2"></i> <!-- Icon yang lebih representatif untuk ATK -->
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/elektronik/kembali" class="nav-link <?= ($currentUrl == '/admin/sarana/elektronik/kembali') ? 'active' : '' ?>">
                <i class="fas fa-tv nav-icon me-2"></i> <!-- Icon yang lebih jelas untuk elektronik -->
                <p>Elektronik</p>
              </a>
            </li>
          </ul>
        </li>

        <?php $isPemindahanOpen = in_array($currentUrl, ['/admin/sarana/bergerak/pindah', '/admin/sarana/mebelair/pindah', '/admin/sarana/atk/pindah', '/admin/sarana/elektronik/pindah']); ?>
        <li class="nav-item has-treeview <?= $isPemindahanOpen ? 'menu-open' : '' ?>">
          <a href="#" class="nav-link <?= $isPemindahanOpen ? 'active' : '' ?>">
            <i class="nav-icon fas fa-truck-loading me-2"></i> <!-- atau fas fa-people-arrows -->
            <p>
              Pemindahan Barang
              <i class="fas fa-angle-left right"></i>
            </p>
          </a>
          <ul class="nav nav-treeview" style="<?= $isPemindahanOpen ? 'display: block;' : '' ?>">
            <li class="nav-item">
              <a href="/admin/sarana/bergerak/pindah" class="nav-link <?= ($currentUrl == '/admin/sarana/bergerak/pindah') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-truck-moving me-2"></i>
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/mebelair/pindah" class="nav-link <?= ($currentUrl == '/admin/sarana/mebelair/pindah') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-chair me-2"></i>
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/atk/pindah" class="nav-link <?= ($currentUrl == '/admin/sarana/atk/pindah') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-pencil-ruler me-2"></i>
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/elektronik/pindah" class="nav-link <?= ($currentUrl == '/admin/sarana/elektronik/pindah') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-plug me-2"></i>
                <p>Elektronik</p>
              </a>
            </li>
          </ul>
        </li>

        <li class="nav-header">MASTER BARANG</li>
        <?php $isKondisiOpen = in_array($currentUrl, ['/admin/sarana/bergerak/kondisi', '/admin/sarana/mebelair/kondisi', '/admin/sarana/atk/kondisi', '/admin/sarana/elektronik/kondisi']); ?>
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
              <a href="/admin/sarana/bergerak/kondisi" class="nav-link <?= ($currentUrl == '/admin/sarana/bergerak/kondisi') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-truck-moving me-2"></i>
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/mebelair/kondisi" class="nav-link <?= ($currentUrl == '/admin/sarana/mebelair/kondisi') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-chair me-2"></i>
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/atk/kondisi" class="nav-link <?= ($currentUrl == '/admin/sarana/atk/kondisi') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-pencil-ruler me-2"></i>
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/sarana/elektronik/kondisi" class="nav-link <?= ($currentUrl == '/admin/sarana/elektronik/kondisi') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-plug me-2"></i>
                <p>Elektronik</p>
              </a>
            </li>
          </ul>
        </li>
        <?php $isPengaturanBarangOpen = in_array($currentUrl, ['/admin/barang/jenis-barang']); ?>
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
              <a href="/admin/barang/jenis-barang" class="nav-link <?= ($currentUrl == '/admin/barang/jenis-barang') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-tags me-2"></i> <!-- atau fas fa-sitemap -->
                <p>Jenis Barang</p>
              </a>
            </li>
          </ul>
        </li>
        <li class="nav-header">SURVEY</li>
        <?php $isSurveySaranaOpen = in_array($currentUrl, ['/admin/survey/sarana/sarana-bergerak', '/admin/survey/sarana/sarana-mebelair', '/admin/survey/sarana/sarana-atk', '/admin/survey/sarana/sarana-elektronik']); ?>
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
              <a href="/admin/survey/sarana/sarana-bergerak" class="nav-link <?= ($currentUrl == '/admin/survey/sarana/sarana-bergerak') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-truck-moving me-2"></i>
                <p>Bergerak</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/survey/sarana/sarana-mebelair" class="nav-link <?= ($currentUrl == '/admin/survey/sarana/sarana-mebelair') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-chair me-2"></i>
                <p>Mebelair</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/survey/sarana/sarana-atk" class="nav-link <?= ($currentUrl == '/admin/survey/sarana/sarana-atk') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-pencil-ruler me-2"></i>
                <p>Alat Tulis Kantor</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/survey/sarana/sarana-elektronik" class="nav-link <?= ($currentUrl == '/admin/survey/sarana/sarana-elektronik') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-plug me-2"></i>
                <p>Elektronik</p>
              </a>
            </li>
          </ul>
        </li>

        <!-- LAPORAN -->
        <li class="nav-header">LAPORAN</li>

        <?php $isLaporanOpen = in_array($currentUrl, ['/admin/laporan/total-data-prasarana', '/admin/laporan/total-data-sarana', '/admin/laporan/barang-dipinjam', '/admin/laporan/barang-rusak']); ?>
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
              <a href="/admin/laporan/total-data-prasarana" class="nav-link <?= ($currentUrl == '/admin/laporan/total-data-prasarana') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-landmark me-2"></i>
                <p>Total Data Prasarana</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/laporan/total-data-sarana" class="nav-link <?= ($currentUrl == '/admin/laporan/total-data-sarana') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-boxes me-2"></i>
                <p>Total Data Sarana</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/laporan/barang-dipinjam" class="nav-link <?= ($currentUrl == '/admin/laporan/barang-dipinjam') ? 'active' : '' ?>">
                <i class="nav-icon fas fa-handshake me-2"></i>
                <p>Total Data Peminjaman Barang</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="/admin/laporan/barang-rusak" class="nav-link <?= ($currentUrl == '/admin/laporan/barang-rusak') ? 'active' : '' ?>">
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