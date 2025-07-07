<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-light">
      <div class="content-header px-4">
        <div class="container-fluid mx-auto px-2 sm:px-4">
          <!-- Header Row -->
          <div class="lg:flex hidden flex-col sm:flex-row items-center justify-between mb-4 gap-2">
            <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 flex items-center">
              <i class="fas fa-tachometer-alt mr-2 text-blue-600"></i>
              Dashboard
            </h1>
            <div class="flex-shrink-0">
              <span class="inline-flex items-center bg-blue-600 text-white px-4 py-2 rounded-full text-sm font-medium">
                <i class="far fa-calendar-alt mr-2"></i>
                <?php echo date('l, d F Y'); ?>
              </span>
            </div>
          </div>

          <!-- Welcome Card -->
          <div class="mb-4">
            <div class="bg-gradient-to-r from-blue-500 to-blue-700 rounded-xl shadow p-5 flex flex-col sm:flex-row justify-between items-center">
              <div class="text-white mb-3 sm:mb-0">
                <h4 class="text-lg sm:text-xl font-semibold flex items-center mb-1">
                  <i class="fas fa-user-circle mr-2"></i>
                  Selamat Datang, <?php echo isset($_SESSION['user']['username']) ? htmlspecialchars($_SESSION['user']['username']) : 'Admin'; ?>!
                </h4>
                <p class="opacity-80 text-sm">Semoga hari Anda menyenangkan. Berikut ringkasan aktivitas terbaru.</p>
              </div>
              <div class="text-white opacity-80 text-sm flex items-center">
                <i class="fas fa-clock mr-1"></i>
                Last login: <?php echo date('d/m/Y H:i'); ?>
              </div>
            </div>
          </div>

          <!-- Quick Stats -->
          <div class="grid grid-cols-2 sm:grid-cols-4 gap-4 mb-4">
            <a href="<?= $linkLaporan['prasarana'] ?>" class="block">
              <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 flex items-center gap-3 h-full">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100">
                  <i class="fas fa-city text-blue-600 text-xl"></i>
                </div>
                <div>
                  <div class="text-xs text-gray-500">Prasarana</div>
                  <div class="text-lg font-bold text-gray-800"><?= $totalPrasaranaData['total'] ?? '0' ?></div>
                </div>
              </div>
            </a>
            <a href="<?= $linkLaporan['sarana'] ?>" class="block">
              <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 flex items-center gap-3 h-full">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-green-100">
                  <i class="fas fa-tools text-green-600 text-xl"></i>
                </div>
                <div>
                  <div class="text-xs text-gray-500">Sarana</div>
                  <div class="text-lg font-bold text-gray-800"><?= $totalSaranaData['total'] ?? '0' ?></div>
                </div>
              </div>
            </a>
            <a href="<?= $linkLaporan['dipinjam'] ?>" class="block">
              <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 flex items-center gap-3 h-full">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-yellow-100">
                  <i class="fas fa-people-arrows text-yellow-500 text-xl"></i>
                </div>
                <div>
                  <div class="text-xs text-gray-500">Dipinjam</div>
                  <div class="text-lg font-bold text-gray-800"><?= $totalSaranaDipinjam ?? '0' ?></div>
                </div>
              </div>
            </a>
            <a href="<?= $linkLaporan['rusak'] ?>" class="block">
              <div class="bg-white rounded-xl shadow hover:shadow-lg transition p-4 flex items-center gap-3 h-full">
                <div class="flex items-center justify-center w-12 h-12 rounded-full bg-red-100">
                  <i class="fas fa-exclamation-triangle text-red-600 text-xl"></i>
                </div>
                <div>
                  <div class="text-xs text-gray-500">Perlu Perhatian</div>
                  <div class="text-lg font-bold text-gray-800"><?= $totalSaranaRusak ?? '0' ?></div>
                </div>
              </div>
            </a>
          </div>

          <!-- Today's Activity -->
          <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
            <div class="bg-white rounded-xl shadow p-4 flex flex-col h-full">
              <div class="flex items-center mb-3">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-blue-100 mr-3">
                  <i class="fas fa-arrow-circle-right text-blue-500 text-lg"></i>
                </div>
                <div>
                  <div class="text-xs text-gray-500">Peminjaman Hari Ini</div>
                  <div class="text-xl font-bold text-gray-800"><?= $totalPinjamHariIni ?? '0' ?></div>
                </div>
              </div>
              <div class="w-full bg-blue-100 rounded-full h-2">
                <div class="bg-blue-500 h-2 rounded-full" style="width: <?= min(($totalPinjamHariIni ?? 0) * 10, 100) ?>%"></div>
              </div>
            </div>
            <div class="bg-white rounded-xl shadow p-4 flex flex-col h-full">
              <div class="flex items-center mb-3">
                <div class="flex items-center justify-center w-10 h-10 rounded-full bg-green-100 mr-3">
                  <i class="fas fa-arrow-circle-left text-green-500 text-lg"></i>
                </div>
                <div>
                  <div class="text-xs text-gray-500">Pengembalian Hari Ini</div>
                  <div class="text-xl font-bold text-gray-800"><?= $totalKembaliHariIni ?? '0' ?></div>
                </div>
              </div>
              <div class="w-full bg-green-100 rounded-full h-2">
                <div class="bg-green-500 h-2 rounded-full" style="width: <?= min(($totalKembaliHariIni ?? 0) * 10, 100) ?>%"></div>
              </div>
            </div>
          </div>

          <!-- Recent Activities -->
          <div class="mb-4">
            <div class="bg-white rounded-xl shadow">
              <div class="flex items-center gap-2 px-4 py-3 border-b border-gray-100">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100">
                  <i class="fas fa-history text-blue-500"></i>
                </div>
                <h5 class="font-semibold text-gray-800 text-base">Aktivitas Terbaru</h5>
              </div>
              <div class="divide-y divide-gray-100">
                <?php if (!empty($recentActivities)) : ?>
                  <?php foreach ($recentActivities as $activity) : ?>
                    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center px-4 py-3">
                      <div class="flex items-center mb-2 sm:mb-0">
                        <div class="flex items-center justify-center w-9 h-9 rounded-full bg-gray-100 mr-3">
                          <i class="fas fa-tasks text-blue-600"></i>
                        </div>
                        <div>
                          <div class="text-sm font-medium text-gray-700">
                            <span class="font-semibold"><?= htmlspecialchars($activity['nama_peminjam'] ?? '-') ?></span>
                            meminjam
                            <span class="font-semibold"><?= htmlspecialchars($activity['nama_barang'] ?? '-') ?></span>
                          </div>
                          <div class="text-xs text-gray-400 flex items-center mt-1">
                            <i class="far fa-clock mr-1"></i>
                            <?= date('d/m/Y H:i', strtotime($activity['created_at'] ?? $activity['tanggal_peminjaman'] ?? '')) ?>
                          </div>
                        </div>
                      </div>
                      <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                        <?php if (($activity['status'] ?? '') == 'Dipinjam') echo 'bg-yellow-100 text-yellow-700';
                        else echo 'bg-green-100 text-green-700'; ?>">
                        <?= htmlspecialchars($activity['status'] ?? '-') ?>
                      </span>
                    </div>
                  <?php endforeach; ?>
                <?php elseif (!empty($noRecentActivity) && $noRecentActivity): ?>
                  <div class="px-4 py-6 text-center text-gray-400">
                    <i class="fas fa-info-circle fa-2x mb-2"></i><br>
                    Tidak ada aktivitas terbaru.
                  </div>
                <?php endif; ?>
              </div>
            </div>
          </div>

          <!-- Charts Row -->
          <div class="grid grid-cols-1 lg:grid-cols-3 gap-4 mb-4">
            <div class="lg:col-span-2">
              <div class="bg-white rounded-xl shadow p-4 h-full flex flex-col">
                <div class="flex items-center gap-2 mb-3">
                  <div class="flex items-center justify-center w-8 h-8 rounded-full bg-blue-100">
                    <i class="fas fa-chart-pie text-blue-600"></i>
                  </div>
                  <h5 class="font-semibold text-gray-800 text-base">Distribusi Aset</h5>
                </div>
                <div class="flex-1 min-h-[200px]">
                  <canvas id="distribusiAsetChart" height="300"></canvas>
                </div>
              </div>
            </div>
            <div>
              <div class="bg-white rounded-xl shadow p-4 h-full flex flex-col">
                <div class="flex items-center gap-2 mb-3">
                  <div class="flex items-center justify-center w-8 h-8 rounded-full bg-green-100">
                    <i class="fas fa-chart-bar text-green-600"></i>
                  </div>
                  <h5 class="font-semibold text-gray-800 text-base">Kondisi Aset</h5>
                </div>
                <div class="flex-1 min-h-[200px]">
                  <canvas id="kondisiBarangPieChart" height="300"></canvas>
                </div>
              </div>
            </div>
          </div>

          <!-- Quick Actions -->
          <div class="mb-4">
            <div class="bg-white rounded-xl shadow">
              <div class="flex items-center gap-2 px-4 py-3 border-b border-gray-100">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-yellow-100">
                  <i class="fas fa-plus text-yellow-500"></i>
                </div>
                <h5 class="font-semibold text-gray-800 text-base">Tambah Data Barang</h5>
              </div>
              <div class="p-4">
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                  <a href="/admin/sarana/bergerak/tambah" class="block group">
                    <div class="bg-blue-50 rounded-xl shadow hover:shadow-lg transition p-4 text-center flex flex-col items-center">
                      <div class="flex items-center justify-center w-12 h-12 rounded-full bg-blue-100 mb-2">
                        <i class="fas fa-truck-moving text-blue-600 text-xl"></i>
                      </div>
                      <div class="text-sm font-medium text-gray-700 group-hover:text-blue-700">Barang Bergerak</div>
                    </div>
                  </a>
                  <a href="/admin/sarana/mebelair/tambah" class="block group">
                    <div class="bg-purple-50 rounded-xl shadow hover:shadow-lg transition p-4 text-center flex flex-col items-center">
                      <div class="flex items-center justify-center w-12 h-12 rounded-full bg-purple-100 mb-2">
                        <i class="fas fa-chair text-purple-600 text-xl"></i>
                      </div>
                      <div class="text-sm font-medium text-gray-700 group-hover:text-purple-700">Barang Mebelair</div>
                    </div>
                  </a>
                  <a href="/admin/sarana/atk/tambah" class="block group">
                    <div class="bg-teal-50 rounded-xl shadow hover:shadow-lg transition p-4 text-center flex flex-col items-center">
                      <div class="flex items-center justify-center w-12 h-12 rounded-full bg-teal-100 mb-2">
                        <i class="fas fa-pencil-ruler text-teal-600 text-xl"></i>
                      </div>
                      <div class="text-sm font-medium text-gray-700 group-hover:text-teal-700">Barang ATK</div>
                    </div>
                  </a>
                  <a href="/admin/sarana/elektronik/tambah" class="block group">
                    <div class="bg-pink-50 rounded-xl shadow hover:shadow-lg transition p-4 text-center flex flex-col items-center">
                      <div class="flex items-center justify-center w-12 h-12 rounded-full bg-pink-100 mb-2">
                        <i class="fas fa-plug text-pink-600 text-xl"></i>
                      </div>
                      <div class="text-sm font-medium text-gray-700 group-hover:text-pink-700">Barang Elektronik</div>
                    </div>
                  </a>
                </div>
              </div>
            </div>
          </div>

          <!-- Calendar -->
          <div>
            <div class="bg-white rounded-xl shadow">
              <div class="flex items-center gap-2 px-4 py-3 border-b border-gray-100">
                <div class="flex items-center justify-center w-8 h-8 rounded-full bg-red-100">
                  <i class="far fa-calendar-alt text-red-500"></i>
                </div>
                <h5 class="font-semibold text-gray-800 text-base">Kalender</h5>
              </div>
              <div class="p-4">
                <div id="calendar"></div>
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