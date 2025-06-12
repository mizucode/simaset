<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include './app/Views/Components/navbar.php'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include './app/Views/Components/aside.php'; ?>
    <!-- /.sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-white py-4 mb-5 px-5">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; // For flash messages or other helpers 
            ?>
            <!-- Card: Grafik Prasarana -->
            <div class="card shadow-md">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Grafik Perbandingan Total Data Prasarana</h3>
                <button type="button" class="btn btn-tool ml-auto text-white" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <div class="card-body p-3">
                <div style="height: 400px;">
                  <canvas id="prasaranaChart"></canvas>
                </div>
              </div>
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col-12 -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </div>
    <!-- /.content-wrapper -->

    <!-- Footer -->
    <?php include './app/Views/Components/footer.php'; // Koreksi nama file dari foooter.php 
    ?>
    <!-- /.footer -->

  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <?php include './app/Views/Components/script.php'; ?>
  <!-- Pastikan script.php memuat jQuery, Bootstrap JS, dan AdminLTE JS -->
  <!-- ChartJS sudah di-include di script.php -->

  <script>
    $(function() {
      var prasaranaChartCanvas = $('#prasaranaChart').get(0).getContext('2d');
      var prasaranaChartData = JSON.parse('<?= $chartData; ?>');

      var prasaranaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: true,
          position: 'top'
        },
        scales: {
          xAxes: [{
            ticks: {
              fontColor: '#333'
            },
            gridLines: {
              display: false,
            }
          }],
          yAxes: [{
            ticks: {
              beginAtZero: true,
              stepSize: 1, // Sesuaikan jika perlu, agar tidak ada angka desimal jika totalnya kecil
              fontColor: '#333'
            },
            gridLines: {
              display: true,
              color: '#e3e3e3',
              drawBorder: false
            }
          }]
        },
        tooltips: {
          backgroundColor: "rgb(0,0,0)",
          bodyFontColor: "#fff",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
          callbacks: {
            label: function(tooltipItem, chart) {
              var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
              return datasetLabel + ': ' + tooltipItem.yLabel;
            }
          }
        }
      };

      new Chart(prasaranaChartCanvas, {
        type: 'bar', // Jenis grafik: bar, line, pie, dll.
        data: prasaranaChartData,
        options: prasaranaChartOptions
      });
    });
  </script>

  <script>
    // Script untuk menangani event klik pada tombol delete (jika ada modal delete)
    // Ini bisa dihapus jika tidak ada tombol delete di halaman ini lagi
    $(document).ready(function() {
      $(document).on('click', 'button[data-target="#deleteModal"]', function() {
        var id = $(this).data('id');
        // Pastikan path URL ini sesuai dengan route Anda jika ada tombol delete
        // var deleteUrl = '/admin/barang/jenis-barang?delete=' + id; 
        // $('#deleteButton').attr('href', deleteUrl); // Asumsi ada tombol dengan id="deleteButton" di modal
      });
    });
  </script>
</body>

</html>