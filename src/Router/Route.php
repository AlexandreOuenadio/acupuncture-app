<?php

namespace App\Router;

class Route{

    private $method = null;
    private $path = null;
    private $controller = null;

    public function __construct($method, $path, $controller){
        $this->method = $method;
        $this->path = $path;
        $this->controller = $controller;
    }

    public function run($request_params=0){
        if (count($request_params) > 0){
            call_user_func_array($this->controller, $request_params);
        }else{
            call_user_func_array($this->controller, []);
        }
        

    }

    public function hasParams(){
        return preg_match('/:[\w]+/i', $this->path) ? true : false;
    }

    public function getPath($regex_version = false){
        if ($regex_version){
            //La version regex du path echappe les forward slashs
            return '/^'. str_replace('/', '\/', $this->path) . '$/i';
        }
        return $this->path;
    }





    public function getRegexPath(){
        //Permet de détecter les paramètres dans l'url customisée de type "id" et "name"
        $pre_regex_path = preg_replace(['/:id/i', '/:name/i'], ['(\d+)', '([a-zA-Z]+)'], $this->path);
        // On échappe les forward slashs pour l'ex
        $pre_regex_path = str_replace('/', '\/', $pre_regex_path);

        $regex = "/^$pre_regex_path$/i";

        return $regex;



    }

}