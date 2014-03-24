<?php

namespace iWorkPHP;

/**
 * Description of Utils
 *
 * @author EpicJhon
 */
class Utils {

    public function standardizeUrl($url) {

        // Remove "http|https|ftp|...://", if any
        if (strpos($url, '://') !== FALSE) {
            $url = substr($url, strpos($url, '://') + 3); // Leave only "site.com/(...)"
            $url = substr($url, strpos($url, '/') + 1); // Remove the first "/"
        }

        // Remove "//", if any
        $url = (substr($url, 0, 2) == '//' ) ? substr($url, 2) : $url;

        // Remove "./", if any
        $url = (substr($url, 0, 2) == './' ) ? substr($url, 2) : $url;

        // Remove index, if any
        $url = (strpos($url, 'index.php') !== FALSE) ? substr($url, strpos($url, 'index.php') + 9) : $url;

        // Add the first "/" if this does not exist
        $url = (substr($url, 0, 1) !== '/' ) ? '/' . $url : $url;

        // Put "/" at the end
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
