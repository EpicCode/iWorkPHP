<?php

namespace iWorkPHP\Service\Twig\Extension;

/**
 * Get absolute url of an asset
 * 
 * @author EpicJhon
 */
class Asset extends \Twig_Extension {

    /**
     *
     * @var type 
     */
    private $config;

    /**
     * 
     * @param type $config
     */
    public function __construct($config) {
        $this->config = $config;
    }

    /**
     * 
     * @return string
     */
    public function getName() {
        return 'asset';
    }

    // Add a set of functions to Twig
    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('asset', array($this, 'getAssetUrl'))
        );
    }

    // Callback
    public function getAssetUrl($url) {
        // If the url is absolute, return the same url
        if (strpos($url, '//') === 0 or strpos($url, '://') === true) {
            return $url;
        }

        return $this->config->getParam('site')->url . $url;
    }

}
