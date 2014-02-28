<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Controller;

/**
 * Description of Main
 *
 * @author Jhonjhon_123
 */
class Main extends Controller
{

    public function mainAction()
    {
        $this->sendText('Welcome to iWorkPHP');
    }

    public function helloAction($name)
    {
        $this->render('hello', array('name' => $name));
    }
    
    public function errorAction()
    {
        $this->render('404');
    }

}
