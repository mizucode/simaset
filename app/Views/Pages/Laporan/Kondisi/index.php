<?php
// View: Kondisi/index.php
// Menampilkan seluruh data kondisi barang
// Diubah untuk menggunakan template AdminLTE
?>
<!DOCTYPE html>
<html lang="id">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed px-3">
  <div class="wrapper">

    <!-- Navbar -->
    <?php include './app/Views/Components/navbar.php'; ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include './app/Views/Components/aside.php'; ?>
    <!-- /.sidebar -->

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper bg-white py-4 mb-5">
      <!-- Content Header (Page header) -->
      <div class="container-fluid">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Laporan Kondisi Barang</h1>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; // For flash messages or other helpers 
            ?>
            <!-- Filter Kategori & Kondisi -->
            <div class="row mb-3">
              <div class="col-md-3">
                <label for="filterKategori" class="font-weight-bold mb-1">Filter Kategori</label>
                <select id="filterKategori" class="form-control">
                  <option value="">Semua Kategori</option>
                  <option value="Sarana Bergerak">Sarana Bergerak</option>
                  <option value="Sarana Mebelair">Sarana Mebelair</option>
                  <option value="Sarana ATK">Sarana ATK</option>
                  <option value="Sarana Elektronik">Sarana Elektronik</option>
                </select>
              </div>
              <div class="col-md-3">
                <label for="filterKondisi" class="font-weight-bold mb-1">Filter Kondisi</label>
                <select id="filterKondisi" class="form-control">
                  <option value="">Semua Kondisi</option>
                  <option value="Baik">Baik</option>
                  <option value="Rusak Ringan">Rusak Ringan</option>
                  <option value="Rusak Berat">Rusak Berat</option>
                  <option value="Hilang">Hilang</option>
                  <option value="Pemusnahan">Pemusnahan</option>
                </select>
              </div>
            </div>
            <!-- End Filter -->
            <!-- Card: Grafik Kondisi Barang -->
            <div class="card shadow-md mb-4" id="grafikKondisiCard">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Grafik Perbandingan Kondisi Barang</h3>
                <button type="button" class="btn btn-tool ml-auto text-white" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <div class="card-body p-3">
                <div id="kondisiChartLegend" class="mb-2"></div>
                <div style="height: 400px;">
                  <canvas id="kondisiChart"></canvas>
                </div>
              </div>
            </div>
            <!-- /.card -->
            <!-- Card: Tabel Kondisi Barang -->
            <div class="card shadow-md" id="tabelKondisiCard">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Daftar Kondisi Seluruh Barang</h3>
                <button type="button" class="btn btn-tool ml-auto text-white" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="kondisiTable" class="table table-bordered table-striped">
                    <thead class="bg-light">
                      <tr>
                        <th style="width: 5%" class="text-center">No</th>
                        <th>Nomor Registrasi</th>
                        <th>Nama Barang</th>
                        <th>Kategori</th>
                        <th>Kondisi</th>
                        <th>Lokasi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($saranaData)) : ?>
                        <?php foreach ($saranaData as $i => $item) : ?>
                          <tr>
                            <td class="text-center"><?= $i + 1 ?></td>
                            <td><?= htmlspecialchars($item['no_registrasi'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($item['nama_detail_barang'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($item['kategori'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($item['kondisi'] ?? '-') ?></td>
                            <td><?= htmlspecialchars($item['lokasi'] ?? '-') ?></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <tr>
                          <td colspan="6" class="text-center">Tidak ada data barang.</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
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
    <?php include './app/Views/Components/footer.php'; ?>
    <!-- /.footer -->

  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->
  <?php include './app/Views/Components/script.php'; ?>
  <!-- ChartJS sudah di-include di script.php -->
  <style>
    /* Styling untuk DataTables */
    .dataTables_wrapper .dataTables_length {
      margin-bottom: 10px;
    }

    .dataTables_wrapper .dataTables_length select {
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 4px 8px;
      margin: 0 5px;
    }

    .dataTables_wrapper .dataTables_filter {
      margin-bottom: 10px;
    }

    .dataTables_wrapper .dataTables_filter input {
      border: 1px solid #ddd;
      border-radius: 4px;
      padding: 6px 12px;
      margin-left: 5px;
      width: 200px;
    }

    .dataTables_wrapper .dataTables_filter input:focus {
      border-color: #007bff;
      outline: 0;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .dataTables_wrapper .dataTables_info {
      padding-top: 10px;
      font-size: 14px;
      color: #6c757d;
    }

    /* Memastikan pagination dan info sejajar */
    .dataTables_wrapper .dataTables_paginate {
      padding-top: 10px;
    }

    /* Styling untuk tombol export */
    .dt-buttons .btn {
      margin-right: 5px;
      margin-bottom: 5px;
    }

    .dt-buttons .btn:last-child {
      margin-right: 0;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
      .dataTables_wrapper .dataTables_filter input {
        width: 150px;
      }

      .dt-buttons .btn {
        font-size: 12px;
        padding: 4px 8px;
      }
    }
  </style>
  <script>
    $(function() {
      // Inisialisasi DataTables dengan konfigurasi yang lebih baik
      var table = $("#kondisiTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "pageLength": 10,
        "ordering": false,
        "dom": '<"row"<"col-sm-12 col-md-6"B><"col-sm-12 col-md-6"f>>' +
          '<"row"<"col-sm-12"tr>>' +
          '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        "buttons": [{
            extend: 'copy',
            text: '<i class="fas fa-copy"></i> Copy',
            className: 'btn btn-info btn-sm mr-1',
            title: 'Laporan Kondisi Barang'
          },
          {
            extend: 'csv',
            text: '<i class="fas fa-file-csv"></i> CSV',
            className: 'btn btn-success btn-sm mr-1',
            title: 'Laporan Kondisi Barang'
          },
          {
            extend: 'excel',
            text: '<i class="fas fa-file-excel"></i> Excel',
            className: 'btn btn-success btn-sm mr-1',
            title: 'Laporan Kondisi Barang'
          },
          {
            extend: 'pdf',
            text: '<i class="fas fa-file-pdf"></i> PDF',
            className: 'btn btn-danger btn-sm mr-1',
            title: 'Laporan Kondisi Barang',
            customize: function(doc) {
              // Customize PDF
              doc.content[1].table.widths = ['5%', '15%', '30%', '15%', '15%', '20%'];
              doc.styles.tableHeader.fillColor = '#1f2937';
              doc.styles.tableHeader.color = '#ffffff';
            }
          },
          {
            extend: 'print',
            text: '<i class="fas fa-print"></i> Print',
            className: 'btn btn-warning btn-sm',
            title: 'Laporan Kondisi Barang'
          }
        ],
        "language": {
          "search": "Cari:",
          "lengthMenu": "Tampilkan _MENU_ data per halaman",
          "zeroRecords": "Tidak ada data yang ditemukan",
          "info": "Menampilkan halaman _PAGE_ dari _PAGES_",
          "infoEmpty": "Tidak ada data tersedia",
          "infoFiltered": "(disaring dari _MAX_ total data)",
          "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Selanjutnya",
            "previous": "Sebelumnya"
          }
        }
      });

      // Inisialisasi ChartJS untuk Grafik Kondisi Barang dengan penanganan error
      var kondisiChart = null;

      if ($('#kondisiChart').length) {
        try {
          var kondisiChartCanvas = $('#kondisiChart').get(0).getContext('2d');
          var kondisiChartData = <?= isset($chartKondisiData) ? $chartKondisiData : '{"labels":[],"datasets":[{"data":[],"backgroundColor":[]}]}' ?>;

          var kondisiChartOptions = {
            maintainAspectRatio: false,
            responsive: true,
            legend: {
              display: false
            },
            legendCallback: function(chart) {
              var text = [];
              text.push('<ul class="chartjs-legend list-unstyled d-flex flex-wrap">');
              var data = chart.data;
              var datasets = data.datasets;
              var labels = data.labels;
              if (datasets.length) {
                for (var i = 0; i < datasets[0].data.length; ++i) {
                  text.push('<li class="mr-3 mb-1 d-flex align-items-center"><span style="display:inline-block;width:18px;height:18px;background-color:' + datasets[0].backgroundColor[i] + ';margin-right:8px;border-radius:3px;"></span>');
                  if (labels[i]) {
                    text.push(labels[i]);
                  }
                  text.push('</li>');
                }
              }
              text.push('</ul>');
              return text.join('');
            },
            scales: {
              xAxes: [{
                ticks: {
                  fontColor: '#333'
                },
                gridLines: {
                  display: false
                }
              }],
              yAxes: [{
                ticks: {
                  beginAtZero: true,
                  stepSize: 1,
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
                label: function(tooltipItem, data) {
                  var label = data.labels[tooltipItem.index] || '';
                  var value = data.datasets[tooltipItem.datasetIndex].data[tooltipItem.index];
                  if (label) {
                    label += ': ';
                  }
                  label += value;
                  return label;
                }
              }
            }
          };

          kondisiChart = new Chart(kondisiChartCanvas, {
            type: 'bar',
            data: kondisiChartData,
            options: kondisiChartOptions
          });

          var legendHtml = kondisiChart.generateLegend();
          $('#kondisiChartLegend').html(legendHtml);
        } catch (e) {
          console.error("Gagal membuat chart:", e);
          $('#kondisiChartLegend').html('<div class="alert alert-danger">Gagal memuat grafik</div>');
        }
      }

      // Fungsi untuk normalisasi kategori
      function normalizeKategori(str) {
        return (str || '').toLowerCase().replace(/\s+/g, '').replace(/-/g, '').trim();
      }

      // Fungsi untuk memperbarui chart berdasarkan data yang difilter
      function updateChart(filteredData) {
        if (!kondisiChart) return;

        var kondisiCount = {};
        var warnaKondisi = {
          'Baik': '#28a745',
          'Rusak Ringan': '#ffc107',
          'Rusak Berat': '#dc3545',
          'Hilang': '#6c757d',
          'Lainnya': '#17a2b8'
        };

        filteredData.forEach(function(row) {
          var k = row.kondisi || 'Lainnya';
          if (!kondisiCount[k]) kondisiCount[k] = 0;
          kondisiCount[k]++;
        });

        var labels = Object.keys(kondisiCount);
        var data = Object.values(kondisiCount);
        var backgroundColor = labels.map(function(k) {
          return warnaKondisi[k] || '#17a2b8';
        });

        kondisiChart.data.labels = labels;
        kondisiChart.data.datasets[0].data = data;
        kondisiChart.data.datasets[0].backgroundColor = backgroundColor;
        kondisiChart.update();

        // Update legend
        $('#kondisiChartLegend').html(kondisiChart.generateLegend());
      }

      // Fungsi filter dengan integrasi DataTables
      function applyFilters() {
        var kategori = normalizeKategori($('#filterKategori').val());
        var kondisi = ($('#filterKondisi').val() || '').trim();

        // Reset filter sebelumnya
        $.fn.dataTable.ext.search.pop();

        // Tambahkan filter baru
        $.fn.dataTable.ext.search.push(
          function(settings, data, dataIndex) {
            var rowKategori = normalizeKategori(data[3]); // Kolom kategori (indeks 3)
            var rowKondisi = (data[4] || '').trim(); // Kolom kondisi (indeks 4)

            if (kategori && rowKategori !== kategori) return false;
            if (kondisi && rowKondisi !== kondisi) return false;
            return true;
          }
        );

        // Terapkan filter dan dapatkan data yang difilter
        table.draw();

        // Dapatkan data yang difilter untuk update chart
        var filteredData = table.rows({
          search: 'applied'
        }).data().toArray().map(function(row) {
          return {
            kategori: row[3],
            kondisi: row[4]
          };
        });

        updateChart(filteredData);
      }

      // Event handler untuk filter
      $('#filterKategori, #filterKondisi').on('change', applyFilters);
    });
  </script>
</body>

</html>