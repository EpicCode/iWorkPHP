<?php

namespace iWorkPHP;

use Symfony\Component\Yaml\Parser;

/**
 * Router
 *
 * @author EpicJhon
 * @property RouterRules $rules
 * @property Utils $utils
 * @property \Symfony\Component\HttpFoundation\Request $request
 * @property SystemProperty $properties
 */
class Router extends Kernel {

    private $config;

    /**
     * Load rules
     * 
     */
    public function loadRules() {
        $this->parseRouterConfig();
        // RouterRule colletion
        $this->rules = new RouterRules();

        // Parse rules from .yml file
        foreach ($this->config as $key => $value)
            $this->rules->setRule($key, $this->utils->iifIssetArray($value, 'path', null), $this->utils->iifIssetArray($value, 'pattern', null), $this->utils->iifIssetArray($value, 'format', null), key($value['class']), current($value['class']));
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
        // New Symfony YAML Parser
        $yaml = new Parser();
        // Load raw rules from .yml file
        $this->config = $yaml->parse(file_get_contents($this->properties->getParameter('configDir') . 'routing.yml'));
    }

}
