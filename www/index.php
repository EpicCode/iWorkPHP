<?php

$composer = require_once __DIR__ . '/../vendor/autoload.php';
$loader = new \iWorkPHP\Loader($composer);
$loader->handleRequest();
$loader->send();
