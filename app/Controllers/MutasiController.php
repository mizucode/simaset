<?php

class MutasiController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Mutasi/{$view}.php";
    }

    public function index()
    {
        global $conn;
        $mutasiBM = MutasiBarangMasuk::getAllData($conn);
        $mutasiBK = MutasiBarangKeluar::getAllData($conn);

        $this->renderView('index', [
            'mutasiBM' => $mutasiBM,
            'mutasiBK' => $mutasiBK,
        ]);
    }

    public function create() {}
}
