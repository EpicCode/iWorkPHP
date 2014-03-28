<?php

namespace iWorkPHP;

/**
 * System property
 */
class SystemProperty
{
    private $config;

    public function __construct()
    {
        $this->config = new \stdClass();
    }

    /**
     * Set parameter
     * 
     * @param string $key
     * @param mixed $value
     */
    public function setParameter($key, $value)
    {
        $this->config->$key = $value;
    }
    
    /**
     * Get parameter
     * 
     * @param string $key
     * @return mixed
     */
    public function getParameter($key)
    {
        return $this->config->$key;
    }
    
    /**
     * Check if parameter exists
     * 
     * @param string $key
     * @return boolean
     */
    public function hasParameter($key)
    {
        return property_exists($this->config, $key);
    }

}
