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

        $dbConfig = $this->config->getParam('db');
        $this->openConnection($dbConfig);
    }

    /**
     * Open database connection
     * 
     * @param stdClass $db
     */
    private function openConnection($db) {
        $paths = array(
            $this->config->getParam('appDir') . '/database/Metadata'
        );

        $dbParams = array(
            'driver' => $db->driver,
            'user' => $db->user,
            'password' => $db->password,
            'dbname' => $db->dbname
        );

        // New configuration
        $config = Setup::createYAMLMetadataConfiguration($paths);
        $this->entityManager = EntityManager::create($dbParams, $config);
    }

    /**
     * Return EntityManager instance
     * 
     * @return EntityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

}
