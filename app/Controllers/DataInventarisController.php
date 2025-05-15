<?php
require_once __DIR__ . '/../Models/SurveySemesteran.php';


class DataInventarisController
{

    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Laporan/{$view}.php";
    }


    public function index()
    {
        $this->renderView('Survey/Semesteran/DataInventaris/create', []);
    }

    public function create($id)
    {
        global $conn;
        $semesterData = SurveySemesteran::getById($conn, $id);

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $penanggung_jawab_id = $_POST['penanggung_jawab_id'] ?? '';
            $nama_barang_survey = $_POST['nama_barang_survey'] ?? '';
            $jumlah = $_POST['jumlah'] ?? '';
            $kondisi = $_POST['kondisi'] ?? '';
            $kebutuhan = $_POST['kebutuhan'] ?? '';
            $keterangan = $_POST['keterangan'] ?? '';

            try {
                $success = DataInventaris::store(
                    $conn,
                    $penanggung_jawab_id,
                    $nama_barang_survey,
                    $jumlah,
                    $kondisi,
                    $kebutuhan,
                    $keterangan
                );

                $message = $success ? 'Data pengembalian berhasil ditambahkan.' : 'Gagal menambahkan data pengembalian.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/survey/semesteran?edit=' . $id);
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }

        $this->renderView('Survey/Semesteran/DataInventaris/create', [
            'semesterData' => $semesterData
        ]);
    }
}
