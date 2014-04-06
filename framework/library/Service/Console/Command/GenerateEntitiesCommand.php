<?php

namespace iWorkPHP\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateEntitiesCommand extends BasicCommand {

    protected function configure() {
        $this
                ->setName('iw:generate:entities')
                ->setDescription('Generate entity classes and method stubs from your mapping information.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $arguments = array(
            '--generate-annotations' => true,
            'dest-path' => \iWorkPHP\Kernel::get('properties')->getParameter('appDir')
        );
        $this->invokeCommand('orm:generate:entities', $arguments, $output);
    }

}
