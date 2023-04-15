<?php

//ROUTER - API
switch($_SERVER['REQUEST_URI']){

    case '/':
        require(join(DIRECTORY_SEPARATOR, [__DIR__,'controllers', 'index.php']));
        break;
    case '/pathologie':
        require(join(DIRECTORY_SEPARATOR, [__DIR__,'controllers', 'pathologie.php']));
        break;
    case '/login':
        require(join(DIRECTORY_SEPARATOR, [__DIR__,'controllers', 'login-register.php']));
        break;
    default:
        http_response_code(404);
        require(join(DIRECTORY_SEPARATOR, [__DIR__,'controllers', '404.php']));
        break;
    
}