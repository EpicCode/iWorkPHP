<?php

namespace iWorkPHP;

/**
 * Description of Utils
 *
 * @author EpicJhon
 */
class Utils {

    /**
     * Standarize the URL
     * 
     * @param string $url
     * @return string
     */
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

    /**
     * Check if the key exists in array, then return it, if not, 
     * then return the $default value
     * 
     * @param array $array
     * @param mixed $key
     * @param mixed $default
     * @return mixed
     */
    public function iifIssetArray($array, $key, $default) {
        return (isset($array[$key])) ? $array[$key] : $default;
    }

    /**
     * Convert an array to an object
     * 
     * @param array $array
     * @return stdClass
     */
    public function arrayToObject($array) {
        return json_decode(json_encode($array), FALSE);
    }

    /**
     * Parse YAML file
     * 
     * @param string $file
     * @return mixed
     */
    public function parseYAML($file) {
        // New Symfony YAML Parser
        $yaml = new Symfony\Component\Yaml\Parser();

        try {
            // Returns an array data from an YAML file
            return $yaml->parse(file_get_contents($file));
        } catch (\Symfony\Component\Yaml\Exception\ParseException $e) {
            return false;
        }
    }

}
