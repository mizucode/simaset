<?php
require_once __DIR__ . '/../Models/Tanah.php';
require_once __DIR__ . '/../Models/Lokasi.php';

class LapangController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Lapang/{$view}.php";
    }
    public function lapang()
    {
        $this->renderView('index', []);
    }
}
