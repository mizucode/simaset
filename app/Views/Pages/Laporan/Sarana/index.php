<!DOCTYPE html>
<html lang="en">
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
    <div class="content-wrapper bg-white py-4 mb-5 ">
      <!-- Content Header (Page header) -->
      <div class="container-fluid">
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Laporan Sarana</h1>
              </div>
              <div class="col-sm-6">
                <div class="float-sm-right d-flex align-items-center">

                  <button id="exportPdfBtn" class="btn btn-sm btn-danger"><i class="fas fa-file-pdf"></i> Export PDF</button>
                </div>
              </div>
            </div>
          </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; // For flash messages or other helpers 
            ?>
            <!-- Card: Grafik Prasarana -->
            <div class="card shadow-md mb-4" id="grafikPrasaranaCard">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Grafik Perbandingan Total Data Sarana</h3>
                <button type="button" class="btn btn-tool ml-auto text-white" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <div class="card-body p-3">
                <div id="prasaranaChartLegend" class="mb-2"></div>
                <div style="height: 400px;">
                  <canvas id="prasaranaChart"></canvas>
                </div>
              </div>
            </div>
            <!-- /.card -->

            <!-- Card: Tabel Total Data Prasarana -->
            <div class="card shadow-md" id="tabelPrasaranaCard">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Tabel Total Data Sarana</h3>
                <button type="button" class="btn btn-tool ml-auto text-white" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table class="table table-bordered table-striped">
                    <thead class="bg-light">
                      <tr>
                        <th style="width: 5%" class="text-center">No</th>
                        <th>Jenis Sarana</th>
                        <th class="text-center">Total Data</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <td class="text-center">1</td>
                        <td>Sarana Bergerak</td>
                        <td class="text-center"><?= isset($chartData) ? json_decode($chartData, true)['datasets'][0]['data'][0] : 0 ?></td>
                      </tr>
                      <tr>
                        <td class="text-center">2</td>
                        <td>Sarana Mebelair</td>
                        <td class="text-center"><?= isset($chartData) ? json_decode($chartData, true)['datasets'][0]['data'][1] : 0 ?></td>
                      </tr>
                      <tr>
                        <td class="text-center">3</td>
                        <td>Sarana ATK</td>
                        <td class="text-center"><?= isset($chartData) ? json_decode($chartData, true)['datasets'][0]['data'][2] : 0 ?></td>
                      </tr>
                      <tr>
                        <td class="text-center">4</td>
                        <td>Sarana Elektronik</td>
                        <td class="text-center"><?= isset($chartData) ? json_decode($chartData, true)['datasets'][0]['data'][3] : 0 ?></td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
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
  <!-- Pustaka untuk Export PDF -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js" integrity="sha512-BNaRQnYJYiPSqHHDb58B0yaPfCu+Wgds8Gp/gU33kqBtgNS4tSPHuGibyoeqMV/TJlSKda6FXzoEyYGjTe+vXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/3.0.1/jspdf.umd.min.js" integrity="sha512-ad3j5/L4h648YM/KObaUfjCsZRBP9sAOmpjaT2BDx6u9aBrKFp7SbeHykruy83rxfmG42+5QqeL/ngcojglbJw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

  <!-- ChartJS sudah di-include di script.php -->

  <script>
    $(function() {
      var prasaranaChartCanvas = $('#prasaranaChart').get(0).getContext('2d');
      var prasaranaChartData = JSON.parse('<?= $chartData; ?>');

      var prasaranaChartOptions = {
        maintainAspectRatio: false,
        responsive: true,
        legend: {
          display: false // Hide default legend
        },
        legendCallback: function(chart) { // Custom legend callback
          var text = [];
          text.push('<ul class="chartjs-legend list-unstyled d-flex flex-wrap">');
          var data = chart.data;
          var datasets = data.datasets;
          var labels = data.labels;
          if (datasets.length) {
            for (var i = 0; i < datasets[0].data.length; ++i) { // Iterate over data points for labels
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

      var prasaranaChart = new Chart(prasaranaChartCanvas, {
        type: 'bar', // Jenis grafik: bar, line, pie, dll.
        data: prasaranaChartData,
        options: prasaranaChartOptions
      });
      // Generate and display custom legend
      var legendHtml = prasaranaChart.generateLegend();
      $('#prasaranaChartLegend').html(legendHtml);
    });
  </script>

  <script>
    $(document).ready(function() {
      $('#exportPdfBtn').on('click', function() {
        // Pastikan jsPDF dan html2canvas sudah tersedia
        if (typeof window.jspdf === 'undefined' || typeof html2canvas === 'undefined') {
          alert('Library jsPDF atau html2canvas belum termuat. Silakan refresh halaman.');
          return;
        }
        const {
          jsPDF
        } = window.jspdf;
        const pdf = new jsPDF('p', 'mm', 'a4');
        let pdfPosition = 15; // Initial Y position for content in PDF
        const pageHeight = pdf.internal.pageSize.getHeight();
        const pageWidth = pdf.internal.pageSize.getWidth();
        const margin = 10;
        const contentWidth = pageWidth - (2 * margin);

        pdf.setFontSize(18);
        pdf.text('Laporan Sarana', pageWidth / 2, pdfPosition, {
          align: 'center'
        });
        pdfPosition += 15;

        function addElementToPdf(elementId, title, currentPosition) {
          return new Promise((resolve, reject) => {
            const element = document.getElementById(elementId);
            if (!element) {
              console.error(`Element with ID '${elementId}' not found.`);
              return reject(new Error(`Element with ID '${elementId}' not found.`));
            }

            if (currentPosition + 20 > pageHeight - margin) {
              pdf.addPage();
              currentPosition = margin + 5;
            }
            pdf.setFontSize(14);
            pdf.text(title, margin, currentPosition);
            currentPosition += 8;

            html2canvas(element, {
                scale: 2,
                useCORS: true,
                backgroundColor: null, // Tambahan agar background transparan
                logging: true // Enabled for easier debugging
              })
              .then(canvas => {
                const imgData = canvas.toDataURL('image/png');
                const imgProps = pdf.getImageProperties(imgData);
                const pdfImgHeight = (imgProps.height * contentWidth) / imgProps.width;

                if (currentPosition + pdfImgHeight > pageHeight - margin) {
                  pdf.addPage();
                  currentPosition = margin;
                }
                pdf.addImage(imgData, 'PNG', margin, currentPosition, contentWidth, pdfImgHeight);
                currentPosition += pdfImgHeight + 10;
                resolve(currentPosition);
              })
              .catch(err => {
                console.error(`Error capturing element ${elementId}: `, err);
                reject(err);
              });
          });
        }

        const $exportButton = $(this);
        const originalButtonText = $exportButton.html();
        $exportButton.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Exporting...');

        // Tunggu chart selesai render sebelum export
        setTimeout(function() {
          addElementToPdf('grafikPrasaranaCard', 'Grafik Perbandingan Total Data Sarana', pdfPosition)
            .then(newPosition => {
              pdfPosition = newPosition;
              return addElementToPdf('tabelPrasaranaCard', 'Tabel Total Data Sarana', pdfPosition);
            })
            .then(() => {
              pdf.save('laporan_sarana.pdf');
            })
            .catch(error => {
              alert('Gagal membuat PDF: ' + error.message);
              console.error(error);
            })
            .finally(() => $exportButton.prop('disabled', false).html(originalButtonText));
        }, 800); // Delay diperpanjang agar chart/legend benar-benar render
      });
    });
  </script>
</body>

</html>