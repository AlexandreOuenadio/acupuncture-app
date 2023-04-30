<?php

require_once(join(DIRECTORY_SEPARATOR, [__DIR__, '..', 'utils', 'functions.php']));

use App\Models\Database;
function isUserConnected(){

    checkSessionStart();

    if (isset($_SESSION['user'])){

        return $_SESSION['user'];
    }

    closeSession();
    return false;

}


function loginUser(){

    //Appeler le model de Arthur ici
    $dsn = 'pgsql:host=localhost;port=5432;dbname=acudb';
    $user_db = 'postgres';
    $password_db = '1234';
    $db = new Database($dsn, $user_db, $password_db);
    $user = $_POST['login-username'];
    $password = $_POST['login-password'];
    
    
    if(isset($user) && isset($password)){
        if(!empty($user) && !empty($password)){
            if($db->check_password($user,$password)){
                
                checkSessionStart();
                $_SESSION['user'] = $user;
                header('Location: /pathologie');
                return "";
            }
        }
    }
    return "Nom d'utilisateur ou mot de passe incorrect.";
}

function logoutUser(){

    if(isset($_POST['user-disconnect']) && !empty($_POST['user-disconnect'])){
        if($_POST['user-disconnect'] === '1'){
    
            closeSession();
            
            header('Location: /auth');
        }
    }
}


function registerUser(){
    $dsn = 'pgsql:host=localhost;port=5432;dbname=acudb';
    $user_db = 'postgres';
    $password_db = '1234';
    $db = new Database($dsn, $user_db, $password_db);

    $user = $_POST['signup-username'];
    $password = $_POST['signup-password'];
    $password_confirmation = $_POST['signup-password2'];
    if(isset($user) && isset($password) && isset($password_confirmation)){
        if(!empty($user) && !empty($password) && !empty($password_confirmation)){
            if($password==$password_confirmation){
                if(!$db->user_exists($user)){
                    if($db->add_user($user,$password)){
                    
                        checkSessionStart();
                        $_SESSION['user'] = $user;
                        header('Location: /pathologie');
                        return "";
                    }
                    return "Erreur de communication avec le serveur.";
                }
                return "L'utilisateur existe déjà, veuillez vous connecter.";
            }
            return "Mots de passe différents, veuillez réssayer.";
        }
        
    }
    return "Une erreur est survenue, veuillez contacter l'administrateur du site.";
}

function cookie_erreur_authentification(){
    if(isset($_COOKIE["erreur_authentification"])){
        setcookie("erreur_authentification", "", time() - 1000);
    }
}  
