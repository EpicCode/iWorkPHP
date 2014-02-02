<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iWorkPHP;

/**
 * Description of RouterRules
 *
 * @author Jhonjhon_123
 */
class RouterRules
{

    private $rules;

    function __construct()
    {
        $this->rules = new \stdClass();
    }

    public function getRules()
    {
        return $this->rules;
    }

    public function getRulePath($name)
    {
        return $this->rules->$name->getPath();
    }

    public function getRulePattern($name)
    {
        return $this->rules->$name->getPattern();
    }

    public function getRuleClass($name)
    {
        return $this->rules->$name->getClass();
    }

    public function getRuleMethod($name)
    {
        return $this->rules->$name->getMethod();
    }

    public function hasRulePath($name)
    {
        return $this->rules->$name->hasPath();
    }

    public function hasRulePattern($name)
    {
        return $this->rules->$name->hasPattern();
    }

    public function setRule($name, $path, $pattern, $className, $classMethod)
    {
        $this->rules->$name = New RouterRule($path, $pattern, $className, $classMethod);
    }

}
