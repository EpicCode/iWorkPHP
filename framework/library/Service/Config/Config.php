<?php

namespace iWorkPHP\Service\Config;

use \iWorkPHP\Service\Utils\Utils;

/**
 * Framework critical configuration
 */
class Config {

    /**
     *
     * @var Utils
     */
    private $utils = null;

    /**
     * Configuration list
     * 
     * @var \stdClass 
     */
    private $config = null;

    /**
     * Constructor
     * 
     * @param Utils $utils
     */
    public function __construct(Utils $utils) {
        $this->utils = $utils;
        $this->config = new \stdClass();

        $this->addParam('frameDir', dirname(dirname(dirname(__DIR__))) . '/');
        $this->addParam('baseDir', dirname(dirname(dirname(dirname(__DIR__)))) . '/');
        $this->addParam('appDir', $this->getParam('baseDir') . 'app/');
        $this->addParam('configDir', $this->getParam('appDir') . 'Config/');
        $this->addParam('cacheDir', $this->getParam('frameDir') . 'cache/');
        $this->addParam('databaseDir', $this->getParam('appDir') . 'Database/');

        $this->loadConfig();
    }

    /**
     * Load user configuration
     */
    public function loadConfig() {
        $config = $this->utils->parseYAML($this->getParam('configDir') . 'configuration.yml');

        foreach ($this->utils->arrayToObject($config) as $key => $value) {
            $this->addParam($key, $value);
        }
    }

    /**
     * Add param to configuration list
     * 
     * @param string $name
     * @param mixed $param
     */
    public function addParam($name, $param) {
        if (!$this->hasParam($name)) {
            $this->config->$name = $param;
        }
    }

    /**
     * Check if param exists
     * 
     * @param string $name
     * @return boolean
     */
    public function hasParam($name) {
        return property_exists($this->config, $name);
    }

    /**
     * Get a param from configuration list
     * 
     * @param string $name
     * @return mixed
     */
    public function getParam($name) {
        if ($this->hasParam($name)) {
            return $this->config->$name;
        }
    }

    /**
     * Set a param from configuration list
     * 
     * @param string $name
     * @param mixed $param
     */
    public function setParam($name, $param) {
        if ($this->hasParam($name)) {
            $this->config->$name = $param;
        }
    }

}
