<?php

namespace iWorkPHP\Twig;

use \iWorkPHP\Kernel;

/**
 * Twig loader
 *
 * @author EpicJhon
 */
class Twig extends \Twig_Environment {

    private $html;

    public function __construct() {
        $loader = new \Twig_Loader_Filesystem(Kernel::get('properties')->getParameter('appDir') . 'view');

        /* For developers */
        if (Kernel::get('properties')->getParameter('config')->environment->debug) {
            parent::__construct($loader, array(
                'cache' => Kernel::get('properties')->getParameter('frameDir') . 'cache',
                'debug' => true
            ));
            parent::addExtension(new \Twig_Extension_Debug());
            parent::setCache(false);
        } else {
            parent::__construct($loader, array(
                'cache' => Kernel::get('properties')->getParameter('frameDir') . 'cache'
            ));
        }
        $this->addExtensions();
    }

    /**
     * Load your own extensions and user extensions
     */
    private function addExtensions() {
        // Framework Extensions
        parent::addExtension(new Extension\Asset());
        parent::addExtension(new Extension\Router());

        // User Extensions
        foreach (Kernel::get('properties')->getParameter('config')->twig->ext as $ext) {
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
