<?php

namespace Controller;

use \iWorkPHP\Core\Controller;

/**
 * Main controller
 */
class Main extends Controller {

    public function mainAction() {
        $this->render('main');
    }

    public function helloAction($name) {
        $this->render('hello', array('name' => $name));
    }

    public function textAction() {
        $this->sendText('Send plain text');
    }

    public function twigAction() {
        $this->render('twig');
    }

    public function errorAction() {
        $this->render('404');
    }

}
