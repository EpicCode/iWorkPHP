<?php

namespace iWorkPHP\Twig\Extensions;

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

        if (func_num_args() < 1)
            return;

        $args = func_get_args();
        $rule_name = $args[0];

        $rules = \iWorkPHP\Kernel::get('rules');
        if (!$rules instanceof \iWorkPHP\RouterRules)
            return;

        if (!$rules->hasRule($rule_name))
            return;

        $url = \iWorkPHP\Kernel::get('properties')->getParameter('config')->site->url;

        $rule = $rules->getRule($rule_name);

        if ($rule->hasPath())
            return $url . '/index.php' . $rule->getPath();


        if (count($args) < 2)
            return;

        array_shift($args);

        if ($rule->hasPattern())
            return $url . '/index.php' . vsprintf($rule->getFormat(), $args);

        return;
    }

}
