<?php

namespace iWorkPHP;

/**
 * Router rule
 */
class RouterRule {

    private $path;
    private $pattern;
    private $format;
    private $class;
    private $method;
    private $matches;

    public function __construct($path, $pattern, $format, $class, $method) {
        $this->path = $path;
        $this->setPattern($pattern);
        $this->setFormat($format);
        $this->class = $class;
        $this->method = $method;
        $this->matches = array();
    }

    public function getPath() {
        return $this->path;
    }

    public function getPattern() {
        return $this->pattern;
    }

    public function getFormat() {
        return $this->format;
    }

    public function getClass() {
        return $this->class;
    }

    public function getMethod() {
        return $this->method;
    }

    public function getMatches() {
        return $this->matches;
    }

    public function setPath($path) {
        $this->path = $path;
    }

    public function setPattern($pattern) {
        if (!empty($pattern))
            $this->pattern = '#' . $pattern . '#';
    }

    public function setFormat($format) {
        if (!empty($this->pattern))
            $this->format = $format;
    }

    public function setClass($class) {
        $this->class = $class;
    }

    public function setMethod($method) {
        $this->method = $method;
    }

    public function setMatches($matches) {
        $this->matches = $matches;
    }

    public function hasPath() {
        return !is_null($this->path);
    }

    public function hasPattern() {
        return !is_null($this->pattern) and ! is_null($this->format);
    }

}
