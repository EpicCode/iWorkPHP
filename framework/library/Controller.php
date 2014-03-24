<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iWorkPHP;

/**
 * Description of Controller
 *
 * @author Jhonjhon_123
 */
class Controller extends Kernel {

    /**
     * Push a text
     * 
     * @param string $text
     */
    public function sendText($text) {
        $this->response->setContent($text);
    }

    /**
     * Render data in a twig template
     * 
     * @param string $namespace
     * @param array $context
     */
    public function render($namespace, array $context = array()) {
        $this->twig->render($namespace, $context);
    }

    /**
     * Render data in a twig template
     * 
     * @param string $namespace
     * @param array $context
     */
    public function renderEx($namespace, array $context = array()) {
        $this->twig->renderEx($namespace, $context);
    }

    /**
     * Render a file
     * 
     * @param string $file
     * @param array $context
     */
    public function renderFile($file, array $context = array()) {
        $this->twig->renderFile($file, $context);
    }

    /**
     * Render a file
     * 
     * @param string $file
     * @param array $context
     */
    public function renderFileEx($file, array $context = array()) {
        $this->twig->renderFileEx($file, $context);
    }

}
