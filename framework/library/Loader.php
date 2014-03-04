<?php

namespace iWorkPHP;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * The loader of framework
 *
 * @author EpicJhon
 */
class Loader extends Kernel {

    /**
     * Define initial configuration for environment
     * 
     * @param ClassLoader $composer
     */
    public function __construct($composer) {
        parent::__construct();
        $this->composer = $composer;
        $this->properties->setParameter('frameDir', dirname(__DIR__) . '/');
        $this->properties->setParameter('baseDir', dirname(dirname(__DIR__)) . '/');
        $this->properties->setParameter('appDir', $this->properties->getParameter('baseDir') . 'app/');
        $this->properties->setParameter('configDir', $this->properties->getParameter('frameDir') . 'config/');
        (new Config())->loadConfig();
    }

    public function handleRequest() {
        // Parse the Request HTTP
        $this->request = Request::createFromGlobals();
        // Set Twig service
        $this->twig = new Twig\Twig();
        // Set response object
        $this->response = new Response();
        // Create Router service
        $this->router = new Router();
        $this->router->loadRules();
        // Match current rule
        $rule = $this->router->matchRule();
        // Load current rule
        if ($rule instanceof RouterRule) {
            $this->callRule($rule);
        } else {
            // onError default page
            if ($this->router->hasOnError()) {
                $rule = $this->router->getOnError();
                $this->callRule($rule);
            }
        }
    }

    public function send() {
        if ($this->twig->hasHtml())
            $this->response->setContent($this->twig->getHtml());
        $this->response->prepare($this->request);
        $this->response->send();
    }

    private function callRule(RouterRule $rule) {
        return call_user_func_array(array(
            $this->{'Controller\\' . $rule->getClass()},
            $rule->getMethod() . 'Action'
                ), $rule->getMatches()
        );
    }

}
