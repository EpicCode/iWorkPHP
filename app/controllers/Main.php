<?php

namespace Controller;

/**
 * Main controller
 *
 * @author EpicJhon
 */
class Main extends Controller {

    public function mainAction() {
        $this->render('main');
    }

    public function textAction() {
        $this->sendText('Send plain text');
    }

    public function helloAction($name) {
        $this->render('hello', array('name' => $name));
    }

    public function errorAction() {
        $this->render('404');
    }

}
