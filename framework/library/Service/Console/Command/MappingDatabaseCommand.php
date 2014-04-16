<?php

namespace iWorkPHP\Service\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MappingDatabaseCommand extends BasicCommand {

    /**
     * Configuration of the command
     */
    protected function configure() {
        $this
                ->setName('iw:mapping:database')
                ->setDescription('Generate maps of the database.');
    }

    /**
     * Executes the current command
     * 
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    protected function execute(InputInterface $input, OutputInterface $output) {
        $arguments = array(
            '--from-database' => true,
            '--namespace' => 'Database\Entity\\',
            'to-type' => 'yml',
            'dest-path' => $this->config->getParam('databaseDir') . 'Metadata/'
        );

        $this->invokeCommand('orm:convert:mapping', $arguments, $output);
    }

}
