<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=laporan_data_tanah.xls");
?>

<table class="table table-bordered table-hover text-sm">
    <thead class="">
        <tr>
            <th>Nama Lokasi</th>
            <th>Alamat</th>
            <th>Luas</th>
            <th>Status Kepemilikan</th>
            <th>No Sertifikat</th>
            <th>Tanggal Perolehan</th>
            <th>Penggunaan</th>
            <th>Keterangan</th>

        </tr>
    </thead>
    <tbody>
        <?php if (!empty($tanahData)) {
            foreach ($tanahData as $tanah) { ?>
                <tr>
                    <td><?= htmlspecialchars($tanah['nama_lokasi']) ?></td>
                    <td><?= htmlspecialchars($tanah['alamat']) ?></td>
                    <td><?= number_format($tanah['luas'], 2) ?> m²</td>
                    <td><?= htmlspecialchars($tanah['status_kepemilikan']) ?></td>
                    <td><?= htmlspecialchars($tanah['no_sertifikat'] ?? 'data tidak ditemukan') ?></td>
                    <td><?= htmlspecialchars($tanah['tanggal_perolehan']) ?></td>
                    <td><?= htmlspecialchars($tanah['penggunaan']) ?></td>
                    <td><?= htmlspecialchars($tanah['keterangan']) ?></td>



                </tr>
        <?php }
        } else {
            echo "<tr><td colspan='10'>Data tidak ditemukan</td></tr>";
        } ?>
    </tbody>
</table>