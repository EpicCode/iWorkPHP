<?php

namespace iWorkPHP\Core;

use \iWorkPHP\Service\Router\RouterRule;
use \Composer\Autoload\ClassLoader;

/**
 * The loader of framework
 */
class Loader extends Kernel {

    /**
     *
     * @var ClassLoader 
     */
    private $composer;

    /**
     *
     * @var \iWorkPHP\Service\HttpFoundation\Request 
     */
    private $request;

    /**
     *
     * @var \iWorkPHP\Service\Twig\Twig
     */
    private $twig;

    /**
     *
     * @var \iWorkPHP\Service\HttpFoundation\Response
     */
    private $response;

    /**
     *
     * @var \iWorkPHP\Service\Router\Router
     */
    private $router;

    /**
     * Define initial configuration for environment
     * 
     * @param ClassLoader $composer
     */
    public function __construct($composer) {
        $this->composer = $composer;
        $this->loadServices();
    }

    /**
     * Evaluates the request and processes actions
     * 
     */
    public function handleRequest() {
        // Parse the Request HTTP
        $this->request = $this->getService('request')->createFromGlobals();
        // Set Twig service
        $this->twig = $this->getService('twig');
        // Set response object
        $this->response = $this->getService('response');
        // Create Router service
        $this->router = $this->getService('router');
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

    /**
     * Send the request response
     */
    public function send() {
        if ($this->twig->hasHtml())
            $this->response->setContent($this->twig->getHtml());
        $this->response->prepare($this->request);
        $this->response->send();
    }

    /**
     * Call the matched rule
     * 
     * @param RouterRule $rule
     */
    private function callRule(RouterRule $rule) {
        $controllerClass = 'Controller\\' . $rule->getClass();

        call_user_func_array(array(
            new $controllerClass(),
            $rule->getMethod() . 'Action'
                ), $rule->getMatches()
        );
    }

}
