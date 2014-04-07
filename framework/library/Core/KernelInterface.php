<?php

namespace iWorkPHP\Core;

interface KernelInterface {

    /**
     * Load critical services
     * 
     * @return void
     */
    public static function loadServices();

    /**
     * Get service instance by name
     * 
     * @param string $name
     * @return mixed
     */
    public static function getService($name);
}
