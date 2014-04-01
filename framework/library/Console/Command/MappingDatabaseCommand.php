<?php

namespace iWorkPHP\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class MappingDatabaseCommand extends BaseCommand {

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
            'dest-path' => \iWorkPHP\Kernel::get('properties')->getParameter('appDir') . 'database/Metadata/'
        );

        $this->invokeCommand('orm:convert:mapping', $arguments, $output);
    }

}
