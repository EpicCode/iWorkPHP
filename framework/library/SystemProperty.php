<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iWorkPHP;

/**
 * Description of SystemProperty
 *
 * @author Jhonjhon_123
 */
class SystemProperty
{

    /**
     *
     * @var Object
     */
    private $config;

    public function __construct()
    {
        $this->config = new \stdClass();
    }

    public function setParameter($key, $value)
    {
        $this->config->$key = $value;
    }

    public function getParameter($key)
    {
        return $this->config->$key;
    }

    public function hasParameter($key)
    {
        return property_exists($this->config, $key);
    }

}
