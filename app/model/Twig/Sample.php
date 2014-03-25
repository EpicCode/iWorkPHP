<?php

namespace Model\Twig;

/**
 * Get absolute url of an asset
 * 
 * @author EpicJhon
 */
class Sample extends \Twig_Extension {

    // The name of its extention
    public function getName() {
        return 'sample';
    }

    // Add a set of filters to Twig
    public function getFilters() {
        return array(
            new \Twig_SimpleFilter('base64_encode', 'base64_encode'),
            new \Twig_SimpleFilter('base64_decode', 'base64_decode')
        );
    }

    // Add a set of functions to Twig
    public function getFunctions() {
        return array(
            new \Twig_SimpleFunction('sample', array($this, 'sample'))
        );
    }

    public function sample($text) {
        return '<' . $text . '>';
    }

}
