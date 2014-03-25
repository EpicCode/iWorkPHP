<?php

namespace iWorkPHP\Twig\Extension;

/**
 * Get absolute url of an router rule
 * 
 * @author EpicJhon
 */
class Router extends \Twig_Extension {

    public function getName() {
        return 'router';
    }

    // Add a set of functions to Twig
    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('path', array($this, 'getRouterRule'))
        );
    }

    // Callback
    public function getRouterRule() {

        // Least the name of the router rule
        if (func_num_args() < 1)
            return;

        $args = func_get_args();
        $rule_name = $args[0];

        // Get a routing rules
        $rules = \iWorkPHP\Kernel::get('rules');

        // Rules that are true a routing
        if (!$rules instanceof \iWorkPHP\RouterRules)
            return;

        // There is this rule?
        if (!$rules->hasRule($rule_name))
            return;

        $url = \iWorkPHP\Kernel::get('properties')->getParameter('config')->site->url;

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

        // Else...
        return;
    }

}
