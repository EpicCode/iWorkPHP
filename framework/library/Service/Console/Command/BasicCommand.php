<?php

namespace iWorkPHP\Service\Console\Command;

use iWorkPHP\Service\Config\Config;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;

abstract class BasicCommand extends Command {

    protected $config = null;

    public function setConfig(Config $config) {
        $this->config = $config;
    }

    /**
     * Invoke a specified command
     * 
     * @param string $command
     * @param array $arguments
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     */
    protected function invokeCommand($command, $arguments, $output) {
        $command = $this->getApplication()->find($command);
        $arguments['command'] = $command->getName();
        $input = new ArrayInput($arguments);
        $command->run($input, $output);
    }

}
