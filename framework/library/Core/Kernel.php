<?php

namespace iWorkPHP\Core;

/**
 * The Kernel Class
 * 
 */
class Kernel implements KernelInterface {
    
    /**
     * @var ServerManager
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
     */
    public static function getService($name) {
        return self::$serviceManager->getService($name);
    }

}
