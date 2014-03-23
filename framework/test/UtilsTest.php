<?php

class UtilsTest extends PHPUnit_Framework_TestCase {

    public function testArrayToObject() {

        $array = array('foo' => 'bar', 1 => 2, 'test');

        $expected = new stdClass;
        $expected->foo = 'bar';
        $expected->{1} = 2;
        $expected->{2} = 'test';

        $utils = new \iWorkPHP\Utils();
        $this->assertEquals($expected, $utils->arrayToObject($array));
    }

}
