<?php

namespace iWorkPHP\Service\Router;

/**
 * Routing rules manager
 */
class RouterRules implements \Iterator {

    private $rules;

    public function __construct() {
        $this->rules = array();
    }

    public function getRules() {
        return $this->rules;
    }

    public function hasRule($name) {
        return array_key_exists($name, $this->rules);
    }

    public function getRule($name) {
        if ($this->hasRule($name)) {
            return $this->rules[$name];
        }
    }

    public function addRule($name, $path, $pattern, $format, $className, $classMethod) {
        if (!$this->hasRule($name)) {
            $this->rules[$name] = New RouterRule($path, $pattern, $format, $className, $classMethod);
        }
    }

    public function current() {
        return current($this->rules);
    }

    public function key() {
        return key($this->rules);
    }

    public function next() {
        return next($this->rules);
    }

    public function rewind() {
        reset($this->rules);
    }

    public function valid() {
        $key = key($this->rules);
        return ($key !== null && $key !== false);
    }

}
