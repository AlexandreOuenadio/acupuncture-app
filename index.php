<?php
//--------- AFFICHAGE DES ERREURS POUR LE DEVELOPPEMENT --------- 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


//--------- AUTOLOADING DES CLASSES --------- 
require_once(join(DIRECTORY_SEPARATOR, [__DIR__, 'vendor', 'autoload.php']));

//--------- CLASSE ROUTEUR --------- 
use App\Router\Router;


//--------- UTILS --------- 


//--------- CONTROLLEURS (use function ne marche pas fsr) --------- 
// controlleur de rendu de page
require_once(join(DIRECTORY_SEPARATOR, [__DIR__, 'src', 'Controllers', 'renderPage.php']));
// controlleur de vérification de connexion utilisateur
require_once(join(DIRECTORY_SEPARATOR, [__DIR__, 'src', 'Controllers', 'checkUserAuth.php']));
// controlleur de récupération des données sur les pathologies
require_once(join(DIRECTORY_SEPARATOR, [__DIR__, 'src', 'Controllers', 'searchData.php']));


// --------- CODE DU SEP --------- 


try{

    $app_router = new Router();

    //On vérifie si l'utilisateur est connecté. Si c'est le cas un tableau avec les données de l'utilisateur est renvoyé, sinon un booléen false est renvoyé
    $user = isUserConnected();
    $data = getDataFromSession();

    //ENREGISTREMENT DE ROUTES 
    //Remarque: Le premier paramètre de la fonction renderPage correspond au nom de la page à afficher et le second les paramètres à transmettre à la vue
    // Le nom de la page correspond aussi aux noms des fichiers twig et css, qui doivent donc avoir le même nom !
    // Valeurs possibles pour les paramètres: "page_title" pour le titre de l'onglet de la page et "userConnected" pour transmettre l'état de connexion de l'utilsateur 
    
    //ROUTES GET
    $app_router->addRoute("GET", "/", fn() => renderPage('index', ['page_title' => 'Accueil', 'userConnected'=> $user]));
    $app_router->addRoute("GET", "/pathologie", function () use($user,$data){
        //Page uniquement accessible si l'on est connecté
        //Si l'on est pas connecté redirige vers la page d'authentification
        if (empty($user)){
           return header('Location: /auth'); 
        }
        renderPage('pathologie', ['page_title' => 'Rechercher une pathologie', 'userConnected'=> $user, ...$data]);
    });
    $app_router->addRoute("GET", "/auth", function() use($user){

        
        if(isset($_COOKIE["erreur_authentification"])){
            renderPage('auth', ['page_title' => 'Authentification', 'userConnected'=> $user, "erreur"=>$_COOKIE["erreur_authentification"]]);
        }
        else{
            renderPage('auth', ['page_title' => 'Authentification', 'userConnected'=> $user]);
        }


    });
    
    $app_router->addRoute("GET", "/info", fn() => renderPage('info', ['page_title' => 'Informations', 'userConnected'=> $user]));
    
    //ROUTES POST
    // L'utilisateur veut se connecter
    $app_router->addRoute("POST", "/auth/login", function (){
        // Définir la valeur de la variable
        cookie_erreur_authentification();
        $message_erreur=loginUser();
        if(!empty($message_erreur)){
            // Définir la durée de vie du cookie en secondes (ici, 1 heure)
            $duree_vie_cookie = time()+2;
            // Ajouter la variable dans les cookies
            setcookie("erreur_authentification", $message_erreur, $duree_vie_cookie);
            header('Location: /auth');
        }

    });
    // L'utilisateur veut s'enregistrer
    $app_router->addRoute("POST", "/auth/register", function (){
        cookie_erreur_authentification();
        $message_erreur=registerUser();
        if(!empty($message_erreur)){
            // Définir la durée de vie du cookie en secondes (ici, 1 heure)
            $duree_vie_cookie = time()+2;
            // Ajouter la variable dans les cookies
            setcookie("erreur_authentification", $message_erreur, $duree_vie_cookie);
            header('Location: /auth');
        }
    });
    // L'utilisateur veut se déconnecter
    $app_router->addRoute("POST", "/auth/logout", function (){
        logoutUser();
    });

    $app_router->addRoute("POST", "/pathologie", function () use($user) {
        if (empty($user)){
            return header('Location: /auth'); 
        }
        
        $data = doResearch();
        renderPage('pathologie', ['page_title' => 'Rechercher une pathologie', 'userConnected'=> $user, ...$data]);
    });
    
    //On définit le fichier pour la page 404
    $app_router->add404Route(fn() => renderPage('404', ['page_title' => 'Erreur 404 - Page non trouvée', 'userConnected'=> $user]));

    // Utilisez $app_router->getInfo(); pour avoir quelques infos sur le routeur en décommentant $app_route->listen()
    // $app_router->getInfo();
    
    // //Mise en marche du routeur
    $app_router->listen();

}catch(\Exception $e){

    echo '<strong>' . $e->getMessage() . '</strong>';

}



// // Controlleur vérification authentification
// checkSessionStart();
// $userConnected = false;
// if (isset($_SESSION['username']) && !empty($_SESSION['username'])){
//     $userConnected = true;
// }

// //ROUTER - API
// if (isset($_GET['p'])){ //METHOD GET pour obtenir une page

    

//     switch($_GET['p']){  
//         case 'pathologie': //Route
//             //Controlleur rendering
//             echo $twig->render('pathologie.twig', [
//                 'page_title' => 'Pathologie',
//                 'page_css_file' => 'pathologie.css',
//                 'userConnected' => $userConnected
//             ]);
//             break;
//         case 'auth': 
//             echo $twig->render('auth.twig', [
//                 'page_title' => 'Authentification',
//                 'page_css_file' => 'auth.css',
//                 'userConnected' => $userConnected
//             ]);
//             break;
//         default:
//             http_response_code(404);
//             echo $twig->render('404.twig');
//             break;
//     }
// }else{
//     echo $twig->render('index.twig', [
//         'page_title' => 'Accueil',
//         'page_css_file' => 'index.css',
//         'userConnected' => $userConnected
//     ]);
// }