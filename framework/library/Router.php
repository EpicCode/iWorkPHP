<?php

namespace iWorkPHP;

use Symfony\Component\Yaml\Parser;

/**
 * Router
 *
 * @author EpicJhon
 */
class Router extends Kernel {

    private $config;

    public function loadRules() {
        $this->parseRouterConfig();
        // RouterRule colletion
        $this->rules = new RouterRules();

        // Parse rules from .yml file
        foreach ($this->config as $key => $value)
            $this->rules->setRule($key, $this->utils->iifIssetArray($value, 'path', null), $this->utils->iifIssetArray($value, 'pattern', null), key($value['class']), current($value['class']));
    }

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

    public function hasOnError() {
        return $this->rules->hasRule('onError');
    }

    public function getOnError() {
        return $this->rules->getRule('onError');
    }

    public function getConfig() {
        return $this->config;
    }

    private function parseRouterConfig() {
        // New Symfony YAML Parser
        $yaml = new Parser();
        // Load raw rules from .yml file
        $this->config = $yaml->parse(file_get_contents($this->properties->getParameter('configDir') . 'routing.yml'));
    }

}
