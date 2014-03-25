<?php

namespace iWorkPHP\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateEntitiesCommand extends Command {

    protected function configure() {
        $this
                ->setName('iw:generate:entities')
                ->setDescription('Generate entity classes and method stubs from your mapping information.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $command = $this->getApplication()->find('orm:generate:entities');

        $arguments = array(
            'command' => $command->getName(),
            '--generate-annotations' => true,
            'dest-path' => \iWorkPHP\Kernel::get('properties')->getParameter('appDir')
        );

        $input = new \Symfony\Component\Console\Input\ArrayInput($arguments);
        $command->run($input, $output);
    }

}
