<?php

namespace iWorkPHP;

/**
 * The Kernel Class
 * 
 * creates a dynamic interface singleton services 
 * defines the basic services
 */
class Kernel {

    private $globals;

    public function __construct() {
        $this->globals = array(
            'env',
            'server',
            'get',
            'post',
            'cookie',
            'files'
        );

        // Singleton Kernel
        if (isset($GLOBALS['8a716159a6854658daeaae10dbcad11420596bfdf95a429e3899ba74adb293e8']))
            return;
        /**
         * clone root variables
         */
        foreach ($this->globals as $value) {
            $var = '_' . strtoupper($value);
            $obj = json_decode(json_encode($GLOBALS[$var]), FALSE);
            $this->set($value, $obj);
        }

        $this->defineKernelServices();
        $GLOBALS['8a716159a6854658daeaae10dbcad11420596bfdf95a429e3899ba74adb293e8'] = true;
    }

    /**
     * Get Singleton Class (Get Service)
     * 
     * @param mixed $var
     * @return mixed
     */
    public static function &get($service) {
        if (isset($GLOBALS[$service]))
            return $GLOBALS[$service];
        else {
            $GLOBALS[$service] = new $service();
            return $GLOBALS[$service];
        }
    }

    // resolve names to get
    public function __get($name) {
        return $this->get($name);
    }

    // resolve names to set
    public function __set($name, $value) {
        if (!in_array($name, $this->globals))
            return $this->set($name, $value);
    }

    /**
     * Create new Singleton Class (New Service)
     * 
     * @param string $name
     * @param string $service
     * @return mixed
     */
    public static function set($name, $service) {
        if (is_string($service))
            return $GLOBALS[$name] = new $service();
        else
            return $GLOBALS[$name] = $service;
    }

    /**
     * Define kernel services
     */
    private function defineKernelServices() {
        $this->properties = new SystemProperty();
        $this->utils = new Utils();
    }

}
