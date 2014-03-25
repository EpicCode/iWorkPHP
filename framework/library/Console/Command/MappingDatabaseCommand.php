<?php

namespace iWorkPHP\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MappingDatabaseCommand extends Command {

    protected function configure() {
        $this
                ->setName('iw:mapping:database')
                ->setDescription('Generate maps of the database.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $command = $this->getApplication()->find('orm:convert:mapping');

        $arguments = array(
            'command' => 'orm:convert:mapping',
            '--from-database' => true,
            '--namespace' => 'Database\Entity\\',
            'to-type' => 'yml',
            'dest-path' => \iWorkPHP\Kernel::get('properties')->getParameter('appDir') . 'database/maps/'
        );

        $input = new \Symfony\Component\Console\Input\ArrayInput($arguments);
        $statusCode = $command->run($input, $output);
    }

}
