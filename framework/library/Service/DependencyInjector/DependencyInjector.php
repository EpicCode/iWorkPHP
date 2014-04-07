<?php

namespace iWorkPHP\Service\DependencyInjector;

use \DI\ContainerBuilder;
use \iWorkPHP\Service\Config\Config;

/**
 * Description of DependencyInjector
 */
class DependencyInjector {

    /**
     *
     * @var Config
     */
    private $config;

    /**
     *
     * @var \DI\Container
     */
    private $container;

    /**
     * Constructor
     * 
     * @param Config $config
     */
    public function __construct(Config $config) {
        $this->config = $config;
        $this->loadContainer(new ContainerBuilder());
    }

    /**
     * Load container by 'ContainerBuilder'
     * 
     * @param ContainerBuilder $builder
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
     * Get container
     * 
     * @return \DI\Container
     */
    public function getContainer() {
        return $this->container;
    }

}
