<?php

// Get the composer autoload
$composer = require_once __DIR__ . '/../vendor/autoload.php';
// Call to frameowrk loader
$loader = new \iWorkPHP\Loader($composer);
// handle actual request
$loader->handleRequest();
// Send response from actual request
$loader->send();
