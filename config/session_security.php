<?php


if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
  return;
}


if (isset($_SESSION['user_agent']) && $_SESSION['user_agent'] !== ($_SERVER['HTTP_USER_AGENT'] ?? '')) {

  session_unset();
  session_destroy();


  header('Location: /?error=session_invalidated');
  exit;
}


if (!isset($_SESSION['last_regen']) || time() - $_SESSION['last_regen'] > 900) {
  session_regenerate_id(true);
  $_SESSION['last_regen'] = time();
}
