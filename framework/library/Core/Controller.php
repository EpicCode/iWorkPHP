<?php

namespace iWorkPHP\Core;

/**
 * Controller
 */

class Controller extends Kernel {
    
    /**
     * Push a text
     * 
     * @param string $text
     */
    public function sendText($text) {
        $this->getService('response')->setContent($text);
    }

    /**
     * Render data in a twig template
     * 
     * @param string $namespace
     * @param array $context
     */
    public function render($namespace, array $context = array()) {
        $this->getService('twig')->render($namespace, $context);
    }

    /**
     * Render data in a twig template
     * 
     * @param string $namespace
     * @param array $context
     */
    public function renderEx($namespace, array $context = array()) {
        $this->getService('twig')->renderEx($namespace, $context);
    }

    /**
     * Render a file
     * 
     * @param string $file
     * @param array $context
     */
    public function renderFile($file, array $context = array()) {
        $this->getService('twig')->renderFile($file, $context);
    }

    /**
     * Render a file
     * 
     * @param string $file
     * @param array $context
     */
    public function renderFileEx($file, array $context = array()) {
        $this->getService('twig')->renderFileEx($file, $context);
    }

}
