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
     * @param type $key
     * @param type $value
     */
    public function setParameter($key, $value)
    {
        $this->config->$key = $value;
    }
    
    /**
     * Get parameter
     * 
     * @param type $key
     * @return type
     */
    public function getParameter($key)
    {
        return $this->config->$key;
    }
    
    /**
     * Check if parameter exists
     * 
     * @param type $key
     * @return type
     */
    public function hasParameter($key)
    {
        return property_exists($this->config, $key);
    }

}
