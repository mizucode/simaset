<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-light p-4">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Dashboard</h1>

            </div>
            <div class="col-sm-6 text-right">
              <span class="badge badge-info"><?php echo date('l, d F Y'); ?></span>
            </div>
          </div>
        </div>
      </div>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <!-- Welcome Banner -->
          <div class="row mb-5">
            <div class="col-12">
              <div class="callout callout-info bg-gradient-navy">
                <div class="d-flex justify-content-between align-items-center">
                  <div>
                    <h5><i class="fas fa-user-circle mr-2"></i> Selamat Datang, <?php echo isset($_SESSION['user']['username']) ? htmlspecialchars($_SESSION['user']['username']) : 'Admin'; ?>!</h5>
                    <p class="mb-0">Semoga hari Anda menyenangkan. Berikut ringkasan aktivitas terbaru.</p>
                  </div>
                  <div class="text-right">
                    <span class="badge badge-light">Last login: <?php echo date('d/m/Y H:i'); ?></span>
                  </div>
                </div>
              </div>
            </div>
          </div>



          <div class="row">
            <div class="col-12">
              <div class="card shadow-sm mb-5">
                <div class="card-header bg-white py-3">
                  <h4 class="card-title mb-0 font-weight-bold">Ringkasan Aset</h4>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3 mb-lg-0">
                      <div class="info-box shadow-sm bg-white rounded-lg h-100">
                        <span class="info-box-icon bg-info elevation-1"><i class="fas fa-city"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total Prasarana</span>
                          <span class="info-box-number" style="font-size: 1.5rem;"><?= $totalPrasaranaData['total'] ?? '0'; ?></span>
                        </div>
                        <a href="/admin/laporan/total-data-prasarana" class="stretched-link" aria-label="Lihat Detail Prasarana"></a>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3 mb-lg-0">
                      <div class="info-box shadow-sm bg-white rounded-lg h-100">
                        <span class="info-box-icon bg-success elevation-1"><i class="fas fa-tools"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Total Sarana</span>
                          <span class="info-box-number" style="font-size: 1.5rem;"><?= $totalSaranaData['total'] ?? '0'; ?></span>
                        </div>
                        <a href="/admin/laporan/total-data-sarana" class="stretched-link" aria-label="Lihat Detail Sarana"></a>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3 mb-md-0">
                      <div class="info-box shadow-sm bg-white rounded-lg h-100">
                        <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-people-arrows text-white"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Barang Dipinjam</span>
                          <span class="info-box-number" style="font-size: 1.5rem;"><?= $totalSaranaDipinjam ?? '0'; ?></span>
                        </div>
                        <a href="/admin/laporan/barang-dipinjam" class="stretched-link" aria-label="Lihat Barang Dipinjam"></a>
                      </div>
                    </div>

                    <div class="col-lg-3 col-md-6 col-sm-12">
                      <div class="info-box shadow-sm bg-white rounded-lg h-100">
                        <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-exclamation-triangle"></i></span>
                        <div class="info-box-content">
                          <span class="info-box-text">Perlu Perhatian</span>
                          <span class="info-box-number" style="font-size: 1.5rem;"><?= $totalSaranaRusak ?? '0'; ?></span>
                        </div>
                        <a href="/admin/laporan/barang-rusak" class="stretched-link" aria-label="Lihat Barang Perlu Perhatian"></a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- Charts and Data Visualization Row -->
          <div class="row mt-4">
            <!-- Asset Distribution Chart -->
            <div class="col-lg-8">
              <div class="card shadow-sm">
                <div class="card-header bg-white">
                  <h3 class="card-title"><i class="fas fa-chart-pie mr-2 text-primary"></i>Distribusi Aset</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div class="chart">
                    <canvas id="distribusiAsetChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Asset Condition Chart -->
            <div class="col-lg-4">
              <div class="card shadow-sm">
                <div class="card-header bg-white">
                  <h3 class="card-title"><i class="fas fa-chart-bar mr-2 text-success"></i>Kondisi Aset</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="kondisiBarangPieChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Actions Section -->
          <div class="row mt-4">
            <div class="col-12">
              <div class="card shadow-sm">
                <div class="card-header bg-white">
                  <h3 class="card-title fw-bold">Tambah Data Barang (Barang Masuk)</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                      <a href="/admin/sarana/bergerak/tambah" class="btn btn-block btn-outline-primary btn-sm btn-action">
                        <i class="fas fa-truck-moving mb-1"></i><br>
                        Barang Bergerak
                      </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                      <a href="/admin/sarana/mebelair/tambah" class="btn btn-block btn-outline-purple btn-sm btn-action">
                        <i class="fas fa-chair mb-1"></i><br>
                        Barang Mebelair
                      </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                      <a href="/admin/sarana/atk/tambah" class="btn btn-block btn-outline-teal btn-sm btn-action">
                        <i class="fas fa-pencil-ruler mb-1"></i><br>
                        Barang ATK
                      </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                      <a href="/admin/sarana/elektronik/tambah" class="btn btn-block btn-outline-maroon btn-sm btn-action">
                        <i class="fas fa-plug mb-1"></i><br>
                        Barang Elektronik
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-12">
              <div class="card shadow-sm">
                <div class="card-header bg-white">
                  <h3 class="card-title fw-bold">Peminjaman Barang</h3>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                      <a href="/admin/sarana/bergerak/pinjam/tambah" class="btn btn-block btn-outline-primary btn-sm btn-action">
                        <i class="fas fa-truck-moving mb-1"></i><br>
                        Barang Bergerak
                      </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                      <a href="/admin/sarana/mebelair/pinjam/tambah" class="btn btn-block btn-outline-purple btn-sm btn-action">
                        <i class="fas fa-chair mb-1"></i><br>
                        Barang Mebelair
                      </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                      <a href="/admin/sarana/atk/pinjam/tambah" class="btn btn-block btn-outline-teal btn-sm btn-action">
                        <i class="fas fa-pencil-ruler mb-1"></i><br>
                        Barang ATK
                      </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12 mb-3">
                      <a href="/admin/sarana/elektronik/pinjam/tambah" class="btn btn-block btn-outline-maroon btn-sm btn-action">
                        <i class="fas fa-plug mb-1"></i><br>
                        Barang Elektronik
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Recent Activity and Calendar -->
          <div class="row mt-4">
            <!-- Recent Activity -->


            <!-- Calendar -->
            <div class="col-lg-12">
              <div class="card shadow-sm">
                <div class="card-header bg-white">
                  <h3 class="card-title"><i class="far fa-calendar-alt mr-2 text-danger"></i>Kalender</h3>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                      <i class="fas fa-minus"></i>
                    </button>
                  </div>
                </div>
                <div class="card-body">
                  <div id="calendar" style="min-height: 300px;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>

    <?php include './app/Views/Components/footer.php'; ?>
  </div>

  <?php include './app/Views/Components/script.php'; ?>
  <!-- FullCalendar JS -->
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js'></script>
  <script src='https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/locales-all.min.js'></script>

  <script>
    if (typeof Chart !== 'undefined') {
      // --- Kondisi Sarana Pie Chart ---
      var kondisiCanvas = document.getElementById('kondisiBarangPieChart');
      if (kondisiCanvas) {
        var kondisiData = {
          labels: [
            'Baik (<?= $kondisiAsetChartData['Baik'] ?? 0 ?>)',
            'Rusak Ringan (<?= $kondisiAsetChartData['Rusak Ringan'] ?? 0 ?>)',
            'Rusak Berat (<?= $kondisiAsetChartData['Rusak Berat'] ?? 0 ?>)',
            'Hilang (<?= $kondisiAsetChartData['Hilang'] ?? 0 ?>)'
          ],
          datasets: [{
            data: [
              <?= $kondisiAsetChartData['Baik'] ?? 0 ?>,
              <?= $kondisiAsetChartData['Rusak Ringan'] ?? 0 ?>,
              <?= $kondisiAsetChartData['Rusak Berat'] ?? 0 ?>,
              <?= $kondisiAsetChartData['Hilang'] ?? 0 ?>
            ],
            backgroundColor: ['#28a745', '#ffc107', '#dc3545', '#adb5bd'], // Adjusted Hilang color
            borderWidth: 1
          }]
        };
        var pieOptions = {
          maintainAspectRatio: false,
          responsive: true,
          plugins: {
            legend: {
              position: 'bottom',
              labels: {
                boxWidth: 12,
                padding: 20
              }
            }
          }
        };
        new Chart(kondisiCanvas.getContext('2d'), {
          type: 'doughnut',
          data: kondisiData,
          options: pieOptions
        });
      }

      // --- Distribusi Aset per Kategori Bar Chart ---
      var distribusiCanvas = document.getElementById('distribusiAsetChart');
      if (distribusiCanvas) {
        var distribusiData = {
          labels: ['Tanah', 'Gedung', 'Ruang', 'Lapang', 'S. Bergerak', 'S. Mebelair', 'S. ATK', 'S. Elektronik'],
          datasets: [{
            label: 'Jumlah Aset',
            backgroundColor: [
              'rgba(54, 162, 235, 0.7)', // Tanah
              'rgba(75, 192, 192, 0.7)', // Gedung
              'rgba(153, 102, 255, 0.7)', // Ruang
              'rgba(255, 159, 64, 0.7)', // Lapang
              'rgba(255, 99, 132, 0.7)', // S. Bergerak
              'rgba(255, 206, 86, 0.7)', // S. Mebelair
              'rgba(0, 204, 102, 0.7)', // S. ATK
              'rgba(201, 203, 207, 0.7)' // S. Elektronik
            ],
            borderColor: [
              'rgba(54, 162, 235, 1)',
              'rgba(75, 192, 192, 1)',
              'rgba(153, 102, 255, 1)',
              'rgba(255, 159, 64, 1)',
              'rgba(255, 99, 132, 1)',
              'rgba(255, 206, 86, 1)',
              'rgba(0, 204, 102, 1)',
              'rgba(201, 203, 207, 1)'
            ],
            borderWidth: 1, // Apply border to all bars
            pointRadius: false,
            pointColor: '#3b8bba',
            pointStrokeColor: 'rgba(60, 141, 188, 1)',
            pointHighlightFill: '#fff',
            pointHighlightStroke: 'rgba(60, 141, 188, 1)',
            data: [
              <?= $totalPrasaranaData['tanah'] ?? 0 ?>,
              <?= $totalPrasaranaData['gedung'] ?? 0 ?>,
              <?= $totalPrasaranaData['ruang'] ?? 0 ?>,
              <?= $totalPrasaranaData['lapang'] ?? 0 ?>,
              <?= $totalSaranaData['bergerak'] ?? 0 ?>,
              <?= $totalSaranaData['mebelair'] ?? 0 ?>,
              <?= $totalSaranaData['atk'] ?? 0 ?>,
              <?= $totalSaranaData['elektronik'] ?? 0 ?>
            ]
          }]
        };
        var barChartOptions = {
          responsive: true,
          maintainAspectRatio: false,
          scales: {
            y: {
              beginAtZero: true,
              grid: {
                display: true,
                color: "rgba(0, 0, 0, .05)"
              }
            },
            x: {
              grid: {
                display: false
              }
            }
          },
          plugins: {
            legend: {
              display: false
            }
          }
        };
        new Chart(distribusiCanvas.getContext('2d'), {
          type: 'bar',
          data: distribusiData,
          options: barChartOptions
        });
      }
    }

    // Inisialisasi FullCalendar
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
      if (calendarEl) {
        var calendar = new FullCalendar.Calendar(calendarEl, {
          initialView: 'dayGridMonth',
          locale: 'id',
          headerToolbar: {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay'
          },
          events: function(fetchInfo, successCallback, failureCallback) {
            fetch('https://api-harilibur.vercel.app/api')
              .then(response => response.json())
              .then(data => {
                let events = data.filter(item => item.is_national_holiday).map(function(item) {
                  return {
                    title: item.holiday_name,
                    start: item.holiday_date,
                    allDay: true,
                    backgroundColor: '#dc3545',
                    borderColor: '#dc3545'
                  };
                });

                // Add sample events for asset maintenance
                events.push({
                  title: 'Pemeliharaan Rutin',
                  start: new Date(),
                  backgroundColor: '#17a2b8',
                  borderColor: '#17a2b8'
                });

                successCallback(events);
              })
              .catch(error => failureCallback(error));
          },
          eventContent: function(arg) {
            return {
              html: '<div class="fc-event-main-frame">' +
                '<div class="fc-event-title-container">' +
                '<div class="fc-event-title fc-sticky">' + arg.event.title + '</div>' +
                '</div></div>'
            };
          }
        });
        calendar.render();
      }
    });
  </script>

  <style>
    .asset-summary-wrapper {
      /* Anda bisa menambahkan style spesifik di sini jika kelas bootstrap tidak cukup, 
         misalnya box-shadow yang lebih custom atau border.
         Untuk saat ini, bg-light, p-3, rounded-lg, dan mb-4 sudah cukup dari Bootstrap. */
    }

    .btn-action {
      padding: 1.5rem 0.5rem;
      transition: all 0.3s ease;
      border-radius: 8px;
    }

    .btn-action:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .btn-outline-purple {
      color: #6f42c1;
      border-color: #6f42c1;
    }

    .btn-outline-purple:hover {
      background-color: #6f42c1;
      color: white;
    }

    .btn-outline-teal {
      color: #20c997;
      border-color: #20c997;
    }

    .btn-outline-teal:hover {
      background-color: #20c997;
      color: white;
    }

    .btn-outline-maroon {
      color: #d63384;
      border-color: #d63384;
    }

    .btn-outline-maroon:hover {
      background-color: #d63384;
      color: white;
    }

    .info-box {
      transition: all 0.3s ease;
      border-radius: 8px;
    }

    .info-box:hover {
      transform: translateY(-3px);
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
    }

    .fc-event {
      cursor: pointer;
    }

    .products-list .item {
      border-bottom: 1px solid #f4f4f4;
      padding: 1rem 0;
    }

    .products-list .item:last-child {
      border-bottom: none;
    }
  </style>
</body>

</html>