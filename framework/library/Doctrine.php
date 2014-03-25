<?php

/**
 * BETA
 * you should not even use it!
 */

namespace iWorkPHP;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Doctrine class
 *
 * @author EpicJhon
 */
class Doctrine extends Kernel {

    private $entityManager;

    /**
     * @property SystemProperty $properties
     */
    public function __construct() {
        parent::__construct();

        $dbConfig = $this->properties->getParameter('config')->db;
        $this->openConnection($dbConfig);
    }

    /**
     * Open database connection
     * 
     * @param stdClass $db
     */
    private function openConnection($db) {
        $paths = array(
            $this->properties->getParameter('appDir') . '/database/Metadata'
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
