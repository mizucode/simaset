<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
  <div class="wrapper">

    <?php include './app/Views/Components/navbar.php'; ?>
    <?php include './app/Views/Components/aside.php'; ?>
    <style>
      /* Scroll hanya tabel */
      .table-responsive {
        max-height: 400px;
        /* Bisa kamu atur tinggi maksimal tabelnya */
        overflow-y: auto;
      }

      /* Tetap posisikan pagination + info di bawah */
      .dataTables_wrapper {
        display: flex;
        flex-direction: column;
      }

      .dataTables_wrapper .dataTables_paginate,
      .dataTables_wrapper .dataTables_info {
        position: sticky;
        bottom: 0;
        background: white;
        /* supaya nggak transparan pas scroll */
        z-index: 10;
        padding: 10px 0;
      }

      /* Make tables same width */
      .card {
        width: 100%;
      }

      .table {
        width: 100% !important;
        table-layout: auto;
      }

      /* Ensure columns have consistent width */
      th,
      td {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
      }
    </style>


    <div class="content-wrapper bg-white py-4 mb-5 px-5">
      <div class="container-fluid">
        <?php include './app/Views/Components/helper.php'; ?>
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Data Riwayat Pinjaman Barang</h3>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tablePeminjaman" class="table table-bordered table-striped">
                    <thead>
                      <tr class="text-nowrap">
                        <th>No</th>
                        <th class="text-nowrap">Nama Peminjam</th>
                        <th>NIK</th>
                        <th>Jabatan</th>
                        <th>No Telepon</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Barang</th>
                        <th>Kondisi</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status</th>
                        <th>Tujuan Peminjaman</th>
                        <th>Lokasi</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($peminjamanData)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($peminjamanData as $pm) : ?>
                          <tr>
                            <td><?= $counter++; ?></td>
                            <td><?= htmlspecialchars($pm['nama_peminjam'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($pm['nik'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($pm['jabatan'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($pm['no_telepon'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($pm['nama_barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($pm['jumlah_barang'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($pm['kondisi'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars(date('d-m-Y', strtotime($pm['tanggal_peminjaman'])) ?? '-'); ?></td>
                            <td><?= htmlspecialchars(date('d-m-Y', strtotime($pm['tanggal_pengembalian'])) ?? '-'); ?></td>
                            <td>
                              <?php
                              $status = htmlspecialchars($pm['status'] ?? '-');
                              $badgeClass = 'badge-secondary';

                              if ($status === 'Dipinjamkan') {
                                $badgeClass = 'badge-success';
                              } elseif ($status === 'Kembali') {
                                $badgeClass = 'badge-primary';
                              } elseif ($status === 'Hilang') {
                                $badgeClass = 'badge-danger';
                              }

                              echo '<span class="badge ' . $badgeClass . ' p-2" style="font-size: 1rem;">' . $status . '</span>';
                              ?>
                            </td>
                            <td><?= htmlspecialchars($pm['tujuan_peminjaman'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars($pm['lokasi'] ?? '-'); ?></td>
                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <tr>
                          <td colspan="13" class="text-center">Data tidak ditemukan</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div> <!-- card -->
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                <h3 class="h4 mb-0">Data Riwayat Pengembalian Barang</h3>

              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table id="tablePengembalian" class="table table-bordered table-striped">
                    <thead>
                      <tr class="text-nowrap">
                        <th>No</th>
                        <th>Detail Peminjaman</th>
                        <th>Nama Pengembali</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Nama Barang</th>
                        <th>Kondisi</th>
                        <th>Keterangan</th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php if (!empty($pengembalianData)) : ?>
                        <?php $counter = 1; ?>
                        <?php foreach ($pengembalianData as $pengembalian) : ?>
                          <tr>
                            <td><?= $counter++; ?></td>
                            <td>
                              <?= htmlspecialchars($pengembalian['nik'] ?? '-'); ?> -
                              <?= htmlspecialchars($pengembalian['nama_peminjam'] ?? '-'); ?> -
                              <?= htmlspecialchars($pengembalian['nama_barang'] ?? '-'); ?>
                            </td>


                            <td><?= htmlspecialchars($pengembalian['nama_peminjam'] ?? '-'); ?></td>
                            <td><?= htmlspecialchars(date('d-m-Y', strtotime($pengembalian['tanggal_pengembalian']))) ?? '-'; ?></td>
                            <td><?= htmlspecialchars($pengembalian['nama_barang'] ?? '-'); ?></td>
                            <td>
                              <?php
                              $kondisi = $pengembalian['kondisi'] ?? '-';
                              $badgeClass = 'badge-';
                              switch ($kondisi) {
                                case 'Baik':
                                  $badgeClass .= 'success';
                                  break;
                                case 'Rusak Ringan':
                                  $badgeClass .= 'warning';
                                  break;
                                case 'Rusak Berat':
                                  $badgeClass .= 'danger';
                                  break;
                                case 'Hilang':
                                  $badgeClass .= 'dark';
                                  break;
                                default:
                                  $badgeClass .= 'secondary';
                              }
                              ?>
                              <span class="badge <?= $badgeClass ?>"><?= $kondisi ?></span>
                            </td>
                            <td><?= htmlspecialchars($pengembalian['keterangan'] ?? '-'); ?></td>

                          </tr>
                        <?php endforeach; ?>
                      <?php else : ?>
                        <tr>
                          <td colspan="8" class="text-center">Tidak ada data pengembalian</td>
                        </tr>
                      <?php endif; ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div> <!-- card -->
          </div>
        </div>

        <!-- Modal Konfirmasi Hapus -->
        <div class="modal fade" id="modalHapus" tabindex="-1" role="dialog" aria-labelledby="modalHapusLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalHapusLabel">Konfirmasi Hapus</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Apakah Anda yakin ingin menghapus data pengembalian ini?
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <a href="#" id="hapusLink" class="btn btn-danger">Hapus</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <footer class="main-footer bg-white text-black">
      <strong>&copy; 2025 <a href="#">Lpptsi</a>. Umkuningan.</strong>
    </footer>

    <?php include './app/Views/Components/script.php'; ?>

    <script>
      $(document).ready(function() {
        // Initialize DataTables with consistent settings
        $('#tablePeminjaman').DataTable({
          responsive: true,
          autoWidth: false,
          lengthChange: true,
          ordering: true,
          buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
          language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
              first: "Pertama",
              last: "Terakhir",
              next: "Selanjutnya",
              previous: "Sebelumnya"
            },
            zeroRecords: "Data tidak ditemukan"
          }
        }).buttons().container().appendTo('#tablePeminjaman_wrapper .col-md-6:eq(0)');

        $('#tablePengembalian').DataTable({
          responsive: true,
          autoWidth: false,
          lengthChange: true,
          ordering: true,
          buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
          language: {
            search: "Cari:",
            lengthMenu: "Tampilkan _MENU_ data",
            info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ data",
            paginate: {
              first: "Pertama",
              last: "Terakhir",
              next: "Selanjutnya",
              previous: "Sebelumnya"
            },
            zeroRecords: "Data tidak ditemukan"
          }
        }).buttons().container().appendTo('#tablePengembalian_wrapper .col-md-6:eq(0)');

        // Konfirmasi hapus
        $('.btn-hapus').click(function() {
          var id = $(this).data('id');
          $('#hapusLink').attr('href', '/admin/pengembalian/hapus/' + id);
          $('#modalHapus').modal('show');
        });
      });
    </script>

  </div>
</body>

</html>