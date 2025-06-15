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
              <div class="card-header bg-light py-2">
                <h3 class="card-title mb-0" style="font-size: 1.1rem;">Filter Data</h3>
              </div>
              <div class="card-body pt-3 pb-3">
                <div class="form-group row mb-3 align-items-center">
                  <label for="jenisFilter" class="col-md-1 col-form-label">Jenis:</label>
                  <div class="col-md-11">
                    <select id="jenisFilter" class="form-control form-control-sm select2-custom">
                      <option value="">Semua Jenis</option>
                      <?php if (!empty($jenisList)) : ?>
                        <?php foreach ($jenisList as $jenis) : ?>
                          <option value="<?= htmlspecialchars($jenis); ?>"><?= htmlspecialchars($jenis); ?></option>
                        <?php endforeach; ?>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-3 align-items-center">
                  <label for="statusFilter" class="col-md-1 col-form-label">Status:</label>
                  <div class="col-md-11">
                    <select id="statusFilter" class="form-control form-control-sm select2-custom">
                      <option value="">Semua Status</option>
                      <option value="Tersedia">Tersedia</option>
                      <option value="Dipinjam">Dipinjam</option>
                      <option value="Terpakai">Terpakai</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row mb-0">
                  <div class="col-12 d-flex justify-content-start">
                    <button id="resetFilter" class="btn btn-secondary btn-sm px-4">Reset</button>
                  </div>
                </div>
              </div>
            </div>

            <div class="card shadow-md">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">
                  Data Sarana Mebelair
                </h3>
                <div class="ml-auto d-flex flex-column flex-sm-row align-items-sm-center">
                  <a href="/admin/sarana/mebelair/download-qr" class="btn btn-success btn-sm mb-2 mb-sm-0 mr-sm-2">
                    <i class="fas fa-download mr-1"></i> Download Semua QR
                  </a>
                  <button id="downloadSelectedQR" class="btn btn-primary btn-sm mb-2 mb-sm-0 mr-sm-2" title="Download QR untuk item yang dipilih">
                    <i class="fas fa-check-square mr-1"></i> QR Terpilih
                  </button>
                  <a href="/admin/sarana/mebelair/tambah" class="btn btn-warning btn-sm mb-2 mb-sm-0">
                    <i class="fas fa-plus mr-1"></i> Tambah Barang
                  </a>
                </div>
              </div>

              <div class="card-body p-3">
                <div class="table-responsive">
                  <table id="mebelairTable" class="table table-bordered table-striped w-100">
                    <thead class="bg-gray-100">
                      <tr class="text-center align-middle">
                        <th width="5%">No</th> <!-- Tetap -->
                        <th width="8%" class="text-center"> <!-- Disesuaikan dari 8% -->
                          Pilih Qr
                        </th>
                        <th width="15%">No Registrasi</th> <!-- Tetap -->
                        <th width="25%">Nama Barang</th> <!-- Tetap, nama barang bisa panjang -->
                        <th width="15%">Jenis</th> <!-- Tetap -->
                        <th width="15%">Status</th> <!-- Disesuaikan dari 15% -->
                        <th width="20%">Aksi</th> <!-- Tetap, untuk tombol aksi -->
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
                            <td class="text-center">
                              <?php
                              $status = htmlspecialchars($sarana['status'] ?? 'Tidak Diketahui');
                              $badgeClass = 'badge-secondary'; // Default badge
                              if ($status === 'Tersedia') {
                                $badgeClass = 'badge-success';
                              } elseif ($status === 'Dipinjam') {
                                $badgeClass = 'badge-warning';
                              } elseif ($status === 'Terpakai') {
                                $badgeClass = 'badge-info';
                              }
                              ?>
                              <span class="badge <?= $badgeClass; ?>"><?= $status; ?></span>
                            </td>
                            <td class="text-center">
                              <div class="d-flex justify-content-center gap-2">
                                <a href="/admin/sarana/mebelair/detail/<?= htmlspecialchars($sarana['no_registrasi']); ?>" class="btn btn-info btn-sm">
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

  <div class="modal fade" id="alertModal" tabindex="-1" role="dialog" aria-labelledby="alertModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="alertModalLabel">Peringatan</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          Silakan pilih minimal satu barang untuk diunduh QR code-nya.
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
        </div>
      </div>
    </div>
  </div>

  <?php require_once './app/Views/Components/script.php'; ?>
  <script>
    $(function() {
      var table = $("#mebelairTable").DataTable({
        "responsive": true,
        "lengthChange": true,
        "autoWidth": false,
        "paging": true,
        "info": true,
        "searching": true,
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
          },
          "aria": {
            "sortAscending": ": aktifkan untuk mengurutkan kolom ke atas",
            "sortDescending": ": aktifkan untuk mengurutkan kolom menurun"
          },
          "searchPlaceholder": "kata kunci pencarian",
          "thousands": "."
        },
        "ordering": false, // Menonaktifkan fitur ordering untuk semua kolom
        "columnDefs": [{
            "targets": 0, // Kolom "No"
            "orderable": false,
            "searchable": false // Kolom "No" tidak perlu bisa dicari
          },
          {
            "targets": 1, // Kolom "Pilih Qr"
            "orderable": false,
            "searchable": false
          },
          {
            "targets": [6], // Kolom "Aksi"
            "orderable": false,
            "searchable": false
          }
        ],
        "dom": "<'row'<'col-sm-12 col-md-6'l><'col-sm-12 col-md-6'f>>" +
          "<'row'<'col-sm-12'tr>>" +
          "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>"
      });


      $('#jenisFilter').on('change', function() {
        var val = $(this).val();

        table.column(4) // Index kolom 'Jenis' adalah 4 (No, Pilih, NoReg, Nama, Jenis)
          .search(val ? '^' + val + '$' : '', true, false)
          .draw();
      });

      $('#statusFilter').on('change', function() {
        var val = $(this).val();
        table.column(5) // Index kolom 'Status' adalah 5
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

      $('#statusFilter').select2({
        theme: 'bootstrap4',
        placeholder: "Pilih Status Barang",
        allowClear: false,
        minimumResultsForSearch: 1,
        width: '100%'
      });

      $('#resetFilter').on('click', function() {
        $('#jenisFilter').val('').trigger('change');
        $('#statusFilter').val('').trigger('change'); // Reset filter status juga
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
          $('#alertModal').modal('show');
          return;
        }

        var form = $('<form></form>');
        form.attr('method', 'POST');
        form.attr('action', '/admin/sarana/mebelair/download-qr'); // Action URL for Mebelair
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