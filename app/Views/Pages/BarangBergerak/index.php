<!DOCTYPE html>
<html lang="en">
<?php require_once './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">
    <?php require_once './app/Views/Components/navbar.php'; ?>
    <?php require_once './app/Views/Components/aside.php'; ?>

    <div class="content-wrapper bg-white py-4 mb-5 px-3">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-12">
            <?php include './app/Views/Components/helper.php'; ?>

            <div class="card shadow-md mb-3" style="border-top: 3px solid #001f3f;">
              <div class="card-header bg-light">
                <h3 class="card-title">Filter Data</h3>
              </div>
              <div class="card-body">
                <div class="form-group row">
                  <label for="jenisFilter" class="col-md-2 col-12 col-form-label">Filter Berdasarkan Jenis:</label>
                  <div class="col-md-4 col-12 mb-2 mb-md-0">
                    <select id="jenisFilter" class="form-control form-control-sm select2-custom">
                      <option value="">Semua Jenis</option>
                      <?php if (!empty($jenisList)) : ?>
                        <?php foreach ($jenisList as $jenis) : ?>
                          <option value="<?= htmlspecialchars($jenis); ?>"><?= htmlspecialchars($jenis); ?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                  <div class="col-md-2 col-12 d-flex">
                    <button id="resetFilter" class="btn btn-secondary btn-sm w-100">Reset Filter</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="card shadow-md">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">
                  Data Sarana Bergerak
                </h3>
                <div class="ml-auto d-flex flex-column flex-sm-row">
                  <button id="downloadSelectedQR" class="btn btn-primary btn-sm mb-2 mb-sm-0 mr-sm-2">
                    <i class="fas fa-check-square mr-1"></i> Download QR Terpilih
                  </button>
                  <a href="/admin/sarana/bergerak/download-qr" class="btn btn-success btn-sm">
                    <i class="fas fa-download mr-1"></i> Download Semua QR
                  </a>
                </div>
              </div>
              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="saranaTable" class="table table-bordered table-striped w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th>
                        <th width="8%" class="text-center">
                          Pilih Qr
                        </th>
                        <th width="15%">No Registrasi</th>
                        <th width="25%">Nama Barang</th>
                        <th width="15%">Jenis</th>
                        <th width="15%">No Polisi</th>
                        <th width="20%">Aksi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($saranaData)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($saranaData as $sarana) : ?>
                          <tr class="align-middle">
                            <td class="text-center"><?= $counter++; ?></td>
                            <td class="text-center">
                              <input type="checkbox" class="row-checkbox" data-id="<?= htmlspecialchars($sarana['id']); ?>">
                            </td>
                            <td class="text-center"><?= htmlspecialchars($sarana['no_registrasi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($sarana['nama_detail_barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($sarana['barang'] ?? '-'); ?></td>
                            <td class="text-center"><?= htmlspecialchars($sarana['no_polisi'] ?? '-'); ?></td>
                            <td class="text-center">
                              <div class="d-flex justify-content-center gap-2">
                                <a href="/admin/sarana/bergerak?detail=<?= $sarana['id']; ?>" class="btn btn-info btn-sm">
                                  <i class="fas fa-eye mr-1"></i> Detail
                                </a>
                              </div>
                            </td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <tr>
                          <td colspan="7" class="text-center">Data tidak ditemukan</td>
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
    <?php require_once './app/Views/Components/footer.php'; ?>
  </div>

  <?php require_once './app/Views/Components/script.php'; ?>
  <script>
    $(function() {
      var table = $("#saranaTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "searching": true,
        "ordering": false,
        "columnDefs": [{
            "targets": 0,
            "orderable": false,
            "searchable": false
          },
          {
            "targets": 1,
            "orderable": false,
            "searchable": false
          },
          {
            "targets": [6],
            "orderable": false,
            "searchable": false
          }
        ],
        "language": {
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
          }
        },
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
      });

      $('#jenisFilter').on('change', function() {
        var val = $(this).val();
        table.column(4) // Index kolom 'Jenis'
          .search(val ? '^' + val + '$' : '', true, false)
          .draw();
      });

      table.on('draw.dt', function() {
        var PageInfo = table.page.info();
        table.column(0, {
          page: 'current'
        }).nodes().each(function(cell, i) {
          cell.innerHTML = i + 1 + PageInfo.start;
        });
      });

      $('#jenisFilter').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Jenis Barang",
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });

      // Event listener untuk tombol reset filter
      $('#resetFilter').on('click', function() {
        $('#jenisFilter').val('').trigger('change');
      });

      // Handle "Pilih Semua" checkbox
      $('#selectAllCheckboxes').on('click', function() {
        var isChecked = $(this).is(':checked');
        $('.row-checkbox').prop('checked', isChecked);
      });

      // Handle "Download QR Terpilih" button
      $('#downloadSelectedQR').on('click', function() {
        var selectedIds = [];
        $('.row-checkbox:checked').each(function() {
          selectedIds.push($(this).data('id'));
        });

        if (selectedIds.length === 0) {
          alert('Silakan pilih minimal satu barang untuk diunduh QR code-nya.');
          return;
        }

        // Create a dynamic form to POST selected IDs
        var form = $('<form></form>');
        form.attr('method', 'POST');
        form.attr('action', '/admin/sarana/bergerak/download-qr');
        form.attr('target', '_blank');

        $.each(selectedIds, function(index, id) {
          var input = $('<input>');
          input.attr('type', 'hidden');
          input.attr('name', 'selected_ids[]');
          input.attr('value', id);
          form.append(input);
        });

        $('body').append(form);
        form.submit();
        form.remove();
      });
    });
  </script>
</body>

</html>