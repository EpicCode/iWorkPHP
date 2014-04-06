<?php

namespace iWorkPHP\Service\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MappingDatabaseCommand extends BasicCommand {

    protected function configure() {
        $this
                ->setName('iw:mapping:database')
                ->setDescription('Generate maps of the database.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $arguments = array(
            '--from-database' => true,
            '--namespace' => 'Database\Entity\\',
            'to-type' => 'yml',
            'dest-path' => $this->config->getParam('appDir') . 'database/Metadata/'
        );

        $this->invokeCommand('orm:convert:mapping', $arguments, $output);
    }

}
