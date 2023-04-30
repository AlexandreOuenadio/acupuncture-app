<?php

//MOTEUR DE TEMPLATING
use Twig\Loader\FilesystemLoader;
use Twig\Environment;

function renderPage(string $pageName, array $params) : void {

    $loader = new FilesystemLoader(join(DIRECTORY_SEPARATOR, [__DIR__, '..', 'Views']));
    $twig = new Environment($loader, ['cache' => false]); 

    if (count($params) > 0){
        echo $twig->render($pageName . '.twig', [
            'page_css_file' => $pageName . '.css',
            ...$params
        ]);
    }else{
        echo $twig->render($pageName . '.twig', [
            'page_css_file' => $pageName . '.css'
        ]);
    }
}


