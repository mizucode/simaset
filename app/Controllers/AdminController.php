<?php
require_once __DIR__ . '/../Models/User.php';
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
    public function devView()
    {
        global $conn;
        $saranaData = SaranaBergerak::getAllData($conn);
        $this->renderView('test', [
            'saranaData' => $saranaData,
        ]);
    }
}
