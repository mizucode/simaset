<!DOCTYPE html>
<html lang="en">
<?php include './app/Views/Components/head.php'; ?>

<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

        <?php include './app/Views/Components/navbar.php'; ?>
        <?php include './app/Views/Components/aside.php'; ?>

        <!-- Modal Konfirmasi Hapus -->
        <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Konfirmasi Hapus</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Apakah Anda yakin ingin menghapus data barang ATK ini?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <a id="deleteButton" href="#" class="btn btn-danger">Hapus</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="content-wrapper bg-white py-4 mb-5 px-3" width="75%">
            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-auto">
                        <?php include './app/Views/Components/helper.php'; ?>
                        <div class="card shadow-md">
                            <div class="card-header bg-navy text-white d-flex justify-content-between align-items-center">
                                <h3 class="h4 mb-0">Data Barang ATK</h3>
                                <a href="/admin/sarana/atk/tambah" class="btn btn-warning btn-sm ml-auto">
                                    <div class="text-dark">
                                        <i class="fas fa-plus mr-1"></i> Tambah Data
                                    </div>
                                </a>
                            </div>

                            <div class="card-body p-3">
                                <div class="overflow-hidden">
                                    <style>
                                        .compact-table th,
                                        .compact-table td {
                                            padding-top: 0.30rem !important;
                                            padding-bottom: 0.30rem !important;
                                            vertical-align: middle !important;
                                        }

                                        .compact-table .btn {
                                            padding: 0.25rem 0.5rem !important;
                                            font-size: 0.8rem !important;
                                        }
                                    </style>
                                    <table id="example1" class="table table-bordered table-responsive">
                                        <thead>
                                            <tr class="text-center align-middle bg-gray-100">
                                                <th>No</th>
                                                <th>No Registrasi</th>
                                                <th>Nama Barang</th>
                                                <th>Jenis</th>
                                                <th>Merk</th>
                                                <th>Spesifikasi</th>
                                                <th>Jumlah</th>
                                                <th>Satuan</th>
                                                <th>Kondisi</th>
                                                <th>Keterangan</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php if (!empty($saranaData)) : ?>
                                                <?php $counter = 1; ?>
                                                <?php foreach ($saranaData as $barang) : ?>
                                                    <tr class="align-middle">
                                                        <td class="text-center"><?= $counter++; ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($barang['no_registrasi'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['nama_detail_barang'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['barang'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars($barang['merk'] ?? '-'); ?></td>
                                                        <td><?= htmlspecialchars(substr($barang['spesifikasi'] ?? '-', 0, 30) . ((strlen($barang['spesifikasi'] ?? '-') > 30) ? '...' : '')) ?></td>
                                                        <td class="text-center"><?= htmlspecialchars($barang['jumlah'] ?? '0'); ?></td>
                                                        <td><?= htmlspecialchars($barang['satuan'] ?? 'Unit'); ?></td>
                                                        <td>
                                                            <?php
                                                            $kondisi = htmlspecialchars($barang['kondisi'] ?? '-');
                                                            $badgeClass = 'bg-gray-500';
                                                            if (strpos($kondisi, 'Baik') !== false) {
                                                                $badgeClass = 'bg-green-500';
                                                            } elseif (strpos($kondisi, 'Rusak Ringan') !== false) {
                                                                $badgeClass = 'bg-yellow-500';
                                                            } elseif (strpos($kondisi, 'Rusak Berat') !== false) {
                                                                $badgeClass = 'bg-red-500';
                                                            }
                                                            echo '<span class="' . $badgeClass . ' text-white px-3 py-1 rounded text-sm w-[120px] text-center d-inline-block">' . $kondisi . '</span>';
                                                            ?>
                                                        </td>
                                                        <td><?= htmlspecialchars(substr($barang['keterangan'] ?? '-', 0, 30) . ((is_string($barang['keterangan'] ?? '-') && strlen($barang['keterangan'] ?? '-') > 30) ? '...' : '')) ?></td>

                                                        <td class="text-center">
                                                            <div class="inline-flex flex-col items-center gap-2">
                                                                <button onclick="window.location.href='/admin/sarana/atk?edit=<?= $barang['id']; ?>'" class="w-24 flex justify-center items-center rounded-lg bg-yellow-400 py-1 px-2 text-sm text-gray-700 hover:bg-slate-700 hover:text-white">
                                                                    <i class="fas fa-edit"></i> Edit
                                                                </button>
                                                                <button type="button" data-id="<?= $barang['id']; ?>" data-toggle="modal" data-target="#deleteModal" class="w-24 flex justify-center items-center rounded-lg bg-red-600 py-1 px-2 text-sm text-white hover:bg-slate-700">
                                                                    <i class="fas fa-trash-alt"></i> Hapus
                                                                </button>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                            <?php else : ?>
                                                <tr>
                                                    <td colspan="11" class="text-center">Data tidak ditemukan</td>
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

        <?php include './app/Views/Components/foooter.php'; ?>
    </div>

    <?php include './app/Views/Components/script.php'; ?>

    <script>
        const exportTitle = 'Data Barang ATK';
        const exportButtons = ['csv', 'excel', 'pdf', 'print'].map(type => ({
            extend: type,
            title: exportTitle
        }));
        exportButtons.push({
            extend: 'colvis',
            text: 'Tampilkan/Sembunyikan Kolom'
        });

        $("#example1").DataTable({
            responsive: true,
            lengthChange: true,
            ordering: false,
            autoWidth: false,
            buttons: exportButtons,
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
            },
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    </script>

    <script>
        $(document).ready(function() {
            $('button[data-target="#deleteModal"]').on('click', function() {
                var id = $(this).data('id');
                var deleteUrl = '/admin/sarana/atk?delete=' + id;
                $('#deleteButton').attr('href', deleteUrl);
                $('#deleteModal').modal('show');
            });
        });
    </script>
</body>

</html>