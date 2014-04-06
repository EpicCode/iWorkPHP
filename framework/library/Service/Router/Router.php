<?php

namespace iWorkPHP\Service\Router;

use \iWorkPHP\Service\Utils\Utils;
use \iWorkPHP\Service\Config\Config;
use \iWorkPHP\Service\HttpFoundation\Request;

/**
 * Router
 */
class Router {

    private $config;
    private $utils;
    private $request;
    private $ruleConfig;
    private $rules;

    /**
     * Constructor
     * 
     * @param \iWorkPHP\Service\Utils\Utils $utils
     * @param \iWorkPHP\Service\Config\Config $config
     */
    public function __construct(Utils $utils, Config $config, Request $request) {
        $this->utils = $utils;
        $this->config = $config;
        $this->request = $request->createFromGlobals();
    }

    /**
     * Load rules
     * 
     */
    public function loadRules() {
        $this->parseRouterConfig();
        // RouterRule colletion
        $this->rules = new RouterRules();

        // Parse rules from .yml file
        foreach ($this->ruleConfig as $key => $value)
            $this->rules->addRule($key, $this->utils->iifIssetArray($value, 'path', null), $this->utils->iifIssetArray($value, 'pattern', null), $this->utils->iifIssetArray($value, 'format', null), key($value['class']), current($value['class']));
    }

    /**
     * 
     * @return type
     */
    public function getRules() {
        return $this->rules;
    }

    /**
     * Match the rule
     * 
     * @return RouterRule
     */
    public function matchRule() {
        $currentPath = $this->utils->standardizeUrl($this->request->getPathInfo());

        foreach ($this->rules->getRules() as $rule) {
            // Static Path
            if ($rule->hasPath() and $currentPath == $this->utils->standardizeUrl($rule->getPath()))
                return $rule;

            if (!$rule->hasPattern())
                continue;

            $matches = array();
            $patternRet = preg_match($rule->getPattern(), $currentPath, $matches);

            if ($patternRet) {
                // Delete url path
                array_shift($matches);
                $rule->setMatches($matches);
                return $rule;
            }
        }
    }

    /**
     * Check if the rule corresponding to the event OnError exists
     * 
     * @return boolean
     */
    public function hasOnError() {
        return $this->rules->hasRule('onError');
    }

    /**
     * Get the rule corresponding to the event OnError
     * 
     * @return RouterRule
     */
    public function getOnError() {
        return $this->rules->getRule('onError');
    }

    /**
     * Parse router config
     */
    private function parseRouterConfig() {
        // Load raw rules from .yml file
        $this->ruleConfig = $this->utils->parseYAML($this->config->getParam('configDir') . 'routing.yml');
    }

}
