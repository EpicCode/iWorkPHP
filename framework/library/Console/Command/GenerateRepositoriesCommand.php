<?php

namespace iWorkPHP\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateRepositoriesCommand extends Command {

    protected function configure() {
        $this
                ->setName('iw:generate:repositories')
                ->setAliases(array('orm:generate:repositories'))
                ->setDescription('Generate repository classes from your mapping information.')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $command = $this->getApplication()->find('orm:generate-repositories');

        $arguments = array(
            'command' => 'orm:generate-repositories',
            'dest-path' => \iWorkPHP\Kernel::get('properties')->getParameter('appDir')
        );

        $input = new \Symfony\Component\Console\Input\ArrayInput($arguments);
        $statusCode = $command->run($input, $output);
    }

}
