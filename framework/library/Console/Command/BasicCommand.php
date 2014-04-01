<?php

namespace iWorkPHP\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\ArrayInput;

abstract class BasicCommand extends Command {

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
