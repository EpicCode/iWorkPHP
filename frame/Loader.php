<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Loader
 *
 * @author Hax0r
 */
$composer = require_once __DIR__ . '/../vendor/autoload.php';
return new \iWorkPHP\Loader($composer);
