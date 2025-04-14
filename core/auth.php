<?php

function auth()
{
    if (!isset($_SESSION['login'])) {
        header('Location: /');
        exit;
    }
}
