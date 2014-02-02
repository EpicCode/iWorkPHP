<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iWorkPHP;

/**
 * Description of Utils
 *
 * @author Jhonjhon_123
 */
class Utils
{

    public function standardizeUrl($url)
    {
        return (substr($url, -1) != '/') ? $url . '/' : $url;
    }

    public function iifIssetArray($array, $key, $default)
    {
        return (isset($array[$key])) ? $array[$key] : $default;
    }

}
