<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iWorkPHP;

/**
 * Description of RouterRule
 *
 * @author Jhonjhon_123
 */
class RouterRule
{

    private $path;
    private $pattern;
    private $class;
    private $method;
    private $matches;

    function __construct($path, $pattern, $class, $method)
    {
        $this->path = $path;
        $this->pattern = $pattern;
        $this->class = $class;
        $this->method = $method;
        $this->matches = array();
    }

    public function getPath()
    {
        return $this->path;
    }

    public function getPattern()
    {
        return $this->pattern;
    }

    public function getClass()
    {
        return $this->class;
    }

    public function getMethod()
    {
        return $this->method;
    }

    public function getMatches()
    {
        return $this->matches;
    }

    public function setPath($path)
    {
        $this->path = $path;
    }

    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
    }

    public function setClass($class)
    {
        $this->class = $class;
    }

    public function setMethod($method)
    {
        $this->method = $method;
    }

    public function setMatches($matches)
    {
        $this->matches = $matches;
    }

    public function hasPath()
    {
        return !is_null($this->path);
    }

    public function hasPattern()
    {
        return !is_null($this->pattern);
    }

}
