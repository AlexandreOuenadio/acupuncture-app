<?php

$users = array('gaph','thomas');
$passwords = array('gaoph','salaud');

if(isset($_POST['login-username']) && isset($_POST['login-password']))
{
    if($_POST['login-username'] !== "" && $_POST['login-password'] !== "")
    {
        if(in_array($_POST['login-username'],$users) && in_array($_POST['login-password'], $passwords)) 
        {
            session_start();
            $_SESSION['username'] = $_POST['login-username'];
            header('Location: /pathologie');
        }
        else
        {
            header('Location: /login?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
        header('Location: /login?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
    header('Location: /login');
}
?>