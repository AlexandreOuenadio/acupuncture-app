<?php

namespace App\Router;

class Route404 extends Route{

    private $method = null;
    private $path = null;
    private $controller = null;

    public function __construct($controller){
        $this->controller = $controller;
    }

    //Override
    public function run($request_params=0){
        call_user_func($this->controller);
    }


}