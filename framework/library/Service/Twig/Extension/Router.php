<?php

namespace iWorkPHP\Service\Twig\Extension;

use \iWorkPHP\Service\Config\Config;
use \iWorkPHP\Service\Router\Router as ServiceRouter;

/**
 * Get absolute url of an router rule
 */
class Router extends \Twig_Extension {

    /**
     *
     * @var Config 
     */
    private $config;

    /**
     *
     * @var ServiceRouter
     */
    private $router;

    /**
     * Constructor
     * 
     * @param Config $config
     * @param ServiceRouter $router
     */
    public function __construct(Config $config, ServiceRouter $router) {
        $this->config = $config;
        $this->router = $router;
    }

    /**
     * 
     * @return string
     */
    public function getName() {
        return 'router';
    }

    /**
     * Add a set of functions to Twig
     * 
     * @return \Twig_SimpleFunction[]
     */
    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('path', array($this, 'getRouterRule'))
        );
    }

    /**
     * Callback
     * 
     * @return string|void
     */
    public function getRouterRule() {

        // Least the name of the router rule
        if (func_num_args() < 1)
            return;

        $args = func_get_args();
        $rule_name = $args[0];

        // Get a routing rules
        $rules = $this->router->getRules();

        // Rules that are true a routing
        if (!$rules instanceof \iWorkPHP\Service\Router\RouterRules)
            return;

        // There is this rule?
        if (!$rules->hasRule($rule_name))
            return;

        $url = $this->config->getParam('site')->url;

        // Get rule
        $rule = $rules->getRule($rule_name);

        // If has path, return the absolute url
        if ($rule->hasPath())
            return $url . '/index.php' . $rule->getPath();

        // Pattern rules
        // Least an argument in the url
        if (count($args) < 2)
            return;

        // Remove the name of the rule
        array_shift($args);

        // If has pattern, return the url formatted with the arguments passed to the function
        if ($rule->hasPattern())
            return $url . '/index.php' . vsprintf($rule->getFormat(), $args);
    }

}
