<?php

namespace iWorkPHP;

/**
 * Description of Utils
 *
 * @author EpicJhon
 */
class Utils {

    public function standardizeUrl($url) {
        return (substr($url, -1) != '/') ? $url . '/' : $url;
    }

    public function iifIssetArray($array, $key, $default) {
        return (isset($array[$key])) ? $array[$key] : $default;
    }

    // convert an array to an object
    public function arrayToObject($array) {
        return json_decode(json_encode($array), FALSE);
    }

}
