<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-light">
      <div class="content-header px-4">
        <div class="container-fluid">
          <div class="row align-items-center mb-4">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark d-flex align-items-center">
                <i class="fas fa-tachometer-alt mr-3 text-primary"></i>
                Dashboard
              </h1>
            </div>
            <div class="col-sm-6 text-right">
              <div class="badge badge-primary px-3 py-2 rounded-pill">
                <i class="far fa-calendar-alt mr-2"></i>
                <?php echo date('l, d F Y'); ?>
              </div>
            </div>
          </div>

          <!-- Welcome Card -->
          <div class="row mb-4">
            <div class="col-12">
              <div class="card bg-gradient-primary border-0 rounded-lg shadow-sm">
                <div class="card-body p-4">
                  <div class="d-flex justify-content-between align-items-center">
                    <div class="text-white">
                      <h4 class="mb-1">
                        <i class="fas fa-user-circle mr-2"></i>
                        Selamat Datang, <?php echo isset($_SESSION['user']['username']) ? htmlspecialchars($_SESSION['user']['username']) : 'Admin'; ?>!
                      </h4>
                      <p class="mb-0 opacity-75">Semoga hari Anda menyenangkan. Berikut ringkasan aktivitas terbaru.</p>
                    </div>
                    <div class="text-white opacity-75">
                      <small>
                        <i class="fas fa-clock mr-1"></i>
                        Last login: <?php echo date('d/m/Y H:i'); ?>
                      </small>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Stats -->
          <div class="row mb-4">
            <div class="col-lg-3 col-md-6 mb-4">
              <a href="<?= $linkLaporan['prasarana'] ?>" class="text-decoration-none">
                <div class="card border-0 rounded-lg shadow-hover h-100 transition-300">
                  <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                      <div class="icon-box bg-primary-light rounded-circle p-3 mr-3">
                        <i class="fas fa-city text-primary"></i>
                      </div>
                      <div>
                        <h6 class="mb-1 text-muted">Prasarana</h6>
                        <h3 class="mb-0 font-weight-bold"><?= $totalPrasaranaData['total'] ?? '0' ?></h3>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
              <a href="<?= $linkLaporan['sarana'] ?>" class="text-decoration-none">
                <div class="card border-0 rounded-lg shadow-hover h-100 transition-300">
                  <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                      <div class="icon-box bg-success-light rounded-circle p-3 mr-3">
                        <i class="fas fa-tools text-success"></i>
                      </div>
                      <div>
                        <h6 class="mb-1 text-muted">Sarana</h6>
                        <h3 class="mb-0 font-weight-bold"><?= $totalSaranaData['total'] ?? '0' ?></h3>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
              <a href="<?= $linkLaporan['dipinjam'] ?>" class="text-decoration-none">
                <div class="card border-0 rounded-lg shadow-hover h-100 transition-300">
                  <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                      <div class="icon-box bg-warning-light rounded-circle p-3 mr-3">
                        <i class="fas fa-people-arrows text-warning"></i>
                      </div>
                      <div>
                        <h6 class="mb-1 text-muted">Dipinjam</h6>
                        <h3 class="mb-0 font-weight-bold"><?= $totalSaranaDipinjam ?? '0' ?></h3>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>

            <div class="col-lg-3 col-md-6 mb-4">
              <a href="<?= $linkLaporan['rusak'] ?>" class="text-decoration-none">
                <div class="card border-0 rounded-lg shadow-hover h-100 transition-300">
                  <div class="card-body p-4">
                    <div class="d-flex align-items-center">
                      <div class="icon-box bg-danger-light rounded-circle p-3 mr-3">
                        <i class="fas fa-exclamation-triangle text-danger"></i>
                      </div>
                      <div>
                        <h6 class="mb-1 text-muted">Perlu Perhatian</h6>
                        <h3 class="mb-0 font-weight-bold"><?= $totalSaranaRusak ?? '0' ?></h3>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            </div>
          </div>

          <!-- Today's Activity -->
          <div class="row mb-4">
            <div class="col-md-6 mb-4 mb-md-0">
              <div class="card border-0 rounded-lg shadow-sm h-100">
                <div class="card-body p-4">
                  <div class="d-flex align-items-center mb-4">
                    <div class="icon-box bg-info-light rounded-circle p-3 mr-3">
                      <i class="fas fa-arrow-circle-right text-info"></i>
                    </div>
                    <div>
                      <h6 class="mb-1 text-muted">Peminjaman Hari Ini</h6>
                      <h3 class="mb-0 font-weight-bold"><?= $totalPinjamHariIni ?? '0' ?></h3>
                    </div>
                  </div>
                  <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-info" role="progressbar" style="width: <?= min(($totalPinjamHariIni ?? 0) * 10, 100) ?>%"></div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6">
              <div class="card border-0 rounded-lg shadow-sm h-100">
                <div class="card-body p-4">
                  <div class="d-flex align-items-center mb-4">
                    <div class="icon-box bg-success-light rounded-circle p-3 mr-3">
                      <i class="fas fa-arrow-circle-left text-success"></i>
                    </div>
                    <div>
                      <h6 class="mb-1 text-muted">Pengembalian Hari Ini</h6>
                      <h3 class="mb-0 font-weight-bold"><?= $totalKembaliHariIni ?? '0' ?></h3>
                    </div>
                  </div>
                  <div class="progress" style="height: 8px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: <?= min(($totalKembaliHariIni ?? 0) * 10, 100) ?>%"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Recent Activities -->
          <div class="row mb-4">
            <div class="col-12">
              <div class="card border-0 rounded-lg shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                  <div class="d-flex align-items-center">
                    <div class="icon-box bg-info-light rounded-circle p-2 mr-3">
                      <i class="fas fa-history text-info"></i>
                    </div>
                    <h5 class="mb-0">Aktivitas Terbaru</h5>
                  </div>
                </div>
                <div class="card-body p-0">
                  <div class="list-group list-group-flush">
                    <?php if (!empty($recentActivities)) : ?>
                      <?php foreach ($recentActivities as $activity) : ?>
                        <div class="list-group-item border-0 py-3">
                          <div class="d-flex justify-content-between align-items-center">
                            <div>
                              <div class="d-flex align-items-center">
                                <div class="avatar-sm bg-light rounded-circle p-2 mr-3">
                                  <i class="fas fa-tasks text-primary"></i>
                                </div>
                                <div>
                                  <h6 class="mb-1">
                                    <strong><?= htmlspecialchars($activity['nama_peminjam'] ?? '-') ?></strong>
                                    meminjam
                                    <strong><?= htmlspecialchars($activity['nama_barang'] ?? '-') ?></strong>
                                  </h6>
                                  <small class="text-muted">
                                    <i class="far fa-clock mr-1"></i>
                                    <?= date('d/m/Y H:i', strtotime($activity['created_at'] ?? $activity['tanggal_peminjaman'] ?? '')) ?>
                                  </small>
                                </div>
                              </div>
                            </div>
                            <span class="badge badge-pill badge-<?= ($activity['status'] ?? '') == 'Dipinjam' ? 'warning' : 'success' ?> px-3">
                              <?= htmlspecialchars($activity['status'] ?? '-') ?>
                            </span>
                          </div>
                        </div>
                      <?php endforeach; ?>
                    <?php elseif (!empty($noRecentActivity) && $noRecentActivity): ?>
                      <div class="list-group-item border-0 py-4 text-center text-muted">
                        <i class="fas fa-info-circle fa-2x mb-2"></i><br>
                        Tidak ada aktivitas terbaru.
                      </div>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Charts Row -->
          <div class="row mb-4">
            <div class="col-lg-8 mb-4 mb-lg-0">
              <div class="card border-0 rounded-lg shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                  <div class="d-flex align-items-center">
                    <div class="icon-box bg-primary-light rounded-circle p-2 mr-3">
                      <i class="fas fa-chart-pie text-primary"></i>
                    </div>
                    <h5 class="mb-0">Distribusi Aset</h5>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="distribusiAsetChart" height="300"></canvas>
                </div>
              </div>
            </div>

            <div class="col-lg-4">
              <div class="card border-0 rounded-lg shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                  <div class="d-flex align-items-center">
                    <div class="icon-box bg-success-light rounded-circle p-2 mr-3">
                      <i class="fas fa-chart-bar text-success"></i>
                    </div>
                    <h5 class="mb-0">Kondisi Aset</h5>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="kondisiBarangPieChart" height="300"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="row mb-4">
            <div class="col-12">
              <div class="card border-0 rounded-lg shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                  <div class="d-flex align-items-center">
                    <div class="icon-box bg-warning-light rounded-circle p-2 mr-3">
                      <i class="fas fa-plus text-warning"></i>
                    </div>
                    <h5 class="mb-0">Tambah Data Barang</h5>
                  </div>
                </div>
                <div class="card-body">
                  <div class="row">
                    <div class="col-lg-3 col-md-6 mb-4">
                      <a href="/admin/sarana/bergerak/tambah" class="card border-0 rounded-lg shadow-hover text-decoration-none transition-300">
                        <div class="card-body text-center p-4">
                          <div class="icon-box bg-primary-light rounded-circle p-3 mx-auto mb-3">
                            <i class="fas fa-truck-moving text-primary"></i>
                          </div>
                          <h6 class="mb-0">Barang Bergerak</h6>
                        </div>
                      </a>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                      <a href="/admin/sarana/mebelair/tambah" class="card border-0 rounded-lg shadow-hover text-decoration-none transition-300">
                        <div class="card-body text-center p-4">
                          <div class="icon-box bg-purple-light rounded-circle p-3 mx-auto mb-3">
                            <i class="fas fa-chair text-purple"></i>
                          </div>
                          <h6 class="mb-0">Barang Mebelair</h6>
                        </div>
                      </a>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                      <a href="/admin/sarana/atk/tambah" class="card border-0 rounded-lg shadow-hover text-decoration-none transition-300">
                        <div class="card-body text-center p-4">
                          <div class="icon-box bg-teal-light rounded-circle p-3 mx-auto mb-3">
                            <i class="fas fa-pencil-ruler text-teal"></i>
                          </div>
                          <h6 class="mb-0">Barang ATK</h6>
                        </div>
                      </a>
                    </div>

                    <div class="col-lg-3 col-md-6 mb-4">
                      <a href="/admin/sarana/elektronik/tambah" class="card border-0 rounded-lg shadow-hover text-decoration-none transition-300">
                        <div class="card-body text-center p-4">
                          <div class="icon-box bg-maroon-light rounded-circle p-3 mx-auto mb-3">
                            <i class="fas fa-plug text-maroon"></i>
                          </div>
                          <h6 class="mb-0">Barang Elektronik</h6>
                        </div>
                      </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Calendar -->
          <div class="row">
            <div class="col-12">
              <div class="card border-0 rounded-lg shadow-sm">
                <div class="card-header bg-white border-0 py-3">
                  <div class="d-flex align-items-center">
                    <div class="icon-box bg-danger-light rounded-circle p-2 mr-3">
                      <i class="far fa-calendar-alt text-danger"></i>
                    </div>
                    <h5 class="mb-0">Kalender</h5>
                  </div>
                </div>
                <div class="card-body">
                  <div id="calendar"></div>
                </div>
              </div>
            </div>
          </div>

        </div>
      </div>
    </div>

    <?php include './app/Views/Components/footer.php'; ?>
  </div>

  <?php include './app/Views/Components/script.php'; ?>
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
              <?= $totalPrasaranaData['lapangan'] ?? 0 ?>,
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
            fetch('https://libur.deno.dev/api')
              .then(response => response.json())
              .then(data => {
                let events = data.filter(item => item.is_national_holiday).map(function(item) {
                  return {
                    title: item.name, // Menggunakan 'holiday_name' dari API aktual
                    start: item.date, // Menggunakan 'holiday_date' dari API aktual
                    allDay: true,
                    backgroundColor: '#dc3545',
                    borderColor: '#dc3545'
                  };
                });
                successCallback(events);
              })
              .catch(error => failureCallback(error));
          },
          eventContent: function(arg) {
            let dateDisplay = '';
            if (arg.event.start) {
              // Format tanggal menjadi "DD Mon" (contoh: "17 Agu") menggunakan lokal Indonesia
              dateDisplay = arg.event.start.toLocaleDateString('id-ID', {
                day: 'numeric',
                month: 'short'
              });
            }
            return {
              html: '<div class="fc-event-main-frame">' +
                '<div class="fc-event-title-container">' +
                '<div class="fc-event-title fc-sticky">' +
                arg.event.title + // Ini adalah holiday_name
                (dateDisplay ? ' <small>(' + dateDisplay + ')</small>' : '') + // Ini adalah holiday_date yang diformat
                '</div>' +
                '</div></div>'
            };
          }
        });
        calendar.render();
      }
    });
  </script>

  <style>
    /* Modern UI Styles */
    .transition-300 {
      transition: all 0.3s ease;
    }

    .shadow-hover:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1) !important;
    }

    .rounded-lg {
      border-radius: 15px !important;
    }

    .icon-box {
      width: 45px;
      height: 45px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .avatar-sm {
      width: 35px;
      height: 35px;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    /* Custom Background Colors */
    .bg-primary-light {
      background-color: rgba(0, 123, 255, 0.1);
    }

    .bg-success-light {
      background-color: rgba(40, 167, 69, 0.1);
    }

    .bg-warning-light {
      background-color: rgba(255, 193, 7, 0.1);
    }

    .bg-danger-light {
      background-color: rgba(220, 53, 69, 0.1);
    }

    .bg-info-light {
      background-color: rgba(23, 162, 184, 0.1);
    }

    .bg-purple-light {
      background-color: rgba(111, 66, 193, 0.1);
    }

    .bg-teal-light {
      background-color: rgba(32, 201, 151, 0.1);
    }

    .bg-maroon-light {
      background-color: rgba(214, 51, 132, 0.1);
    }

    /* Custom Text Colors */
    .text-purple {
      color: #6f42c1;
    }

    .text-teal {
      color: #20c997;
    }

    .text-maroon {
      color: #d63384;
    }

    /* Calendar Customization */
    .fc-button-primary {
      background-color: #007bff !important;
      border-color: #007bff !important;
    }

    .fc-button-primary:hover {
      background-color: #0056b3 !important;
      border-color: #0056b3 !important;
    }

    .fc-day-today {
      background-color: rgba(0, 123, 255, 0.1) !important;
    }

    .fc-event {
      border-radius: 4px;
      border: none;
      padding: 2px 5px;
    }

    /* Progress Bar */
    .progress {
      background-color: rgba(0, 0, 0, 0.05);
      border-radius: 10px;
    }

    .progress-bar {
      border-radius: 10px;
    }

    /* Card and List Customization */
    .list-group-item:hover {
      background-color: rgba(0, 0, 0, 0.01);
    }

    .badge {
      padding: 0.5em 1em;
    }

    .badge-pill {
      border-radius: 10px;
    }
  </style>
</body>

</html>