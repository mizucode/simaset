<?php
include 'includes/lteHeader.php';
include 'includes/lteSidebar.php';

// Query ke database dengan JOIN untuk menghindari N+1 queries
$pertanyaan_list = [];
$jawaban_map = [];

$query = "SELECT p.pertanyaan_id, p.pertanyaan, p.wajib, p.segmen, p.placeholder, p.keterangan, 
                 j.jawaban_id, j.jawaban, j.tipe_input 
          FROM pertanyaan p
          LEFT JOIN jawaban j ON p.pertanyaan_id = j.jawaban_pertanyaan
          ORDER BY p.pertanyaan_id DESC, j.jawaban_id ASC";

$result = mysqli_query($koneksi, $query);

if ($result) {
  $current_pertanyaan_id = null;

  while ($row = mysqli_fetch_assoc($result)) {
    $pertanyaan_id = $row['pertanyaan_id'];

    if (!isset($pertanyaan_list[$pertanyaan_id])) {
      $pertanyaan_list[$pertanyaan_id] = [
        'pertanyaan_id' => $row['pertanyaan_id'],
        'pertanyaan' => $row['pertanyaan'],
        'wajib' => $row['wajib'],
        'segmen' => $row['segmen'], // PASTIKAN INI ADA
        'placeholder' => $row['placeholder'],  // PASTIKAN INI DITAMBAHKAN
        'keterangan' => $row['keterangan']    // JIKA DIBUTUHKAN
      ];
    }

    // Simpan jawaban jika ada
    if ($row['jawaban_id']) {
      $jawaban_map[$pertanyaan_id][] = [
        'jawaban' => $row['jawaban'],
        'tipe_input' => $row['tipe_input']
      ];
    }
  }

  // Reset array keys untuk pertanyaan_list
  $pertanyaan_list = array_values($pertanyaan_list);
}
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <div style="position: fixed; top: 70px; right: 20px; z-index: 9999; min-width: 300px;">
    <?php //Flasher::flash(); 
    ?>
  </div>

  <!-- Content Header (Page header) -->
  <div class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1 class="m-0">Kuesioner</h1>
        </div><!-- /.col -->
        <div class="col-sm-6">
          <!-- <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active">Starter Page</li>
          </ol> -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content-header -->

  <!-- Main content -->
  <div class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- TABLES -->
        <div class="col-lg-12">

          <div class="card">
            <div class="card-header bg-navy">
              <h3 class="card-title">Tabel Kuesioner</h3>
              <div class="card-tools">
                <!--  -->
                <button type="button" class="btn btn-warning btn-sm font-weight-bold" data-toggle="modal" data-target="#modalTambahPertanyaan">
                  <i class="fas fa-plus"></i>
                  Tambah Pertanyaan
                </button>

                <form action="master_pertanyaan_act.php" method="post">
                  <div class="modal fade" id="modalTambahPertanyaan" tabindex="-1" role="dialog" aria-labelledby="labelTambahPertanyaan" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="labelTambahPertanyaan">Buat Pertanyaan Baru</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <div class="modal-body">

                          <div class="form-group">
                            <label>Pertanyaan</label>
                            <input type="text" name="pertanyaan" class="form-control" placeholder="Tuliskan pertanyaan anda" required>
                          </div>

                          <div class="form-group">
                            <label>Segmen</label>
                            <select name="segmen" class="form-control" required>
                              <option value="identitas">Identitas</option>
                              <option value="status">Status</option>
                              <option value="lokasiKerja">Lokasi Tempat Kerja</option>
                              <option value="posisiBekerja">Posisi Bekerja</option>
                              <option value="studiLanjut">Studi Lanjut</option>
                              <option value="kompetensi">Komptensi</option>
                              <option value="penekananMetodePembelajaran">Penekanan Metode Pembelajaran</option>
                              <option value="kuesionerOpsional1">Kuesioner Opsional 1</option>
                              <option value="kuesionerOpsional2">Kuesioner Opsional 2</option>
                            </select>
                          </div>

                          <div class="form-group">
                            <label for="placeholder">Placeholder (Opsional)</label>
                            <input type="text" name="placeholder" class="form-control" id="placeholder" placeholder="Tuliskan placeholder pertanyaan" autocomplete="off">
                          </div>

                          <div class="form-group">
                            <label for="keterangan">Keterangan (Opsional)</label>
                            <input type="text" name="keterangan" class="form-control" id="keterangan" placeholder="Tuliskan keterangan pertanyaan" autocomplete="off">
                          </div>

                          <div class="form-group form-check">
                            <input type="checkbox" name="wajib" value="ya" class="form-check-input" id="wajibCheck" checked>
                            <label class="form-check-label" for="wajibCheck">Pertanyaan wajib diisi</label>
                          </div>

                        </div>

                        <div class="modal-footer">
                          <button type="button" class="btn btn-danger btn-sm" data-dismiss="modal"><i class="fa fa-close"></i> Batal</button>
                          <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i> Simpan</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </form>


              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <!-- area button -->
              <div class="d-flex justify-content-end mb-3">

              </div>
              <!-- area button -->
              <table id="example1" class="table table-bordered">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Nama Peminjam</th>
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
                  </tr>
                </thead>
                <tbody>
                  <?php if (!empty($peminjaman)) : ?>
                    <?php $counter = 1; ?>
                    <?php foreach ($peminjaman as $pm) : ?>
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
                        <td><?= htmlspecialchars($pm['status'] ?? '-'); ?></td>
                        <td><?= htmlspecialchars($pm['tujuan_peminjaman'] ?? '-'); ?></td>
                      </tr>
                    <?php endforeach; ?>
                  <?php else : ?>
                    <tr>
                      <td colspan="12" class="text-center">Data tidak ditemukan</td>
                    </tr>
                  <?php endif; ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>

      </div>
      <!-- /.row -->
    </div><!-- /.container-fluid -->
  </div>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<?php include 'includes/lteFooter.php' ?>

<script>
  $(function() {
    $("#example1")
      .DataTable({
        responsive: true,
        lengthChange: false,
        autoWidth: false,
        ordering: false,
        pageLength: 15
      })
      .buttons()
      .container()
      .appendTo("#kuesioner_wrapper .col-md-6:eq(0)");

  });
</script>