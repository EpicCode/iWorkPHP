<?php

namespace iWorkPHP\Console\Command;

use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateRepositoriesCommand extends BaseCommand {

    protected function configure() {
        $this
                ->setName('iw:generate:repositories')
                ->setAliases(array('orm:generate:repositories'))
                ->setDescription('Generate repository classes from your mapping information.');
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $arguments = array(
            'dest-path' => \iWorkPHP\Kernel::get('properties')->getParameter('appDir')
        );

        $this->invokeCommand('orm:generate-repositories', $arguments, $output);
    }

}
