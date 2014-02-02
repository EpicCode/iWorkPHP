<?php

$loader = require_once __DIR__ . '/../frame/Loader.php';
$loader->handleRequest();
$loader->send();