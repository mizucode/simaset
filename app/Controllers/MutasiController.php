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
        $this->renderView('index', []);
    }

    public function create() {}
}
