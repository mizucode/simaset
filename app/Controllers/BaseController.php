<?php

class BaseController {
  protected $conn;

  public function __construct(PDO $conn) {
    $this->conn = $conn;
  }

  protected function renderView(string $viewPathPrefix, string $view, array $data = []) {
    extract($data);
    // Ensure the path is relative to the Views directory
    require_once __DIR__ . "/../Views/{$viewPathPrefix}/{$view}.php";
  }

  protected function redirect(string $url) {
    header("Location: {$url}");
    exit();
  }

  protected function setSessionMessage(string $type, string $message) {
    $_SESSION[$type] = $message;
  }

  protected function getPostData(array $fields, array $defaults = []) {
    $data = [];
    foreach ($fields as $field) {
      $data[$field] = $_POST[$field] ?? ($defaults[$field] ?? null);
    }
    return $data;
  }
}
