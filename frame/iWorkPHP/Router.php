<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iWorkPHP;

use Symfony\Component\Yaml\Parser;

/**
 * Description of Router
 *
 * @author Jhonjhon_123
 */
class Router extends Kernel
{

    private $config;

    private function parseRouterConfig()
    {
        $yaml = new Parser();
        $this->config = $yaml->parse(file_get_contents($this->properties->getParameter('frameDir') . 'routing.yml'));
    }

    public function loadRules()
    {
        $Utils = new Utils();
        $this->parseRouterConfig();
        $this->rules = new RouterRules();



        foreach ($this->config as $key => $value)
            $this->rules->setRule($key, $this->utils->iifIssetArray($value, 'path', null), $this->utils->iifIssetArray($value, 'pattern', null), key($value['class']), current($value['class']));
    }

    public function matchRule()
    {
        $currentPath = $this->utils->standardizeUrl($this->request->getPathInfo());

        foreach ($this->rules->getRules() as $rule)
        {
            // Static Path
            if ($rule->hasPath() and $currentPath == $this->utils->standardizeUrl($rule->getPath()))
                return $rule;

            if (!$rule->hasPattern())
                continue;

            $matches = array();
            $patternRet = preg_match($rule->getPattern(), $currentPath, $matches);

            if ($patternRet)
            {
                // Delete url path
                array_shift($matches);
                $rule->setMatches($matches);
                return $rule;
            }
        }
    }

    public function getConfig()
    {
        return $this->config;
    }

}
