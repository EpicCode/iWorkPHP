<?php

/**
 * BETA
 * you should not even use it!
 */

namespace iWorkPHP\Service\ORM;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Doctrine class
 */

class Doctrine {
    
    private $entityManager;
    private $config;

    /**
     * Constructor
     */
    public function __construct(\iWorkPHP\Service\Config\Config $config) {
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
     * @return \Doctrine\ORM\EntityManager
     */
    public function getEntityManager() {
        return $this->entityManager;
    }

}
