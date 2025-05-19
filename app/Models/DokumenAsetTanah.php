<?php

class DokumenAsetTanah
{
    public static function getAllData($conn)
    {
        $query = "SELECT * FROM dokumen_aset_tanah";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }
    public static function getAllDataGambar($conn)
    {
        $query = "SELECT * FROM dokumentasi_tanah";
        $stmt = $conn->prepare($query);
        try {
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e) {
            return "Query gagal: " . $e->getMessage();
        }
    }

    public static function getDokumenById($conn, $id)
    {
        $query = "SELECT * FROM dokumen_aset_tanah WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public static function getDokumenGambarById($conn, $id)
    {
        $query = "SELECT * FROM dokumentasi_tanah WHERE id = :id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public static function storeData(
        $conn,
        $tanah_id,
        $file_dokumen,
        $keterangan
    ) {
        $fields = [
            'tanah_id' => $tanah_id,
            'file_dokumen' => $file_dokumen,
            'keterangan' => $keterangan
        ];

        $columns = implode(', ', array_keys($fields));
        $placeholders = ':' . implode(', :', array_keys($fields));

        $query = "INSERT INTO dokumen_tanah ($columns) VALUES ($placeholders)";
        $stmt = $conn->prepare($query);

        foreach ($fields as $key => &$value) {
            if ($key === 'file_dokumen') {
                // Bind the file parameter as a stream
                if (is_file($value)) {
                    // Open the file in read mode
                    $fileStream = fopen($value, 'rb');
                    if ($fileStream) {
                        // Bind the stream to the statement
                        $stmt->bindParam(":$key", $fileStream, PDO::PARAM_LOB);
                    } else {
                        throw new Exception("Unable to open file: " . htmlspecialchars($value));
                    }
                } else {
                    throw new Exception("File not found: " . htmlspecialchars($value));
                }
            } else {
                // Bind other parameters normally
                $stmt->bindParam(":$key", $fields[$key]);
            }
        }

        return $stmt->execute();
    }
}
