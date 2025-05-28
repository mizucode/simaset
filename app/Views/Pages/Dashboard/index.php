<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white px-5">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0" style="color: black;">DASHBOARD</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="/admin">Home</a></li>
                <li class="breadcrumb-item active">Dashboard</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
        </div><!-- /.container-fluid -->
      </div>
      <!-- /.content-header -->

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Info boxes -->
          <div class="row">

            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3><?= $totalPrasaranaData['total']; ?></h3> <!-- Example Data -->
                  <p>Total Prasarana</p>
                </div>
                <div class="icon">
                  <i class="fas fa-building"></i>
                </div>
                <a href="/admin/laporan/total-data-prasarana" class="small-box-footer">
                  Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <div class="col-12 col-sm-6 col-md-3">
              <div class="small-box bg-primary">
                <div class="inner">
                  <h3><?= $totalSaranaData['total']; ?></h3> <!-- Example Data -->
                  <p>Total Sarana</p>
                </div>
                <div class="icon">
                  <i class="fas fa-tools"></i>
                </div>
                <a href="/admin/sarana/bergerak" class="small-box-footer">
                  Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>50</h3> <!-- Example Data -->
                  <p>Barang Masuk</p>
                </div>
                <div class="icon">
                  <i class="fas fa-cart-plus"></i>
                </div>
                <a href="/admin/sarana/bergerak/tambah" class="small-box-footer"> <!-- Assuming this is the first link for adding -->
                  Lihat Detail <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="small-box bg-olive">
                <div class="inner">
                  <h3>4</h3> <!-- Example Data -->
                  <p>Survey</p>
                </div>
                <div class="icon">
                  <i class="fas fa-tags"></i>
                </div>
                <a href="/admin/barang/jenis-barang" class="small-box-footer">
                  Lihat Pengaturan <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
              <div class="small-box bg-olive">
                <div class="inner">
                  <h3>4</h3> <!-- Example Data -->
                  <p>Jenis Barang</p>
                </div>
                <div class="icon">
                  <i class="fas fa-tags"></i>
                </div>
                <a href="/admin/barang/jenis-barang" class="small-box-footer">
                  Lihat Pengaturan <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="small-box bg-teal">
                <div class="inner">
                  <h3>100</h3> <!-- Example Data -->
                  <p>Barang Kondisi Baik</p>
                </div>
                <div class="icon">
                  <i class="fas fa-check-circle"></i>
                </div>
                <a href="/admin/sarana/bergerak/kondisi" class="small-box-footer"> <!-- Link to one of the condition pages -->
                  Periksa Kondisi <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>18</h3> <!-- Example Data -->
                  <p>Barang Perlu Perbaikan</p>
                </div>
                <div class="icon">
                  <i class="fas fa-exclamation-triangle"></i>
                </div>
                <a href="/admin/sarana/elektronik/kondisi" class="small-box-footer"> <!-- Link to another condition page -->
                  Periksa Kondisi <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
              <div class="small-box bg-danger">
                <div class="inner">
                  <h3>2</h3> <!-- Example Data -->
                  <p>Laporan Barang Hilang</p>
                </div>
                <div class="icon">
                  <i class="fas fa-search-minus"></i> <!-- Or fas fa-bell -->
                </div>
                <a href="pages/forms/general.html" class="small-box-footer"> <!-- Link from your sidebar -->
                  Lihat Laporan <i class="fas fa-arrow-circle-right"></i>
                </a>
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->

          <!-- Quick Actions -->
          <div class="row mt-4">
            <div class="col-md-12">
              <div class="card card-outline card-primary">
                <div class="card-header">
                  <h3 class="card-title">Aksi Cepat</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-md-3 col-sm-6 col-12">
                      <a href="/admin/sarana/bergerak/tambah" class="btn btn-block btn-success btn-lg">
                        <i class="fas fa-plus-square mr-2"></i>Tambah Barang
                      </a>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                      <a href="/admin/sarana/bergerak/pindah" class="btn btn-block btn-info btn-lg">
                        <i class="fas fa-exchange-alt mr-2"></i>Pindahkan Barang
                      </a>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                      <a href="pages/forms/general.html" class="btn btn-block btn-danger btn-lg">
                        <i class="fas fa-file-invoice mr-2"></i>Laporan Kehilangan
                      </a>
                    </div>
                    <div class="col-md-3 col-sm-6 col-12">
                      <a href="/admin/survey/semesteran" class="btn btn-block btn-warning btn-lg">
                        <i class="fas fa-poll mr-2"></i>Survey Semesteran
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


        </div><!--/. container-fluid -->
      </section>
      <!-- /.content -->
    </div>


    <?php include './app/Views/Components/foooter.php'; ?>

  </div>
  <!-- ./wrapper -->
  <?php include './app/Views/Components/script.php'; // Make sure Chart.js script is loaded here 
  ?>

  <!-- OPTIONAL: Chart.js Script (Example for the placeholders) -->
  <script>
    // Make sure Chart.js is loaded before this script runs
    // You would typically include Chart.js CDN or local file in head.php or script.php
    if (typeof Chart !== 'undefined') {
      // --- Kondisi Barang Pie Chart ---
      var kondisiCanvas = document.getElementById('kondisiBarangPieChart');
      if (kondisiCanvas) {
        var kondisiData = {
          labels: [
            'Baik',
            'Rusak Ringan',
            'Rusak Berat',
            'Hilang'
          ],
          datasets: [{
            data: [70, 15, 10, 5], // Example data
            backgroundColor: ['#00a65a', '#f39c12', '#f56954', '#d2d6de'],
          }]
        };
        var pieOptions = {
          maintainAspectRatio: false,
          responsive: true,
        };
        new Chart(kondisiCanvas.getContext('2d'), {
          type: 'pie',
          data: kondisiData,
          options: pieOptions
        });
      }

      // --- Stok Kategori Bar Chart ---
      var stokCanvas = document.getElementById('stokKategoriBarChart');
      if (stokCanvas) {
        var stokData = {
          labels: ['Bergerak', 'Mebelair', 'ATK', 'Elektronik'],
          datasets: [{
            label: 'Jumlah Stok',
            backgroundColor: 'rgba(60,141,188,0.9)',
            borderColor: 'rgba(60,141,188,0.8)',
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60,141,188,1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60,141,188,1)',
            data: [65, 59, 80, 81] // Example data
          }]
        };
        var barChartOptions = {
          responsive: true,
          maintainAspectRatio: false,
          datasetFill: false,
          scales: {
            yAxes: [{
              ticks: {
                beginAtZero: true
              }
            }]
          }
        };
        new Chart(stokCanvas.getContext('2d'), {
          type: 'bar',
          data: stokData,
          options: barChartOptions
        });
      }
    } else {
      console.warn("Chart.js not loaded. Charts will not be rendered.");
    }
  </script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</body>

</html>