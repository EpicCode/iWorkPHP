<?php

use iWorkPHP\Core\Loader;
use Doctrine\ORM\EntityManager;
use iWorkPHP\Service\Config\Config;
use Symfony\Component\Console\Application;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use \Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Helper\HelperSet;
use Symfony\Component\Console\Tester\CommandTester;
use iWorkPHP\Service\Console\Command\MappingDatabaseCommand;
use iWorkPHP\Service\Console\Command\GenerateEntitiesCommand;
use iWorkPHP\Service\Console\Command\GenerateRepositoriesCommand;

class ConsoleRunnerTest extends ConsoleRunner {

    static public function runTest(HelperSet $helperSet, Command $command) {

        $cli = new Application();
        $cli->setHelperSet($helperSet);

        self::addCommands($cli);
        $cli->add($command);

        $command = $cli->find($command->getName());
        $commandTester = new CommandTester($command);
        $commandTester->execute(array('command' => $command->getName()));

        return $commandTester->getDisplay();
    }

}

class MySQLTest extends PHPUnit_Framework_TestCase {

    /**
     *
     * @var Loader 
     */
    private $loader;

    /**
     *
     * @var Config
     */
    private $config;

    /**
     *
     * @var EntityManager
     */
    private $em;

    /**
     *
     * @var MappingDatabaseCommand
     */
    private $mappingDatabaseCommand;

    /**
     *
     * @var GenerateEntitiesCommand
     */
    private $generateEntitiesCommand;

    /**
     *
     * @var GenerateRepositoriesCommand
     */
    private $generateRepositoriesCommand;

    public function __construct() {
        // Get the composer autoload
        $composer = require_once __DIR__ . '/../../vendor/autoload.php';
        // Call to framework loader
        $this->loader = new Loader($composer);
        $this->config = $this->loader->getService('config');

        // Test MySQL configuration
        $config = new stdClass();
        $config->driver = 'pdo_mysql';
        $config->host = 'localhost';
        $config->port = '3306';
        $config->user = 'travis';
        $config->password = '';
        $config->dbname = 'iworkphp_test';
        // Overwrite MySQL configuration
        $this->config->setParam('db', $config);

        // Get EntityManager
        $this->em = $this->loader->getService('doctrine')->getEntityManager();

        // Create commands
        $this->mappingDatabaseCommand = new MappingDatabaseCommand();
        $this->mappingDatabaseCommand->setConfig($this->config);

        $this->generateEntitiesCommand = new GenerateEntitiesCommand();
        $this->generateEntitiesCommand->setConfig($this->config);

        $this->generateRepositoriesCommand = new GenerateRepositoriesCommand();
        $this->generateRepositoriesCommand->setConfig($this->config);
    }

    private function auxiliaryConsoleRunner(Command $command) {
        $helperSet = ConsoleRunnerTest::createHelperSet($this->em);
        return ConsoleRunnerTest::runTest($helperSet, $command);
    }

    public function testMappingDatabase() {
        $ret = $this->auxiliaryConsoleRunner($this->mappingDatabaseCommand);
        $this->assertContains('mapping information to', $ret);
    }

    public function testGenerateEntitiesCommand() {
        $ret = $this->auxiliaryConsoleRunner($this->generateEntitiesCommand);
        $this->assertContains('Entity classes generated to', $ret);
    }

    public function testMySQL() {

        $query = $this->em
                ->getRepository('Database\Entity\Info')
                ->createQueryBuilder('i')
                ->getQuery();

        foreach ($query->getResult() as $value) {
            $this->assertInstanceOf('Database\Entity\Info', $value);
        }

        $query = $this->em
                ->getRepository('Database\Entity\User')
                ->createQueryBuilder('u')
                ->getQuery();

        foreach ($query->getResult() as $value) {
            $this->assertInstanceOf('Database\Entity\User', $value);
        }
    }

}
