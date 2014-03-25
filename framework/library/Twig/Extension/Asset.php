<?php

namespace iWorkPHP\Twig\Extension;

/**
 * Get absolute url of an asset
 * 
 * @author EpicJhon
 */
class Asset extends \Twig_Extension {

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

        return \iWorkPHP\Kernel::get('properties')->getParameter('config')->site->url . $url;
    }

}
