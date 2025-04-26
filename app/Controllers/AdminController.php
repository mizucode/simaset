<?php


class AdminController
{
    private function renderView(string $view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../Views/Pages/Dashboard/{$view}.php";
    }

    public function index()
    {
        $this->renderView('index');
    }
}
