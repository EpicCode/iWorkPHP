<?php

namespace iWorkPHP\Service\ORM;

use \iWorkPHP\Service\Config\Config;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Doctrine class
 */
class Doctrine {

    /**
     *
     * @var EntityManager
     */
    private $entityManager;

    /**
     *
     * @var Config
     */
    private $config;

    /**
     * Constructor
     * 
     * @param Config $config
     */
    public function __construct(Config $config) {
        $this->config = $config;
    }

    /**
     * Open database connection
     * 
     */
    private function openConnection() {
        $db = $this->config->getParam('db');

        $paths = array(
            $this->config->getParam('appDir') . '/Database/Metadata'
        );

        $dbParams = array(
            'driver' => $db->driver,
            'host' => $db->host,
            'port' => $db->port,
            'user' => $db->user,
            'password' => $db->password,
            'dbname' => $db->dbname
        );

        // Set environment mode
        if (!$this->config->getParam('environment')->debug) {
            $proxyDir = $this->config->getParam('frameDir') . 'cache';
        } else {
            $proxyDir = null;
        }

        // New configuration
        $config = Setup::createYAMLMetadataConfiguration($paths, $this->config->getParam('environment')->debug, $proxyDir);
        $this->entityManager = EntityManager::create($dbParams, $config);
    }

    /**
     * Return EntityManager instance
     * 
     * @return EntityManager
     */
    public function getEntityManager() {
        if ($this->entityManager === null) {
            $this->openConnection();
        }

        return $this->entityManager;
    }

}
