<?php
require_once __DIR__ . '/../Models/SurveySemesteran.php';
require_once __DIR__ . '/../Models/DataInventaris.php';


class SurveySemesteranController
{

    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Laporan/{$view}.php";
    }


    public function index()
    {
        global $conn;
        $semesterData = SurveySemesteran::getAllData($conn);

        $this->renderView('Survey/Semesteran/index', [
            'semesterData' => $semesterData
        ]);
    }
    public function create()
    {
        global $conn;

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $penanggung_jawab    = $_POST['penanggung_jawab'];
            $semester            = $_POST['semester'];
            $tahun_akademik      = $_POST['tahun_akademik'];
            $tanggal_pengecekan  = $_POST['tanggal_pengecekan'];
            $lokasi_survey       = $_POST['lokasi_survey'];

            try {
                $success = SurveySemesteran::storeData(
                    $conn,
                    $penanggung_jawab,
                    $semester,
                    $tahun_akademik,
                    $tanggal_pengecekan,
                    $lokasi_survey,
                );

                $message = $success ? 'Data survey semesteran berhasil ditambahkan.' : 'Gagal menambahkan data surevey semesteran.';
                $_SESSION['update'] = $message;

                if ($success) {
                    header('Location: /admin/survey/semesteran');
                    exit();
                }
            } catch (PDOException $e) {
                $_SESSION['error'] = 'Error database: ' . $e->getMessage();
            }
        }
        $this->renderView('Survey/Semesteran/create', []);
    }
    public function update($id)
    {
        global $conn;
        $semesterData = SurveySemesteran::getById($conn, $id);
        $inventarisData = DataInventaris::getByPenanggungJawabID($conn, $id);

        $this->renderView('Survey/Semesteran/update', [
            'data' => $semesterData,
            'inventarisData' => $inventarisData
        ]);
    }
}
