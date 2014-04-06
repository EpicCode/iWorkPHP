<?php

namespace iWorkPHP\Service\DependencyInjector;

use \DI\ContainerBuilder;

/**
 * Description of DependencyInjector
 */
class DependencyInjector {

    private $config;
    private $container;

    /**
     * Constructor
     */
    public function __construct(\iWorkPHP\Service\Config\Config $config) {
        $this->config = $config;
        $this->loadContainer(new ContainerBuilder());
    }

    /**
     * 
     * @param type $builder
     */
    private function loadContainer($builder) {
        $path = $this->config->getParam('appDir') . 'config/di/';

        if (is_dir($path)) {
            if (($handle = opendir($path))) {
                while (($file = readdir($handle)) !== false) {
                    if ($file == '.' || $file == '..') {
                        continue;
                    }

                    $builder->addDefinitions($path . $file);
                }

                closedir($handle);
            }

            $this->container = $builder->build();
        }
    }

    /**
     * Get service container
     * 
     * @return type object
     */
    public function getContainer() {
        return $this->container;
    }

}
