<?php

/**
 * BETA
 * you should not even use it!
 */

namespace iWorkPHP;

use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

/**
 * Description of Doctrine
 *
 * @author Hax0r
 */
class Doctrine extends Kernel
{

    private $entityManager;

    function __construct()
    {
        $paths = array(
            $this->properties->getParameter('baseDir') . 'entity/mapping'
        );

        $isDevMode = true;

        // the connection configuration
        $dbParams = array(
            'driver' => 'pdo_mysql',
            'user' => 'iworkphp',
            'password' => 'iworkphp',
            'dbname' => 'iworkphp',
        );

        // New configuration
        $config = Setup::createYAMLMetadataConfiguration($paths);
        $this->entityManager = EntityManager::create($dbParams, $config);
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }

    public function setEntityManager($entityManager)
    {
        $this->entityManager = $entityManager;
    }

}
