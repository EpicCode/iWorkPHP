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
     * @var Config 
     */
    private $config;

    /**
     *
     * @var Router 
     */
    private $router;

    /**
     *
     * @var string 
     */
    private $html;

    /**
     * 
     * @param \iWorkPHP\Service\Config\Config $config
     * @param \iWorkPHP\Service\Router\Router $router
     */
    public function __construct(Config $config, Router $router) {
        $this->config = $config;
        $this->router = $router;

        $loader = new \Twig_Loader_Filesystem($this->config->getParam('appDir') . 'View');

        /* For developers */
        if ($this->config->getParam('environment')->debug) {
            parent::__construct($loader, array(
                'cache' => $this->config->getParam('cacheDir'),
                'debug' => true
            ));

            parent::addExtension(new \Twig_Extension_Debug());
            parent::setCache(false);
        } else {
            parent::__construct($loader, array(
                'cache' => $this->config->getParam('cacheDir')
            ));
        }

        $this->addExtensions();
    }

    /**
     * Load your own extensions and user extensions
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
     * Get HTML
     * 
     * @return string
     */
    public function getHtml() {
        return $this->html;
    }

    /**
     * Has HTML
     * 
     * @return boolean
     */
    public function hasHtml() {
        return !empty($this->html);
    }

    /**
     * Add a global variable to the environment
     * 
     * @param string $var
     * @param mixed $data (optional)
     */
    public function addGlobal($var, $data = '') {
        parent::addGlobal($var, $data);
    }

    /**
     * Render a template
     * 
     * @description find a template file in views that match the format: {$namespace}.html.twig
     * 
     * @param string $namespace
     * @param array $context (optional)
     */
    public function render($namespace, array $context = array()) {
        $this->html .= parent::render(ucfirst($namespace) . '.html.twig', $context);
    }

    /**
     * Render a template
     * 
     * @description find a template file in views match {$namespace}
     * 
     * @param string $namespace
     * @param array $context (optional)
     */
    public function renderEx($namespace, array $context = array()) {
        $this->html .= parent::render(ucfirst($namespace), $context);
    }

    /**
     * Render template file
     * 
     * @description find a template {$file}.html.twig
     * 
     * @param string $file
     * @param array $context (optional)
     */
    public function renderFile($file, array $context = array()) {
        $file = $file . '.html.twig';
        if ($this->getLoader()->exists($file))
            $this->html .= parent::render($file, $context);
    }

    /**
     * Render template file
     * 
     * @description find a template {$file}
     * 
     * @param string $file
     * @param array $context (optional)
     */
    public function renderFileEx($file, array $context = array()) {
        if ($this->getLoader()->exists($file))
            $this->html .= parent::render($file, $context);
    }

}
