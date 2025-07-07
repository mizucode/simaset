<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>
<style>
  .bg-navy {
    background-color: #001f3f !important;
  }

  .bg-light-navy {
    background-color: #f0f4f8 !important;
  }

  .border-navy {
    border-color: #001f3f !important;
  }

  .btn-navy {
    background-color: #001f3f;
    color: white;
    border-color: #001f3f;
  }

  .btn-navy:hover {
    background-color: #003366;
    border-color: #003366;
    color: white;
  }

  .input-group-text.bg-navy {
    background-color: #131313;
    color: white;
    border-color: #001f3f;
  }

  .form-control.border-navy:focus {
    border-color: #001f3f;
    box-shadow: 0 0 0 0.2rem rgba(0, 31, 63, 0.25);
  }

  table.dataTable thead th,
  table.dataTable thead td {
    white-space: nowrap;
  }

  /* Tambahan CSS responsif untuk mobile */
  @media (max-width: 767.98px) {
    .table-responsive {
      overflow-x: auto;
    }

    #surveyTable th,
    #surveyTable td {
      white-space: nowrap;
      font-size: 13px;
      padding: 6px 8px;
    }

    .dataTables_wrapper .dataTables_paginate {
      font-size: 13px;
    }
  }
</style>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white py-4 mb-5 px-3">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>

            <?php if (!empty($errorMessage)) : ?>
              <div class="alert alert-danger">
                <?php echo htmlspecialchars($errorMessage); ?>
              </div>
            <?php endif; ?>

            <div class="card shadow-md">
              <div class="card-header bg-navy text-white flex justify-between">
                <h3 class="h4 mb-0">Data Survey Sarana</h3>
                <div class="ml-auto flex flex-col gap-2 justify-end md:flex-row">
                  <button type="button" class="btn btn-light btn-sm" data-toggle="modal" data-target="#filterModal">
                    <i class="fas fa-filter mr-1"></i> Filter Data
                  </button>
                  <a href="/admin/survey/sarana/survey-barang/tambah" class="btn btn-warning flex align-center btn-sm text-dark">
                    <i class="fas fa-plus mr-1"></i> Tambah Data
                  </a>
                </div>
              </div>
              <?php
              $tahunAkademikOptions = [];
              if (!empty($surveyData)) {
                $tahunAkademikOptions = array_unique(array_column($surveyData, 'tahun_akademik'));
                sort($tahunAkademikOptions);
              }

              $lokasiSurveyOptions = [];
              if (!empty($surveyData)) {
                $lokasiSurveyOptions = array_unique(array_column($surveyData, 'lokasi_survey'));
                sort($lokasiSurveyOptions);
              }
              ?>
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="surveyTable" class="table table-bordered w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="20%">Penanggung Jawab</th>
                        <th width="10%">Semester</th>
                        <th width="15%">Tahun Akademik</th>
                        <th width="15%">Tanggal Pengecekan</th>
                        <th width="20%">Lokasi Survey</th>
                        <th width="15%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($surveyData)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($surveyData as $data) : ?>
                          <tr class="align-middle">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td><?= htmlspecialchars($data['penanggung_jawab'] ?? '-'); ?></td>
                            <td class="text-center"><?= htmlspecialchars($data['semester'] ?? '-'); ?></td>
                            <td class="text-center"><?= htmlspecialchars($data['tahun_akademik'] ?? '-'); ?></td>
                            <td class="text-center"><?= isset($data['tanggal_pengecekan']) ? date('d M Y', strtotime($data['tanggal_pengecekan'])) : '-'; ?></td>
                            <td><?= htmlspecialchars($data['lokasi_survey'] ?? '-'); ?></td>
                            <td class="text-center">
                              <div class="d-flex justify-content-center gap-2">
                                <a href="/admin/survey/sarana/survey-barang?detail=<?= $data['id']; ?>" class="btn btn-info btn-sm">
                                  <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else: ?>
                        <tr>
                          <td colspan="7" class="text-center">Tidak ada data yang tersedia pada tabel ini</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
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

  <div class="modal fade" id="filterModal" tabindex="-1" role="dialog" aria-labelledby="filterModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header bg-navy text-white">
          <h5 class="modal-title font-weight-bold" id="filterModalLabel">
            <i class="fas fa-filter mr-2"></i>Filter Data Survey
          </h5>
          <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="container-fluid">
            <div class="card mb-4 border-navy">
              <div class="card-header bg-light-navy">
                <h6 class="mb-0 font-weight-bold text-navy"><i class="fas fa-calendar-alt mr-2"></i>Periode Survey</h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="filterSemester" class="form-label">Semester</label>
                    <select id="filterSemester" class="form-control border-navy select2-filter">
                      <option value="">Semua Semester</option>
                      <option value="Ganjil">Ganjil</option>
                      <option value="Genap">Genap</option>
                    </select>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="filterTahun" class="form-label">Tahun Akademik</label>
                    <select id="filterTahun" class="form-control border-navy select2-filter">
                      <option value="">Semua Tahun</option>
                      <?php foreach ($tahunAkademikOptions as $tahun) : ?>
                        <option value="<?= htmlspecialchars($tahun) ?>"><?= htmlspecialchars($tahun) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="card mb-4 border-navy">
              <div class="card-header bg-light-navy">
                <h6 class="mb-0 font-weight-bold text-navy"><i class="fas fa-info-circle mr-2"></i>Detail Survey</h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="filterPenanggungJawab" class="form-label">Penanggung Jawab</label>
                    <input type="text" id="filterPenanggungJawab" class="form-control border-navy" placeholder="Nama Penanggung Jawab">
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="filterLokasi" class="form-label">Lokasi Survey</label>
                    <select id="filterLokasi" class="form-control border-navy select2-filter">
                      <option value="">Semua Lokasi</option>
                      <?php foreach ($lokasiSurveyOptions as $lokasi) : ?>
                        <option value="<?= htmlspecialchars($lokasi) ?>"><?= htmlspecialchars($lokasi) ?></option>
                      <?php endforeach; ?>
                    </select>
                  </div>
                </div>
              </div>
            </div>
            <div class="card border-navy">
              <div class="card-header bg-light-navy">
                <h6 class="mb-0 font-weight-bold text-navy"><i class="far fa-calendar-check mr-2"></i>Tanggal Pengecekan</h6>
              </div>
              <div class="card-body">
                <div class="row">
                  <div class="col-md-6 mb-3">
                    <label for="filterTanggalMin" class="form-label">Dari Tanggal</label>
                    <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text bg-navy text-white"><i class="far fa-calendar"></i></span></div>
                      <input type="date" id="filterTanggalMin" class="form-control border-navy">
                    </div>
                  </div>
                  <div class="col-md-6 mb-3">
                    <label for="filterTanggalMax" class="form-label">Sampai Tanggal</label>
                    <div class="input-group">
                      <div class="input-group-prepend"><span class="input-group-text bg-navy text-white"><i class="far fa-calendar"></i></span></div>
                      <input type="date" id="filterTanggalMax" class="form-control border-navy">
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-secondary" data-dismiss="modal"><i class="fas fa-times mr-1"></i>Tutup</button>
          <button type="button" class="btn btn-outline-danger" id="resetFiltersBtn"><i class="fas fa-undo mr-1"></i>Reset</button>
          <button type="button" class="btn btn-navy" id="applyFiltersBtn"><i class="fas fa-check mr-1"></i>Terapkan</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    $(function() {
      var table = $("#surveyTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "searching": true,
        "ordering": false,
        "columnDefs": [{
            "targets": 0, // No
            "orderable": false,
            "searchable": false
          },
          {
            "targets": [6], // Aksi
            "searchable": false,
            "orderable": false
          }
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
        language: {
          "emptyTable": "Tidak ada data yang tersedia pada tabel ini",
          "info": "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
          "infoEmpty": "Menampilkan 0 sampai 0 dari 0 entri",
          "infoFiltered": "(disaring dari _MAX_ entri keseluruhan)",
          "lengthMenu": "Tampilkan _MENU_ entri",
          "loadingRecords": "Sedang memuat...",
          "processing": "Sedang memproses...",
          "search": "Cari:",
          "zeroRecords": "Tidak ditemukan data yang sesuai",
          "paginate": {
            "first": "Pertama",
            "last": "Terakhir",
            "next": "Selanjutnya",
            "previous": "Sebelumnya"
          },
          "aria": {
            "sortAscending": ": aktifkan untuk mengurutkan kolom ke atas",
            "sortDescending": ": aktifkan untuk mengurutkan kolom menurun"
          },
          "searchPlaceholder": "kata kunci pencarian",
          "thousands": "."
        }
      });

      // Auto-increment 'No' column
      table.on('draw.dt', function() {
        var PageInfo = table.page.info();
        table.column(0, {
          page: 'current'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1 + PageInfo.start;
        });
      });

      // Filter logic tetap menggunakan yang lama
      $('#filterSemester').select2({
        placeholder: "Pilih Semester",
        allowClear: true,
        theme: 'bootstrap4',
        dropdownParent: $('#filterModal')
      });
      $('#filterTahun').select2({
        placeholder: "Pilih Tahun Akademik",
        allowClear: true,
        theme: 'bootstrap4',
        dropdownParent: $('#filterModal')
      });
      $('#filterLokasi').select2({
        placeholder: "Pilih Lokasi Survey",
        allowClear: true,
        theme: 'bootstrap4',
        dropdownParent: $('#filterModal')
      });
      $.fn.dataTable.ext.search.push(function(settings, data, dataIndex) {
        var semester = $('#filterSemester').val();
        var tahun = $('#filterTahun').val().toLowerCase();
        var penanggung = $('#filterPenanggungJawab').val().toLowerCase();
        var lokasi = $('#filterLokasi').val().toLowerCase();
        var min = $('#filterTanggalMin').val();
        var max = $('#filterTanggalMax').val();
        var dataSemester = data[2] ? data[2].toLowerCase() : '';
        var dataTahun = data[3] ? data[3].toLowerCase() : '';
        var dataPenanggung = data[1] ? data[1].toLowerCase() : '';
        var dataLokasi = data[5] ? data[5].toLowerCase() : '';
        var dataTanggal = data[4] ? data[4] : '';
        if (semester && dataSemester !== semester.toLowerCase()) return false;
        if (tahun && dataTahun !== tahun.toLowerCase()) return false;
        if (penanggung && dataPenanggung.indexOf(penanggung) === -1) return false;
        if (lokasi && dataLokasi !== lokasi.toLowerCase()) return false;
        if (min || max) {
          if (!dataTanggal || dataTanggal === '-') return false;
          var cellDate = moment(dataTanggal, 'DD MMM YYYY', true);
          if (!cellDate.isValid()) return false;
          var filterMinDate = min ? moment(min, 'YYYY-MM-DD') : null;
          var filterMaxDate = max ? moment(max, 'YYYY-MM-DD') : null;
          if (filterMinDate && cellDate.isBefore(filterMinDate)) return false;
          if (filterMaxDate && cellDate.isAfter(filterMaxDate)) return false;
        }
        return true;
      });
      $('#applyFiltersBtn').on('click', function() {
        table.draw();
        $('#filterModal').modal('hide');
      });
      $('#resetFiltersBtn').on('click', function() {
        $('#filterSemester').val('').trigger('change');
        $('#filterTahun').val('').trigger('change');
        $('#filterPenanggungJawab').val('');
        $('#filterLokasi').val('').trigger('change');
        $('#filterTanggalMin').val('');
        $('#filterTanggalMax').val('');
        table.draw();
      });
    });
  </script>
</body>

</html>