<?php

namespace iWorkPHP\Core;

interface KernelInterface {

    /**
     * 
     */
    public static function loadServices();

    /**
     * 
     */
    public static function getService($name);
}
