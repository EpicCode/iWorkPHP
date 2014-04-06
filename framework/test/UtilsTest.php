<?php

class UtilsTest extends PHPUnit_Framework_TestCase {

    private $utils;

    public function __construct() {
        $this->utils = new \iWorkPHP\Service\Utils\Utils();
    }

    public function testArrayToObject() {

        $array = array('foo' => 'bar', 1 => 2, 'test');

        $expected = new stdClass;
        $expected->foo = 'bar';
        $expected->{1} = 2;
        $expected->{2} = 'test';

        $this->assertEquals($expected, $this->utils->arrayToObject($array));
    }

    private function auxiliaryStandardizeUrl($url) {
        $expected = '/page/';
        $this->assertEquals($expected, $this->utils->standardizeUrl($url));
    }

    public function testStandardizeUrl() {

        $this->auxiliaryStandardizeUrl('/page');

        $this->auxiliaryStandardizeUrl('/page/');

        $this->auxiliaryStandardizeUrl('./page');

        $this->auxiliaryStandardizeUrl('./page/');

        $this->auxiliaryStandardizeUrl('.//page');

        $this->auxiliaryStandardizeUrl('.//page/');

        $this->auxiliaryStandardizeUrl('./index.php/page');

        $this->auxiliaryStandardizeUrl('./index.php/page/');

        $this->auxiliaryStandardizeUrl('//index.php/page');

        $this->auxiliaryStandardizeUrl('//index.php/page/');

        $this->auxiliaryStandardizeUrl('///page');

        $this->auxiliaryStandardizeUrl('///page/');

        $this->auxiliaryStandardizeUrl('index.php/page');

        $this->auxiliaryStandardizeUrl('index.php/page/');

        $this->auxiliaryStandardizeUrl('/index.php/page');

        $this->auxiliaryStandardizeUrl('/index.php/page/');

        $protocols = array('http', 'https', 'ftp', 'ssh');

        foreach ($protocols as $protocol) {
            $this->auxiliaryStandardizeUrl($protocol . '://site.com/index.php/page');

            $this->auxiliaryStandardizeUrl($protocol . '://site.com/index.php/page/');

            $this->auxiliaryStandardizeUrl($protocol . '://site.com/page');

            $this->auxiliaryStandardizeUrl($protocol . '://site.com/page/');
        }
    }

}
