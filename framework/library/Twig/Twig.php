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

    public function getHtml() {
        return $this->html;
    }

    public function hasHtml() {
        return !empty($this->html);
    }

    public function addGlobal($var, $data = '') {
        return parent::addGlobal($var, $data);
    }

    public function render($namespace, array $context = array()) {
        $this->html .= parent::render(ucfirst($namespace) . '.html.twig', $context);
    }

    public function renderEx($namespace, array $context = array()) {
        $this->html .= parent::render(ucfirst($namespace), $context);
    }

    public function renderFileEx($file, array $context = array()) {
        if ($this->getLoader()->exists($file))
            $this->html .= parent::render($file, $context);
    }

    public function renderFile($file, array $context = array()) {
        $file = $file . '.html.twig';
        if ($this->getLoader()->exists($file))
            $this->html .= parent::render($file, $context);
    }

}
