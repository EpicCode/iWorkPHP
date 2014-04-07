<?php

namespace iWorkPHP\Service\Twig\Extension;

use \iWorkPHP\Service\Config\Config;

/**
 * Get absolute url of an asset
 * 
 * @author EpicJhon
 */
class Asset extends \Twig_Extension {

    /**
     *
     * @var Config
     */
    private $config;

    /**
     * Constructor
     * 
     * @param Config $config
     */
    public function __construct(Config $config) {
        $this->config = $config;
    }

    /**
     * 
     * @return string
     */
    public function getName() {
        return 'asset';
    }

    /**
     * Add a set of functions to Twig
     * 
     * @return \Twig_SimpleFunction[]
     */
    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('asset', array($this, 'getAssetUrl'))
        );
    }

    /**
     * Callback
     * 
     * @param string $url
     * @return string
     */
    public function getAssetUrl($url) {
        // If the url is absolute, return the same url
        if (strpos($url, '//') === 0 or strpos($url, '://') === true) {
            return $url;
        }

        return $this->config->getParam('site')->url . $url;
    }

}
