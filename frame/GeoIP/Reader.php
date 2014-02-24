<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace iWorkPHP\GeoIP;

/**
 * Description of GeoIP
 *
 * @author Hax0r
 */
class Reader extends \GeoIp2\Database\Reader
{

    public function __construct($mode, $locales = array('en'), $filename = '')
    {
        if (empty($filename))
        {
            $path = __DIR__ . '/files/';
            switch ($mode)
            {
                case 'City':
                    $file = $path . 'GeoLite2-City.mmdb';
                    break;
                case 'Country':
                    $file = $path . 'GeoLite2-Country.mmdb';
                    break;
            }
        } else
        {
            $file = $filename;
        }
        parent::__construct($file, $locales);
    }

}
