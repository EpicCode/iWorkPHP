<?php

namespace iWorkPHP;

/**
 * Config parser
 *
 * @author EpicJhon
 * @property SystemProperty $properties
 * @property Utils $utils
 */
class Config extends Kernel {

    private $config;

    /**
     * Load config to environment
     * 
     */
    public function loadConfig() {
        $this->parseConfig();
        $this->properties->setParameter('config', $this->utils->arrayToObject($this->config));
    }

    /**
     * Parse configuration file
     */
    private function parseConfig() {
        // Load raw config from .yml file
        $this->config = $this->utils->parseYAML($this->properties->getParameter('configDir') . 'configuration.yml');
    }

}
