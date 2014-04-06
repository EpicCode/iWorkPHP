<?php

namespace iWorkPHP\Core;

use \iWorkPHP\Service\Utils\Utils;
use \iWorkPHP\Service\Config\Config;
use \iWorkPHP\Service\Twig\Twig;
use \iWorkPHP\Service\ORM\Doctrine;
use \iWorkPHP\Service\DependencyInjector\DependencyInjector;
use \iWorkPHP\Service\HttpFoundation\Request;
use \iWorkPHP\Service\HttpFoundation\Response;
use \iWorkPHP\Service\Router\Router;

class ServiceManager {

    /**
     * Service list
     * 
     * @var array 
     */
    private $service_list = array();

    /**
     * Constructor
     */
    public function __construct() {
        $this->loadServices();
    }

    /**
     * Load kernel services
     */
    private function loadServices() {
        $this->addService('utils', new Utils());
        $this->addService('request', new Request());
        $this->addService('response', new Response());

        $this->addService('config', new Config(
                $this->getService('utils')
            )
        );

        $this->addService('doctrine', new Doctrine(
                $this->getService('config')
            )
        );

        $this->addService('di', new DependencyInjector(
                $this->getService('config')
            )
        );

        $this->addService('router', new Router(
                $this->getService('utils'), 
                $this->getService('config'), 
                $this->getService('request')
            )
        );

        $this->addService('twig', new Twig(
                $this->getService('config'),
                $this->getService('router')
            )
        );
    }

    /**
     * Add new service to service list
     * 
     * @param string $name
     * @param mixed $service
     */
    public function addService($name, $service) {
        $this->service_list[$name] = $service;
    }

    /**
     * 
     * @param string $service
     * @return mixed
     * @throws Exception
     */
    public function getService($service) {
        if (!array_key_exists($service, $this->service_list)) {
            throw new \Exception('Error: there is no service by ' . $service . ' name...');
        }

        return $this->service_list[$service];
    }

}
