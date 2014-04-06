<?php

namespace iWorkPHP\Service\Twig;

use \iWorkPHP\Service\Config\Config;
use \iWorkPHP\Service\Router\Router;

/**
 * Twig loader
 */

class Twig extends \Twig_Environment {

    /**
     *
     * @var type 
     */
    private $config;
    
    /**
     *
     * @var type 
     */
    private $router;
    
    
    /**
     *
     * @var type 
     */
    private $html;

    /**
     * Constructor
     * 
     * @param \iWorkPHP\Service\Config\Config $config
     */
    public function __construct(Config $config, Router $router) {
        $this->config = $config;
        $this->router = $router;
        
        $loader = new \Twig_Loader_Filesystem($this->config->getParam('appDir') . 'view');

        /* For developers */
        if ($this->config->getParam('environment')->debug) {
            parent::__construct($loader, array(
                'cache' => $this->config->getParam('frameDir') . 'cache',
                'debug' => true
            ));

            parent::addExtension(new \Twig_Extension_Debug());
            parent::setCache(false);
        } else {
            parent::__construct($loader, array(
                'cache' => $this->config->getParam('frameDir') . 'cache'
            ));
        }

        $this->addExtensions();
    }

    /**
     * 
     */
    private function addExtensions() {
        // Framework Extensions
        parent::addExtension(new Extension\Asset($this->config));
        parent::addExtension(new Extension\Router($this->config, $this->router));

        // User Extensions
        foreach ($this->config->getParam('twig')->ext as $ext) {
            $class = '\\Model\\Twig\\' . $ext;
            
            if (class_exists($class)) {
                $newExt = new $class();
                
                if ($newExt instanceof \Twig_Extension)
                    parent::addExtension($newExt);
            }
        }
    }

    /**
     * 
     * @return type
     */
    public function getHtml() {
        return $this->html;
    }

    /**
     * 
     * @return type
     */
    public function hasHtml() {
        return !empty($this->html);
    }

    /**
     * 
     * @param type $var
     * @param type $data
     * @return type
     */
    public function addGlobal($var, $data = '') {
        return parent::addGlobal($var, $data);
    }

    /**
     * 
     * @param type $namespace
     * @param array $context
     */
    public function render($namespace, array $context = array()) {
        $this->html .= parent::render(ucfirst($namespace) . '.html.twig', $context);
    }

    /**
     * 
     * @param type $namespace
     * @param array $context
     */
    public function renderEx($namespace, array $context = array()) {
        $this->html .= parent::render(ucfirst($namespace), $context);
    }

    /**
     * 
     * @param type $file
     * @param array $context
     */
    public function renderFileEx($file, array $context = array()) {
        if ($this->getLoader()->exists($file))
            $this->html .= parent::render($file, $context);
    }

    /**
     * 
     * @param string $file
     * @param array $context
     */
    public function renderFile($file, array $context = array()) {
        $file = $file . '.html.twig';
        if ($this->getLoader()->exists($file))
            $this->html .= parent::render($file, $context);
    }

}
