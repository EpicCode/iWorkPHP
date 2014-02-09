<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iWorkPHP;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of Loader
 *
 * @author Hax0r
 */
class Loader extends Kernel
{

    /**
     * Define initial configuration for environment
     * 
     * @param ClassLoader $composer
     */
    public function __construct($composer)
    {
        parent::__construct();
        $this->composer = $composer;
        $this->properties->setParameter('baseDir', __DIR__ . '/../../');
        $this->properties->setParameter('frameDir', __DIR__ . '/../');
    }

    public function handleRequest()
    {
        // Parse the Request HTTP
        $this->request = Request::createFromGlobals();
        // Set Twig service
        $this->twig = new Twig();
        // Set response object
        $this->response = new Response();
        // Create Router service
        $this->router = new Router();
        $this->router->loadRules();
        // Match current rule
        $rule = $this->router->matchRule();
        // Load current rule
        if ($rule instanceof RouterRule)
        {
            $this->callRule($rule);
        } else
        {
            // onError default page
            if ($this->router->hasOnError())
            {
                $rule = $this->router->getOnError();
                $this->callRule($rule);
            }
        }
    }

    public function send()
    {
        if ($this->twig->hasHtml())
            $this->response->setContent($this->twig->getHtml());
        $this->response->prepare($this->request);
        $this->response->send();
    }

    private function callRule(RouterRule $rule)
    {
        return call_user_func_array(array(
            $this->{'Source\\' . $rule->getClass()},
            $rule->getMethod() . 'Action'
                ), $rule->getMatches()
        );
    }

}
