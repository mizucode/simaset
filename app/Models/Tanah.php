<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

class Tanah
{
    public static function getAllData($conn)
    {
        $query = "SELECT aset_tanah.*, jenis_aset.jenis_aset 
              FROM aset_tanah 
              JOIN jenis_aset ON aset_tanah.jenis_aset_id = jenis_aset.id";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }
    public static function getByFilename($conn, $filename)
    {
        $stmt = $conn->prepare("SELECT * FROM tanah WHERE file_sertifikat = ?");
        $stmt->bind_param("s", $filename);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public static function getById($conn, $id)
    {
        $query = "SELECT aset_tanah.*, jenis_aset.jenis_aset 
              FROM aset_tanah 
              JOIN jenis_aset ON aset_tanah.jenis_aset_id = jenis_aset.id
              WHERE aset_tanah.id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function storeData(
        $conn,
        $kode_aset,
        $nama_aset,
        $jenis_aset_id,
        $nomor_sertifikat,
        $luas,
        $lokasi,
        $tgl_pajak,
        $fungsi,
        $keterangan,
        $file_sertifikat // tambahkan parameter baru
    ) {
        $fields = [
            'kode_aset' => $kode_aset,
            'nama_aset' => $nama_aset,
            'jenis_aset_id' => $jenis_aset_id,
            'nomor_sertifikat' => $nomor_sertifikat,
            'luas' => $luas,
            'lokasi' => $lokasi,
            'tgl_pajak' => $tgl_pajak,
            'fungsi' => $fungsi,
            'keterangan' => $keterangan,
            'file_sertifikat' => $file_sertifikat // tambahkan ke array
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO aset_tanah ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }

    public static function updateData(
        $conn,
        $id,
        $kode_aset,
        $nama_aset,
        $jenis_aset_id,
        $nomor_sertifikat,
        $luas,
        $lokasi,
        $tgl_pajak,
        $fungsi,
        $keterangan,
        $file_sertifikat // tambahkan parameter baru
    ) {
        $query = "UPDATE aset_tanah SET 
                kode_aset = :kode_aset,
                nama_aset = :nama_aset,
                jenis_aset_id = :jenis_aset_id,
                nomor_sertifikat = :nomor_sertifikat,
                luas = :luas,
                lokasi = :lokasi,
                tgl_pajak = :tgl_pajak,
                fungsi = :fungsi,
                keterangan = :keterangan,
                file_sertifikat = :file_sertifikat
                WHERE id = :id";

        $stmt = $conn->prepare($query);
        $stmt->bindParam(':kode_aset', $kode_aset);
        $stmt->bindParam(':nama_aset', $nama_aset);
        $stmt->bindParam(':jenis_aset_id', $jenis_aset_id);
        $stmt->bindParam(':nomor_sertifikat', $nomor_sertifikat);
        $stmt->bindParam(':luas', $luas);
        $stmt->bindParam(':lokasi', $lokasi);
        $stmt->bindParam(':tgl_pajak', $tgl_pajak);
        $stmt->bindParam(':fungsi', $fungsi);
        $stmt->bindParam(':keterangan', $keterangan);
        $stmt->bindParam(':file_sertifikat', $file_sertifikat);
        $stmt->bindParam(':id', $id);

        return $stmt->execute();
    }

    public function preview()
    {
        if (!isset($_SESSION['user'])) {
            header('HTTP/1.1 403 Forbidden');
            exit('Unauthorized');
        }

        $filename = basename($_GET['filename']);
        $jenis = $_GET['jenis'];

        // Pastikan folder sesuai dengan jenis file
        $folder = '';
        if ($jenis === 'sertifikat') {
            $folder = 'sertifikat';
        } elseif ($jenis === 'bukti') {
            $folder = 'bukti';
        } else {
            http_response_code(400);
            echo "Invalid file type.";
            exit;
        }

        $filepath = __DIR__ . '/../../storage/' . $folder . '/' . $filename;

        if (!file_exists($filepath)) {
            http_response_code(404);
            echo "File not found.";
            exit;
        }

        // Tampilkan langsung file PDF di browser
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . $filename . '"');
        readfile($filepath);
        exit;
    }


    public static function deleteData($conn, $id)
    {
        $query = "DELETE FROM aset_tanah WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public static function storeDokumenTanah(
        $conn,
        $aset_tanah_id,
        $nama_dokumen,
        $path_dokumen
    ) {
        $fields = [
            'aset_tanah_id' => $aset_tanah_id,
            'nama_dokumen' => $nama_dokumen,
            'path_dokumen' => $path_dokumen

        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO dokumen_aset_tanah ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }
    public static function storeDokumentasiTanah(
        $conn,
        $aset_tanah_id,
        $nama_dokumen,
        $path_dokumen
    ) {
        $fields = [
            'aset_tanah_id' => $aset_tanah_id,
            'nama_dokumen' => $nama_dokumen,
            'path_dokumen' => $path_dokumen

        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO dokumentasi_tanah ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => $value) {
            $stmt->bindValue(":$key", $value);
        }

        return $stmt->execute();
    }
}
