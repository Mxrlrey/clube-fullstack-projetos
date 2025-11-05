<?php

function load() {
    $page = filter_input(INPUT_GET, 'page', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

    $page = (!$page) ? 'pages/home.php' : "pages/{$page}.php";

    if (!file_exists($page)) {
        throw new \Exception("Algo deu errado.");
    }

    return $page;
}

