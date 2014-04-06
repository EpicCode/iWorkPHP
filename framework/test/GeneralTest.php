<?php

class GeneralTest extends PHPUnit_Framework_TestCase {

    private function indexEmulator() {
        // Get the composer autoload
        $composer = require_once __DIR__ . '/../../vendor/autoload.php';
        // Call to framework loader
        $loader = new \iWorkPHP\Core\Loader($composer);
        // handle actual request
        $loader->handleRequest();
        // Send response from actual request
        $loader->send();
    }

    private function prepareRequest($path = '') {
        $request = new \Symfony\Component\HttpFoundation\Request();
        $ret = $request->create('http://site.com/index.php/' . $path);
        $ret->overrideGlobals();
    }

    public function testIndex() {
        $this->prepareRequest();
        $this->expectOutputRegex('/Welcome to iWorkPHP/');
        $this->indexEmulator();
    }

    public function testTwig() {
        $this->prepareRequest('twig');
        $this->expectOutputRegex('/aVdvcmtQSFA=/');
        $this->indexEmulator();
    }

    public function testHelloWorld() {
        $this->prepareRequest('hello/World');
        $this->expectOutputRegex('/Hello World/');
        $this->indexEmulator();
    }

    public function test404() {
        $this->prepareRequest('not_exist');
        $this->expectOutputRegex('/404/');
        $this->indexEmulator();
    }

}
