<?php

namespace iWorkPHP;

use Symfony\Component\Yaml\Parser;

/**
 * Config parser
 *
 * @author EpicJhon
 */
class Config extends Kernel {

    private $config;

    // Load config to environment
    public function loadConfig() {
        $this->parseConfig();
        $this->properties->setParameter('config', $this->utils->arrayToObject($this->config));
    }

    private function parseConfig() {
        // New Symfony YAML Parser
        $yaml = new Parser();
        // Load raw config from .yml file
        $this->config = $yaml->parse(file_get_contents($this->properties->getParameter('configDir') . 'configuration.yml'));
    }

}
