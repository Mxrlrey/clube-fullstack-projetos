<?php

if (!ob_get_level()) {
    ob_start();
}

session_start();

require "vendor/autoload.php";