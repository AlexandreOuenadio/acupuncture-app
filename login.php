<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion</title>
        <link rel="icon" type="image/x-icon" href="assets/images/favicon.ico">
        <link rel="stylesheet" href="assets/css/global.css">
        <link rel="stylesheet" href="assets/css/login.css">
        <link rel="stylesheet" href="assets/css/header_footer.css">
    </head>

    <body>
        <?php require('templates/header.php'); ?>
        <?php
        if(isset($_GET['deconnexion']))
        { 
        if($_GET['deconnexion']==true)
        { 
        session_unset();
        header("location:login.php");
        }
        }
        ?>
        <div id="container">
            <!-- Zone où se connecter -->

            <form action="verification.php" method="POST">
                <h1>Connexion</h1>

                <label><b>Nom d'utilisateur</b></label>
                <input type='text' placeholder="Entrer le nom d'utilisation ou votre mail" name="username" required>

                <label><b>Mot de passe</b></label>
                <input type="password" placeholder="Entre le mot de passe" name="password" required>
                
                <div class="password-icon">
                    <ion-icon name="eye-outline" class="eye"></ion-icon>
                    <ion-icon name="eye-off-outline" class="eye-off"></ion-icon>
                </div>

                <input type="submit" id="submit" value="LOGIN">
                <?php
                if(isset($_GET['erreur'])){
                    $err = $_GET['erreur'];
                    if($err==1 || $err==2)
                    echo "<p style='color:red'>Utilisateur ou mot de passe incorrect</p>";
                    }
                    ?>
                <h2> Ou créez votre compte <a href= "compte.php" style="color:green;">ici </a> </h2> 
            </form>
        </div>
        <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
        <script src="assets/js/login.js"></script>
    </body>
</html>

