<?php
session_start();
$users = array('gaph','thomas');
$passwords = array('gaoph','salaud');
if(isset($_POST['username']) && isset($_POST['password']))
{
    if($_POST['username'] !== "" && $_POST['password'] !== "")
    {
        if(in_array($_POST['username'],$users) && in_array($_POST['password'], $passwords)) 
        {
        $_SESSION['username'] = $_POST['username'];
        header('Location: pathologie.php');
        }
        else
        {
        header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
        }
    }
    else
    {
    header('Location: login.php?erreur=2'); // utilisateur ou mot de passe vide
    }
}
else
{
header('Location: login.php');
}
   ?>