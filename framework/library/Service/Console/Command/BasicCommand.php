<?php

namespace iWorkPHP\Service\Console\Command;

use iWorkPHP\Service\Config\Config;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Output\OutputInterface;

abstract class BasicCommand extends Command {

    /**
     *
     * @var Config
     */
    protected $config = null;

    /**
     * Set config
     * 
     * @param Config $config
     */
    public function setConfig(Config $config) {
        $this->config = $config;
    }

    /**
     * Invoke a specified command
     * 
     * @param string $command
     * @param array $arguments
     * @param OutputInterface $output
     */
    protected function invokeCommand($command, $arguments, OutputInterface $output) {
        $command = $this->getApplication()->find($command);
        $arguments['command'] = $command->getName();
        $input = new ArrayInput($arguments);
        $command->run($input, $output);
    }

}
