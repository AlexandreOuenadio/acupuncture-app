<?php

$URI = parse_url($_SERVER['REQUEST_URI']);
if (isset($URI['query']) && explode('=',$URI['query'])[0] === "page"){
    $query = explode('=',$URI['query'])[1];
    switch($query){
        case 'accueil':
            require(join(DIRECTORY_SEPARATOR, [__DIR__,'controllers','rendering', 'index.php']));
            break;
        case 'pathologie':
            require(join(DIRECTORY_SEPARATOR, [__DIR__,'controllers', 'rendering','pathologie.php']));
            break;
        case 'login':
            require(join(DIRECTORY_SEPARATOR, [__DIR__,'controllers', 'rendering','login-register.php']));
            break;
        case '404':
            http_response_code(404);
            require(join(DIRECTORY_SEPARATOR, [__DIR__,'controllers','rendering', '404.php']));
            break;
        default:
            http_response_code(404);
            require(join(DIRECTORY_SEPARATOR, [__DIR__,'controllers','rendering', '404.php']));
            break;
        
    }
}

//ROUTER - API
switch($_SERVER['REQUEST_URI']){

    case '/':
        require(join(DIRECTORY_SEPARATOR, [__DIR__,'controllers','rendering', 'index.php']));
        break;
    case '/pathologie':
        require(join(DIRECTORY_SEPARATOR, [__DIR__,'controllers', 'rendering','pathologie.php']));
        break;
    case '/login':
        require(join(DIRECTORY_SEPARATOR, [__DIR__,'controllers', 'rendering','login-register.php']));
        break;
    default:
        http_response_code(404);
        require(join(DIRECTORY_SEPARATOR, [__DIR__,'controllers','rendering', '404.php']));
        break;
    
}