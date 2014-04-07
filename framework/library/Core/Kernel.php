<?php

namespace iWorkPHP\Core;

/**
 * The Kernel Class
 * 
 */
class Kernel implements KernelInterface {

    /**
     *
     * @var ServiceManager
     */
    private static $serviceManager;

    /**
     * Load critical services
     */
    public static function loadServices() {
        self::$serviceManager = new ServiceManager();
    }

    /**
     * Get service instance by name
     * 
     * @param string $name
     * @return mixed
     */
    public static function getService($name) {
        return self::$serviceManager->getService($name);
    }

}
