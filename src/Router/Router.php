<?php

namespace App\Router;

class Router{

    private $routes = [];
    private $request_params = [];
    const AVAILABLE_METHODS = ['GET', 'POST'];
    private $route404 = null;

    public function addRoute($method,$path, $controller){
        if (!in_array($method,self::AVAILABLE_METHODS)){ // Le routeur ne filtre que les requêtes GET et POST
            throw new RouterException('Erreur enregistrement de route - Méthode HTTP non reconnue');
        }

        $this->routes[$method][] = new Route($method, $path, $controller);

    }

    public function add404Route($controller){
        $this->route404 = new Route404($controller);

    }

    public function getInfo(){
        
        echo '<div style="border: 1px solid black; width: 300px; padding: 10px; margin: 30px 0;">';
        echo '<h1>ROUTER INFO</h1>';
        echo '<h2>REQUEST INFO</h2>';
        echo '<ul>';
        echo'<li> Requested method: ' . $_SERVER['REQUEST_METHOD'] . '</li>'; 
        echo'<li> Requested URI: ' . $_GET['p'] . '</li>'; 
        echo '</ul>';
        echo '<h3>AVAILABLE GET ROUTES</h3>';
        echo '<ul>';
        if (isset($this->routes['GET']) && count($this->routes['GET']) > 0){
            foreach($this->routes['GET'] as $route){
                $routePath=$route->getPath();
                echo  '<li>' . $routePath . '</li>';
            }
        }else{
            echo 'Aucune route disponible';
        }
        echo '</ul>';

        echo '<h3>AVAILABLE POST ROUTES</h3>';
        echo '<ul>';
        if (isset($this->routes['POST']) && count($this->routes['POST']) > 0){
            foreach($this->routes['POST'] as $route){
                $routePath=$route->getPath();
                echo  '<li>' . $routePath . '</li>';
            }
        }else{
            echo 'Aucune route disponible';
        }
        echo '</ul>';
        echo '</div>';


    }



    public function listen(){

        $requested_method = $_SERVER['REQUEST_METHOD'];
        
        //Soit on fait une requete index.php?p=${path} ou /
        $requested_path = isset($_GET['p']) ? '/' . $_GET['p'] : '/'; 
        

        $possible_routes = $this->routes[$requested_method];
        $result_route = null;

        //RESOLUTION DE LA ROUTE
        foreach($possible_routes as $route){

            if ($route->hasParams()){
                $matches = [];
                //La route est du type /blablabla/.../:id ou /blablabla/.../:name
                if (preg_match($route->getRegexPath(), $requested_path, $matches)){
                    $result_route = $route;

                    //On vire le match qui comprend l'url entière (index 0);
                    array_shift($matches);
                    //On récupère les paramètres de l'URI
                    $this->request_params = $matches;

                    break;
                }
            }else{
                //La route est du type /blablabla (sans parametre)
                if (preg_match($route->getPath(true), $requested_path)){
                    $result_route = $route;
                    break;
                }
            }
          
            
        }

        if (empty($result_route)){
            http_response_code(404);
            return $this->route404->run();
        }

        $result_route->run($this->request_params);
        

    }






}