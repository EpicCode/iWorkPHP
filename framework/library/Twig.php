<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iWorkPHP;

/**
 * Description of Twig
 *
 * @author Jhonjhon_123
 */
class Twig extends \Twig_Environment
{

    private $html;

    public function __construct()
    {
        $loader = new \Twig_Loader_Filesystem(Kernel::get('properties')->getParameter('appDir') . 'views');

        /* For developers */
        //if (Kernel::Get('Sys_Config')->debug)
        //{
        parent::__construct($loader, array(
            'cache' => Kernel::get('properties')->getParameter('appDir') . 'cache',
            'debug' => true
        ));
        parent::addExtension(new \Twig_Extension_Debug());
        parent::setCache(false);
        //} else
        /*
          parent::__construct($loader, array(
          'cache' => PATH_ROOT . '/cache'
          ));
         */
    }

    public function getHtml()
    {
        return $this->html;
    }

    public function hasHtml()
    {
        return !empty($this->html);
    }

    public function addGlobal($var, $data = '')
    {
        return parent::addGlobal($var, $data);
    }

    public function render($namespace, array $context = array())
    {
        $this->html .= parent::render($namespace . '.html.twig', $context);
    }

    public function renderEx($namespace, array $context = array())
    {
        $this->html .= parent::render($namespace, $context);
    }

    public function renderFileEx($file, array $context = array())
    {
        if ($this->getLoader()->exists($file))
            $this->html .= parent::render($file, $context);
    }

    public function renderFile($file, array $context = array())
    {
        $file = $file . '.html.twig';
        if ($this->getLoader()->exists($file))
            $this->html .= parent::render($file, $context);
    }

}
